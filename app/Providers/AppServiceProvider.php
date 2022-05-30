<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Setting;
use App\Models\SiteSection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('currency',function ($app){
           return new \NumberFormatter(App::currentLocale(),\NumberFormatter::CURRENCY);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('ar');
        //configurations
        $configs = Cache::get('configs');
        if(!$configs){
            $configs = Setting::all();
            Cache::put('configs',$configs);
        }
        foreach ($configs as $config){
            Config::set($config->key,$config->value);
        }

        //pass variable to specific layouts
        view()->composer(
            'admin.layouts.sidebar', function ($view) {
                $view->with(['categories'=> BlogCategory::limit(4)->get(),]);
            }
        );

        view()->composer(
            'site.news.news', function ($view) {
                $view->with(['all_news'=>Blog::where(['active'=>1,'category_id'=>2])->latest()->limit(6)->get(),]);
            }
        );

        view()->composer(
            'site.layouts.header', function ($view) {
                $view->with([
                    'setting'=> new Setting(),
                    'image'=> SiteSection::with('image')->where('name','header_logo')->first()->image->image,
                    'links'=> SiteSection::with('links')->where('name','header_links')->first()->links,
                ]);
            }
        );

        view()->composer(
            'site.layouts.footer', function ($view) {
                $view->with([
                    'image'=> SiteSection::with('image')->where('name','footer_logo')->first()->image->image,
                    'content'=> SiteSection::with('site_contents')->where(['name'=>'footer_top'])->first()->site_contents->first()->body,
                    'about_links'=> SiteSection::with('links')->where('name','footer_about_links')->first()->links,
                    'content_links'=> SiteSection::with('links')->where('name','footer_content_links')->first()->links,
                    'social_links'=> SiteSection::with('links')->where('name','header_links')->first()->links,
                    'footer_content'=> SiteSection::with('site_contents')->where(['name'=>'footer_bottom'])->first()->site_contents->first()->body,
                ]);
            }
        );
    }
}

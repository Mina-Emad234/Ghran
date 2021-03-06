<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($auth,$ability){
            if($auth->email=='mina@gmail.com'){
                return true;
            }
        });

        foreach (config('global.permissions') as $ability => $value){
            Gate::define($ability,function ($auth) use ($ability){
                return $auth->hasAbility($ability);//get role in array
            });
        }
    }
}

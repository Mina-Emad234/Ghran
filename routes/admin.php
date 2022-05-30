<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can volunteer web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'App\Http\Controllers\Admin'], function () {
    Route::group(['middleware'=>'guest:admin'],function () {
        Route::get('login','LoginController@getLogin')->name("admin.login");
        Route::post('login','LoginController@postLogin')->name('login');
    });
    Route::group(['middleware'=>'auth:admin'], function () {
        Route::post('logout','LoginController@logout')->name("admin.logout");
        Route::get('home','DashboardController@index')->name("admin.home");
        ##################### categories #####################
        Route::resource('blog/categories','BlogCategoriesController',['middleware'=>'can:categories']);
        ##################### blogs #####################
        Route::group(['middleware'=>'can:blogs'], function () {
            Route::get('category/blogs/{slug}','BlogsController@CategoryBlogs')->name('blogs.cats');
            Route::get('blogs/activate/{blog}','BlogsController@activate')->name('blogs.activate');
            Route::get('blogs/deactivate/{blog}','BlogsController@deactivate')->name('blogs.deactivate');
            Route::resource('blogs','BlogsController');
        });
        ##################### comments #####################
        Route::group(['prefix'=>'comments','middleware'=>'can:comments'], function () {
            Route::get('/{blog_slug?}','CommentsController@index')->name('comments.index');
            Route::get('delete/{comment}','CommentsController@delete')->name('comments.delete');
            Route::get('activate/{comment}','CommentsController@activate')->name('comments.activate');
            Route::get('deactivate/{comment}','CommentsController@deactivate')->name('comments.deactivate');
        });
        ######################## info ########################
        Route::group(['middleware'=>'can:info'], function () {
            Route::get('info/activate/{info}','InfoController@activate')->name('info.activate');
            Route::get('info/deactivate/{info}','InfoController@deactivate')->name('info.deactivate');
            Route::get('info/sort/{info}/{direction}','InfoController@sort')->name('info.sort');
            Route::resource('info','InfoController');
        });
        ######################## tags ########################
        Route::group(['middleware'=>'can:tags'], function () {
            Route::get('tags/blogs/{slug}','TagsController@getBlogTags')->name('tags.blogs');
            Route::get('tags/activate/{tag}','TagsController@activate')->name('tags.activate');
            Route::get('tags/deactivate/{tag}','TagsController@deactivate')->name('tags.deactivate');
            Route::resource('tags','TagsController');
        });
        ######################## v_question ########################
        Route::group(['middleware'=>'can:votes'], function () {
            Route::get('votes/questions/activate/{vote}','VoteQuestionsController@activate')->name('questions.activate');
            Route::get('votes/questions/deactivate/{vote}','VoteQuestionsController@deactivate')->name('questions.deactivate');
            Route::get('votes/questions/sort/{vote}/{direction}','VoteQuestionsController@sort')->name('questions.sort');
            Route::get('votes/questions/result/{question_id?}','VoteQuestionsController@result')->name('results.index');
            Route::resource('votes/questions','VoteQuestionsController');
        });
        ######################## admins ########################
        Route::group(['middleware'=>'can:admins'], function () {
            Route::get('admins/activate/{admin}','AdminsController@activate')->name('admins.activate');
            Route::get('admins/profile/edit','AdminsController@profileEdit')->name('admins.profile');
            Route::get('admins/deactivate/{admin}','AdminsController@deactivate')->name('admins.deactivate');
            Route::resource('admins','AdminsController');
        });
        ######################## contact ########################
        Route::group(['prefix'=>'users/contacts','middleware'=>'can:contacts'], function () {
            Route::get('/','ContactsController@index')->name('contact.index');
            Route::get('read/{contact}','ContactsController@read')->name('contact.read');
            Route::get('open_file/{email}/{file}','ContactsController@open_file')->name('contact.open');
            Route::get('delete/{contact}','ContactsController@delete')->name('contact.delete');
        });
        ######################## mails ########################
        Route::group(['prefix'=>'mails/list','middleware'=>'can:mails'], function () {
            Route::get('/','ListMailsController@index')->name('mails.index');;
            Route::get('delete/{mail}','ListMailsController@delete')->name('mails.delete');
        });
        ######################## courses ########################
        Route::group(['middleware'=>'can:courses'], function () {
            Route::get('courses/payable','CoursesController@payable')->name('courses.payable');
            Route::get('courses/activate/{course}','CoursesController@activate')->name('courses.activate');
            Route::get('courses/deactivate/{course}','CoursesController@deactivate')->name('courses.deactivate');
            Route::resource('courses','CoursesController');
        });
        ######################## videos ########################
        Route::group(['middleware'=>'can:courses'], function () {
            Route::get('courses/videos/{course}','VideosController@getCourseVideos')->name('courses.videos.index');
            Route::get('videos/activate/{video}','VideosController@activate')->name('videos.activate');
            Route::get('videos/deactivate/{video}','VideosController@deactivate')->name('videos.deactivate');
            Route::get('videos/sort/{video}/{direction}','VideosController@sort')->name('videos.sort');
            Route::resource('videos','VideosController');
        });
        ######################## scouts_applicants ########################
        Route::group(['prefix'=>'scouts/applicants','middleware'=>'can:socials'], function () {
            Route::get('/','ScoutsController@index')->name('scouts.index');
            Route::get('read/{scout}','ScoutsController@read')->name('scouts.read');
            Route::get('delete/{scout}','ScoutsController@delete')->name('scouts.delete');
        });
        ######################## media_center_applicants ########################
        Route::group(['prefix'=>'media/center/applicants','middleware'=>'can:socials'], function () {
            Route::get('/','MediaApplicantsController@index')->name('media.index');
            Route::get('read/{applicant}','MediaApplicantsController@read')->name('media.read');
            Route::get('delete/{applicant}','MediaApplicantsController@delete')->name('media.delete');
        });
        ######################## volunteer_applicants ########################
        Route::group(['prefix'=>'volunteers','middleware'=>'can:socials'], function () {
            Route::get('/','VolunteersController@index')->name('volunteer.index');
            Route::get('read/{volunteer}','VolunteersController@read')->name('volunteer.read');
            Route::get('delete/{volunteer}','VolunteersController@delete')->name('volunteer.delete');
        });
        ################## albums ################
        Route::resource('albums','AlbumsController',['middleware'=>'can:photo_category']);
        ######################## photo ########################
        Route::group(['middleware'=>'can:photos'], function () {
            Route::get('album/photos/{slug}','PhotosController@getAlbumPhotos')->name('album.photos');
            Route::get('photos/activate/{photo}','PhotosController@activate')->name('photos.activate');
            Route::get('photos/deactivate/{photo}','PhotosController@deactivate')->name('photos.deactivate');
            Route::resource('photos','PhotosController');
        });
        ######################## partners ########################
        Route::group(['middleware'=>'can:partners'], function () {
            Route::get('partners/activate/{partner}','PartnersController@activate')->name('partners.activate');
            Route::get('partners/deactivate/{partner}','PartnersController@deactivate')->name('partners.deactivate');
            Route::get('partners/sort/{partner}/{direction}','PartnersController@sort')->name('partners.sort');
            Route::resource('partners','PartnersController');
        });
        ######################## settings ########################
        Route::group(['prefix'=>'settings','middleware'=>'can:settings'], function () {
            Route::get('/','SettingsController@index')->name('settings.index');
            Route::get('edit/{setting}','SettingsController@edit')->name('settings.edit');
            Route::post('update/{setting}','SettingsController@update')->name('settings.update');
        });
        ######################## roles ########################
        Route::resource('roles','RolesController',['middleware'=>'can:roles']);
        ######################## media_center_applicants ########################
        Route::group(['prefix'=>'course_applicants','middleware'=>'can:courses'], function () {
            Route::get('/{course_id?}','CourseApplicantsController@index')->name('course.applicants.index');
            Route::get('read/{applicant}','CourseApplicantsController@read')->name('course.applicants.read');
            Route::get('delete/{applicant}','CourseApplicantsController@delete')->name('course.applicants.delete');
        });
        ################## site-sections ################
        Route::resource('site/sections','SiteSectionsController',['middleware'=>'can:site-sections','as'=>'site']);
        ######################## site_image ########################
        Route::group(['prefix'=>'site/images','middleware'=>'can:site-images'], function () {
            Route::get('/','SiteImagesController@index')->name('site.images.index');
            Route::get('create','SiteImagesController@create')->name('site.images.create');
            Route::post('store','SiteImagesController@store')->name('site.images.store');
        });

        ######################## site_content ########################
        Route::group(['middleware'=>'can:site-content'], function () {
            Route::get('site/content/activate/{content}','SiteContentController@activate')->name('site.content.activate');
            Route::get('site/content/deactivate/{content}','SiteContentController@deactivate')->name('site.content.deactivate');
            Route::resource('site/content','SiteContentController',['as'=>'site']);
        });

        ######################## site_link ########################
        Route::group(['middleware'=>'can:site-links'], function () {
            Route::get('site/links/activate/{link}','SiteLinksController@activate')->name('site.links.activate');
            Route::get('site/links/deactivate/{link}','SiteLinksController@deactivate')->name('site.links.deactivate');
            Route::resource('site/links','SiteLinksController',['as'=>'site']);
        });
    });
});

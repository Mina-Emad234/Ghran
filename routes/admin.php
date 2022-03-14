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
        Route::get('logout','LoginController@logout')->name("admin.logout");
        Route::get('home','DashboardController@index')->name("admin.home");
        ################## blog category ################
        Route::group(['prefix'=>'blog_categories','middleware'=>'can:categories'], function () {
            Route::get('/','BlogCategoryController@index')->name('category.index');
            Route::get('create','BlogCategoryController@create')->name('category.create');
            Route::post('store','BlogCategoryController@store')->name('category.store');
            Route::get('edit/{id}','BlogCategoryController@edit')->name('category.edit');
            Route::post('update/{id}','BlogCategoryController@update')->name('category.update');
            Route::get('delete/{id}','BlogCategoryController@delete')->name('category.delete');
        });

        ######################## blog ########################
        Route::group(['prefix'=>'blogs','middleware'=>'can:blogs'], function () {
            Route::get('/{cat_id?}','BlogController@index')->name('blog.index');
            Route::get('create','BlogController@create')->name('blog.create');
            Route::post('store','BlogController@store')->name('blog.store');
            Route::get('show/{id}','BlogController@show')->name('blog.show');
            Route::get('edit/{id}','BlogController@edit')->name('blog.edit');
            Route::post('update/{id}','BlogController@update')->name('blog.update');
            Route::get('delete/{id}','BlogController@delete')->name('blog.delete');
            Route::get('activate/{id}','BlogController@activate')->name('blog.activate');
            Route::get('deactivate/{id}','BlogController@deactivate')->name('blog.deactivate');
        });
        ##################### comment #####################
        Route::group(['prefix'=>'comments','middleware'=>'can:comments'], function () {
            Route::get('/{blog_id?}','CommentController@index')->name('comment.index');
            Route::get('delete/{id}','CommentController@delete')->name('comment.delete');
            Route::get('activate/{id}','CommentController@activate')->name('comment.activate');
            Route::get('deactivate/{id}','CommentController@deactivate')->name('comment.deactivate');
        });
        ######################## info ########################
        Route::group(['prefix'=>'information','middleware'=>'can:infos'], function () {
            Route::get('/','InfoController@index')->name('info.index');
            Route::get('create','InfoController@create')->name('info.create');
            Route::post('store','InfoController@store')->name('info.store');
            Route::get('edit/{id}','InfoController@edit')->name('info.edit');
            Route::post('update/{id}','InfoController@update')->name('info.update');
            Route::get('delete/{id}','InfoController@delete')->name('info.delete');
            Route::get('activate/{id}','InfoController@activate')->name('info.activate');
            Route::get('deactivate/{id}','InfoController@deactivate')->name('info.deactivate');
            Route::get('sort/{direction}/{id}','InfoController@sort')->name('info.sort');
        });
        ######################## tag ########################
        Route::group(['prefix'=>'tags','middleware'=>'can:tags'], function () {
            Route::get('/{blog_id?}','TagController@index')->name('tag.index');
            Route::get('create','TagController@create')->name('tag.create');
            Route::post('store','TagController@store')->name('tag.store');
            Route::get('edit/{id}','TagController@edit')->name('tag.edit');
            Route::post('update/{id}','TagController@update')->name('tag.update');
            Route::get('delete/{id}','TagController@delete')->name('tag.delete');
            Route::get('activate/{id}','TagController@activate')->name('tag.activate');
            Route::get('deactivate/{id}','TagController@deactivate')->name('tag.deactivate');
            Route::get('sort/{direction}/{id}','TagController@sort')->name('tag.sort');
        });
        ######################## v_question ########################
        Route::group(['prefix'=>'v_questions','middleware'=>'can:votes'], function () {
            Route::get('/','VoteQuestionController@index')->name('v_question.index');
            Route::get('create','VoteQuestionController@create')->name('v_question.create');
            Route::post('store','VoteQuestionController@store')->name('v_question.store');
            Route::get('edit/{id}','VoteQuestionController@edit')->name('v_question.edit');
            Route::post('update/{id}','VoteQuestionController@update')->name('v_question.update');
            Route::get('delete/{id}','VoteQuestionController@delete')->name('v_question.delete');
            Route::get('activate/{id}','VoteQuestionController@activate')->name('v_question.activate');
            Route::get('deactivate/{id}','VoteQuestionController@deactivate')->name('v_question.deactivate');
            Route::get('sort/{direction}/{id}','VoteQuestionController@sort')->name('v_question.sort');
            Route::get('result/{question_id?}','VoteQuestionController@result')->name('v_question.result');
        });
        ######################## admin ########################
        Route::group(['prefix'=>'admins','middleware'=>'can:users'], function () {
            Route::get('/','AdminController@index')->name('admin.index');
            Route::get('create','AdminController@create')->name('admin.create');
            Route::post('store','AdminController@store')->name('admin.store');
            Route::get('edit/{id}','AdminController@edit')->name('admin.edit');
            Route::post('update/{id}','AdminController@update')->name('admin.update');
            Route::get('delete/{id}','AdminController@delete')->name('admin.delete');
            Route::get('activate/{id}','AdminController@activate')->name('admin.activate');
            Route::get('deactivate/{id}','AdminController@deactivate')->name('admin.deactivate');
        });
        ######################## contact ########################
        Route::group(['prefix'=>'contact_submitters','middleware'=>'can:contacts'], function () {
            Route::get('/','ContactController@index')->name('contact.index');
            Route::get('read/{id}','ContactController@read')->name('contact.read');
            Route::get('open_file/{email}/{file}','ContactController@open_file')->name('contact.open');
            Route::get('delete/{id}','ContactController@delete')->name('contact.delete');
        });
        ######################## list_mail ########################
        Route::group(['prefix'=>'list_mails','middleware'=>'can:mails'], function () {
            Route::get('/','ListMailController@index')->name('list_mail.index');;
            Route::get('delete/{id}','ListMailController@delete')->name('list_mail.delete');
        });
        ######################## course ########################
        Route::group(['prefix'=>'courses','middleware'=>'can:courses'], function () {
            Route::get('/','CourseController@index')->name('course.index');
            Route::get('payable','CourseController@payable')->name('course.payable');
            Route::get('create','CourseController@create')->name('course.create');
            Route::post('store','CourseController@store')->name('course.store');
            Route::get('edit/{id}','CourseController@edit')->name('course.edit');
            Route::post('update/{id}','CourseController@update')->name('course.update');
            Route::get('delete/{id}','CourseController@delete')->name('course.delete');
            Route::get('activate/{id}','CourseController@activate')->name('course.activate');
            Route::get('deactivate/{id}','CourseController@deactivate')->name('course.deactivate');
        });
        ######################## video ########################
        Route::group(['prefix'=>'videos','middleware'=>'can:courses'], function () {
            Route::get('/{course_id?}','VideoController@index')->name('video.index');
            Route::get('create','VideoController@create')->name('video.create');
            Route::post('store','VideoController@store')->name('video.store');
            Route::get('show/{id}','VideoController@show')->name('video.show');
            Route::get('edit/{id}','VideoController@edit')->name('video.edit');
            Route::post('update/{id}','VideoController@update')->name('video.update');
            Route::get('delete/{id}','VideoController@delete')->name('video.delete');
            Route::get('activate/{id}','VideoController@activate')->name('video.activate');
            Route::get('deactivate/{id}','VideoController@deactivate')->name('video.deactivate');
            Route::get('sort/{direction}/{id}','VideoController@sort')->name('video.sort');
        });
        ######################## scouts_applicants ########################
        Route::group(['prefix'=>'scouts_applicants','middleware'=>'can:socials'], function () {
            Route::get('/','ScoutController@index')->name('scouts.index');
            Route::get('read/{id}','ScoutController@read')->name('scouts.read');
            Route::get('delete/{id}','ScoutController@delete')->name('scouts.delete');
        });
        ######################## media_center_applicants ########################
        Route::group(['prefix'=>'media_center_applicants','middleware'=>'can:socials'], function () {
            Route::get('/','MediaController@index')->name('media.index');
            Route::get('read/{id}','MediaController@read')->name('media.read');
            Route::get('delete/{id}','MediaController@delete')->name('media.delete');
        });
        ######################## volunteer_applicants ########################
        Route::group(['prefix'=>'volunteer_applicants','middleware'=>'can:socials'], function () {
            Route::get('/','VolunteerController@index')->name('volunteer.index');
            Route::get('read/{id}','VolunteerController@read')->name('volunteer.read');
            Route::get('delete/{id}','VolunteerController@delete')->name('volunteer.delete');
        });
        ################## albums ################
        Route::group(['prefix'=>'albums','middleware'=>'can:photo_category'], function () {
            Route::get('/','AlbumController@index')->name('album.index');
            Route::get('create','AlbumController@create')->name('album.create');
            Route::post('store','AlbumController@store')->name('album.store');
            Route::get('edit/{id}','AlbumController@edit')->name('album.edit');
            Route::post('update/{id}','AlbumController@update')->name('album.update');
            Route::get('delete/{id}','AlbumController@delete')->name('album.delete');
        });
        ######################## photo ########################
        Route::group(['prefix'=>'photos','middleware'=>'can:photos'], function () {
            Route::get('/{album_id?}','PhotoController@index')->name('photo.index');
            Route::get('create','PhotoController@create')->name('photo.create');
            Route::post('store','PhotoController@store')->name('photo.store');
            Route::get('delete/{id}','PhotoController@delete')->name('photo.delete');
            Route::get('activate/{id}','PhotoController@activate')->name('photo.activate');
            Route::get('deactivate/{id}','PhotoController@deactivate')->name('photo.deactivate');
            Route::get('sort/{direction}/{id}','PhotoController@sort')->name('photo.sort');
        });

        ######################## partner ########################
        Route::group(['prefix'=>'partners','middleware'=>'can:partner'], function () {
            Route::get('/','PartnerController@index')->name('partner.index');
            Route::get('create','PartnerController@create')->name('partner.create');
            Route::post('store','PartnerController@store')->name('partner.store');
            Route::get('edit/{id}','PartnerController@edit')->name('partner.edit');
            Route::post('update/{id}','PartnerController@update')->name('partner.update');
            Route::get('delete/{id}','PartnerController@delete')->name('partner.delete');
            Route::get('activate/{id}','PartnerController@activate')->name('partner.activate');
            Route::get('deactivate/{id}','PartnerController@deactivate')->name('partner.deactivate');
            Route::get('sort/{direction}/{id}','PartnerController@sort')->name('partner.sort');
        });
        ######################## setting ########################
        Route::group(['prefix'=>'settings','middleware'=>'can:settings'], function () {
            Route::get('/','SettingController@index')->name('setting.index');
            Route::get('create','SettingController@create')->name('setting.create');
            Route::post('add','SettingController@add')->name('setting.add');
            Route::get('edit/{id}','SettingController@edit')->name('setting.edit');
            Route::post('update/{id}','SettingController@update')->name('setting.update');
            Route::get('delete/{id}','SettingController@delete')->name('setting.delete');
        });
        ######################## roles ########################
        Route::group(['prefix' => 'roles','middleware'=>'can:roles'], function () {
            Route::get('/', 'RoleController@index')->name('roles.index');
            Route::get('/create', 'RoleController@create')->name('roles.create');
            Route::post('/store', 'RoleController@store')->name('roles.store');
            Route::get('/edit/{id}', 'RoleController@edit')->name('roles.edit');
            Route::post('/update/{id}', 'RoleController@update')->name('roles.update');
            Route::get('/delete/{id}', 'RoleController@delete')->name('roles.delete');
        });
        ######################## media_center_applicants ########################
        Route::group(['prefix'=>'course_applicants','middleware'=>'can:courses'], function () {
            Route::get('/{course_id?}','CourseApplicantController@index')->name('c_applicant.index');
            Route::get('read/{id}','CourseApplicantController@read')->name('c_applicant.read');
            Route::get('delete/{id}','CourseApplicantController@delete')->name('c_applicant.delete');
        });
        ######################## site_image ########################
        Route::group(['prefix'=>'site_images','middleware'=>'can:site_image'], function () {
            Route::get('/','SiteImageController@index')->name('site_image.index');
            Route::get('create','SiteImageController@create')->name('site_image.create');
            Route::post('store','SiteImageController@store')->name('site_image.store');
        });
    });
});

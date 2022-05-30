<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can volunteer web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'\App\Http\Controllers\Site'],function(){
    Route::get('/home','HomeController@index')->name('home');
    Route::post('/send_mail','HomeController@send_mail')->name('send_mail');
    Route::group(['prefix'=>'posts'],function(){
        Route::get('/{cat_slug?}','PostController@index')->name('post.index');
        Route::get('show/{slug}','PostController@show')->name('post.show');
        Route::get('tag_blog/{slug}','PostController@getBlogTag')->name('tag_blog.index');
        Route::post('add_comment/{slug}','PostController@addComment')->name('add_comment');
        Route::post('edit_comment/{slug}','PostController@EditComment')->name('edit_comment');
        Route::get('delete_comment/{id}','PostController@deleteComment')->name('delete_comment');
    });
    Route::group(['prefix'=>'vote'],function(){
        Route::get('previous','VoteController@votePrevious')->name('vote.previous');
        Route::post('send_vote/{id}','VoteController@voteAnswer')->name('vote.answer');
        Route::get('result/{id}','VoteController@voteResult')->name('vote.result');
    });

    Route::group(['prefix'=>'search'],function(){
        Route::get('/','SearchController@searchPage')->name('search.page');
        Route::get('/search_data/{search?}','SearchController@search')->name('search');
    });

    Route::group(['prefix'=>'album_categories'],function(){
        Route::get('/','AlbumController@index')->name('album_cat.index');
        Route::get('photos/{slug}','AlbumController@photos')->name('album_cat.photos');
    });

        Route::get('/our_partners','PartnerController@index')->name('partners.front.index');

    Route::group(['prefix'=>'pages'],function(){
        Route::get('about','PagesController@about')->name('pages.about');
        Route::get('programs','PagesController@programs')->name('pages.programs');
        Route::get('support','PagesController@support')->name('pages.support');
        Route::get('members','PagesController@members')->name('pages.members');
        Route::get('info','PagesController@info')->name('pages.info');
        Route::get('site_map','PagesController@sitemap')->name('pages.map');
    });

    Route::group(['prefix'=>'contact_us'],function(){
        Route::get('register','ContactController@registerPage')->name('contact.register');
        Route::post('send','ContactController@send')->name('contact.send');
    });

    Route::group(['prefix'=>'volunteer'],function(){
        Route::get('register','VolunteerController@registerPage')->name('volunteer.register');
        Route::post('send','VolunteerController@send')->name('volunteer.send');
    });

    Route::group(['prefix'=>'media_center'],function(){
        Route::get('register','MediaController@registerPage')->name('media.register');
        Route::post('send','MediaController@send')->name('media.send');
    });

    Route::group(['prefix'=>'scouts'],function(){
        Route::get('register','ScoutController@registerPage')->name('scout.register');
        Route::post('send','ScoutController@send')->name('scout.send');
    });

    Route::group(['prefix'=>'courses'],function(){
        Route::get('/','CourseController@getCourses')->name('course_free.all');
        Route::get('payable/','CourseController@getPayableCourses')->name('course_payable.all');
        Route::get('videos/{course_id}','CourseController@getVideos')->name('course.videos');
        Route::get('video/{video_id}','CourseController@listenVideo')->name('video');
    });

    Route::group(['prefix'=>'course_applicants'],function(){
        Route::get('register/{course_id}','CourseApplicantController@registerPage')->name('course_applicant.register');
        Route::post('send/{course_id}','CourseApplicantController@send')->name('course_applicant.send');
        Route::get('callback','CourseApplicantController@paymentCallBack');
        Route::get('callback_error','CourseApplicantController@paymentError');
    });

});

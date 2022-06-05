<?php

use App\Http\Controllers\Api\AlbumsController;
use App\Http\Controllers\Api\ApplicantsController;
use App\Http\Controllers\Api\BlogCategoriesController;
use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\MailsController;
use App\Http\Controllers\Api\MediaApplicantsController;
use App\Http\Controllers\Api\PartnersController;
use App\Http\Controllers\Api\PhotosController;
use App\Http\Controllers\Api\ScoutsController;
use App\Http\Controllers\Api\SectionsController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\SiteContentsController;
use App\Http\Controllers\Api\SiteImagesController;
use App\Http\Controllers\Api\SiteLinksController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\VideosController;
use App\Http\Controllers\Api\VolunteersController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can volunteer API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>'guest:sanctum'],function(){
    Route::post('auth/register', [UsersController::class,'register']);
    Route::post('auth/login', [UsersController::class,'login']);
});
#########################################################################
Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('user/tokens', [UsersController::class,'getAllTokens']);
    Route::delete('user/tokens/{id}', [UsersController::class,'deleteToken']);
    Route::post('auth/logout', [UsersController::class,'logout']);
    Route::post('auth/all/logout', [UsersController::class,'logoutAllDevices']);
    ##############################################################
    Route::apiResource('tags_api',TagsController::class);
    ##############################################################
    Route::apiResource('blog_categories_api',BlogCategoriesController::class);
    Route::get('blog_categories_api/{id}/restore',[BlogCategoriesController::class,'restore']);
    ##############################################################
    Route::apiResource('comments_api',CommentsController::class);
    Route::get('comments_api/{comment}/activation',[CommentsController::class,'activation']);
    ##############################################################
    Route::apiResource('blogs_api',BlogsController::class);
    ##############################################################
    Route::apiResource('albums_api',AlbumsController::class);
    ##############################################################
    Route::get('photos_api/{photo}/activation',[PhotosController::class,'activation']);
    Route::apiResource('photos_api',PhotosController::class);
    ##############################################################
    Route::apiResource('courses_api',CoursesController::class);
    ##############################################################
    Route::apiResource('videos_api',VideosController::class);
    ##############################################################
    Route::apiResource('course/applicants_api',ApplicantsController::class);
    ##############################################################
    Route::apiResource('info_api',InformationController::class);
    ##############################################################
    Route::apiResource('vote_api',VoteController::class);
    Route::post('vote/answer/add/{vote}',[VoteController::class,'addAnswer']);
    ##############################################################
    Route::apiResource('contacts_api',ContactsController::class);
    ##############################################################
    Route::apiResource('mails_api',MailsController::class);
    ##############################################################
    Route::apiResource('media/members_api',MediaApplicantsController::class);
    ##############################################################
    Route::apiResource('partners_api',PartnersController::class);
    ##############################################################
    Route::apiResource('scouts_api',ScoutsController::class);
    ##############################################################
    Route::apiResource('volunteers_api',VolunteersController::class);
    ##############################################################
    Route::get('settings_api/restore/{id}',[SettingsController::class,'restore']);
    Route::apiResource('settings_api',SettingsController::class);
    ##############################################################
    Route::apiResource('sections_api',SectionsController::class);
    Route::get('sections_api/{id}/restore',[SectionsController::class,'restore']);
    ##############################################################
    Route::apiResource('site/images_api',SiteImagesController::class);
    ##############################################################
    Route::apiResource('site/links_api',SiteLinksController::class);
    ##############################################################
    Route::apiResource('site/contents_api',SiteContentsController::class);
});

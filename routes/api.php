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
    Route::apiResource('tags',TagsController::class);
    ##############################################################
    Route::apiResource('blogs/categories',BlogCategoriesController::class);
    ##############################################################
    Route::apiResource('comments',CommentsController::class);
    Route::get('comments/{comment}/activation',[CommentsController::class,'activation']);
    ##############################################################
    Route::apiResource('blogs',BlogsController::class);
    ##############################################################
    Route::apiResource('albums',AlbumsController::class);
    ##############################################################
    Route::get('photos/{photo}/activation',[PhotosController::class,'activation']);
    Route::apiResource('photos',PhotosController::class);
    ##############################################################
    Route::apiResource('courses',CoursesController::class);
    ##############################################################
    Route::apiResource('videos',VideosController::class);
    ##############################################################
    Route::apiResource('course/applicants',ApplicantsController::class);
    ##############################################################
    Route::apiResource('info',InformationController::class);
    ##############################################################
    Route::apiResource('vote',VoteController::class);
    Route::post('vote/answer/add/{vote}',[VoteController::class,'addAnswer']);
    ##############################################################
    Route::apiResource('contacts',ContactsController::class);
    ##############################################################
    Route::apiResource('mails',MailsController::class);
    ##############################################################
    Route::apiResource('media/applicants',MediaApplicantsController::class);
    ##############################################################
    Route::apiResource('partners',PartnersController::class);
    ##############################################################
    Route::apiResource('scouts',ScoutsController::class);
    ##############################################################
    Route::apiResource('volunteers',VolunteersController::class);
    ##############################################################
    Route::apiResource('settings',SettingsController::class);
    ##############################################################
    Route::apiResource('sections',SectionsController::class);
    ##############################################################
    Route::apiResource('site/images',SiteImagesController::class);
    ##############################################################
    Route::apiResource('site/links',SiteLinksController::class);
    ##############################################################
    Route::apiResource('site/contents',SiteContentsController::class);
});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home_page');

Route::get('home', function () {
	// return bcrypt('kittensdie2');
	
    return view('home');
});
Auth::routes(['verify' => true]);
Route::get('login/google', 'Auth\SocilMediaAuthController@redirectToProvider');
Route::get('login/google/callback', 'Auth\SocilMediaAuthController@handleProviderCallback');
Route::get('login/facebook', 'Auth\SocilMediaAuthController@redirectToFbProvider');
Route::get('login/facebook/callback', 'Auth\SocilMediaAuthController@handleFbProviderCallback');

//Pages Controller
Route::get('noknok/give-your-interview', 'PagesController@give_your_interview');
//End Pages Controller

// Route::get('/home', 'HomeController@index')->name('home');

//create interview Routes
Route::get('create-interview', 'QuestionController@index');
Route::post('api/create-interview', 'QuestionController@store');
Route::post('api/question/{id}', 'QuestionController@get_questions');
Route::post('create-interview/publish_interview/', 'QuestionController@publish_interview')->name('publish_interview');
//end create interview Routes

//Question & Answer - Full Interviews Routes
Route::get('{interview:slug}', 'InterviewController@show_interview_questions');
Route::post('save-interview', 'InterviewController@save_interview')->name('submit_interview');
Route::get('interview/{user}/{slug:slug}', 'InterviewController@show_full_interview');
//End Question & Answer - Full Interviews Routes

//Star answer
Route::post('star_answer/put_star', 'StarAnswersController@put_star');
Route::post('star_answer/remove_star', 'StarAnswersController@remove_star');
//End Star answer

// User Profile
Route::get('user/{user}', 'PagesController@user_profile')->middleware(['auth','verified']);

//End User Profile


//Branding Routes
Route::get('brand/create_profile', 'BrandController@create_profile')->middleware(['auth','verified']);
Route::post('brand/create', 'BrandController@store')->name('create_brand');
Route::get('brand/ask-on-question', 'BrandController@index');

Route::get('brand/{brand:slug}', 'BrandInterviewController@index');
Route::post('brand/ask_question', 'BrandInterviewController@ask_question');
Route::post('brand/answer_a_question', 'BrandInterviewController@answer');
Route::get('brand/{user}/{slug:slug}', 'BrandInterviewController@single_user_question');
//End Branding Routes

//Media House
Route::post('media_house/create', 'MediaHouseController@create')->name('create-media-house');
Route::post('media_house/update', 'MediaHouseController@update')->name('update-media-house');
//End Media House


//following
Route::post('user/follow', 'FollowerController@follow')->name('follow');
Route::post('user/unfollow', 'FollowerController@unfollow')->name('unfollow');
//end following

//Nok It
Route::post('nokit/create', 'NokItController@save')->name('nok-it');
//End Nok It


//Read all notifications
Route::get('notifications/markAsRead', function(){
	auth()->user()->unreadNotifications->markAsRead();
	return redirect()->back();
})->name('markRead');


//Route Any Unwanted Link
Route::any('{query}', 
  function() { return redirect('/'); })
  ->where('query', '.*');
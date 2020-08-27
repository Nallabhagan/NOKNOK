<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'PagesController@home_page');

Route::get('home', function () {
	// return bcrypt('kittensdie2');
	// Mail::to("nallapagan1997@gmail.com")->send(new QPartyInvitationMail());
	
	
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
Route::get('user/{user}', 'PagesController@user_profile');

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

//QParty Routes
Route::get('qparty/create_profile', 'QuestionPartyController@create_profile')->middleware(['auth','verified']);
Route::post('qparty/create', 'QuestionPartyController@store')->name('create_qparty');
Route::get('qparty/{qparty:slug}', 'QPartyInterviewController@index');

Route::post('qparty/ask_question', 'QPartyInterviewController@ask_question');
Route::post('qparty/answer_a_question', 'QPartyInterviewController@answer');
Route::get('qparty/{user}/{slug:slug}', 'QPartyInterviewController@single_user_question');

Route::get('qparty/accept/{user}/{token}', 'InviteController@qparty_process')->middleware(['auth','verified']);

//End QParty Routes
//Media House
Route::post('media_house/create', 'MediaHouseController@create')->name('create-media-house');
Route::post('media_house/update', 'MediaHouseController@update')->name('update-media-house');
//End Media House


//following
Route::post('user/follow', 'FollowerController@follow')->name('follow');
Route::post('user/unfollow', 'FollowerController@unfollow')->name('unfollow');
//end following

//Nok It
Route::group(['prefix' => 'nokit', 'middleware' => ['auth','verified']], function () {
    Route::post('create', 'NokItController@save')->name('nok-it');
    Route::post('delete', 'NokItController@delete')->name('delete');
    Route::post('like', 'NokIt\LikesController@like')->name('like');
    Route::post('comment', 'NokIt\CommentsController@save_comment')->name('comment');
});
Route::get('nokit/{nokit_id}', 'PagesController@shared_nokit');
//End Nok It

//Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','verified']], function () {
	
	//profile
    Route::get('profile', 'Dashboard\ProfileController@index');
    Route::post('profile/profile_pic', 'Dashboard\ProfileController@profile_pic')->name('change-profile-pic');
    Route::post('profile/profile_details', 'Dashboard\ProfileController@profile_details')->name('change-profile-details');
    Route::post('profile/social_links', 'Dashboard\ProfileController@social_links')->name('social_links');
    //end profile

    //interviews
    Route::get('interviews', 'Dashboard\InterviewController@index');
    //end interviews

    //Q Party
    Route::get('qparties', 'Dashboard\QPartyController@index');
    //End Q Party
});
//End Dashboard


//Read all notifications
Route::get('notifications/markAsRead', function(){
	auth()->user()->unreadNotifications->markAsRead();
	return redirect()->back();
})->name('markRead');


//Route Any Unwanted Link
Route::any('{query}', 
  function() { return redirect('/'); })
  ->where('query', '.*');
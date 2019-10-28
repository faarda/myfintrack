<?php

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

Route::get('/', function () {
	if(Auth::check()){
		return redirect('dashboard');
	}
    return view('landing');
});

Route::get('contact', 'GuestController@contactForm');
Route::post('contact', 'GuestController@contact')->name('contact');
Route::get('faq', function() {
    return view('faq');
});

Route::get('blog', function() {
    return view('blog');
});


Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::resource('spendings', 'SpendingsController');
Route::resource('earnings', 'EarningController');

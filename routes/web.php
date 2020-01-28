<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Team auth
Route::prefix('/team')->name('teams.')->namespace('Team')->group(function () {
    Route::namespace('Auth')->group(function () {
        // Register
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register');

        //Login
        // Route::get('/login', 'LoginController@showLoginForm')->name('login');
        // Route::post('/login', 'LoginController@login');
        // Route::post('/logout', 'LoginController@logout')->name('logout');

        // //Forgot Password
        // Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        // //Reset Password
        // Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        // Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    });
});

// Candidates
Route::group(['prefix' => '/candidates', 'name' => 'candidates.', 'namespace' => 'Team', 'middleware' => ['auth', 'team']], function () {
    Route::namespace('Candidate')->group(function () {
        Route::post('/{candidate}', 'CandidateController@store');
    });
});

Route::get('/home', 'HomeController@index')->name('home');

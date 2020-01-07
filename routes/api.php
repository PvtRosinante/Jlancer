<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'auth'], function (){ 
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'API\AuthController@login');
        Route::post('signup', 'API\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('getuser', 'API\AuthController@getUser');
    });
}); 

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/cv', 'CvController@insertcv');
    Route::post('/cv-update/contact/{id}', 'CvController@updatecontact');
    Route::post('/cv-update/award/{id}', 'CvController@updateaward');
    Route::post('/cv-update/other/{id}', 'CvController@updateother');
    Route::post('/cv-update/summary/{id}', 'CvController@updatesummary');
    Route::post('/cv-update/education/{id}', 'CvController@updateeducation');
    Route::post('/cv-update/experience/{id}', 'CvController@updateexperience');
    Route::post('/cv-update/project/{id}', 'CvController@updateproject');
    Route::delete('/cv-del/contact/{id}', 'CvController@delcontact');
    Route::delete('/cv-del/award/{id}', 'CvController@delaward');
    Route::delete('/cv-del/other/{id}', 'CvController@delother');
    Route::delete('/cv-del/summary/{id}', 'CvController@delsummary');
    Route::delete('/cv-del/education/{id}', 'CvController@deleducation');
    Route::delete('/cv-del/experience/{id}', 'CvController@delexperience');
    Route::delete('/cv-del/project/{id}', 'CvController@delproject');
});

Route::get('vacancy', 'VacancyController@index');
Route::post('vacancy', 'VacancyController@create');
Route::post('/vacancy-update/{id}', 'VacancyController@update');
Route::delete('/vacancy-del/{id}', 'VacancyController@delete');

Route::get('skill', 'SkillController@index');
Route::post('skill', 'SkillController@create');
Route::post('/skill-update/{id}', 'SkillController@update');
Route::delete('/skill-del/{id}', 'SkillController@delete');

Route::get('/cv', 'CvController@index');
Route::get('/cv/{id}', 'CvController@show');

Route::get('/profile', 'ProfileController@index');

Route::get('/home', 'HomepageController@index');

Route::get('/vacancyskill', 'SkillvacancyController@index');
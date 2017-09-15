<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('test/index', 'TestController@index');
//注册
Route::get('signup','Home\RegisterController@signup');
Route::post('register/checkMoblie','Home\RegisterController@checkMoblie');
Route::post('register/zhuce','Home\RegisterController@zhuce');
//登录
Route::get('login/tologin','Home\LoginController@tologin');
Route::post('login/insert','Home\LoginController@insert');
Route::post('login/checkCode', 'Home\loginController@checkCode');
Route::post('login/checkUser', 'Home\loginController@checkUser');
Route::get('login/threeLogin', 'Home\loginController@threeLogin');
Route::get('login/findThree', 'Home\loginController@findThree');
Route::get('login/openLogin', 'Home\loginController@openLogin');
Route::post('login/agreeThree', 'Home\loginController@agreeThree');

//图形验证码  手机验证码
Route::get('img/captcha/{tmp}', 'Home\ImgController@captcha');
Route::get('img/code', 'Home\ImgController@code');
Route::post('img/checkCode', 'Home\ImgController@checkCode');
Route::post('img/msgCode', 'Home\ImgController@msgCode');
Route::post('img/checkCap', 'Home\ImgController@checkCap');

Route::get('index/show','Home\IndexController@show');
//忘记密码
Route::get('forget/forget', 'Home\ForgetController@forget');
Route::post('forget/two', 'Home\ForgetController@two');
Route::get('forget/repwd', 'Home\ForgetController@repwd');
Route::post('forget/checkUser', 'Home\ForgetController@checkUser');
Route::post('forget/checkCaptcha', 'Home\ForgetController@checkCaptcha');
Route::get('forget/toEmail', 'Home\ForgetController@toEmail');
Route::get('forget/email', 'Home\ForgetController@email');
Route::post('forget/checkMsgCode', 'Home\ForgetController@checkMsgCode');
Route::post('forget/upd', 'Home\ForgetController@upd');
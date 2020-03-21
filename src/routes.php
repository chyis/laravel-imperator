<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/admin/test', function () {
    app('imperator')->printRunning();
});
// 管理后台地址解析
Route::group(['prefix' => 'admin', 'namespace'=>'Chyis\Imperator\Controllers'], function(){
//Route::group(['middleware' => ['admin']], function(){
    Route::get('login', 'LoginController@index')->name('admin.login');
    Route::post('login', 'LoginController@signin')->name('admin.signin');
    //首页看板
    Route::get('/index', 'IndexController@index')->name('admin.main');
    Route::get('/', 'IndexController@index')->name('admin.main');
    //资料修改
    Route::get('profile', 'UserController@edit')->name('admin.profile');
    Route::post('profile', 'UserController@update')->name('admin.profile.save');
    //密码修改
    Route::get('password', 'UserController@password')->name('admin.password');
    Route::post('password', 'UserController@setPass')->name('admin.password.save');
    //登出
    Route::get('logout', 'UserController@logout')->name('admin.logout');
    //内容管理
    Route::resource('news','NewsController', ['as'=>'admin']);
    //分类管理
    Route::resource('category','CategoryController', ['as'=>'admin']);
    Route::resource('advertise','AdvertiseController', ['as'=>'admin']);
    //
    Route::get('contact', 'ContactController@index')->name('admin.contact.index');
    Route::get('contact/{id}', 'ContactController@show')->name('admin.contact.show');
    Route::delete('contact/{id}', 'ContactController@show')->name('admin.contact.destroy');
    Route::post('reply', 'ContactController@reply')->name('admin.contact.reply');
    //字典
    Route::resource('dictionary','DictionaryController', ['as'=>'admin']);
    //菜单管理
    Route::resource('menu', 'MenuController', ['as'=>'admin']);
    //合作伙伴
    Route::resource('links', 'LinksController', ['as'=>'admin']);
    //关于我们
    Route::get('about', 'AboutController@edit')->name('admin.about.edit');
    Route::put('about', 'AboutController@update')->name('admin.about.update');
    //系统管理设置
    Route::get('setting','SettingController@index')->name('admin.setting');
    Route::get('setting-system','SettingController@system')->name('admin.setting-system');
    Route::get('setting-upload','SettingController@upload')->name('admin.setting-upload');
    Route::post('setting-save','SettingController@store')->name('admin.setting-save');
    Route::put('setting-update','SettingController@update')->name('admin.setting-update');
    //图片上传
    Route::get('upload','UploadController@upload')->name('admin.upload');
    Route::post('upload','UploadController@doupload')->name('admin.do-upload');
    //分组角色管理
    Route::resource('role', 'RoleController', ['as'=>'admin']);
    Route::resource('privilege', 'PrivilegeController', ['as'=>'admin']);
    Route::resource('manager', 'ManagerController', ['as'=>'admin']);
    //模板管理选择
    Route::resource('module', 'ModuleController', ['as'=>'admin']);
    Route::get('template', 'TemplateController@index')->name('admin.template');
});
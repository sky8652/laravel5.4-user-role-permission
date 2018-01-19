<?php
//登陆
Route::group(['namespace'=>'Admin'],function (){
    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login');
    Route::get('logout','LoginController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| 后台admin路由
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>['auth'],'prefix'=>'admin/','namespace'=>'Admin'],function (){

        Route::get('/','IndexController@index');

        //角色管理
        Route::group(['middleware'=>'can:role.index'],function (){
            //角色列表
            Route::get('role','RoleController@index')->name('role.index');
            //添加角色
            Route::get('role/create','RoleController@create')->name('role.create')->middleware('can:role.create');
            Route::post('role','RoleController@store')->name('role.store')->middleware('can:role.create');
            //编辑角色
            Route::get('role/{role}/edit','RoleController@edit')->name('role.edit')->middleware('can:role.edit');
            Route::put('role/{role}','RoleController@update')->name('role.update')->middleware('can:role.edit');
            //删除角色
            Route::delete('role/{role}','RoleController@destroy')->name('role.destroy')->middleware('can:role.destroy');
            //分配权限
            Route::get('role/{role}/permission','RoleController@assignPermission')->name('role.permission')->middleware('can:role.permission');
            Route::put('role/{role}/savePermission','RoleController@savePermission')->name('role.savePermission')->middleware('can:role.permission');
        });

        //用户管理
        Route::group(['middleware'=>'can:user.index'],function (){
            //用户列表
            Route::get('user','UserController@index')->name('user.index');
            //添加用户
            Route::get('user/create','UserController@create')->name('user.create')->middleware('can:user.create');
            Route::post('user','UserController@store')->name('user.store')->middleware('can:user.create');
            //编辑用户
            Route::get('user/{user}/edit','UserController@edit')->name('user.edit')->middleware('can:user.edit');
            Route::put('user/{user}','UserController@update')->name('user.update')->middleware('can:user.edit');
            //删除用户
            Route::delete('user/{user}','UserController@destroy')->name('user.destroy')->middleware('can:user.destroy');
            //分配角色
            Route::get('user/{user}/assignRole','UserController@assignRole')->name('user.role')->middleware('can:user.role');
            Route::put('user/{user}/saveRole','UserController@saveRole')->name('user.saveRole')->middleware('can:user.role');
        });

        //权限管理
        Route::group(['middleware'=>'can:permission.index'],function (){
            //权限列表
            Route::get('permission','PermissionController@index')->name('permission.index');
            //添加权限
            Route::get('permission/create','PermissionController@create')->name('permission.create')->middleware('can:permission.create');
            Route::post('permission','PermissionController@store')->name('permission.store')->middleware('can:permission.create');
            //编辑权限
            Route::get('permission/{permission}/edit','PermissionController@edit')->name('permission.edit')->middleware('can:permission.edit');
            Route::put('permission/{permission}','PermissionController@update')->name('permission.update')->middleware('can:permission.edit');
            //删除权限
            Route::delete('permission/{permission}','PermissionController@destroy')->name('permission.destroy')->middleware('can:permission.destroy');
        });

});

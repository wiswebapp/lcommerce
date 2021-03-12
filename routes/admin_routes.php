<?php

$routeResource = function ($url, $controllerName, $suffix) {
    Route::get($url, $controllerName . '@' . $suffix)->name('admin.' . $suffix);
    Route::get($url . '/create', $controllerName . '@create_' . $suffix)->name('admin.create_' . $suffix);
    Route::post($url . '/create', $controllerName . '@store_' . $suffix);
    Route::get($url . '/edit/{id}', $controllerName . '@edit_' . $suffix)->name('admin.edit_' . $suffix);
    Route::put($url . '/edit/{id}', $controllerName . '@update_' . $suffix);
    Route::delete($url . '/delete', $controllerName . '@destroy_' . $suffix)->name('admin.destroy_' . $suffix);;
};

Route::group(['prefix' => ADMIN_PATH], function() use ($routeResource) {

    Route::get('login', 'Auth\admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\admin\LoginController@login');
    Route::post('logout', 'Auth\admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware'=> 'auth:admin', 'namespace' => 'admin'],function () use ($routeResource) {
        
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::get('getDashboardUser', 'DashboardController@getUserData');

        $routeResource("roles", "RoleController", 'roles');
        $routeResource("admin", "AdminController", 'admin');
        $routeResource("category", "CategoryController", 'category');
        $routeResource("subcategory", "CategoryController", 'subcategory');
        $routeResource("product", "ProductController", 'product');
        $routeResource("user", "UserController", 'user');
        $routeResource("pages", "PagesController", 'pages');

        //Ajax Calls
        Route::post('product/getCat', 'CategoryController@get_ajax_category')->name('ajax.getCat');
        Route::post('product/getSubCat', 'CategoryController@get_ajax_subcategory')->name('ajax.getSubCat');
    });
});



?>
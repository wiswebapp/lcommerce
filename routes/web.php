<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

defined('ADMIN_PATH') or define('ADMIN_PATH', 'webadmin');
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
$routeResource = function ($url, $controllerName, $suffix) {
    Route::get($url, $controllerName . '@' . $suffix)->name('admin.' . $suffix);
    Route::get($url . '/create', $controllerName . '@create_' . $suffix)->name('admin.create_' . $suffix);
    Route::post($url . '/create', $controllerName . '@store_' . $suffix);
    Route::get($url . '/edit/{id}', $controllerName . '@edit_' . $suffix)->name('admin.edit_' . $suffix);
    Route::put($url . '/edit/{id}', $controllerName . '@update_' . $suffix);
    Route::delete($url . '/delete', $controllerName . '@destroy_' . $suffix)->name('admin.destroy_' . $suffix);;
};


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
/* for pages */
Route::get('/{page}', 'PageController')->name('page')->where('page', 'about|privacy|terms');
Route::get('/{slug}', 'ItemController@viewItem');

Route::get('create-permission',function(){
    $term = ['Role','Admin','User','Category','SubCategory','Product','Pages'];
    foreach ($term as $itemValue) {
        $name = 'Create '. $itemValue;
        $create = Permission::create(['name' => $name,'guard_name' => 'admin']);
        $name = 'View ' . $itemValue;
        Permission::create(['name' => $name,'guard_name' => 'admin']);
        $name = 'Edit ' . $itemValue;
        Permission::create(['name' => $name,'guard_name' => 'admin']);
        $name = 'Delete ' . $itemValue;
        Permission::create(['name' => $name,'guard_name' => 'admin']);
    }
});

/*--------------------Admin Panel--------------------*/
Route::get(ADMIN_PATH, 'Auth\admin\LoginController@showLoginForm');

Route::prefix(ADMIN_PATH)->group(function () {
    Route::get('login', 'Auth\admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\admin\LoginController@login');
    Route::post('logout', 'Auth\admin\LoginController@logout')->name('admin.logout');
});

Route::prefix(ADMIN_PATH)->middleware(['auth:admin'])->namespace('admin')->group(function() use($routeResource){
    
    //For Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('getDashboardUser', 'DashboardController@getUserData');

    //Admin Roles
    $routeResource("roles", "RoleController", 'roles');
    //Admin Users
    $routeResource("admin", "AdminController", 'admin');
    //Category
    $routeResource("category", "CategoryController",'category');
    //SubCategory
    $routeResource("subcategory", "CategoryController",'subcategory');
    //Product
    $routeResource("product", "ProductController",'product');
    //Register Users
    $routeResource("user", "UserController",'user');
    //CMS Pages
    $routeResource("pages", "PagesController", 'pages');

    //Common (Ajax)
    Route::post('product/getCat', 'CategoryController@get_ajax_category')->name('ajax.getCat');
    Route::post('product/getSubCat', 'CategoryController@get_ajax_subcategory')->name('ajax.getSubCat');
    
});

?>
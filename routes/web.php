<?php

use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
/* for pages */
Route::get('/{page}', 'PageController')
->name('page')
->where('page', 'about|privacy|terms');
// Route::get('about', 'PageController@about')->name('about');
// Route::get('terms', 'PageController@terms')->name('terms');
// Route::get('privacy', 'PageController@privacy')->name('privacy');

/*--------------------Admin Panel--------------------*/
Route::get(ADMIN_PATH, 'Auth\admin\LoginController@showLoginForm');

Route::prefix(ADMIN_PATH)->group(function () {
    Route::get('login', 'Auth\admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\admin\LoginController@login');
    Route::post('logout','Auth\admin\LoginController@logout')->name('admin.logout');
});

$routeResource = function ($url, $controllerName, $suffix) {
    Route::get($url, $controllerName . '@' . $suffix)->name('admin.' . $suffix);
    Route::get($url . '/create', $controllerName . '@create_' . $suffix)->name('admin.create_' . $suffix);
    Route::post($url . '/create', $controllerName . '@store_' . $suffix);
    Route::get($url . '/edit/{id}', $controllerName . '@edit_' . $suffix)->name('admin.edit_' . $suffix);
    Route::post($url . '/edit/{id}', $controllerName . '@update_' . $suffix);
    Route::post($url . '/delete', $controllerName . '@destroy_' . $suffix)->name('admin.destroy_' . $suffix);;
};

Route::prefix(ADMIN_PATH)->middleware(['auth:admin'])->namespace('admin')->group(function() use($routeResource){
    Route::get('dashboard','DashboardController@index')->name('admin.dashboard');
    //Common (Ajax)
    Route::post('product/getCat', 'CategoryController@get_ajax_category')->name('ajax.getCat');
    Route::post('product/getSubCat', 'CategoryController@get_ajax_subcategory')->name('ajax.getSubCat');
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
});

?>
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
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
/* for pages */
Route::get('/{page}', 'PageController')->name('page')->where('page', 'about|privacy|terms');
Route::get('/{slug}', 'ItemController@viewItem');

require('permission_route.php');
require('admin_routes.php');

?>
<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['userCount'] = User::all()->whereNull('deleted_at')->count();
        $data['productCount'] = Product::all()->whereNull('deleted_at')->count();
        $data['categoryCount'] = Category::all()->where('parent_id',0)->whereNull('deleted_at')->count();
        $data['subCategoryCount'] = Category::all()->where('parent_id','!=',0)->whereNull('deleted_at')->count();
        return view('admin.dashboard')->with('data',$data);
    }
}

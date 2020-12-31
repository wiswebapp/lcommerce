<?php
namespace App\Http\Controllers;

use App\Category;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['categoryList'] = Category::where('parent_id',0)->orderBy('id', 'desc')->take(10)->get();
        $data['productList'] = Product::orderBy('id','desc')->take(10)->get();

        return view('index')->with('data',$data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function viewItem($slug){
        $data['product'] = Product::where('product_slug',$slug)->first();
        if(empty($data['product'])){
            return redirect('/?err=item-not-found');
        }
        return view('item.view')->with('data', $data);
    }
}

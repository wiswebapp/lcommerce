<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{    
    public function product(){
        abort_unless($this->checkPermission('View Product'), 403);
        $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : "";
        $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : "";
        $query = Product::whereNull('deleted_at')->orderBy('id', 'desc');
        if(!empty($name)){
            $query->where('product_name','LIKE','%'.$name.'%');
        }
        if(!empty($status)){
            $query->where('status',$status);
        }
        $product = $query->paginate(10);
        $data['pageData'] = $product;
        $data['pageTitle'] = "Product";
        return view('admin.product.index')->with('data',$data);
    }

    public function create_product(){
        abort_unless($this->checkPermission('Create Product'), 403);
        $data['action'] = "Add";        
        $data['pageTitle'] = "Add Product";
        $data['pageData']['category'] = Builder::getCategoryData();
        return view('admin.product.product_action')->with('data',$data);
    }
    
    public function store_product(Request $request){
        abort_unless($this->checkPermission('Create Product'), 403);
        $validated = $request->validate([
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'price' => 'required|integer',
            'status' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //Uploading Image
        if ($request->hasFile('product_image')) {
            $extension = $request->file('product_image')->extension();
            $newFileName = "PRODUCT_".time().".".$extension;
            $uploadPath = '/public/product/';
            if(!Storage::exists($uploadPath)){
                Storage::makeDirectory($uploadPath);
            }
            $request->file('product_image')->storeAs($uploadPath,$newFileName);
        }else{
            $newFileName = "";
        }

        $Product = new Product();
        $input = $request->all();
        $input['product_image'] = $newFileName;
        $Product::Create($input);
        return redirect()->route('admin.product')->with('success','Data Updated Successfuly');
    }
    
    public function edit_product($id){
        abort_unless($this->checkPermission('Edit Product'), 403);
        $data['action'] = "Edit";
        $data['pageData'] = Product::find($id);
        $data['pageTitle'] = "Edit Product";
        $data['pageData']['category'] = Builder::getCategoryData();
        return view('admin.product.product_action')->with('data',$data);
    }
    
    public function update_product($id, Request $request){
        abort_unless($this->checkPermission('Edit Product'), 403);
        $validated = $request->validate([
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'product_name' => 'required|max:255',
            'product_description' => 'required|max:255',
            'price' => 'required|integer',
            'status' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $Product = Product::find($id);
        //Uploading Image
        if ($request->hasFile('product_image')) {
            //--------------Method1--------------
            //$path = $request->file('product_image')->store('/public/productimg');
            //--------------Method2--------------
            $extension = $request->file('product_image')->extension();
            $newFileName = "PRODUCT_".time().".".$extension;
            $uploadPath = '/public/product/';
            if(!Storage::exists($uploadPath)){
                Storage::makeDirectory($uploadPath);
            }
            if(Storage::exists($uploadPath.$Product->product_image)) {
                Storage::delete($uploadPath.$Product->product_image);
            }
            $request->file('product_image')->storeAs($uploadPath,$newFileName);
        }else{
            $newFileName = $Product->product_image;
        }
        $input = $request->all();
        $input['product_image'] = $newFileName;        
        $Product->fill($input)->save();
        return redirect()->route('admin.product')->with('success','Data Updated Successfuly');
    }
    
    public function destroy_product( Request $request){
        abort_unless($this->checkPermission('Delete Product'), 403);
        $product = Product::find($request->dataId);
        $product->delete();
        echo 1;
    }

}

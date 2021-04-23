<?php
namespace App\Http\Controllers\admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{    
    public function product(Request $request){
        abort_unless($this->checkPermission('View Product'), 403);
        $query = Product::whereNull('deleted_at')->orderBy('id', 'desc');
        if(!empty($request->input('name'))){
            $query->where('product_name','LIKE','%'. $request->input('name').'%');
        }
        if(!empty($request->input('status'))){
            $query->where('status', $request->input('status'));
        }
        $data['pageData'] = $query->paginate(10);
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
    
    public function store_product(CreateProduct $request){
        abort_unless($this->checkPermission('Create Product'), 403);
        
        $newFileName = "";
        if ($request->hasFile('product_image')) {
            $extension = $request->file('product_image')->extension();
            $newFileName = "PRODUCT_".time().".".$extension;
            $uploadPath = '/public/product/';
            if(!Storage::exists($uploadPath)){
                Storage::makeDirectory($uploadPath);
            }
            $request->file('product_image')->storeAs($uploadPath,$newFileName);
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
    
    public function update_product($id, CreateProduct $request){
        abort_unless($this->checkPermission('Edit Product'), 403);
        $Product = Product::find($id);
        $newFileName = $Product->product_image;
        
        if ($request->hasFile('product_image')) {
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
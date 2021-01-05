<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        abort_unless($this->checkPermission('View Category'), 403);
        $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : "";
        $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : "";

        $query = Category::where([['parent_id','=',0]])->orderBy('id', 'desc');
        
        if(!empty($name)){
            $query->where('category_name','LIKE','%'.$name.'%');
        }
        if(!empty($status)){
            $query->where('status',$status);
        }
        $category = $query->paginate(10);
        $data['pageData'] = $category;
        $data['pageTitle'] = "Category";
        
        return view('admin.category.index')->with('data',$data);
    }

    public function create_category(){
        abort_unless($this->checkPermission('Create Category'), 403);
        $data['pageTitle'] = "Add Category";
        $data['action'] = "Add";
        return view('admin.category.category_action')->with('data',$data);
    }
    
    public function store_category(Request $request){
        abort_unless($this->checkPermission('Create Category'), 403);
        $validated = $request->validate([
            'category_name' => 'required|max:255',
            'status' => 'required',
        ]);
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->status = $request->input('status');
        $category->save();
        return redirect()->route('admin.category')->with('success','Data Inserted Successfuly');
    }

    public function edit_category($id){
        abort_unless($this->checkPermission('Edit Category'), 403);
        $dataCategory = Category::find($id);
        $data['pageTitle'] = "Edit Category";
        $data['action'] = "Edit";
        $data['pageData'] = $dataCategory;
        return view('admin.category.category_action')->with('data',$data);
    }

    public function update_category($id,Request $request){
        abort_unless($this->checkPermission('Edit Category'), 403);
        $validated = $request->validate([
            'category_name' => 'required|max:255',
            'status' => 'required',
        ]);
        $category = Category::find($id);
        $category->category_name = $request->input('category_name');
        $category->status = $request->input('status');
        $category->save();
        return redirect()->route('admin.category')->with('success','Data Updated Successfuly');
    }

    public function destroy_category(Request $request){
        abort_unless($this->checkPermission('Delete Category'), 403);
        $category = Category::find($request->dataId);
        $category->children()->delete();
        $category->products()->delete();
        $category->delete();
        echo 1;
    }
    
    public function subcategory(){
        abort_unless($this->checkPermission('View SubCategory'), 403);
        $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : "";
        $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : "";

        $query = Category::where([['parent_id','!=',0]])->orderBy('id', 'desc');
        
        if(!empty($name)){
            $query->where('category_name','LIKE','%'.$name.'%');
        }
        if(!empty($status)){
            $query->where('status',$status);
        }
        $subcategory = $query->paginate(10);
        $data['pageData'] = $subcategory;
        $data['pageTitle'] = "Sub Category";
        
        return view('admin.category.subcategory')->with('data',$data);
    }
    public function create_subcategory(){
        abort_unless($this->checkPermission('Create SubCategory'), 403);
        $data['pageTitle'] = "Add SubCategory";
        $data['action'] = "Add";
        $data['pageData']['category'] = Category::where([['parent_id','=',0]])->orderBy('id', 'desc')->get();
        return view('admin.category.subcategory_action')->with('data',$data);
    }
    public function store_subcategory(Request $request){
        abort_unless($this->checkPermission('Create SubCategory'), 403);
        $validated = $request->validate([
            'parent_id' => 'required|integer',
            'category_name' => 'required|max:255',
            'status' => 'required',
        ]);
        $category = new Category();
        $input = $request->all();
        $category::create($input);
        return redirect()->route('admin.subcategory')->with('success','Data Added Successfuly');
    }
    public function edit_subcategory($id,Request $request){
        abort_unless($this->checkPermission('Edit SubCategory'), 403);
        $dataCategory = Category::find($id);
        $data['pageTitle'] = "Edit SubCategory";
        $data['action'] = "Edit";
        $data['pageData'] = $dataCategory;
        $data['pageData']['category'] = Category::where([['parent_id','=',0]])->orderBy('id', 'desc')->get();
        return view('admin.category.subcategory_action')->with('data',$data);
    }
    public function update_subcategory($id,Request $request){
        abort_unless($this->checkPermission('Edit SubCategory'), 403);
        $validated = $request->validate([
            'parent_id' => 'required|integer',
            'category_name' => 'required|max:255',
            'status' => 'required',
        ]);
        $category = Category::find($id);
        $input = $request->all();
        $category->fill($input)->save();
        return redirect()->route('admin.subcategory')->with('success','Data Updated Successfuly');
    }
    public function destroy_subcategory(Request $request){
        abort_unless($this->checkPermission('Delete SubCategory'), 403);
        $category = Category::find($request->dataId);
        $category->delete();
        echo 1;
    }

    public function get_ajax_category(Request $request){
        abort_unless($this->checkPermission('View Category'), 403);
        $selectedId = $request->input('selectedId');
        $catData = Builder::getCategoryData();
        if( $catData->count() > 0){
            $CatData="";
            foreach($catData as $catData){
                $selected = ($selectedId == $catData->id) ? "selected" : "";
                $CatData .= "<option value='".$catData->id."' $selected>".$catData->category_name."</option>";
            }
        }
        return response()->json(['success' => true, 'subCatData' => $CatData]);
    }
    public function get_ajax_subcategory(Request $request){
        abort_unless($this->checkPermission('View SubCategory'), 403);
        $categoryId = $request->input('categoryId');
        $selectedId = $request->input('selectedId');        
        $subCat = Builder::getSubCategoryData('*',['status'=>'Active','parent_id'=>$categoryId]);
        $subCatData="";
        if( $subCat->count() > 0){
            foreach($subCat as $catData){
                $selected = ($selectedId == $catData->id) ? "selected" : "";
                $subCatData .= "<option value='".$catData->id."' $selected>".$catData->category_name."</option>";
            }
        }else{
            $subCatData .= "<option value=''>Select Category</option>";
        }
        return response()->json(['success' => true, 'subCatData' => $subCatData]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\CreateSubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(Request $request){
        abort_unless($this->checkPermission('View Category'), 403);
        $query = Category::where([['parent_id','=',0]])->orderBy('id', 'desc');
        if(!empty($request->input('name'))){
            $query->where('category_name','LIKE','%'. $request->input('name') .'%');
        }
        if(!empty($request->input('status'))){
            $query->where('status', $request->input('status'));
        }
        $data['pageData'] = $query->paginate(10);
        $data['pageTitle'] = "Category";
        return view('admin.category.index')->with('data',$data);
    }

    public function create_category(){
        abort_unless($this->checkPermission('Create Category'), 403);
        $data['pageTitle'] = "Add Category";
        $data['action'] = "Add";
        return view('admin.category.category_action')->with('data',$data);
    }
    
    public function store_category(CreateCategory $request){
        abort_unless($this->checkPermission('Create Category'), 403);
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->status = $request->input('status');
        $category->save();
        return redirect()->route('admin.category')->with('success','Data Inserted Successfuly');
    }

    public function edit_category($id){
        abort_unless($this->checkPermission('Edit Category'), 403);
        $data['pageTitle'] = "Edit Category";
        $data['action'] = "Edit";
        $data['pageData'] = Category::find($id);
        return view('admin.category.category_action')->with('data',$data);
    }

    public function update_category($id, CreateCategory $request){
        abort_unless($this->checkPermission('Edit Category'), 403);
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
    
    public function subcategory(Request $request){
        abort_unless($this->checkPermission('View SubCategory'), 403);
        $query = Category::where([['parent_id','!=',0]])->orderBy('id', 'desc');
        if(!empty($request->input('name'))){
            $query->where('category_name','LIKE','%'. $request->input('name').'%');
        }
        if(!empty($request->input('status'))){
            $query->where('status', $request->input('status'));
        }
        $data['pageData'] = $query->paginate(10);
        $data['pageTitle'] = "Sub Category";   
        return view('admin.category.subcategory')->with('data',$data);
    }
    public function create_subcategory(){
        abort_unless($this->checkPermission('Create SubCategory'), 403);
        $data['pageTitle'] = "Add SubCategory";
        $data['action'] = "Add";
        $data['pageData']['category'] = Category::where(['status' => 'Active', ['parent_id','=',0]])->orderBy('id', 'desc')->get();
        return view('admin.category.subcategory_action')->with('data',$data);
    }
    public function store_subcategory(CreateSubCategory $request){
        abort_unless($this->checkPermission('Create SubCategory'), 403);
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
    public function update_subcategory($id, CreateSubCategory $request){
        abort_unless($this->checkPermission('Edit SubCategory'), 403);
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
        $subCat = Builder::getSubCategoryData('*',['status'=>'Active','parent_id'=> $request->input('categoryId')]);
        $subCatData="";
        if( $subCat->count() > 0){
            foreach($subCat as $catData){
                $selected = ($request->input('selectedId') == $catData->id) ? "selected" : "";
                $subCatData .= "<option value='".$catData->id."' $selected>".$catData->category_name."</option>";
            }
        }else{
            $subCatData .= "<option value=''>Select Category</option>";
        }
        return response()->json(['success' => true, 'subCatData' => $subCatData]);
    }
}

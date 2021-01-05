<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function pages()
    {
        abort_unless($this->checkPermission('View Pages'), 403);
        $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : "";
        $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : "";
        $query = Pages::orderBy('id', 'desc');
        if (!empty($name)) {
            $query->where('page_title', 'LIKE', '%' . $name . '%');
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }
        $pagesdata = $query->paginate(10);
        $data['pageData'] = $pagesdata;
        $data['pageTitle'] = "Pages";
        return view('admin.pages.index')->with('data', $data);
    }

    public function create_pages()
    {
        abort_unless($this->checkPermission('Create Pages'), 403);
        $data['action'] = "Add";
        $data['pageTitle'] = "Add Pages";
        return view('admin.pages.pages_action')->with('data', $data);
    }

    public function store_pages (Request $request)
    {
        abort_unless($this->checkPermission('Create Pages'), 403);
       $validated = $request->validate([
            'page_title' => 'required',
            'page_description' => 'required',
            'page_meta_keyword' => 'required',
            'page_meta_description' => 'required',
            'status' => 'required',
        ]);
        //Uploading Image
        if ($request->hasFile('page_image')) {
            $extension = $request->file('page_image')->extension();
            $newFileName = "PAGES_".time().".".$extension;
            $uploadPath = '/public/pages/';
            if(!Storage::exists($uploadPath)){
                Storage::makeDirectory($uploadPath);
            }
            $request->file('page_image')->storeAs($uploadPath,$newFileName);
        }else{
            $newFileName = "";
        }

        $Pages = new Pages();
        $input = $request->all();
        $input['page_image'] = $newFileName;
        $Pages::Create($input);
        return redirect()->route('admin.pages')->with('success','Data Added Successfuly');
    }

    public function edit_pages($id)
    {
        abort_unless($this->checkPermission('Edit Pages'), 403);
        $data['action'] = "Edit";
        $data['pageData'] = Pages::find($id);
        $data['pageTitle'] = "Edit Pages";
        return view('admin.pages.pages_action')->with('data', $data);
    }

    public function update_pages($id, Request $request)
    {
        abort_unless($this->checkPermission('Edit Pages'), 403);
        $validated = $request->validate([
            'page_title' => 'required',
            'page_description' => 'required',
            'page_meta_keyword' => 'required',
            'page_meta_description' => 'required',
            'status' => 'required',
        ]);
        $pages = Pages::find($id);
        //Uploading Image
        if ($request->hasFile('page_image')) {
            $extension = $request->file('page_image')->extension();
            $newFileName = "PAGES_" . time() . "." . $extension;
            $uploadPath = '/public/pages/';
            if (!Storage::exists($uploadPath)) {
                Storage::makeDirectory($uploadPath);
            }
            if (Storage::exists($uploadPath . $pages->page_image)) {
                Storage::delete($uploadPath . $pages->page_image);
            }
            $request->file('page_image')->storeAs($uploadPath, $newFileName);
        } else {
            $newFileName = $pages->page_image;
        }

        $input = $request->all();
        $input['page_image'] = $newFileName;
        $pages->fill($input)->save();
        return redirect()->route('admin.pages')->with('success', 'Data Updated Successfuly');
    }
    
}

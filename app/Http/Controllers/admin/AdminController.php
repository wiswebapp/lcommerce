<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin()
    {
        abort_unless($this->checkPermission('View Admin'), 403);
        $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : "";
        $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : "";
        $query = Admin::orderBy('id', 'desc');
        if (!empty($name)) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }
        $pagesdata = $query->paginate(10);
        $data['pageData'] = $pagesdata;
        $data['pageTitle'] = "Admin Users";
        return view('admin.user.admin')->with('data', $data);
    }

    public function create_admin()
    {
        abort_unless($this->checkPermission('Create Admin'), 403);
        $data['action'] = "Add";
        $data['pageTitle'] = "Add Pages";
        $data['roleList'] = Role::all();
        return view('admin.user.admin_action')->with('data', $data);
    }

    public function store_admin(Request $request)
    {
        abort_unless($this->checkPermission('Create Admin'), 403);
        $request->validate([
            'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => [
                'required', Rule::unique('admin', 'email'), 'email:rfc'
            ],
            'status' => 'required',
        ]);
        //Uploading Image
        if ($request->hasFile('page_image')) {
            $extension = $request->file('page_image')->extension();
            $newFileName = "PAGES_" . time() . "." . $extension;
            $uploadPath = '/public/user/';
            if (!Storage::exists($uploadPath)) {
                Storage::makeDirectory($uploadPath);
            }
            $request->file('page_image')->storeAs($uploadPath, $newFileName);
        } else {
            $newFileName = "";
        }

        $Admin = new Admin();
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $ROLE_OF_ADMIN = $input['role'];
        unset($input['role']);
        $input['page_image'] = $newFileName;
        $user = $Admin::Create($input);
        $user->assignRole($ROLE_OF_ADMIN);
        return redirect()->route('admin.admin')->with('success', 'Data Added Successfuly');
    }

    public function edit_admin($id)
    {
        abort_unless($this->checkPermission('Edit Admin'), 403);
        $data['action'] = "Edit";
        $data['pageData'] = Admin::find($id);
        $data['pageTitle'] = "Edit Admin";
        $data['RollName'] = $data['pageData']->getRoleNames()->toArray()[0];
        $data['roleList'] = Role::all();
        return view('admin.user.admin_action')->with('data', $data);
    }

    public function update_admin($id, Request $request)
    {
        abort_unless($this->checkPermission('Edit Admin'), 403);
        $request->validate([
            'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => [
                'required', Rule::unique('admin', 'email')->ignore($id), 'email:rfc'
            ],
            'status' => 'required',
        ]);
        $AdminUser = Admin::find($id);
        //Uploading Image
        if ($request->hasFile('page_image')) {
            $extension = $request->file('page_image')->extension();
            $newFileName = "PAGES_" . time() . "." . $extension;
            $uploadPath = '/public/user/';
            if (!Storage::exists($uploadPath)) {
                Storage::makeDirectory($uploadPath);
            }
            if (Storage::exists($uploadPath . $AdminUser->page_image)) {
                Storage::delete($uploadPath . $AdminUser->page_image);
            }
            $request->file('page_image')->storeAs($uploadPath, $newFileName);
        } else {
            $newFileName = $AdminUser->page_image;
        }
        
        $input = $request->all();
        if ($input['password'] == null) {
            unset($input['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }
        $ROLE_OF_ADMIN = $input['role'];
        unset($input['role']);
        $AdminUser->fill($input)->save();
        $AdminUser->syncRoles($ROLE_OF_ADMIN);
        return redirect()->route('admin.admin')->with('success', 'Data Updated Successfuly');
    }
}

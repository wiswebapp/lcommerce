<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function roles(){
        abort_unless($this->checkPermission('View Role'), 403);
        $data['pageTitle'] = "Admin Roles";
        $data['pageData'] = Role::with('permissions')->get();
        return view('admin.roles.roles')->with('data', $data);
    }

    public function create_roles(){
        abort_unless($this->checkPermission('Create Role'), 403);
        $data['action'] = "Add";
        $data['pageTitle'] = "Add Admin Roles";
        $data['permission'] = Permission::all();
        return view('admin.roles.roles_action')->with('data', $data);
    }

    public function store_roles(Request $request){
        abort_unless($this->checkPermission('Create Role'), 403);
        $role = Role::create(['name' => $request->input('role_name')]);
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route('admin.roles')->with('success', 'Data Added Successfuly');
    }

    public function edit_roles($id){
        abort_unless($this->checkPermission('Edit Role'), 403);
        $data['pageTitle'] = "Edit Permission";
        $data['action'] = "Edit";
        $data['pageData'] = Role::where('id', $id)->with('permissions')->get();
        $data['permission'] = Permission::all();
        return view('admin.roles.roles_action')->with('data', $data);
    }

    public function update_roles($id, Request $request){
        abort_unless($this->checkPermission('Edit Role'), 403);
        $request->validate([
            'role_name' => 'required|max:255',
        ]);
        $roleData = Role::find($id);
        $roleData->name = $request->input('role_name');
        $roleData->syncPermissions($request->input('permissions'));
        return redirect()->route('admin.roles')->with('success', 'Data Updated Successfuly');
    }

    public function destroy_roles(){
        abort_unless($this->checkPermission('Delete Role'), 403);
    }
}
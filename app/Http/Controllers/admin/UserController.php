<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user(){
        $name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : "";
        $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : "";
        $query = User::whereNull('deleted_at')->orderBy('id', 'desc');
        if(!empty($name)){
            $query->where('fname','LIKE','%'.$name.'%');
            $query->orWhere('lname','LIKE','%'.$name.'%');
        }
        if(!empty($status)){
            $query->where('status',$status);
        }
        $product = $query->paginate(10);
        $data['pageData'] = $product;
        $data['pageTitle'] = "Register Users";
        return view('admin.user.users')->with('data',$data);
    }
    public function create_user(Request $request){
        $data['action'] = "Add";
        $data['pageTitle'] = "Add Register User";
        return view('admin.user.users_action')->with('data',$data);
    }
    public function store_user(UserStoreRequest $request){
        $user = new User();
        $input = $request->all();
        if($input['password'] == null){
            unset($input['password']);
        }else{
            $input['password'] = Hash::make($input['password']);
        }
        $user->fill($input)->save();
        return redirect()->route('admin.user')->with('success','Data Updated Successfuly');
    }
    public function edit_user($id){
        $data['action'] = "Edit";
        $data['pageData'] = User::find($id);
        $data['pageTitle'] = "Edit Register User";
        return view('admin.user.users_action')->with('data',$data);
    }
    public function update_user(UserStoreRequest $request,$id){
        $user = User::find($id);
        $input = $request->all();
        if($input['password'] == null){
            unset($input['password']);
        }else{
            $input['password'] = Hash::make($input['password']);
        }
        $user->fill($input)->save();
        return redirect()->route('admin.user')->with('success','Data Updated Successfuly');
    }
    public function destroy_user(Request $request){
        # code...
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $myPermissions;

    public function userPermissions(){
        return $this->myPermissions = Auth::user()->getAllPermissions()->pluck('name')->toArray();
    }

    public function checkPermission( $permissionName )
    {
        if(in_array($permissionName, $this->userPermissions()) ){
            return true;
        }
    }

}

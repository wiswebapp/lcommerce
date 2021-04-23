<?php

namespace App\Http\Controllers\MyClass;

trait GeneralClass
{
    public function filterData($filterType, $request, $query){
        switch ($filterType) {
            case 'Admin':
                if (!empty($request->name)) {
                    $query->where('name', 'LIKE', '%' . $request->name . '%');
                }
                if (!empty($request->status)) {
                    $query->where('status', $request->status);
                }
                break;
        }
        return $query;
    }
}
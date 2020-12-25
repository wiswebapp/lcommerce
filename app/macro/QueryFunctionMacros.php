<?php

namespace App\macro;

use App\Category;

class QueryFunctionMacros{

    
    public function getCategoryData(){
        return function ($fieldName='*',$where = ['status'=>'Active'], $orderBy='id',$desc = 'desc'){    

            $query = Category::select($fieldName);
            $query->where('parent_id',0);
            $query->where($where);
            $query->whereNull('deleted_at');
            $data = $query->orderBy($orderBy, $desc)->get();
            
            return $data;
        };
    }
    public function getSubCategoryData(){

        return function ($fieldName='*',$where = ['status'=>'Active'], $orderBy='id',$desc = 'desc'){    
            $query = Category::select($fieldName);
            $query->where('parent_id','!=',0);
            $query->where($where);
            $query->whereNull('deleted_at');
            $data = $query->orderBy($orderBy, $desc)->get();
            
            return $data;
        };

    }

}
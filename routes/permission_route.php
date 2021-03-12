<?php

Route::get('create-permission',function(){
    $term = ['Role','Admin','User','Category','SubCategory','Product','Pages'];
    foreach ($term as $itemValue) {
        $name = 'Create '. $itemValue;
        $create = Permission::create(['name' => $name,'guard_name' => 'admin']);
        $name = 'View ' . $itemValue;
        Permission::create(['name' => $name,'guard_name' => 'admin']);
        $name = 'Edit ' . $itemValue;
        Permission::create(['name' => $name,'guard_name' => 'admin']);
        $name = 'Delete ' . $itemValue;
        Permission::create(['name' => $name,'guard_name' => 'admin']);
    }
});

?>
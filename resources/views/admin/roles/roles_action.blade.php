<?php
  $pageData = "";
  $action = $data['action'];
  if($action == "Edit"){
    $pageData = $data['pageData'];
    $pageData  = $pageData[0];
  }
?>

@extends('admin.layouts.app_admin')

@section('title',$data['pageTitle'])

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$data['pageTitle']}}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('includes.alert_msg')
                    <div class="card">
                        @if ($action == "Edit")
                        {{Form::open(['action' => ['admin\RoleController@update_roles',$pageData->id],'method'=>'post','enctype'=>'multipart/form-data'])}}
                        @else
                        {{Form::open(['action' => ['admin\RoleController@store_roles'],'method'=>'post','enctype'=>'multipart/form-data'])}}
                        @endif
                        <div class="card-body">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Role Name</label>
                                    <input type="text" name="role_name"
                                        value="{{old('role_name',$pageData->name)}}"
                                        class="form-control {{ $errors->has('role_name') ? 'is-invalid' : '' }}"
                                        placeholder="Enter Role Name">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Roles</label>
                                    <select name="permissions[]" id="" class="form-control select2" multiple>
                                        <?php $i = 0;?>
                                        @foreach ($data['permission'] as $item)
                                        <?php
                                            $selected = "";
                                            if($action == "Edit"){
                                                $rolePermissions = $pageData->permissions->pluck('id')->toArray();
                                                if( in_array($item->id, $rolePermissions)){
                                                    $selected = "selected";
                                                }
                                            }
                                        ?>
                                            <option <?=$selected?> value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{$data['action']}} Data</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
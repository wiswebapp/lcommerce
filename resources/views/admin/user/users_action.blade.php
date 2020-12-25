<?php
  $pageData = "";
  $action = $data['action'];
  if($action == "Edit"){
    $pageData = $data['pageData'];   
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
                {{Form::open(['action' => ['admin\UserController@update_user',$pageData->id],'method'=>'post','enctype'=>'multipart/form-data'])}}
            @else
              {{Form::open(['action' => ['admin\UserController@store_user'],'method'=>'post','enctype'=>'multipart/form-data'])}}
            @endif
              <div class="card-body">
                       
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" value="{{old('fname',$pageData->fname)}}" class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" placeholder="Enter First Name">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" value="{{old('lname',$pageData->lname)}}" class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" name="email" value="{{old('email',$pageData->email)}}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email Address">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" name="phone" value="{{old('phone',$pageData->phone)}}" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="Enter Mobile Number">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter Password">
                        </div>
                    </div>
                  
                    <div class="col-md-8">
                        <div class="form-group">
                        <label>Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" <?=($action == "Add") ? "checked" : ""?> value='Active' <?=($pageData->status == 'Active') ? "checked" : ""?>>
                            <label class="form-check-label">Active</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="form-check-input" type="radio" name="status" value='InActive' <?=($pageData->status == 'InActive') ? "checked" : ""?>>
                            <label class="form-check-label">InActive</label>
                        </div>
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
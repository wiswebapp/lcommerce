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
                {{Form::open(['action' => ['admin\PagesController@update_pages',$pageData->id],'method'=>'post','enctype'=>'multipart/form-data'])}}
            @else
              {{Form::open(['action' => ['admin\PagesController@store_pages'],'method'=>'post','enctype'=>'multipart/form-data'])}}
            @endif
              <div class="card-body">
                  <div class="col-md-8">
                      <div class="form-group">
                          <label>Pages Name</label>
                          <input type="text" name="page_title" value="{{old('page_title',$pageData->page_title)}}" class="form-control {{ $errors->has('page_title') ? 'is-invalid' : '' }}" placeholder="Enter Page Name">
                      </div>
                  </div>

                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Pages Meta Keyword</label>
                      <input type="text" name="page_meta_keyword" value="{{old('page_meta_keyword',$pageData->page_meta_keyword)}}"
                        class="form-control {{ $errors->has('page_meta_keyword') ? 'is-invalid' : '' }}" placeholder="Enter Page Keywords">
                    </div>
                  </div>

                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Pages Meta Description</label>
                      <textarea name="page_meta_description" class="form-control {{ $errors->has('page_meta_description') ? 'is-invalid' : '' }}" placeholder="Enter Page Meta Description">{{old('page_meta_description',$pageData->page_meta_description)}}</textarea>
                    </div>
                  </div>
                  
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Pages Description</label>
                     <textarea name="page_description" class="form-control wysiwyg-ck {{ $errors->has('page_description') ? 'is-invalid' : '' }}"
                      placeholder="Enter Page Description">{{old('page_description',$pageData->page_description)}}</textarea>
                    </div>
                  </div>

                  <div class="col-md-8">
                      <div class="form-group">
                      <label>Status</label>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value='Active' <?=($action == "Add") ? "checked" : ""?><?=($pageData->status == 'Active') ? "checked" : ""?>>
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
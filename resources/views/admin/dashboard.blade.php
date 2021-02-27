@section('title','Dashboard')

@extends('admin.layouts.app_admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome Admin</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total User</span>
                <span class="info-box-number">
                  {{$data['userCount']}}
                  <small>Users</small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-eye"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Category</span>
                <span class="info-box-number">{{$data['categoryCount']}}</span>
              </div>
            </div>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-eye"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total SubCategory</span>
                <span class="info-box-number">{{$data['subCategoryCount']}}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Products</span>
                <span class="info-box-number">{{$data['productCount']}}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <!-- Remove this section -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3><i class="fa fa-cloud"></i> {{greetings()." ".Auth::user()->name}}</h3>
              </div>
            </div>
            <dashboard-data></dashboard-data>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
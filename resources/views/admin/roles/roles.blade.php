@php
$routeUrl = route('admin.roles');
$routeCreateUrl = route('admin.create_roles');
$routeEditUrl = url(ADMIN_PATH.'/roles/edit/');
@endphp

@section('title','Admin roles')

@extends('admin.layouts.app_admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{$data['pageTitle']}} <a href="{{$routeCreateUrl}}" class="float-right btn btn-sm btn-info"><i
                                class="fa fa-plus fa-sm"></i> Add {{$data['pageTitle']}}</a></h1>
                    <hr>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('includes.alert_msg')
                        <!-- /.card-header -->
                        <div class="card-body table-bodered table-responsive p-0">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data['pageData']) > 0)
                                    @foreach($data['pageData'] as $pageData)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><?=$pageData->name?></td>
                                        <td>
                                            @foreach ($pageData->permissions as $item)
                                                <span class="badge badge-warning">{{$item->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{$routeEditUrl.'/'.$pageData->id}}"
                                                class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            <span onclick="removeData('category',{{$pageData->id}})"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-danger">
                                        <td colspan="10">Sorry No Data Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
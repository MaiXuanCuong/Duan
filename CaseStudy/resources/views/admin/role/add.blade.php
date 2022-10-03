@extends('admin.layouts.master')
@section('content')
@if (Auth::user()->hasPermission('Role_create'))
    <div class="content-wrapper">
        <div class="content">
            <div class="pagetitle">
            <h1>Thêm Chức Vụ Và Quyền</h1>
            <nav>
              <ol class="breadcrumb">
                @if (Auth::user()->hasPermission('Role_viewAny'))
                  <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Chức Vụ</a></li>
                  @endif
                <li class="breadcrumb-item"><b style="color: red">Thêm Chức Vụ</b></li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
        </div><!-- End Page Title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('role.store') }} " method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên Chức Vụ</label>
                                    <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                                        id="name" placeholder="Nhập Tên Chức Vụ">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên Hiển Thị</label>
                                    <input name="display_name" value="{{ old('display_name') }}" type="text" class="form-control"
                                        id="name" placeholder="Nhập Tên Hiển Thị">
                                    <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Quyền</label>
                            </div>
                            <div class="card-header col-md-12">
                                <input name="" value="" class="form-check-input checkbox_all" type="checkbox"
                                    id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Tất cả
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox row d-flex mb-4">
                                @if (is_array($parent_permissions) || is_object($parent_permissions))
                                @foreach ($parent_permissions as $parent_permission)
                                    <div class="card col-md-12">
                                        <div class="card-header">
                                            <input name="" value="{{ $parent_permission->id }}"
                                                class="form-check-input checkbox_parent checkbox_all_childrent"
                                                type="checkbox" id="gridCheck{{ $parent_permission->id }}">
                                            <label class="form-check-label" for="gridCheck{{ $parent_permission->id }}">
                                                {{ $parent_permission->group_name }}
                                            </label>
                                        </div>
                                        <div class="card-body row d-flex">
                                            @foreach ($parent_permission->childrentPermissions as $childrentPermission)
                                                <div class="form-check col-3">
                                                    <input name="permissions_id[]" value="{{ $childrentPermission->id }}"
                                                        class="form-check-input checkbox_childrent checkbox_all_childrent"
                                                        type="checkbox" id="gridCheck{{ $childrentPermission->id }}">
                                                    <label class="form-check-label"
                                                        for="gridCheck{{ $childrentPermission->id }}">
                                                        {{ $childrentPermission->group_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

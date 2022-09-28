@extends('admin.layouts.master')
@section('title')
    <title>Thêm tài khoản</title>
@endsection
@section('content')
    <div class="content-wrapper">

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('role.update', ['id' => $role->id]) }} " method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên nhóm quyền</label>
                                    <input name="name" value="{{ $role->name ?? old('name') }}" type="text" class="form-control"
                                        id="name" placeholder="nhập họ tên">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Tên Hiển Thị</label>
                                    <input name="name" value="{{ $role->name ?? old('name') }}" type="text" class="form-control"
                                        id="name" placeholder="nhập họ tên">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Quyền</label>
                            </div>
                            <div class="card-header col-md-6">
                                <input name="" value="" class="form-check-input checkbox_all" type="checkbox"
                                    id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Tất cả
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox row d-flex mb-4">
                                @foreach ($parent_permissions as $parent_permission)
                                    <div class="card col-md-12">
                                        <div class="card-header">
                                            <input name="" value="{{ $parent_permission->id }}" class="form-check-input checkbox_parent checkbox_all_childrent" type="checkbox"
                                                id="gridCheck{{ $parent_permission->id }}">
                                            <label class="form-check-label" for="gridCheck{{ $parent_permission->id }}">
                                                {{ $parent_permission->name }}
                                            </label>
                                        </div>
                                        <div class="card-body row d-flex">
                                            @foreach ($parent_permission->childrentPermissions as $childrentPermission)
                                                <div class="form-check col-3">
                                                    <input name="permissions_id[]" 
                                                        value="{{ $childrentPermission->id }}" 
                                                        {{ $permissions_checked->contains('id', $childrentPermission->id) ? 'checked' : '' }}
                                                        class="form-check-input checkbox_childrent checkbox_all_childrent"
                                                        type="checkbox" 
                                                        id="gridCheck{{ $childrentPermission->id }}">
                                                    <label class="form-check-label" for="gridCheck{{ $childrentPermission->id }}">
                                                        {{ $childrentPermission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.checkbox_parent').on('click', function(){
            $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'))
        });
        $('.checkbox_all').on('click', function(){
            $(this).parents('.form').find('.checkbox_all_childrent').prop('checked', $(this).prop('checked'))
        });
    </script>
@endsection
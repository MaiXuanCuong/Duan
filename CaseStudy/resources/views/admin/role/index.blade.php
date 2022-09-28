@extends('admin.layouts.master')

@section('title')
<title>Tài khoản</title>
@endsection
@php
//  dd($roles)   
@endphp
@section('css')
<link rel="stylesheet" href="{{ asset('admin\product\index\index.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('role.create') }}" class="btn btn-primary float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên nhóm quyền</th>
                    <th scope="col">Tên Hiển Thị</th>
                    <th scope="col">Tùy chọn</th>
                  </tr>
                </thead>
                <tbody>
                  @if($roles->count())
                      @foreach ($roles as $role)
                          <tr>
                            <td> {{ $role->id }} </td>
                            <td> {{ $role->name }} </td>
                            <td> {{ $role->display_name }} </td>
                            <td>
                                 <a href="{{ route('role.edit', ['id' => $role->id]) }}" class="btn btn-primary">Sửa</a>
                              <a href="{{ route('role.delete', ['id' => $role->id]) }}"
                                  data-url="{{ route('role.delete', ['id' => $role->id]) }}"
                                  class="btn btn-danger ajax_delete">
                                  Xóa
                              </a>
                             
                            </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                          <th colspan="4" class="text-center">Empty</th>
                      </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              {{ $roles->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

{{-- @section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin\product\index\index.js') }}"></script>
@endsection --}}
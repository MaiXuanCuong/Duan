@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin\product\index\index.css') }}">
@endsection
@section('content')
    @if (Auth::user()->hasPermission('Role_viewAny'))
        <div class="title m-b-md">
            <div class="pagetitle">
                <h1>Chức Vụ</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><b style="color: red">Chức Vụ</b></li>
                        @if (Auth::user()->hasPermission('Role_create'))
                            <li class="breadcrumb-item"><a href="{{ route('role.create') }}">Thêm Chức Vụ</a></li>
                        @endif
                        </li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div style="text-align: center" class="col-lg-12">
                    <div class="card">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên nhóm quyền</th>
                                    <th scope="col">Tên Hiển Thị</th>
                                    @if (Auth::user()->hasPermission('Role_update') || Auth::user()->hasPermission('Role_delete'))
                                        <th scope="col">Tùy chọn</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($roles->count())
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td> {{ $role->id }} </td>
                                            <td> {{ $role->name }} </td>
                                            <td> {{ $role->display_name }} </td>
                                            @if (Auth::user()->hasPermission('Role_update') || Auth::user()->hasPermission('Role_delete'))
                                                <td>
                                                    @if (Auth::user()->hasPermission('Role_update'))
                                                        <a href="{{ route('role.edit', ['id' => $role->id]) }}"
                                                            class="btn btn-primary">Sửa</a>
                                                    @endif
                                                    @if (Auth::user()->hasPermission('Role_delete'))
                                                        <a href="{{ route('role.delete', ['id' => $role->id]) }}"
                                                            data-url="{{ route('role.delete', ['id' => $role->id]) }}"
                                                            class="btn btn-danger ajax_delete">
                                                            Xóa
                                                        </a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="4" class="text-center">Empty</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="col-md-12">
                        </div>
                    </div>
                    {{ $roles->links() }}
                </div>
            </div>
            </div>
        </section>
    @endif
@endsection

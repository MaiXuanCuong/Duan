@extends('admin.layouts.master')

@section('content')
    @if (Auth::user()->hasPermission('Category_viewAny'))


        <body>
            <div class="flex-center position-ref full-height">
                <div class="content container">
                    <div class="title m-b-md">
                        <div class="pagetitle" >
                            <h1>Danh Mục</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
                                    <li class="breadcrumb-item"><b style="color: red">Danh Mục</b></li>
                                    @if (Auth::user()->hasPermission('Category_create'))
                                        <li class="breadcrumb-item"><a href="{{ route('categories.add') }}">Thêm Danh Mục</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasPermission('Category_viewgc'))
                                        <li class="breadcrumb-item active"><a
                                                href="{{ route('categories.garbageCan') }}">Thùng
                                                Rác</a></li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                       
                        @if (Auth::user()->hasPermission('Category_create'))
                            <a class="btn btn-primary" id="addcategory" href="{{ route('categories.add') }}">Thêm Danh
                                Mục</a>
                        @endif
                        @if (Auth::user()->hasPermission('Category_viewgc'))
                            <a class="btn btn-danger" href="{{ route('categories.garbageCan') }}">Thùng rác</a>
                        @endif
                        @if (Session::has('success'))
                            <p class="text-success">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                {{ Session::get('success') }}
                            </p>
                        @endif
                

                    </div>
                    <br>
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">
                                <div style="text-align: center" class="card">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th width="20%"><i>STT</i></th>
                                                <th width="30%"><i>Tên Danh Mục</i></th>
                                                <th width="30%"><i>Ảnh Danh Mục</i></th>
                                                @if (Auth::user()->hasPermission('Category_update') || Auth::user()->hasPermission('Category_delete'))
                                                    <th width="30%"><i>Thao Tác</i></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $key => $item)
                                                <tr class="item-{{ $item->id }}">
                                                    <td>
                                                        <i>{{ $key + 1 }} </i>
                                                    </td>
                                                    <td>
                                                        <i> {{ $item->name }} </i>
                                                    </td>
                                                    <td>
                                                        <img width="200px" height="50px" src="{{ asset($item->image) }}"
                                                            alt="">
                                                    </td>
                                                    @if (Auth::user()->hasPermission('Category_update') || Auth::user()->hasPermission('Category_delete'))
                                                        <td>
                                                            {{-- <form action="{{ route('categories.destroy', $item->id) }}" method="post"> --}}
                                                            @if (Auth::user()->hasPermission('Category_update'))
                                                                <i>
                                                                    <a class="btn btn-primary"
                                                                        href="{{ route('categories.edit', $item->id) }}">Sửa</a>
                                                                </i>
                                                            @endif

                                                            {{-- @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Bạn Chắc Chắn Xóa {{ $item->name }}')" type="submit">
                                                <i>Xóa</i></button> --}}
                                                            {{-- </form> --}}
                                                            @if (Auth::user()->hasPermission('Category_update'))
                                                                <a
                                                                    data-url="{{ route('categories.destroy', $item->id) }}" id="{{ $item->id }}"
                                                                    class="btn btn-danger ajax_delete">
                                                                    Xóa
                                                                </a>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $items->appends(request()->all())->links() }}
                            </div>
                        </div>
                </div>
    @endif
    </section>
    </body>

    </html>
@endsection

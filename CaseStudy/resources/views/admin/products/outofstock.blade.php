@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Product_viewAny'))
        <body>
            <div class="flex-center position-ref full-height">
                <div class="content container">
                    <div class="title m-b-md">
                        <div class="pagetitle">
                            <h1>Sản Phẩm Hết Hàng</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
                                    <li class="breadcrumb-item"><b style="color: red">Sản Phẩm Hết Hàng</b></li>
                                    @if (Auth::user()->hasPermission('Product_create'))
                                        <li class="breadcrumb-item"><a href="{{ route('products.add') }}">Thêm Sản Phẩm</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasPermission('Product_viewgc'))
                                        <li class="breadcrumb-item active"><a href="{{ route('products.garbageCan') }}">Thùng
                                                Rác</a>
                                        </li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                    @if (Auth::user()->hasPermission('Product_create'))
                        <a class="btn btn-primary" href="{{ route('products.add') }}">Thêm Sản Phẩm</a>
                    @endif
                    @if (Auth::user()->hasPermission('Product_viewgc'))
                        <a class="btn btn-danger" href="{{ route('products.garbageCan') }}">Thùng rác</a>
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
                                            <th width="5%"><i>STT</i></td>
                                            <th width="20%"><i>Sản Phẩm</i></th>
                                            <th width="10%"><i>Danh Mục</i></th>
                                            <th width="20%"><i>Giá</i></th>
                                            <th width="20%"><i>Ảnh</i></th>
                                            @if (Auth::user()->hasPermission('Product_update') || Auth::user()->hasPermission('Product_delete') || Auth::user()->hasPermission('Product_view'))
                                                <th width="30%"><i>Thao Tác</i></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($items->count())
                                        @foreach ($items as $key => $item)
                                            <tr>
                                                <td>
                                                    <i>{{ $key + 1 }} </i>
                                                </td>
                                                <td>
                                                    <i>{{ $item->name }} </i>
                                                </td>
                                                <td>
                                                    {{-- @if (isset($item->category->name)) --}}
                                                    <i>{{ $item->category->name ?? 'Danh Mục Đã Bị Xóa' }}</i>
                                                    {{-- @endif --}}
                                                </td>
                                                <td>
                                                    <i>{{ number_format($item->price)." VNĐ" }} </i>
                                                </td>
                                                <td>
                                                    <img width="100px" height="120px" src="{{ asset($item->image) }}"
                                                        alt="">
                                                </td>
                                                @if (Auth::user()->hasPermission('Product_update') || Auth::user()->hasPermission('Product_delete'))
                                                    <td>
                                                        {{-- <form action="{{ route('products.destroy',$item->id) }}" method="post"> --}}
                                                            @if (Auth::user()->hasPermission('Product_view'))
                                                            <i><a class="btn btn-warning"
                                                                    href="{{ route('products.show', $item->id) }}">Chi Tiết</a></i>
                                                                   
                                                        @endif
                                                        @if (Auth::user()->hasPermission('Product_update'))
                                                            <i><a class="btn btn-primary"
                                                                    href="{{ route('products.edit', $item->id) }}">Sửa</a></i>
                                                        @endif
                                                        {{-- @csrf
                                    @method('delete') --}}
                                                        {{-- <button class="btn btn-danger" onclick="return confirm('Bạn Chắc Chắn Xóa {{ $item->name }}')" type="submit"><i>Xóa</i></button><hr>     --}}
                                                        {{-- </form> --}}
                                                        @if (Auth::user()->hasPermission('Product_delete'))
                                                            <a href="{{ route('products.destroy', $item->id) }}"
                                                                data-url="{{ route('products.destroy', $item->id) }}"
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
                                            <th colspan="4" class="text-center">Không Có Sản Phẩm Hết Hàng!</th>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
            {{ $items->appends(request()->all())->links() }}
            <!-- Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
            </script>
        </body>
        </html>
    @endif
@endsection

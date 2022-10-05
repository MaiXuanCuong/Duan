@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Product_viewgc'))

        <body>
            <div class="flex-center position-ref full-height">
                <div class="content container">
                    <div class="title m-b-md">
                        <div class="pagetitle">
                            <h1>Thùng Rác</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
                                    @if (Auth::user()->hasPermission('Product_viewAny'))
                                        <li class="breadcrumb-item"><a href="{{ route('products') }}">Sản Phẩm</a></li>
                                    @endif
                                    @if (Auth::user()->hasPermission('Product_create'))
                                        <li class="breadcrumb-item"><a href="{{ route('products.add') }}">Thêm Sản Phẩm</a>
                                        </li>
                                    @endif
                                    <li class="breadcrumb-item active"><b style="color: red;">Thùng Rác</b></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    @if (Auth::user()->hasPermission('Product_viewAny'))
                        <a class="btn btn-primary" href="{{ route('products') }}">Trang Sản Phẩm</a>
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
                                
                                @if ($items->count())
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th width="5%"><i>STT</i></td>
                                            <th width="20%"><i>Sản Phẩm</i></th>
                                            <th width="20%"><i>Danh Mục</i></th>
                                            <th width="20%"><i>Giá</i></th>
                                            <th width="20%"><i>Ảnh</i></th>
                                            @if (Auth::user()->hasPermission('Product_restore') || Auth::user()->hasPermission('Product_forceDelete'))
                                                <th width="20%"><i>Thao Tác</i></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                    <i>{{ number_format($item->price)." VNĐ"  }} </i>
                                                </td>
                                                <td>
                                                    <img width="100px" height="120px" src="{{ asset($item->image) }}"
                                                        alt="">
                                                </td>
                                                @if (Auth::user()->hasPermission('Product_restore') || Auth::user()->hasPermission('Product_forceDelete'))
                                                    <td>
                                                        {{-- <form action="{{ route('products.forceDelete',$item->id) }}" method="post"> --}}
                                                        {{-- <i><a class="btn btn-primary" href="{{ route('products.restore',$item->id) }}">Lấy lại</a></i> --}}
                                                        @if (Auth::user()->hasPermission('Product_restore'))
                                                            <a href="{{ route('products.restore', $item->id) }}"
                                                                data-url="{{ route('products.restore', $item->id) }}"
                                                                class="btn btn-primary ajax_restore">
                                                                Lấy Lại
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->hasPermission('Product_forceDelete'))
                                                            {{-- @csrf --}}
                                                            {{-- @method('delete') --}}
                                                            {{-- <button class="btn btn-danger" onclick="return confirm('Bạn Chắc Chắn Xóa {{ $item->name }}')" type="submit"><i>Xóa</i></button><hr>     --}}
                                                            {{-- </form> --}}
                                                            <a 
                                                                data-url="{{ route('products.forceDelete', $item->id) }}"
                                                                class="btn btn-danger ajax_delete">
                                                                Xóa
                                                            </a>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <tr>
                                        <b colspan="6" class="text-center">Thùng Rác Trống!</b>
                                    </tr>
                                @endif
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

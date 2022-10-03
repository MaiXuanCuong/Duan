@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Category_update'))
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <div class="pagetitle">
                        <h1>Chỉnh Sửa Danh Mục</h1>
                        <nav>
                          <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
                            @if (Auth::user()->hasPermission('Category_viewAny'))
                            <li class="breadcrumb-item"><a href="{{ route('categories') }}">Danh Mục</a></li>
                            @endif
                            @if (Auth::user()->hasPermission('Category_create'))
                            <li class="breadcrumb-item"><a href="{{ route('categories.add') }}">Thêm Danh Mục</a></li>
                            @endif
                            @if (Auth::user()->hasPermission('Category_viewgc'))
                            <li class="breadcrumb-item active"><a href="{{ route('categories.garbageCan') }}">Thùng Rác</a></li>
                            @endif
                          </ol>
                        </nav>
                      </div><!-- End Page Title -->
                    </div><!-- End Page Title -->
                </div>
                <form class="text-left" method="post" action="{{ route('categories.update', $item->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputTitle">Tên Danh Mục</label>
                        <input type="text" class="form-control" id="inputTitle" name="name"
                            value="{{ $item->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="inputTitle">Ảnh Danh Mục</label><br>
                        <input accept="image/*" type='file' id="imgInp" name="inputFile" /><br><br>
                        <img type="hidden" width="90px" height="90px" id="blah1"
                            src="{{ asset($item->image) ?? $request->inputFile }}" alt="" /> <br>
                        @error('inputFile')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>

                        {{-- <img width="100px" height="130px" src="{{ asset($item->image) }}" alt=""> --}}
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a class="btn btn-danger" href="{{ route('categories') }}">Hủy</a>
                </form>
            </div>
        </div>
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

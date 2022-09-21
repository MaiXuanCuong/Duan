@extends('admin.layouts.master')
@section('content')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <h1>Thêm Khách Hàng</h1>
                </div>
                <form class="text-left" method="post" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="inputTitle">Tên Khách Hàng</label>
                        <input type="text" class="form-control" id="inputTitle" name="name" value="{{ $request->name ?? old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTitle">Địa Chỉ</label>
                        <input type="text" class="form-control" id="inputTitle" name="address" value="{{ $request->address ?? old('address') }}">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTitle">email</label>
                        <input type="email" class="form-control" id="inputTitle" name="email" value="{{ $request->email ?? old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="inputTitle">Mật Khẩu</label>
                        <input type="password" class="form-control" id="inputTitle" name="password" value="{{ $request->password ?? old('password') }}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <a class="btn btn-danger" href="{{ route('customers') }}">Hủy</a>
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
@endsection

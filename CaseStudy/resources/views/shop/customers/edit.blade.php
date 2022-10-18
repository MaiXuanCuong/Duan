@extends('admin.layouts.master')
@section('content')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <h1>Chỉnh Sửa Khách Hàng</h1>
                </div>
                <form class="text-left" method="post" action="{{ route('customers.update', $customer->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputTitle">Khách Hàng</label>
                        <input type="text" class="form-control" id="inputTitle" name="name"
                            value="{{ $customer->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTitle">Địa Chỉ</label>
                        <input type="text" class="form-control" id="inputTitle" name="address" value="{{ $customer->address}}">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTitle">email</label>
                        <input type="email" class="form-control" id="inputTitle" name="email" value="{{ $customer->email}}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="inputTitle">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="inputTitle" name="phone" value="{{ $customer->phone}}">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="inputTitle">Mật Khẩu</label>
                        <input type="password" class="form-control" id="inputTitle" name="password" value="{{ $customer->password}}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
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

@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Admin_create'))
        <div class="pagetitle">
            <h1>Đăng Ký User</h1>
            <nav>
                <ol class="breadcrumb">
                    @if (Auth::user()->hasPermission('Admin_viewAny'))
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Danh Sách user</a></li>
                        @endif
                        <li class="breadcrumb-item"><b>Thêm User</b></li>
                        @if (Auth::user()->hasPermission('Admin_viewgc'))
                            <li class="breadcrumb-item"><a href="{{ route('users.garbageCan') }}">User Bị Cất Chức</a></li>
                        @endif
                        {{-- <li class="breadcrumb-item active"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thêm User</h5>
                            {{-- <code></code> --}}
                            <!-- Browser Default Validation -->
                            @include('sweetalert::alert')
                            <form class="mx-1 mx-md-4" method="post" action="{{ route('users.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label class="form-label" for="form3Example1c">Họ Và Tên</label>

                                        <input type="text" id="form3Example1c" class="form-control" name="name"
                                            value="{{ old('name') }}" />
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class='fa fa-address-book fa-lg me-3 fa-fw'></i>
                                    <div class="form-outline flex-fill mb-0">
                                   
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tỉnh/Thành Phố</label>
                                                    <select name="province_id" id="province_id" class="form-control province_id"
                                                        aria-label="Default select example" data-toggle="select2">
                                                        <option selected="" value="">Chọn Tỉnh/Thành Phố</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id')
                                                        <div class="text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quận/Huyện</label>
                                                    <select name="district_id" id="district_id" class="form-control district_id"
                                                        aria-label="Default select example">
                                                        <option selected="" value="">Chọn Quận/Huyện</option>
                                                    </select>
                                                    @error('district_id')
                                                        <div class="text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Xã/Phường</label>
                                                    <select name="ward_id" class="form-control ward_id" aria-label="Default select example"
                                                        id="ward_id">
                                                        <option selected="" value="">Chọn Xã/Phường</option>
                                                    </select>
                                                    @error('ward_id')
                                                        <div class="text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label class="form-label" for="form3Example3c">Tài Khoản Email</label>

                                        <input type="email" id="form3Example3c" class="form-control" name="email"
                                            value="{{ old('email') }}" />
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class='fa fa-phone fa-lg me-3 fa-fw'></i>
                                    <div class="form-outline flex-fill mb-0">
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label class="form-label" for="form3Example3c">Số Điện Thoại</label>

                                        <input type="text" id="form3Example3c" class="form-control" name="phone"
                                            value="{{ old('phone') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">Ảnh User</label><br>
                                    <input accept="image/*" type='file' id="imgInp" name="inputFile" /><br><br>
                                    <img type="hidden" width="90px" height="90px" id="blah" src=""
                                        alt="" />
                                    <br>
                                    @error('inputFile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Đăng Ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    @endif
@endsection

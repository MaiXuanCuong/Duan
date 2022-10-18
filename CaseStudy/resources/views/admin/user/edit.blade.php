@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Admin_update'))
        <div class="pagetitle">
            <h1>Chỉnh Sửa User</h1>
            <nav>
                <ol class="breadcrumb">
                    @if (Auth::user()->hasPermission('Admin_viewAny'))
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Danh Sách user</a></li>
                    @endif
                    @if (Auth::user()->hasPermission('Admin_create'))
                        <li class="breadcrumb-item"><a href="{{ route('users.add') }}">Thêm User</a></li>
                    @endif
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Chỉnh Sửa User</h5>
                            @include('sweetalert::alert')
                            <form class="mx-1 mx-md-4" method="post" action="{{ route('users.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" id="form3Example1c" class="form-control" name="name"
                                            value="{{ $user->name ?? old('name') }}" />
                                        <label class="form-label" for="form3Example1c">Họ Và Tên</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tỉnh/Thành Phố</label>
                                            <select name="province_id"
                                                class="form-control @error('province_id') is-invalid @enderror">
                                                @foreach ($provinces as $province)
                                                    <option value="{{ old('province_id') ?? $province->id }}"
                                                        @selected($province->id == $user->province_id)>
                                                        {{ $province->name }}</option>
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
                                            <select name="district_id" id="district_id"
                                                class="form-control @error('district_id') is-invalid @enderror"
                                                aria-label="Default select example">
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" @selected($district->id == $user->district_id)>
                                                        {{ old('district_id') ?? $district->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('district_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Xã/Phường</label>
                                            <select name="ward_id"
                                                class="form-control @error('ward_id') is-invalid @enderror"
                                                aria-label="Default select example" id="ward_id">
                                                @foreach ($wards as $ward)
                                                    <option value="{{ $ward->id }}" @selected($ward->id == $user->ward_id)>
                                                        {{ old('ward_id') ?? $ward->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('ward_id')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="email" id="form3Example3c" class="form-control" name="email"
                                            value="{{ $user->email ?? old('email') }}" />
                                        <label class="form-label" for="form3Example3c">Tài Khoản Email</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <i class='fa fa-phone fa-lg me-3 fa-fw'></i>
                                    <div class="form-outline flex-fill mb-0">
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" id="form3Example3c" class="form-control" name="phone"
                                            value="{{ $user->phone ?? old('phone') }}" />
                                        <label class="form-label" for="form3Example3c">Số Điện Thoại</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">Ảnh User</label><br>
                                    <input accept="image/*" type='file' id="imgInp" name="inputFile" /><br><br>
                                    <img type="hidden" width="90px" height="90px" id="blah1"
                                        src="{{ asset($user->image) ?? $request->inputFile }}" alt="" /> <br>
                                    @error('inputFile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if (Auth::user()->hasPermission('Role_update'))
                                    <div class="col-md-6">
                                        <b class="breadcrumb-item">Vai trò</b>
                                    </div>
                                    <div class="custom-control custom-checkbox row d-flex mb-4">
                                        @foreach ($roles as $role)
                                            <div class="form-check col-3">
                                                <input name="roles_id[]" value="{{ $role->id }}"
                                                    {{ $user_roles->contains('role_id', $role->id) ? 'checked' : '' }}
                                                    class="form-check-input" type="checkbox"
                                                    id="gridCheck{{ $role->id }}">
                                                <label class="form-check-label"
                                                    for="gridCheck{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    @endif
@endsection


 @extends('admin.layouts.master')
 @section('content')
    <div class="pagetitle">
      <h1>Thông Tin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li>
          <li class="breadcrumb-item active"><b>Thông Tin Cá Nhân</b></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="{{ asset(Auth()->user()->image) }}" alt="Profile" class="rounded-circle">
              <h2>{{Auth()->user()->name}}</h2>
              <h3>   @if (isset(Auth()->user()->roles[0]['display_name']))
                <span>{{ Auth()->user()->roles[0]['display_name'] }}</span>
                @endif</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tổng Quan</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Chỉnh Sửa Hồ Sơ</button>
                </li>
           
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Thay Đổi Mật Khẩu</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Châm Ngôn</h5>
                  <p class="small fst-italic">Hãy Đến Với Chúng Tôi, Chúng Tôi Luôn Đợi Bạn</p>

                  <h5 class="card-title">Hồ Sơ</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Họ Và Tên</div>
                    <div class="col-lg-9 col-md-8">{{Auth()->user()->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Công Ty</div>
                    <div class="col-lg-9 col-md-8">XC-Shop</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nghề Nghiệp</div>
                    <div class="col-lg-9 col-md-8">@if (isset(Auth()->user()->roles[0]['display_name']))
                      <span>{{ Auth()->user()->roles[0]['display_name'] }}</span>
                      @else
                      Thử Việc
                      @endif</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Quốc Gia</div>
                    <div class="col-lg-9 col-md-8">Việt Nam</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Địa Chỉ</div>
                    <div class="col-lg-9 col-md-8">{{Auth()->user()->address}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Số Điên Thoại</div>
                    <div class="col-lg-9 col-md-8">{{Auth()->user()->phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{Auth()->user()->email}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" action="{{ route('users.updateProfile', Auth()->user()->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                   @method('PUT')
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-group">
                          <input accept="image/*" type='file' id="imgInp" name="inputFile" /><br><br>
                          <img type="hidden" width="90px" height="90px" id="blah1"
                              src="{{ asset(Auth()->user()->image) ?? $request->inputFile }}" alt="" /> <br>
                          @error('inputFile')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ và Tên</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="{{Auth()->user()->name}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Địa Chỉ</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="{{Auth()->user()->address}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số Điện Thoại</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="{{Auth()->user()->phone}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{Auth()->user()->email}}">
                      </div>
                    </div>
                 
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form class="mx-1 mx-md-4" method="post" action="{{ route('users.updatepassword') }}">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mật Khẩu Hiện Tại</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Mật Khẩu Mới</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Xác Nhận Mật Khẩu</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                    </div>
                  </form><!-- End Change Password Form -->
                </div>
              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/apple-touch-icon.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">
<meta name="theme-color" content="#3063A0">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme.min.css') }}" data-skin="default">
<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark">
<link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/custom.css') }}">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng Ký</p>
                  @include('sweetalert::alert')
                  <form class="mx-1 mx-md-4" method="post" action="{{ route('admin.register') }}">
                    @csrf
                    @method('POST')
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <input type="text" id="form3Example1c" class="form-control" name="name" value="{{ old('name') }}" />
                        <label class="form-label" for="form3Example1c">Họ Và Tên</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class='fa fa-address-book fa-lg me-3 fa-fw'></i>
                      <div class="form-outline flex-fill mb-0">
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <input type="text" id="form3Example1c" class="form-control" name="address" value="{{ old('address') }}" />
                        <label class="form-label" for="form3Example1c">Địa Chỉ</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <input type="email" id="form3Example3c" class="form-control" name="email" value="{{ old('email') }}"/>
                        <label class="form-label" for="form3Example3c">Tài Khoản Email</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class='fa fa-phone fa-lg me-3 fa-fw'></i>
                      <div class="form-outline flex-fill mb-0">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <input type="text" id="form3Example3c" class="form-control" name="phone" value="{{ old('phone') }}"/>
                        <label class="form-label" for="form3Example3c">Số Điện Thoại</label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <input type="password" id="form3Example4c" class="form-control" name="password" value="{{ old('password') }}"/>
                        <label class="form-label" for="form3Example4c">Mật Khẩu </label>
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        @error('password1')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <input type="password" id="form3Example4cd" class="form-control" name="password1" value="{{ old('password1') }}" />
                        <label class="form-label" for="form3Example4cd">Xác Nhận Mật Khẩu</label>
                      </div>
                    </div>
  
                   
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Đăng Ký</button>
                      
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <br><br><p class="small fw-bold mt-2 pt-1 mb-0">Đã Có Tài Khoản? <a href="{{ route('login') }}"
                        class="link-danger">Đăng Nhập</a></p>
                    </div>
                  </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
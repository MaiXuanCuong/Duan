<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
    <style>
.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}

}

</style>
<section class="vh-100">
  @include('sweetalert::alert')
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="post" action="{{ route('customer.login') }}">
            @csrf
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p  class="lead fw-normal mb-0 me-3">Đăng Nhập</p>
             
            </div><br>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                placeholder="Nhập Tài Khoản" value="{{ old('email') }}"/>
              <label class="form-label" for="form3Example3">Tài Khoản</label>
              @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                placeholder="Nhập Mật Khẩu" value="{{ old('password') }}" />
              <label class="form-label" for="form3Example4">Mật Khẩu</label>
              @error('password')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
            </div>
            <div class="text-center text-lg-start mt-4 pt-2">
              <div class="row"> <input class="btn btn-primary btn-lg" type="submit" value="Đăng Nhập">
              <p class="small fw-bold mt-2 pt-1 mb-0">Không Có Tài Khoản? <a href="{{ route('register') }}"
                  class="link-danger">Đăng Ký</a></p></div>
               
            </div>
  
          </form>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Quên mật khẩu
            </button>
          <div class="collapse  text-center" id="collapseExample">
            <div class="card card-body">
              <form action="{{ route('customer.changepassmail') }}" method="POST">
                @csrf
              <input class="form-control" type="text" name="emails" value="{{ request()->emails }}" placeholder="Nhập email của bạn"><br>
              @error('emails')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
                
              <input class="btn btn-primary" type="submit" value="Gửi mã xác nhận">
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </section>
  
</body>
</html>
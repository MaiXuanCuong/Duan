@extends('admin.layouts.master')
@section('content')
    <div class="pagetitle">
      <h1>Đăng Ký User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li>
          {{-- <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
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
                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <button type="submit" class="btn btn-primary btn-lg">Đăng Ký</button>
                  
                </div>
                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                  <br><br><p class="small fw-bold mt-2 pt-1 mb-0">Đã Có Tài Khoản? <a href="{{ route('login') }}"
                    class="link-danger">Đăng Nhập</a></p>
                </div>
              </form>
              <!-- End Browser Default Validation -->

            </div>
          </div>

        </div>

        {{-- <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Custom Styled Validation</h5>
              <p>For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>. This disables the browser default feedback tooltips, but still provides access to the form validation APIs in JavaScript. </p>

              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">First name</label>
                  <input type="text" class="form-control" id="validationCustom01" value="John" >
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label">Last name</label>
                  <input type="text" class="form-control" id="validationCustom02" value="Doe" >
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustomUsername" class="form-label">Username</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" >
                    <div class="invalid-feedback">
                      Please choose a username.
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom03" class="form-label">City</label>
                  <input type="text" class="form-control" id="validationCustom03" >
                  <div class="invalid-feedback">
                    Please provide a valid city.
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="validationCustom04" class="form-label">State</label>
                  <select class="form-select" id="validationCustom04" >
                    <option selected disabled value="">Choose...</option>
                    <option>...</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid state.
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="validationCustom05" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="validationCustom05" >
                  <div class="invalid-feedback">
                    Please provide a valid zip.
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" >
                    <label class="form-check-label" for="invalidCheck">
                      Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                      You must agree before submitting.
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Custom Styled Validation with Tooltips</h5>
              <p>If your form layout allows it, you can swap the <code>.{valid|invalid}-feedback</code> classes for .<code>{valid|invalid}-tooltip</code> classes to display validation feedback in a styled tooltip. Be sure to have a parent with <code>position: relative</code> on it for tooltip positioning. In the example below, our column classes have this already, but your project may require an alternative setup. </p>

              <!-- Custom Styled Validation with Tooltips -->
              <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-4 position-relative">
                  <label for="validationTooltip01" class="form-label">First name</label>
                  <input type="text" class="form-control" id="validationTooltip01" value="John" >
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-4 position-relative">
                  <label for="validationTooltip02" class="form-label">Last name</label>
                  <input type="text" class="form-control" id="validationTooltip02" value="Doe" >
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-4 position-relative">
                  <label for="validationTooltipUsername" class="form-label">Username</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                    <input type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" >
                    <div class="invalid-tooltip">
                      Please choose a unique and valid username.
                    </div>
                  </div>
                </div>
                <div class="col-md-6 position-relative">
                  <label for="validationTooltip03" class="form-label">City</label>
                  <input type="text" class="form-control" id="validationTooltip03" >
                  <div class="invalid-tooltip">
                    Please provide a valid city.
                  </div>
                </div>
                <div class="col-md-3 position-relative">
                  <label for="validationTooltip04" class="form-label">State</label>
                  <select class="form-select" id="validationTooltip04" >
                    <option selected disabled value="">Choose...</option>
                    <option>...</option>
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid state.
                  </div>
                </div>
                <div class="col-md-3 position-relative">
                  <label for="validationTooltip05" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="validationTooltip05" >
                  <div class="invalid-tooltip">
                    Please provide a valid zip.
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
              </form><!-- End Custom Styled Validation with Tooltips -->

            </div>
          </div>

        </div>
      </div> --}}
    </section>
@endsection
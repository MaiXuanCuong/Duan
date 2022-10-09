<!DOCTYPE html>
<html lang="en">

<head>
    <title>XC-Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('shop/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/css.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .index {
        display: flex;
    }
</style>

<body>

    <div class="super_container">

        <!-- Header -->

        <header class="header trans_300">

            <!-- Top Navigation -->

            <div class="top_nav">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="top_nav_left">Miễn Phí Vận Chuyển Cho Đơn Hàng Trên 10.000.000 VNĐ</div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="top_nav_right">
                                <ul class="top_nav_menu">


                                    <li class="account">
                                        <a href="#">
                                            Tài Khoản Của Bạn
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="account_selection">
                                            <li><a href="{{ route('register') }}"><i class="fa fa-sign-in"
                                                        aria-hidden="true"></i>Login</a></li>
                                            <li><a href="#"><i class="fa fa-user-plus"
                                                        aria-hidden="true"></i>Register</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->

            <div class="main_nav_container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <div class="logo_container">
                                <a href="#">XC-<span>shop</span></a>
                            </div>
                            <nav class="navbar">
                                <ul class="navbar_menu">
                                    <li><a href="#">Trang Chủ</a></li>
                                    <li><a href="#">Cửa Hàng</a></li>
                                    <li><a href="#">Khuyến Mãi</a></li>

                                </ul>
                                <ul class="navbar_user">
                                    <form action="">
                                        <div class="index">
                                            <div class="form-outline">
                                                <input type="search" name="key" value="{{ old('key') }}"
                                                    id="search" class="form-control" placeholder="Search" />
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary" id="submit">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </div>&emsp;
                                            <li class="checkout">
                                                <a href="#">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <span id="checkout_items" class="checkout_items">2</span>
                                                </a>
                                            </li>
                                        </div>
                                    </form>
                                </ul>
                        </div>
                        </nav>
                    </div>
                </div>
            </div>
    </div>

    </header>

    <div class="fs_menu_overlay"></div>
    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">
                <li class="menu_item has-children">
                    <a href="#">
                        usd
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">cad</a></li>
                        <li><a href="#">aud</a></li>
                        <li><a href="#">eur</a></li>
                        <li><a href="#">gbp</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        English
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">German</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        My Account
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                    </ul>
                </li>
                <li class="menu_item"><a href="#">home</a></li>
                <li class="menu_item"><a href="#">shop</a></li>
                <li class="menu_item"><a href="#">promotion</a></li>
                <li class="menu_item"><a href="#">pages</a></li>
                <li class="menu_item"><a href="#">blog</a></li>
                <li class="menu_item"><a href="#">contact</a></li>
            </ul>
        </div>
    </div>

    <!-- Slider -->

    <div class="main_slider" style="background-image:url({{ asset('shop/images/bane1.jpg') }}); height:400px">
        <div class="container fill_height">
            <div class="row align-items-center fill_height">
                <div class="col">

                </div>
            </div>
        </div>
    </div>

    <!-- Banner -->

    <div class="banner">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="banner_item align-items-center"
                        style="background-image:url({{ asset($category->image) }})">
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                            data-filter=".{{ $category->name }}">{{ $category->name }}</li>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- New Arrivals -->

    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Được Săn Đón</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col text-center">
                    <div class="new_arrivals_sorting">
                        <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked"
                                id="all" data-filter="*">Tất Cả</li>
                                @foreach ($categories as $category)
                            <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                                data-filter=".{{ $category->name }}">{{ $category->name }}</li>
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="product-grid"
                        data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

                        <!-- Product 1 -->
                        @if (isset($items))
                            @foreach ($items as $item)
                                <div class="product-item {{ $item->category->name }}">
                                    <div class="product discount product_filter">
                                        <div class="product_image">
                                            <img src="{{ asset($item->image) }}" alt="">
                                        </div>
                                        <div class="favorite favorite_left"></div>
                                        <div
                                            class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                            <span>-$20</span>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="">{{ $item->name }}</a>
                                            </h6>
                                            <span>{{ number_format($item->price * (100 / 80)) . ' VNĐ' }}</span>
                                            <div class="product_price">{{ number_format($item->price) . ' VNĐ' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="red_button add_to_cart_button"><a href="#">Thêm vào Giỏ</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deal of the week -->

    <div style="background-color: rgba(218, 218, 218, 0.238)" class="deal_ofthe_week">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="deal_ofthe_week_img">
                        <img src="{{ asset('shop/images/iphone14.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 text-right deal_ofthe_week_col">
                    <div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
                        <div class="section_title">
                            <h2>Deal Of The Week</h2>
                        </div>
                        <ul class="timer">
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="day" class="timer_num">03</div>
                                <div class="timer_unit">Day</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="hour" class="timer_num">15</div>
                                <div class="timer_unit">Hours</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="minute" class="timer_num">45</div>
                                <div class="timer_unit">Mins</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="second" class="timer_num">23</div>
                                <div class="timer_unit">Sec</div>
                            </li>
                        </ul>
                        <div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Sellers -->

    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title new_arrivals_title">
                        <h2>Bán Chạy Nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="product_slider_container">
                        <div class="owl-carousel owl-theme product_slider">

                            <!-- Slide 1 -->

                            <div class="owl-item product_slider_item">
                                @if (isset($Apple))
                                    @foreach ($Apple as $item)
                                        @if ($item->id != rand(0, $loop->count))
                                            <div class="product-item">
                                                <div class="product discount">
                                                    <div class="product_image">
                                                        <img src="{{ asset($item->image) }}" alt="">
                                                    </div>
                                                    <div class="favorite favorite_left"></div>
                                                    <div
                                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                        <span>-$20</span>
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_name"><a
                                                                href="single.html">{{ $item->name }}</a></h6>
                                                        <div class="product_price">
                                                            {{ number_format($item->price) . ' VNĐ' }}<span>{{ number_format($item->price * (100 / 80)) . ' VNĐ' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <!-- Slide 2 -->

                            <div class="owl-item product_slider_item">
                                @if (isset($Realme))
                                    @foreach ($Realme as $item)
                                        @if ($item->id != rand(0, $loop->count))
                                            <div class="product-item women">
                                                <div class="product">
                                                    <div class="product_image">
                                                        <img src="{{ asset($item->image) }}" alt="">
                                                    </div>
                                                    <div class="favorite"></div>
                                                    <div
                                                        class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_name"><a
                                                                href="single.html">{{ $item->name }}</a></h6>
                                                        <div class="product_price">
                                                            {{ number_format($item->price) . ' VNĐ' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <!-- Slide 3 -->

                            <div class="owl-item product_slider_item">
                                @if (isset($SamSung))
                                    @foreach ($SamSung as $item)
                                        @if ($item->id != rand(0, $loop->count))
                                            <div class="product-item women">
                                                <div class="product">
                                                    <div class="product_image">
                                                        <img src="{{ asset($item->image) }}" alt="">
                                                    </div>
                                                    <div class="favorite"></div>
                                                    <div class="product_info">
                                                        <h6 class="product_name"><a
                                                                href="single.html">{{ $item->name }}</a></h6>
                                                        <div class="product_price">
                                                            {{ number_format($item->price) . ' VNĐ' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <!-- Slide 4 -->

                            <div class="owl-item product_slider_item">
                                @if (isset($Xiaomi))
                                    @foreach ($Xiaomi as $item)
                                        @if ($item->id != rand(0, $loop->count))
                                            <div class="product-item accessories">
                                                <div class="product">
                                                    <div class="product_image">
                                                        <img src="{{ asset($item->image) }}" alt="">
                                                    </div>
                                                    <div
                                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                        <span>sale</span>
                                                    </div>
                                                    <div class="favorite favorite_left"></div>
                                                    <div class="product_info">
                                                        <h6 class="product_name"><a
                                                                href="single.html">{{ $item->name }}</a></h6>
                                                        <div class="product_price">
                                                            {{ number_format($item->price) . ' VNĐ' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="owl-item product_slider_item">
                                @if (isset($Apple))
                                    @foreach ($Apple as $item)
                                        @if ($item->id != rand(0, $loop->count))
                                            <div class="product-item">
                                                <div class="product discount">
                                                    <div class="product_image">
                                                        <img src="{{ asset($item->image) }}" alt="">
                                                    </div>
                                                    <div class="favorite favorite_left"></div>
                                                    <div
                                                        class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                        <span>-$20</span>
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_name"><a
                                                                href="single.html">{{ $item->name }}</a></h6>
                                                        <div class="product_price">
                                                            {{ number_format($item->price) . ' VNĐ' }}<span>{{ number_format($item->price * (100 / 80)) . ' VNĐ' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefit -->

        <div class="benefit">
            <div class="container">
                <div class="row benefit_row">
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>Miễn Phí Vận Chuyển</h6>
                                <p>Có Thể Thay Đổi Trong Một Số Hình Thức</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>Thanh Toán Khi Nhận Hàng</h6>
                                <p>Kiểm Tra Hàng & Thanh Toán Đơn Hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>Trả Hàng Trong 3 Ngày</h6>
                                <p>Nếu Phát Hiện lỗi Từ Nhà Sản Xuất</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 benefit_col">
                        <div class="benefit_item d-flex flex-row align-items-center">
                            <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                            <div class="benefit_content">
                                <h6>Cửa Hàng Mở Cửa</h6>
                                <p>Từ 7h Sáng - 5h Chiều</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blogs -->

        <!-- Newsletter -->

        <div class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
                            <h4>Đăng Ký Nhận Khuyến Mãi</h4>
                            <p>Đăng Ký Để Nhận Thông Báo Khi Có Khuyến Mãi Mới Nhất</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="post">
                            <div
                                class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                                <input id="newsletter_email" type="email" placeholder="Nhập email"
                                    required="required" data-error="Valid email is required.">
                                <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300"
                                    value="Submit">Đăng Ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
                            <ul class="footer_nav">
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div
                            class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_nav_container">
                            <div class="cr">©2022 Mai Xuân Cường <i class="fa fa-heart-o" aria-hidden="true"></i>
                                By <a href="#">XC-Shop</a> &amp; Được Phân Phối
                                Bởi <a href="https://www.facebook.com/hihihihi.cuong">Xuân Cường</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('shop/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('shop/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('shop/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('shop/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('shop/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('shop/js/custom.js') }}"></script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- Vendor JS Files -->
    {{-- @yield('js') --}}
    <script>
        $('.checkbox_parent').on('click', function() {
            $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'))
        });
        $('.checkbox_all').on('click', function() {
            $(this).parents('.form').find('.checkbox_all_childrent').prop('checked', $(this).prop('checked'))
        });
    </script>
    <!-- Template Main JS File -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            if ($('#blah').hide()) {
                $('#blah').hide();
            }
            jQuery('#imgInp').change(function() {
                $('#blah').show();
                const file = jQuery(this)[0].files;
                if (file[0]) {
                    jQuery('#blah').attr('src', URL.createObjectURL(file[0]));
                    jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '.province_id, .add_user', function() {
                var province_id = $(this).val();
                var district_name = $('.district_id').find('option:selected').text();
                $.ajax({
                    url: "{{ route('user.GetDistricts') }}",
                    type: "GET",
                    data: {
                        province_id: province_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Open this select menu</option>';
                        $.each(data, function(key, v) {
                            console.log(v);
                            html += '<option value=" ' + v.id + ' "> ' + v
                                .name + '</option>';
                        });
                        $('.district_id').html(html);
                    }
                })
            });
        });
        $(function() {
            $(document).on('change', '#district_id, .add_user', function() {
                var district_id = $(this).val();
                var ward_id = $(this).val();
                $.ajax({
                    url: "{{ route('user.getWards') }}",
                    type: "GET",
                    data: {
                        district_id: district_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Open this select menu</option>';
                        $.each(data, function(key, v) {
                            html += '<option value =" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#ward_id').html(html);
                    }
                })
            });
        });
        $("#search").keyup(function() {
            $("#search").css("background-color", "yellow");
            setTimeout(() => {
                $("#submit").click();
            }, 2500);

        });
        $("#search").keydown(function() {
            $("#search").css("background-color", "pink");
        });
        $("#all").click(function() {
            $("#submit").click();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>

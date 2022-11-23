   < <div class="super_container">

       <!-- Header -->

       <header class="header trans_300">
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

                                           @if (isset(Auth()->guard('customers')->user()->name))
                                               <label>{{ Auth()->guard('customers')->user()->name }}</label>
                                               <li><a href="{{ route('shop.logout') }}"><i class="fa fa-sign-in"
                                                           aria-hidden="true"></i>Đăng Xuất</a></li>
                                           @else
                                               <li><a href="{{ route('shop.login') }}"><i class="fa fa-sign-in"
                                                           aria-hidden="true"></i>Đăng Nhập</a></li>
                                               <li><a href="{{ route('register') }}"><i class="fa fa-address-card-o"
                                                           aria-hidden="true"></i></i>Đăng Ký</a></li>
                                           @endif
                                       </ul>
                                   </li>
                               </ul>
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
                                   <div class="logo">
                                       <h1><a href="{{ route('shop.home') }}"><img
                                                   src="{{ asset('shop/img/logo-search-grid-1x.png') }}"></a></h1>
                                   </div>
                               </div>
                               <nav class="navbar">
                                   <ul class="navbar_menu">
                                       <li><a href="{{ route('shop.home') }}">Trang Chủ</a></li>
                                       <li><a href="{{ route('shop.cart') }}">Giỏ Hàng</a></li>
                                   </ul>
                                   <ul class="navbar_user">
                                       <li class="checkout">
                                           <a href="{{ route('shop.cart') }}">
                                               <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                               @if(isset($carts))
                                               @php
                                                $countCart = count($carts);
                                               @endphp
                                               @endif
                                               <span id="checkout_items"
                                                   class="checkout_items">{{ $countCart ?? 0 }}</span>
                                           </a>
                                       </li>
                                   </ul>
                           </div>
                           </nav>
                       </div>
                   </div>
               </div>
           </div>
       </header>
       <br>
       <br>
       <br>
       <br>
       <div class="mainmenu-area">
           <div class="container">
               <div class="row">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse"
                           data-target=".navbar-collapse">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                   </div>
               </div>
           </div>
       </div> <!-- End mainmenu area -->

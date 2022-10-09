   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            
                            <li><a href="#"><i class="fa fa-heart"></i>Yêu Thích</a></li>
                            <li><a href="{{ route('shop.cart') }}"><i class="fa fa-user"></i>Giỏ Hàng</a></li>
                            
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                           

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"><i class="fa fa-user"></i>Tài Khoản</span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Đăng Nhập</a></li>
                                    <li><a href="#">Cài Đặt Tài Khoản</a></li>
                                    <li><a href="#">Đăng Xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
      
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="{{ route('shop.home') }}"><img src="{{ asset('shop1/img/logo-search-grid-1x.png') }}"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="{{ route('shop.cart') }}">Giỏ Hàng <span class="cart"></span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
             

            </div>
        </div>
    </div> <!-- End mainmenu area -->
      

    
    
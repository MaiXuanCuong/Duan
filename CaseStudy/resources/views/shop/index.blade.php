@extends('shop.home')
@section('content')
@include('sweetalert::alert')
<br>
    <br>
    <br>
    <div class="slider-area">
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">
                    @foreach ($products as $item)
					<li>
						<img style="height: 400px; width: 400px" src="{{ asset($item->image) }}" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								<span class="primary"><strong>{{ $item->name }}</strong></span>
							</h2>
							<h4 class="caption subtitle"><strong>Giá Chỉ: </strong>{{ number_format($item->price)." VNĐ" }}</h4>
                            <a data-url="{{route('shop.store',$item->id)}}" id="{{ $item->id}}" class="caption button-radius add-to-cart-link addToCart"><span class="icon"></span><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
						</div>
					</li>
                    @endforeach
				</ul>
			</div>
    </div>
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản Phẩm Mới Nhất</h2>
                        <div class="product-carousel">
                            @foreach ($products as $item)
                            <div class="single-product">
                                <div  class="product-f-image">
                                    <img src="{{ asset($item->image) }}" alt="">
                                    <div class="product-hover">
                                        <a data-url="{{route('shop.store',$item->id)}}" id="{{ $item->id}}" class="add-to-cart-link addToCart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
                                        <a href="{{ route('shop.product',$item->id) }}" class="view-details-link"><i class="fa fa-link"></i>Xem Chi Tiết</a>
                                    </div>
                                </div>
                                <h2><a href="{{ route('shop.product',$item->id) }}">{{ $item->name }}</a></h2>
                                <div class="product-carousel-price">
                                    <ins>{{ number_format($item->price)." VNĐ" }}</ins> <del>{{ number_format($item->price*(100/80))." VNĐ" }}</del>
                                </div> 
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            @foreach ($categories as $item)
                            <img src="{{ asset($item->image) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    <div style="background-color: rgba(218, 218, 218, 0.238)" class="deal_ofthe_week">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="deal_ofthe_week_img">
                        <img src="http://127.0.0.1:8000/shop/img/iphone14.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 text-right deal_ofthe_week_col">
                    <div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
                        <div class="section_title">
                            <h2>Deal hot</h2>
                        </div>
                        <ul class="timer">
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="day" class="timer_num">2</div>
                                <div class="timer_unit">Day</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="hour" class="timer_num">23</div>
                                <div class="timer_unit">Hours</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="minute" class="timer_num">59</div>
                                <div class="timer_unit">Mins</div>
                            </li>
                            <li class="d-inline-flex flex-column justify-content-center align-items-center">
                                <div id="second" class="timer_num">18</div>
                                <div class="timer_unit">Sec</div>
                            </li>
                        </ul>
                        <div class="red_button deal_ofthe_week_button"><a href="#">Mua ngay</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Bán Chạy Nhất</h2>
                     
                        @if(isset($topProducts) && !empty($topProducts))
                        @foreach($topProducts as $top)
                        <div class="single-wid-product">
                            <div class="product_bubble product_bubble_yellow d-flex flex-column align-items-center"><span>Hot</span></div>
                            <a href="{{ route('shop.product',$top->id) }}"><img src="{{ asset($top->image) }}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ route('shop.product',$top->id) }}">{{ $top->name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>{{ number_format($top->price)." VNĐ" }}</ins> <del>{{ number_format($top->price*(100/80))." VNĐ" }}</del>
                            </div>                            
                        </div>
                        @endforeach
                        @endif
                     
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Đã Xem Gần Đây</h2>

                        
                        @if(isset($historyProducts) && !empty($historyProducts))
                     
                        @foreach($historyProducts as $history)

                        <div class="single-wid-product">
                            <div class="product_bubble product_bubble_orange d-flex flex-column align-items-center"><span>His</span></div>
                            <a href="{{ route('shop.product',$history['id']) }}"><img src="{{ asset($history['image']) }}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ route('shop.product',$history['id']) }}">{{ $history['name'] }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>{{ number_format($history['price'])." VNĐ" }}</ins> <del>{{ number_format($history['price']*(100/80))." VNĐ" }}</del>
                            </div>                            
                        </div>
                        
                        @endforeach
                        @endif
                    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Sản Phẩm Mới</h2>
                        
                        @if(isset($productsNew) && !empty($productsNew))
                        @foreach($productsNew as $new)
                        <div class="single-wid-product">
                            <div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>New</span></div>
                        
                            <a href="{{ route('shop.product',$new->id) }}"><img src="{{ asset($new->image) }}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ route('shop.product',$new->id) }}">{{ $new->name }}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>{{ number_format($new->price)." VNĐ" }}</ins> <del>{{ number_format($new->price*(100/80))." VNĐ" }}</del>
                            </div>                            
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   function AddToCart(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let tr = $(this);
    Swal.fire({
        title: 'Thêm Sản Phẩm',
        text: "Vào Giỏ Hàng Của Bạn",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng Ý'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlRequest,
                type: 'get',
                success: function(data){
                    if(data.code == 200){
                        Swal.fire(
                            'Thêm Sản Phẩm',
                            'Thành Công Vào Giỏ Hàng',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Thêm Sản Phẩm Không Thành Công',
                            'Vui Lòng Đăng Nhập',
                            'error'
                        );
                    }
                }
            });
        }
    })
}
$(function () {
    $(document).on('click', '.addToCart', AddToCart);
});

</script>


    @endsection
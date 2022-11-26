@extends('shop.home')
@section('content')
@php
// dd($carts[0]);
@endphp
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        {{-- <h2 class="sidebar-title">Tìm Kiếm</h2> --}}
                        <form action="">
                            <input type="text" value="{{ request()->key }}" name='key' placeholder="TÌm Sản Phẩm">
                            <input type="submit" value="Tìm Kiếm">
                        </form>
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title"><i>Sản Phẩm</i></h2>
                        @php($count = 0)
                        @foreach ($products as $item)
                            @if ($item->id != rand(0, $item->id) && $count < 5)
                                @php($count++)
                                <div class="thubmnail-recent">
                                    <img src="{{ asset($item->image) }}" class="recent-thumb" alt="">
                                    <b><a href="{{ route('shop.product',$item->id) }}"><i>{{ $item->name }}</i></a></b>
                                    <div class="product-sidebar-price">
                                        <del><i>{{ number_format($item->price * (100 / 80)) . ' VNĐ' }}</i></del><br>
                                        <ins><i>{{ number_format($item->price) . ' VNĐ' }}</i></ins>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove"><i>Mua</i></th>
                                            <th class="product-thumbnail"><i>Ảnh</i></th>
                                            <th class="product-name"><i>Sản Phẩm</i></th>
                                            <th class="product-price"><i>Giá</i></th>
                                            <th class="product-quantity"><i>Số Lượng</i></th>
                                            <th class="product-subtotal"><i>Tổng Tiền</i></th>
                                            <th class="product-delete"><i>Xóa</i></th>
                                        </tr>
                                 
                                    </thead>
                                  
                                    @if(isset(Auth()->guard('customers')->user()->name))
                                    @if (isset($carts) && count($carts) > 0)
                                  
                                    @foreach ($carts as $product_cart)
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                      </svg></a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="chi tiết sản phẩm" href="{{ route('shop.product',$product_cart['id']) }}"><img width="145" height="145"
                                                            alt="poster_1_up" class="shop_thumbnail"
                                                            src="{{ asset($product_cart['image']) }}"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="chi tiết sản phẩm" href="{{ route('shop.product',$product_cart['id']) }}">{{ $product_cart['name'] }}</a>
                                                </td>

                                                <td class="product-price">
                                                    <span
                                                        class="amount">{{ number_format($product_cart['price']) . ' VNĐ' }}</span>
                                                </td>

                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                        <input type="number" size="4" class=""
                                                            title="Qty" value="{{ $product_cart['quantity'] }}" min="0" step="1">
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span
                                                        class="amount">{{ number_format($product_cart['price'] * $product_cart['quantity']) . ' VNĐ' }}</span>
                                                </td>
                                                <td class="product-delete">
                                                    <a data-url="{{route('remove.cart',$product_cart['id'])}}" id="{{ $product_cart['id'] }}" class="add-to-cart-link ajax_delete"><i class="fa fa-trash-o sidebar-title" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="actions" colspan="8">
                                                    <a type="button" href="{{ route('checkOuts')}}"
                                                        class="checkout-button button alt wc-forward">Đặt hàng</a>
                                                </td>
                                            @else
                                            <tr>
                                                <td colspan="6">
                                                    <h4><i>Giỏ Hàng Trống!</i></h4>
                                                </td>
                                            </tr>
                                    @endif
                                    @endif
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <br>
                            </form>

                            <div class="cart-collaterals">
                                <div class="slider-area">
                                    <div class="block-slider block-slider4">
                                        <ul class="" id="bxslider-home4">
                                            @foreach ($products as $item)
                                            <li>
                                                <img style="height: 200px; width: 200px" src="{{ asset($item->image) }}" alt="Slide">
                                                <div class="caption-group">
                                                    <b class="caption title">
                                                        <span class="primary"><strong>{{ $item->name }}</strong></span>
                                                    </b>
                                                    <h4 class="caption subtitle"><strong>Giá Chỉ: </strong>{{ number_format($item->price)." VNĐ" }}</h4>
                                                    <a data-url="{{route('shop.store',$item->id)}}" id="{{ $item->id}}" class="caption button-radius add-to-cart-link addToCart"><span class="icon"></span><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                            </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<script>
   function DeleteToCart(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let tr = $(this);
    Swal.fire({
        title: 'Xóa Sản Phẩm',
        text: "Khỏi Vào Giỏ Hàng Của Bạn",
        icon: 'warning',
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
                        tr.parent().parent().remove();
                        Swal.fire(
                            'Xóa Sản Phẩm',
                            'Thành Công Khỏi Giỏ Hàng',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Xóa Sản Phẩm',
                            'Không Thành Công Khỏi Giỏ Hàng',
                            'error'
                        );
                    }
                }
            });
        }
    })
}
$(function () {
    $(document).on('click', '.ajax_delete', DeleteToCart);
});
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

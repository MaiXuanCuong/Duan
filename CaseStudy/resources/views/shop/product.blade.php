@extends('shop.home')
@section('content')
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                @if(isset($product))
                <div id="layoutSidenav_content">
                    <div class="container-fluid px-4">
                        <div class="row">
                            @if(isset($product))
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div style="text-align: center" class="card-header">
                                        <b style="color: blue">{{ $product->name}}</b>
                                    </div>
                                    <div style="text-align: center">
                                        <img width="300px" height="330px" src="{{ asset($product->image) }}" />
                                        <br>
                                        <b style="color: blue"><i>{{ $product->name . ': '; }}</i></b>
                                        <small> {{ $product->describe }}<br><br><br></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div style="text-align: center" class="card-header">
                                        <b style="color: red">
                                            <i>{{ number_format($product->price). ' VNĐ'; }}</i>
                                        </b>
                                        <sub><b><del><small>{{ number_format($product->price + ($product->price * 21) / 100) . ' VNĐ'; }}</small></del></b></sub>
                                    </div>
                                    <div style="text-align: center; color:red ">
                                        <table width="100%">
                                            <form action="" method="post">
                                                <tr>
                                                    <td>
                                                        <b><i>Tình Trạng <div style="color:blue"></i>
                                                            <i>@if($product->quantity > 10) 
                                                                ✅ Còn Hàng
                                                            @elseif($product->quantity <= 10)
                                                                echo '⚠ Sản Phẩm Còn Số Lượng ít';
                                                            @else 
                                                                echo '❌ Tạm Hết Hàng';
                                                             @endif</b></i>
                                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="policy"><i>Chọn Màu
                                                    <div style="color:blue">
                                                </i>
                                                @php $explode1 = explode(';', $product->color); @endphp
                                                @foreach ($explode1 as $key2 => $value2)
                                                <input name="color" type="radio" checked="checked"
                                                    value="{{ $value2; }}">{{ $value2; }}
                                                @endforeach
                                        </td>
                                </div>
                                </tr>
                                <tr>
                                    <td>
                                        <b class="policy"><i>Chọn Cấu Hình </i>
                                            <div style="color:blue">
                                                @php
                                                $explode5 = explode(';', $product->price_product);
                                                $explode2 = explode(';', $product->configuration);
                                                @endphp
                                                @foreach ($explode2 as $key3 => $value3)
                                                <input name="configuration" type="radio" checked="checked"
                                                    value="{{ $value3 . ';' . $explode5[$key3];}}">{{ $value3 . ': ' . number_format($explode5[$key3]) . ' VNĐ'; }}<br>
                                                @endforeach
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b class="policy"><i>Số Lượng</i>
                                            <div style="color:blue">
                                                <input name="quantity" type="number" min="1"
                                                    max="{{ $product->quantity;  }}" value="1">
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a type="button" data-url="{{route('shop.store',$product->id)}}" id="{{ $product->id}}" class="add-to-cart-link addToCart"><i class="fa fa-shopping-cart"></i> Thêm Vào Giỏ</a>
                                        <div>
                                        </div>
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card mb-4">
                            <div style="text-align: center" class="card-header">
                                <b><i> Thông Số Kĩ Thuật</i></b>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <div style="text-align: left ; color:red ">
                                            <b>@php $explode = explode(';', $product->specifications);
                                            @endphp</b>
                                            <table cellpadding='10px'>
                                               @foreach ($explode as $key1 => $value1)
                                                <tr>
                                                    <td><small><b>{{'➣ ' . $value1;}}</b></small>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div style="text-align: center" class="card-header">
                                            <b style="color:blue ; font-size:20px"><i>Có Thể Bạn Quan Tâm</i></b><br>
                                        </div>
                                        <div style="text-align: center">
                                            <b style="color:red ; font-size:20px"><i>Khuyến Mãi</i></b>
                                            <br>
                                            <b><em>➣<i>CHỈ BÁN HÀNG NGUYÊN SEAL 100%, nói không với hàng
                                                        Fullbox</i></em><br>
                                                <em>➣<i>Tặng dán cường lực Fullview khi nâng cấp sVIP</i></em><br>
                                                <em>➣<i>Hỗ trợ trả góp nhanh, tra góp lãi suất 0% từ xa</i></em><br>
                                                <em>➣<i>Mua Online: Giao hàng tận nhà- Nhận hàng thanh toán</i></em><br>
                                                <em>➣<i>Mọi Thắc Mắc Vui Lòng Liên Hệ: 0843.442.357 Để Được Tư vấn Và Hỗ
                                                 Trợ</i></em>
                                        </div>
                                    </td>
                                </tr>
                                </form>
                            </table>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
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

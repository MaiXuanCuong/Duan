@php
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
if(isset(Auth::guard('customers')->user()->id)){

    $user = Auth::guard('customers')->user()->id;
            $orders =  Customer::with(['orders' => function ($query) {
                return $query->with(['orderDetails' => function ($query) {
                    return $query->with('products');
                }]);
            }])->find($user); 
}
@endphp
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<div class="super_container">
    <header>
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
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Cài đặt tài khoản
                                        <i class="fa fa-angle-down"></i>

                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                @if (isset(Auth()->guard('customers')->user()->name))
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thay đổi thông
                                                            tin</h5>
                                                    </div>
                                                    <form action="{{ route('customers.update') }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ Auth()->guard('customers')->user()->name }}"
                                                                placeholder="Nhập họ và tên">
                                                                @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                            <input type="email" class="form-control"
                                                                value="{{ Auth()->guard('customers')->user()->email }}"
                                                                placeholder="Nhập email" disabled required><br>

                                                            <button class="btn btn-primary" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseExample" aria-expanded="false"
                                                                aria-controls="collapseExample">
                                                                Đổi mật khẩu
                                                            </button>
                                                            <div class="collapse  text-center" id="collapseExample">
                                                                <div class="card card-body">
                                                                    <input type="password" class="form-control" value="{{ request()->passwordOld }}" name="passwordOld"
                                                                        placeholder="Nhập mật khẩu cũ ">
                                                                        @error('passwordOld')
                                                                        <div class="alert alert-danger">{{ $errors->has('passwordOld') }}</div>
                                                                    @enderror
                                                                    <input type="password" class="form-control" value="{{ request()->passwordNew }}" name="passwordNew"
                                                                        placeholder="Nhập mật khẩu mới">
                                                                        @error('passwordNew')
                                                                        <div class="alert alert-danger">{{ $errors->has('passwordNew') }}</div>
                                                                    @enderror
                                                                    <input type="password" class="form-control" value="{{ request()->passwordConfirm }}" name="passwordConfirm"
                                                                        placeholder="Nhập lại mật khẩu mới">
                                                                        @error('name')
                                                                        <div class="alert alert-danger">{{ $errors->has('passwordConfirm') }}</div>
                                                                    @enderror



                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Hủy</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Lưu</button>


                                                            </div>
                                                    </form>
                                                @endif
                                                <ul class="account_selection">

                                                    @if (isset(Auth()->guard('customers')->user()->name))
                                                        <label>{{ Auth()->guard('customers')->user()->name }}</label>
                                                        <li><a href="{{ route('shop.logout') }}"><i
                                                                    class="fa fa-sign-in" aria-hidden="true"></i>Đăng
                                                                Xuất</a></li>
                                                    @else
                                                        <li><a href="{{ route('shop.login') }}"><i class="fa fa-sign-in"
                                                                    aria-hidden="true"></i>Đăng Nhập</a></li>
                                                        <li><a href="{{ route('register') }}"><i
                                                                    class="fa fa-address-card-o"
                                                                    aria-hidden="true"></i></i>Đăng Ký</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


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
                                  
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Lịch sử đặt hàng
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Lịch sử mua hàng</h5>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                                <div class="modal-body">
                                                    @if(isset($orders) && !empty($orders))
                                                    @foreach ($orders->orders as $order)
                                                    <table class="table">
                                                            <tr>
                                                                <td style="width: 25%; text-align: center">Ảnh</td>
                                                                <td style="width: 25%">Sản Phẩm</td>
                                                                <td style="width: 25%">Số lượng</td>
                                                                <td style="width: 25%">Ngày đặt</td>
                                                            </tr>
                                                           @foreach($order->orderDetails as $orderDetails)
                                                            <tr>
                                                                <td style="width: 25%">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="{{ asset($orderDetails->products->image) }}"
                                                                                alt="" width="100px" height="80px" class="img-fluid">
                                                                        </div>
                                                                </td>
                                                                <td style="width: 25%">
                                                                    
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="chi tiết sản phẩm" href="{{ route('shop.product',$orderDetails->products->id) }}">{{$orderDetails->products->name}}</a>
                                                                 </td>
                                                                <td style="width: 25%">
                                                                        
                                                                        {{$orderDetails->quantity}}
                                                                </td>
                                                                <td style="width: 25%">
                                                                        
                                                                    {{date_format($order->created_at, "d-m-Y H:i:s")}}
                                                                </td>
                                                                
                                                              
                                                            </tr>
                                                            @endforeach
                                                    </table>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </ul>
                                <ul class="navbar_user">
                                    <li class="checkout">
                                        <a href="{{ route('shop.cart') }}">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            @if (isset($carts))
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

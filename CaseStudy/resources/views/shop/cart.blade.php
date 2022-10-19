@extends('shop.home')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Tìm Kiếm</h2>
                        <form action="">
                            <input type="text" name='key' placeholder="TÌm Sản Phẩm">
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
                                        </tr>
                                 
                                    </thead>
                                    @if(isset(Auth()->guard('customers')->user()->name))
                                    @if (isset($carts))
                                    @foreach ($carts as $product_cart)
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove" href="#">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="single-product.html"><img width="145" height="145"
                                                            alt="poster_1_up" class="shop_thumbnail"
                                                            src="{{ asset($product_cart->image) }}"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href="single-product.html">{{ $product_cart->name }}</a>
                                                </td>

                                                <td class="product-price">
                                                    <span
                                                        class="amount">{{ number_format($product_cart->price) . ' VNĐ' }}</span>
                                                </td>

                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                        {{-- <input type="button" class="minus" value="-"> --}}
                                                        <input type="number" size="4" class="input-text qty text"
                                                            title="Qty" value="1" min="0" step="1">
                                                        {{-- <input type="button" class="plus" value="+"> --}}
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span
                                                        class="amount">{{ number_format($product_cart->price) . ' VNĐ' }}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="actions" colspan="6">
                                                    <div class="coupon">
                                                        <label for="coupon_code">Giảm Giá:</label>
                                                        <input type="text" placeholder="Mã Giảm Giá" value=""
                                                            id="coupon_code" class="input-text" name="coupon_code">
                                                        <input type="submit" value="Apply Coupon" name="apply_coupon"
                                                            class="button">
                                                    </div>
                                                    <input type="submit" value="Update Cart" name="update_cart"
                                                        class="button">
                                                    <input type="submit" value="Checkout" name="proceed"
                                                        class="checkout-button button alt wc-forward">
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


                                <div class="hover">
                                    <h2><i>Có Thể Bạn Quan Tâm</i></h2>
                                    <ul class="products">
                                        @php($count = 0)
                                        @foreach ($products as $item)
                                            @if ($item->id != rand(0, $item->id) && $count < 2)
                                                @php($count++)
                                                <li class="product">
                                                    <a href="{{ route('shop.product',$item->id) }}">
                                                        <img width="325" height="325" alt="T_4_front"
                                                            class="attachment-shop_catalog wp-post-image"
                                                            src="{{ asset($item->image) }}">
                                                        <b>{{ $item->name }}</b>
                                                        <span class="price"><span
                                                                class="amount">{{ number_format($item->price) . ' VNĐ' }}</span></span>
                                                    </a>

                                                    {{-- <a class="add_to_cart_button" data-quantity="1" data-product_sku=""
                                                        data-product_id="22" rel="nofollow" href="single-product.html">Xem
                                                        Sản Phẩm</a> --}}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="cart_totals ">
                                    <h2>Tổng Giỏ Hàng</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Tổng Tiền</th>
                                                <td><span class="amount">£15.00</span></td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>HÌnh Thức Vận Chuyển</th>
                                                <td>Free Shipping</td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Tổng Đơn Đặt</th>
                                                <td><strong><span class="amount">£15.00</span></strong> </td>
                                            </tr>
                                        </tbody>
                                 
                                    </table>
                                    
                                </div>
                                <form method="post" action="#" class="shipping_calculator">
                                    <h2><a class="shipping-calculator-button" data-toggle="collapse" href="#calcalute-shipping-wrap" aria-expanded="false" aria-controls="calcalute-shipping-wrap">Đặt Hàng</a></h2>
    
                                    <section id="calcalute-shipping-wrap" class="shipping-calculator-form collapse in" style="">
    
                                    <p class="form-row form-row-wide">
                                    <select rel="calc_shipping_state" class="country_to_state" id="calc_shipping_country" name="calc_shipping_country">
                                        <option value="">Select a country…</option>
                                      
                                    </select>
                                    </p>
    
                                    <p class="form-row form-row-wide"><input type="text" id="calc_shipping_state" name="calc_shipping_state" placeholder="State / county" value="" class="input-text"> </p>
    
                                    <p class="form-row form-row-wide"><input type="text" id="calc_shipping_postcode" name="calc_shipping_postcode" placeholder="Postcode / Zip" value="" class="input-text"></p>
    
    
                                    <p><button class="button" value="1" name="calc_shipping" type="submit">Đặt Hàng</button></p>
    
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

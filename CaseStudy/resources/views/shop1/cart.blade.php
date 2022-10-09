@extends('shop1.home')
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
                        <h2 class="sidebar-title">Sản Phẩm</h2>
                        @php($count = 0)
                        @foreach ($items as $item)
                            @if ($item->id != rand(0, $item->id) && $count < 5)
                                @php($count++)
                                <div class="thubmnail-recent">
                                    <img src="{{ asset($item->image) }}" class="recent-thumb" alt="">
                                    <h2><a href="single-product.html">{{ $item->name }}</a></h2>
                                    <div class="product-sidebar-price">
                                        <ins>{{ number_format($item->price) . ' VNĐ' }}</ins>
                                        <del>{{ number_format($item->price * (100 / 80)) . ' VNĐ' }}</del>
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
                                            <th class="product-remove">Mua</th>
                                            <th class="product-thumbnail">Ảnh</th>
                                            <th class="product-name">Sản Phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số Lượng</th>
                                            <th class="product-subtotal">Tổng Tiền</th>
                                        </tr>
                                    </thead>
                                    @if (isset($product_cart))
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove" href="#">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="single-product.html"><img width="145" height="145"
                                                            alt="poster_1_up" class="shop_thumbnail"
                                                            src="img/product-thumb-2.jpg"></a>
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
                                            </tr>
                                        </tbody>
                                    @else
                                        <h2>Giỏ Hàng Trống!</h2>
                                    @endif
                                </table>
                            </form>

                            <div class="cart-collaterals">


                                <div class="cross-sells">
                                    <h2>Có Thể Bạn Quan Tâm</h2>
                                    <ul class="products">
                                        @php($count = 0)
                                        @foreach ($items as $item)
                                            @if ($item->id != rand(0, $item->id) && $count < 2)
                                                @php($count++)
                                                <li class="product">
                                                    <a href="single-product.html">
                                                        <img width="325" height="325" alt="T_4_front"
                                                            class="attachment-shop_catalog wp-post-image"
                                                            src="{{ asset($item->image) }}">
                                                        <b>{{ $item->name }}</b>
                                                        <span class="price"><span
                                                                class="amount">{{ number_format($item->price) . ' VNĐ' }}</span></span>
                                                    </a>

                                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku=""
                                                        data-product_id="22" rel="nofollow" href="single-product.html">Xem
                                                        Sản Phẩm</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

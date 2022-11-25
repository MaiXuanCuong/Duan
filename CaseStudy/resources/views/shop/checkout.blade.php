@extends('shop.home')
@section('content')

    <div class="container">
        <div class="single-product-area">
            <div class="col-md-12">
                <form action="{{ route('order') }}" method="post">
                    @csrf
                    <div id="customer_details">
                        <div class="row">

                            <div class="col-6">
                                <div style="margin-left: 5px">
                                    <h3>Thông tin đặt hàng</h3>
                                    <p id="billing_country_field"
                                        class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                        <label class="" for="billing_country">Tên khách hàng <abbr title="required"
                                                class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="name" name="name_customer"
                                            class="input-text">
                                            @error('name_customer')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </p>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <p id="billing_last_name_field"
                                                    class="form-row form-row-last validate-required">
                                                    <label class="" for="billing_last_name">Tỉnh/Thành Phố<abbr
                                                            title="required" class="required">*</abbr>
                                                    </label>
                                                    <select name="province_id" id="province_id" class="province_id"
                                                        aria-label="Default select example" data-toggle="select2">
                                                        <option selected="" value="">Chọn Tỉnh/Thành Phố</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}">{{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('province_id')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <p id="billing_last_name_field"
                                                    class="form-row form-row-last validate-required">
                                                    <label class="" for="billing_last_name">Quận/Huyện<abbr
                                                            title="required" class="required">*</abbr>
                                                    </label>
                                                    <select name="district_id" id="district_id" class="district_id"
                                                        aria-label="Default select example">
                                                        <option selected="" value="">Chọn Quận/Huyện</option>
                                                    </select>
                                                    @error('district_id')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <p id="billing_last_name_field"
                                                    class="form-row form-row-last validate-required">
                                                    <label class="" for="billing_last_name">Xã/Phường<abbr
                                                            title="required" class="required">*</abbr>
                                                    </label>
                                                    <select name="ward_id" class="ward_id"
                                                        aria-label="Default select example" id="ward_id">
                                                        <option selected="" value="">Chọn Xã/Phường</option>
                                                    </select>
                                                    @error('ward_id')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                        <label class="" for="billing_first_name">Nơi nhận hàng<abbr title="required"
                                                class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="address" name="address"
                                            class="input-text ">
                                            @error('address')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                    </p>

                                    <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                        <label class="" for="billing_last_name">Số điện thoại<abbr title="required"
                                                class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" placeholder="" id="billing_last_name"
                                            name="phone" class="input-text ">
                                            @error('phone')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                    </p>
                                    <div class="clear"></div>

                                    <p id="billing_company_field" class="form-row form-row-wide">
                                        <label class="" for="billing_company">Ghi chú</label>
                                        <textarea type="text" cols="6" rows="6" placeholder="" id="billing_company" name="note"
                                            class="input-text "></textarea>
                                    </p>


                                </div>

                            </div>


                            <div class="col-6">
                                <h3 id="order_review_heading">Bạn đặt hàng</h3><br>

                                <div id="order_review">
                                    <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="product-name"><small>Sản phẩm</small></th>
                                                <th class="product-name"><small>Tổng tiền</small></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset(Auth()->guard('customers')->user()->name))
                                                @if (isset($carts) && count($carts) > 0)
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($carts as $product_cart)
                                                        <tr class="cart_item">
                                                            <td><img width="80" height="80"
                                                                alt="poster_1_up" class="shop_thumbnail"
                                                                src="{{ asset($product_cart['image']) }}"></td>
                                                            <td class="product-name">
                                                                <small>{{ $product_cart['name'] }}</small><strong
                                                                    class="product-quantity"><br> ×
                                                                    {{ $product_cart['quantity'] }}</strong>
                                                            </td>
                                                            <td class="product-total">
                                                                <span
                                                                    class="amount">{{ number_format($product_cart['price'] * $product_cart['quantity']) . ' VNĐ' }}</span>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $total += $product_cart['price'] * $product_cart['quantity'];
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            @endif

                                        </tbody>
                                        <tfoot>

                                            <tr class="cart-subtotal">
                                                <th><small>Tổng phụ giỏ hàng</small></th>
                                                <td colspan="2"><span
                                                        class="amount">{{ number_format($total) . ' VNĐ' }}</span>
                                                </td>
                                            </tr>

                                            <tr class="shipping">
                                                <th><small>Vận chuyển và xử lý</small></th>
                                                <td colspan="2">

                                                    Miễn phí vận chuyển

                                                </td>
                                            </tr>


                                            <tr class="order-total">
                                                <th><small>Tổng thanh toán</small></th>
                                                <td colspan="2"><strong><span
                                                            class="amount">{{ number_format($total) . ' VNĐ' }}</span></strong>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                    <div style="text-align: center">
                                        <button type="submit">Đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '.province_id, .add_user', function() {
                var province_id = $(this).val();
                var district_name = $('.district_id').find('option:selected').text();
                $.ajax({
                    url: "{{ route('customer.GetDistricts') }}",
                    type: "GET",
                    data: {
                        province_id: province_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Bấm để chọn</option>';
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
                    url: "{{ route('customer.getWards') }}",
                    type: "GET",
                    data: {
                        district_id: district_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Bấm để chọn</option>';
                        $.each(data, function(key, v) {
                            html += '<option value =" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#ward_id').html(html);
                    }
                })
            });
        });
    </script>
@endsection

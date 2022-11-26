@extends('admin.layouts.master')
@section('content')
  <div class="pagetitle">
    <h1>Trang chủ</h1>
  </div>
<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <a style="text-decoration: none">
        <div class="col-xl-6 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h4 class="card-title">Đơn Hàng</h4>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6 class="card-title">{{ $totalOrders }} <span>Đơn</span></h6>
                  <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>

          </div>  </a>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-6 col-md-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Doanh Thu</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6 class="card-title">{{ number_format($totalPrice) }} <span>VNĐ</span></h6>
                  <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <a style="text-decoration: none">
        <div class="col-xxl-12 col-xl-12">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Khách Hàng</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6 class="card-title">{{ $totalCustomer }} <span>Người</span> </h6>
                  <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                </div>
              </div>
            </div>
          </div>  </a>
        </div><!-- End Customers Card -->

        <!-- Top Selling -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">
            <div class="card-body pb-0">
              <h5 class="card-title">Top 5 Sản Phẩm<span>| Bán Chạy</span></h5>

              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Sản Phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Đã Bán</th>
                    <th scope="col">Doanh Thu</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($topProducts))
                  @foreach($topProducts as $product)
                  <tr>
                    <th scope="row"><a href="{{ route('products.show',$product->id) }}"><img src="{{ asset($product->image) }}" alt=""></a></th>
                    <td><a data-bs-toggle="tooltip" data-bs-placement="top" title="Chi Tiết Sản Phẩm" href="{{ route('products.show',$product->id) }}" class="text-primary fw-bold">{{ $product->name }}</a></td>
                    <td><i data-bs-toggle="tooltip" data-bs-placement="top" title="Giá Sản Phẩm">{{ number_format($product->price) }} <span class="badge bg-success rounded-pill">VNĐ</span></i></td>
                    <td class="fw-bold"><i data-bs-toggle="tooltip" data-bs-placement="top" title="Số Lượng"><span class="badge bg-success rounded-pill">{{$product->totalProduct}} Chiếc</span></i></td>
                    <td><i data-bs-toggle="tooltip" data-bs-placement="top" title="Doanh Thu">{{number_format($product->totalPrice)}} <span class="badge bg-success rounded-pill">VNĐ</span></i></td>
                  </tr>
                  @endforeach
                 @endif
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Top Selling -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      <!-- Recent Activity -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Top 5 Khách Hàng <span>| Thân Thiết</span></h5>

          <div class="activity">
            @if(isset($topCustomer))
            @foreach($topCustomer as $customer)
            <div class="activity-item d-flex">
              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
              <div class="activity-content">
               {{ $customer->name }} Thanh Toán <b data-bs-toggle="tooltip" data-bs-placement="top" title="Khách Hàng Đã Thanh Toán">{{ number_format($customer->totalOrder) }}</b><span class="badge bg-success rounded-pill">VNĐ</span>
              </div>
            </div><!-- End activity item-->
            @endforeach
            @endif


          </div>

        </div>
      </div><!-- End Recent Activity -->
        <div class="card-body pb-0">
          <h5 class="card-title">Báo Cáo <span>| Doanh Thu</span></h5>

          <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                legend: {
                  data: ['Mua Vào', 'Bán Ra']
                },
                radar: {
                  // shape: 'circle',
                  indicator: [{
                      name: 'Bán hàng',
                      max: 6500
                    },
                    {
                      name: 'Quản Lý',
                      max: 16000
                    },
                    {
                      name: 'Công Nghệ',
                      max: 30000
                    },
                    {
                      name: 'Hỗ Trợ Khách Hàng',
                      max: 38000
                    },
                    {
                      name: 'Phát Triển',
                      max: 52000
                    },
                    {
                      name: 'Tiếp Thị',
                      max: 25000
                    }
                  ]
                },
                series: [{
                  name: 'Budget vs spending',
                  type: 'radar',
                  data: [{
                      value: [4200, 3000, 20000, 35000, 50000, 18000],
                      name: 'Mua Vào'
                    },
                    {
                      value: [5000, 14000, 28000, 26000, 42000, 21000],
                      name: 'Bán Ra'
                    }
                  ]
                }]
              });
            });
          </script>

        </div>
      </div><!-- End Budget Report -->


</section>
@endsection
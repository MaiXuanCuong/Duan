@extends('admin.layouts.master')
@section('content')
@if (Auth::user()->hasPermission('Product_view'))
<div  class="flex-center position-ref full-height">
    <div  class="content container">
        <div class="title m-b-md">
            <div class="pagetitle">
                <h1>Chi Tiết Sản Phẩm</h1>
                <nav>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><b>Sản Phẩm</b></li>
                  </ol>
                </nav>
              </div>
              @if (Auth::user()->hasPermission('Product_viewAny'))
              <a class="btn btn-primary" href="{{ route('products') }}">Trở Về</a>
          @endif
          
              <section class="section">
                <br>
                <div class="row">
                  <div style="text-align: center" class="col-lg-12">
                    <div class="card">
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                                <th width="10%" ><i>Sản Phẩm</i><hr></th>
                                <th width="10%"><i>Danh Mục</i><hr></th>
                                <th width="30%"><i>Cấu Hình</i><hr></th>
                                <th width="15%"><i>Người Thêm</i><hr></th>
                                <th width="15%"><i>Giá</i><hr></th>
                                <th width="10%"><i>Số Lượng</i><hr></th>
                                <th width="30%"><i>Ảnh</i><hr></th>
                            
                            </tr>
                          </thead>
                          
                          <tbody>
                            <tr>
                                <td>
                                    <i>{{ $items->name }} </i>  
                                </td>
                                <td>
                                  @if (isset($items->category->name))
                                    <i>{{ $items->category->name }}</i>
                                    @else 
                                   <i>Đã Bị Xóa</i>
                                    @endif
                                </td>
                                <td>
                                    <i>{{ $items->configuration }}  </i> 
                                </td>
                                <td>
                                    <i><b>{{ $items->user->name }} </b> </i> 
                                </td>
                                <td>
                                    <i>{{ number_format($items->price)." VNĐ" }}  </i> 
                                </td>
                                <td>
                                    <i>{{ $items->quantity }}  </i> 
                                </td>
                                <td>
                                   <img width="100px" height="120px" src="{{asset($items->image)}}" alt="">    
                                </td>
                            </tr>
                         
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
@endif
@endsection
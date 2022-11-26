@extends('admin.layouts.master')
@section('content')
        <div class="pagetitle">
            <h1>Khách Hàng</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Khách Hàng</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                <h5 class="card-title">Danh Sách Khách Hàng</h5>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                @if (Session::has('success'))
                <p class="text-success"><i class="fa fa-check" aria-hidden="true"></i>
                    {{ Session::get('success') }}
                </p>
            @endif
            @if (Session::has('error'))
                <p class="text-danger"><i class="bi bi-x-circle"></i>
                    {{ Session::get('error') }}
                </p>
            @endif
                <div style="text-align: right" class="md-3 title_cate" >
                </div>
                <table style="text-align: center" class="table table-hover">
                    @if (!$customers->count())
                        <tr>
                            <td colspan="6">Danh Sách Rỗng!</td>
                        </tr>
                    @else
                        <thead>

                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Họ Và Tên</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr class="item-{{ $customer->id }}">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>@if(Auth::user()->hasPermission('Customer_view'))
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Chi Tiết Khách Hàng" href="{{ route('customer.show',$customer->id) }}">
                                         @endif
                                    {{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                     
                                    </td>
                                </tr>
                            @endforeach
                    @endif
                    </tbody>
                </table>
                    <div style="float: right">
                        {{ $customers->appends(request()->all())->links() }}
                    </div>
            </div>
        </div>
    </div>
 @endsection
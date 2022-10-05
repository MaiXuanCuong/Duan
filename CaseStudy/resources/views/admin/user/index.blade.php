@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Admin_viewAny'))
        <div class="pagetitle">
            <h1>Danh Sách User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><b>Danh Sách User</b></li>
                    @if (Auth::user()->hasPermission('Admin_create'))
                        <li class="breadcrumb-item"><a href="{{ route('users.add') }}">Thêm User</a></li>
                    @endif
                    @if (Auth::user()->hasPermission('Admin_viewgc'))
                    <li class="breadcrumb-item"><a href="{{ route('users.garbageCan') }}">User Bị Cất Chức</a></li>
                @endif
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div style="text-align: center" class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i>Quản Trị Viên<b>*Thông Báo*</b></i></h5>
                            <p>Hãy <code>Cẩn Thận Với Những Thao Tác Của Bạn</code> ("Trừ Lương")</p>
                            <!-- Active Table -->
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Chức Vụ</th>
                                        @if ((Auth::user()->hasPermission('Admin_update')) || (Auth::user()->hasPermission('Admin_delete')))
                                        <th scope="col">Tùy chọn</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->count())
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $user->name }} </td>
                                                <td> {{ $user->email }} </td>

                                                <td>
                                                    @if (isset($user->roles[0]['display_name']))
                                                        {{ $user->roles[0]['display_name'] }}
                                                    @else
                                                        Chưa Có Chức Vụ
                                                    @endif
                                                </td>
                                                <td>
                                                        @if (Auth::user()->hasPermission('Admin_update'))
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn btn-primary">Cập Nhật</a>
                                                        @endif
                                                    @if ($user->id != 1)
                                                        @if (Auth::user()->hasPermission('Admin_delete'))
                                                            <a 
                                                                data-url="{{ route('users.destroy', $user->id) }}"
                                                                class="btn btn-danger ajax_delete">
                                                                Cất Chức
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="4" class="text-center">Empty</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

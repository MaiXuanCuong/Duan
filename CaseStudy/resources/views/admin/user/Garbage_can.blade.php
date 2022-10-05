@extends('admin.layouts.master')
@section('content')
    @if (Auth::user()->hasPermission('Admin_viewgc'))

        <body>
            <div class="flex-center position-ref full-height">
                <div class="content container">
                    <div class="title m-b-md">
                        <div class="pagetitle">
                            <h1>Thùng Rác</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="{{ route('/') }}">Trang Chủ</a></li> --}}
                                    @if (Auth::user()->hasPermission('Admin_viewAny'))
                                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Danh Sách User</a></li>
                                    @endif
                                    @if (Auth::user()->hasPermission('Admin_create'))
                                        <li class="breadcrumb-item"><a href="{{ route('users.add') }}">Thêm User</a>
                                        </li>
                                    @endif
                                    <li class="breadcrumb-item"><b style="color: red">User Bị Cất Chức</b></li>
                                </ol>
                            </nav>
                        </div><!-- End Page Title -->
                    </div><!-- End Page Title -->
                    <a class="btn btn-primary" href="{{ route('users') }}">Trở Về</a>
                    @if (Session::has('success'))
                        <p class="text-success">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            {{ Session::get('success') }}
                        </p>
                    @endif
                </div>
                <br>
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div style="text-align: center" class="card">
                                @if ($items->count())
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Chức Vụ</th>
                                            @if (Auth::user()->hasPermission('Admin_restore') || Auth::user()->hasPermission('Admin_forceDelete'))
                                                <th scope="col">Tùy chọn</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($items as $key => $user)
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
                                                    @if (Auth::user()->hasPermission('Admin_restore') || Auth::user()->hasPermission('Admin_forceDelete'))
                                                        <td>
                                                            {{-- <form action="{{ route('categories.forceDelete',$item->id) }}" method="post"> --}}
                                                            {{-- <i><a class="btn btn-primary" href="{{ route('categories.restore',$item->id) }}">Lấy lại</a></i> --}}
                                                            @if (Auth::user()->hasPermission('Admin_restore'))
                                                                <a href="{{ route('users.restore', $user->id) }}"
                                                                    data-url="{{ route('users.restore', $user->id) }}"
                                                                    class="btn btn-primary ajax_restore">
                                                                    Bỏ Đình Chỉ
                                                                </a>
                                                            @endif
                                                            @if (Auth::user()->hasPermission('Admin_forceDelete'))
                                                                <a 
                                                                    data-url="{{ route('users.forceDelete', $user->id) }}"
                                                                    class="btn btn-danger ajax_delete">
                                                                    Đuổi Việc
                                                                </a>
                                                            @endif
                                                            {{-- @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" onclick="return confirm('Bạn Chắc Chắn Xóa {{ $item->name }}')" type="submit"><i>Xóa</i></button><hr>    
                                            </form> --}}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <b colspan="4" class="text-center">Không Có User Bị Cất Chức!</b>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
    @endif
    </section>
    {{ $items->appends(request()->all())->links() }}
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    </body>

    </html>
@endsection

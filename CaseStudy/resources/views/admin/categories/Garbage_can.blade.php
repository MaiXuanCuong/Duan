@extends('admin.layouts.master')
@section('content')
<body>
<div  class="flex-center position-ref full-height">
    <div  class="content container">
        <div class="title m-b-md">
            <h1>Thùng Rác</h1>
            <a class="btn btn-primary" href="{{ route('categories') }}">Trở Về</a>
            @if (Session::has('success'))
            <p class="text-success">
                <i class="fa fa-check" aria-hidden="true"></i>
                {{ Session::get('success') }}
            </p>
        @endif
        </div>
        <br>
        <table style="text-align:center ;background-color: rgba(255, 255, 255, 0)" class="table-hover table">
            <tr>
                
                <th ><i>STT</i></td>
                <th width="30%"><i>Tên Danh Mục</i></th>
                <th width="40%"><i>Ảnh</i></th>
                <th width="50%"><i>Thao Tác</i></th>
            </tr>
            @if($items->count())
        @foreach($items as $key => $item)
         
        <tr>

            <td >
                <i >{{ $key + 1 }} </i>  

            </td>
            <td>

                <i>{{ $item->name }} </i>  
            </td>
            <td>
               <img width="100px" height="120px" src="{{ asset($item->image) }}" alt="">    
            </td>
          
            <td>
                {{-- <form action="{{ route('categories.forceDelete',$item->id) }}" method="post"> --}}
                    {{-- <i><a class="btn btn-primary" href="{{ route('categories.restore',$item->id) }}">Lấy lại</a></i> --}}
                    <a href="{{ route('categories.restore',$item->id) }}"
                        data-url="{{ route('categories.restore',$item->id) }}"
                        class="btn btn-primary ajax_restore">
                        Lấy Lại
                    </a>
                    <a href="{{ route('categories.forceDelete',$item->id) }}"
                        data-url="{{ route('categories.forceDelete',$item->id) }}"
                        class="btn btn-danger ajax_delete">
                        Xóa
                    </a>
                    {{-- @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="return confirm('Bạn Chắc Chắn Xóa {{ $item->name }}')" type="submit"><i>Xóa</i></button><hr>    
                </form> --}}
                
            </td>
            
        </tr>
        
        @endforeach
        @else
        <tr>
            <th colspan="4" class="text-center">Thùng Rác Trống!</th>
        </tr>
    @endif
    </table>
        
    </div>
</div>
{{ $items->appends(request()->all())->links() }}
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>

@endsection
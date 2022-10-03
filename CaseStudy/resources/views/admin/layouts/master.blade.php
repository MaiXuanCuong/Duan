<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('admin/assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('admin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('admin/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    b{
      color: red;
    }
    hr{
      color:azure;
    }
  </style>
</head>

<body>

  @include('admin.layouts.includes.header')
  @include('admin.layouts.includes.sidebar')

  <main id="main" class="main">
    @section('title')
    @include('sweetalert::alert')
    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  
  @include('admin.layouts.includes.footer')
  <!-- End Footer -->
  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 <!-- jQuery -->
 <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
 <!-- Bootstrap 4 -->
 <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
  <!-- Vendor JS Files -->
  {{-- @yield('js') --}}
  <script>
    $('.checkbox_parent').on('click', function(){
        $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'))
    });
    $('.checkbox_all').on('click', function(){
        $(this).parents('.form').find('.checkbox_all_childrent').prop('checked', $(this).prop('checked'))
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin\product\index\index.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/chart.js')}}/chart.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('admin/assets/js/main.js')}}"></script>
  <script>
    jQuery(document).ready(function() {
      if( $('#blah').hide()){
        $('#blah').hide();
      }
        jQuery('#imgInp').change(function() {
            $('#blah').show();
            const file = jQuery(this)[0].files;
            if (file[0]) {
                jQuery('#blah').attr('src', URL.createObjectURL(file[0]));
                jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
            }
        });
    });
    
</script>
<script type="text/javascript">
  $(function() {
      $(document).on('change', '.province_id, .add_user', function() {
          var province_id = $(this).val();
          var district_name = $('.district_id').find('option:selected').text();
          $.ajax({
              url: "{{ route('user.GetDistricts') }}",
              type: "GET",
              data: {
                  province_id: province_id
              },
              success: function(data) {
                  console.log(data);
                  var html = '<option value="">Open this select menu</option>';
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
              url: "{{ route('user.getWards') }}",
              type: "GET",
              data: {
                  district_id: district_id
              },
              success: function(data) {
                  console.log(data);
                  var html = '<option value="">Open this select menu</option>';
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
<script>
  $(function() {
      $('#search').on('keyup' , function() {
          var search = $(this).val();
          var url = $(this).data('url')
          $.ajax({
              type: "get",
              url: url,
              data: {
                  search: search
              },
              dataType: 'json',
              success: function(response) {
                  $('#list_categories').html(response);
              }
          });
      })
  });
  $("#search").keyup(function(){
    setTimeout(() => {
				$("#submit").click();
			}, 2500);
});
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
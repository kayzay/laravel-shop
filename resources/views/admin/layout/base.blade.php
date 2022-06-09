<!DOCTYPE html>
<html lang="en">
<x-head/>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img
            class="animation__shake"
            src="{{asset('img/AdminLTELogo.png')}}"
            alt="AdminLTELogo"
            height="60"
            width="60">
    </div>

    <!-- Navbar -->
    <x-header/>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <x-left-menu/>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-content-header name="{{isset($h1Name) ? $h1Name : ''}}"/>

        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{--<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>--}}
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
{{--<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>--}}
<!-- Sparkline -->
{{--<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>--}}
<!-- JQVMap -->
{{--<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>--}}
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script>
    let _tocken =  $('input[name="_token"]').val(),
        GoAjax = {
            beforeSend: function(){},
            data: {},
            send: function (link, method, success, error) {
                console.log(_tocken);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': _tocken },
                    type: method,
                    url: link,
                    data: GoAjax.data,
                    dataType: 'json',
                    beforeSend: GoAjax.beforeSend,
                    success: success,
                    error: error
                });
            }
        };
</script>
<!-- AdminLTE App -->
<script src="{{asset('js/admin/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="{{asset('js/admin/demo.js')}}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{asset('js/admin/dashboard.js')}}"></script>--}}
@yield('footerJs')
</body>
</html>


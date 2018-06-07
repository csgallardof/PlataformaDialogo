<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
        <title>Inteligencia Productiva - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="Sistema de Inteligencia Productiva MIPRO" name="description" />
        <meta content="Ministerio de Industrias y Productividad" name="author" />

        @section('head')
            <!-- ================== BEGIN BASE CSS STYLE ================== -->
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
            <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
            <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
            <!-- ================== END BASE CSS STYLE ================== -->
        @show

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        @section('start_css')
            <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
            <link href="{{ asset('plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
            <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
            <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
            <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
            <link href="{{ asset('css/theme/default.css') }}" rel="stylesheet" id="theme" />
            <link href="{{ asset('css/inteligencia.css') }}" rel="stylesheet" />
            
                @show
        <!-- ================== END BASE JS ================== -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109787903-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'UA-109787903-1');
        </script>
    @yield('start_css2')
</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51">

    <div id="page-container" class="fade">
            @include ('layouts.menu_admin')
            <br><br><br><br><br><br>
            @yield ('content')
            @include ('layouts.common_modals')
            @include ('layouts.footer')
    </div>

    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

    @section('end_js')
            <!-- ================== BEGIN BASE JS ================== -->
            <script src="{{ asset('plugins/jquery/jquery-1.9.1.min.js') }}"></script>
            <script src="{{ asset('plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
            <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
            <!--[if lt IE 9]>
              <script src="{{ asset('crossbrowserjs/html5shiv.js') }}"></script>
              <script src="{{ asset('crossbrowserjs/respond.min.js') }}"></script>
              <script src="{{ asset('crossbrowserjs/excanvas.min.js') }}"></script>
            <![endif]-->
            <script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
            <script src="{{ asset('plugins/scrollMonitor/scrollMonitor.js') }}"></script>
            <!-- ================== END BASE JS ================== -->
            <script src="{{ asset('plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
            <script src="{{ asset('plugins/DataTables/js/jquery.dataTables.js') }}"></script>
            <script src="{{ asset('plugins/DataTables/js/dataTables.responsive.js') }}"></script>
            <script src="{{ asset('js/table-manage-responsive.demo.min.js') }}"></script>
            <script src="{{ asset('js/custom-mipro.js') }}"></script>
            <script src="{{ asset('js/apps.js') }}"></script>
            <script src="{{ asset('js/dashboard.js') }}"></script>
            <script src="{{ asset('js/dropdown.js') }}"></script>
            

    @show


    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('plugins/masked-input/masked-input.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/password-indicator/js/password-indicator.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js') }}"></script>
    <script src="{{ asset('plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/form-plugins.demo.min.js') }}"></script>
    <script src="{{ asset('js/apps.min.js') }}"></script>
    <script src="{{ asset('js/Solucion/comboSolucion.js') }}"></script>
    
    <script src="{{ asset('plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/js/dataTables.colReorder.js') }}"></script>
    <script src="{{ asset('plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{asset ('plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset ('plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset ('plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
    <script src="{{asset ('js/form-wysiwyg.demo.min.js')}}"></script>

    <script src="{{ asset('plugins/DataTablesv2/datatables.js') }}"></script>
    <script src="{{ asset('js/table-manage-responsive.demo.js') }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    

    <script>
        $(document).ready(function() {
            App.init();
            FormWysihtml5.init();
            FormPlugins.init();
            TableManageResponsive.init();
        });
    </script>
    @yield('init_scripts')


</body>
</html>
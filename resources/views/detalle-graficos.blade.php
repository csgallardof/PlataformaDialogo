@extends('layouts.main')

@section('title', 'Inicio')

@section('start_css')
  @parent
  
  <script src="{{asset('plugins/pace/pace.min.js')}}"></script>


   
@endsection

@section('contenido')

<div id="content" class="content">
            <!-- begin breadcrumb -->

            <!-- DESDE AQUI -->

            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <!-- end page-header -->

            <!-- begin row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="chart-js-2">
                                            <div class="panel-heading">
                                                    <h4 class="panel-title">Radar Chart</h4>
                                            </div>
                        <div class="panel-body">
                            <div>
                                <canvas id="bar-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- begin row -->
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">Radar Chart</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                <canvas id="radar-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">Radar Chart</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                <canvas id="radar-chartnew"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->

            <!-- begin row -->
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-5">
                        <div class="panel-heading">
                            <h4 class="panel-title">Pie Chart</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                <canvas id="pie-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end col-6 -->
                <!-- begin col-6 -->
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="chart-js-6">
                        <div class="panel-heading">
                            <h4 class="panel-title">Doughnut Chart</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                <canvas id="doughnut-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->
        </div>


@endsection

@section('end_js')
  @parent




  <script src="{{ asset('plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('js/table-manage-responsive.demo.min.js') }}"></script>
    <script src="{{ asset('js/custom-mipro.js') }}"></script>
    <script src="{{ asset('js/apps.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script src="{{ asset('/plugins/chart-jsv2.7.2/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/chart-jsv2.7.2/chartjs-plugin-datalabels/chartjs-plugin-datalabels.min.js') }}"></script>

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('js/apps.min.js') }}"></script>
    <script src="{{ asset('js/chart-js.demo.js') }}"></script>
    
    <!-- ================== END PAGE LEVEL JS ================== -->


@endsection

@section('init_scripts')

  <script>
        $(document).ready(function() {
            App.init();
            var ctxBAR = document.getElementById("bar-chart");
            ctxBAR.height = 100;
        });
    </script>
  <script>
function goBack() {
    window.history.back();
}
</script>

@endsection
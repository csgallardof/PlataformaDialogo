<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Chart JS</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<!-- end #page-loader -->

	<!-- begin #page-container -->

		<!-- end #header -->

		<!-- begin #sidebar -->
		<!-- end #sidebar -->

		<!-- begin #content -->
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
		<!-- end #content -->

		<!-- HASTA AQUI -->

        <!-- begin theme-panel -->


		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->

	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="assets/plugins/chart-jsv2.7.2/Chart.min.js"></script>
	<script src="assets/plugins/chart-jsv2.7.2/chartjs-plugin-datalabels/chartjs-plugin-datalabels.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/js/apps.min.js"></script>
	<script src="assets/js/chart-js.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			//ChartJs.init();

			// var divbar = document.getElementById("bar-chart");
			// divbar.height = 75;

		});
	</script>
</body>
</html>

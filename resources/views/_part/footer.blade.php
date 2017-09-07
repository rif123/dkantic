
	@include('_part.dialog')
	<!--   Core JS Files   -->
	<script src="{{asset('/') }}js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="{{asset('/') }}js/bootstrap.min.js" type="text/javascript"></script>
	<script src="{{asset('/') }}js/material.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('/') }}js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="{{asset('/') }}js/bootstrap-notify.js"></script>

	<!--  Google Maps Plugin    -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="{{asset('/') }}js/material-dashboard.js"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{asset('/') }}js/demo.js"></script>

	<script src="{{asset('/') }}js/custom.js"></script>
	<script type="text/javascript">
    	$(document).ready(function(){
			// Javascript method's body can be found in assets/js/demos.js
        	demo.initDashboardPageCharts();
    	});
	</script>
	@yield('script')

</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
    <base href="{{asset('')}}" >
    <title>Creative - Bootstrap Admin Template</title>

    <!-- Bootstrap CSS -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="admin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="admin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="admin/css/font-awesome.min.css" rel="stylesheet" />
      <script src="admin/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function(){
          $('#changePassword').change(function(){
            if ($(this).is(':checked')) {
              $('.password').removeAttr('disabled');
            }else {
              $('.password').attr('disabled','');
            }
          });
        });
      </script>
	<link href="admin/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="admin/css/fullcalendar.css">
	<link href="admin/css/widgets.css" rel="stylesheet">
    <link href="admin/css/style.css" rel="stylesheet">
    <link href="admin/css/style-responsive.css" rel="stylesheet" />
	<link href="admin/css/xcharts.min.css" rel=" stylesheet">
	<link href="admin/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- =======================================================
        Theme Name: NiceAdmin
        Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">


      @include('admin.layout.header')
      @include('admin.layout.sidebar')
      @yield('maincontent')



  </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="admin/js/jquery.js"></script>
	<script src="admin/js/jquery-ui-1.10.4.min.js"></script>

    <script type="text/javascript" src="admin/js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="admin/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="admin/js/jquery.scrollTo.min.js"></script>
    <script src="admin/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--script for this page only-->
    <script src="admin/js/calendar-custom.js"></script>
	<script src="admin/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="admin/js/jquery.customSelect.min.js" ></script>
	<script src="admin/assets/chart-master/Chart.js"></script>
  <!-- ck editor -->
    <script type="text/javascript" src="admin/assets/ckeditor/ckeditor.js"></script>
    <!--custome script for all page-->
    <script src="admin/js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="admin/js/sparkline-chart.js"></script>
    <script src="admin/js/easy-pie-chart.js"></script>
	<script src="admin/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="admin/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="admin/js/xcharts.min.js"></script>
	<script src="admin/js/jquery.autosize.min.js"></script>
	<script src="admin/js/jquery.placeholder.min.js"></script>
	<script src="admin/js/gdp-data.js"></script>
	<script src="admin/js/morris.min.js"></script>
	<script src="admin/js/sparklines.js"></script>
	<script src="admin/js/charts.js"></script>
	<script src="admin/js/jquery.slimscroll.min.js"></script>
  <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () {
            $(this.i).val(this.cv + '%')
          }
        })

      });


      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});


  </script>

  </body>
</html>

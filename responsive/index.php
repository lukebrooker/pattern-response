<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Pattern Response</title>

<!-- Mobile viewport optimization h5bp.com/ad -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width">
<!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
<meta http-equiv="cleartype" content="on">
<!-- Styles just for pattern response -->
<link rel="stylesheet" href="../pattern-response/css/styles.css">

<style type="text/css">
	body.pat-res {
		height: 95%;
		width: 100%;
		padding-top: 40px;
		background: #eee;
		-webkit-transition: width 0.5s ease-out;
		-moz-transition: width 0.5s ease-out;
		-ms-transition: width 0.5s ease-out;
		-o-transition: width 0.5s ease-out;
		transition: width 0.5s ease-out;
	}
	iframe.page {
		box-shadow: 0 1px 5px rgba(0,0,0,0.25);
	}
</style>

</head>
<body onload="prettyPrint()" data-spy="scroll" class="pat-res pat-res-no-code">
<nav class="pat-res-nav">
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<ul class="nav pull-right">
				<li class="dropdown pat-res-screen-size">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>Screen Size</span><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="fluid">Fluid</a></li>
						<li><a href="320">320px (iPhone - Portrait)</a></li>
						<li><a href="480">480px (iPhone - Landscape)</a></li>
						<li><a href="768">768px (iPad - Portrait)</a></li>
						<li><a href="1024">1024px (iPad - Landscape)</a></li>
						<li><a href="1280">1280px (Common Laptop Width)</a></li>
						<li><a href="1366">1366px (Common Laptop Width)</a></li>
						<li><a href="1440">1440px (Common Laptop Width)</a></li>
						<li><a href="1680">1680px (Common Width)</a></li>
						<li><a href="1920">1920px (Common Width)</a></li>
					</ul>
				</li>
				<li><a href="../">Back</a></li>
			</ul>
		</div>
	</div>
</div>
</nav>
<iframe src="../index.php" class="page" frameborder="0" style="width: 100%; height: 100%;"></iframe>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="../pattern-response/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="../pattern-response/js/bootstrap-scrollspy.js"></script>
<script type="text/javascript" src="../pattern-response/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="../pattern-response/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="../pattern-response/google-code-prettify/prettify.js"></script>
<script type="text/javascript">

$(function() {
	
	// Change screen width
	$('.pat-res-screen-size li a').click(function(e) {
		e.preventDefault();
		var screenWidth = $(this).attr('href');
		if (screenWidth == 'fluid') {
			$('body.pat-res').removeAttr('style');
		}
		else {
	  	$('body.pat-res').css('width', screenWidth);
	  }
	});

});
	
</script>

</body>
</html>
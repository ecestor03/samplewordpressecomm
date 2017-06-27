
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tiny Carousel v2.1.8: A lightweight jQuery plugin</title>
	<link rel="stylesheet" href="tinycarousel.css" type="text/css" media="screen"/>

	<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="jquery.tinycarousel.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
	</script>

</head>
<body>
	<div id="slider1">
		<a class="buttons prev" href="#">&#60;</a>
		<div class="viewport">
			<ul class="overview">
				<li><img src="images/picture6.jpg" /></li>
				<li><img src="images/picture5.jpg" /></li>
				<li><img src="images/picture4.jpg" /></li>
				<li><img src="images/picture3.jpg" /></li>
				<li><img src="images/picture2.jpg" /></li>
				<li><img src="images/picture1.jpg" /></li>
			</ul>
		</div>
		<a class="buttons next" href="#">&#62;</a>
	</div>
</body>
</html>

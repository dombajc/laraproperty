<?php $app = App\Aplikasi::getApp(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Udema a modern educational site template">
    <meta name="author" content="Ansonika">
    <title>{{ $app->title }}</title>

    <!-- BASE CSS -->
    <link href="{{ url('online3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('online3/css/style.css') }}" rel="stylesheet">
	<link href="{{ url('online3/css/vendors.css') }}" rel="stylesheet">
	<link href="{{ url('online3/css/all_icons.min.css') }}" rel="stylesheet">
	
    <!-- YOUR CUSTOM CSS -->
	<link href="{{ url('online3/css/custom.css') }}" rel="stylesheet">
	
	
	<!-- COMMON SCRIPTS -->
    <script src="{{ url('online3/js/jquery-2.2.4.min.js') }}"></script>
</head>

<body>
	
	<div id="page">
	
	<header class="header menu_2">
		<div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
		<div id="logo">
			<a href="index.html">{{ $app->nm_judul }}</a>
		</div>
		
		<!-- /top_menu -->
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<nav id="menu" class="main-menu">
			<ul>
				<li><span><a href="{{ url('/') }}">Home</a></span></li>
				<li><span><a href="{{ url('/products') }}">Produk</a></span></li>
				<li><span><a href="{{ url('/news') }}">Berita</a></span></li>
				<li><span><a href="{{ url('/aboutus') }}">Tentang Kami</a></span></li>
			</ul>
		</nav>
	</header>
	<!-- /header -->
		
	@yield('content')
	
	<footer>
		<div class="container margin_120_95">
			<div class="row">
				<div class="col-lg-8 col-md-6 p-r-5">
					<p>{{ $app->nm_judul }}</p>
					<p>{{ $app->desc }}</p>
					<div class="follow_us">
						<ul>
							<li>Follow us</li>
							<li><a href="#0"><i class="ti-facebook"></i></a></li>
							<li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
							<li><a href="#0"><i class="ti-google"></i></a></li>
							<li><a href="#0"><i class="ti-pinterest"></i></a></li>
							<li><a href="#0"><i class="ti-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<h5>Contact with Us</h5>
					<ul class="contacts">
						<li><a href="tel://61280932400"><i class="ti-mobile"></i>{{ $app->telp }}</a></li>
						<li><a href="tel://61280932400"><i class="ti-mobile"></i>{{ $app->fax }}</a></li>
						<li><a href="/cdn-cgi/l/email-protection#dab3b4bcb59aafbebfb7bbf4b9b5b7"><i class="ti-email"></i> <span class="__cf_email__" data-cfemail="b9d0d7dfd6f9ccdddcd4d897dad6d4">{{ $app->email }}</span></a></li>
					</ul>
				</div>
			</div>
			<!--/row-->
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div id="copy">© 2018 Pesankode.com</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
    <script src="{{ url('online3/js/common_scripts.js') }}"></script>
    <script src="{{ url('online3/js/main.js') }}"></script>
	<script src="{{ url('online3/js/validate.js') }}"></script>
</body>
</html>
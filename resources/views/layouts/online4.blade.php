<?php $app = App\Aplikasi::getApp(); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	
	<!-- Page Title -->
	<title>{{ $app->nm_judul }}</title>
	
	<meta name="keywords" content="{{ $app->keyword }}" />
	<meta name="description" content="{{ $app->desc }}" />
	<meta name="author" content="pesankode.com" />
	
	<!-- Mobile Meta Tag -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Fav and touch icons 
	<link rel="shortcut icon" type="image/x-icon" href="images/fav_touch_icons/favicon.ico" />
	<link rel="apple-touch-icon" href="images/fav_touch_icons/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/fav_touch_icons/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/fav_touch_icons/apple-touch-icon-114x114.png" />
	
	<!-- IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
	<![endif]-->
	
	<!-- Google Web Font -->
	<link href="http://fonts.googleapis.com/css?family=Raleway:300,500,900%7COpen+Sans:400,700,400italic" rel="stylesheet" type="text/css" />
	
	<!-- Bootstrap CSS -->
    <link href="{{ url('online4/css/bootstrap.min.css') }}" rel="stylesheet" />
	
    <!-- Revolution Slider CSS settings -->
    <link rel="stylesheet" type="text/css" href="{{ url('online4/css/settings.css') }}" media="screen" />
	
	<!-- Template CSS -->
	<link href="{{ url('online4/css/style.css') }}" rel="stylesheet" />
	
	<!-- Modernizr -->
	<script src="{{ url('online4/js/modernizr-2.8.1.min.js') }}"></script>
	<script src="{{ url('online4/js/common.js') }}"></script>
</head>
<body>
	<!-- BEGIN WRAPPER -->
	<div id="wrapper">
	
		<!-- BEGIN HEADER -->
		<header id="header">
			<div id="top-bar">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<ul id="top-info">
								<li>Phone: {{ $app->telp }}</li>
								<li>Email: <a href="mailto:{{ $app->email }}">{{ $app->email }}</a></li>
							</ul>
							
							<ul id="top-buttons">
								<li><a href="{{ url('log-in') }}"><i class="fa fa-sign-in"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
			<div id="nav-section">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<a href="index.html" class="nav-logo"><img src="images/logo.png" alt="Cozy Logo" style="display:none;" />{{ $app->title }}</a>
							
							<!-- BEGIN MAIN MENU -->
							<nav class="navbar">
								<button id="nav-mobile-btn"><i class="fa fa-bars"></i></button>
								
								<ul class="nav navbar-nav">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('properties') }}">Properties</a></li>
									<li class="dropdown">
										<a href="#" data-toggle="dropdown" data-hover="dropdown">News<b class="caret"></b></a>
										<ul class="dropdown-menu">
											{{ App\Kategori::show_as_menu() }}
										</ul>
									</li>
									<li><a href="{{ url('contactus') }}">Hubungi Kami</a></li>
								</ul>
							
							</nav>
							<!-- END MAIN MENU -->
							
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- END HEADER -->
		
	@yield('content')
	
	<!-- BEGIN FOOTER -->
	<footer id="footer">
			<div id="footer-top" class="container">
				<div class="row">
					<div class="block col-sm-3">
						<a href="{{ url('/') }}"><img src="images/logo.png" alt="Cozy Logo" style="display:none;" />Rumahsubsidiceria.com</a>
						<br><br>
						<p>{{ $app->about }}</p>
					</div>
					<div class="block col-sm-3">
						<h3>Contact Info</h3>
						<ul class="footer-contacts">
							<li><i class="fa fa-map-marker"></i> {{ $app->alamat }} </li>
							<li><i class="fa fa-phone"></i> {{ $app->telp }} </li>
							<li><i class="fa fa-envelope"></i> <a href="mailto:{{ $app->email }}">{{ $app->email }}</a></li>
						</ul>
					</div>
					<!--
					<div class="block col-sm-3">
						<h3>Helpful Links</h3>
						<ul class="footer-links">
							<li><a href="properties-list.html">All Properties Available</a></li>
							<li><a href="agent-listing.html">Look for an Agent</a></li>
							<li><a href="agency-listing.html">Look for an Agency</a></li>
							<li><a href="pricing-tables.html">See our Pricing Tables</a></li>
						</ul>
					</div>
					<div class="block col-sm-3">
						<h3>Latest Listings</h3>
						<ul class="footer-listings">
							<li>
								<div class="image">
									<a href="properties-detail.html"><img src="images/property1.jpg" alt="" /></a>
								</div>
								<p><a href="properties-detail.html">Luxury Apartment with great views<span>+</span></a></p>
							</li>
							<li>
								<div class="image">
									<a href="properties-detail.html"><img src="images/property2.jpg" alt="" /></a>
								</div>
								<p><a href="properties-detail.html">Stunning Villa with 5 bedrooms<span>+</span></a></p>
							</li>
							<li>
								<div class="image">
									<a href="properties-detail.html"><img src="images/property3.jpg" alt="" /></a>
								</div>
								<p><a href="properties-detail.html">Recent construction with 3 bedrooms.<span>+</span></a></p>
							</li>
						</ul>
					</div>
					-->
				</div>
			</div>
			
			
			<!-- BEGIN COPYRIGHT -->
			<div id="copyright">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							&copy; 2018 rumahsubsidiceria.com. All rights reserved. Developed by <a href="http://www.pesankode.com" target="_blank">Pesankode.com</a>
							
							<!-- BEGIN SOCIAL NETWORKS 
							<ul class="social-networks">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube"></i></a></li>
								<li><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
							 END SOCIAL NETWORKS -->
						
						</div>
					</div>
				</div>
			</div>
			<!-- END COPYRIGHT -->
			
		</footer>
		<!-- END FOOTER -->
	
	</div>
	<!-- END WRAPPER -->
	
    <!-- BEGIN TEMPLATE SETTINGS PANEL -->
    <!--
	<div id="template-settings">
		<i class="fa fa-cog"></i>
		
		<h4>Color: *</h4>
		<input class="minicolors" type="text" name="color-picker" value="df4a43" />
		
		<h4>PATTERN:</h4>
		<div class="settings-pattern">
			<span class="pattern1_icon selected" id="pattern1"></span>		
			<span class="pattern2_icon" id="pattern2"></span>
			<span class="pattern3_icon" id="pattern3"></span>
			<span class="pattern4_icon" id="pattern4"></span>
			<span class="pattern5_icon" id="pattern5"></span>
			<span class="pattern6_icon" id="pattern6"></span>
			<span class="pattern7_icon" id="pattern7"></span>
			<span class="pattern8_icon" id="pattern8"></span>
			<span class="pattern9_icon" id="pattern9"></span>
		</div>
		
		<div>* May not be fully accurate!</div>
    </div>
    -->
	<!-- END TEMPLATE SETTINGS PANEL -->

	
	<!-- Libs -->
	
    <script src="{{ url('online4/js/owl.carousel.min.js') }}"></script>
	<script src="{{ url('online4/js/chosen.jquery.min.js') }}"></script>
	
	<!-- jQuery Revolution Slider -->
    <script type="text/javascript" src="{{ url('online4/js/jquery.themepunch.tools.min.js') }}"></script>   
    <script type="text/javascript" src="{{ url('online4/js/jquery.themepunch.revolution.min.js') }}"></script>
	
	<!-- Template Scripts -->
	<script src="{{ url('online4/js/variables.js') }}"></script>
	<script src="{{ url('online4/js/custom_scripts.js') }}"></script>
	
	<!-- Agencies list -->
	<script src="{{ url('online4/js/agencies.js') }}"></script>
	
	<script type="text/javascript">
		(function($){
			"use strict";
			
        })(jQuery);
        
	</script>
	
	

</body>
</html>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P5MJCCG');</script>
    <!-- End Google Tag Manager -->
    <title>The Nest - Real Estate HTML Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="online2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="online2/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="online2/css/bootstrap-submenu.css">
    <link rel="stylesheet" type="text/css" href="online2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="online2/css/leaflet.css" type="text/css">
    <link rel="stylesheet" href="online2/css/map.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="online2/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="online2/css/flaticon.css">
    <link rel="stylesheet" type="text/css" href="online2/css/style.css">
    <link rel="stylesheet" type="text/css"  href="online2/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css"  href="online2/css/dropzone.css">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="online2/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="online2/css/default.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="css/ie10-viewport-bug-workaround.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script type="text/javascript" src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script type="text/javascript" src="online2/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5shiv.min.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5MJCCG"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Option Panel -->
<div class="option-panel option-panel-collased">
    <h2>Change Color</h2>
    <div class="color-plate default-plate" data-color="default"></div>
    <div class="color-plate blue-plate" data-color="blue"></div>
    <div class="color-plate yellow-plate" data-color="yellow"></div>
    <div class="color-plate red-plate" data-color="red"></div>
    <div class="color-plate green-light-plate" data-color="green-light"></div>
    <div class="color-plate orange-plate" data-color="orange"></div>
    <div class="color-plate yellow-light-plate" data-color="yellow-light"></div>
    <div class="color-plate green-light-2-plate" data-color="green-light-2"></div>
    <div class="color-plate olive-plate" data-color="olive"></div>
    <div class="color-plate purple-plate" data-color="purple"></div>
    <div class="color-plate blue-light-plate" data-color="blue-light"></div>
    <div class="color-plate brown-plate" data-color="brown"></div>
    <div class="setting-button">
        <i class="fa fa-gear"></i>
    </div>
</div>
<!-- /Option Panel -->

<!-- Top header start -->
<header class="top-header hidden-xs" id="top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="list-inline">
                    <a href="tel:1-8X0-666-8X88"><i class="fa fa-phone"></i>1-8X0-666-8X88</a>
                    <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i>info@themevessel.com</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Top header end -->

<!-- Main header start -->
<header class="main-header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navigation" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.html" class="logo">
                    <img src="img/logos/logo.png" alt="logo">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                <ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('listing') }}">Listing Rumah</a></li>
                    <li><a href="{{ url('news') }}">Berita</a></li>
                    <li><a href="{{ url('contactus') }}">Kontak Kami</a></li>
                    <li><a href="{{ url('aboutus') }}">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- /.navbar-collapse -->
            <!-- /.container -->
        </nav>
    </div>
</header>
<!-- Main header end -->

<!-- Banner start -->
<section class="banner banner_video_bg">
    <div class="pattern-overlay">
        <a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=5e0LxrLSzok',containment:'.banner_video_bg', quality:'large', autoPlay:true, mute:true, opacity:1}">bg</a>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="container">
                        <div class="carousel-caption banner-slider-inner">
                            <div class="text-center">
                                <h1 data-animation="animated fadeInUp delay-05s"><span>Selamat Datang di</span> Rumahceria.com</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner end -->


<!-- Listings parallax start -->
<div class="listings-parallax clearfix">
    <div class="listings-parallax-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-8 col-xs-12">
                    <h1>Kami disini untuk membantu anda </h1>
                    <h3>Berikan permasalahan perumahan anda kepada kami, maka kami akan memberikan solusi yang terbaik.</h3>
                    
                </div>
                <div class="col-lg-offset-3 col-lg-3 col-sm-4 col-xs-12">
                    <div class="contect-agent-photo">
                        <img src="img/avatar/avatar-8.png" alt="avatar-6" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Listings parallax end -->

<!-- Counters strat -->
<div class="counters">
    <div class="container">

        <div class="row">
            <div class="col-md-3 col-sm-6 bordered-right">
                <div class="counter-box">
                    <i class="flaticon-tag"></i>
                    <h1 class="counter">967</h1>
                    <p>Listings For Sale</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 bordered-right">
                <div class="counter-box">
                    <i class="flaticon-symbol-1"></i>
                    <h1 class="counter">1276</h1>
                    <p>Listings For Rent</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 bordered-right">
                <div class="counter-box">
                    <i class="flaticon-people"></i>
                    <h1 class="counter">396</h1>
                    <p>Agents</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-people-1"></i>
                    <h1 class="counter">177</h1>
                    <p>Brokers</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counters end -->

<!-- Footer start -->
<footer class="main-footer clearfix">
    <div class="container">
        <!-- Footer top -->
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-2">
                        <a href="index.html">
                            <img src="img/logos/footer-logo.png" alt="footer-logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer info-->
        <div class="footer-info">
            <div class="row">
                <!-- About us -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Contact Us</h1>
                        </div>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printing and typesetting
                        </p>
                        <ul class="personal-info">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                Address: 20/F Green Road, Dhanmondi, Dhaka
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                Email:<a href="mailto:sales@hotelempire.com">info@themevessel.com</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                Phone: <a href="tel:+55-417-634-7071">+55 4XX-634-7071</a>
                            </li>
                            <li>
                                <i class="fa fa-fax"></i>
                                Fax: +55 4XX-634-7071
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Links -->
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Links</h1>
                        </div>
                        <ul class="links">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="about.html">About Us</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact Us</a>
                            </li>
                            <li>
                                <a href="blog-single.html">Blog</a>
                            </li>
                            <li>
                                <a href="properties-list-rightside.html">properties Listing</a>
                            </li>
                            <li>
                                <a href="properties-grid-rightside.html">properties Grid</a>
                            </li>
                            <li>
                                <a href="properties-details.html">properties Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Recent cars -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-item popular-posts">
                        <div class="main-title-2">
                            <h1>popular posts</h1>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="img/properties/small-properties-1.jpg" alt="small-properties-1">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Modern Design Building</a>
                                </h3>
                                <p>21 October, 2016</p>
                                <div class="comments-icon">
                                    <i class="fa fa-comments"></i>45 comments
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="img/properties/small-properties-2.jpg" alt="small-properties-2">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Real Eatate Expo 2016</a>
                                </h3>
                                <p>10 October, 2016</p>
                                <div class="comments-icon">
                                    <i class="fa fa-comments"></i>32 comments
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="img/properties/small-properties-3.jpg" alt="small-properties-3">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="#">Construction and Development</a>
                                </h3>
                                <p>10 October, 2016</p>
                                <div class="comments-icon">
                                    <i class="fa fa-comments"></i>58 comments
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Copy right start -->
<div class="copy-right">
    <div class="container">
        &copy;  2017 <a href="http://themevessel.com/" target="_blank">Theme Vessel</a>. Trademarks and brands are the property of their respective owners.
    </div>
</div>
<!-- Copy end right-->

<script type="text/javascript" src="online2/js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="online2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="online2/js/bootstrap-submenu.js"></script>
<script type="text/javascript" src="online2/js/rangeslider.js"></script>
<script type="text/javascript" src="online2/js/jquery.mb.YTPlayer.js"></script>
<script type="text/javascript" src="online2/js/wow.min.js"></script>
<script type="text/javascript" src="online2/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="online2/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="online2/js/jquery.scrollUp.js"></script>
<script type="text/javascript" src="online2/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="online2/js/leaflet.js"></script>
<script type="text/javascript" src="online2/js/leaflet-providers.js"></script>
<script type="text/javascript" src="online2/js/leaflet.markercluster.js"></script>
<script type="text/javascript" src="online2/js/dropzone.js"></script>
<script type="text/javascript" src="online2/js/jquery.filterizr.js"></script>
<script type="text/javascript" src="online2/js/maps.js"></script>
<script type="text/javascript" src="online2/js/app.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script type="text/javascript" src="online2/js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script type="text/javascript" src="online2/js/ie10-viewport-bug-workaround.js"></script>
</html>
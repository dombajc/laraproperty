
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

<!-- Sub banner start -->
<div class="sub-banner">
    <div class="overlay">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Properties List Left Sidebar</h1>
                <ul class="breadcrumbs">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Properties List Left Sidebar</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Properties section body start -->
<div class="properties-section-body content-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xs-12 col-md-push-4">
                <!-- Option bar start -->
                <div class="option-bar">
                    <div class="row">
                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-2">
                            <h4>
                                <span class="heading-icon">
                                    <i class="fa fa-th-list"></i>
                                </span>
                                <span class="hidden-xs">Properties List</span>
                            </h4>
                        </div>
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-10 cod-pad">
                            <div class="sorting-options">
                                <select class="sorting">
                                    <option>New To Old</option>
                                    <option>Old To New</option>
                                    <option>Properties (High To Low)</option>
                                    <option>Properties (Low To High)</option>
                                </select>
                                <a href="properties-list-leftside.html" class="change-view-btn active-view-btn"><i class="fa fa-th-list"></i></a>
                                <a href="properties-grid-leftside.html" class="change-view-btn"><i class="fa fa-th-large"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Option bar end -->

                <div class="clearfix"></div>
                <!-- Property start -->
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Sale</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-1.jpg" alt="properties-1" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Beautiful Single Home</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Rent</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-3.jpg" alt="properties-3" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Modern Family Home</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Sale</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-4.jpg" alt="properties-4" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Sweet Family Home</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Rent</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-7.jpg" alt="properties-7" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Park Avenue</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Sale</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-8.jpg" alt="properties-8" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Masons Villas</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Rent</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-5.jpg" alt="properties-5" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Big Head House</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Sale</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-9.jpg" alt="properties-9" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Beautiful Single Home</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <div class="property clearfix wow fadeInUp delay-03s">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-pad">
                        <a href="properties-details.html" class="property-img height">
                            <div class="property-tag button alt featured">Featured</div>
                            <div class="property-tag button sale">For Rent</div>
                            <div class="property-price">$150,000</div>
                            <img src="img/properties/properties-6.jpg" alt="properties-6" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 property-content ">
                        <!-- title -->
                        <h1 class="title">
                            <a href="properties-details.html">Modern Family Home</a>
                        </h1>
                        <!-- Property address -->
                        <h3 class="property-address">
                            <a href="properties-details.html">
                                <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                            </a>
                        </h3>
                        <!-- Facilities List -->
                        <ul class="facilities-list clearfix">
                            <li>
                                <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                <span>4800 sq ft</span>
                            </li>
                            <li>
                                <i class="flaticon-bed"></i>
                                <span>3 Beds</span>
                            </li>
                            <li>
                                <i class="flaticon-monitor"></i>
                                <span>TV </span>
                            </li>
                            <li>
                                <i class="flaticon-holidays"></i>
                                <span> 2 Baths</span>
                            </li>
                            <li>
                                <i class="flaticon-vehicle"></i>
                                <span>1 Garage</span>
                            </li>
                            <li>
                                <i class="flaticon-building"></i>
                                <span> 3 Balcony</span>
                            </li>
                        </ul>
                        <!-- Property footer -->
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                                <a href="#"><i class="fa fa-heart-o icon"></i></a>
                                <a href="#"><i class="fa fa-share-alt"></i></a>
                             </span>
                        </div>
                    </div>
                </div>
                <!-- Property end -->

                <!-- Page navigation start -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">Previous</span>
                            </a>
                        </li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- Page navigation end-->
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 col-md-pull-8">
                <!-- Search contents sidebar start -->
                <div class="sidebar-widget">
                    <div class="main-title-2">
                        <h1><span>Advanced</span> Search</h1>
                    </div>

                    <form method="GET">
                        <div class="form-group">
                            <select class="selectpicker search-fields" name="property-status" data-live-search="true" data-live-search-placeholder="Search value">
                                <option>Property Status</option>
                                <option>For Sale</option>
                                <option>For Rent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="selectpicker search-fields" name="location" data-live-search="true" data-live-search-placeholder="Search value">
                                <option>Location</option>
                                <option>United States</option>
                                <option>United Kingdom</option>
                                <option>American Samoa</option>
                                <option>Belgium</option>
                                <option>Cameroon</option>
                                <option>Canada</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="selectpicker search-fields" name="property-types" data-live-search="true" data-live-search-placeholder="Search value" >
                                <option>Property Types</option>
                                <option>Residential</option>
                                <option>Commercial</option>
                                <option>Land</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="selectpicker search-fields" name="area-from" data-live-search="true" data-live-search-placeholder="Search value" >
                                <option>Area From</option>
                                <option>1000</option>
                                <option>800</option>
                                <option>600</option>
                                <option>400</option>
                                <option>200</option>
                                <option>100</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bedrooms">
                                        <option>Bedrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bathroom">
                                        <option>Bathroom</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="balcony">
                                        <option>Balcony</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" data-live-search="true" name="garage">
                                        <option>Garage</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="range-slider">
                            <label>Area</label>
                            <div data-min="0" data-max="10000" data-unit="Sq ft" data-min-name="min_area" data-max-name="max_area" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="range-slider">
                            <label>Price</label>
                            <div data-min="0" data-max="150000" data-unit="USD" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
                            <div class="clearfix"></div>
                        </div>

                        <a class="show-more-options" data-toggle="collapse" data-target="#options-content">
                            <i class="fa fa-plus-circle"></i> Show More Options
                        </a>
                        <div id="options-content" class="collapse">
                            <label class="margin-t-10">Features</label>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">
                                    Free Parking
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox2" type="checkbox">
                                <label for="checkbox2">
                                    Air Condition
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox3" type="checkbox">
                                <label for="checkbox3">
                                    Places to seat
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox4" type="checkbox">
                                <label for="checkbox4">
                                    Swimming Pool
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox5" type="checkbox">
                                <label for="checkbox5">
                                    Laundry Room
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox6" type="checkbox">
                                <label for="checkbox6">
                                    Window Covering
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox7" type="checkbox">
                                <label for="checkbox7">
                                    Central Heating
                                </label>
                            </div>
                            <div class="checkbox checkbox-theme checkbox-circle">
                                <input id="checkbox8" type="checkbox">
                                <label for="checkbox8">
                                    Alarm
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="search-button">Search</button>
                        </div>
                    </form>
                </div>
                <!-- Search contents sidebar end -->

                <!-- Popular posts start -->
                <div class="sidebar-widget popular-posts">
                    <div class="main-title-2">
                        <h1><span>Recent</span> Properties</h1>
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
                <!-- Popular posts end -->

                <!-- Helping box Start -->
                <div class="sidebar-widget helping-box clearfix">
                    <div class="main-title-2">
                        <h1><span>Helping</span> Center</h1>
                    </div>
                    <div class="helping-center">
                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                        <h4>Address</h4>
                        <span>123 Kathal St. Tampa City,</span>
                    </div>
                    <div class="helping-center">
                        <div class="icon"><i class="fa fa-phone"></i></div>
                        <h4>Phone</h4>
                        <p><a href="tel:+55-417-634-7071">+55 417 634 7071</a> </p>
                    </div>
                </div>
                <!-- Helping box end -->

                <!-- Latest reviews start -->
                <div class="sidebar-widget latest-reviews">
                    <div class="main-title-2">
                        <h1><span>Latest</span> Reviews</h1>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="img/avatar/avatar-1.jpg" alt="avatar-1">
                            </a>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><a href="#">Property title</a></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit.
                                Etiamrisus tortor, accumsan at nisi et,
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="img/avatar/avatar-2.jpg" alt="avatar-2">
                            </a>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><a href="#">Property title</a></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit.
                                Etiamrisus tortor, accumsan at nisi et,
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Latest reviews end -->
            </div>
        </div>
    </div>
</div>
<!-- Properties section body end -->


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
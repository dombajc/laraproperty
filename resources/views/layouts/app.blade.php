<!DOCTYPE html>
<html>
    <head>
        <title>Pongo | Admin Template</title>
        <meta charset="utf-8">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <meta content="template language" name="keywords">
        <meta content="Native Theme" name="author">
        <meta content="Admin Template" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="favicon.png" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="plugins/confirm/jquery-confirm.min.css">

        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/jquery.countTo.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
    </head>
    <body>
        <div class="top-nav">
            <div class="top-nav-box">
                <div class="side-nav-mobile"><i class="fa fa-bars"></i></div>
                <div class="logo-wrapper">
                    <div class="logo-box">
                        <a href="">
                            <div class="logo-title">ManTEP2 v1.0</div>
                        </a>
                    </div>
                </div>
                <div class="top-nav-content">
                    <div class="top-nav-box">
                        <div class="top-notification">
                            <div class="notification-icon">
                                <i class="fa fa-envelope-open"></i>
                            </div>
                            <div class="notification-icon">
                                <div class="notification-badge bounceInDown animated timer" data-from="0" data-to="21">21</div>
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="notification-icon">
                                <div class="notification-badge bounceInDown animated timer" data-from="0" data-to="3">3</div>
                                <i class="fa fa-bell"></i>
                            </div>
                        </div>
                        <div class="user-top-profile">
                            <div class="user-image">
                                <div class="user-on"></div>
                                <img alt="pongo" src="{{ url('images/default_profile.png') }}">
                            </div>
                            <div class="clear">
                                <div class="user-name">John Doe</div>
                                <div class="user-group">Administrator</div>
                                <ul class="user-top-menu animated bounceInUp">
                                    <li><a href="">Lihat Profile</a></li>
                                    <li><a href="">Ubah Kata Sandi</a></li>
                                    <li><a href="{{ url('log-out') }}">Keluar</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-nav-mobile"><i class="fa fa-cog"></i></div>
            </div>
        </div>
        <div class="wrapper fixed-nav">
            <aside class="side-nav">
                <div class="user-side-profile">
                    <div class="user-image">
                        <div class="user-on"></div>
                        <img alt="pongo" src="{{ url('images/default_profile.png') }}">
                    </div>
                    <div class="clear">
                        <div class="user-name">John Doe</div>
                        <div class="user-group">Administrator</div>
                        <ul class="user-side-menu animated bounceInUp">
                            <li><a href="">Lihat Profile</a></li>
                            <li><a href="">Ubah Kata Sandi</a></li>
                            <li><a href="{{ url('log-out') }}">Keluar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main-menu-title">Menu</div>
                <div class="main-menu">
                    {{ App\Menu::ShowListMenu() }}
                </div>
            </aside>
            <div class="main">
                
                <div class="content">
                    <div class="panel">
                        
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <script src="plugins/jquery-loading-overlay-master/src/loadingoverlay.min.js"></script>
        <script src="plugins/confirm/jquery-confirm.min.js"></script>
        <script>
            $(document).ajaxSend(function(event, jqxhr, settings){
                $.LoadingOverlay("show", {
                    image : "images/loading-ajax.gif",
                    maxSize         : "380px",
                    minSize         : "220px",
                    resizeInterval  : 0
                });
            });
            $(document).ajaxComplete(function(event, jqxhr, settings){
                $.LoadingOverlay("hide");
            });
            function AppError(pesan) {
                $.alert({
                    title: 'Oops ...',
                    content: pesan,
                    type: 'red',
                    typeAnimated: true,
                });
            }
            function JsonError(pesan) {
                if ( pesan.status == 200 ) {
                    location.reload();
                } else {
                    $.alert({
                        title: pesan.status,
                        content: pesan.statusText,
                        type: 'red',
                        typeAnimated: true,
                    });
                }
                
            }
        </script>
    </body>
</html>

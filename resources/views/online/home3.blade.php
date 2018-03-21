@extends( 'layouts.online' )

@section( 'content' )

		<!-- SPECIFIC CSS -->
	<link href="online3/css/layerslider.css" rel="stylesheet">
	<main>
		<!-- Slider -->
		<div id="full-slider-wrapper">
			<div id="layerslider" style="width:100%;height:750px;">
				<!-- first slide -->
				<div class="ls-slide" data-ls="slidedelay: 5000; transition2d:85;">
					<img src="online3/images/slider1.jpg" class="ls-bg" alt="Slide background">
					<h3 class="ls-l slide_typo" style="top: 47%; left: 50%;" data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">Selamat Datang <strong>rumahceria.com</strong></h3>
				</div>
				<!-- second slide -->
				<div class="ls-slide" data-ls="slidedelay:5000; transition2d:103;">
					<img src="online3/images/slider2.jpg" class="ls-bg" alt="Slide background">
				</div>
				<!-- third slide -->
				<div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
					<img src="online3/images/slider3.jpg" class="ls-bg" alt="Slide background">
				</div>
			</div>
		</div>
		<!-- End layerslider -->

		<div class="features clearfix">
			<div class="container">
				<ul>
					<li><i class="pe-7s-study"></i>
						<h4>2</h4><span>Proyek</span>
					</li>
					<li><i class="pe-7s-cup"></i>
						<h4>1000</h4><span>Kapling</span>
					</li>
					<li><i class="pe-7s-target"></i>
						<h4>1500</h4><span>Kapling terjual</span>
					</li>
				</ul>
			</div>
		</div>
		<!-- /features -->
		<div class="container-fluid margin_120_0">
			
			<div class="main_title_2">
				<span><em></em></span>
				<h2>PERUMAHAN</h2>
				<p>Wujudkan impian anda bersama kami</p>
			</div>
			<div id="reccomended" class="owl-carousel owl-theme">
				@foreach ($Rowsproyek as $itemproyek )
				<div class="item">
					<div class="box_grid">
						<figure>
							<a href="{{ url('product_detil/'. $itemproyek->id_proyek) }}">
							<div class="preview"><span>Lihat Detail</span></div><img src="{{ $itemproyek->uri_pic_proyek }}" class="img-fluid" alt=""></a>
							<div class="price">Luas : {{ number_format($itemproyek->luas_proyek) }} HA</div>
						</figure>
						<div class="wrapper">
							<small>Proyek</small>
							<h3>{{ $itemproyek->nm_proyek }}</h3>
							<p>{{ $itemproyek->alamat }}<br>{{ $itemproyek->nm_kota }}<br>{{ $itemproyek->nm_provinsi }}</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- /carousel -->
			<div class="container">
				<p class="btn_home_align"><a href="{{ url('products') }}" class="btn_1 rounded">Lihat Semuanya</a></p>
			</div>
			<!-- /container -->
			
		</div>
		<!-- /container -->
	
		<div class="bg_color_1">
			<div class="container margin_120_95">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>Berita dan Kegiatan</h2>
				</div>
				<div class="row">
					@foreach ( $Rowsnews as $itemnews )
					<div class="col-lg-6">
						<a class="box_news" href="{{ url('news_detil/'. $itemnews->id_berita) }}">
							<figure><img src="{{ $itemnews->foto }}" alt="">
								<figcaption><strong>{{ $itemnews->hari }}</strong>{{ App\Fungsi::getBulan2($itemnews->bln) }}</figcaption>
							</figure>
							<ul>
								<li>{{ $itemnews->kategori_berita }}</li>
								<li>{{ $itemnews->tgl }}</li>
							</ul>
							<h4>{{ $itemnews->judul }}</h4>
						</a>
					</div>
					@endforeach
				</div>
				<!-- /row -->
				<p class="btn_home_align"><a href="{{ url('news') }}" class="btn_1 rounded">Lihat Semuanya</a></p>
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->

		<div class="call_section">
			<div class="container clearfix">
				<div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
					<div class="block-reveal">
						<div class="block-vertical"></div>
						<div class="box_1">
							<h3>Anda punya pertanyaan ?</h3>
							<p>Silahkan kontak kami, kami akan memberikan kemampuan terbaik kami.</p>
							<form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
								<div class="row">
									<div class="col-md-6">
										<span class="input">
											<input class="input_field" type="text" id="name_contact" name="name_contact">
											<label class="input_label">
												<span class="input__label-content">Your Name</span>
											</label>
										</span>
									</div>
									<div class="col-md-6">
										<span class="input">
											<input class="input_field" type="text" id="lastname_contact" name="lastname_contact">
											<label class="input_label">
												<span class="input__label-content">Last name</span>
											</label>
										</span>
									</div>
								</div>
								<!-- /row -->
								<div class="row">
									<div class="col-md-6">
										<span class="input">
											<input class="input_field" type="email" id="email_contact" name="email_contact">
											<label class="input_label">
												<span class="input__label-content">Your email</span>
											</label>
										</span>
									</div>
									<div class="col-md-6">
										<span class="input">
											<input class="input_field" type="text" id="phone_contact" name="phone_contact">
											<label class="input_label">
												<span class="input__label-content">Your telephone</span>
											</label>
										</span>
									</div>
								</div>
								<!-- /row -->
								<span class="input">
										<textarea class="input_field" id="message_contact" name="message_contact" style="height:150px;"></textarea>
										<label class="input_label">
											<span class="input__label-content">Your message</span>
										</label>
								</span>
								
								<p class="add_top_30"><input type="submit" value="Submit" class="btn_1 rounded" id="submit-contact"></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/call_section-->
	</main>

    <script src="online3/js/greensock.js"></script>
    <script src="online3/js/layerslider.transitions.js"></script>
    <script src="online3/js/layerslider.kreaturamedia.jquery.js"></script>
    <script type="text/javascript">
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            navButtons: false,
            navStartStop: false,
            showCircleTimer: false,
            responsive: true,
            responsiveUnder: 1280,
            layersContainer: 1200,
            skinsPath: 'online3/'
                // Please make sure that you didn't forget to add a comma to the line endings
                // except the last line!
        });
    </script>
@endsection   
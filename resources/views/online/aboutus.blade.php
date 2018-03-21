@extends( 'layouts.online' )

@section( 'content' )
	
	<main>
        @extends( 'layouts.headernohome' )

		<div class="contact_info">
			<div class="container">
				<ul class="clearfix">
					<li>
						<i class="pe-7s-map-marker"></i>
						<h4>Alamat</h4>
						<span>{{ $row->alamat }}</span>
					</li>
					<li>
						<i class="pe-7s-mail-open-file"></i>
						<h4>e-Mail</h4>
						<span>{{ $row->email }}</span>

					</li>
					<li>
						<i class="pe-7s-phone"></i>
						<h4>Info Kontak</h4>
						<span>{{ $row->telp }}</span>
					</li>
				</ul>
			</div>
        </div>
        
        <div class="bg_color_1">
			<div class="container margin_120_95">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>Cerita Singkat Rumahsubsidiceria.com</h2>
				</div>
				<div class="row justify-content-between">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<figure class="block-reveal">
							<div class="block-horizzontal"></div>
							<img src="{{ url('images/defaultfoto.jpg') }}" class="img-fluid" alt="">
						</figure>
					</div>
					<div class="col-lg-5">
						<p>Lorem ipsum dolor sit amet, homero erroribus in cum. Cu eos <strong>scaevola probatus</strong>. Nam atqui intellegat ei, sed ex graece essent delectus. Autem consul eum ea. Duo cu fabulas nonumes contentiones, nihil voluptaria pro id. Has graeci deterruisset ad, est no primis detracto pertinax, at cum malis vitae facilisis.</p>
						<p>Dicam diceret ut ius, no epicuri dissentiet philosophia vix. Id usu zril tacimates neglegentur. Eam id legimus torquatos cotidieque, usu decore <strong>percipitur definitiones</strong> ex, nihil utinam recusabo mel no. Dolores reprehendunt no sit, quo cu viris theophrastus. Sit unum efficiendi cu.</p>
						<p><em>CEO Marc Schumaker</em></p>
					</div>
				</div>
				<!--/row-->
			</div>
			<!--/container-->
		</div>
        <!--/bg_color_1-->
        
        <div class="container margin_120_95">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Struktur Organisasi</h2>
			</div>
			<div id="carousel" class="owl-carousel owl-theme">
				<div class="item">
					<a href="#0">
						<div class="title">
							<h4>[ nama ]<em>CEO</em></h4>
						</div><img src="{{ url('images/default_profile.png') }}" alt="">
					</a>
				</div>
				<div class="item">
					<a href="#0">
						<div class="title">
							<h4>[ nama ]<em>Marketing</em></h4>
						</div><img src="{{ url('images/default_profile.png') }}" alt="">
					</a>
				</div>
				<div class="item">
					<a href="#0">
						<div class="title">
							<h4>[ nama ]<em>Business strategist</em></h4>
						</div><img src="{{ url('images/default_profile.png') }}" alt="">
					</a>
				</div>
				<div class="item">
					<a href="#0">
						<div class="title">
							<h4>[ nama ]<em>Customer Service</em></h4>
						</div><img src="{{ url('images/default_profile.png') }}" alt="">
					</a>
				</div>
				<div class="item">
					<a href="#0">
						<div class="title">
							<h4>[ nama ]<em>Admissions</em></h4>
						</div><img src="{{ url('images/default_profile.png') }}" alt="">
					</a>
				</div>
			</div>
			<!-- /carousel -->
		</div>
		
	</main>
    <!--/main-->
@endsection  
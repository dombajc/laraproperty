
@extends( 'layouts.online4' )

@section( 'content' )
	<!-- BEGIN PAGE TITLE/BREADCRUMB -->
	<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="page-title">Hubungi Kami</h1>
					
					<ul class="breadcrumb">
						<li><a href="{{ url('/') }}">Home </a></li>
						<li><a href="{{ url('contactus') }}">Hubungi Kami</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE TITLE/BREADCRUMB -->
	
	
	<!-- BEGIN CONTENT WRAPPER -->
	<div class="content contacts">
		<div id="contacts_map"></div>
		
		
		<div class="container">
			<div class="row">
			
				<div id="contacts-overlay" class="col-sm-7">
					<i id="contacts-overlay-close" class="fa fa-minus"></i>
					
					<ul class="col-sm-6">
						<li><i class="fa fa-map-marker"></i> {{ $R->alamat }}</li>
						<li><i class="fa fa-envelope"></i> <a href="mailto:youremail@domain.com">youremail@domain.com</a></li>
					</ul>
					
					<ul class="col-sm-6">
						<li><i class="fa fa-phone"></i> Tel.: {{ $R->telp }}</li>
						<li><i class="fa fa-print"></i> Fax: {{ $R->fax }}</li>
					</ul>
				</div>
				
				<!-- BEGIN MAIN CONTENT -->
				<div class="main col-sm-4 col-sm-offset-8">
					<h2 class="section-title">Contact Form</h2>
					<p class="col-sm-12 center">Anda punya pertanyaan seputar perumahan bersubsidi. Silahkan hubungi kami melalui form di bawah ini atau kunjungi kantor kami yang tertera pada peta di samping dan kami akan memberikan jawaban terbaik untuk anda. Temukan solusi perumahan anda bersama kami <b>{{ $R->nm_judul }}</b></p>
					
					<form>						
						<div class="col-sm-12">
							<input type="text" name="Name" placeholder="Name" class="form-control required fromName" />
						
							<input type="email" name="Email" placeholder="Email" class="form-control required fromEmail"  />
						
							<input type="text" name="Subject" placeholder="Subject" class="form-control required subject"  />
							<textarea name="Message" placeholder="Message" class="form-control required"></textarea> 
						</div>
						
						<div class="center">
							<button type="submit" class="btn btn-default-color btn-lg submit_form"><i class="fa fa-envelope"></i> Send Message</button>
						</div>
					</form>
				</div>	
				<!-- END MAIN CONTENT -->

			</div>
		</div>
	</div>
	<!-- END CONTENT WRAPPER -->
	<script>
	function initMap() {

		var uluru = {lat: {{ $R->lat }}, lng: {{ $R->lang }}};
		var map = new google.maps.Map(document.getElementById('contacts_map'), {
			zoom: 20,
			center: uluru,
			styles: [
				{
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#f5f5f5"
					}
					]
				},
				{
					"elementType": "labels.icon",
					"stylers": [
					{
						"visibility": "off"
					}
					]
				},
				{
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#616161"
					}
					]
				},
				{
					"elementType": "labels.text.stroke",
					"stylers": [
					{
						"color": "#f5f5f5"
					}
					]
				},
				{
					"featureType": "administrative.land_parcel",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#bdbdbd"
					}
					]
				},
				{
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#eeeeee"
					}
					]
				},
				{
					"featureType": "poi",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#757575"
					}
					]
				},
				{
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#e5e5e5"
					}
					]
				},
				{
					"featureType": "poi.park",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#9e9e9e"
					}
					]
				},
				{
					"featureType": "road",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#ffffff"
					}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#757575"
					}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#dadada"
					}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#616161"
					}
					]
				},
				{
					"featureType": "road.local",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#9e9e9e"
					}
					]
				},
				{
					"featureType": "transit.line",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#e5e5e5"
					}
					]
				},
				{
					"featureType": "transit.station",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#eeeeee"
					}
					]
				},
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
					{
						"color": "#c9c9c9"
					}
					]
				},
				{
					"featureType": "water",
					"elementType": "labels.text.fill",
					"stylers": [
					{
						"color": "#9e9e9e"
					}
					]
				}
			]

			//mapTypeId: 'hybrid'
		});
		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
	}
</script>

<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA410jI9jrile0OCUsyo7xUIRVtm4sw5_k&callback=initMap'></script>
		
@endsection 
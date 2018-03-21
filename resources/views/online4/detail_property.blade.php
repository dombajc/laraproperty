
@extends( 'layouts.online4' )

@section( 'content' )
		
	<!-- BEGIN PAGE TITLE/BREADCRUMB -->
	<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="page-title">Property Detail</h1>
						
						<ul class="breadcrumb">
							<li><a href="{{ url('/') }}">Home </a></li>
							<li><a href="{{ url('properties') }}">Properties</a></li>
							<li><a href="{{ url('properties/'. str_replace(' ','_', strtolower($P->nm_proyek))) }}">{{ $P->nm_proyek }}</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE TITLE/BREADCRUMB -->
		
		
		<!-- BEGIN CONTENT WRAPPER -->
		<div class="content">
			<div class="container">
				<div class="row">
				
					<!-- BEGIN MAIN CONTENT -->
					<div class="main col-sm-8">
					
						<h1 class="property-title">{{ $P->nm_proyek }}<small>{{ $P->alamat }}, 
								{{ $P->nm_provinsi }}, {{ $P->nm_kota }}, 
								Kec. {{ $P->nm_kecamatan }}, 
								Kel. {{ $P->nm_kelurahan }}</small></h1>
						
						@foreach( App\Tipeproyek::get_arr_detil_by_proyek($P->id_proyek) as $row )
						<div class="property-topinfo">
							<ul class="amenities">
								<li><i class="icon-apartment"></i> Rumah Subsidi</li>
								<li><i class="icon-area"></i> {{ $row['luas_bangunan'] }} m<sup>2</sup></li>
								<li><i class="icon-bedrooms"></i> {{ $row['jml_kmr_tidur'] }}</li>
								<li><i class="icon-bathrooms"></i> {{ $row['jml_kmr_mandi'] }}</li>
							</ul>
							
							<div id="property-id">TIPE : {{ $row['nm_tipe'] }}</div>
						</div>

						<!-- BEGIN PROPERTY DETAIL SLIDERS WRAPPER -->
						<div id="property-detail-wrapper" class="style2">
							
							<div class="price">
								<i class="fa fa-home"></i>HARGA STANDAR
								<span>Rp. {{ number_format($row['harga_standar'],2) }}</span>
							</div>
									
							<!-- BEGIN PROPERTY DETAIL LARGE IMAGE SLIDER -->
							<div id="property-detail-large" class="owl-carousel">
								<div class="item">
									@if( count($row['images']) > 0 )
									@foreach( $row['images'] as $pic )
									<img src="{{ $pic }}" alt="" />
									@endforeach
									@endif
								</div>
								
							</div>
							<!-- END PROPERTY DETAIL LARGE IMAGE SLIDER -->
							
							<!-- BEGIN PROPERTY DETAIL THUMBNAILS SLIDER -->
							<div id="property-detail-thumbs" class="owl-carousel">
								@if( count($row['images']) > 0 )
								@foreach( $row['images'] as $pic )
								<div class="item"><img src="{{ $pic }}" alt="" /></div>
								@endforeach
								@endif
							</div>
							<!-- END PROPERTY DETAIL THUMBNAILS SLIDER -->
						
						</div>
						@endforeach;
						
						<!-- BEGIN SIMILAR PROPERTIES -->
						<h1 class="section-title">Tipe Perumahan Lain</h1>
						<div id="similar-properties" class="grid-style1 clearfix">
							<div class="row">
								{{ App\Tipeproyek::preview_home_online() }}
								
							</div>
							
						</div>
					</div>	
					<!-- END MAIN CONTENT -->
					
					
					<!-- BEGIN SIDEBAR -->
					<div class="sidebar gray col-sm-4">
						
						<!-- BEGIN NEWSLETTER -->
						<div id="newsletter" class="col-sm-12">
							<h2 class="section-title">Sekilas<br><span>Proyek</span></h2>
							<?= $P->desc_proyek ?>
							<div id="show-maps" style="height: 400px;"></div>
						</div>
						<!-- END NEWSLETTER -->

						<!-- BEGIN ADVANCED SEARCH -->
						<h2 class="section-title">Pilih Proyek</h2>
						<form>
							<div class="form-group">
							
								<div class="col-sm-12">
									<select class="col-sm-12" id="search_prop_type" name="search_prop_type" data-placeholder="Type of Property">
										<option value=""> Silahkan pilih Proyek </option>
										{{ App\Proyek::opsiByName() }}
									</select>
								</div>
								
								<p>&nbsp;</p>
								<p class="center">
									<button type="button" class="btn btn-default-color" id="jump-proyek">Search</button>
								</p>
							</div>
						</form>
						<!-- END ADVANCED SEARCH -->
						
						<!-- BEGIN LATEST NEWS -->
						<h2 class="section-title">Berita Terbaru</h2>
						<ul class="latest-news">
							{{ App\Posts::preview_sidebar_online() }}
						</ul>
						<!-- END LATEST NEWS -->
							
						
						
					</div>
					<!-- END SIDEBAR -->

				</div>
			</div>
		</div>
		<!-- END CONTENT WRAPPER -->	

<script>
	function initMap() {
		var contentString = '<div class="infoBox"><div class="infoWindowAgency"><h3>{{ $P->nm_proyek }}</h3><a href="agency-detail.html"><img src="{{ $P->uri_pic_proyek }}"></a><div class="center"><a class="btn btn-fullcolor" href="agency-detail.html">View More</a></div></div></div>';

        var infowindow = new google.maps.InfoWindow({
        	content: contentString
        });
		var uluru = {lat: {{ $P->lat }}, lng: {{ $P->lang }}};
		var map = new google.maps.Map(document.getElementById('show-maps'), {
			zoom: 15,
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

		marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
	}


</script>

<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA410jI9jrile0OCUsyo7xUIRVtm4sw5_k&callback=initMap'></script>

<script>
	$('#jump-proyek').click(function(){
		if ( $('#search_prop_type').val() == '' ) {
			alert('Silahkan pilih dahulu Proyek yang akan di tuju !')
		} else {
			location.href = "{{ url('properties') }}/" + $('#search_prop_type').val();
		}
	})
</script>
		
@endsection 
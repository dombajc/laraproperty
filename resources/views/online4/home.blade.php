
@extends( 'layouts.online4' )

@section( 'content' )
		
		
		<!-- BEGIN HOME SLIDER SECTION -->
		<div class="revslider-container">
			<div class="revslider" >
				<ul>
					@if( count($sliders) == 0 )
					<li data-transition="fade" data-slotamount="7">
						<img src="online4/images/homeslider-img1.jpg" alt="" />
						<div class="caption sfr slider-title" data-x="70" data-y="120" data-speed="800" data-start="1300" data-easing="easeOutBack" data-end="9600" data-endspeed="700" data-endeasing="easeInSine">HOME SWEET HOME!</div>
						<div class="caption sfl slider-subtitle" data-x="75" data-y="190" data-speed="800" data-start="1500" data-easing="easeOutBack" data-end="9700" data-endspeed="500" data-endeasing="easeInSine">Cozy it's the perfect Template for Real Estate.</div>
					</li>
					@else
					@foreach($sliders as $row)
					<li data-transition="fade">
						<img src="{{ $row->uri_slider }}" alt="" />
						<div class="caption sfr slider-title" data-x="450" data-y="120" data-speed="800" data-start="1300" data-easing="easeOutBack" data-end="9600" data-endspeed="500" data-endeasing="easeInSine">{{ $row->text1 }}</div>
						<div class="caption sfl slider-subtitle" data-x="455" data-y="190" data-speed="800" data-start="1500" data-easing="easeOutBack" data-end="9700" data-endspeed="500" data-endeasing="easeInSine">{{ $row->text2 }}</div>
					</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
		<!-- END HOME SLIDER SECTION -->
		
		<!-- BEGIN HOME ADVANCED SEARCH 
		<div id="home-advanced-search" class="open">
			<div id="opensearch"></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<form>
							<div class="form-group">
								<div class="form-control-large">
									<input type="text" class="form-control" name="location" placeholder="City, State, Country, etc...">
								</div>
								
								<div class="form-control-large">
									<select id="search_prop_type" name="search_prop_type" data-placeholder="Type of Property">
										<option value=""> </option>
										<option value="residential">Residential</option>
										<option value="commercial">Commercial</option>
										<option value="land">Land</option>
									</select>
								</div>
								
								<div class="form-control-small">
									<select id="search_status" name="search_status" data-placeholder="Status">
										<option value=""> </option>
										<option value="sale">For Sale</option>
										<option value="rent">For Rent</option>
									</select>
								</div>
								
								<div class="form-control-small">
									<select id="search_bedrooms" name="search_bedrooms" data-placeholder="Bedrooms">
										<option value=""> </option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="5plus">5+</option>
									</select>
								</div>
								
								<div class="form-control-small">
									<select id="search_bathrooms" name="search_bathrooms" data-placeholder="Bathrooms">
										<option value=""> </option>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="4plus">4+</option>
									</select>
								</div>
								
								<div class="form-control-small">
									<select id="search_minprice" name="search_minprice" data-placeholder="Min. Price">
										<option value=""> </option>
										<option value="0">$0</option>
										<option value="25000">$25000</option>
										<option value="50000">$50000</option>
										<option value="75000">$75000</option>
										<option value="100000">$100000</option>
										<option value="150000">$150000</option>
										<option value="200000">$200000</option>
										<option value="300000">$300000</option>
										<option value="500000">$500000</option>
										<option value="750000">$750000</option>
										<option value="1000000">$1000000</option>
									</select>
								</div>
								
								<div class="form-control-small">
									<select id="search_maxprice" name="search_maxprice" data-placeholder="Max. Price">
										<option value=""> </option>
										<option value="25000">$25000</option>
										<option value="50000">$50000</option>
										<option value="75000">$75000</option>
										<option value="100000">$100000</option>
										<option value="150000">$150000</option>
										<option value="200000">$200000</option>
										<option value="300000">$300000</option>
										<option value="500000">$500000</option>
										<option value="750000">$750000</option>
										<option value="1000000">$1000000</option>
										<option value="1000000plus">>$1000000</option>
									</select>
								</div>
							
								<button type="submit" class="btn btn-fullcolor">Search</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		 END HOME ADVANCED SEARCH -->
		
		<!-- BEGIN PROPERTIES SLIDER WRAPPER-->
		<div class="parallax pattern-bg" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Proyek Properti</h1>
						
						<div id="featured-properties-slider" class="owl-carousel fullwidthsingle" data-animation-direction="from-bottom" data-animation-delay="250">
							{{ App\Proyek::preview_home_online() }}
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- END PROPERTIES SLIDER WRAPPER -->
		
		<!-- BEGIN CONTENT WRAPPER -->
		<div class="content">
			<div class="container">
				<div class="row">
				
					<!-- BEGIN MAIN CONTENT -->
					<div class="main col-sm-8">
						<h1 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Tipe Perumahan</h1>

						<div class="grid-style1 clearfix">
							{{ App\Tipeproyek::preview_home_online() }}
						</div>
						
						
						<h1 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Latest News</h1>
						<div class="grid-style1">
							{{ App\Posts::preview_home_online() }}
						</div>
						
						<div class="center"><a href="blog-listing1.html" class="btn btn-default-color" data-animation-direction="from-bottom" data-animation-delay="850">View All News</a></div>
					</div>
					<!-- END MAIN CONTENT -->
					
					<!-- BEGIN SIDEBAR -->
					<div class="sidebar colored col-sm-4">
						
						<!-- BEGIN SIDEBAR ABOUT -->
						<div class="col-sm-12">
							<h2 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">About Us</h2>
							<p class="center" data-animation-direction="from-bottom" data-animation-delay="200">
								{{ $R->about }}
							</p>
						</div>

						<div class="col-sm-12">
							<h2 class="section-title" data-animation-direction="from-bottom" data-animation-delay="50">Lokasi Proyek</h2>
							<div id="show-maps" style="height: 400px;"></div>
						</div>
						<!-- END SIDEBAR ABOUT -->
						
                        <!-- BEGIN NEWSLETTER -->
						<div class="col-sm-12" data-animation-direction="from-bottom" data-animation-delay="200">
							<div id="newsletter" class="col-sm-12">
								<h2 class="section-title">rumahsubsidiceria.com<br><span>Kontak Kami</span></h2>
								<form>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control input-sm" placeholder="Nama" name="txtnama">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control input-sm" placeholder="Email" name="txtemail">
								</div>
								<div class="form-group">
									<label>No.HP</label>
									<input type="text" class="form-control input-sm" placeholder="No Handphone" name="txtnohp">
								</div>
								<div class="form-group">
									<label>Pesan</label>
									<textarea name="txtpesan" cols="10" class="form-control input-sm" style="height:100px"></textarea>
								</div>
								<button type="submit" class="btn btn-default">Submit</button>
								</form>
							</div>
						</div>
						<!-- END NEWSLETTER -->
						
					</div>
					<!-- END SIDEBAR -->
					
				</div>
			</div>
		</div>
        <!-- END CONTENT WRAPPER -->
        
        <!-- BEGIN HOME SLIDER SECTION -->
        <div id="countup" class="parallax dark-bg" data-stellar-background-ratio="0.5" style="background-position: -25px -143.5px;">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="section-title animate-from-top animation-from-top" data-animation-direction="from-top" data-animation-delay="50">VIDEO</h1>
						
						<iframe width="100%" height="420px" src="https://www.youtube.com/embed/jpvah7nDdWA?rel=0&showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
					</div>

				</div>
			</div>
		</div>
        		
        <!-- BEGIN TESTIMONIALS -->
        <!--
		<div class="parallax dark-bg" style="background-image:url(images/testimonials-img.jpg);" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-sm-12" data-animation-direction="from-top" data-animation-delay="50">
						<h2 class="section-title">Testimonials</h2>
						
						<div id="testimonials-slider" class="owl-carousel testimonials">
							<div class="item">
								<blockquote class="text">
									<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Pellentesque elementum libero enim, eget gravida nunc laoreet et. Nullam ac enim auctor, fringilla risus at, imperdiet turpis.</p>
								</blockquote>
								<div class="col-md-5 center">
									<div class="author">
										<img src="images/client1.jpg" alt="" />
										<div>
											Mark Maecenas<br>
											<span>CEO at Lorem Ipsum Agency</span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="item">
								<blockquote class="text">
									<p>Pellentesque elementum libero enim, eget gravida nunc laoreet et. Nullam ac enim auctor, fringilla risus at, imperdiet turpis.</p>
								</blockquote>
								<div class="col-md-5 center">
									<div class="author">
										<img src="images/client2.jpg" alt="" />
										<div>
											John Doe<br>
											<span>CTO at Dolor Sit Amet Agency</span>
										</div>
									</div>
								</div>
							</div>
								
							<div class="item">
								<blockquote class="text">
									<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Pellentesque elementum libero enim, eget gravida nunc laoreet et. Nullam ac enim auctor, fringilla risus at, imperdiet turpis. Nullam ac enim auctor, fringilla risus at, imperdiet turpis.</p>
								</blockquote>
								<div class="col-md-5 center">
									<div class="author">
										<img src="images/client3.jpg" alt="" />
										<div>
											Mary Smith<br>
											<span>UFO at Some Agency</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        -->
		<!-- END TESTIMONIALS -->
		<script type="text/javascript">
		var map;
		function initMap() {
			var mapOptions = {
			center: new google.maps.LatLng(-6.8974236,110.5004342,11),
			zoom: 10,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
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
			};
			map = new google.maps.Map(document.getElementById("show-maps"),
				mapOptions);
		}
		</script>
		<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA410jI9jrile0OCUsyo7xUIRVtm4sw5_k&callback=initMap'></script>
		<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
		<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
		<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>
		<script>
			var infoWindow = new google.maps.InfoWindow();
			$.getJSON('{{ url('api/jsonlocationproyek') }}', function(res) {
				$.each(res, function(key, data) {
					var latLng = new google.maps.LatLng(data.lat, data.lang); 
					// Creating a marker and putting it on the map
					var marker = new google.maps.Marker({
						map : map,
						position: latLng,
						title: data.nm_proyek,
						foto: data.uri_pic_proyek
					});
					marker.setMap(map);
					google.maps.event.addListener(marker, "click", function(e) {
						infoWindow.setContent('<div class="infoBox"><div class="infoWindowAgency"><h3>'+ data.nm_proyek +'</h3><a href="agency-detail.html"><img src="'+ data.uri_pic_proyek +'"></a><div class="center"><a class="btn btn-fullcolor" href="{{ url('properties') }}/'+ data.nm_proyek.replace(/ /gi, "_").toLowerCase() +'">View More</a></div></div></div>');
						infoWindow.open(map, marker);
					});
				});
				
			});
			var form = $('form');
			form.formValidation({
				framework: 'bootstrap',
				excluded: ':disabled',
				message: 'This value is not valid',
				row: {
					invalid: 'text-danger'
				},
				icon: {
					valid: '',
					invalid: '',
					validating: ''
				},
				fields: {
					txtnama: {
						validators: {
							notEmpty: {},
						}
					},
					txtemail: {
						validators: {
							notEmpty: {},
						}
					},
					txtnohp: {
						validators: {
							notEmpty: {},
						}
					},
					txtpesan: {
						validators: {
							notEmpty: {},
						}
					}
				}
			})
			.on('err.field.fv', function(e, data) {
				if (data.fv.getSubmitButton()) {
					data.fv.disableSubmitButtons(false);
				}
			})
			.on('success.field.fv', function(e, data) {
				if (data.fv.getSubmitButton()) {
					data.fv.disableSubmitButtons(false);
				}
			})
			.on('success.form.fv', function(e) {
				// Prevent form submission
				e.preventDefault();
				$.post('', {}, function(res){
					if( res.Status == 1 ) {
						form[0].reset();
					} else {
						alert(res.Msg);
					}
				}, 'json');
				
			});
		</script>
		@endsection 
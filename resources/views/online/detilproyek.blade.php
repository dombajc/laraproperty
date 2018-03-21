@extends( 'layouts.online' )

@section( 'content' )
	
    <main>
        @extends( 'layouts.headernohome' )

		<div class="bg_color_1">
			<nav class="secondary_nav sticky_horizontal">
				<div class="container">
					<ul class="clearfix">
						<li><a href="#siteplan" class="active">Siteplan</a></li>
                        <li><a href="#description">Deskripsi</a></li>
                        <li><a href="#lessons">Tipe</a></li>
					</ul>
				</div>
			</nav>
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-12">
                        <section id="siteplan">
							<!-- /box_highlight -->
							<h2>Siteplan</h2>
							<img src="<?= $row->uri_pic_master_plan ?>" class="img-fluid"
							<!-- /row -->
						</section>
						<!-- /section -->
						<section id="description">
							<!-- /box_highlight -->
							<h2>Deskripsi</h2>
							<?= $row->desc_proyek ?>
							<!-- /row -->
						</section>
						<!-- /section -->
						
						<section id="lessons">
							<div class="intro_title">
								<h2>Tipe</h2>
							</div>
							<div id="accordion_lessons" role="tablist" class="add_bottom_45">
                                @foreach ( $tipes as $tipe )
								<div class="card">
									<div class="card-header" role="tab" id="headingOne">
										<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse{{ $tipe->id_tipe_proyek }}" aria-expanded="true" aria-controls="collapseOne"><i class="indicator ti-minus"></i> {{ $tipe->nm_tipe }}</a>
										</h5>
									</div>

									<div id="collapse{{ $tipe->id_tipe_proyek }}" class="collapse" role="tabpanel" aria-labelledby="headingOne">
										<div class="card-body">
											<div class="list_lessons_2">
												<ul>
													<li>Luas Bangunan<span> {{ $tipe->luas_bangunan }} M<sup>2</sup></span></li>
													<li>Kamar Tidur<span> {{ $tipe->jml_kmr_tidur }}</span></li>
													<li>Kamar Mandi<span> {{ $tipe->jml_kmr_mandi }}</span></li>
													<li>Garasi<span> {{ $tipe->garasi }}</span></li>
													<li>Total Unit<span> {{ empty($total_unit_per_tipe[$tipe->id_tipe_proyek]) ? 0 : $total_unit_per_tipe[$tipe->id_tipe_proyek] }}</span></li>
                                                </ul>
                                                <a href="{{ url('list_kapling/'. $tipe->id_tipe_proyek) }}" class="btn btn-sm btn-info">Lihat Kapling</a>
											</div>
										</div>
									</div>
                                </div>
                                @endforeach
							</div>
							<!-- /accordion -->
						</section>
					</div>
					<!-- /col -->
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>
    <!--/main-->
    <script>
        document.getElementById("hero_in").style.background = "url('{{ $row->uri_pic_proyek }}') no-repeat right top fixed";
    </script>
@endsection  
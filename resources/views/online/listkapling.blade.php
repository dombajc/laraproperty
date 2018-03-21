@extends( 'layouts.online' )

@section( 'content' )
	
	<main>
        @extends( 'layouts.headernohome' )

		<div class="container margin_60_35">
			<div class="row">
                <aside class="col-lg-3" id="sidebar">
                    <button type="button" class="btn btn-sm btn-danger btn-block" onClick="location.href='{{ $url_back }}'">Kembali</button>
					<div id="filters_col"> <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
						<div class="collapse show" id="collapseFilters">
							<div class="filter_type">
                                <form>
								<div class="form-group">
                                    <label>Alamat Kapling</label>
                                    <input type="text" class="form-control" name="key_address" id="key_address">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="key_sts" id="key_sts">
                                        <option value=""> -- Keseluruhan -- </option>
                                        <option value="0"> Belum Terjual </option>
                                        <option value="1"> Terjual </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-block btn-info"> Cari </button>
                                </div>
                                </form>
							</div>
						</div>
						<!--/collapse -->
					</div>
					<!--/filters col-->
				</aside>
                <!-- /aside -->
                <div class="col-lg-9" id="listing">
					
                    @if (count($listing) > 0)
                        @include('online.loadpagingkapling')
                    @endif
                    
                </div> 
			</div>
			<!-- /row -->
		</div>
		
	</main>
    <!--/main-->
	<script type="text/javascript">
        document.getElementById("hero_in").style.background = "url('{{ $row->uri_pic_proyek }}') no-repeat right top fixed";
        $('#key_address').val('{{ $req->key_address }}');
        $('#key_sts').val('{{ $req->key_sts }}');
        $(function() {
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#load a').css('color', '#dfecf6');
                $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });

            function getArticles(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#listing').html(data);
                }).fail(function () {
                    alert('Listing could not be loaded.');
                });
            }
        });
    </script>
@endsection  
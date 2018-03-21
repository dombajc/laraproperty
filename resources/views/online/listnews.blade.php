@extends( 'layouts.online' )

@section( 'content' )
    <link href="{{ url('online3/css/blog.css') }}" rel="stylesheet">
	<main>
        @extends( 'layouts.headernohome' )

		<div class="container margin_60_35">
			<div class="row">
                <aside class="col-lg-3" id="sidebar">
					<div id="filters_col"> <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
						<div class="collapse show" id="collapseFilters">
							<div class="filter_type">
                                <form>
								<div class="form-group">
                                    <label>Kata Kunci</label>
                                    <input type="text" class="form-control" name="key_word" id="key_word">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="key_category" id="key_category">
                                        <option value=""> -- Keseluruhan -- </option>
                                        {{ App\Kategori::opsi() }}
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
					
                    @if (count($news) > 0)
                        @include('online.loadpagingnews')
                    @endif
                    
                </div> 
			</div>
			<!-- /row -->
		</div>
		
	</main>
    <!--/main-->
	<script type="text/javascript">
        $('#key_word').val('{{ $req->key_word }}');
        $('#key_category').val('{{ $req->key_category }}');
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

@extends( 'layouts.online4' )

@section( 'content' )
	<!-- BEGIN PAGE TITLE/BREADCRUMB -->
	<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="page-title">{{ ucfirst($kategori) }}</h1>
					
					<ul class="breadcrumb">
						<li><a href="{{ url('/') }}">Home </a></li>
						<li><a href="{{ url('news/'. $kategori) }}">{{ ucfirst($kategori) }}</a></li>
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
				
					<div id="listing-header" class="clearfix">
						<!--
						<div class="form-control-small">
							<select id="sort_by" name="sort_by" data-placeholder="Sort">
								<option value=""> </option>
								<option value="data">Sort by Date</option>
								<option value="area">Sort by Area</option>
							</select>
						</div>
						
						<div class="sort">
							<ul>
								<li class="active"><i data-toggle="tooltip" data-placement="top" title="Sort Descending" class="fa fa-chevron-down"></i></li>
								<li><i data-toggle="tooltip" data-placement="top" title="Sort Ascending" class="fa fa-chevron-up"></i></li>
							</ul>
						</div>
						-->
						<div class="view-mode">
							<span>View Mode:</span>
							<ul>
								<li data-view="grid-style1" data-target="blog-listing" class="active"><i class="fa fa-th"></i></li>
								<li data-view="list-style" data-target="blog-listing"><i class="fa fa-th-list"></i></li>
							</ul>
						</div>
					</div>
					
					<!-- BEGIN BLOG LISTING -->
					<div id="blog-listing" class="grid-style1 clearfix">
						@if (count($news) > 0)
							@include('online4.load_paging_news')
						@endif
						
												
					</div>
					<!-- END BLOG LISTING -->
					
				</div>	
				<!-- END MAIN CONTENT -->
				
				
				<!-- BEGIN SIDEBAR -->
				<div class="sidebar gray col-sm-4">
					
					<h2 class="section-title">Kategori</h2>
					<ul class="categories">
						{{ App\Kategori::get_list_resume_sidebar() }}
					</ul>
					
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

	<script type="text/javascript">
        //$('#key_word').val('{{ $req->key_word }}');
        //$('#key_category').val('{{ $req->key_category }}');
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
                    $('#blog-listing').html(data);
                }).fail(function () {
                    alert('Listing could not be loaded.');
                });
            }

            
        });
    </script>
@endsection 
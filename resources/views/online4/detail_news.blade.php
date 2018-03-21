
@extends( 'layouts.online4' )

@section( 'content' )
<!-- BEGIN PAGE TITLE/BREADCRUMB -->
	<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="page-title">{{ ucfirst($kategori) }} Detail</h1>
					
					<ul class="breadcrumb">
						<li><a href="{{ url('/') }}">Home </a></li>
						<li><a href="{{ url('news/'. $kategori) }}">{{ ucfirst($kategori) }}</a></li>
						<li><a href="{{ url('news/'. $kategori .'?n='. $R->id_berita) }}">{{ ucfirst($kategori) }} Detail</a></li>
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
				
					<h1 class="blog-title">{{ $R->judul }}</h1>
					
					<div class="blog-main-image">
						<img src="{{ url($R->foto) }}" alt="" />
						<div class="tag"><i class="fa fa-file-text"></i></div>
					</div>
					
					<div class="blog-bottom-info">
						<ul>
							<li><i class="fa fa-calendar"></i> {{ App\Fungsi::format_sql_to_indo($R->create_on) }}</li>
							<li><i class="fa fa-tags"></i> {{ $R->kategori_berita }}</li>
						</ul>
						
						<div id="post-author"><i class="fa fa-pencil"></i> By {{ $R->nm_user }}</div>
					</div>
					
					<div class="post-content">
						<?= $R->content ?>
					</div>
					
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
@endsection 
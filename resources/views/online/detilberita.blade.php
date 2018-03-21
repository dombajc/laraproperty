@extends( 'layouts.online' )

@section( 'content' )
	<link href="{{ url('online3/css/blog.css') }}" rel="stylesheet">
    <main>
        @extends( 'layouts.headernohome' )

		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-9">
					<div class="bloglist singlepost">
						<p><img alt="" class="img-fluid" src="{{ url($row->foto) }}"></p>
						<h1>{{ $row->judul }}</h1>
						<div class="postmeta">
							<ul>
								<li><a href="#"><i class="icon_folder-alt"></i> {{ $row->kategori_berita }}</a></li>
								<li><a href="#"><i class="icon_clock_alt"></i> {{ $row->tgl }} {{ App\Fungsi::getBulan($row->bln) }} {{ $row->thn }} </a></li>
								<li><a href="#"><i class="icon_pencil-edit"></i> Admin</a></li>
							</ul>
						</div>
						<!-- /post meta -->
						<div class="post-content">
							<div class="dropcaps">
								<?= $row->content ?> 
							</div>
						</div>
						<!-- /post -->
					</div>
					<!-- /single-post -->

				</div>
				<!-- /col -->
				<aside class="col-lg-3">
					<!-- /widget -->
					<div class="widget">
						<div class="widget-title">
							<h4>Recent Posts</h4>
						</div>
						<ul class="comments-list">
						</ul>
					</div>
					<!-- /widget -->
					<div class="widget">
						<div class="widget-title">
							<h4>Kategori</h4>
						</div>
						<ul class="cats">
						</ul>
					</div>
					<!-- /widget -->
					
				</aside>
			</div>
			<!-- /row -->
		</div>
		<!-- /bg_color_1 -->
		
	</main>
    <!--/main-->
    <script>
		$.get('{{ url('remote_random_news') }}', { 'idShow' : '{{ $row->id_berita }}'}, function(res) {
			var list_post = $('.comments-list');
			list_post.empty();
			$.each(res, function(key, val){
				list_post.append('<li>'+
				'<div class="alignleft">'+
				'<a href="{{ url('/') }}/news_detil/'+ val.id_berita +'"><img src="{{ url('/') }}/'+ val.foto +'" alt=""></a>'+
				'</div>'+
				'<small>'+ val.tgl +' / '+ val.kategori_berita +'</small>'+
				'<h3><a href="{{ url('/') }}/news_detil/'+ val.id_berita +'" title="">'+ val.judul +'</a></h3>'+
				'</li>');
			});
		}, 'json')
		.fail(function(jqXHR, textStatus) {
			alert(jqXHR);
		});

		$.get('{{ url('remote_resume_category') }}', {}, function(res){
			var list_kategori = $('.cats');
			list_kategori.empty();
			$.each(res, function(key, val){
				list_kategori.append('<li><a href="{{ url('news?key_word=&key_category=') }}'+ val.id_kategori_berita +'">'+ val.kategori_berita +' <span>('+ val.jml +')</span></a></li>');
			});
		}, 'json')
		.fail(function(jqXHR, textStatus) {
			alert(jqXHR);
		});
    </script>
@endsection  

@extends( 'layouts.online4' )

@section( 'content' )
	
	<!-- BEGIN PAGE TITLE/BREADCRUMB -->
	<div class="parallax colored-bg pattern-bg" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="page-title">Daftar Properti</h1>
					
					<ul class="breadcrumb">
						<li><a href="{{ url('/') }}">Home </a></li>
						<li><a href="{{ url('properties') }}">Properties</a></li>
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
				<div class="main col-sm-12" id="blog-listing">			
						
					@if (count($tipes) > 0)
						@include('online4.load_paging_properti')
					@endif
					
				</div>	
				<!-- END MAIN CONTENT -->

			</div>
		</div>
	</div>
	<!-- END CONTENT WRAPPER -->

	<script type="text/javascript">
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
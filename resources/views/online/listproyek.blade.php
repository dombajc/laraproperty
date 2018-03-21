@extends( 'layouts.online' )

@section( 'content' )
	
	<main>
        @extends( 'layouts.headernohome' )

		<div class="container margin_60_35">
			<div class="row">
                @if (count($proyeks) > 0)
                    @include('online.loadpagingproyek')
                @endif
			</div>
			<!-- /row -->
		</div>
		
	</main>
    <!--/main-->
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
                    $('.articles').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            }
        });
    </script>
@endsection  
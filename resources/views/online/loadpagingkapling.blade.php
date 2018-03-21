<div class="row">
@foreach($listing as $r)
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="box_grid wow">
            <figure class="block-reveal">
                <div class="block-horizzontal"></div>
                @if ( $r->sts_terjual == 1 )
                <div class="sts">
                    Terjual
                </div>
                @endif
                <a href="course-detail.html"><img src="{{ $r->nm_image }}" class="img-fluid" alt=""></a>
                <div class="price">Rp. {{ number_format($r->harga,2) }}</div>
            </figure>
            <div class="wrapper">
                <h3>{{ $r->alamat }}</h3>
                <p>
                    Luas tanah : {{ $r->luas_tanah }} m<sup>2</sup><br>
                    Luas bangunan : {{ $r->luas_bangunan }} m<sup>2</sup><br>
                    KLT : {{ $r->luas_tanah - $r->luas_bangunan }}
                </p>
            </div>
            
        </div>
    </div>
    <!-- /box_grid -->
@endforeach
</div>

<nav aria-label="...">
{{ $listing->links('online.custompagingproyek') }}
</nav>


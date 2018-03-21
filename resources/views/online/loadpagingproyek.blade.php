
@foreach($proyeks as $proyek)
    <div class="col-xl-4 col-lg-4 col-md-4">
        <div class="box_grid wow">
            <figure class="block-reveal">
                <div class="block-horizzontal"></div>
                <a href="product_detil/{{ $proyek->id_proyek }}"><img src="{{ $proyek->uri_pic_proyek }}" class="img-fluid" alt=""></a>
                <div class="price">Luas : {{ number_format($proyek->luas_proyek) }} HA</div>
            </figure>
            <div class="wrapper">
                <small>Category</small>
                <h3>{{ $proyek->nm_proyek }}</h3>
                <p>{{ $proyek->alamat }}<br>{{ $proyek->nm_kota }}<br>{{ $proyek->nm_provinsi }}</p>
                <a href="product_detil/{{ $proyek->id_proyek }}" class="btn btn-sm btn-info pull-right">Detail</a>
            </div>
        </div>
    </div>
    <!-- /box_grid -->
@endforeach
<nav aria-label="...">
{{ $proyeks->links('online.custompagingproyek') }}
</nav>


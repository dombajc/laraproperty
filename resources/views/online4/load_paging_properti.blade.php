<?php $cols = 1; ?>
<div id="property-listing" class="grid-style1 clearfix">
<div class="row">
@foreach($tipes as $r)
     
    <div class="item col-sm-4"><!-- Set width to 4 columns for grid view mode only -->
        <div class="image">
            <a href="{{ url('properties/'. str_replace(' ', '_', strtolower($r->nm_proyek)) ) }}">
                <h3>{{ $r->nm_proyek }}</h3>
                <span class="location">{{ $r->alamat }}</span>
            </a>
            <img src="{{ $r->uri_pic_tipe }}" alt="" />
        </div>
        <div class="price">
            <i class="fa fa-home"></i>{{ $r->nm_tipe }}
            <span>Rp. {{ number_format($r->harga_standar, 2) }}</span>
        </div>
        <ul class="amenities">
            <li><i class="icon-area"></i> {{ $r->luas_bangunan }} m<sup>2</sup></li>
            <li><i class="icon-bedrooms"></i> {{ $r->jml_kmr_tidur }}</li>
            <li><i class="icon-bathrooms"></i> {{ $r->jml_kmr_mandi }}</li>
        </ul>
    </div>
    
@endforeach
</div>
</div>
<nav aria-label="...">
{{ $tipes->links('online4.custom_paging') }}
</nav>


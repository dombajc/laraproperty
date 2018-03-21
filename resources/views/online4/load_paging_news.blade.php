<?php $cols = 1; ?>
<div class="row">
@foreach($news as $r)
     
    <div class="item col-xs-6"><!-- Set width to 4 columns for grid view mode only -->
        <div class="image">
            <a href="{{ url('news/'. strtolower($r->kategori_berita) .'?n='. $r->id_berita ) }}">
                <span class="btn btn-default"><i class="fa fa-file-o"></i> Read More</span>
            </a>
            <img src="{{ url($r->foto) }}" alt="" />
        </div>
        <div class="tag"><i class="fa fa-file-text"></i></div>
        <div class="info-blog">
            <ul class="top-info">
                <li><i class="fa fa-calendar"></i> {{ App\Fungsi::format_sql_to_indo($r->create_on) }}</li>
                <li><i class="fa fa-tags"></i> {{ $r->kategori_berita }}</li>
            </ul>
            <h3>
                <a href="{{ url('news/'. strtolower($r->kategori_berita) .'?n='. $r->id_berita ) }}">{{ $r->judul }}</a>
            </h3>
        </div>
    </div>
    
@endforeach
</div>
<nav aria-label="...">
{{ $news->links('online4.custom_paging') }}
</nav>


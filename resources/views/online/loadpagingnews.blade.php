
@foreach($news as $r)
    <article class="blog wow fadeIn">
        <div class="row no-gutters">
            <div class="col-lg-7">
                <figure>
                    <a href="{{ url('news_detil/'. $r->id_berita) }}"><img src="{{ $r->foto }}" alt="">
                        <div class="preview"><span>Read more</span></div>
                    </a>
                </figure>
            </div>
            <div class="col-lg-5">
                <div class="post_info">
                    <small>{{ $r->hari }} {{ App\Fungsi::getBulan($r->bln) }} {{ $r->thn }} / {{ $r->kategori_berita }}</small>
                    <h3><a href="{{ url('news_detil/'. $r->id_berita) }}">{{ $r->judul }}</a></h3>
                </div>
            </div>
        </div>
    </article>
    <!-- /box_grid -->
@endforeach

<nav aria-label="...">
{{ $news->links('online.custompagingproyek') }}
</nav>


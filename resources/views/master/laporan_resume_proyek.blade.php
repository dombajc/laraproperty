@extends( 'layouts.app' )

@section( 'content' )

<div class="content-header no-mg-top">
    <i class="{{ $icon }}"></i>
    <div class="content-header-title">{{ $title }}</div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Form control -->
        <div class="content-box">
            <div class="form-group row">
                <label class="col-form-label col-sm-2 col-lg-2">Proyek</label>
                <div class="col-sm-4 col-lg-3">
                    <select class="form-control input-sm" id="fproyek">
                        {{ App\Proyek::opsi() }}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 col-lg-3">
                    <button type="button" class="btn btn-sm btn-default" id="btn-preview"> Preview </button>
                    <button type="button" class="btn btn-sm btn-default" id="btn-excel"> EXCEL </button>
                </div>
            </div>

            <div id="show-laporan"></div>  

        </div><!-- .card -->
        <!-- /End Form control -->
        
    </div><!-- .col -->

</div>

<script type="text/javascript" src="{{ url('scripts/laporan_resume_proyek.js') }}"></script>

@endsection           
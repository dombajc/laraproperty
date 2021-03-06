@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/datepicker/datepicker.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/datepicker/datepicker3.min.css' ) }}" />

<div class="content-header no-mg-top">
    <i class="{{ $icon }}"></i>
    <div class="content-header-title">{{ $title }}</div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Form control -->
        <div class="content-box">
            <div class="form-group row">
                <label class="col-form-label col-sm-3 col-lg-2">Proyek</label>
                <div class="col-sm-6 col-lg-4">
                    <select class="form-control input-sm" id="fproyek">
                        <option value=""> -- Keseluruhan -- </option>
                        {{ App\Proyek::opsi() }}
                    </select>
                </div>
                <label class="col-form-label col-sm-2 col-lg-1">Tipe</label>
                <div class="col-sm-4 col-lg-3">
                    <select class="form-control input-sm" id="ftipe">
                        <option value=""> -- Keseluruhan -- </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 col-lg-2">Tgl Transaksi</label>
                <div class="col-sm-6 col-lg-4" id="tgltr">
                    <div class="input-group input-daterange input-append date">
                        <input type="text" class="form-control input-sm text-center" id="ftglstart">
                        <div class="input-group-addon"> s.d </div>
                        <input type="text" class="form-control input-sm text-center" id="ftglend">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 col-lg-2">Cara Pembayaran</label>
                <div class="col-sm-6 col-lg-4">
                    <select class="form-control input-sm" id="fcarabayar">
                        <option value=""> -- Keseluruhan -- </option>
                        {{ App\Carapembayaran::opsi() }}
                    </select>
                </div>
                <label class="col-form-label col-sm-2 col-lg-1">Marketing</label>
                <div class="col-sm-6 col-lg-4">
                    <select class="form-control input-sm" id="fmarketing">
                        <option value=""> -- Keseluruhan -- </option>
                        {{ App\Marketing::opsi() }}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 col-lg-3">
                    <button type="button" class="btn btn-sm btn-default" id="btn-preview"> Preview </button>
                    <button type="button" class="btn btn-sm btn-default" id="btn-pdf"> PDF </button>
                    <button type="button" class="btn btn-sm btn-default" id="btn-excel"> EXCEL </button>
                </div>
            </div>

            <div id="show-laporan"></div>  

        </div><!-- .card -->
        <!-- /End Form control -->
        
    </div><!-- .col -->

</div>

<script type="text/javascript" src="{{ url( '/plugins/datepicker/bootstrap-datepicker.min.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/laporan_penjualan.js') }}"></script>

@endsection           
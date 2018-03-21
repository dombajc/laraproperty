@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/dataTable/jquery.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/dataTable/responsive.dataTables.min.css' ) }}" />
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
                    <select class="form-control input-sm" id="cariproyek">
                        <option value=""> -- Keseluruhan -- </option>
                        {{ App\Proyek::opsi() }}
                    </select>
                </div>
                <label class="col-form-label col-sm-2 col-lg-1">Tipe</label>
                <div class="col-sm-4 col-lg-3">
                    <select class="form-control input-sm" id="caritipe">
                        <option value=""> -- Keseluruhan -- </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 col-lg-2">Alamat</label>
                <div class="col-sm-6 col-lg-4">
                    <input type="text" class="form-control input-sm" id="carialamat">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 col-lg-2">Tgl Pembatalan</label>
                <div class="col-sm-6 col-lg-4" id="tgltr">
                    <div class="input-group input-daterange input-append date">
                        <input type="text" class="form-control input-sm text-center" id="txttglawal">
                        <div class="input-group-addon"> s.d </div>
                        <input type="text" class="form-control input-sm text-center" id="txttglakhir">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div> 
                </div>
                <label class="col-form-label col-sm-2 col-lg-1">Nama</label>
                <div class="col-sm-6 col-lg-4">
                    <input type="text" class="form-control input-sm" id="carinama">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 col-lg-3">
                    <button type="button" class="btn btn-sm btn-default" id="btn-cari"> Temukan </button>
                </div>
            </div>   
            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-gear"></i></th>
                        <th>TGL BATAL</th>
                        <th>KAPLING</th>
                        <th>ALASAN</th>
                        <th>TIPE</th>
                        <th>PROYEK</th>
                    </tr>
                </thead>
            </table>

        </div><!-- .card -->
        <!-- /End Form control -->

    </div><!-- .col -->

</div>

<!-- sample modal content -->
<div id="modal-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodel">PROSES PENJUALAN KAPLING</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="form">
                    <input type="hidden" name="hid" id="hid">
                    <input type="hidden" name="haksi" id="haksi" value="add">
                    <input type="hidden" name="hidpenjualan" id="hidpenjualan">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <h6>DATA KONSUMEN</h6>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm nik" id="txtnik" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="txtnama" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">No.HP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="txtnohp" disabled>
                                </div>
                            </div>
                            <h6>DATA KAPLING</h6>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="txtkapling" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Tipe</label>
                                <div class="col-sm-9">
                                    <div class="input-group input-append">
                                        <input type="text" class="form-control input-sm text-center" id="txttipe" disabled>
                                        <span class="input-group-addon add-on">Proyek</span>
                                        <input type="text" class="form-control input-sm text-center" id="txtproyek" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h6>RIWAYAT TRANSAKSI</h6>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Tanggal Jual</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append date">
                                        <input type="text" class="form-control input-sm text-center" id="txttgljual" disabled>
                                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Total</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append">
                                        <span class="input-group-addon add-on">Rp.</span>
                                        <input type="text" class="form-control input-sm number text-right" name="txttotal" id="txttotal" disabled>
                                        <span class="input-group-addon add-on">,00</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Tanggal Batal</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append date">
                                        <input type="text" class="form-control input-sm text-center" name="txttgl" id="txttgl">
                                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Alasan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control input-sm" cols="5" name="txtalasan" id="txtalasan">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">BATAL</button>
                            <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript" src="{{ url( '/plugins/datepicker/bootstrap-datepicker.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/data_pembatalan.js') }}"></script>

@endsection           
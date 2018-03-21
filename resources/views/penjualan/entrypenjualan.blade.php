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
                <label class="col-form-label col-sm-2 col-lg-1">Proyek</label>
                <div class="col-sm-4 col-lg-3">
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
                <label class="col-form-label col-sm-2 col-lg-1">Alamat</label>
                <div class="col-sm-4 col-lg-3">
                    <input type="text" class="form-control input-sm" id="carialamat">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 col-lg-1"></label>
                <div class="col-sm-4 col-lg-3">
                    <button type="button" class="btn btn-sm btn-default" id="btn-cari"> Temukan </button>
                </div>
            </div>
            Dibawah ini merupakan data kapling yang tersedia. Silahkan pilih kapling di bawah ini untuk menambah transaksi
            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-gear"></i></th>
                        <th>ALAMAT</th>
                        <th>LUAS BANGUNAN</th>
                        <th>LUAS TANAH</th>
                        <th>HARGA</th>
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
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <h6>DATA KONSUMEN</h6>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm nik" name="txtnik" id="txtnik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtnama" id="txtnama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtalamat" id="txtalamat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">e-Mail</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtemail" id="txtemail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">No.HP</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtnohp" id="txtnohp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtpekerjaan" id="txtpekerjaan">
                                </div>
                            </div>
                            <h6>DATA KAPLING</h6>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="txtidkapling" id="txtidkapling">
                                    <input type="text" class="form-control input-sm" name="txtkapling" id="txtkapling" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Tipe</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txttipe" id="txttipe" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Luas Bangunan</label>
                                <div class="col-sm-6">
                                    <div class="input-group input-append">
                                        <input type="text" class="form-control input-sm number text-right" name="txtluasbangunan" id="txtluasbangunan" disabled>
                                        <span class="input-group-addon add-on">m2</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6">Luas Tanah</label>
                                <div class="col-sm-6">
                                    <div class="input-group input-append">
                                        <input type="text" class="form-control input-sm number text-right" name="txtluastanah" id="txtluastanah" disabled>
                                        <span class="input-group-addon add-on">m2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h6>TRANSAKSI</h6>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Tanggal</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append date">
                                        <input type="text" class="form-control input-sm text-center" name="txttgl" id="txttgl">
                                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Ket. Biaya Lainnya</label>
                                <div class="col-sm-7">
                                    <textarea rows="5" class="form-control input-sm" id="txtketbiayalain" name="txtketbiayalain"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Biaya Lainnya</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append">
                                        <span class="input-group-addon add-on">Rp.</span>
                                        <input type="text" class="form-control input-sm number text-right hitung" name="txtbiayalain" id="txtbiayalain">
                                        <span class="input-group-addon add-on">,00</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Harga Standar</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append">
                                        <span class="input-group-addon add-on">Rp.</span>
                                        <input type="text" class="form-control input-sm number text-right hitung" name="txthargakesepakatan" id="txthargakesepakatan">
                                        <span class="input-group-addon add-on">,00</span>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Harga KLT per meter</label>
                                <div class="col-sm-9">
                                    <div class="input-group input-append">
                                        <span class="input-group-addon add-on" id="txtklt"></span>
                                        <span class="input-group-addon add-on">x</span>
                                        <span class="input-group-addon add-on">Rp.</span>
                                        <input type="text" class="form-control input-sm text-right number" name="txthargaklt" id="txthargaklt">
                                        <span class="input-group-addon add-on">,00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Penambahan</label>
                                <div class="col-sm-7">
                                    <textarea rows="5" class="form-control input-sm" id="txtpenambahan" name="txtpenambahan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Biaya Tambahan</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-append">
                                        <span class="input-group-addon add-on">Rp.</span>
                                        <input type="text" class="form-control input-sm number text-right hitung" name="txtbiayatambahan" id="txtbiayatambahan">
                                        <span class="input-group-addon add-on">,00</span>
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
                                <label class="col-form-label col-sm-5">Marketing</label>
                                <div class="col-sm-7">
                                    <select class="form-control input-sm" id="slctmarketing" name="slctmarketing">
                                        <option value=""> -- Pilih salah satu -- </option>
                                        {{ App\Marketing::opsi() }}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-5">Cara Pembayaran</label>
                                <div class="col-sm-7">
                                    <select class="form-control input-sm" id="slctcarapembayaran" name="slctcarapembayaran">
                                        <option value=""> -- Pilih salah satu -- </option>
                                        {{ App\Carapembayaran::opsi() }}
                                    </select>
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
<script type="text/javascript" src="{{ url( 'plugins/jquery-number-master/jquery.number.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( '/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/entry_penjualan.js') }}"></script>

@endsection           
@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/dataTable/jquery.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/dataTable/responsive.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( 'plugins/fancybox/jquery.fancybox.min.css' ) }}" />

<div class="content-header no-mg-top">
    <i class="{{ $icon }}"></i>
    <div class="content-header-title">{{ $title }}</div>
    <button type="button" class="btn btn-sm btn-primary pull-right" id="btn-add">Tambah</button>
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
                <label class="col-form-label col-sm-2 col-lg-1">Status</label>
                <div class="col-sm-4 col-lg-3">
                    <select class="form-control input-sm" id="caristatus">
                        <option value=""> -- Keseluruhan -- </option>
                        <option value="0"> Belum Terjual </option>
                        <option value="1"> Terjual </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 col-lg-1"></label>
                <div class="col-sm-4 col-lg-3">
                    <button type="button" class="btn btn-sm btn-default" id="btn-cari"> Temukan </button>
                </div>
            </div>
            
            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-gear"></i></th>
                        <th>ALAMAT</th>
                        <th>LUAS TANAH ( m<sup>2</sup> )</th>
                        <th>HARGA</th>
                        <th>TIPE</th>
                        <th>PROYEK</th>
                        <th>STATUS</th>
                        <th>GALERI</th>
                    </tr>
                </thead>
            </table>

        </div><!-- .card -->
        <!-- /End Form control -->

    </div><!-- .col -->

</div>

<!-- sample modal content -->
<div id="modal-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodel">PENGELOLAAN KAPLING</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="form">
                    <input type="hidden" name="hid" id="hid">
                    <input type="hidden" name="haksi" id="haksi" value="add">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Proyek</label>
                        <div class="col-sm-7">
                            <select class="form-control input-sm" name="slctproyek" id="slctproyek">
                                <option value=""> -- Pilih salah satu -- </option>
                                {{ App\Proyek::opsi() }}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Tipe</label>
                        <div class="col-sm-7">
                            <input type="hidden" id="res-tipe">
                            <select class="form-control input-sm" name="slcttipe" id="slcttipe">
                                <option value=""> -- Pilih proyek dahulu -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Luas Tanah</label>
                        <div class="col-sm-5">
                            <div class="input-group input-append">
                                <input type="text" class="form-control input-sm text-right number" name="txtluas" id="txtluas">
                                <span class="input-group-addon add-on"> m2</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Alamat</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control input-sm" name="txtalamat" id="txtalamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Harga</label>
                        <div class="col-sm-7">
                            <div class="input-group input-append">
                                <span class="input-group-addon add-on">Rp.</span>
                                <input type="text" class="form-control input-sm text-right number" name="txtharga" id="txtharga">
                                <span class="input-group-addon add-on">,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Harga KLT per meter</label>
                        <div class="col-sm-7">
                            <div class="input-group input-append">
                                <span class="input-group-addon add-on">Rp.</span>
                                <input type="text" class="form-control input-sm text-right number" name="txthargaklt" id="txthargaklt">
                                <span class="input-group-addon add-on">,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Biaya Lain-lain</label>
                        <div class="col-sm-7">
                            <div class="input-group input-append">
                                <span class="input-group-addon add-on">Rp.</span>
                                <input type="text" class="form-control input-sm text-right number" name="txtbiayalain" id="txtbiayalain">
                                <span class="input-group-addon add-on">,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5">Keterangan Biaya Lain</label>
                        <div class="col-sm-7">
                            <textarea class="form-control input-sm" name="txtketbiayalain" id="txtketbiayalain" cols="20"></textarea>
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

<!-- sample modal content -->
<div id="modal-galeri" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodel">GALERI KAPLING</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Galeri</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Unggah Foto</a>
                </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table-galeri">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-gear"></i></th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <input type="hidden" id="idkapling">
                        <form class="form form-horizontal" id="uploaded" style="margin-top:10px;">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <p>
                                        * File harus berupa JPG or JPEG<br>
                                        * File maksimal upload 2M
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4 text-right">Unggah File</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control input-sm" name="unggahfile" id="unggahfile">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-sm btn-success">UPLOAD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/jquery-number-master/jquery.number.min.js' ) }}"></script>
<script src="{{ url( 'plugins/fancybox/jquery.fancybox.min.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/set_kapling.js') }}"></script>

@endsection           
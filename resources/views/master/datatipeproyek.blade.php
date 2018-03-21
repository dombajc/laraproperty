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
                <div class="col-sm-4 col-lg-2">
                    <select class="form-control input-sm" id="filterproyek">
                        <option value=""> -- Keseluruhan -- </option>
                        {{ App\Proyek::opsi() }}
                    </select>
                </div>
            </div>
            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-gear"></i></th>
                        <th>TIPE</th>
                        <th>LUAS BANGUNAN ( m<sup>2</sup> )</th>
                        <th>HARGA</th>
                        <th>JML UNIT</th>
                        <th>PROYEK</th>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodel">PENGELOLAAN TIPE PROYEK</h4>
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
                        <label class="col-form-label col-sm-5">Nama Tipe</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control input-sm" name="txtnama" id="txtnama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-5 text-right">Harga Standar</label>
                        <div class="col-sm-7">
                            <div class="input-group input-append">
                                <span class="input-group-addon add-on">Rp</span>
                                <input type="text" class="form-control input-sm text-right number" name="txtharga" id="txtharga">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6 text-right">Luas Bangunan</label>
                        <div class="col-sm-6">
                            <div class="input-group input-append">
                                <input type="text" class="form-control input-sm text-right number" name="txtluas" id="txtluas">
                                <span class="input-group-addon add-on">M2</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6 text-right">Kamar Tidur</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm text-right number" name="txtjmlkmrtidur" id="txtjmlkmrtidur">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6 text-right">Kamar Mandi</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm text-right number" name="txtjmlkmrmandi" id="txtjmlkmrmandi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-6 text-right">Garasi</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm text-right number" name="txtjmlgarasi" id="txtjmlgarasi">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodel">GALERI KAPLING</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idtipe">
                <button type="button" class="btn btn-sm btn-info" id="btn-add-upload"><i class="fa fa-plus"></i>Tambah Unggah Foto</button>
                <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table-galeri">
                    <thead>
                        <tr>
                            <th><i class="fa fa-gear"></i></th>
                            <th>Foto</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- sample modal content -->
<div id="modal-upload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titlemodel">UNGGAH FOTO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="uploaded" style="margin-top:10px;">
                    <input type="hidden" id="hidupload" name="hidupload">
                    <input type="hidden" id="haksiupload" name="haksiupload">
                    <div class="form-group row" id="src-foto">
                        <label class="col-form-label col-sm-3 text-right">Gambar Terupload</label>
                        <div class="col-sm-9">
                            <div class="media-row">
                                <div class="media-box">
                                    <div class="media-image">
                                        <img src="" id="gambar" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-right">Unggah File</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control input-sm" name="unggahfile" id="unggahfile">
                            <p>
                                * File harus berupa JPG or JPEG<br>
                                * File maksimal upload 2M
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 text-right">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control input-sm" cols="10" id="txtketerangan" name="txtketerangan"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-sm btn-success">UPLOAD</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/jquery-number-master/jquery.number.min.js' ) }}"></script>
<script src="{{ url( 'plugins/fancybox/jquery.fancybox.min.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/set_tipe_proyek.js') }}"></script>

@endsection           
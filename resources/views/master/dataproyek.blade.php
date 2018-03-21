@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/dataTable/jquery.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/dataTable/responsive.dataTables.min.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ url('plugins/bootstrap-daterangepicker-master/daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ url( '/plugins/confirm/jquery-confirm.min.css' ) }}" />

<div class="content-header no-mg-top">
    <i class="{{ $icon }}"></i>
    <div class="content-header-title">{{ $title }}</div>
    <button type="button" class="btn btn-sm btn-primary pull-right" data-backdrop="static"
   data-keyboard="false" id="btn-add">Tambah</button>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Form control -->
        <div class="content-box">
            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-gear"></i></th>
                        <th>NAMA PROYEK</th>
                        <th>ALAMAT</th>
                        <th>LUAS (HA)</th>
                        <th>PERIODE</th>
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
                <h4 class="modal-title" id="titlemodel">PENGELOLAAN PROYEK</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="form">
                    <input type="hidden" name="hid" id="hid">
                    <input type="hidden" name="haksi" id="haksi" value="add">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Nama Proyek</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="txtnama" id="txtnama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4">Provinsi</label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" name="slctprov" id="slctprov">
                                        <option value=""> -- Pilih salah satu -- </option>
                                        {{ App\Provinsi::opsi() }}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2">Kota</label>
                                <div class="col-sm-10">
                                    <input type="hidden" id="result-kota">
                                    <select class="form-control input-sm" name="slctkota" id="slctkota">
                                        <option value=""> -- Pilih provinsi dahulu -- </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="result-kecamatan">
                                    <select class="form-control input-sm" name="slctkecamatan" id="slctkecamatan">
                                        <option value=""> -- Pilih kota dahulu -- </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" id="result-kelurahan">
                                    <select class="form-control input-sm" name="slctkelurahan" id="slctkelurahan">
                                        <option value=""> -- Pilih kecamatan dahulu -- </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="txtalamat" id="txtalamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Peta</label>
                        <div class="col-sm-10">
                            <div id="show-maps" style="height: 400px;"></div>
                            <input type="text" class="form-control input-sm" id="txtbantucari">
                            <input type="hidden" name="txtlat" id="txtlat">
                            <input type="hidden" name="txtlong" id="txtlong">
                            <input type="hidden" name="txtradius" id="txtradius" value="300">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4">Periode</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-append">
                                        <input type="text" class="form-control input-sm text-center" name="txtrangetgl" id="txtrangetgl" readonly>
                                        <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="hidden" name="txtstart" id="txtstart">
                                    <input type="hidden" name="txtend" id="txtend">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-6 text-right">Luas Proyek</label>
                                <div class="col-sm-6">
                                    <div class="input-group input-append">
                                        <input type="text" class="form-control input-sm text-right number" name="txtluas" id="txtluas">
                                        <span class="input-group-addon add-on">HA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control input-sm" id="txtdesc" name="txtdesc" cols="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4">Master Plan</label>
                                <div class="col-sm-8">
                                    <div class="row media-wrapper" id="r-pic-masterplan">
                                        <div class="col-md-12 sm-max">
                                            <div class="media-row">
                                                <div class="media-box">
                                                    <div class="media-image">
                                                        <img src="" id="gambar-masterplan">
                                                    </div>
                                                    <div class="media-footer">
                                                        <div class="media-action">
                                                            <a href="javascript:void(0)" id="deleteFotoMasterplan"><i class="fa fa-trash"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control input-sm" name="filemasterplan" id="filemasterplan">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-4">Gambar Proyek</label>
                                <div class="col-sm-8">
                                    <div class="row media-wrapper" id="r-pic-proyek">
                                        <div class="col-sm-12">
                                            <div class="media-row">
                                                <div class="media-box">
                                                    <div class="media-image">
                                                        <img src="" id="gambar-proyek">
                                                    </div>
                                                    <div class="media-footer">
                                                        <div class="media-action">
                                                            <a href="javascript:void(0)" id="deleteGambarTajuk"><i class="fa fa-trash"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control input-sm" name="gambarproyek" id="gambarproyek">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2">File Brosur</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="hidden" id="r-file-brosur">
                                        <input type="file" class="form-control input-sm" name="filebrosur" id="filebrosur">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" type="button" id="lihatbrosur">Lihat</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" type="button" id="hapusbrosur">Hapus</button>
                                        </span>
                                    </div>
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

<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA410jI9jrile0OCUsyo7xUIRVtm4sw5_k&libraries=places'></script>
<script src="{{ url( 'plugins/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/tinymce/js/tinymce/tinymce.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url('plugins/bootstrap-daterangepicker-master/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('plugins/bootstrap-daterangepicker-master/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/jquery-number-master/jquery.number.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>
<script type="text/javascript" src="{{ url( '/plugins/confirm/jquery-confirm.min.js' ) }}"></script>


<script type="text/javascript" src="{{ url('scripts/set_proyek.js') }}"></script>


@endsection           
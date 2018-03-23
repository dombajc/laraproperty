@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/dataTable/jquery.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/dataTable/responsive.dataTables.min.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ url('plugins/bootstrap-daterangepicker-master/daterangepicker.css') }}" />

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
                        <th>GAMBAR SLIDER</th>
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
                <h4 class="modal-title" id="titlemodel">FORM SLIDER</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="form">
                    <input type="hidden" name="hid" id="hid">
                    <input type="hidden" name="haksi" id="haksi" value="add">
                    
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Upload Gambar</label>
                        <div class="col-sm-10">
                            <img src="" id="r-slctfoto" class="img-thumbnail">
                            <input type="hidden" id="uri_slctfoto" name="uri_slctfoto">
                            <input type="file" class="form-control input-sm" name="slctfoto" id="slctfoto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Status Tampil</label>
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="slctststampil" id="slctststampil">
                            <option value=""> -- Pilih salah satu -- </option>
                            <option value="1">Selalu</option>
                            <option value="0">Periodik</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="show-range-tgl" style="display:none;">
                        <label class="col-form-label col-sm-6 text-right">Range Tanggal Tampil</label>
                        <div class="col-sm-6">
                            <div class="input-group input-append">
                                <input type="text" class="form-control input-sm text-center" name="txtrangetgl" id="txtrangetgl" readonly>
                                <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="hidden" name="txtstart" id="txtstart">
                            <input type="hidden" name="txtend" id="txtend">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Text Slider 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="txttext1" id="txttext1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2">Text Slider 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="txttext2" id="txttext2">
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

<script type="text/javascript" src="{{ url('plugins/bootstrap-daterangepicker-master/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('plugins/bootstrap-daterangepicker-master/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/jquery-number-master/jquery.number.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/set_slider.js') }}"></script>


@endsection           
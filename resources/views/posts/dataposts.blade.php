@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/dataTable/jquery.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/dataTable/responsive.dataTables.min.css' ) }}" />
<link href="{{ url( 'plugins/fancybox/jquery.fancybox.min.css' ) }}" rel="stylesheet">

<div class="content-header no-mg-top">
    <i class="{{ $icon }}"></i>
    <div class="content-header-title">{{ $title }}</div>
    <button type="button" class="btn btn-sm btn-primary pull-right" id="btn-add">Tambah</button>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Form control -->
        <div class="content-box">
                
            <table class="table table-striped table-bordered" width="100%" cellspacing="0" id="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-gear"></i></th>
                        <th>JUDUL</th>
                        <th>KATEGORI</th>
                        <th>TGL PUBLIKASI</th>
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
                <h4 class="modal-title" id="titlemodel">PENGELOLAAN POSTS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="form">
                    <input type="hidden" name="hid" id="hid">
                    <input type="hidden" name="haksi" id="haksi" value="add">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" name="txtnama" id="txtnama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control input-sm" name="slctkategori" id="slctkategori">
                                <option value=""> -- Pilih Kategori -- </option>
                                {{ App\Kategori::opsi() }}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Isi Berita</label>
                        <div class="col-sm-9">
                            <textarea class="form-control input-sm" id="txtisi" name="txtisi" cols="20"></textarea>
                        </div>
                    </div>
                    <div class="form-group row" id="show-image">
                        <label class="col-form-label col-sm-3"></label>
                        <div class="col-sm-9">
                            <div class="row media-wrapper">
                                <div class="col-md-9 sm-max">
                                    <div class="media-row">
                                        <div class="media-box">
                                            <div class="media-image">
                                                <img src="" id="gambar-tajuk">
                                            </div>
                                            <div class="media-footer">
                                                <div class="media-action">
                                                    <a href="javascript:void(0)" id="deleteFotoTajuk"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Gambar Utama</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control input-sm" name="filegambar" id="filegambar">
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

<script src="{{ url( 'plugins/fancybox/jquery.fancybox.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/tinymce/js/tinymce/tinymce.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>


<script type="text/javascript" src="{{ url('scripts/data_posts.js') }}"></script>

@endsection           
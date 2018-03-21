@extends( 'layouts.app' )

@section( 'content' )

<link rel="stylesheet" href="{{ url( '/plugins/dataTable/jquery.dataTables.min.css' ) }}" />
<link rel="stylesheet" href="{{ url( '/plugins/dataTable/responsive.dataTables.min.css' ) }}" />
<link href="{{ url( 'plugins/jquery-tree-master/src/css/jquery.tree.css') }}" rel="stylesheet" />

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
                        <th>NAMA</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
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
                <h4 class="modal-title" id="titlemodel">PENGELOLAAN PENGGUNA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" id="form">
                    <input type="hidden" name="hid" id="hid">
                    <input type="hidden" name="haksi" id="haksi" value="add">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-12">A. DATA PENGGUNA</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtnama" id="txtnama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" name="txtuser" id="txtuser">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control input-sm" name="txtpass" id="txtpass" maxlength="25">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3">Ulangi Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control input-sm" name="txtrepass" id="txtrepass" maxlength="25">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-12">B. HAK AKSES</label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12" id="pilihanmenu">
                                    {{ App\Menu::ShowPilihanMenu() }}
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

<script type="text/javascript" src="{{ url( 'plugins/jquery/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/jquery-tree-master/src/js/jquery.tree.js') }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/dataTable/dataTables.responsive.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>

<script type="text/javascript" src="{{ url('scripts/set_user.js') }}"></script>

@endsection           
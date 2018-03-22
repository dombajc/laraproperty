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
                
            <form class="form form-horizontal" id="form">
                <div class="form-group row">
                    <label class="col-form-label col-sm-5 text-right">Nama</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control input-sm" name="txtnama" id="txtnama" value="{{ $row->nm_user }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-5 text-right">Foto Profile</label>
                    <div class="col-sm-4 text-center">
                        <img src="{{ $row->uri_profile }}" id="r-slctfoto" class="img-thumbnail">
                        <input type="hidden" id="uri_slctfoto" name="uri_slctfoto" value="{{ $row->uri_profile }}">
                        <input type="file" class="form-control input-sm" name="slctfoto" id="slctfoto">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-sm btn-success">SIMPAN</button>
                    </div>
                </div>
            </form>

        </div><!-- .card -->
        <!-- /End Form control -->

    </div><!-- .col -->

</div>

<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>
<script>
    var pic_default = '{{ url('images/default_profile.jpg') }}';
</script>
<script type="text/javascript" src="{{ url('scripts/profile.js') }}"></script>

@endsection           
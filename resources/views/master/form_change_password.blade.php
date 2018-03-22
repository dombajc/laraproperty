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
                    <label class="col-form-label col-sm-6 text-right">Password Baru</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control input-sm" name="txtpass" id="txtpass" maxlength="25">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-6 text-right">Ulangi Password Baru</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control input-sm" name="txtrepass" id="txtrepass" maxlength="25">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-sm btn-success"> SIMPAN PASSWORD BARU</button>
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

<script type="text/javascript" src="{{ url('scripts/change_password.js') }}"></script>

@endsection           
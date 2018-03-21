@extends( 'layouts.app' )

@section( 'content' )

<div class="content-header no-mg-top">
    <i class="fa fa-gear"></i>
    <div class="content-header-title">Setting Aplikasi</div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Form control -->
        <div class="content-box">
            <form class="form form-horizontal" id="form">
                <input type="hidden" name="hid" id="hid">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">Judul</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txtjudul" id="txtjudul" value="{{ $row->nm_judul }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txttitle" id="txttitle" value="{{ $row->title }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">About</label>
                    <div class="col-sm-8">
                        <textarea class="form-control input-sm" cols="10" name="txtabout" id="txtabout">{{ $row->about }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">Alamat Perusahaan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txtalamat" id="txtalamat" value="{{ $row->alamat }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">Telp</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txttelp" id="txttelp" value="{{ $row->telp }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">E-Mail</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txtemail" id="txtemail" value="{{ $row->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">Fax</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txtfax" id="txtfax" value="{{ $row->fax }}">
                    </div>
                </div><div class="form-group row">
                    <label class="col-form-label col-sm-2 text-right">URL Video</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" name="txturlvideo" id="txturlvideo" value="{{ $row->url_video }}">
                    </div>
                </div>
                <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-right">Peta</label>
                        <div class="col-sm-8">
                            <div id="show-maps" style="height: 300px;"></div>
                            <input type="text" class="form-control input-sm" id="txtbantucari">
                            <input type="hidden" name="txtlat" id="txtlat">
                            <input type="hidden" name="txtlong" id="txtlong">
                            <input type="hidden" name="txtradius" id="txtradius" value="300">
                        </div>
                    </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-sm btn-success">UPDATE</button>
                    </div>
                </div>
            </form>

        </div><!-- .card -->
        <!-- /End Form control -->

    </div><!-- .col -->

</div>

<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA410jI9jrile0OCUsyo7xUIRVtm4sw5_k&libraries=places'></script>
<script src="{{ url( 'plugins/jquery-locationpicker-plugin-master/dist/locationpicker.jquery.js' ) }}"></script>

<script type="text/javascript" src="{{ url( 'plugins/formvalidation/formValidation.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/framework/bootstrap.min.js' ) }}"></script>
<script type="text/javascript" src="{{ url( 'plugins/formvalidation/language/id_ID.js' ) }}"></script>

<script>
    var lat = {{ $row->lat }};
    var lang = {{ $row->lang }};
</script>
<script type="text/javascript" src="{{ url('scripts/set_app.js') }}"></script>


@endsection           
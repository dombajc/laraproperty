@extends('layouts.dashboard')

@section('content')
<div class="top-banner">
    <div class="top-banner-title">Dashboard</div>
    <div class="top-banner-subtitle">Selamat Datang di Aplikasi Management Penjualan Rumah Subsidi Ceria</div>
</div>
<div class="content with-top-banner">
    <div class="content-header no-mg-top">
        <i class="fa fa-newspaper-o"></i>
        <div class="content-header-title">Resume Singkat</div>
    </div>
    <div class="panel">
        <div class="row">
            <div class="col-md-3 card-wrapper">
                <div class="card">
                    <i class="fa fa-suitcase"></i>
                    <div class="clear">
                        <div class="card-title text-right">
                            <span class="timer" data-from="0" data-to="{{ $jml_proyek }}">{{ $jml_proyek }}</span>
                        </div>
                        <div class="card-subtitle">TOTAL PROYEK</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 card-wrapper">
                <div class="card">
                    <i class="fa fa-newspaper-o"></i>
                    <div class="clear">
                        <div class="card-title text-right">
                            <span class="timer" data-from="0" data-to="{{ $jml_kapling }}">{{ $jml_kapling }}</span>
                        </div>
                        <div class="card-subtitle">TOTAL KAPLING</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 card-wrapper">
                <div class="card">
                    <i class="fa fa-signal"></i>
                    <div class="clear">
                        <div class="card-title text-right">
                            <span class="timer" data-from="0" data-to="{{ $jml_kapling_terjual }}">{{ $jml_kapling_terjual }}</span>
                        </div>
                        <div class="card-subtitle">KAPLING TERJUAL</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 card-wrapper">
                <div class="card">
                    <i class="fa fa-map-marker"></i>
                    <div class="clear">
                        <div class="card-title text-right">
                            <span class="timer" data-from="0" data-to="{{ $total_kapling_terjual }}">{{ $total_kapling_terjual }}</span>
                        </div>
                        <div class="card-subtitle">TOTAL PENJUALAN</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel" style="display:none">
        <div class="row">
            <div class="col-md-8">
                <div class="content-header">
                    <i class="fa fa-newspaper-o"></i>
                    <div class="content-header-title">Resume Per Proyek</div>
                </div>
                <div class="content-box">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Product Name</th>
                                    <th class="text-center">Images</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Order Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td class="nowrap">Iphone 6</td>
                                    <td class="text-center"><img alt="pongo" class="image-table" src="assets/images/asparagus.jpg"></td>
                                    <td class="text-center">
                                        <div class="status-pill green"></div>
                                    </td>
                                    <td class="text-right">$22</td>
                                    <td class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td class="nowrap">Iphone 6</td>
                                    <td class="text-center"><img alt="pongo" class="image-table" src="assets/images/belts.jpg"></td>
                                    <td class="text-center">
                                        <div class="status-pill red"></div>
                                    </td>
                                    <td class="text-right">$22</td>
                                    <td class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td class="nowrap">Iphone 6</td>
                                    <td class="text-center"><img alt="pongo" class="image-table" src="assets/images/bulldozer.jpg"></td>
                                    <td class="text-center">
                                        <div class="status-pill yellow"></div>
                                    </td>
                                    <td class="text-right">$22</td>
                                    <td class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td class="nowrap">Iphone 6</td>
                                    <td class="text-center"><img alt="pongo" class="image-table" src="assets/images/chocolate.jpg"></td>
                                    <td class="text-center">
                                        <div class="status-pill green"></div>
                                    </td>
                                    <td class="text-right">$22</td>
                                    <td class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td class="nowrap">Iphone 6</td>
                                    <td class="text-center"><img alt="pongo" class="image-table" src="assets/images/belts.jpg"></td>
                                    <td class="text-center">
                                        <div class="status-pill red"></div>
                                    </td>
                                    <td class="text-right">$22</td>
                                    <td class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <td class="nowrap">Iphone 6</td>
                                    <td class="text-center"><img alt="pongo" class="image-table" src="assets/images/bulldozer.jpg"></td>
                                    <td class="text-center">
                                        <div class="status-pill yellow"></div>
                                    </td>
                                    <td class="text-right">$22</td>
                                    <td class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-trash"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 sm-max">
                <div class="content-header">
                    <i class="fa fa-suitcase"></i>
                    <div class="content-header-title">Penjualan Terakhir</div>
                </div>
                <div class="content-box slide-item">
                    <div class="product-list">
                        <img alt="pongo" class="pull-left" src="assets/images/belts.jpg">
                        <div class="clear">
                            <div class="product-list-title">Iphone 6</div>
                            <div class="product-list-category">Smartphone</div>
                        </div>
                        <div class="product-list-price">$2,300</div>
                    </div>
                    <div class="product-list">
                        <img alt="pongo" class="pull-left" src="assets/images/asparagus.jpg">
                        <div class="clear">
                            <div class="product-list-title">Asus</div>
                            <div class="product-list-category">Laptop</div>
                        </div>
                        <div class="product-list-price">$9,150</div>
                    </div>
                    <div class="product-list">
                        <img alt="pongo" class="pull-left" src="assets/images/chocolate.jpg">
                        <div class="clear">
                            <div class="product-list-title">Iphone 5</div>
                            <div class="product-list-category">Smartphone</div>
                        </div>
                        <div class="product-list-price">$124</div>
                    </div>
                    <div class="product-list">
                        <img alt="pongo" class="pull-left" src="assets/images/bulldozer.jpg">
                        <div class="clear">
                            <div class="product-list-title">Lenovo</div>
                            <div class="product-list-category">Laptop</div>
                        </div>
                        <div class="product-list-price">$454</div>
                    </div>
                    <div class="product-list">
                        <img alt="pongo" class="pull-left" src="assets/images/belts.jpg">
                        <div class="clear">
                            <div class="product-list-title">Iphone 6</div>
                            <div class="product-list-category">Smartphone</div>
                        </div>
                        <div class="product-list-price">$9,023</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
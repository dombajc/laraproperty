<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Kapling;

class DashboardController extends Controller
{
    public function index()
    {
        $penjualan_kapling = Kapling::jmlkaplingterjual();
        return view('dashboard')->with(array(
            'jml_proyek' => Proyek::jmlproyek(),
            'jml_kapling' => Kapling::jmlkapling(),
            'jml_kapling_terjual' => $penjualan_kapling->kapling_terjual,
            'total_kapling_terjual' => $penjualan_kapling->total_pernjualan,
            'icon' => 'fa fa-users'
        ));
    }
}

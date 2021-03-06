<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplikasi;
use App\Slider;

class OnlinehomeController extends Controller
{
    public function index()
    {
        /*return view('online.home3')->with([
            'Rowsproyek' => Proyek::getOnlineHome(),
            'Rowsnews' => Posts::getOnlineHome()
        ]);*/
        return view('online4.home')->with([
            'R' => Aplikasi::getApp(),
            'sliders' => Slider::get_arr_aktif()
        ]);
    }
}

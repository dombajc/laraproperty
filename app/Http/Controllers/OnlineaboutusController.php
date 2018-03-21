<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplikasi;

class OnlineaboutusController extends Controller
{
    public function index()
    {
        return view('online.aboutus')->with([
            'title' => 'Tentang Kami <br>rumahsubsidiceria.com',
            'row' => Aplikasi::getApp()
        ]);
    }
}

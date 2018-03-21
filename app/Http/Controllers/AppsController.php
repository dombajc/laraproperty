<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplikasi;

class AppsController extends Controller
{
    public function index()
    {
        return view('master.setting_aplikasi')->with([
            'row' => Aplikasi::getApp()
        ]);
    }

    public function act()
    {
        $json = array();
        $status = 0;
        $msg = '';

        $result = Aplikasi::simpan();
        if ( empty($result) ){
            $status = 1;
        } else {
            $msg = $result;
        }

        $json['Status'] = $status;
        $json['Msg'] = $msg;

        return response()->json($json, 200);
    }
}

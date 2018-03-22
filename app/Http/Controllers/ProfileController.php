<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Users;

class ProfileController extends Controller
{
    public function index()
    {
        return view('master.see_profile')->with(array(
            'title' => 'PROFILE PENGGUNA',
            'icon' => 'fa fa-users',
            'row' => Users::getSess()->first()
        ));
    }

    public static function perbaharui_profile(){

        $json = array();
        $status = 0;
        $msg = '';

        $result = Users::update_profile();
        if ( empty($result) ){
            $status = 1;
        } else {
            $msg = $result;
        }

        $json['Status'] = $status;
        $json['Msg'] = $msg;

        return response()->json($json, 200);
    }

    public function page_change_password() {
        return view('master.form_change_password')->with(array(
            'title' => 'UBAH PASSWORD PENGGUNA',
            'icon' => 'fa fa-users'
        ));
    }

    public static function perbaharui_password(){

        $json = array();
        $status = 0;
        $msg = '';

        $result = Users::update_password();
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

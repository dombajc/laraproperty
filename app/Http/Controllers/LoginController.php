<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Session;

class LoginController extends Controller
{

    public function index()
    {
        if ( Session::get('idu') != '' ) {
            return redirect('dashboard');
        } else {
            return view('formlogin');
        }
    }

    public static function validationLogin(Request $req) {
        $json = array();
        $status = 0;
        $msg = '';
        $url_to = '';

        $check = Users::checkActionLogin();

        if ( !empty($check->id_user) ) {
            if ( $check->enc_pass == md5($req->txtpass) ) {
                $status = 1;
                Session::put('idu', $check->id_user);
                $url_to = url('dashboard');
            } else {
                $status = 9;
                $msg = 'Kata Sandi tidak cocok';
            }
        } else {
            $msg = 'Maaf Username tidak terdaftar';
        }

        $json['Status'] = $status;
        $json['Msg'] = $msg;
        $json['Next'] = $url_to;
        echo json_encode($json);
    }
}

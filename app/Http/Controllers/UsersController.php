<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Users;

class UsersController extends Controller
{
    public function index()
    {
        return view('master.datausers')->with(array(
            'title' => 'DATA USERS',
            'icon' => 'fa fa-users'
        ));
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Users::tambah($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Users::Edit();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'valid':
                $result = Users::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Users::Remove();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
        endswitch;

        $json['Status'] = $status;
        $json['Msg'] = $msg;

        return response()->json($json, 200);
    }

    public static function datatable(Request $rq){
        $json = array();
        
        $rows = Users::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Users::getCountForPaging();
        return response()->json($json);
    }

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Users::findById($rq->paramId);
        if( count($check) == 1 ){
            $status = 1;
            $row = $check;
        } else {
            $msg = 'Maaf data tidak diketemukan';
        }

        $json['Status'] = $status;
        $json['Msg'] = $msg;
        $json['Row'] = $row;

        echo json_encode($json);
    }
}

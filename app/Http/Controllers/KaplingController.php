<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kapling;
use App\Proyek;
use App\Tipeproyek;
use App\Imageskapling;

class KaplingController extends Controller
{
    public function index()
    {
        return view('master.datakapling')->with(array(
            'title' => 'DATA KAPLING',
            'icon' => 'fa fa-users'
        ));
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Kapling::tambah($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Kapling::Edit();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'valid':
                $result = Kapling::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Kapling::Remove();
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

    public static function unggah(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Imageskapling::tambah($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'valid':
                $result = Imageskapling::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Imageskapling::Remove();
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
        
        $rows = Kapling::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Kapling::getCountForPaging();
        return response()->json($json);
    }

    public static function datagaleri(Request $rq){
        $json = array();
        
        $rows = Imageskapling::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Imageskapling::getCountForPaging();
        return response()->json($json);
    }

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Kapling::findById($rq->paramId);
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

    public function jsonGetTipeByProyek(Request $req) {
        return response()->json(Tipeproyek::jsonGetTipeByProyek($req->paramId), 200);
    }
}

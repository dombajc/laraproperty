<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;

class ProyekController extends Controller
{
    public function index()
    {
        return view('master.dataproyek')->with(array(
            'title' => 'DATA PROYEK',
            'icon' => 'fa fa-users'
        ));
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Proyek::tambah($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Proyek::Edit($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete_master_plan':
                $result = Proyek::HapusMasterPlan();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete_tajuk':
                $result = Proyek::HapusGambarTajuk();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete_brosur':
                $result = Proyek::HapusBrosur();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'valid':
                $result = Proyek::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Proyek::Remove();
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
        
        $rows = Proyek::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Proyek::getCountForPaging();
        return response()->json($json);
    }

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Proyek::findById($rq->paramId);
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

    public function jsonGetKotaByProv(Request $req) {
        return response()->json(Kota::jsonGetKotaByProv($req->paramId), 200);
    }

    public function jsonGetKecamatanByKota(Request $req) {
        return response()->json(Kecamatan::jsonGetByKota($req->paramId), 200);
    }

    public function jsonGetKelurahanByKecamatan(Request $req) {
        return response()->json(Kelurahan::jsonGetByKecamatan($req->paramId), 200);
    }
    
}

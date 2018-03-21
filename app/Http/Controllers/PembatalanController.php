<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Kapling;
use App\Pembatalan;

class PembatalanController extends Controller
{
    public function index()
    {
        return view('penjualan.entrypembatalan')->with(array(
            'title' => 'ENTRY PEMBATALAN',
            'icon' => 'fa fa-cart-plus'
        ));
    }

    public function page()
    {
        return view('penjualan.datapembatalan')->with(array(
            'title' => 'DATA RIWAYAT PEMBATALAN',
            'icon' => 'fa fa-cart'
        ));
    }

    public static function getPenjualan(Request $rq){
        $json = array();
        
        $rows = Pembatalan::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Pembatalan::getCountForPaging();
        return response()->json($json);
    }

    public static function checkPenjualan(Request $req) {
    	$sts = 0;
    	$msg = '';
    	$row = array();

    	$q = Penjualan::cekPenjualanAktif($req->paramId);
    	if ( count($q) == 1 ) {
    		$sts = 1;
    		$row = $q;
    	} else {
    		$msg = 'Maaf Penjualan tidak tersedia !';
    	}

    	return response()->json(['Status' => $sts, 'Msg' => $msg, 'Row' => $row], 200);
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Pembatalan::tambah();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Pembatalan::Edit();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Pembatalan::Remove();
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

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Pembatalan::findById($rq->paramId);
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

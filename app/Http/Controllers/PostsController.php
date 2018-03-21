<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Kota;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.dataposts')->with(array(
            'title' => 'DATA POSTS',
            'icon' => 'fa fa-users'
        ));
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Posts::tambah($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Posts::Edit($rq);
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'valid':
                $result = Posts::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Posts::Remove();
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
        
        $rows = Posts::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Posts::getCountForPaging();
        return response()->json($json);
    }

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Posts::findById($rq->paramId);
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

    public static function hapusfoto() {
        $json = array();
        $status = 0;
        $msg = '';

        $check = Posts::hapusgambartajuk();
        if( empty($check) ){
            $status = 1;
            
        } else {
            $msg = 'Maaf data tidak diketemukan';
        }

        $json['Status'] = $status;
        $json['Msg'] = $msg;

        echo json_encode($json);
    }

    public function result_random(Request $req) {
        echo Posts::show_random_except_id($req->idShow);
    }
}

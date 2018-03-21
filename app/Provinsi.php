<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Provinsi extends Model
{
    protected $table = 'dt_provinsi';

    public static function getArrActive() {
        return Provinsi::select('id_provinsi', 'nm_provinsi')
            ->where('sts_aktif', 1)
            ->get();
    }

    public static function opsi() {
        $opsi = '';
        foreach( self::getArrActive() as $r ) {
            $opsi .= '<option value="'. $r->id_provinsi .'">'. $r->nm_provinsi .'</option>';
        }
        echo $opsi;
    }
}

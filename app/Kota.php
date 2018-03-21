<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Kota extends Model
{
    protected $table = 'dt_kota';

    public static function jsonGetKotaByProv($IDProvinsi) {
        return Kota::select('id_kota', 'nm_kota')
            ->where('id_provinsi', $IDProvinsi)
            ->get();
    }
}

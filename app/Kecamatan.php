<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Kecamatan extends Model
{
    protected $table = 'dt_kecamatan';

    public static function jsonGetByKota($id) {
        return Kecamatan::select('id_kecamatan', 'nm_kecamatan')
            ->where('id_kota', $id)
            ->get();
    }
}

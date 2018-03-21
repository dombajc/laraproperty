<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Kelurahan extends Model
{
    protected $table = 'dt_kelurahan';

    public static function jsonGetByKecamatan($id) {
        return Kelurahan::select('id_kelurahan', 'nm_kelurahan')
            ->where('id_kecamatan', $id)
            ->get();
    }
}

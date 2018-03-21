<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Konsumen extends Model
{
    protected $table = 'dt_konsumen';

    public static function checkInsertID() {
    	return Konsumen::select('id_konsumen')
    		->where('nik', Input::get('txtnik'));
    }
}

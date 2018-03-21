<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carapembayaran extends Model
{
    protected $table = 'dt_cara_pembayaran';

    public static function getArrActive() {
        return Carapembayaran::select('id_cara_pembayaran', 'cara_pembayaran')
            ->where('sts_aktif', 1)
            ->get();
    }

    public static function opsi() {
        $opsi = '';
        foreach( self::getArrActive() as $r ) {
            $opsi .= '<option value="'. $r->id_cara_pembayaran .'">'. $r->cara_pembayaran .'</option>';
        }
        echo $opsi;
    }

    public static function getById($id) {
        return Carapembayaran::select('cara_pembayaran')
            ->where('id_cara_pembayaran', $id)
            ->first();
    }
}

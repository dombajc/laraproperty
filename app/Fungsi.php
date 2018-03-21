<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fungsi extends Model
{
    public static function format_tgl_indo($date) {
		$tgl = self::formatdatetosql($date);
        $tanggal = substr($tgl, 8, 2);
        $bulan = self::getBulan(substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    public static function format_sql_to_indo($tgl) {
        $tanggal = substr($tgl, 8, 2);
        $bulan = self::getBulan(substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    public static function getBulan($bln) {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

    public static function getBulan2($bln) {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
	
	public static function formatdatetosql($date) {

        $tanggal = substr($date, 0, 2);
        $bulan = substr($date, 3, 2);
        $tahun = substr($date, 6, 4);
        return $tahun . '-' . $bulan . '-' . $tanggal;
    }

    public static function formatsqltodate($date) {

        $tanggal = substr($date, 8, 2);
        $bulan = substr($date, 5, 2);
        $tahun = substr($date, 0, 4);
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }

    public static function cleanXSS($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

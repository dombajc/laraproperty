<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class Aplikasi extends Model
{
    
    protected $table = 'ds_aplikasi';

    public static function getApp() {
		return Aplikasi::where('sts_publish', 1)
			->first();
	}

	public static function simpan() {
		DB::beginTransaction();
        try {
            DB::table('ds_aplikasi')
                ->where('id_aplikasi', 1)
                ->update([
                    'nm_judul' => Fungsi::cleanXSS(Input::get('txtjudul')),
                    'title' => Fungsi::cleanXSS(Input::get('txttitle')),
                    'about' => Fungsi::cleanXSS(Input::get('txtabout')),
                    'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                    'telp' => Input::get('txttelp'),
                    'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                    'fax' => Fungsi::cleanXSS(Input::get('txtfax')),
                    'lat' => str_replace(' ','',Input::get('txtlat')),
                    'lang' => str_replace(' ','',Input::get('txtlong')),
                    'url_video' => Input::get('txturlvideo')
                ]);
            
            DB::commit();
        } catch ( \Iluminate\Database\QueryException $e ) {
            DB::rollback();
            return $e->getMessage();
        } catch ( \Exception $e ) {
            DB::rollback();
            return $e->getMessage();
        } catch ( \PDOException $e ) {
            DB::rollback();
            return $e->getMessage();
        }
	}
}

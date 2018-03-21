<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Marketing extends Model
{
    protected $table = 'dt_marketing';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = empty(Input::get('sByNama')) ? "1=1" : "nm_marketing like '%". Input::get('sByNama') ."%'";
        $result = Marketing::select(DB::raw('id_marketing,nm_marketing,alamat,email,password_email,telp,sts_aktif'))
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = empty(Input::get('sByNama')) ? "1=1" : "nm_marketing like '%". Input::get('sByNama') ."%'";
        $result = Marketing::select('id_marketing')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah() {
        DB::beginTransaction();
        try {
            Marketing::insert(array(
                'id_marketing' => time(),
                'nm_marketing' => Fungsi::cleanXSS(Input::get('txtnama')),
                'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                'password_email' => Fungsi::cleanXSS(Input::get('txtpassemail')),
                'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                'telp' => Fungsi::cleanXSS(Input::get('txttelp'))
            ));
            
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

    public static function Edit ()
    {
        DB::beginTransaction();
        try {
            Marketing::where('id_marketing', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                    'nm_marketing' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                    'password_email' => Fungsi::cleanXSS(Input::get('txtpassemail')),
                    'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                    'telp' => Fungsi::cleanXSS(Input::get('txttelp'))
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

    public static function Valid ()
    {
        DB::beginTransaction();
        try {
            Marketing::where('id_marketing', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                'sts_aktif' => Input::get('sts')
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

    public static function Remove ()
    {
        DB::beginTransaction();
        try {
            Marketing::where('id_marketing', Fungsi::cleanXSS(Input::get('hid')))
                ->delete();
            
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

    public static function findById()
    {
        return Marketing::where('id_marketing', Input::get('paramId'))
            ->first();
    }

    public static function opsi() {
        $q = Marketing::select('id_marketing', 'nm_marketing')
            ->where('sts_aktif', 1)
            ->get();
        $opsi = '';
        foreach( $q as $r ) {
            $opsi .= '<option value="'. $r->id_marketing .'">'. $r->nm_marketing .'</option>';
        }
        echo $opsi;
    }

    public static function getById($id) {
        return Marketing::select('nm_marketing')
            ->where('id_marketing', $id)
            ->first();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Users extends Model
{
    protected $table = 'dt_users';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "1=1";
        $result = Users::select(DB::raw('id_user,nm_user,username,pass,sts_aktif'))
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "1=1";
        $result = Users::select('id_user')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah() {
        DB::beginTransaction();
        try {
            Users::insert(array(
                'id_user' => time(),
                'nm_user' => Fungsi::cleanXSS(Input::get('txtnama')),
                'username' => Fungsi::cleanXSS(Input::get('txtuser')),
                'pass' => Fungsi::cleanXSS(Input::get('txtpass')),
                'enc_pass' => md5(Fungsi::cleanXSS(Input::get('txtpass'))),
                'hak_akses' => empty(Input::get('chkmenu')) ? '' : implode(',', Input::get('chkmenu')),
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
        $arrMain = array(
            'nm_user' => Fungsi::cleanXSS(Input::get('txtnama')),
            'hak_akses' => empty(Input::get('chkmenu')) ? '' : implode(',', Input::get('chkmenu')),
        );
        $arrPass = empty(Input::get('txtpass')) ? array() : array(
            'pass' => Fungsi::cleanXSS(Input::get('txtpass')),
            'enc_pass' => md5(Fungsi::cleanXSS(Input::get('txtpass'))),
        );
        DB::beginTransaction();
        try {
            DB::table('dt_users')
                ->where('id_user', Fungsi::cleanXSS(Input::get('hid')))
                ->update(array_merge($arrMain, $arrPass));
            
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
            DB::table('dt_users')
                ->where('id_user', Fungsi::cleanXSS(Input::get('hid')))
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
            DB::table('dt_users')
                ->where('id_user', Fungsi::cleanXSS(Input::get('hid')))
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
        return Users::select(DB::raw("id_user,username,nm_user,hak_akses"))
            ->where('id_user', Input::get('paramId'))
            ->first();
    }

    public static function checkActionLogin() {
        return Users::select('id_user', 'enc_pass')
            ->where('username', Fungsi::cleanXSS(Input::get('txtuser')))
            ->where('sts_aktif', 1 )
            ->first();
    }

    public static function getSess() {
        return Users::selectRaw("nm_user,hak_akses,ifnull(uri_profile,'') as uri_profile")
            ->where('id_user', Session::get('idu'));
    }

    public static function update_profile() {
        DB::beginTransaction();
        try {
            Users::where('id_user', Session::get('idu'))
                ->update([
                    'nm_user' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'uri_profile' => Input::get('uri_slctfoto'),
                    'updated_by' => Session::get('idu')
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

    public static function update_password ()
    {
        DB::beginTransaction();
        try {
            Users::where('id_user', Session::get('idu'))
                ->update([
                    'pass' => Fungsi::cleanXSS(Input::get('txtpass')),
                    'enc_pass' => md5(Fungsi::cleanXSS(Input::get('txtpass'))),
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

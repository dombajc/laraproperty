<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Kategori extends Model
{
    protected $table = 'dt_kategori_berita';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "1=1";
        $result = Kategori::select(DB::raw('id_kategori_berita,kategori_berita,sts_aktif'))
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "1=1";
        $result = Kategori::select('id_kategori_berita')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah() {
        DB::beginTransaction();
        try {
            Kategori::insert(array(
                'id_kategori_berita' => time(),
                'kategori_berita' => Fungsi::cleanXSS(Input::get('txtnama'))
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
            DB::table('dt_kategori_berita')
                ->where('id_kategori_berita', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                    'kategori_berita' => Fungsi::cleanXSS(Input::get('txtnama'))
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
            DB::table('dt_kategori_berita')
                ->where('id_kategori_berita', Fungsi::cleanXSS(Input::get('hid')))
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
            DB::table('dt_kategori_berita')
                ->where('id_kategori_berita', Fungsi::cleanXSS(Input::get('hid')))
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
        return Kategori::select(DB::raw("id_kategori_berita,kategori_berita"))
            ->where('id_kategori_berita', Input::get('paramId'))
            ->first();
    }

    public static function opsi() {
        $q = Kategori::select('id_kategori_berita', 'kategori_berita')
            ->where('sts_aktif', 1)
            ->orderBy('kategori_berita')
            ->get();
        $opsi = '';
        foreach( $q as $r ) {
            $opsi .= '<option value="'. $r->id_kategori_berita .'"> '. $r->kategori_berita .' </option>';
        }
        echo $opsi;
    }

    public static function count_berita_by_kategori() {
        return Kategori::selectRaw("dt_kategori_berita.id_kategori_berita,kategori_berita, count(id_berita) as jml")
            ->leftJoin('dt_posted', function($join){
                $join->on('dt_posted.id_kategori_berita','=','dt_kategori_berita.id_kategori_berita')
                    ->where('dt_posted.sts_aktif', 1);
            })
            ->where('dt_kategori_berita.sts_aktif', 1)
            ->groupBy('dt_kategori_berita.id_kategori_berita','kategori_berita')
            ->get()
            ->toJson();
    }

    private static function get_arr_only_active() {
        return Kategori::select('id_kategori_berita', 'kategori_berita')
            ->where('sts_aktif', 1)
            ->orderBy('kategori_berita')
            ->get();
    }

    public static function show_as_menu() {
        $li = '';
        foreach( self::get_arr_only_active() as $row ) {
            $li .= '<li><a href="'. url('/news/'. strtolower($row->kategori_berita)) .'"> '. $row->kategori_berita .' </a></li>';
        }
        echo $li;
    }

    public static function get_list_resume_sidebar() {
        $li = '';
        foreach( self::get_arr_only_active() as $row ) {
            $li .= '<li><a href="'. url('news/'. strtolower($row->kategori_berita)) .'">'. $row->kategori_berita .' </a></li>';
        }
        echo $li;
    }

    public static function cek_by_name($param_name) {
        return Kategori::select('id_kategori_berita')
            ->where('kategori_berita', $param_name)
            ->first();
    }
}

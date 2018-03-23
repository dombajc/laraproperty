<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Fungsi;
use Session;

class Slider extends Model
{
    protected $table = 'dt_slider';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $result = Slider::selectRaw("id_slider,uri_slider,if(sts_tampil=1,'Selalu',
        concat(date_format(tgl_start,'%d-%m-%Y'),' s.d ',date_format(tgl_end,'%d-%m-%Y'))
        ) as sts_tampil,
        text1,text2,sts_aktif")
            ->offset($start)
            ->limit($length)
            ->orderBy('id_slider','desc')
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $result = Slider::select('id_slider')
            ->count();
        return $result;
    }

    public static function tambah() {
        
        DB::beginTransaction();
        try {
            Slider::insert(array(
                'id_slider' => time(),
                'uri_slider' => Fungsi::cleanXSS(Input::get('uri_slctfoto')),
                'sts_tampil' => Fungsi::cleanXSS(Input::get('slctststampil')),
                'tgl_start' => empty(Input::get('txtstart')) ? null : Fungsi::cleanXSS(Input::get('txtstart')),
                'tgl_end' => empty(Input::get('txtend')) ? null : Fungsi::cleanXSS(Input::get('txtend')),
                'text1' => Fungsi::cleanXSS(Input::get('txttext1')),
                'text2' => Fungsi::cleanXSS(Input::get('txttext2')),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('idu')
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
            Slider::where('id_slider', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                    'uri_slider' => Fungsi::cleanXSS(Input::get('uri_slctfoto')),
                    'sts_tampil' => Fungsi::cleanXSS(Input::get('slctststampil')),
                    'tgl_start' => empty(Input::get('txtstart')) ? null : Fungsi::cleanXSS(Input::get('txtstart')),
                    'tgl_end' => empty(Input::get('txtend')) ? null : Fungsi::cleanXSS(Input::get('txtend')),
                    'text1' => Fungsi::cleanXSS(Input::get('txttext1')),
                    'text2' => Fungsi::cleanXSS(Input::get('txttext2')),
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

    public static function Valid ()
    {
        DB::beginTransaction();
        try {
            Slider::where('id_slider', Fungsi::cleanXSS(Input::get('hid')))
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
            Slider::where('id_slider', Fungsi::cleanXSS(Input::get('hid')))
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
        return Slider::selectRaw("id_slider,uri_slider,sts_tampil,tgl_start,tgl_end,text1,text2
            ,if(
            ifnull(tgl_start,'')='','',date_format(tgl_start,'%d-%m-%Y')
            ) as tgl_awal
            ,if(
            ifnull(tgl_end,'')='','',date_format(tgl_end,'%d-%m-%Y')
            ) as tgl_akhir")
            ->where('id_slider', Input::get('paramId'))
            ->first();
    }

    public static function get_arr_aktif() {
        $q1 = Slider::select('uri_slider','tgl_start','tgl_end','text1','text2')
            ->where('sts_aktif', 1)
            ->where('sts_tampil', 1);

        $q2 = Slider::select('uri_slider','tgl_start','tgl_end','text1','text2')
            ->where('sts_aktif', 1)
            ->where('sts_tampil', 0)
            ->where('tgl_start', '>=', date('Y-m-d'))
            ->where('tgl_end', '<=', date('Y-m-d'))
            ->union($q1)
            ->get();
        return $q2;
    }

}

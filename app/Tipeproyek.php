<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Tipeproyek extends Model
{
    protected $table = 'dt_tipe_proyek';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = empty(Input::get('sProyek')) ? "1=1" : "dt_tipe_proyek.id_proyek='". Input::get('sProyek') ."'";
        $result = Tipeproyek::select(DB::raw("id_tipe_proyek,nm_tipe,format(harga_standar,0) as harga_standar,format(luas_bangunan,0) as luas_bangunan,dt_proyek.nm_proyek,dt_tipe_proyek.sts_aktif,format((select count(id_kapling_proyek) from dt_kapling_proyek where dt_kapling_proyek.id_tipe_proyek=dt_tipe_proyek.id_tipe_proyek),0) as jml_unit"))
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = empty(Input::get('sProyek')) ? "1=1" : "id_proyek='". Input::get('sProyek') ."'";
        $result = Tipeproyek::select('id_tipe_proyek')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah() {
        DB::beginTransaction();
        try {
            Tipeproyek::insert(array(
                'id_tipe_proyek' => time(),
                'nm_tipe' => Fungsi::cleanXSS(Input::get('txtnama')),
                'id_proyek' => Fungsi::cleanXSS(Input::get('slctproyek')),
                'harga_standar' => Fungsi::cleanXSS(Input::get('txtharga')),
                'luas_bangunan' => Fungsi::cleanXSS(Input::get('txtluas')),
                'jml_kmr_tidur' => Fungsi::cleanXSS(Input::get('txtjmlkmrtidur')),
                'jml_kmr_mandi' => Fungsi::cleanXSS(Input::get('txtjmlkmrmandi')),
                'garasi' => Fungsi::cleanXSS(Input::get('txtjmlgarasi'))
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
            DB::table('dt_tipe_proyek')
                ->where('id_tipe_proyek', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                    'nm_tipe' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'id_proyek' => Fungsi::cleanXSS(Input::get('slctproyek')),
                    'harga_standar' => Fungsi::cleanXSS(Input::get('txtharga')),
                    'luas_bangunan' => Fungsi::cleanXSS(Input::get('txtluas')),
                    'jml_kmr_tidur' => Fungsi::cleanXSS(Input::get('txtjmlkmrtidur')),
                    'jml_kmr_mandi' => Fungsi::cleanXSS(Input::get('txtjmlkmrmandi')),
                    'garasi' => Fungsi::cleanXSS(Input::get('txtjmlgarasi'))
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
            DB::table('dt_tipe_proyek')
                ->where('id_tipe_proyek', Fungsi::cleanXSS(Input::get('hid')))
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
            DB::table('dt_tipe_proyek')
                ->where('id_tipe_proyek', Fungsi::cleanXSS(Input::get('hid')))
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
        return Tipeproyek::where('id_tipe_proyek', Input::get('paramId'))
            ->first();
    }

    public static function jsonGetTipeByProyek() {
        return Tipeproyek::select('id_tipe_proyek','nm_tipe')
            ->where('sts_aktif', 1)
            ->where('id_proyek', Input::get('paramId'))
            ->get();
    }

    public static function get_arr_by_proyek($id) {
        return Tipeproyek::select('id_tipe_proyek','nm_tipe','luas_bangunan','jml_kmr_tidur','jml_kmr_mandi','garasi')
            ->where('sts_aktif', 1)
            ->where('id_proyek', $id)
            ->get();
    }

    public static function arr_count_unit_per_tipe_from_proyek($id_proyek) {
        $arr = array();
        $q = Tipeproyek::selectRaw("dt_tipe_proyek.id_tipe_proyek,count(id_kapling_proyek) as total_unit")
            ->leftJoin('dt_kapling_proyek','dt_tipe_proyek.id_tipe_proyek','dt_kapling_proyek.id_tipe_proyek')
            ->where('dt_kapling_proyek.sts_aktif', 1)
            ->where('dt_tipe_proyek.sts_aktif', 1)
            ->where('id_proyek', $id_proyek)
            ->groupBy('dt_tipe_proyek.id_tipe_proyek')
            ->get();
        foreach( $q as $r ) {
            $arr[$r->id_tipe_proyek] = $r->total_unit;
        }
        return $arr;
    }

    public static function cek_by_tipe($id) {
        return Tipeproyek::selectRaw("id_tipe_proyek,dt_tipe_proyek.id_proyek,nm_tipe,nm_proyek,if(ifnull(uri_pic_proyek,'')='', 'images/defaultfoto.jpg',uri_pic_proyek) as uri_pic_proyek,luas_bangunan")
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('id_tipe_proyek', $id)
            ->where('dt_tipe_proyek.sts_aktif', 1)
            ->first();
    }

    private static function get_arr_aktif() {
        return Tipeproyek::selectRaw("nm_tipe,harga_standar,luas_bangunan,jml_kmr_tidur,jml_kmr_mandi,garasi,nm_proyek,ifnull((
            select concat('unggahfiles/galeritipe/',nm_foto) from dt_galeri_tipe_proyek a where a.id_tipe_proyek=dt_tipe_proyek.id_tipe_proyek limit 1
            ),if(ifnull(pic_proyek,'')='', 'images/defaultfoto.jpg',concat('unggahfiles/gambarproyek/',pic_proyek))) as uri_pic_tipe,alamat")
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('dt_tipe_proyek.sts_aktif', 1)
            ->get();
    }

    public static function preview_home_online() {
        $html = '';
        foreach( self::get_arr_aktif() as $row ) {
            $html .= '<div class="item col-md-4" data-animation-direction="from-bottom" data-animation-delay="200">
                <div class="image">
                    <a href="'. url('properties/'. str_replace(' ','_',strtolower($row->nm_proyek))) .'">
                        <h3>'. $row->nm_proyek .'</h3>
                        <span class="location">'. $row->alamat .'</span>
                    </a>
                    <img src="'. url($row->uri_pic_tipe) .'" alt="" />
                </div>
                <div class="price">
                    <i class="fa fa-home"></i>'. $row->nm_tipe .'
                    <span>Rp. '. number_format($row->harga_standar,2) .'</span>
                </div>
                <ul class="amenities">
                    <li><i class="icon-area"></i> '. $row->luas_bangunan .' m<sup>2</sup></li>
                    <li><i class="icon-bedrooms"></i> '. $row->jml_kmr_tidur .'</li>
                    <li><i class="icon-bathrooms"></i> '. $row->jml_kmr_mandi .'</li>
                </ul>
            </div>';
        }
        echo $html;
    }

    private static function get_arr_tipe_by_proyek($id_proyek) {
        return Tipeproyek::selectRaw("id_tipe_proyek,nm_tipe,harga_standar,luas_bangunan,jml_kmr_tidur,jml_kmr_mandi,garasi")
            ->where('id_proyek', $id_proyek)
            ->get();
    }

    public static function get_arr_detil_by_proyek($id_proyek) {
        $arr = array();
        $galeries = Galeritipe::arr_by_proyek($id_proyek);
        foreach( self::get_arr_tipe_by_proyek($id_proyek) as $r ) {
            if ( array_key_exists($r->id_tipe_proyek, $galeries) ) {
                $arr[] = array(
                    'id_tipe_proyek' => $r->id_tipe_proyek,
                    'nm_tipe' => $r->nm_tipe,
                    'harga_standar' => $r->harga_standar,
                    'luas_bangunan' => $r->luas_bangunan,
                    'jml_kmr_tidur' => $r->jml_kmr_tidur,
                    'jml_kmr_mandi' => $r->jml_kmr_mandi,
                    'images' => $galeries[$r->id_tipe_proyek]
                );
            } else {
                $arr[] = array(
                    'id_tipe_proyek' => $r->id_tipe_proyek,
                    'nm_tipe' => $r->nm_tipe,
                    'harga_standar' => $r->harga_standar,
                    'luas_bangunan' => $r->luas_bangunan,
                    'jml_kmr_tidur' => $r->jml_kmr_tidur,
                    'jml_kmr_mandi' => $r->jml_kmr_mandi,
                    'images' => array()
                );
            }
        }
        return $arr;
    }

    public static function get_array_paging() {
        return Tipeproyek::selectRaw("nm_tipe,harga_standar,luas_bangunan,jml_kmr_tidur,jml_kmr_mandi,garasi,nm_proyek,ifnull((
            select uri_foto from dt_galeri_tipe_proyek a where a.id_tipe_proyek=dt_tipe_proyek.id_tipe_proyek limit 1
            ),if(ifnull(uri_pic_proyek,'')='', 'images/defaultfoto.jpg',uri_pic_proyek)) as uri_pic_tipe,alamat")
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('dt_tipe_proyek.sts_aktif', 1)
            ->paginate(10);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use Session;

class Kapling extends Model
{
    protected $table = 'dt_kapling_proyek';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "1=1";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $where .= input::get('sByStatus') == '' ? "" : " and if(ifnull(id_tr_jual,'') = '', 0, 1)='". Input::get('sByStatus') ."'";
        $result = Kapling::select(DB::raw("dt_kapling_proyek.id_kapling_proyek,dt_kapling_proyek.alamat,format(harga+dt_kapling_proyek.biaya_lain,0) as harga,luas_tanah,nm_proyek,nm_tipe,dt_kapling_proyek.sts_aktif,if(ifnull(id_tr_jual,'') = '', 0, 1) as status"))
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->leftJoin('dt_tr_jual', function($join){
                $join->on('dt_tr_jual.id_kapling_proyek','=','dt_kapling_proyek.id_kapling_proyek')
                    ->where('dt_tr_jual.sts_batal', '=', '0');
            })
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "1=1";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $where .= input::get('sByStatus') == '' ? "" : " and if(ifnull(id_tr_jual,'') = '', 0, 1)='". Input::get('sByStatus') ."'";
        $result = Kapling::select('id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->leftJoin('dt_tr_jual', function($join){
                $join->on('dt_tr_jual.id_kapling_proyek','=','dt_kapling_proyek.id_kapling_proyek')
                    ->where('dt_tr_jual.sts_batal', '=', '0');
            })
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah() {
        DB::beginTransaction();
        try {
            Kapling::insert(array(
                'id_kapling_proyek' => time(),
                'id_tipe_proyek' => Fungsi::cleanXSS(Input::get('slcttipe')),
                'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                'harga' => Fungsi::cleanXSS(Input::get('txtharga')),
                'luas_tanah' => Fungsi::cleanXSS(Input::get('txtluas')),
                'harga_klt_per_meter' => Fungsi::cleanXSS(Input::get('txthargaklt')),
                'biaya_lain' => Fungsi::cleanXSS(Input::get('txtbiayalain')),
                'ket_biaya_lain' => Fungsi::cleanXSS(Input::get('txtketbiayalain'))
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
            Kapling::where('id_kapling_proyek', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                    'id_tipe_proyek' => Fungsi::cleanXSS(Input::get('slcttipe')),
                    'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                    'harga' => Fungsi::cleanXSS(Input::get('txtharga')),
                    'luas_tanah' => Fungsi::cleanXSS(Input::get('txtluas')),
                    'harga_klt_per_meter' => Fungsi::cleanXSS(Input::get('txthargaklt')),
                    'biaya_lain' => Fungsi::cleanXSS(Input::get('txtbiayalain')),
                    'ket_biaya_lain' => Fungsi::cleanXSS(Input::get('txtketbiayalain'))
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
            Kapling::where('id_kapling_proyek', Fungsi::cleanXSS(Input::get('hid')))
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
        if( Penjualan::cekRiwayatKapling(Fungsi::cleanXSS(Input::get('hid'))) == 0 ) {
            DB::beginTransaction();
            try {
                
                Kapling::where('id_kapling_proyek', Fungsi::cleanXSS(Input::get('hid')))
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
        } else {
            return 'Maaf Kapling tidak dapat di hapus karena sudah pernah melakukan transaksi !';
        }
    }

    public static function findById()
    {
        return Kapling::select(DB::raw("dt_kapling_proyek.*,dt_proyek.id_proyek"))
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('id_kapling_proyek', Input::get('paramId'))
            ->first();
    }

    public static function opsi() {
        $q = Kapling::select('id_kapling_proyek', 'nm_proyek')
            ->where('sts_aktif', 1)
            ->orderBy('nm_proyek')
            ->get();
        $opsi = '';
        foreach( $q as $r ) {
            $opsi .= '<option value="'. $r->id_kapling_proyek .'"> '. $r->nm_proyek .' </option>';
        }
        echo $opsi;
    }

    public static function arrKaplingTersedia()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "sts_terjual=0 and dt_kapling_proyek.sts_aktif=1";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $result = Kapling::select(DB::raw('id_kapling_proyek,dt_kapling_proyek.alamat,format(harga+biaya_lain,0) as harga,nm_proyek,nm_tipe,luas_bangunan,luas_tanah'))
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function arrKaplingTersediaPaging()
    {
        $where = "sts_terjual=0 and dt_kapling_proyek.sts_aktif=1";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $result = Kapling::select('id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    //Cek kapling sudah terjual apa belum untuk entri penjualan
    public static function checkKaplingBelumTerjual() {
        return Kapling::select('dt_kapling_proyek.*','nm_tipe', 'nm_proyek','luas_bangunan')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('id_kapling_proyek', Input::get('paramId'))
            ->where('sts_terjual', 0)
            ->first();
    }

    public static function cekStatusTerjual($getID) {
        return Kapling::where('id_kapling_proyek', $getID)
            ->where('sts_terjual', 0)
            ->count(); 
    }

    public static function jmlkapling() {
        return Kapling::select('id_kapling_proyek')
            ->where('sts_aktif', 1)
            ->count();
    }

    public static function jmlkaplingterjual() {
        return Kapling::selectRaw("count(id_kapling_proyek) as kapling_terjual,format(sum(harga+((luas_tanah-luas_bangunan)*harga_klt_per_meter)),0) as total_pernjualan")
            ->leftJoin('dt_tipe_proyek','dt_tipe_proyek.id_tipe_proyek','dt_kapling_proyek.id_tipe_proyek')
            ->where('sts_terjual', 1)
            ->where('dt_kapling_proyek.sts_aktif', 1)
            ->first();
    }

    public static function get_array_paging_by_tipe($req) {
        $where = "dt_tipe_proyek.id_tipe_proyek='". $req->id ."' and dt_kapling_proyek.sts_aktif=1";
        $where .= empty($req->key_address) ? "" : " and alamat like '%". $req->key_address ."%'";
        $where .= $req->key_sts == "" ? "" : " and sts_terjual='". $req->key_sts ."'";
        return Kapling::selectRaw("dt_kapling_proyek.id_kapling_proyek,nm_tipe,alamat,harga,harga_klt_per_meter,luas_tanah,luas_bangunan,sts_terjual,if(ifnull(nm_image,'')='','../images/defaultfoto.jpg',concat('../unggahfiles/kapling/',nm_image)) as nm_image")
            ->leftJoin('dt_tipe_proyek','dt_tipe_proyek.id_tipe_proyek','dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_images_kapling', function($join){
                $join->on('dt_images_kapling.id_kapling_proyek','=','dt_kapling_proyek.id_kapling_proyek')
                    ->where('dt_images_kapling.sts_default', 1);
            })
            ->whereRaw($where)
            ->paginate(10);
    }

    private static function get_laporan_resume_per_proyek() {
        return Kapling::selectRaw("id_tipe_proyek,alamat
            ,if(ifnull(id_tr_jual,'') = '','-', 'Terjual') as sts_terjual
            ,if(ifnull(id_tr_jual,'') = '','-', date_format(tgl_jual, '%d-%m-%Y')) as tgl_terjual
            ,if(ifnull(id_tr_jual,'') = '','-',
                if(ifnull(tgl_akad,'') = '',
                    if(ifnull(tgl_sp3k,'') = '',
                        if(ifnull(tgl_wawancara,'') = '','Booking Fee','Wawancara')
                    ,'SP3K')
                ,'Akad')
            ) as sts_proses")
            ->leftJoin('dt_tr_jual', function($left){
                $left::on('dt_tr_jual.id_kapling_proyek','dt_kapling_proyek.id_kapling_proyek')
                    ->where('sts_batal',0);
            })
            ->leftJoin('dt_tipe_proyek','dt_tipe_proyek.id_tipe_proyek','dt_kapling_proyek.id_tipe_proyek')
            ->whereRaw("id_proyek=''")
            ->get();
    }

    public static function get_arr_by_tipe_proyek() {
        $arr = array();
        foreach( self::get_laporan_resume_per_proyek() as $r ) {
            $arr[$r->id_tipe_proyek] = $r;
        }
        return $arr;
    }
}

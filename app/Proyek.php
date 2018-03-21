<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Fungsi;
use Session;

class Proyek extends Model
{
    protected $table = 'dt_proyek';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "1=1";
        $result = Proyek::select(DB::raw("id_proyek,nm_proyek,alamat,nm_provinsi,nm_kota,nm_kecamatan,nm_kelurahan,
        format(luas_proyek,0) as luas_proyek,concat(date_format(periode_mulai,'%d-%m-%Y'),' s.d ', date_format(periode_selesai,'%d-%m-%Y')) as periode,dt_proyek.sts_aktif"))
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "1=1";
        $result = Proyek::select('id_proyek')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah($req) {
        $createID = time();
        $pic_proyek = '';
        $uri_pic_proyek = '';
        if ( $req->hasFile('gambarproyek')){
            $file = $req->file('gambarproyek');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = $file->path();
            $destination = base_path() . '/public/unggahfiles/gambarproyek';
            $type = pathinfo($jpg, PATHINFO_EXTENSION);
            $new_image = $createID .'.'. $type;
            
            $file->move($destination, $new_image);
            $data = file_get_contents($destination .'/'. $new_image);
            $uri_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $pic_proyek = $new_image;
            $uri_pic_proyek = $uri_image;
        }

        $pic_siteplan = '';
        $uri_pic_siteplan = '';
        if ( $req->hasFile('filemasterplan')){
            $file = $req->file('filemasterplan');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = $file->path();
            $destination = base_path() . '/public/unggahfiles/gambarsiteplan';
            $type = pathinfo($jpg, PATHINFO_EXTENSION);
            $new_image = $createID .'.'. $type;
            
            $file->move($destination, $new_image);
            $data = file_get_contents($destination .'/'. $new_image);
            $uri_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $pic_siteplan = $new_image;
            $uri_pic_siteplan = $uri_image;
        }

        $file_brosur = '';
        if ( $req->hasFile('filebrosur')){
            $file = $req->file('filebrosur');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = $file->path();
            $destination = base_path() . '/public/unggahfiles/filebrosur';
            $type = pathinfo($jpg, PATHINFO_EXTENSION);
            $new_file = $createID .'.'. $type;
            
            $file->move($destination, $new_file);
            $file_brosur = $new_file;
        }
        
        DB::beginTransaction();
        try {
            Proyek::insert(array(
                'id_proyek' => $createID,
                'nm_proyek' => Fungsi::cleanXSS(Input::get('txtnama')),
                'id_kelurahan' => Fungsi::cleanXSS(Input::get('slctkelurahan')),
                'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                'luas_proyek' => Fungsi::cleanXSS(Input::get('txtluas')),
                'desc_proyek' => Input::get('txtdesc'),
                'periode_mulai' => Fungsi::cleanXSS(Input::get('txtstart')),
                'periode_selesai' => Fungsi::cleanXSS(Input::get('txtend')),
                'pic_master_plan' => $pic_siteplan,
                'uri_pic_master_plan' => $uri_pic_siteplan,
                'pic_proyek' => $pic_proyek,
                'uri_pic_proyek' => $uri_pic_proyek,
                'file_brosur' => $file_brosur,
                'lat' => str_replace(' ','',Input::get('txtlat')),
                'lang' => str_replace(' ','',Input::get('txtlong')),
                'radius' => Input::get('txtradius')
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

    public static function Edit ($req)
    {
        $arrpostimage = array();
        if ( $req->hasFile('gambarproyek')){
            $file = $req->file('gambarproyek');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = $file->path();
            $destination = base_path() . '/public/unggahfiles/gambarproyek';
            $type = pathinfo($jpg, PATHINFO_EXTENSION);
            $new_image = Input::get('hid') .'.'. $type;
            
            $file->move($destination, $new_image);
            $data = file_get_contents($destination .'/'. $new_image);
            $uri_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $arrpostimage = array(
                'pic_proyek' => $new_image,
                'uri_pic_proyek' => $uri_image
            );
        }

        $arrpostsiteplan = array();
        if ( $req->hasFile('filemasterplan')){
            $file = $req->file('filemasterplan');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = $file->path();
            $destination = base_path() . '/public/unggahfiles/gambarsiteplan';
            $type = pathinfo($jpg, PATHINFO_EXTENSION);
            $new_image = Input::get('hid') .'.'. $type;
            
            $file->move($destination, $new_image);
            $data = file_get_contents($destination .'/'. $new_image);
            $uri_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $arrpostsiteplan = array(
                'pic_master_plan' => $new_image,
                'uri_pic_master_plan' => $uri_image
            );
        }

        $arrpostbrosur = array();
        if ( $req->hasFile('filebrosur')){
            $file = $req->file('filebrosur');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = $file->path();
            $destination = base_path() . '/public/unggahfiles/filebrosur';
            $type = pathinfo($jpg, PATHINFO_EXTENSION);
            $new_file = Input::get('hid') .'.'. $type;
            
            $file->move($destination, $new_file);
            $arrpostbrosur = array(
                'file_brosur' => $new_file
            );
        }
        
        DB::beginTransaction();
        try {
            DB::table('dt_proyek')
                ->where('id_proyek', Fungsi::cleanXSS(Input::get('hid')))
                ->update(array_merge([
                    'nm_proyek' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'id_kelurahan' => Fungsi::cleanXSS(Input::get('slctkelurahan')),
                    'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                    'luas_proyek' => Fungsi::cleanXSS(Input::get('txtluas')),
                    'desc_proyek' => Input::get('txtdesc'),
                    'periode_mulai' => Fungsi::cleanXSS(Input::get('txtstart')),
                    'periode_selesai' => Fungsi::cleanXSS(Input::get('txtend')),
                    'lat' => str_replace(' ','',Input::get('txtlat')),
                    'lang' => str_replace(' ','',Input::get('txtlong')),
                    'radius' => Input::get('txtradius')
                ], $arrpostimage, $arrpostsiteplan, $arrpostbrosur));
            
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
            DB::table('dt_proyek')
                ->where('id_proyek', Fungsi::cleanXSS(Input::get('hid')))
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
            DB::table('dt_proyek')
                ->where('id_proyek', Fungsi::cleanXSS(Input::get('hid')))
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
        return Proyek::select(DB::raw("id_proyek,nm_proyek,alamat,dt_proyek.id_kelurahan,dt_kecamatan.id_kecamatan,dt_kelurahan.id_kelurahan,dt_kota.id_kota,dt_provinsi.id_provinsi,pic_proyek,uri_pic_proyek,pic_master_plan,uri_pic_master_plan,file_brosur,lat,lang as langitute, desc_proyek,luas_proyek,periode_mulai,date_format(periode_mulai, '%d-%m-%Y') as periode_mulai_indo,periode_selesai,date_format(periode_selesai, '%d-%m-%Y') as periode_selesai_indo"))
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')
            ->where('id_proyek', Input::get('paramId'))
            ->first();
    }

    public static function opsi() {
        $q = Proyek::select('id_proyek', 'nm_proyek')
            ->where('sts_aktif', 1)
            ->orderBy('nm_proyek')
            ->get();
        $opsi = '';
        foreach( $q as $r ) {
            $opsi .= '<option value="'. $r->id_proyek .'"> '. $r->nm_proyek .' </option>';
        }
        echo $opsi;
    }

    public static function jmlproyek() {
        return Proyek::select('id_proyek')
            ->where('sts_aktif', 1)
            ->count();
    }

    public static function getById($id) {
        return Proyek::select('id_proyek','uri_pic_master_plan','pic_master_plan','nm_proyek', 'pic_proyek', 'uri_pic_proyek', 'file_brosur', 'desc_proyek','lat','lang','radius','luas_proyek', 'alamat', 'desc_proyek', 'nm_provinsi', 'nm_kecamatan', 'nm_kota', 'nm_kelurahan')
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')
            ->where('id_proyek', $id)
            ->first();
    }

    public static function HapusMasterPlan() {
        $cek = self::getById(Fungsi::cleanXSS(Input::get('hid')));
        if (count($cek) == 1) {
            DB::beginTransaction();
            try {
                DB::table('dt_proyek')
                    ->where('id_proyek', Fungsi::cleanXSS(Input::get('hid')))
                    ->update([
                        'pic_master_plan' => '',
                        'uri_pic_master_plan' => ''
                    ]);
                File::delete('unggahfiles/gambarsiteplan/'. $cek->pic_master_plan);
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
            return 'Data tidak di ketemukan !';
        }
    }

    public static function HapusGambarTajuk() {
        $cek = self::getById(Fungsi::cleanXSS(Input::get('hid')));
        if (count($cek) == 1) {
            DB::beginTransaction();
            try {
                DB::table('dt_proyek')
                    ->where('id_proyek', Fungsi::cleanXSS(Input::get('hid')))
                    ->update([
                        'pic_proyek' => '',
                        'uri_pic_proyek' => '',
                    ]);
                File::delete('unggahfiles/gambarproyek/'. $cek->pic_proyek);
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
            return 'Data tidak di ketemukan !';
        }
    }

    public static function HapusBrosur() {
        $cek = self::getById(Fungsi::cleanXSS(Input::get('hid')));
        if (count($cek) == 1) {
            DB::beginTransaction();
            try {
                DB::table('dt_proyek')
                    ->where('id_proyek', Fungsi::cleanXSS(Input::get('hid')))
                    ->update([
                        'file_brosur' => ''
                    ]);
                File::delete('unggahfiles/filebrosur/'. $cek->file_brosur);
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
            return 'Data tidak di ketemukan !';
        }
    }

    public static function getOnlineHome() {
        return Proyek::select('id_proyek','nm_proyek','uri_pic_proyek', 'uri_pic_master_plan','nm_kota','nm_provinsi','alamat','luas_proyek')
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')
            ->where('dt_proyek.sts_aktif', 1)
            ->orderBy('id_proyek')
            ->get();
    }

    public static function get_array_paging() {
        return Proyek::selectRaw("id_proyek,nm_proyek,if(ifnull(uri_pic_proyek,'')='', 'images/defaultfoto.jpg',uri_pic_proyek) as uri_pic_proyek,if(ifnull(uri_pic_master_plan,'')='', 'images/defaultfoto.jpg',uri_pic_master_plan) as uri_pic_master_plan,nm_kota,nm_provinsi,alamat,luas_proyek")
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')
            ->where('dt_proyek.sts_aktif', 1)
            ->paginate(10);
    }

    private static function get_arr_aktif() {
        return Proyek::selectRaw("id_proyek,nm_proyek,if(ifnull(uri_pic_proyek,'')='', 'images/defaultfoto.jpg',uri_pic_proyek) as uri_pic_proyek,nm_kota,nm_provinsi,alamat,nm_kecamatan,nm_kelurahan,desc_proyek")
            ->where('dt_proyek.sts_aktif', 1)
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')
            ->get();
    }

    public static function preview_home_online() {
        $html = '';
        foreach( self::get_arr_aktif() as $row ) {
            $html .= '<div class="item">
                <div class="image">
                    <a href="'. url('properties/'. str_replace(' ','_',strtolower($row->nm_proyek))) .'"></a>
                    <img src="'. $row->uri_pic_proyek .'" alt="" />
                </div>
                <div class="info">
                    <h3><a href="'. url('properties/'. str_replace(' ','_',strtolower($row->nm_proyek))) .'">'. $row->nm_proyek .'</a></h3>
                    '. $row->desc_proyek .'
                    <a href="'. url('properties/'. str_replace(' ','_',strtolower($row->nm_proyek))) .'" class="btn btn-default">Read More</a>
                </div>
            </div>';
        }
        echo $html;
    }

    public static function arr_location_proyek() {
        return Proyek::selectRaw("id_proyek,nm_proyek,if(ifnull(uri_pic_proyek,'')='', '". url('images/defaultfoto.jpg') ."',uri_pic_proyek) as uri_pic_proyek,lat,lang,desc_proyek")
            ->leftJoin('dt_kelurahan', 'dt_kelurahan.id_kelurahan', 'dt_proyek.id_kelurahan')
            ->leftJoin('dt_kecamatan', 'dt_kecamatan.id_kecamatan', 'dt_kelurahan.id_kecamatan')
            ->leftJoin('dt_kota', 'dt_kota.id_kota', 'dt_kecamatan.id_kota')
            ->leftJoin('dt_provinsi', 'dt_provinsi.id_provinsi', 'dt_kota.id_provinsi')    
            ->where('dt_proyek.sts_aktif', 1)
            ->get();
    }

    public static function cek_by_judul($judul) {
        return Proyek::select('id_proyek')
            ->where('nm_proyek', strtolower(str_replace('_',' ',$judul)))
            ->where('sts_aktif', 1)
            ->first();
    }

    public static function opsiByName() {
        $q = Proyek::select('id_proyek', 'nm_proyek')
            ->where('sts_aktif', 1)
            ->orderBy('nm_proyek')
            ->get();
        $opsi = '';
        foreach( $q as $r ) {
            $opsi .= '<option value="'. str_replace(' ', '_', strtolower($r->nm_proyek)) .'"> '. $r->nm_proyek .' </option>';
        }
        echo $opsi;
    }
}

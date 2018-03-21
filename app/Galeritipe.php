<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Fungsi;
use Session;

class Galeritipe extends Model
{
    protected $table = 'dt_galeri_tipe_proyek';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $result = Galeritipe::select('id_galeri_tipe','nm_foto','uri_foto','keterangan','sts_aktif')
            ->where('id_tipe_proyek', Input::get('sTipe'))
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $result = Galeritipe::select('id_galeri_tipe')
            ->where('id_tipe_proyek', Input::get('sTipe'))
            ->count();
        return $result;
    }

    public static function tambah($req) {

        $new_image = '';
        if ( $req->hasFile('unggahimg')){
            $file = $req->file('unggahimg');
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $destination = base_path() . '/public/unggahfiles/galeritipe';
            $type = pathinfo($name, PATHINFO_EXTENSION);
            $new_image = time() .'_'. $req->hidtipe .'.' . $type;
            
            $pindahfile = $file->move($destination, $new_image);
            if ( $pindahfile ) {
                $data = file_get_contents(url('unggahfiles/galeritipe/'. $new_image));
                $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
                DB::beginTransaction();
                try {
                    Galeritipe::insert(array(
                        'id_galeri_tipe' => time(),
                        'id_tipe_proyek' => Fungsi::cleanXSS($req->hidtipe),
                        'nm_foto' => $new_image,
                        'uri_foto' => $dataUri,
                        'keterangan' => Fungsi::cleanXSS($req->desc)
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
            } else {
                return 'Maaf unggah file gagal !';
            }
        } else {
            return 'Tidak ada gambar yang di unggah !';
        }
    }

    public static function edit($req) {

        $arr_edit_image = array();
        $new_image = '';
        if ( $req->hasFile('unggahimg')){
            $file = $req->file('unggahimg');
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $destination = base_path() . '/public/unggahfiles/galeritipe';
            $type = pathinfo($name, PATHINFO_EXTENSION);
            $new_image = time() .'_'. $req->hidtipe .'.' . $type;
            
            $pindahfile = $file->move($destination, $new_image);
            if ( $pindahfile ) {
                $data = file_get_contents(url('unggahfiles/galeritipe/'. $new_image));
                $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $arr_edit_image = array(
                    'nm_foto' => $new_image,
                    'uri_foto' => $dataUri,
                );
            } else {
                return 'Maaf unggah file gagal !';
            }
        }

        DB::beginTransaction();
        try {
            Galeritipe::where('id_galeri_tipe', Input::get('hid'))
                ->update(array_merge(array(
                'keterangan' => Fungsi::cleanXSS($req->desc)
            ), $arr_edit_image ));
            
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

    public static function findById($id)
    {
        return Galeritipe::where('id_galeri_tipe', $id)
            ->first();
    }

    public static function Remove ()
    {
        $cek = self::findById(Fungsi::cleanXSS(Input::get('hid')));
        if ( count($cek) == 1 ) {
            $hapus = File::delete(base_path() . '/public/unggahfiles/galeritipe/'. $cek->nm_foto);
            if ( $hapus ) {
                DB::beginTransaction();
                try {
                    Galeritipe::where('id_galeri_tipe', Fungsi::cleanXSS(Input::get('hid')))
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
                return 'Hapus file Gagal !';
            }
        } else {
            return 'Data tidak di ketemukan !';
        }
    }

    public static function arr_by_proyek($id_proyek) {
        $arr = array();
        $q = Galeritipe::select('dt_galeri_tipe_proyek.id_tipe_proyek', 'uri_foto')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_galeri_tipe_proyek.id_tipe_proyek')
            ->where('id_proyek', $id_proyek)
            ->get();

        foreach( $q as $row ) {
            $arr[$row->id_tipe_proyek][] = $row->uri_foto;
        }

        return $arr;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Fungsi;
use Session;
use Faker\Provider\Image;

class Imageskapling extends Model
{
    protected $table = 'dt_images_kapling';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "id_kapling_proyek='". Input::get('sKapling') ."'";
        $result = Imageskapling::select(DB::raw('id_images_kapling,nm_image,sts_default,sts_aktif'))
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->orderBy('sts_default', 'desc')
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "id_kapling_proyek='". Input::get('sKapling') ."'";
        $result = Imageskapling::select('id_images_kapling')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah($req) {

        $new_image = '';
        if ( $req->hasFile('unggahimg')){
            $file = $req->file('unggahimg');
            $pdf = $file->getClientOriginalName();
            $size = $file->getSize();
            $destination = base_path() . '/public/unggahfiles/kapling';
            $new_image = time() . $pdf;
            //$type = pathinfo($new_image, PATHINFO_EXTENSION);
            //$data = file_get_contents(url('unggahfiles/kapling/'. $new_image));
            //$dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $pindahfile = $file->move($destination, $new_image);
            if ( $pindahfile ) {
                DB::beginTransaction();
                try {
                    $sts_default = self::cekDefaultImagesById(Input::get('idkapling'));
                    Imageskapling::insert(array(
                        'id_images_kapling' => time(),
                        'id_kapling_proyek' => Fungsi::cleanXSS(Input::get('idkapling')),
                        'nm_image' => $new_image,
                        'sts_default' => $sts_default == 0 ? 1 : 0
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

    public static function Valid ()
    {
        DB::beginTransaction();
        try {
            $cek = self::findById(Fungsi::cleanXSS(Input::get('hid')));
            Imageskapling::where('id_kapling_proyek', $cek->id_kapling_proyek)
                ->update([
                'sts_default' => 0
                ]);

            Imageskapling::where('id_images_kapling', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                'sts_default' => Input::get('sts')
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
        $cek = self::findById(Fungsi::cleanXSS(Input::get('hid')));

        if ( count($cek) == 0 ) {
            return 'Maaf file tidak ditemukan atau telah di hapus !';
        } else {
            DB::beginTransaction();
            try {
                Imageskapling::where('id_images_kapling', Fungsi::cleanXSS(Input::get('hid')))
                    ->delete();
                File::delete(base_path() . '/public/unggahfiles/kapling/'. $cek->nm_image);
                
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

    public static function findById($Id)
    {
        return Imageskapling::select('nm_image', 'id_kapling_proyek')
            ->where('id_images_kapling', $Id)
            ->first();
    }

    public static function cekDefaultImagesById($id_kapling) {
        return Imageskapling::select('id_images_kapling')
            ->where('id_kapling_proyek', $id_kapling)
            ->where('sts_default', 1)
            ->count();
    }
}

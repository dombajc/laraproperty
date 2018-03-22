<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use App\Konsumen;
use App\Kapling;
use App\Penjualan;
use Session;

class Pembatalan extends Model
{
    protected $table = 'dt_tr_batal';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "dt_tr_batal.sts_aktif=1";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $where .= empty(Input::get('sByTglAwal')) ? '' : " and tgl_batal>='". Fungsi::formatdatetosql(Input::get('sByTglAwal')) ."'";
        $where .= empty(Input::get('sByTglAkhir')) ? '' : " and tgl_batal<='". Fungsi::formatdatetosql(Input::get('sByTglAkhir')) ."'";
        $where .= empty(Input::get('sByNama')) ? '' : " and nm_konsumen like '%". Input::get('sByNama') ."%'";
        
        $result = Pembatalan::select(DB::raw("id_tr_batal,alasan,DATE_FORMAT(tgl_batal,'%d-%m-%Y') as tgl_batal,dt_kapling_proyek.alamat,dt_proyek.nm_proyek,nm_tipe"))
            ->leftJoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')
            ->leftJoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->whereRaw($where)
            ->orderBy('id_tr_batal')
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "dt_tr_batal.sts_aktif=1";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $where .= empty(Input::get('sByTglAwal')) ? '' : " and tgl_batal>='". Fungsi::formatdatetosql(Input::get('sByTglAwal')) ."'";
        $where .= empty(Input::get('sByTglAkhir')) ? '' : " and tgl_batal<='". Fungsi::formatdatetosql(Input::get('sByTglAkhir')) ."'";
        $where .= empty(Input::get('sByNama')) ? '' : " and nm_konsumen like '%". Input::get('sByNama') ."%'";

        $result = Pembatalan::select('id_tr_batal')
            ->leftJoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')
            ->leftJoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah() {
        DB::beginTransaction();
        try {

            $check_penjualan = Penjualan::cekPenjualanAktif(Fungsi::cleanXSS(Input::get('hidpenjualan')));

            if ( count($check_penjualan) == 1 ) {

                Penjualan::where('id_tr_jual', Fungsi::cleanXSS(Input::get('hidpenjualan')))
                    ->update([
                        'sts_batal' => 1
                    ]);

                DB::table('dt_tr_batal')
                    ->leftJoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')
                    ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
                    ->where('dt_kapling_proyek.id_kapling_proyek', $check_penjualan->id_kapling_proyek)
                    ->update([
                        'dt_tr_batal.sts_aktif' => 0
                    ]);

                Pembatalan::insert(array(
                    'id_tr_batal' => time(),
                    'id_tr_jual' => Fungsi::cleanXSS(Input::get('hidpenjualan')),
                    'tgl_batal' => Fungsi::formatdatetosql(Input::get('txttgl')),
                    'alasan' => Fungsi::cleanXSS(Input::get('txtalasan')),
                    'create_at' => date('Y-m-d H:i:s'),
                    'create_by' => '9999'
                ));

                Kapling::where('id_kapling_proyek', $check_penjualan->id_kapling_proyek)
                    ->update([
                        'sts_terjual' => 0
                    ]);

            } else {
                return 'Transaksi tidak di ketemukan !';
            }
            
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
            Pembatalan::where('id_tr_batal', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                    'tgl_batal' => Fungsi::formatdatetosql(Input::get('txttgl')),
                    'alasan' => Fungsi::cleanXSS(Input::get('txtalasan')),
                    'create_by' => '9999'
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
            $cek_kapling_sudah_terjual_belum = self::cekKaplingSudahTerjualLagi(Input::get('hid'));
            if ( count($cek_kapling_sudah_terjual_belum) == 1 ) {

                if ( $cek_kapling_sudah_terjual_belum->sts_terjual == 1 ) {
                    return 'Maaf Pembatalan tidak dapat di hapus karena kapling sudah terjual !';
                } else {

                    Kapling::where('id_kapling_proyek', $cek_kapling_sudah_terjual_belum->id_kapling_proyek)
                    ->update([
                        'sts_terjual' => 1
                    ]);

                    Penjualan::where('id_tr_jual', $cek_kapling_sudah_terjual_belum->id_tr_jual)
                        ->update([
                            'sts_batal' => 0
                        ]);

                    Pembatalan::where('id_tr_batal', Fungsi::cleanXSS(Input::get('hid')))
                        ->delete();

                    $cek_pembatalan_terakhir = self::dapatkanIDPembatalanTerakhir($cek_kapling_sudah_terjual_belum->id_kapling_proyek);
                    if ( count($cek_pembatalan_terakhir) == 1 ) {
                        DB::table('dt_tr_batal')
                            ->where('id_tr_batal', $cek_pembatalan_terakhir->id_tr_batal)
                            ->update([
                                'dt_tr_batal.sts_aktif' => 1
                            ]);
                    }

                    DB::commit();
                }                
            } else {
                return 'Maaf Pembatalan tidak di ketemukan !';
            }
            
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
        return Pembatalan::select(DB::raw("dt_tr_batal.*,nik,nm_konsumen,dt_konsumen.no_hp,dt_kapling_proyek.alamat as alamat_kapling,nm_tipe,nm_proyek,date_format(tgl_batal, '%d-%m-%Y') as tgl_batal_indo,date_format(tgl_jual, '%d-%m-%Y') as tgl_jual_indo,format((harga_sepakat+((luas_tanah-luas_bangunan)*dt_tr_jual.harga_klt_per_meter)+biaya_penambahan),0) as total_biaya"))
            ->leftJoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')
            ->leftJoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftJoin('dt_marketing', 'dt_marketing.id_marketing', 'dt_tr_jual.id_marketing')
            ->leftJoin('dt_cara_pembayaran', 'dt_cara_pembayaran.id_cara_pembayaran', 'dt_tr_jual.id_cara_pembayaran')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('id_tr_batal', Input::get('paramId'))
            ->first();
    }

    private static function cekKaplingSudahTerjualLagi($getId) {
        return Pembatalan::select('dt_kapling_proyek.id_kapling_proyek', 'dt_tr_batal.id_tr_jual', 'dt_kapling_proyek.sts_terjual')
            ->leftJoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->where('id_tr_batal', $getId)
            ->first();
    }

    private static function dapatkanIDPembatalanTerakhir($getIdKapling) {
        return Pembatalan::select('id_tr_batal')
            ->leftJoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->where('dt_kapling_proyek.id_kapling_proyek', $getIdKapling)
            ->orderBy('dt_kapling_proyek.id_kapling_proyek', 'desc')
            ->first();
    }

    public static function get_laporan_pembatalan($req) {
        $where = 'dt_tr_batal.sts_aktif=1';
        $where .= empty($req->p) ? '' : " and dt_proyek.id_proyek='". $req->p ."'";
        $where .= empty($req->t) ? '' : " and dt_tipe_proyek.id_tipe_proyek='". $req->t ."'";
        $where .= empty($req->s) ? '' : " and tgl_batal>='". Fungsi::formatdatetosql($req->s) ."'";
        $where .= empty($req->e) ? '' : " and tgl_batal<='". Fungsi::formatdatetosql($req->e) ."'";

        return Pembatalan::selectRaw("date_format(tgl_batal,'%d-%m-%Y') as tgl_batal,alasan,nm_konsumen,no_hp
        ,date_format(tgl_jual,'%d-%m-%Y') as tgl_jual
        ,dt_kapling_proyek.alamat
        ,nm_tipe,nm_proyek
        ,nm_marketing")
        ->leftjoin('dt_tr_jual', 'dt_tr_jual.id_tr_jual', 'dt_tr_batal.id_tr_jual')        
        ->leftjoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
        ->leftjoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
        ->leftjoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
        ->leftjoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
        ->leftjoin('dt_marketing', 'dt_marketing.id_marketing', 'dt_tr_jual.id_marketing')
        ->whereRaw($where)
        ->get();
    }
}

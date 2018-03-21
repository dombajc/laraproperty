<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Fungsi;
use App\Konsumen;
use App\Kapling;
use Session;

class Penjualan extends Model
{
    protected $table = 'dt_tr_jual';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "sts_batal=0";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $where .= Input::get('sByPembayaran') == '' ? "" : " and dt_tr_jual.id_cara_pembayaran='". Input::get('sByPembayaran') ."'";
        $where .= empty(Input::get('sByTglAwal')) ? '' : " and tgl_jual>='". Fungsi::formatdatetosql(Input::get('sByTglAwal')) ."'";
        $where .= empty(Input::get('sByTglAkhir')) ? '' : " and tgl_jual<='". Fungsi::formatdatetosql(Input::get('sByTglAkhir')) ."'";
        $where .= empty(Input::get('sByNama')) ? '' : " and nm_konsumen like '%". Input::get('sByNama') ."%'";
        $where .= Input::get('sByMarketing') == '' ? "" : " and dt_tr_jual.id_marketing='". Input::get('sByMarketing') ."'";

        $result = Penjualan::select(DB::raw("id_tr_jual,DATE_FORMAT(tgl_jual,'%d-%m-%Y') as tgl_jual,dt_konsumen.nm_konsumen,dt_konsumen.no_hp,dt_kapling_proyek.alamat,dt_proyek.nm_proyek,nm_tipe,dt_cara_pembayaran.cara_pembayaran,format((harga_sepakat+((luas_tanah-luas_bangunan)*dt_tr_jual.harga_klt_per_meter)+biaya_penambahan),0) as total_biaya"))
            ->leftJoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftJoin('dt_marketing', 'dt_marketing.id_marketing', 'dt_tr_jual.id_marketing')
            ->leftJoin('dt_cara_pembayaran', 'dt_cara_pembayaran.id_cara_pembayaran', 'dt_tr_jual.id_cara_pembayaran')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "sts_batal=0";
        $where .= empty(Input::get('sByProyek')) ? "" : " and dt_tipe_proyek.id_proyek='". Input::get('sByProyek') ."'";
        $where .= empty(Input::get('sByTipe')) ? "" : " and dt_kapling_proyek.id_tipe_proyek='". Input::get('sByTipe') ."'";
        $where .= empty(Input::get('sByAlamat')) ? "" : " and dt_kapling_proyek.alamat like '%". Input::get('sByAlamat') ."%'";
        $where .= Input::get('sByPembayaran') == '' ? "" : " and dt_tr_jual.id_cara_pembayaran='". Input::get('sByPembayaran') ."'";
        $where .= empty(Input::get('sByTglAwal')) ? '' : " and tgl_jual>='". Fungsi::formatdatetosql(Input::get('sByTglAwal')) ."'";
        $where .= empty(Input::get('sByTglAkhir')) ? '' : " and tgl_jual<='". Fungsi::formatdatetosql(Input::get('sByTglAkhir')) ."'";
        $where .= empty(Input::get('sByNama')) ? '' : " and nm_konsumen like '%". Input::get('sByNama') ."%'";
        $where .= Input::get('sByMarketing') == '' ? "" : " and id_marketing='". Input::get('sByMarketing') ."'";

        $result = Penjualan::select('id_tr_jual')
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

            $check_customer = Konsumen::checkInsertID()->first();

            if ( count($check_customer) == 1 ) {
                $id_customer = $check_customer->id_konsumen;
                Konsumen::where('id_konsumen', $id_customer)
                    ->update([
                        'nm_konsumen' => Fungsi::cleanXSS(Input::get('txtnama')),
                        'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                        'no_hp' => Fungsi::cleanXSS(Input::get('txtnohp')),
                        'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                        'pekerjaan' => Fungsi::cleanXSS(Input::get('txtpekerjaan')),
                    ]);
            } else {
                $id_customer = time() .'09';
                Konsumen::insert([
                    'id_konsumen' => $id_customer,
                    'nik' => Fungsi::cleanXSS(Input::get('txtnik')),
                    'nm_konsumen' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                    'no_hp' => Fungsi::cleanXSS(Input::get('txtnohp')),
                    'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                    'pekerjaan' => Fungsi::cleanXSS(Input::get('txtpekerjaan')),
                ]);
            }

            Penjualan::insert(array(
                'id_tr_jual' => time(),
                'id_konsumen' => $id_customer,
                'id_marketing' => Fungsi::cleanXSS(Input::get('slctmarketing')),
                'id_kapling_proyek' => Fungsi::cleanXSS(Input::get('txtidkapling')),
                'id_cara_pembayaran' => Fungsi::cleanXSS(Input::get('slctcarapembayaran')),
                'tgl_jual' => Fungsi::formatdatetosql(Input::get('txttgl')),
                'harga_sepakat' => Fungsi::cleanXSS(Input::get('txthargakesepakatan')),
                'harga_klt_per_meter' => Fungsi::cleanXSS(Input::get('txthargaklt')),
                'penambahan_lain' => Fungsi::cleanXSS(Input::get('txtpenambahan')),
                'ket_biaya_lain' => Fungsi::cleanXSS(Input::get('txtketbiayalain')),
                'biaya_lain' => Fungsi::cleanXSS(Input::get('txtbiayalain')),
                'biaya_penambahan' => empty(Input::get('txtbiayatambahan')) ? 0 : Fungsi::cleanXSS(Input::get('txtbiayatambahan')),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Session::get('idu')
            ));

            Kapling::where('id_kapling_proyek', Fungsi::cleanXSS(Input::get('txtidkapling')))
                ->update([
                    'sts_terjual' => 1
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

    public static function Edit ()
    {
        DB::beginTransaction();
        try {
            $check_customer = Konsumen::checkInsertID()->first();

            if ( count($check_customer) == 1 ) {
                $id_customer = $check_customer->id_konsumen;
                Konsumen::where('id_konsumen', $id_customer)
                    ->update([
                        'nm_konsumen' => Fungsi::cleanXSS(Input::get('txtnama')),
                        'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                        'no_hp' => Fungsi::cleanXSS(Input::get('txtnohp')),
                        'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                        'pekerjaan' => Fungsi::cleanXSS(Input::get('txtpekerjaan')),
                    ]);
            } else {
                $id_customer = time() .'09';
                Konsumen::insert([
                    'id_konsumen' => $id_customer,
                    'nik' => Fungsi::cleanXSS(Input::get('txtnik')),
                    'nm_konsumen' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'alamat' => Fungsi::cleanXSS(Input::get('txtalamat')),
                    'no_hp' => Fungsi::cleanXSS(Input::get('txtnohp')),
                    'email' => Fungsi::cleanXSS(Input::get('txtemail')),
                    'pekerjaan' => Fungsi::cleanXSS(Input::get('txtpekerjaan')),
                ]);
            }

            Penjualan::where('id_tr_jual', Input::get('hid'))
                ->update([
                'id_konsumen' => $id_customer,
                'id_marketing' => Fungsi::cleanXSS(Input::get('slctmarketing')),
                'id_kapling_proyek' => Fungsi::cleanXSS(Input::get('txtidkapling')),
                'id_cara_pembayaran' => Fungsi::cleanXSS(Input::get('slctcarapembayaran')),
                'tgl_jual' => Fungsi::formatdatetosql(Input::get('txttgl')),
                'harga_sepakat' => Fungsi::cleanXSS(Input::get('txthargakesepakatan')),
                'harga_klt_per_meter' => Fungsi::cleanXSS(Input::get('txthargaklt')),
                'penambahan_lain' => Fungsi::cleanXSS(Input::get('txtpenambahan')),
                'biaya_penambahan' => Fungsi::cleanXSS(Input::get('txtbiayatambahan')),
                'ket_biaya_lain' => Fungsi::cleanXSS(Input::get('txtketbiayalain')),
                'biaya_lain' => Fungsi::cleanXSS(Input::get('txtbiayalain')),
                'tgl_wawancara' => Fungsi::cleanXSS(Input::get('slctcarapembayaran')) == '001' ? empty(Input::get('txttglwawancara')) ? null : Fungsi::formatdatetosql(Input::get('txttglwawancara')) : null,
                'tgl_sp3k' => Fungsi::cleanXSS(Input::get('slctcarapembayaran')) == '001' ? empty(Input::get('txttglsp3k')) ? null : Fungsi::formatdatetosql(Input::get('txttglsp3k')) : null,
                'tgl_akad' => Fungsi::cleanXSS(Input::get('slctcarapembayaran')) == '001' ? empty(Input::get('txttglakad')) ? null : Fungsi::formatdatetosql(Input::get('txttglakad')) : null,
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

    public static function Remove ()
    {
        DB::beginTransaction();
        try {

            if ( count(self::checkID(Input::get('hid'))) == 1 ) {
                Kapling::where('id_kapling_proyek', self::checkID(Input::get('hid'))->id_kapling_proyek)
                ->update([
                    'sts_terjual' => 0
                ]);

                Penjualan::where('id_tr_jual', Fungsi::cleanXSS(Input::get('hid')))
                    ->delete();
            } else {
                return 'Maaf Transaksi tidak di ketemukan !';
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

    public static function checkID($keyID) {
        return Penjualan::select('id_kapling_proyek')
            ->where('id_tr_jual', $keyID)
            ->first();
    }

    public static function findById()
    {
        return Penjualan::select(DB::raw("dt_tr_jual.*,nik,nm_konsumen,dt_konsumen.alamat,dt_konsumen.email,dt_konsumen.no_hp,pekerjaan,dt_kapling_proyek.alamat as alamat_kapling,nm_tipe,luas_tanah,luas_bangunan,date_format(tgl_jual, '%d-%m-%Y') as tgl_jual_indo,date_format(tgl_wawancara, '%d-%m-%Y') as tgl_wawancara_indo,date_format(tgl_sp3k, '%d-%m-%Y') as tgl_sp3k_indo,date_format(tgl_akad, '%d-%m-%Y') as tgl_akad_indo"))
            ->leftJoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftJoin('dt_marketing', 'dt_marketing.id_marketing', 'dt_tr_jual.id_marketing')
            ->leftJoin('dt_cara_pembayaran', 'dt_cara_pembayaran.id_cara_pembayaran', 'dt_tr_jual.id_cara_pembayaran')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('sts_batal', 0)
            ->where('id_tr_jual', Input::get('paramId'))
            ->first();
    }

    public static function cekPenjualanAktif($keyID) {
        return Penjualan::select(DB::raw("id_tr_jual,dt_tr_jual.id_kapling_proyek,nik,nm_konsumen,dt_konsumen.no_hp,dt_kapling_proyek.alamat as alamat_kapling,nm_tipe,nm_proyek,date_format(tgl_jual, '%d-%m-%Y') as tgl_jual,format((harga_sepakat+((luas_tanah-luas_bangunan)*dt_tr_jual.harga_klt_per_meter)+biaya_penambahan),0) as total_biaya"))
            ->leftJoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftJoin('dt_marketing', 'dt_marketing.id_marketing', 'dt_tr_jual.id_marketing')
            ->leftJoin('dt_cara_pembayaran', 'dt_cara_pembayaran.id_cara_pembayaran', 'dt_tr_jual.id_cara_pembayaran')
            ->leftJoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftJoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftJoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->where('sts_batal', 0)
            ->where('id_tr_jual', $keyID)
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

    public static function cekRiwayatKapling($getIdKapling) {
        return Penjualan::where('id_kapling_proyek', $getIdKapling)
            ->count();
    }

    public static function get_laporan_penjualan($req) {

        $where = '';
        $where .= empty($req->p) ? '' : " and dt_proyek.id_proyek='". $req->p ."'";
        $where .= empty($req->t) ? '' : " and dt_tipe_proyek.id_tipe_proyek='". $req->t ."'";
        $where .= empty($req->s) ? '' : " and tgl_jual>='". Fungsi::formatdatetosql($req->s) ."'";
        $where .= empty($req->e) ? '' : " and tgl_jual<='". Fungsi::formatdatetosql($req->e) ."'";
        $where .= empty($req->c) ? '' : " and dt_cara_pembayaran.id_cara_pembayaran='". $req->c ."'";
        $where .= empty($req->m) ? '' : " and dt_marketing.id_marketing='". $req->m ."'";

        return Penjualan::selectRaw("DATE_FORMAT(tgl_jual,'%d-%m-%Y') as tgl_jual,nm_konsumen,no_hp,DATE_FORMAT(tgl_wawancara,'%d-%m-%Y') as tgl_wawancara,DATE_FORMAT(tgl_sp3k,'%d-%m-%Y') as tgl_sp3k,DATE_FORMAT(tgl_akad,'%d-%m-%Y') as tgl_akad
            ,dt_kapling_proyek.alamat
            ,nm_tipe
            ,nm_proyek
            ,(harga_sepakat+(dt_tr_jual.harga_klt_per_meter*(luas_tanah-luas_bangunan))+biaya_penambahan+dt_tr_jual.biaya_lain) as total
            ,cara_pembayaran
            ,nm_marketing")
            ->leftjoin('dt_konsumen', 'dt_konsumen.id_konsumen', 'dt_tr_jual.id_konsumen')
            ->leftjoin('dt_kapling_proyek', 'dt_kapling_proyek.id_kapling_proyek', 'dt_tr_jual.id_kapling_proyek')
            ->leftjoin('dt_tipe_proyek', 'dt_tipe_proyek.id_tipe_proyek', 'dt_kapling_proyek.id_tipe_proyek')
            ->leftjoin('dt_proyek', 'dt_proyek.id_proyek', 'dt_tipe_proyek.id_proyek')
            ->leftjoin('dt_cara_pembayaran', 'dt_cara_pembayaran.id_cara_pembayaran', 'dt_tr_jual.id_cara_pembayaran')
            ->leftjoin('dt_marketing', 'dt_marketing.id_marketing', 'dt_tr_jual.id_marketing')
            ->whereRaw("sts_batal=0". $where)
            ->get();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Excel;

class SliderController extends Controller
{
    public function index()
    {
        return view('master.setting_slider')->with(array(
            'title' => 'DATA PROYEK',
            'icon' => 'fa fa-picture-o'
        ));
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Slider::tambah();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Slider::Edit();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'valid':
                $result = Slider::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Slider::Remove();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
        endswitch;

        $json['Status'] = $status;
        $json['Msg'] = $msg;

        return response()->json($json, 200);
    }

    public static function datatable(Request $rq){
        $json = array();
        
        $rows = Slider::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Slider::getCountForPaging();
        return response()->json($json);
    }

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Slider::findById($rq->paramId);
        if( count($check) == 1 ){
            $status = 1;
            $row = $check;
        } else {
            $msg = 'Maaf data tidak diketemukan';
        }

        $json['Status'] = $status;
        $json['Msg'] = $msg;
        $json['Row'] = $row;

        echo json_encode($json);
    }

    public function jsonGetKotaByProv(Request $req) {
        return response()->json(Kota::jsonGetKotaByProv($req->paramId), 200);
    }

    public function jsonGetKecamatanByKota(Request $req) {
        return response()->json(Kecamatan::jsonGetByKota($req->paramId), 200);
    }

    public function jsonGetKelurahanByKecamatan(Request $req) {
        return response()->json(Kelurahan::jsonGetByKecamatan($req->paramId), 200);
    }

    public function page_laporan() {
        return view('master.laporan_resume_proyek')->with(array(
            'title' => 'LAPORAN RESUME PROYEK',
            'icon' => 'fa fa-report'
        ));
    }

    public static function show_laporan(Request $req) {
        $get_data = Slider::arr_resume_by_id($req->p);

        switch($req->jenis){
            case 'preview':
                return self::get_preview($get_data);
                break;
            case 'pdf':
                return self::get_pdf($get_data);
                break;
            case 'excel':
                return self::get_excel($get_data);
                break;
            default :
                break;
        }
    }

    private static function get_excel($load_data) {

        $get_detil = $load_data['get_proyek'];
        return Excel::create('Laporan Resume Proyek '. $get_detil->nm_proyek, function($excel) use ($load_data) {

            $get_detil = $load_data['get_proyek'];
            $get_tipe = $load_data['arr_tipe'];
            $get_kapling = $load_data['arr_kapling'];

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Laporan Resume Proyek'. $get_detil->nm_proyek);
            $excel->setCreator('Laravel')->setCompany('Rumah Subsidi Ceria');
            $excel->setDescription('Laporan Resume Proyek Rumah Subsidi Ceria');

            foreach( $get_tipe as $r ) {
                $excel->sheet(str_replace('/','-',$r->nm_tipe), function($sheet) use ($get_detil, $r, $get_kapling) {
                    $sheet->loadView('excel.laporan_resume_proyek',['get_detil'=>$get_detil, 't'=>$r, 'k'=> $get_kapling]);
                    $sheet->setWidth(array(
                        'A'     =>  10,
                        'B'     =>  60,
                        'C'     =>  20,
                        'D'     =>  20,
                        'E'     =>  20
                    ));

                    $sheet->getStyle('A1:E100')->getAlignment()->setWrapText(true);
                    $sheet->cells('A1:E7', function($cells) {
                        $cells->setValignment('top');
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '12',
                            'bold'       =>  true
                        ));
                    });
                    $sheet->mergeCells('B1:E1');
                    $sheet->mergeCells('B2:E2');
                    $sheet->mergeCells('B3:E3');
                    $sheet->mergeCells('B4:E4');
                    $sheet->mergeCells('B5:E5');
                    $sheet->mergeCells('B6:E6');
                    $sheet->mergeCells('B7:E7');

                    $row = 9;
                    // Set border for range
                    $sheet->setBorder('A'. $row .':E'. $row, 'thin');
                    $row_start = $row + 1;
                    if ( isset($get_kapling[$r->id_tipe_proyek]) ) {
                        $row_last = $row + 6 + count($get_kapling[$r->id_tipe_proyek]);
                    } else {
                        $row_last = $row + 6;
                    }
                    
                    $sheet->setBorder('A'. $row_start .':E'. $row_last, 'thin');
                    $sheet->cells('A9:E'. $row_last, function($cells) {
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '12'
                        ));
                    });
                    //$sheet->setAutoSize(true);
            
                });
            }

            
        })->download('xlsx');
    }

    private static function get_preview($load_data) {
        $get_detil = $load_data['get_proyek'];
        $get_tipe = $load_data['arr_tipe'];
        $get_kapling = $load_data['arr_kapling'];

        $no = 1;
        $html = '<html><head><style>body{ font-family:Arial, Helvetica, "sans-serif"; } #table tbody tr td, #table thead tr th{ border:1px solid #000; font-size:12px; }</style></head><body>';

        $html .= '<table width="100%" cellspacing=5>';
        $html .= '<tr>';
        $html .= '<td width="10%">Proyek</td><td width="3%" align="center"> : </td><td width="87%" colspan="5">'. $get_detil->nm_proyek .'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td valign="top">Alamat</td><td align="center" valign="top"> : </td><td colspan="5">'. $get_detil->alamat .'<br>'. $get_detil->nm_provinsi .' '. $get_detil->nm_kecamatan .' Kec. '. $get_detil->nm_kota .' Kel. '. $get_detil->nm_kelurahan .'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td valign="top">Periode</td><td align="center" valign="top" width="3%" align="center"> : </td><td width="30%">'. Fungsi::format_sql_to_indo($get_detil->periode_mulai) .' s.d '. Fungsi::format_sql_to_indo($get_detil->periode_selesai) .'</td>';
        $html .= '<td valign="top" width="10%">Luas Proyek</td><td align="center" valign="top" width="3%" align="center"> : </td><td width="10%">'. number_format($get_detil->luas_proyek) .' HA</td>';
        $html .= '<td valign="top" width="10%">Jumlah Unit</td><td align="center" valign="top" width="3%" align="center"> : </td><td width="10%">'. number_format(count($load_data['arr_kapling'])) .' Unit</td>';
        $html .= '</tr>';
        $html .= '</table>';

        foreach( $get_tipe as $r ) {
            $sts_bf = 0;
            $sts_wawancara = 0;
            $sts_sp3k = 0;
            $sts_akad = 0;
            $sts_terjual = 0;

            $html .= '<h4>'. $r->nm_tipe .'</h4>';
            $html .= '<table width="100%" border=1 cellpadding=5>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>No.</th>';
            $html .= '<th>Alamat Kapling</th>';
            $html .= '<th>Status Terjual</th>';
            $html .= '<th>Tgl Terjual</th>';
            $html .= '<th>Proses Terakhir</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            if (isset($get_kapling[$r->id_tipe_proyek])) {
                $no = 1;
                foreach( $get_kapling[$r->id_tipe_proyek] as $k ) {
                    $html .= '<tr>';
                    $html .= '<td align="right" width="5%">'. $no .' .</td>';
                    $html .= '<td>'. $k->alamat .'</td>';
                    $html .= '<td align="center" width="10%">'. $k->sts_terjual .'</td>';
                    $html .= '<td align="center" width="10%">'. $k->tgl_terjual .'</td>';
                    $html .= '<td align="center" width="10%">'. $k->sts_proses .'</td>';
                    $html .= '</tr>';
                    $no++;

                    if ( $k->sts_terjual == 'Terjual' ) {
                        $sts_terjual++;
                    }

                    switch( $k->sts_proses ):
                        case 'Booking Fee':
                            $sts_bf++;
                        break;
                        case 'Wawancara':
                            $sts_wawancara++;
                        break;
                        case 'SP3K':
                            $sts_sp3k++;
                        break;
                        case 'Akad':
                            $sts_akad++;
                        break;
                    endswitch;
                }

                $html .= '</tbody>
                    <tfoot>
                    <tr>
                    <td colspan="2" align="right"><b>TOTAL UNIT</b></td><td align="right" colspan="3"><b>'. number_format(count(collect($get_kapling[$r->id_tipe_proyek]))) .'</b></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="right"><b>BELUM TERJUAL</b></td><td align="right" colspan="3"><b>'. number_format((count(collect($get_kapling[$r->id_tipe_proyek]))-$sts_terjual)) .'</b></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="right"><b>BOOKING FEE</b></td><td align="right" colspan="3"><b>'. number_format($sts_bf) .'</b></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="right"><b>WAWANCARA</b></td><td align="right" colspan="3"><b>'. number_format($sts_wawancara) .'</b></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="right"><b>SP3K</b></td><td align="right" colspan="3"><b>'. number_format($sts_sp3k) .'</b></td>
                    </tr>
                    <tr>
                    <td colspan="2" align="right"><b>AKAD</b></td><td align="right" colspan="3"><b>'. number_format($sts_akad) .'</b></td>
                    </tr>
                    </tfoot>';
            } else {
                $html .= '<tr>';
                $html .= '<td align="center" colspan="5">Tidak ada data</td>';
                $html .= '</tr>';
                $html .= '</tbody>';
            }
            $html .= '</table>';
        }

        $html .= '</body></html>';

        return $html;
    }
        
    
}

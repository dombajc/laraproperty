<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Kapling;
use App\Pembatalan;
use App\Fungsi;
use App\Proyek;
use App\Tipeproyek;

use PDF;
use Excel;

class PembatalanController extends Controller
{
    public function index()
    {
        return view('penjualan.entrypembatalan')->with(array(
            'title' => 'ENTRY PEMBATALAN',
            'icon' => 'fa fa-cart-plus'
        ));
    }

    public function page()
    {
        return view('penjualan.datapembatalan')->with(array(
            'title' => 'DATA RIWAYAT PEMBATALAN',
            'icon' => 'fa fa-cart'
        ));
    }

    public static function getPenjualan(Request $rq){
        $json = array();
        
        $rows = Pembatalan::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Pembatalan::getCountForPaging();
        return response()->json($json);
    }

    public static function checkPenjualan(Request $req) {
    	$sts = 0;
    	$msg = '';
    	$row = array();

    	$q = Penjualan::cekPenjualanAktif($req->paramId);
    	if ( count($q) == 1 ) {
    		$sts = 1;
    		$row = $q;
    	} else {
    		$msg = 'Maaf Penjualan tidak tersedia !';
    	}

    	return response()->json(['Status' => $sts, 'Msg' => $msg, 'Row' => $row], 200);
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Pembatalan::tambah();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Pembatalan::Edit();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Pembatalan::Remove();
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

    public static function viewById(Request $rq){
        $json = array();
        $status = 0;
        $msg = '';
        $row = '';

        $check = Pembatalan::findById($rq->paramId);
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

    public function page_laporan() {
        return view('penjualan.laporan_batal')->with(array(
            'title' => 'LAPORAN PEMBATALAN',
            'icon' => 'fa fa-report'
        ));
    }

    public static function show_laporan(Request $req) {
        $load_data = Pembatalan::get_laporan_pembatalan($req);
        $header = '';
        $header .= empty($req->p) ? '' : Proyek::getById($req->p)->nm_proyek;
        $header .= empty($req->t) ? '' : ' Tipe : '. Tipeproyek::cek_by_tipe($req->t)->nm_tipe .'<br>';
        $header .= empty($req->s) ? '' : Fungsi::format_tgl_indo($req->s);
        $header .= empty($req->e) ? '' : ' s.d '. Fungsi::format_tgl_indo($req->e);
        switch($req->jenis){
            case 'preview':
                return self::get_preview($load_data, $header);
                break;
            case 'pdf':
                return self::get_pdf($load_data, $header);
                break;
            case 'excel':
                return self::get_excel($load_data, $header);
                break;
            default :
                break;
        }
    }

    private static function get_excel($load_data, $header) {
        return Excel::create('Laporan Pembatalan', function($excel) use ($load_data, $header) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Laporan Pembatalan');
            $excel->setCreator('Laravel')->setCompany('Rumah Subsidi Ceria');
            $excel->setDescription('Laporan Pembatalan Rumah Subsidi Ceria');

            $excel->sheet('Laporan Penjualan', function($sheet) use ($load_data, $header) {
                $sheet->loadView('excel.laporan_pembatalan',['header'=>$header, 'load_data'=>$load_data]);
                $sheet->mergeCells('A1:J1');

                $jml_header = explode('<br>', $header);
                $row = 3;
                if ( count($jml_header) >0 ) {
                    foreach($jml_header as $r ) {
                        $sheet->mergeCells('A'. $row .':J'. $row);
                        $row++;
                    }

                    $sheet->cells('A3:A'. $row, function($cells) {
                        $cells->setAlignment('center');
                        $cells->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '12',
                            'bold'       =>  true
                        ));
                    });
                }

                $sheet->cell('A1', function($cell) {
                    $cell->setAlignment('center');
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });

                // Set border for range
                $row++;
                $sheet->setBorder('A'. $row .':J'. $row, 'thin');
                $row_start = $row + 1;
                $row_last = $row + count($load_data);
                
                $sheet->cells('A'. $row_start .':J'. $row_last, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12'
                    ));
                });
                $sheet->setAutoSize(true);
        
            });
        })->download('xlsx');
    }

    private static function get_preview($load_data, $header) {
        $no = 1;
        $html = '<html><head><style>body{ font-family:Arial, Helvetica, "sans-serif"; } table tbody tr td, table thead tr th{ border:1px solid #000; font-size:12px; }</style></head><body>';
        $html .= '<h3 align="center">LAPORAN TRANSAKSI BATAL RUMAHSUBSIDICERIA<br><small>'. strtoupper($header) .'</small></h3>';
        $html .= '<table width="100%" border=1 cellpadding=5>';
        $html .= '<thead><tr><th align="center">No.</th><th align="center" width="50px">TGL BATAL</th><th>ALASAN</th><th align="center">Nama Konsumen</th><th align="center">No. HP</th><th align="center" width="50px">TGL JUAL</th><th align="center">Alamat Kapling</th><th align="center">Tipe</th><th align="center">Proyek</th><th align="center">MARKETING</th></tr></thead><tbody>';
        foreach( $load_data as $r ) {
            $html .= '<tr>
            <td align="right">'. $no .'</td>
            <td align="center" width="50px">'. $r->tgl_batal .'</td>
            <td>'. $r->alasan .'</td>
            <td>'. $r->nm_konsumen .'</td>
            <td align="center">'. $r->no_hp .'</td>
            <td align="center" width="50px">'. $r->tgl_jual .'</td>
            <td>'. $r->alamat .'</td>
            <td align="center">'. $r->nm_tipe .'</td>
            <td align="center">'. $r->nm_proyek .'</td>
            <td align="center">'. $r->nm_marketing .'</td>
            </tr>';
            $no++;
        }
        $html .= '</tbody></table></body></html>';
        return $html;
    }

    private static function get_pdf($load_data, $header) {
        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

        // set array for viewer preferences
        $preferences = array(
            'HideToolbar' => true,
            'HideMenubar' => true,
            'HideWindowUI' => true,
            'FitWindow' => true,
            'CenterWindow' => true,
            'DisplayDocTitle' => true,
            'NonFullScreenPageMode' => 'UseNone', // UseNone, UseOutlines, UseThumbs, UseOC
            'ViewArea' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'ViewClip' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'PrintArea' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'PrintClip' => 'CropBox', // CropBox, BleedBox, TrimBox, ArtBox
            'PrintScaling' => 'AppDefault', // None, AppDefault
            'Duplex' => 'DuplexFlipLongEdge', // Simplex, DuplexFlipShortEdge, DuplexFlipLongEdge
            'PickTrayByPDFSize' => true,
            'PrintPageRange' => array(1,1,2,3),
            'NumCopies' => 2
        );

        // set pdf viewer preferences
        PDF::setViewerPreferences($preferences);

        PDF::setHeaderCallback(function($pdf){
            $pdf->SetY(5);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(0, 15, 'dicetak pada '. Fungsi::format_sql_to_indo(date('Y-m-d')), 0, false, 'L', 0, '', 0, false, 'M', 'M');
        });

        // set font
        PDF::SetFont('helvetica', '', 9);

        PDF::SetTitle('LAPORAN BATAL');
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::AddPage('L', 'F4');

        $no = 1;
        $html = '<html><head></head><body>';
        $html .= '<h3 align="center">LAPORAN TRANSAKSI BATAL RUMAHSUBSIDICERIA<br>'. $header .'</h3>';
        $html .= '<table id="table" width="100%" border="1" cellpadding="5">';
        $html .= '<thead><tr><th align="center" width="5%"><b>No.</b></th><th align="center" width="8%"><b>TGL BATAL</b></th><th width="20%"><b>ALASAN</b></th><th align="center"><b>Nama Konsumen</b></th><th align="center"><b>No. HP</b></th><th align="center" width="8%"><b>TGL JUAL</b></th><th align="center"><b>Alamat Kapling</b></th><th align="center" width="8%"><b>Tipe</b></th><th align="center"><b>Proyek</b></th><th align="center"><b>MARKETING</b></th></tr></thead><tbody>';
        foreach( $load_data as $r ) {
            $html .= '<tr>
            <td align="right" width="5%">'. $no .'</td>
            <td align="center" width="8%">'. $r->tgl_batal .'</td>
            <td width="20%">'. $r->alasan .'</td>
            <td>'. $r->nm_konsumen .'</td>
            <td align="center">'. $r->no_hp .'</td>
            <td align="center"  width="8%">'. $r->tgl_jual .'</td>
            <td>'. $r->alamat .'</td>
            <td align="center" width="8%">'. $r->nm_tipe .'</td>
            <td align="center">'. $r->nm_proyek .'</td>
            <td align="center">'. $r->nm_marketing .'</td>
            </tr>';
            $no++;
        }
        $html .= '</tbody></table></body></html>';

        

        PDF::setFooterCallback(function($pdf){
            $pdf->SetY(-5);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(0, 15, 'Halaman '. $pdf->getAliasNumPage() .' dari '. $pdf->getAliasNbPages() , 0, false, 'C', 0, '', 0, false, 'M', 'M');
        });

        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('LAPORAN BATAL.pdf','I');

    }
}

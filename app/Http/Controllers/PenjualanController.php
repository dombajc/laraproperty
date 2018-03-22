<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Kapling;
use App\Proyek;
use App\Tipeproyek;
use App\Carapembayaran;
use App\Fungsi;
use App\Marketing;
use PDF;
use Excel;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.entrypenjualan')->with(array(
            'title' => 'ENTRY PENJUALAN',
            'icon' => 'fa fa-cart-plus'
        ));
    }

    public function page()
    {
        return view('penjualan.datapenjualan')->with(array(
            'title' => 'DATA PENJUALAN',
            'icon' => 'fa fa-cart'
        ));
    }

    public static function getKaplingYgTersedia(Request $rq){
        $json = array();
        
        $rows = Kapling::arrKaplingTersedia();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Kapling::arrKaplingTersediaPaging();
        return response()->json($json);
    }

    public static function getPenjualan(Request $rq){
        $json = array();
        
        $rows = Penjualan::arrTabelwithPaging();

        $json['draw'] = $rq->draw;
        $json['data'] = $rows;
        $json['recordsTotal'] = count($rows);
        $json['recordsFiltered'] = Penjualan::getCountForPaging();
        return response()->json($json);
    }

    public static function checkKapling() {
    	$sts = 0;
    	$msg = '';
    	$row = array();

    	$q = Kapling::checkKaplingBelumTerjual();
    	if ( count($q) == 1 ) {
    		$sts = 1;
    		$row = $q;
    	} else {
    		$msg = 'Maaf Kapling tidak tersedia !';
    	}

    	return response()->json(['Status' => $sts, 'Msg' => $msg, 'Row' => $row], 200);
    }

    public static function act(Request $rq){

        $json = array();
        $status = 0;
        $msg = '';

        switch( $rq->haksi ):
            case 'add':
                $result = Penjualan::tambah();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }

            break;
            case 'edit':
                $result = Penjualan::Edit();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'valid':
                $result = Penjualan::Valid();
                if ( empty($result) ){
                    $status = 1;
                } else {
                    $msg = $result;
                }
            break;
            case 'delete':
                $result = Penjualan::Remove();
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

        $check = Penjualan::findById($rq->paramId);
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
        return view('penjualan.laporan')->with(array(
            'title' => 'LAPORAN TRANSAKSI PENJUALAN',
            'icon' => 'fa fa-report'
        ));
    }

    public static function show_laporan(Request $req) {
        $load_data = Penjualan::get_laporan_penjualan($req);
        $header = '';
        $header .= empty($req->p) ? '' : Proyek::getById($req->p)->nm_proyek;
        $header .= empty($req->t) ? '' : ' Tipe : '. Tipeproyek::cek_by_tipe($req->t)->nm_tipe .'<br>';
        $header .= empty($req->s) ? '' : Fungsi::format_tgl_indo($req->s);
        $header .= empty($req->e) ? '' : ' s.d '. Fungsi::format_tgl_indo($req->e);
        $header .= empty($req->c) ? '' : '<br>Pembayaran '. Carapembayaran::getById($req->c)->cara_pembayaran;
        $header .= empty($req->m) ? '' : '<br>'. Marketing::getById($req->m)->nm_marketing;
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
        return Excel::create('Laporan Penjualan', function($excel) use ($load_data, $header) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Laporan Penjualan');
            $excel->setCreator('Laravel')->setCompany('Rumah Subsidi Ceria');
            $excel->setDescription('Laporan Penjualan Rumah Subsidi Ceria');

            $excel->sheet('Laporan Penjualan', function($sheet) use ($load_data, $header) {
                $sheet->loadView('excel.laporan_penjualan',['header'=>$header, 'load_data'=>$load_data]);
                $sheet->mergeCells('A1:M1');

                $jml_header = explode('<br>', $header);
                $row = 3;
                if ( count($jml_header) >0 ) {
                    foreach($jml_header as $r ) {
                        $sheet->mergeCells('A'. $row .':M'. $row);
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
                $sheet->setBorder('A'. $row .':M'. $row, 'thin');
                $row_start = $row + 1;
                $row_last = $row + count($load_data);
                
                $sheet->cells('A'. $row_start .':M'. $row_last, function($cells) {
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
        $html .= '<h3 align="center">LAPORAN TRANSAKSI PENJUALAN RUMAHSUBSIDICERIA<br><small>'. strtoupper($header) .'</small></h3>';
        $html .= '<table width="100%" border=1 cellpadding=5>';
        $html .= '<thead><tr><th align="center">No.</th><th align="center" width="50px">Tgl Jual</th><th align="center">Nama Konsumen</th><th align="center">No. HP</th><th align="center">Alamat Kapling</th><th align="center">Tipe</th><th align="center">Proyek</th><th align="center" width="50px">TOTAL PEMBAYARAN</th><th align="center" width="50px">CARA PEMBAYARAN</th><th align="center" width="50px">WCR</th><th align="center" width="50px">SP3K</th><th align="center" width="50px">AKAD</th><th align="center">MARKETING</th></tr></thead><tbody>';
        foreach( $load_data as $r ) {
            $html .= '<tr>
            <td align="right">'. $no .'</td>
            <td align="center" width="50px">'. $r->tgl_jual .'</td>
            <td>'. $r->nm_konsumen .'</td>
            <td align="center">'. $r->no_hp .'</td>
            <td>'. $r->alamat .'</td>
            <td align="center">'. $r->nm_tipe .'</td>
            <td align="center">'. $r->nm_proyek .'</td>
            <td align="right">'. number_format($r->total,0) .'</td>
            <td align="center" width="50px">'. $r->cara_pembayaran .'</td>
            <td align="center" width="50px">'. $r->tgl_wawancara .'</td>
            <td align="center" width="50px">'. $r->tgl_sp3k .'</td>
            <td align="center" width="50px">'. $r->tgl_akad .'</td>
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

        PDF::SetTitle('LAPORAN PENJUALAN');
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::AddPage('L', 'F4');

        $no = 1;
        $html = '<html><head></head><body>';
        $html .= '<h3 align="center">LAPORAN TRANSAKSI PENJUALAN RUMAHSUBSIDICERIA<br>'. $header .'</h3>';
        $html .= '<table id="table" width="100%" border="1" cellpadding="5">';
        $html .= '<thead><tr><th align="center" width="5%"><b>No.</b></th><th align="center" width="8%"><b>Tgl Jual</b></th><th align="center"><b>Nama Konsumen</b></th><th align="center"><b>No. HP</b></th><th align="center"><b>Alamat Kapling</b></th><th align="center"><b>Tipe</b></th><th align="center"><b>Proyek</b></th><th align="center" width="8%"><b>TOTAL PEMBAYARAN</b></th><th align="center" width="8%"><b>CARA PEMBAYARAN</b></th><th align="center" width="8%"><b>WCR</b></th><th align="center" width="8%"><b>SP3K</b></th><th align="center" width="8%"><b>AKAD</b></th><th align="center"><b>MARKETING</b></th></tr></thead><tbody>';
        foreach( $load_data as $r ) {
            $html .= '<tr>
            <td align="right" width="5%">'. $no .'</td>
            <td align="center" width="8%">'. $r->tgl_jual .'</td>
            <td>'. $r->nm_konsumen .'</td>
            <td align="center">'. $r->no_hp .'</td>
            <td>'. $r->alamat .'</td>
            <td align="center">'. $r->nm_tipe .'</td>
            <td align="center">'. $r->nm_proyek .'</td>
            <td align="right" width="8%">'. number_format($r->total,0) .'</td>
            <td align="center" width="8%">'. $r->cara_pembayaran .'</td>
            <td align="center" width="8%">'. $r->tgl_wawancara .'</td>
            <td align="center" width="8%">'. $r->tgl_sp3k .'</td>
            <td align="center" width="8%">'. $r->tgl_akad .'</td>
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
        PDF::Output('LAPORAN PENJUALAN.pdf','I');

    }
}

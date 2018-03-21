<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Tipeproyek;
use App\Kapling;

class OnlinedaftarproyekController extends Controller
{
    protected $proyek;
    protected $listing;

    public function __construct(Proyek $proyek, Kapling $listing)
    {
        $this->proyek = $proyek;
        $this->listing = $listing;
    }
    
    public function index(Request $request)
    {
        $proyek = Proyek::get_array_paging();

        if ($request->ajax()) {
            return view('online.loadpagingproyek', ['proyeks' => $proyek])->render();  
        }
        
        return view('online.listproyek', ['proyeks'=>$proyek])->with([
            'title' => 'Daftar Proyek Perumahan Subsidi'
        ]);
    }

    public static function detil(Request $req) {
        $cek = Proyek::getById($req->id);
        if ( count($cek) == 1 ) {
            return view('online.detilproyek')->with([
                'title' => $cek->nm_proyek,
                'row' => $cek,
                'tipes' => Tipeproyek::get_arr_by_proyek($req->id),
                'total_unit_per_tipe' => Tipeproyek::arr_count_unit_per_tipe_from_proyek($req->id)
            ]);
        } else {
            return redirect('not_found');
        }
    }

    public function listingkaplingpertipe(Request $request) {
        $cek = Tipeproyek::cek_by_tipe($request->id);
        if ( count($cek) == 1 ) {
            $kapling = Kapling::get_array_paging_by_tipe($request);

            if ($request->ajax()) {
                return view('online.loadpagingkapling', ['listing' => $kapling])->render();  
            }

            $kapling->appends($request->all());
            
            return view('online.listkapling', ['listing'=>$kapling])->with([
                'title' => 'Daftar Kapling / Rumah<br>'. $cek->nm_proyek .'<br>TIPE : '. $cek->nm_tipe,
                'row' => $cek,
                'req' => $request,
                'url_back' => url('product_detil/'. $cek->id_proyek)
            ]);
        } else {
            return redirect('not_found');
        }
        
    }
}

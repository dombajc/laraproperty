<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipeproyek;

class OnlinelistpropertiController extends Controller
{
    public function index(Request $request)
    {
        $proyek = Tipeproyek::get_array_paging();

        if ($request->ajax()) {
            return view('online4.load_paging_properti', ['tipes' => $proyek])->render();  
        }
        
        return view('online4.listing_properties', ['tipes'=>$proyek])->with([
            'title' => 'Daftar Proyek Perumahan Subsidi'
        ]);
    }
}

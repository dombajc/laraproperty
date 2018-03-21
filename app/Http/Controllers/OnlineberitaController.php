<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class OnlineberitaController extends Controller
{
    protected $news;
    protected $listing;

    public function __construct(Posts $news)
    {
        $this->news = $news;
    }
    
    public function index(Request $request)
    {
        $news = Posts::get_array_paging($request);

        if ($request->ajax()) {
            return view('online.loadpagingnews', ['news' => $news])->render();  
        }
        
        return view('online.listnews', ['news'=>$news])->with([
            'title' => 'Berita / Kegiatan',
            'req' => $request
        ]);
    }

    public static function detil(Request $req) {
        $cek = Posts::getById($req->id);
        if ( count($cek) == 1 ) {
            return view('online.detilberita')->with([
                'title' => 'BERITA / KEGIATAN',
                'row' => $cek
            ]);
        } else {
            return redirect('not_found');
        }
    }
}

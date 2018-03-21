<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Fungsi;
use Session;

class Posts extends Model
{
    protected $table = 'dt_posted';

    public static function arrTabelwithPaging()
    {
        $start = Input::get('start');
        $length = Input::get('length');
        $where = "1=1";
        $result = Posts::select(DB::raw("id_berita,judul,content,kategori_berita,dt_posted.sts_aktif,DATE_FORMAT(dt_posted.create_on, '%d-%m-%Y %H:%i:%s') as posted_on"))
            ->leftJoin('dt_kategori_berita', 'dt_kategori_berita.id_kategori_berita', 'dt_posted.id_kategori_berita')
            ->whereRaw($where)
            ->offset($start)
            ->limit($length)
            ->orderBy('id_berita', 'desc')
            ->get();

        return $result->toArray();
    }

    public static function getCountForPaging()
    {
        $where = "1=1";
        $result = Posts::select('id_berita')
            ->whereRaw($where)
            ->count();
        return $result;
    }

    public static function tambah($req) {
        $new_image = '';
        $uri_image = '';
        if ( $req->hasFile('filegambar')){
            $file = $req->file('filegambar');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $destination = base_path() . '/public/unggahfiles/posted';
            $new_image = time() . $jpg;
            //$type = pathinfo($new_image, PATHINFO_EXTENSION);
            $file->move($destination, $new_image);
            //$data = file_get_contents(url('unggahfiles/posted/'. $new_image));
            //$uri_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            
        }

        DB::beginTransaction();
        try {
            Posts::insert(array(
                'id_berita' => time(),
                'judul' => Fungsi::cleanXSS(Input::get('txtnama')),
                'id_kategori_berita' => Fungsi::cleanXSS(Input::get('slctkategori')),
                'content' => Input::get('txtisi'),
                'foto' => $new_image,
                //'uri_foto' => $uri_image,
                'create_on' => date('Y-m-d H:i:s'),
                'create_by' => Session::get('idu')
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
    }

    public static function Edit ($req)
    {
        $arrpostimage = array();
        if ( $req->hasFile('filegambar')){
            $file = $req->file('filegambar');
            $jpg = $file->getClientOriginalName();
            $size = $file->getSize();
            $destination = base_path() . '/public/unggahfiles/posted';
            $new_image = time() . $jpg;
            //$type = pathinfo($new_image, PATHINFO_EXTENSION);
            $file->move($destination, $new_image);
            //$data = file_get_contents(url('unggahfiles/posted/'. $new_image));
            //$uri_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $arrpostimage = array(
                'foto' => $new_image,
                //'uri_foto' => $uri_image
            );
        }
        
        DB::beginTransaction();
        try {
            Posts::where('id_berita', Fungsi::cleanXSS(Input::get('hid')))
                ->update(array_merge([
                    'judul' => Fungsi::cleanXSS(Input::get('txtnama')),
                    'id_kategori_berita' => Fungsi::cleanXSS(Input::get('slctkategori')),
                    'content' => Input::get('txtisi'),
                ], $arrpostimage));
            
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

    public static function Valid ()
    {
        DB::beginTransaction();
        try {
            DB::table('dt_posted')
                ->where('id_berita', Fungsi::cleanXSS(Input::get('hid')))
                ->update([
                'sts_aktif' => Input::get('sts')
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
            DB::table('dt_posted')
                ->where('id_berita', Fungsi::cleanXSS(Input::get('hid')))
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
    }

    public static function findById($ID)
    {
        return Posts::select(DB::raw("id_berita,judul,content,dt_posted.id_kategori_berita,foto"))
            ->leftJoin('dt_kategori_berita', 'dt_kategori_berita.id_kategori_berita', 'dt_posted.id_kategori_berita')
            ->where('id_berita', $ID)
            ->first();
    }

    public static function hapusgambartajuk() {
        $cek = self::findById(Input::get('hid'));
        if ( count($cek) == 1 ) {
            DB::beginTransaction();
            try {
                Posts::where('id_berita', Input::get('hid'))
                    ->update([
                        'uri_foto' => '',
                        'foto' => ''
                    ]);
                
                DB::commit();
                File::delete('unggahfiles/posted/'. $cek->foto);
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
            return 'Maaf Posted tidak dapat di ketemukan !';
        }
    }

    public static function getOnlineHome() {
        return Posts::selectRaw("id_berita,judul,if(ifnull(foto,'')='', 'images/defaultfoto.jpg',concat('unggahfiles/posted/',foto)) as foto,day(create_on) as hari, MONTH(create_on) as bln,judul,kategori_berita,date_format(create_on, '%d-%m-%Y %H:%i:%s') as tgl")
            ->leftJoin('dt_kategori_berita','dt_kategori_berita.id_kategori_berita','dt_posted.id_kategori_berita')
            ->where('dt_posted.sts_aktif', 1)
            ->orderBy('id_berita', 'desc')
            ->get();
    }

    public static function get_array_paging($req, $kat) {
        $where = "dt_posted.sts_aktif=1 and dt_posted.id_kategori_berita='". $kat ."'";
        $where .= empty($req->key_word) ? "" : " and judul like '%". $req->key_word ."%'";
        $where .= $req->key_category == "" ? "" : " and dt_posted.id_kategori_berita='". $req->key_category ."'";

        return Posts::selectRaw("id_berita,judul,if(ifnull(foto,'')='', 'images/defaultfoto.jpg',concat('unggahfiles/posted/',foto)) as foto,day(create_on) as hari, MONTH(create_on) as bln, YEAR(create_on) as thn,judul,kategori_berita,date_format(create_on, '%d-%m-%Y %H:%i:%s') as tgl,create_on")
            ->leftJoin('dt_kategori_berita','dt_kategori_berita.id_kategori_berita','dt_posted.id_kategori_berita')
            ->whereRaw($where)
            ->paginate(10);
    }

    public static function getById($ID)
    {
        return Posts::select(DB::raw("id_berita,judul,content,dt_posted.id_kategori_berita,if(ifnull(foto,'')='', 'images/defaultfoto.jpg',concat('unggahfiles/posted/',foto)) as foto,day(create_on) as hari, MONTH(create_on) as bln, YEAR(create_on) as thn,kategori_berita,create_on,nm_user"))
            ->leftJoin('dt_kategori_berita', 'dt_kategori_berita.id_kategori_berita', 'dt_posted.id_kategori_berita')
            ->leftJoin('dt_users', 'id_user', 'create_by')
            ->where('id_berita', $ID)
            ->where('dt_posted.sts_aktif', 1)
            ->first();
    }

    public static function show_random_except_id($id) {
        return Posts::selectRaw("id_berita,judul,if(ifnull(foto,'')='', 'images/defaultfoto.jpg',concat('unggahfiles/posted/',foto)) as foto,day(create_on) as hari, MONTH(create_on) as bln, YEAR(create_on) as thn,judul,kategori_berita,date_format(create_on, '%d-%m-%Y %H:%i:%s') as tgl")
            ->leftJoin('dt_kategori_berita','dt_kategori_berita.id_kategori_berita','dt_posted.id_kategori_berita')
            ->where('id_berita','!=',$id)
            ->where('dt_posted.sts_aktif', 1)
            ->inRandomOrder()
            ->limit(3)
            ->get()
            ->toJson();
    }

    private static function get_arr_aktif() {
        return Posts::selectRaw("judul,if(ifnull(foto,'')='', 'images/defaultfoto.jpg',concat('unggahfiles/posted/',foto)) as foto,create_on,id_berita,kategori_berita")
            ->leftJoin('dt_kategori_berita','dt_kategori_berita.id_kategori_berita','dt_posted.id_kategori_berita')
            ->where('dt_posted.sts_aktif', 1)
            ->orderBy('id_berita', 'desc')
            ->limit(3)
            ->get();
    }

    public static function preview_home_online() {
        $html = '';
        foreach( self::get_arr_aktif() as $row ) {
            $html .= '<div class="item col-md-4" data-animation-direction="from-bottom" data-animation-delay="250">
                <div class="image">
                    <a href="'. url('news/'. strtolower($row->kategori_berita) .'?n='. $row->id_berita ) .'">
                        <span class="btn btn-default"><i class="fa fa-file-o"></i> Read More</span>
                    </a>
                    <img src="'. url($row->foto) .'" alt="" />
                </div>
                <div class="tag"><i class="fa fa-file-text"></i></div>
                <div class="info-blog">
                    <ul class="top-info">
                        <li><i class="fa fa-calendar"></i> '. Fungsi::format_sql_to_indo($row->create_on) .'</li>
                        <li><i class="fa fa-tags"></i> Properties, Prices, best deals</li>
                    </ul>
                    <h3>
                        <a href="'. url('news/'. strtolower($row->kategori_berita) .'?n='. $row->id_berita ) .'">'. $row->judul .'</a>
                    </h3>
                </div>
            </div>';
        }
        echo $html;
    }

    public static function preview_sidebar_online() {
        $html = '';
        foreach( self::get_arr_aktif() as $row ) {
            $html .= '<li class="col-md-12">
                <div class="image">
                    <a href="'. url('news/'. strtolower($row->kategori_berita) .'?n='. $row->id_berita ) .'"></a>
                    <img src="'. url($row->foto) .'" alt="" />
                </div>
                <ul class="top-info">
                    <li><i class="fa fa-calendar"></i> '. Fungsi::format_sql_to_indo($row->create_on) .'</li>
                </ul>
                <h3><a href="'. url('news/'. strtolower($row->kategori_berita) .'?n='. $row->id_berita ) .'">'. $row->judul .'</a></h3>
            </li>';
        }
        echo $html;
    }

    public static function getByName($paramId) {
        return Posts::where('id_berita', $paramId);
    }
}

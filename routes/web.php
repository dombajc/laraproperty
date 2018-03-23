<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
//use Session;

Auth::routes();

Route::group(['middleware' => ['checkSess']], function () {
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('set_app', 'AppsController@index');
    Route::post('set_app/save', 'AppsController@act');

    Route::get('set_slider', 'SliderController@index');
    Route::post('set_slider/action', 'SliderController@act');
    Route::get('set_slider/rows', 'SliderController@datatable');
    Route::post('set_slider/view', 'SliderController@viewById');

    Route::get('set_user', 'UsersController@index');
    Route::get('set_user/rows', 'UsersController@datatable');
    Route::post('set_user/action', 'UsersController@act');
    Route::post('set_user/view', 'UsersController@viewById');

    Route::get('set_proyek', 'ProyekController@index');
    Route::get('set_proyek/findKotaByProv', 'ProyekController@jsonGetKotaByProv');
    Route::get('set_proyek/findKecamatanByKota', 'ProyekController@jsonGetKecamatanByKota');
    Route::get('set_proyek/findKelurahanByKecamatan', 'ProyekController@jsonGetKelurahanByKecamatan');
    Route::get('set_proyek/rows', 'ProyekController@datatable');
    Route::post('set_proyek/action', 'ProyekController@act');
    Route::post('set_proyek/view', 'ProyekController@viewById');

    Route::get('set_tipe_proyek', 'TipeproyekController@index');
    Route::get('set_tipe_proyek/rows', 'TipeproyekController@datatable');
    Route::post('set_tipe_proyek/action', 'TipeproyekController@act');
    Route::post('set_tipe_proyek/view', 'TipeproyekController@viewById');
    Route::get('set_tipe_proyek/pics', 'TipeproyekController@datagaleri');
    Route::post('set_tipe_proyek/actionupload', 'TipeproyekController@actupload');
    Route::post('set_tipe_proyek/viewupload', 'TipeproyekController@viewFotoById');

    Route::get('set_kapling', 'KaplingController@index');
    Route::get('set_kapling/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');
    Route::get('set_kapling/rows', 'KaplingController@datatable');
    Route::post('set_kapling/action', 'KaplingController@act');
    Route::post('set_kapling/view', 'KaplingController@viewById');
    Route::post('set_kapling/upload', 'KaplingController@unggah');
    Route::get('set_kapling/galeri', 'KaplingController@datagaleri');

    Route::get('set_marketing', 'MarketingController@index');
    Route::get('set_marketing/findTipeByProyek', 'MarketingController@jsonGetTipeByProyek');
    Route::get('set_marketing/rows', 'MarketingController@datatable');
    Route::post('set_marketing/action', 'MarketingController@act');
    Route::post('set_marketing/view', 'MarketingController@viewById');

    Route::get('entry_transaksi', 'PenjualanController@index');
    Route::get('entry_transaksi/rows', 'PenjualanController@getKaplingYgTersedia');
    Route::get('entry_transaksi/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');
    Route::post('entry_transaksi/view', 'PenjualanController@checkKapling');
    Route::post('entry_transaksi/action', 'PenjualanController@act');

    Route::get('data_transaksi', 'PenjualanController@page');
    Route::get('data_transaksi/rows', 'PenjualanController@getPenjualan');
    Route::get('data_transaksi/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');
    Route::post('data_transaksi/view', 'PenjualanController@viewById');
    Route::post('data_transaksi/action', 'PenjualanController@act');

    Route::get('entry_pembatalan', 'PembatalanController@index');
    Route::get('entry_pembatalan/rows', 'PenjualanController@getPenjualan');
    Route::get('entry_pembatalan/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');
    Route::post('entry_pembatalan/view', 'PembatalanController@checkPenjualan');
    Route::post('entry_pembatalan/action', 'PembatalanController@act');

    Route::get('data_pembatalan', 'PembatalanController@page');
    Route::get('data_pembatalan/rows', 'PembatalanController@getPenjualan');
    Route::get('data_pembatalan/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');
    Route::post('data_pembatalan/view', 'PembatalanController@viewById');
    Route::post('data_pembatalan/action', 'PembatalanController@act');

    Route::get('set_categories', 'KategoriController@index');
    Route::get('set_categories/rows', 'KategoriController@datatable');
    Route::post('set_categories/action', 'KategoriController@act');
    Route::post('set_categories/view', 'KategoriController@viewById');

    Route::get('post_news', 'PostsController@index');
    Route::get('post_news/rows', 'PostsController@datatable');
    Route::post('post_news/action', 'PostsController@act');
    Route::post('post_news/view', 'PostsController@viewById');
    Route::post('post_news/deleteFotoTajuk', 'PostsController@hapusfoto');

    Route::get('r_transaksi', 'PenjualanController@page_laporan');
    Route::get('r_transaksi/report', 'PenjualanController@show_laporan');
    Route::get('r_transaksi/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');

    Route::get('r_pembatalan', 'PembatalanController@page_laporan');
    Route::get('r_pembatalan/report', 'PembatalanController@show_laporan');
    Route::get('r_pembatalan/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');

    Route::get('r_resume_proyek', 'ProyekController@page_laporan');
    Route::get('r_resume_proyek/report', 'ProyekController@show_laporan');
    Route::get('r_resume_proyek/findTipeByProyek', 'KaplingController@jsonGetTipeByProyek');

    Route::get('profile', 'ProfileController@index');
    Route::post('profile/update_profile', 'ProfileController@perbaharui_profile');

    Route::get('change_password', 'ProfileController@page_change_password');
    Route::post('change_password/update_password', 'ProfileController@perbaharui_password');
    Route::get('change_password/success', function(){
        return redirect('log-out');
    });
    
});



Route::get('log-in', 'LoginController@index');
Route::post('log-in/checklogin', 'LoginController@validationLogin');
Route::get('log-out', function(){
    Session::flush();
    return redirect('log-in');
});

Route::get('/', 'OnlinehomeController@index');
Route::get('properties', 'OnlinelistpropertiController@index');
Route::get('properties/{proyek}', function($proyek){
    $cek = App\Proyek::cek_by_judul($proyek);
    if ( count($cek) == 1 ) {
        return view('online4.detail_property')->with([
            'P' => App\Proyek::getById($cek->id_proyek)
        ]);
    } else {
        return redirect('404');
    }
    
});


Route::get('news/{kategori}', function($kategori, Request $req) {
    $cek_kategori = App\Kategori::cek_by_name($kategori);
    if ( count($cek_kategori) == 1 ) {
        if ( empty($req->n) ) {
            //return view('online4.listing_news');
            $news = App\Posts::get_array_paging($req,$cek_kategori->id_kategori_berita);

            if ($req->ajax()) {
                return view('online4.load_paging_news', ['news' => $news])->render();  
            }
            
            return view('online4.listing_news', ['news'=>$news])->with([
                'req' => $req,
                'kategori' => $kategori
            ]);
        } else {
            $cek = App\Posts::getById($req->n);
            if ( count($cek) == 1) {
                return view('online4.detail_news')->with([
                    'R' => $cek,
                    'kategori' => $kategori
                ]);
            } else {
                return redirect('404');
            }
        }
    } else {
        return redirect('404');
    }
});
Route::get('contactus', function(){
    return view('online4.contactus')->with([
        'R' => App\Aplikasi::getApp()
    ]);
});

Route::get('404', function(){
    return view('online4.404');
});


Route::get('products', 'OnlinedaftarproyekController@index');
Route::get('product_detil/{id}', 'OnlinedaftarproyekController@detil')->where('id','[0-9]+');
Route::get('list_kapling/{id}', 'OnlinedaftarproyekController@listingkaplingpertipe')->where('id','[0-9]+');
Route::get('news', 'OnlineberitaController@index');
Route::get('news_detil/{id}', 'OnlineberitaController@detil')->where('id','[0-9]+');
Route::get('aboutus', 'OnlineaboutusController@index');

Route::get('not_found', function(){
    return view('online.404')->with([
        'title' => 'Halaman tidak di ketemukan !'
    ]);
});

Route::get('remote_resume_category', 'KategoriController@result_resume');
Route::get('remote_random_news', 'PostsController@result_random');

Route::get('proxy', function(){

    $validMimeTypes = array("image/gif", "image/jpeg", "image/png");
    
    if (!isset($_GET["url"]) || !trim($_GET["url"])) {
        header("HTTP/1.0 500 Url parameter missing or empty.");
        return;
    }
    
    $scheme = parse_url($_GET["url"], PHP_URL_SCHEME);
    if ($scheme === false || in_array($scheme, array("http", "https")) === false) {
        header("HTTP/1.0 500 Invalid protocol.");
        return;
    }
    
    $content = file_get_contents($_GET["url"]);
    $info = getimagesizefromstring($content);
    
    if ($info === false || in_array($info["mime"], $validMimeTypes) === false) {
        header("HTTP/1.0 500 Url doesn't seem to be a valid image.");
        return;
    }
    
    header('Content-Type:' . $info["mime"]);
    echo $content;
    
});

Route::get('see_array', function(){
    foreach(App\Tipeproyek::get_arr_detil_by_proyek() as $r){
        echo $r['nm_tipe'].'<br>';
    }
});

//Route::get('/log-in', 'LoginController@index');

Route::get('sendemail', function () {

    $data = array(
        'name' => "Test Pesan Kode",
    );

    Mail::send('email.test', $data, function ($message) {

        $message->from('support@rumahsubsidiceria.com', 'Test');

        $message->to('febriantojrk2a@gmail.com')->subject('Kirim email !');

    });

    
});

use PHPJasper\PHPJasper;

Route::get('trial_jasper_reports', function () {

    $jasperPHP = new PHPJasper;
    $jdbc_dir = __DIR__ . '/vendor/geekcom/phpjasper/bin/jaspertarter/jdbc';
    $options = [
        'format' => ['pdf'],
        //'locale' => 'en',
        //'params' => [],
    ];

    $jasperPHP->process(
		public_path() . '/examples/report1.jasper', //Input file 
		public_path() . '/reports', //Output file without extension
		$options //Output format
		//array("php_version" => phpversion()) //Parameters array
		//Config::get('database.connections.mysql'), //DB connection array
	)->execute();
});
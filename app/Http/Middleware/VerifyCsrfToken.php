<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'set_user/*',
        'set_proyek/*',
        'set_tipe_proyek/*',
        'set_kapling/*',
        'set_marketing/*',
        'set_categories/*',
        'post_news/*',
        'entry_transaksi/view',
        'entry_transaksi/action',
        'data_transaksi/view',
        'data_transaksi/action',
        'entry_pembatalan/*',
        'data_pembatalan/view',
        'data_pembatalan/action',
        'log-in/checklogin',
        'set_app/save',
        'profile/update_profile',
        'change_password/update_password',
        'set_slider/action',
        'set_slider/view'
    ];
}

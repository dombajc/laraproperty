<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlinelistingController extends Controller
{
    public function index()
    {
        return view('online.listing');
    }
}

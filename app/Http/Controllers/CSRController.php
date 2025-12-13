<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSRController extends Controller
{
    public function index()
    {
        return view('csr.index');
    }
}

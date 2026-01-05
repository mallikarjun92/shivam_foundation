<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSRController extends Controller
{
    public function index()
    {
        $impactReports = \App\Models\ImpactReport::orderBy('created_at', 'desc')
            ->paginate(6);
        return view('csr.index', compact('impactReports'));
    }

    public function index2()
    {
        $impactReports = \App\Models\ImpactReport::orderBy('created_at', 'desc')
            ->paginate(6);
        return view('csr.index_old', compact('impactReports'));
    }
}

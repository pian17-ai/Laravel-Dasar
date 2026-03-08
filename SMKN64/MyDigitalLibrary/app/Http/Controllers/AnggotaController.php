<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('anggota.index');
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        // simpan data anggota
        return redirect()->route('anggota.index');
    }
}

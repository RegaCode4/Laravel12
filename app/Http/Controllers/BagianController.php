<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function index()
    {
        $bagian = Bagian::all();
        return view('bagian.index', compact('bagian'));
    }

    public function show($id){
        $bagian = Bagian::find($id);
        return view('bagian.show', compact('bagian'));
    }
}

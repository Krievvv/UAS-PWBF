<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PanduanModel;
use App\Models\RekomendasiPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    public function index()
    {
        $rekomendasi = RekomendasiPelayanan::all();
        return view('admin.rekomendasi.index', compact('rekomendasi'));
    }
    public function index_user()
    {
        $rekomendasi = RekomendasiPelayanan::all();
        return view('user.rekomendasi.index', compact('rekomendasi'));
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'nama_rekomendasi' => $request->nama_rekomendasi,
            'deskripsi_rekomendasi' => $request->deskripsi_rekomendasi,
            'url_rekomendasi' => $request->url_rekomendasi
        ];
        RekomendasiPelayanan::create($data);
        return redirect()->back()->with('success', 'Rekomendasi Successfully Added !');
    }

    public function detail($id)
    {
        $data = RekomendasiPelayanan::find($id);
        return view('admin.rekomendasi.detail', compact('data'));
    }
}

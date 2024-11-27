<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\KomunitasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomunitasController extends Controller
{
    public function index()
    {
        $data = KomunitasModel::where('status', '1')->paginate(10);
        $latest5 = KomunitasModel::latest()->get('nama_komunitas');
        // return $latest5;
        return view('user.komunitas.index', compact('data'));
    }
    public function indexAdmin()
    {
        $komunitas = KomunitasModel::paginate(10);
        return view('admin.komunitas.index', compact('komunitas'));
    }
    public function create()
    {
        return view('user.komunitas.create');
    }
    public function store(Request $request)
    {

        if (Auth::user()->role_id === 1) {

            $data = [
                'nama_komunitas' => $request->nama_komunitas,
                'deskripsi_komunitas' => $request->deskripsi_komunitas,
                'status' => 1
            ];

            KomunitasModel::create($data);

            return redirect()->back()->with('success', 'Komunitas Berhasil Ditambahkan');

        } else {

            $data = [
                'nama_komunitas' => $request->nama_komunitas,
                'deskripsi_komunitas' => $request->deskripsi_komunitas,
                'status' => 0
            ];

            KomunitasModel::create($data);

            return redirect('komunitas/all')->with('success', 'Komunitas Berhasil Ditambahkan');

        }
    }

    public function show($id)
    {
        $show = KomunitasModel::with('comments')->findOrFail($id);
        return view('user.komunitas.detail', compact('show'));
    }
}

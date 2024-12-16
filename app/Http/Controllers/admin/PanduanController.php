<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PanduanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanduanController extends Controller
{
    public function index()
    {
        $panduan = PanduanModel::all();
        return view('admin.panduan.index', compact('panduan'));
    }

    public function index_user()
    {
        $panduan = PanduanModel::paginate(5);
        return view('user.panduan.index', compact('panduan'));
    }


    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'nama_panduan' => $request->nama_panduan,
            'isi_panduan' => $request->isi_panduan
        ];

        PanduanModel::create($data);
        return redirect()->back()->with('success', 'Panduan Successfully Added !');
    }

    public function detail($id)
    {
        $panduan = PanduanModel::findOrFail($id);
        return view('admin.panduan.detail',compact('panduan'));
    }
    public function show($id)
    {
        $panduan = PanduanModel::findOrFail($id);
        return view('user.panduan.show',compact('panduan'));
    }

    public function delete($id)
    {
        $data = PanduanModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Panduan Berhasil Dihapus');
    }
}

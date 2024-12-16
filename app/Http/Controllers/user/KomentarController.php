<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\KomentarModel;
use App\Models\KomunitasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function index()
    {
        $data = KomentarModel::with('user', 'komunitas')->paginate(10);
        return view('admin.komentar.index', compact('data'));
    }

    public function store(Request $request, $id)
    {

        $komunitas = KomunitasModel::find($id, 'id');

        $komentar = [
            'komunitas_id' => $komunitas->id,
            'isi_komentar' => $request->komentar,
            'status' => 1, // active
            'user_id' => Auth::user()->id
        ];

        KomentarModel::create($komentar);

        return redirect()->back()->with('success', 'Comments Published');
    }

    public function publish($id)
    {
        $comment = KomentarModel::find($id);
        $comment->status = 1; // publish
        $comment->save();

        return redirect()->back()->with('success', 'Comment has been published');
    }
    public function takedown($id)
    {
        $comment = KomentarModel::find($id);
        $comment->status = 0; // takedown
        $comment->save();

        return redirect()->back()->with('success', 'Comment has been takedown');
    }

    public function delete($id)
    {
        $data = KomentarModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Komentar Berhasil Dihapus');
    }
}

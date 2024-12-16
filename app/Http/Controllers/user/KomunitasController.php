<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\KomentarModel;
use App\Models\KomunitasModel;
use App\Models\memberKomunitasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KomunitasController extends Controller
{
    public function index()
    {
        $data = KomunitasModel::where('status', '1')->paginate(5);
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
        $show = KomunitasModel::with([
            'comments' => function ($query) {
                $query->where('status', 1);
            }
        ])->findOrFail($id);

        $user = Auth::user();
        $countComment = KomentarModel::where('komunitas_id', '=', $id)->count();
        return view('user.komunitas.detail', compact('show', 'countComment', 'user'));
    }

    public function detail($id)
    {
        $komunitas = KomunitasModel::find($id);
        $usersJoined = memberKomunitasModel::where('komunitas_id', '=', $id)
                        ->with('komunitas', 'user')
                        ->get();
        return view('admin.komunitas.detail', compact('komunitas', 'usersJoined'));
    }

    public function join(Request $request, $id)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'komunitas_id' => $id,
        ];

        memberKomunitasModel::create($data);
        return redirect()->back()->with('Succesfully Joined Komunitas');
    }

    public function myKomunitas($id)
    {
        $komunitas = memberKomunitasModel::where('user_id', '=', Auth::user()->id);
        return view('user.komunitas.myKomunitas', compact('komunitas'));
    }

    public function publish($id)
    {
        $comment = KomunitasModel::find($id);
        $comment->status = 1; // publish
        $comment->save();

        return redirect()->back()->with('success', 'Komunitas has been published');
    }

    public function takedown($id)
    {
        $comment = KomunitasModel::find($id);
        $comment->status = 0; // takedown
        $comment->save();

        return redirect()->back()->with('success', 'Komunitas has been takedown');
    }

    public function delete($id)
    {
        $data = KomunitasModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Komunitas Berhasil Dihapus');
    }

    public function leave($id)
    {
        $data = memberKomunitasModel::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Keluardari komunitas');
    }
}

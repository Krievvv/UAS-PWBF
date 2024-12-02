<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\KomentarModel;
use App\Models\KomunitasModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $komunitas = KomunitasModel::latest()->take(4)->get();
        $comments = KomentarModel::latest()->take(5)->get();
        return view('admin.dashboard', compact('komunitas', 'comments'));
    }
}

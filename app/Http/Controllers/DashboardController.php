<?php


// DashboardController.php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswaCount = Mahasiswa::count();
        $dosenCount     = Dosen::count();
        $mhs = Mahasiswa::orderBy('id', 'asc')->take(10)->get();
        $dns = Dosen::orderBy('id', 'asc')->take(10)->get();
        return view('dashboard', compact('mahasiswaCount', 'dosenCount', 'mhs', 'dns'));
    }
}

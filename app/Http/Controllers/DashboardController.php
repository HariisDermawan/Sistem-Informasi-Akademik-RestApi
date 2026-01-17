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
        // Total counts
        $mahasiswaCount = Mahasiswa::count();
        $dosenCount = Dosen::count();

        // Recent entries, misal 10 terbaru
        $recentMahasiswa = Mahasiswa::latest()->take(10)->get();
        $recentDosen = Dosen::latest()->take(10)->get();

        return view('dashboard', compact('mahasiswaCount', 'dosenCount', 'recentMahasiswa', 'recentDosen'));
    }
}

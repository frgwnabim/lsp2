<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        $laporan = laporan::all();
         if ($request->has('kegiatan')) {
            $kegiatanFilter = $request->input('kegiatan');
            $laporan_kegiatan = Laporan::whereIn('kegiatan', $kegiatanFilter)->get();
        }
        return view('welcome',compact('laporan'));
    }


    public function kegiatan(){
        return view('kegiatan');
    }

    public function dashboard(Request $request){
        $user = Auth::user(); 
        $laporan = laporan::all();
        if ($request->has('kegiatan')) {
            $kegiatanFilter = $request->input('kegiatan');
            $laporan_kegiatan = Laporan::whereIn('kegiatan', $kegiatanFilter)->get();
        }

        // Filter berdasarkan hari
        $filteredDataHari = Laporan::whereDate('created_at', now()->toDateString())->get();

        // Filter berdasarkan minggu
        $filteredDataMinggu = Laporan::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();

        // Filter berdasarkan bulan
        $filteredDataBulan = Laporan::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->get();
        
        return view('dashboard',compact('laporan'));
    }

    public function history(Request $request){
        $user = Auth::user(); 
        $laporan = laporan::all();
        if ($request->has('kegiatan')) {
            $kegiatanFilter = $request->input('kegiatan');
            $laporan_kegiatan = Laporan::whereIn('kegiatan', $kegiatanFilter)->get();
        }
        
        return view('history',compact('laporan'));
    }
    public function show($id)
    {
        $user = Auth::user(); 
        $laporan = Laporan::findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->input('status');
        $laporan->save();

        return redirect()->route('laporan.show', $laporan->id)->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = laporan::find($id);

        if (!$laporan) {
            return response()->json(['message' => 'laporan not found'], 404);
        }
        $laporan->delete();

        return Redirect('/dashboard')->with('success', 'Laporan deleted successfully');
    }

}

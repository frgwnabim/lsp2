<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use app\Models\laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class FormController extends Controller
{
    public function submitForm(Request $request) {
        
        $validatedData = $request->validate([
             'kategori' => 'required',
             'name' => 'required',
             'alamat' => 'required',
             'aspirasi' => 'required',
             'keterangan' => 'required',
             'gambar_kejadian' => 'image',
             'status' => 'nullable',
         ]);
 
         $gambarKejadianPath = $request->file('gambar_kejadian')->store('public/gambar_kejadian');
         $gambarKejadianUrl = Storage::url($gambarKejadianPath);
 
         DB::table('laporan')->insert([
             'kategori' => $validatedData['kategori'],
             'name' => $validatedData['name'],
             'alamat' => $validatedData['alamat'],
             'aspirasi' => $validatedData['aspirasi'],
             'keterangan' => $validatedData['keterangan'],
             'gambar_kejadian' => $gambarKejadianUrl,
             'status' => $validatedData['status'],
         ]);
         return response()->json(['message' => 'Formulir berhasil terkirim']);
     }
 
}

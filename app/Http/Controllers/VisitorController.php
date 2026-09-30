<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Str;

class VisitorController extends Controller
{
    public function store(Request $request)
  {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'required|string',
            'divisi_tujuan' => 'required|string',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required',
            'temu_janji' => 'required|string',
            'keperluan' => 'required|string',
        ]);

        Visitor::create($validated);

        // Pesan sukses yang lebih ramah dan hangat
        return redirect()->back()->with(
            'success', 
            'Terima kasih! Kehadiran Anda telah berhasil dicatat di Buku Tamu Digital RRI Bukittinggi.'
        );
    }
}
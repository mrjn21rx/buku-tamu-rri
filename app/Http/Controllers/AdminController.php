<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // Fungsi privat pembantu untuk menerapkan filter
    private function getFilteredQuery(Request $request)
    {
        $query = Visitor::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('divisi')) {
            $query->where('divisi_tujuan', $request->divisi);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_kunjungan', $request->bulan);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function index(Request $request)
    {
        // Gunakan fungsi filter di atas
        $visitors = $this->getFilteredQuery($request)->paginate(10);

        // Ambil data Metric Cards
        $totalKunjungan = Visitor::count();
        $hariIni = Visitor::whereDate('tanggal_kunjungan', now()->toDateString())->count();
        $bulanIni = Visitor::whereMonth('tanggal_kunjungan', now()->month)
                           ->whereYear('tanggal_kunjungan', now()->year)->count();
        $menunggu = Visitor::where('status', 'Menunggu')->count();

        return view('admin.dashboard', compact(
            'visitors', 'totalKunjungan', 'hariIni', 'bulanIni', 'menunggu'
        ));
    }

    public function updateStatus($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->update(['status' => 'Selesai']);

        return back()->with('success', 'Status kunjungan berhasil diubah menjadi Selesai!');
    }

    // --- FITUR EKSPOR ---

    public function exportExcel(Request $request)
    {
        $visitors = $this->getFilteredQuery($request)->get();
        $fileName = 'Laporan_Kunjungan_RRI_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Kolom Header Excel
       $columns = ['No', 'Tanggal', 'Jam', 'Nama Lengkap', 'No HP', 'Email', 'Alamat/Instansi', 'Divisi Tujuan', 'Status Janji', 'Keperluan', 'Status Selesai'];

        $callback = function() use($visitors, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            $row = 1;
            foreach ($visitors as $v) {
                fputcsv($file, [
                    $row++, 
                    $v->tanggal_kunjungan, 
                    $v->jam_kunjungan, 
                    $v->nama_lengkap, 
                    $v->no_hp,
                    $v->email, 
                    $v->alamat, 
                    $v->divisi_tujuan,
                    $v->temu_janji, 
                    $v->keperluan, 
                    $v->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $visitors = $this->getFilteredQuery($request)->get();
        
        // Memanggil view cetak PDF
        $pdf = Pdf::loadView('admin.pdf', compact('visitors'));
        
        // Set ukuran kertas
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Laporan_Kunjungan_RRI_' . date('Ymd_His') . '.pdf');
    }
}
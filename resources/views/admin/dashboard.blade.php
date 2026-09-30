@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Dashboard Admin</h2>
            <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>
        </div>
        <div class="space-x-2">
            <!-- Tombol Ekspor (Fungsinya akan ditambahkan nanti) -->
            <!-- Tombol Ekspor Aktif -->
<a href="{{ route('admin.export.excel', request()->all()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow inline-block transition"><i class="fas fa-file-excel mr-2"></i> Ekspor Excel</a>
<a href="{{ route('admin.export.pdf', request()->all()) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow inline-block transition"><i class="fas fa-file-pdf mr-2"></i> Cetak PDF</a>
        </div>
    </div>

    <!-- Alert Sukses Ubah Status -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl mr-4"><i class="fas fa-users"></i></div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Kunjungan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalKunjungan }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl mr-4"><i class="fas fa-calendar-day"></i></div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Hari Ini</p>
                <p class="text-2xl font-bold text-gray-800">{{ $hariIni }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xl mr-4"><i class="fas fa-calendar-alt"></i></div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Bulan Ini</p>
                <p class="text-2xl font-bold text-gray-800">{{ $bulanIni }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center text-xl mr-4"><i class="fas fa-clock"></i></div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Menunggu</p>
                <p class="text-2xl font-bold text-gray-800">{{ $menunggu }}</p>
            </div>
        </div>
    </div>

    <!-- Filter & Pencarian -->
    <div class="bg-white p-4 rounded-t-xl shadow-sm border-b border-gray-200">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, instansi, atau kode..." class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/3">
            
            <select name="divisi" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4">
                <option value="">Semua Divisi</option>
                <option value="Pemberitaan" {{ request('divisi') == 'Pemberitaan' ? 'selected' : '' }}>Pemberitaan</option>
                <option value="Siaran" {{ request('divisi') == 'Siaran' ? 'selected' : '' }}>Siaran</option>
                <option value="Program" {{ request('divisi') == 'Program' ? 'selected' : '' }}>Program</option>
                <option value="Teknik" {{ request('divisi') == 'Teknik' ? 'selected' : '' }}>Teknik & TMB</option>
                <option value="Tata Usaha" {{ request('divisi') == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha / SDM</option>
            </select>

            <select name="bulan" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/4">
                <option value="">Semua Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ sprintf('%02d', $i) }}" {{ request('bulan') == sprintf('%02d', $i) ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                    </option>
                @endfor
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg"><i class="fas fa-filter mr-1"></i> Filter</button>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-center"><i class="fas fa-sync-alt"></i></a>
        </form>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-b-xl shadow-sm overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-gray-50 text-gray-700 border-b">
                    <th class="py-3 px-4">Waktu</th>
                    <th class="py-3 px-4">Nama Lengkap</th>
                    <th class="py-3 px-4">No. HP</th>
                    <th class="py-3 px-4">Instansi</th>
                    <th class="py-3 px-4">Divisi & Janji</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visitors as $v)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">
                        <div class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($v->tanggal_kunjungan)->format('d/m/Y') }}</div>
                        <div class="text-xs text-blue-600"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($v->jam_kunjungan)->format('H:i') }} WIB</div>
                    </td>
                    <td class="py-3 px-4 font-semibold text-gray-800">{{ $v->nama_lengkap }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $v->no_hp }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ Str::limit($v->alamat, 25) }}</td>
                    <td class="py-3 px-4">
                        <div class="font-medium text-gray-800">{{ $v->divisi_tujuan }}</div>
                        @if ($v->temu_janji == 'Sudah Janji')
                            <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded border border-green-200">Sudah Janji</span>
                        @else
                            <span class="text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded border border-gray-200">Belum Janji</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if ($v->status == 'Menunggu')
                            <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-bold">Menunggu</span>
                        @else
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-bold">Selesai</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if ($v->status == 'Menunggu')
                        <form action="{{ route('admin.visitor.status', $v->id) }}" method="POST" onsubmit="return confirm('Tandai kunjungan ini telah selesai?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded shadow-sm font-medium">
                                <i class="fas fa-check mr-1"></i> Selesai
                            </button>
                        </form>
                        @else
                            <span class="text-gray-400 text-xs italic"><i class="fas fa-check-double"></i> Tuntas</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-500">
                        Belum ada data kunjungan yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="p-4 border-t">
            {{ $visitors->links() }}
        </div>
    </div>

</div>
@endsection
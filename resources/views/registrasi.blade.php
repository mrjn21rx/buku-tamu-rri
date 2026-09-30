@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Header Kembali -->
    <div class="mb-8">
        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
        </a>
        <h2 class="text-3xl font-bold text-gray-800 mt-4">Form Registrasi Kunjungan</h2>
        <p class="text-gray-600 mt-2">Silakan lengkapi data di bawah ini sebelum melakukan kunjungan ke RRI Bukittinggi.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Kolom Kiri: Form -->
<div class="lg:w-2/3 bg-white p-8 rounded-xl shadow-md border border-gray-100">
            
            {{-- Alert Sukses Revisi (Lebih Ramah) --}}
            @if (session('success'))
            <div class="mb-8 p-6 bg-green-50 border border-green-200 rounded-xl flex items-center shadow-sm">
                <div class="flex-shrink-0 mr-4">
                    <i class="fas fa-check-circle text-4xl text-green-500"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-green-800">Selamat Datang!</h3>
                    <p class="text-green-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- Alert Error Validasi --}}
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                <p class="font-bold mb-1">Mohon periksa kembali isian Anda:</p>
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('visitor.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Contoh: 081234567890">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-gray-400 text-xs">(Opsional)</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="budi@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Kunjungan <span class="text-red-500">*</span></label>
                        <select name="temu_janji" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="Belum Janji" {{ old('temu_janji') == 'Belum Janji' ? 'selected' : '' }}>Datang Langsung (Belum ada janji)</option>
                            <option value="Sudah Janji" {{ old('temu_janji') == 'Sudah Janji' ? 'selected' : '' }}>Sudah Buat Janji Sebelumnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Instansi / Pengunjung <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Alamat instansi atau rumah lengkap...">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Divisi Tujuan <span class="text-red-500">*</span></label>
                        <select name="divisi_tujuan" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Divisi --</option>
                            <option value="Pemberitaan" {{ old('divisi_tujuan') == 'Pemberitaan' ? 'selected' : '' }}>Pemberitaan</option>
                            <option value="Siaran" {{ old('divisi_tujuan') == 'Siaran' ? 'selected' : '' }}>Siaran</option>
                            <option value="Program" {{ old('divisi_tujuan') == 'Program' ? 'selected' : '' }}>Program</option>
                            <option value="Teknik" {{ old('divisi_tujuan') == 'Teknik' ? 'selected' : '' }}>Teknik & TMB</option>
                            <option value="Tata Usaha" {{ old('divisi_tujuan') == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha / SDM</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tgl Kunjungan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Kunjungan <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_kunjungan" value="{{ old('jam_kunjungan', date('H:i')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan Kunjungan <span class="text-red-500">*</span></label>
                    <textarea name="keperluan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Jelaskan tujuan kunjungan Anda...">{{ old('keperluan') }}</textarea>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300">
                        <i class="fas fa-edit mr-2"></i> Catat di Buku Tamu
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Sidebar Informasi (DIREVISI) -->
        <div class="lg:w-1/3 space-y-6">
            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                <h3 class="text-lg font-bold text-blue-800 mb-3 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i> Ketentuan Berkunjung
                </h3>
                <ul class="text-sm text-blue-900 space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mt-1 mr-2 text-blue-500"></i>
                        Anda dapat mengisi buku tamu pada hari-H kedatangan (di meja resepsionis) atau mengisi lebih awal.
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mt-1 mr-2 text-blue-500"></i>
                        Jika belum membuat janji dengan divisi terkait, mohon tunggu sebentar di lobi setelah mengisi form ini.
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mt-1 mr-2 text-blue-500"></i>
                        Pastikan data dan nomor HP yang diisi benar agar mudah dihubungi oleh petugas kami.
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Butuh Bantuan?</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Hotline Humas</p>
                            <p class="text-gray-800 font-medium">0812-XXXX-XXXX</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-envelope text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Email</p>
                            <p class="text-gray-800 font-medium">bukittinggi@rri.co.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
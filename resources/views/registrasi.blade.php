@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Header -->
    <div class="mb-10 text-center md:text-left">
        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors mb-4 bg-blue-50 px-3 py-1.5 rounded-full">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Formulir Buku Tamu</h2>
        <p class="text-slate-500 mt-2 text-lg">Silakan lengkapi data kunjungan Anda di bawah ini.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Kolom Kiri: Form -->
        <div class="lg:w-2/3 bg-white p-8 md:p-10 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 relative overflow-hidden">
            
            {{-- Dekorasi Sudut --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-10 opacity-50"></div>

            {{-- Alert Sukses --}}
            @if (session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-start shadow-sm">
                <div class="flex-shrink-0 mt-1 mr-4">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-md">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-emerald-900">Berhasil Disimpan!</h3>
                    <p class="text-emerald-700 mt-1 leading-relaxed">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- Alert Error --}}
            @if ($errors->any())
            <div class="mb-8 p-5 bg-rose-50 border border-rose-200 rounded-2xl shadow-sm">
                <div class="flex items-center mb-3">
                    <i class="fas fa-exclamation-triangle text-rose-500 mr-2"></i>
                    <p class="font-bold text-rose-900">Terdapat kesalahan pengisian:</p>
                </div>
                <ul class="list-disc pl-6 text-sm text-rose-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('visitor.store') }}" method="POST" class="space-y-7">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="far fa-user"></i></span>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none" required placeholder="Contoh: Budi Santoso">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">No. HP / WhatsApp <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="fas fa-phone-alt"></i></span>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none" required placeholder="0812-XXXX-XXXX">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email <span class="text-slate-400 font-normal ml-1">(Opsional)</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="far fa-envelope"></i></span>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none" placeholder="budi@email.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Status Kunjungan <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="far fa-calendar-check"></i></span>
                            <select name="temu_janji" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none appearance-none" required>
                                <option value="Belum Janji" {{ old('temu_janji') == 'Belum Janji' ? 'selected' : '' }}>Datang Langsung (Belum janji)</option>
                                <option value="Sudah Janji" {{ old('temu_janji') == 'Sudah Janji' ? 'selected' : '' }}>Sudah Buat Janji Sebelumnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Asal Instansi / Alamat <span class="text-rose-500">*</span></label>
                    <textarea name="alamat" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none resize-none" required placeholder="Tuliskan nama instansi atau alamat asal Anda...">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 p-5 bg-slate-50/50 border border-slate-100 rounded-2xl">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Divisi Tujuan <span class="text-rose-500">*</span></label>
                        <select name="divisi_tujuan" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none" required>
                            <option value="">-- Pilih --</option>
                            <option value="Pemberitaan" {{ old('divisi_tujuan') == 'Pemberitaan' ? 'selected' : '' }}>Pemberitaan</option>
                            <option value="Siaran" {{ old('divisi_tujuan') == 'Siaran' ? 'selected' : '' }}>Siaran</option>
                            <option value="Program" {{ old('divisi_tujuan') == 'Program' ? 'selected' : '' }}>Program</option>
                            <option value="Teknik" {{ old('divisi_tujuan') == 'Teknik' ? 'selected' : '' }}>Teknik & TMB</option>
                            <option value="Tata Usaha" {{ old('divisi_tujuan') == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha / SDM</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tgl Kunjungan <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jam Kedatangan <span class="text-rose-500">*</span></label>
                        <input type="time" name="jam_kunjungan" value="{{ old('jam_kunjungan', date('H:i')) }}" class="w-full bg-white border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Keperluan Kunjungan <span class="text-rose-500">*</span></label>
                    <textarea name="keperluan" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none resize-none" required placeholder="Jelaskan tujuan atau keperluan Anda secara singkat...">{{ old('keperluan') }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex items-center justify-center gap-3 bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-paper-plane"></i> Kirim Data Kunjungan
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Sidebar Informasi (Desain Baru) -->
        <div class="lg:w-1/3 space-y-6">
            <!-- Card Informasi -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 p-8 rounded-3xl shadow-xl shadow-blue-900/20 text-white relative overflow-hidden">
                <div class="absolute -right-6 -top-6 text-blue-700/50 text-8xl"><i class="fas fa-quote-right"></i></div>
                <h3 class="text-xl font-bold mb-6 flex items-center relative z-10">
                    <i class="fas fa-info-circle mr-3 text-blue-300 text-2xl"></i> Ketentuan
                </h3>
                <ul class="text-blue-100 space-y-5 relative z-10 text-sm leading-relaxed">
                    <li class="flex items-start">
                        <div class="w-6 h-6 rounded-full bg-blue-700/50 flex-shrink-0 flex items-center justify-center mt-0.5 mr-3">
                            <i class="fas fa-check text-xs text-blue-300"></i>
                        </div>
                        Anda dapat mengisi buku tamu langsung di resepsionis pada hari-H kedatangan.
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 h-6 rounded-full bg-blue-700/50 flex-shrink-0 flex items-center justify-center mt-0.5 mr-3">
                            <i class="fas fa-check text-xs text-blue-300"></i>
                        </div>
                        Bila belum memiliki janji temu, mohon bersabar menunggu di area lobi selagi petugas kami menghubungi divisi terkait.
                    </li>
                    <li class="flex items-start">
                        <div class="w-6 h-6 rounded-full bg-blue-700/50 flex-shrink-0 flex items-center justify-center mt-0.5 mr-3">
                            <i class="fas fa-check text-xs text-blue-300"></i>
                        </div>
                        Pastikan kontak Anda aktif agar memudahkan kordinasi.
                    </li>
                </ul>
            </div>

            <!-- Card Kontak -->
            <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Hubungi Kami</h3>
                <div class="space-y-5">
                    <div class="flex items-center group">
                        <div class="w-12 h-12 bg-emerald-50 group-hover:bg-emerald-500 transition-colors rounded-2xl flex items-center justify-center mr-4 text-emerald-600 group-hover:text-white shadow-sm border border-emerald-100">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Hotline Humas</p>
                            <p class="text-slate-700 font-bold">0812-XXXX-XXXX</p>
                        </div>
                    </div>
                    <div class="flex items-center group">
                        <div class="w-12 h-12 bg-blue-50 group-hover:bg-blue-600 transition-colors rounded-2xl flex items-center justify-center mr-4 text-blue-600 group-hover:text-white shadow-sm border border-blue-100">
                            <i class="far fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Email Resmi</p>
                            <p class="text-slate-700 font-bold">bukittinggi@rri.co.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
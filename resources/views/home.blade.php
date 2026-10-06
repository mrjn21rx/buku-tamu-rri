@extends('layouts.app')

@section('content')
<!-- Hero Section Modern -->
<div class="relative bg-blue-900 min-h-[78vh] flex flex-col justify-between overflow-hidden">
    <!-- 1. Foto Gedung Asli (Di lapisan paling bawah) -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/gedung-rri.png') }}');"></div>
    
    <!-- 2. Overlay Gradasi Gelap (Agar warna foto tidak nabrak dengan teks) -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-blue-900/85 to-blue-800/70 mix-blend-multiply"></div>
    
    <!-- 3. Efek Vignette (Pinggiran agak gelap agar fokus ke tengah) -->
    <div class="absolute inset-0 bg-black/30"></div>
    
    <!-- Jam Realtime: Di pojok kanan atas, menyatu dengan background Gedung RRI -->
    <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5 sm:pt-6 flex justify-end">
        <div class="inline-flex items-center gap-2.5 bg-slate-950/40 hover:bg-slate-900/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 text-white shadow-xl shadow-black/30 transition-all duration-300">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <i class="far fa-clock text-cyan-300 text-sm"></i>
            <span id="hero-realtime-clock" class="realtime-clock-display text-xs sm:text-sm font-semibold tracking-wide font-mono text-white/95"></span>
        </div>
    </div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto my-auto py-8">
        <span class="inline-block py-1 px-3 rounded-full bg-blue-800/50 border border-blue-400/30 text-blue-200 text-xs font-semibold tracking-widest uppercase mb-6 backdrop-blur-sm">Layanan Digital</span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
            Buku Tamu <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-cyan-200">RRI Bukittinggi</span>
        </h1>
        <p class="text-lg md:text-xl text-blue-100/90 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
            Selamat datang di layanan pencatatan kunjungan digital terpadu Lembaga Penyiaran Publik Radio Republik Indonesia (RRI) Bukittinggi.
        </p>
        <a href="{{ route('registrasi') }}" class="group inline-flex items-center justify-center bg-white text-blue-900 font-bold px-8 py-4 rounded-full shadow-xl shadow-blue-900/20 hover:bg-blue-50 hover:scale-105 transition-all duration-300 text-lg">
            Isi Buku Tamu Sekarang
            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <!-- Spacer bawah agar tombol CTA tidak bertabrakan dengan feature cards (-mt-20) -->
    <div class="h-20 sm:h-24"></div>
</div>

<!-- Feature Cards Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 p-8 border border-white hover:-translate-y-2 transition-transform duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-blue-100">
                <i class="fas fa-bolt text-2xl text-blue-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-3">Cepat & Praktis</h3>
            <p class="text-slate-600 leading-relaxed">Pendaftaran kunjungan dilakukan secara digital, menggantikan form kertas manual yang memakan waktu.</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 p-8 border border-white hover:-translate-y-2 transition-transform duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-cyan-100 to-cyan-50 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-cyan-100">
                <i class="fas fa-search text-2xl text-cyan-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-3">Terkoneksi</h3>
            <p class="text-slate-600 leading-relaxed">Notifikasi kehadiran langsung terhubung dengan Dashboard Humas dan divisi yang Anda tuju.</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 p-8 border border-white hover:-translate-y-2 transition-transform duration-300">
            <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-indigo-100">
                <i class="fas fa-shield-alt text-2xl text-indigo-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-3">Aman & Terpusat</h3>
            <p class="text-slate-600 leading-relaxed">Data instansi dan kontak pengunjung dikelola dengan aman tersentralisasi dalam satu sistem.</p>
        </div>
    </div>
</div>
@endsection
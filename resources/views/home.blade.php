@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-blue-900 h-[80vh] flex items-center justify-center">
    <!-- Background Image dengan Overlay Gradasi Biru -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1541888046425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-blue-700/70"></div>
    
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Selamat Datang di Buku Tamu RRI</h1>
        <p class="text-lg md:text-xl text-blue-100 mb-8">
            Layanan pencatatan kunjungan digital Lembaga Penyiaran Publik Radio Republik Indonesia (RRI) Bukittinggi. Kami siap melayani kunjungan kerja, riset, maupun studi banding Anda.
        </p>
        <a href="{{ route('registrasi') }}" class="inline-block bg-white text-blue-700 font-bold px-8 py-3 rounded-full shadow-lg hover:bg-blue-50 transition duration-300 text-lg">
            <i class="fas fa-edit mr-2"></i>Daftar Kunjungan
        </a>
    </div>
</div>

<!-- Feature Cards Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 border-blue-500">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 text-2xl">
                <i class="fas fa-bolt"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Mudah & Cepat</h3>
            <p class="text-gray-600">Proses pendaftaran kunjungan dilakukan secara digital tanpa perlu mengisi form kertas manual.</p>
        </div>
        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 border-blue-500">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 text-2xl">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Transparan</h3>
            <p class="text-gray-600">Status kunjungan dan jadwal audensi dapat terpantau dengan jelas oleh semua divisi terkait.</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 border-blue-500">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600 text-2xl">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Aman & Terpercaya</h3>
            <p class="text-gray-600">Data pengunjung dikelola dengan aman secara tersentralisasi oleh sistem administrasi RRI.</p>
        </div>
    </div>
</div>
@endsection
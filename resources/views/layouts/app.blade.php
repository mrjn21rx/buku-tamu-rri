<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - RRI Bukittinggi</title>
    
    {{-- Tailwind CSS & FontAwesome --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen selection:bg-blue-200">

    <!-- Navbar Minimalis Modern -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <!-- Ini untuk memanggil logo PNG Anda -->
                        <img src="{{ asset('images/logo_rri.svg') }}" alt="Logo RRI Bukittinggi" class="h-10 md:h-12 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                    </a>
                </div>

                {{-- Jam Digital Realtime Navbar --}}
                <div class="flex items-center gap-2 bg-slate-100/90 px-3.5 py-1.5 rounded-full border border-slate-200 text-slate-700 shadow-inner">
                    <i class="far fa-clock text-blue-600 text-xs md:text-sm animate-pulse"></i>
                    <span id="navbar-realtime-clock" class="text-xs md:text-sm font-semibold tracking-wide font-mono text-slate-800"></span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-700 transition-colors">Beranda</a>
                    <a href="{{ route('registrasi') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-700 transition-colors">Buku Tamu</a>
                    
                    @auth
                        <span class="text-slate-300">|</span>
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-blue-700 hover:text-blue-900">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-red-500 hover:text-red-700 transition-colors">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Simple -->
    <footer class="bg-slate-900 text-slate-400 text-center py-8 mt-auto">
        <p class="text-sm">&copy; {{ date('Y') }} LPP RRI Bukittinggi. Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        function updateNavbarClock() {
            const clockEl = document.getElementById('navbar-realtime-clock');
            if (!clockEl) return;

            const now = new Date();
            const hari = now.toLocaleDateString('id-ID', { weekday: 'long' });
            const tanggal = now.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');

            clockEl.textContent = `${hari}, ${tanggal} • ${jam}:${menit}:${detik} WIB`;
        }
        document.addEventListener('DOMContentLoaded', function() {
            updateNavbarClock();
            setInterval(updateNavbarClock, 1000);
        });
    </script>
</body>
</html>
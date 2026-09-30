<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu - RRI Bukittinggi</title>
    
    {{-- Kita gunakan CDN Tailwind untuk vibe coding cepat --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-700 tracking-wider">RRI<span class="text-gray-700 text-lg ml-2">Bukittinggi</span></span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <!-- Menu Publik -->
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-700 font-medium">Beranda</a>
                    <a href="{{ route('registrasi') }}" class="text-gray-600 hover:text-blue-700 font-medium">Kunjungan</a>
                    
                    <!-- Menu Admin (Mulai) -->
                    @auth
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-700 font-bold hover:text-blue-900">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Logout</button>
                        </form>
                    @endauth
                    <!-- Menu Admin (Selesai) -->
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white text-center py-6 mt-10">
        <p>&copy; {{ date('Y') }} RRI Bukittinggi. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WebGIS UMKM Sutojayan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(to right, #7f1d1d, #dc2626);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center">

    <!-- Judul -->
    <h1 class="text-white text-xl md:text-2xl font-bold mb-8 text-center px-4">
        Sistem Informasi Pemetaan UMKM Potensial Kecamatan Sutojayan
    </h1>

    <!-- Card Login -->
    <div class="bg-white/95 backdrop-blur-md w-full max-w-xl rounded-xl shadow-xl p-10 border border-red-100">

        <!-- Form -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                 {{ session('success') }}
             </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                {{ session('error') }}
             </div>
        @endif
        <form method="POST" action="{{ route('login.process') }}" class="space-y-6">
            @csrf

            <!-- Username -->
            <input type="text" name="email"
                placeholder="Username"
                class="w-full text-center px-4 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none text-lg">

            <!-- Password -->
            <input type="password" name="password"
                placeholder="Password"
                class="w-full text-center px-4 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:outline-none text-lg">

            <!-- Button -->
            <div class="flex justify-center gap-6 pt-2">

                <a href="{{ route('register') }}"
                class="text-gray-600 hover:text-red-600 font-medium">
                Buat Akun
                </a>

                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-semibold transition">
                    Login
                </button>

            </div>

        </form>

    </div>

</body>
</html>

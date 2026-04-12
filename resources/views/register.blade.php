<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WebGIS UMKM Sutojayan</title>

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
        Pendaftaran Akun Sistem UMKM Sutojayan
    </h1>

    <!-- Card -->
    <div class="bg-white/95 w-full max-w-xl rounded-xl shadow-xl p-10 border border-red-100">

        <!-- Error -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('register.process') }}" class="space-y-5">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap"
                class="w-full text-center px-4 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">

            <input type="email" name="email" placeholder="Email"
                class="w-full text-center px-4 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">

            <input type="password" name="password" placeholder="Password"
                class="w-full text-center px-4 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full text-center px-4 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">

            <!-- Button -->
            <div class="flex justify-center gap-6 pt-2">

                <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-red-600 font-medium">
                    Kembali
                </a>

                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-semibold">
                    Daftar
                </button>

            </div>

        </form>

    </div>

</body>
</html>

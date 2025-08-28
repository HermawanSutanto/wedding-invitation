<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Belum Aktif</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc; /* Latar belakang abu-abu sangat terang */
        }
        .playfair-display {
            font-family: 'Playfair Display', serif;
        }
        @keyframes pulse-clock {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-pulse-clock {
            animation: pulse-clock 2.5s infinite ease-in-out;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="text-center bg-white p-8 md:p-12 rounded-xl shadow-2xl max-w-xl w-full">
        
        <div class="mb-5">
            <svg class="mx-auto h-16 w-16 text-yellow-500 animate-pulse-clock" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-3 playfair-display">Undangan Ini Belum Aktif</h1>
        
        <p class="text-gray-600 text-base max-w-md mx-auto leading-relaxed">
            Undangan pernikahan untuk
            <span class="block font-semibold text-indigo-700 text-2xl my-2 playfair-display italic">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</span>
            sedang dalam tahap persiapan dan akan segera tersedia.
        </p>

        <div class="mt-8 pt-8 border-t border-gray-200">
            <p class="text-sm text-gray-500 mb-4">Apakah Anda pemilik undangan ini?</p>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-indigo-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login untuk Mengaktifkan
            </a>
        </div>
    </div>

</body>
</html>
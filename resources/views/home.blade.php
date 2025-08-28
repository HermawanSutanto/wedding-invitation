<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Undangan Pernikahan Digital Impianmu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #6a5acd; /* Warna ungu lembut */
            --secondary-color: #f4f4f4;
            --text-color: #333;
            --heading-font: 'Playfair Display', serif;
            --body-font: 'Montserrat', sans-serif;
        }
        #background-slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1; /* Posisikan di paling belakang */
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #background-slideshow .slide {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: center center;
            opacity: 0; /* Semua slide awalnya transparan */
            transition: opacity 2s ease-in-out; /* Animasi fade */
        }

        #background-slideshow .slide.active {
            opacity: 1; /* Slide yang aktif akan terlihat */
        }
        body {
            margin: 0;
            font-family: var(--body-font);
            color: var(--text-color);
            line-height: 1.6;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }
        /* Header & Navigasi */
        .main-header {
            background: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-family: var(--heading-font);
            font-size: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
        }
        .auth-links a {
            margin-left: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
            transition: opacity 0.3s ease;
        }
        .auth-links a:hover {
            opacity: 0.7;
        }
        /* Hero Section */
        .hero {
        height: 90vh;
        background: none; /* Biarkan transparan agar slideshow terlihat */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #fff; /* <-- UBAH WARNA FONT MENJADI PUTIH */
        padding: 20px;
        position: relative; /* <-- TAMBAHKAN INI */
        z-index: 2; /* <-- TAMBAHKAN INI */
        }

        /* TAMBAHKAN BLOK BARU INI */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Lapisan gelap 40% transparan */
            z-index: -1;
        }
        .hero h1 {
            font-family: var(--heading-font);
            font-size: 3.5rem;
            margin-bottom: 0.5rem;
        }
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin-bottom: 2rem;
        }
        .cta-button {
            background: var(--primary-color);
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            background: #5a4ab9;
        }
        /* Sections */
        .section {
            padding: 60px 0;
            text-align: center;
        }
        .section-title {
            font-family: var(--heading-font);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            
        }
        .section-subtitle {
            max-width: 600px;
            margin: 0 auto 40px auto;
            color: #666;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: left;
        }
        .feature-card {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .feature-card h3 {
            font-family: var(--heading-font);
            margin-top: 0;
            color: var(--primary-color);
        }
        .bg-light {
            background: var(--secondary-color);
        }
        /* Footer */
        .main-footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        #features {
            position: relative; /* Diperlukan untuk overlay */
            z-index: 2;
            background: none; /* Menghapus background asli section */
        }

        /* 2. Menambahkan lapisan overlay gelap */
        #features::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Lapisan gelap 50% transparan */
            z-index: -1;
        }

        /* 3. Memastikan semua teks judul berwarna putih */
        #features .section-title,
        #features .section-subtitle {
            color: #fff;
        }

       

        /* 5. Mengubah warna judul di dalam kartu agar lebih kontras */
        #features .feature-card h3 {
            color: var(--gold-color);
        }
    </style>
</head>
<body>
    @include('layouts.partials.navbar') {{-- GANTI HEADER LAMA DENGAN INI --}}
    <div id="background-slideshow">
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1532712938310-34cb3982ef74');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1439539698758-ba2680ecadb9');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1583939411023-14783179e581');"></div>
        
        {{-- Anda bisa menambahkan lebih banyak div.slide di sini --}}
    </div>
    
    <main>
        {{-- Section .hero sekarang tidak perlu background image lagi --}}
        <section class="hero">
            <h1>Rancang Undangan Digital Impian Anda</h1>
            <p>Buat, sesuaikan, dan bagikan undangan pernikahan digital yang elegan hanya dalam beberapa menit. Mudah, cepat, dan berkesan.</p>
            <a href="{{ route('register') }}" class="cta-button">Buat Undangan Sekarang →</a>
        </section>

        <section id="features" class="section">
            <div class="container">
                <h2 class="section-title">Fitur Unggulan Kami</h2>
                <p class="section-subtitle">Semua yang Anda butuhkan untuk undangan pernikahan digital yang sempurna.</p>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>🎨 Desain Elegan</h3>
                        <p>Pilih dari puluhan template premium yang dirancang oleh desainer profesional untuk menyesuaikan dengan tema pernikahan Anda.</p>
                    </div>
                    <div class="feature-card">
                        <h3>✍️ Kustomisasi Mudah</h3>
                        <p>Ubah teks, foto, musik, dan peta lokasi dengan editor yang sangat mudah digunakan, bahkan untuk pemula sekalipun.</p>
                    </div>
                    <div class="feature-card">
                        <h3>📨 Manajemen Tamu & RSVP</h3>
                        <p>Kirim undangan via WhatsApp, pantau status kehadiran (RSVP), dan terima ucapan langsung dari para tamu undangan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="section bg-light">
             <div class="container">
                <h2 class="section-title">Hanya 3 Langkah Mudah</h2>
                 <p class="section-subtitle">Mulai perjalanan Anda menuju undangan yang tak terlupakan.</p>
                 <div class="features-grid">
                     <div class="feature-card">
                         <h3>1. Daftar Akun</h3>
                         <p>Buat akun gratis Anda untuk memulai dan menyimpan semua data undangan Anda dengan aman.</p>
                     </div>
                     <div class="feature-card">
                         <h3>2. Pilih & Edit Desain</h3>
                         <p>Jelajahi galeri template kami, pilih yang paling Anda suka, dan mulailah berkreasi dengan data pernikahan Anda.</p>
                     </div>
                     <div class="feature-card">
                         <h3>3. Bagikan & Pantau</h3>
                         <p>Setelah selesai, dapatkan link unik undangan Anda untuk dibagikan ke semua tamu dan lihat siapa saja yang akan hadir.</p>
                     </div>
                 </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2025 NikahYuk. All Rights Reserved.</p>
        </div>
    </footer>
    <script>document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('#background-slideshow .slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        
        // Tampilkan slide pertama secara langsung
        slides[currentSlide].classList.add('active');

        setInterval(() => {
            // Sembunyikan slide saat ini
            slides[currentSlide].classList.remove('active');
            
            // Pindah ke slide berikutnya
            currentSlide = (currentSlide + 1) % slides.length;
            
            // Tampilkan slide berikutnya
            slides[currentSlide].classList.add('active');
        }, 5000); // Ganti gambar setiap 5 detik (5000 milidetik)
    }
});</script>
</body>
</html>
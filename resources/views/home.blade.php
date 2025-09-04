    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Undangan Pernikahan Digital Impianmu</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary-color: #A0522D; /* Rusty Rose / Warm Brown - lebih romantis */
                --secondary-color: #F8F4EA; /* Off-white / Cream */
                --accent-color: #D4AF37; /* Gold / Emas */
                --text-color: #4A4A4A; /* Abu-abu tua */
                --light-text-color: #777;
                --heading-font: 'Playfair Display', serif;
                --body-font: 'Lora', serif; /* Mengganti Montserrat dengan Lora */
            }
            
            /* Global Styles */
            body {
                margin: 0;
                font-family: var(--body-font);
                color: var(--text-color);
                line-height: 1.7;
                background-color: var(--secondary-color); /* Background default */
            }
            .container {
                max-width: 1200px; /* Lebar container sedikit lebih besar */
                margin: 0 auto;
                padding: 0 25px;
            }
            a {
                text-decoration: none;
                color: var(--primary-color);
            }

            /* Background Slideshow */
            #background-slideshow {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: -2; /* Posisikan lebih jauh di belakang */
                list-style: none;
                padding: 0;
                margin: 0;
                overflow: hidden; /* Pastikan tidak ada scrollbar dari sini */
            }
            #background-slideshow .slide {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                background-size: cover;
                background-position: center center;
                opacity: 0;
                transition: opacity 2s ease-in-out;
                filter: brightness(0.7); /* Tambahkan sedikit gelap pada gambar */
            }
            #background-slideshow .slide.active {
                opacity: 1;
            }

            /* Header & Navigasi */
            .main-header {
                background: rgba(255, 255, 255, 0.95); /* Sedikit transparan */
                padding: 1rem 0;
                box-shadow: 0 2px 10px rgba(0,0,0,0.08);
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
                font-size: 1.8rem; /* Logo sedikit lebih besar */
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 700;
            }
            .auth-links a {
                margin-left: 2rem;
                font-weight: 600;
                color: var(--primary-color);
                text-decoration: none;
                transition: color 0.3s ease;
            }
            .auth-links a:hover {
                color: var(--accent-color);
            }

            /* Hero Section */
            .hero {
                height: 90vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                color: #fff;
                padding: 20px;
                position: relative;
                z-index: 1; /* Di atas slideshow */
            }
            .hero::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5); /* Lapisan gelap lebih pekat */
                z-index: -1;
            }
            .hero h1 {
                font-family: var(--heading-font);
                font-size: 4rem; /* Judul lebih besar */
                margin-bottom: 0.8rem;
                line-height: 1.1;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Tambah bayangan teks */
            }
            .hero p {
                font-size: 1.3rem;
                max-width: 700px;
                margin-bottom: 2.5rem;
                font-weight: 300;
            }
            .cta-button {
                background: var(--accent-color); /* Warna gold untuk CTA */
                color: #fff;
                padding: 18px 35px;
                text-decoration: none;
                border-radius: 50px; /* Bentuk tombol lebih lembut */
                font-weight: bold;
                font-size: 1.2rem;
                transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            }
            .cta-button:hover {
                transform: translateY(-5px);
                background: #c29b28; /* Warna gold sedikit lebih gelap saat hover */
                box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            }

            /* Sections */
            .section {
                padding: 80px 0; /* Padding lebih besar */
                text-align: center;
                position: relative;
                z-index: 2; /* Agar di atas background */
                background-color: var(--secondary-color); /* Default background untuk section */
            }
            .section-title {
                font-family: var(--heading-font);
                font-size: 3.2rem; /* Judul section lebih besar */
                margin-bottom: 1.5rem;
                color: var(--primary-color);
                position: relative;
                display: inline-block; /* Untuk underline */
            }
            .section-title::after {
                content: '';
                position: absolute;
                left: 50%;
                bottom: -10px;
                transform: translateX(-50%);
                width: 80px;
                height: 3px;
                background-color: var(--accent-color); /* Garis bawah emas */
                border-radius: 2px;
            }
            .section-subtitle {
                font-size: 1.15rem;
                max-width: 700px;
                margin: 0 auto 50px auto;
                color: var(--light-text-color);
            }
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Kolom lebih lebar */
                gap: 40px; /* Jarak antar kartu lebih besar */
                text-align: left;
            }
            .feature-card {
                background: #fff;
                padding: 35px; /* Padding kartu lebih besar */
                border-radius: 12px; /* Sudut lebih melengkung */
                box-shadow: 0 8px 25px rgba(0,0,0,0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                display: flex; /* Untuk ikon di samping judul */
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            }
            .feature-card i {
                font-size: 3rem; /* Ukuran ikon lebih besar */
                color: var(--primary-color);
                margin-bottom: 20px;
            }
            .feature-card h3 {
                font-family: var(--heading-font);
                font-size: 1.8rem;
                margin-top: 0;
                color: var(--primary-color);
                margin-bottom: 15px;
            }
            .feature-card p {
                color: var(--text-color);
                font-size: 1rem;
            }

            /* Pricing Section */
            #pricing {
                background-color: #fff; /* Pricing section background putih */
            }
            .pricing-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 30px;
                margin-top: 60px;
                align-items: stretch; /* Agar tinggi kartu sama */
            }
            .pricing-card {
                background: var(--secondary-color); /* Kartu pricing off-white */
                padding: 30px 20px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.06);
                text-align: center;
                transition: transform 0.3s, box-shadow 0.3s;
                position: relative;
                border: 1px solid rgba(var(--primary-color), 0.1);
                display: flex;
                flex-direction: column;
            }
            .pricing-card:hover {
                transform: translateY(-12px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            }
            .pricing-card.featured {
                background: linear-gradient(135deg, var(--primary-color) 0%, #8b4513 100%); /* Gradient untuk featured */
                color: #fff;
                transform: scale(1.07);
                border: none;
                box-shadow: 0 15px 40px rgba(0,0,0,0.25);
            }
            .pricing-card.featured .package-name,
            .pricing-card.featured .package-price .price,
            .pricing-card.featured .package-price .original-price {
                color: #fff;
            }
            .pricing-card.featured .cta-button {
                background: var(--accent-color);
                color: var(--primary-color); /* Warna teks tombol gold */
            }
            .pricing-card.featured .cta-button:hover {
                background: #e6c148;
            }
            .pricing-card.featured .package-features i {
                color: #fff;
            }
            .featured-badge {
                position: absolute;
                top: -20px;
                left: 50%;
                transform: translateX(-50%) rotate(-5deg); /* Sedikit rotasi */
                background: var(--accent-color);
                color: var(--primary-color);
                padding: 8px 20px;
                border-radius: 50px;
                font-size: 0.9em;
                font-weight: bold;
                box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            }
            .package-name {
                font-family: var(--heading-font);
                font-size: 1.8rem;
                color: var(--primary-color);
                margin-bottom: 1.2rem;
            }
            .package-price {
                margin-bottom: 1rem;
            }
            .package-price .price {
                font-size: 2.2rem; /* Harga lebih besar */
                font-weight: bold;
                color: var(--primary-color);
                display: block;
                margin-bottom: 0.5rem;
            }
            .package-price .original-price {
                color: var(--light-text-color);
                text-decoration: line-through;
                font-size: 1rem;
            }
            .pricing-card.featured .package-price .original-price {
                color: rgba(255, 255, 255, 0.7);
            }
            .package-features {
                list-style: none;
                padding: 0;
                margin: 25px 0 30px 0;
                text-align: left;
                flex-grow: 1; /* Agar mengambil ruang yang tersedia */
            }
            .package-features li {
                margin-bottom: 12px;
                display: flex;
                align-items: center;
                font-size: 1.05rem;
            }
            .package-features li.disabled {
                color: #b0b0b0;
                text-decoration: line-through;
            }
            .package-features i {
                margin-right: 12px;
                font-size: 1.1rem;
                color: #3cb371; /* Warna hijau yang lebih lembut */
            }
            .pricing-card.featured .package-features i {
                color: var(--accent-color); /* Ikon di featured card warna gold */
            }
            .package-features li.disabled i {
                color: #dc6a6a; /* Merah yang lebih lembut */
            }
            .package-button {
                width: 100%;
                display: block;
                margin-top: auto; /* Selalu di bawah */
            }

            /* How it Works Section */
            #how-it-works .feature-card {
                background: #fff;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                border: 1px solid #eee;
            }
            #how-it-works .feature-card h3 {
                position: relative;
                padding-bottom: 15px;
                margin-bottom: 20px;
                color: var(--primary-color);
            }
            #how-it-works .feature-card h3::before {
                content: attr(data-step); /* Mengambil data-step dari atribut */
                position: absolute;
                top: -30px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 3.5rem;
                font-family: var(--heading-font);
                color: rgba(var(--primary-color), 0.1); /* Warna transparan */
                z-index: -1;
                font-weight: 700;
            }

            /* Footer */
            .main-footer {
                background: var(--primary-color); /* Footer dengan warna utama */
                color: #fff;
                text-align: center;
                padding: 30px 0;
                font-size: 1rem;
            }
            .main-footer p {
                margin: 0;
            }

            /* Responsiveness */
            @media (max-width: 768px) {
                .main-nav {
                    flex-direction: column;
                }
                .auth-links {
                    margin-top: 1rem;
                }
                .auth-links a {
                    margin: 0 0.8rem;
                }
                .hero h1 {
                    font-size: 2.8rem;
                }
                .hero p {
                    font-size: 1rem;
                }
                .cta-button {
                    padding: 12px 25px;
                    font-size: 1rem;
                }
                .section-title {
                    font-size: 2.2rem;
                }
                .section-subtitle {
                    font-size: 1rem;
                }
                .features-grid, .pricing-grid {
                    grid-template-columns: 1fr;
                    gap:20px;
                }
                .pricing-card {
                    padding: 30px 20px;
                }
                .pricing-card.featured {
                    transform: scale(1);
                }
                .package-name {
                    font-size: 1.8 rem;
                }
                .package-price .price {
                    font-size: 2.8rem;
                }
            }
            @media (max-width: 480px) {
                .logo {
                    font-size: 1.5rem;
                }
                .auth-links a {
                    margin: 0 0.5rem;
                }
                .hero h1 {
                    font-size: 2.3rem;
                }
                .section-title {
                    font-size: 1.8rem;
                }
                .section {
                    padding: 50px 0;
                }
            }
        </style>
    </head>
    <body>
        @include('layouts.partials.navbar') {{-- Asumsi navbar ini sudah terintegrasi atau Anda akan menyesuaikannya --}}
        
        <div id="background-slideshow">
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1532712938310-34cb3982ef74');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1439539698758-ba2680ecadb9');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1583939411023-14783179e581');"></div>
        </div>
        
        <main>
            <section class="hero">
                <h1>Ciptakan Undangan Digital yang Tak Terlupakan</h1>
                <p>Jadikan hari spesial Anda semakin istimewa dengan undangan pernikahan digital yang elegan, mudah dibuat, dan penuh gaya.</p>
                <a href="{{ route('register') }}" class="cta-button">Buat Undangan Sekarang →</a>
            </section>

            <section id="features" class="section">
                <div class="container">
                    <h2 class="section-title">Mengapa Memilih Kami?</h2>
                    <p class="section-subtitle">Kami menyediakan semua yang Anda butuhkan untuk undangan digital yang sempurna, dirancang dengan cinta dan perhatian.</p>
                    <div class="features-grid">
                        <div class="feature-card">
                            <i class="fas fa-gem"></i>
                            <h3>Desain Eksklusif & Elegan</h3>
                            <p>Pilih dari koleksi template premium yang dirancang khusus untuk memukau tamu Anda. Setiap desain adalah karya seni.</p>
                        </div>
                        <div class="feature-card">
                            <i class="fas fa-sliders-h"></i>
                            <h3>Kustomisasi Tanpa Batas</h3>
                            <p>Personalikan setiap detail: dari font, warna, foto, hingga musik latar. Buat undangan yang benar-benar unik milik Anda.</p>
                        </div>
                        <div class="feature-card">
                            <i class="fas fa-heart-pulse"></i>
                            <h3>Manajemen RSVP Cerdas</h3>
                            <p>Lacak konfirmasi kehadiran tamu dengan mudah, kirim pengingat, dan terima ucapan selamat secara real-time.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="pricing" class="section">
                <div class="container">
                    <h2 class="section-title">Pilih Paket Impian Anda</h2>
                    <p class="section-subtitle">Temukan paket yang paling sesuai dengan gaya dan kebutuhan pernikahan Anda. Transparan, tanpa biaya tersembunyi.</p>
                    
                    <div class="pricing-grid">
                        {{-- Asumsi data $packages tersedia dari controller Laravel --}}
                        @forelse($packages as $package)
                            <div class="pricing-card {{ $package->is_featured ? 'featured' : '' }}">
                                @if($package->is_featured)
                                    <div class="featured-badge">Pilihan Favorit</div>
                                @endif
                                
                                <h3 class="package-name">{{ $package->name }}</h3>
                                <div class="package-price">
                                    <span class="price">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                    @if($package->value && $package->value > $package->price)
                                        <span class="original-price">Rp {{ number_format($package->value, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <ul class="package-features">
                                    <li><i class="fas fa-check-circle"></i> {{ $package->max_guests }} Tamu Undangan</li>
                                    <li><i class="fas fa-check-circle"></i> {{ $package->count_gallery }} Foto Galeri</li>
                                    <li class="{{ $package->has_love_story ? '' : 'disabled' }}"><i class="fas {{ $package->has_love_story ? 'fa-check-circle' : 'fa-times-circle' }}"></i> Kisah Cinta</li>
                                    <li class="{{ $package->has_music ? '' : 'disabled' }}"><i class="fas {{ $package->has_music ? 'fa-check-circle' : 'fa-times-circle' }}"></i> Musik Latar</li>
                                    <li class="{{ $package->has_rsvp ? '' : 'disabled' }}"><i class="fas {{ $package->has_rsvp ? 'fa-check-circle' : 'fa-times-circle' }}"></i> RSVP & Buku Tamu</li>
                                    <li class="{{ $package->has_live_streaming ? '' : 'disabled' }}"><i class="fas {{ $package->has_live_streaming ? 'fa-check-circle' : 'fa-times-circle' }}"></i> Live Streaming Acara</li>
                                </ul>
                                <a href="{{ route('register') }}" class="cta-button package-button">Pilih Paket Ini</a>
                            </div>
                        @empty
                            <p>Paket harga akan segera tersedia. Mohon kembali lagi nanti!</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="how-it-works" class="section">
                <div class="container">
                    <h2 class="section-title">Hanya 3 Langkah Mudah</h2>
                    <p class="section-subtitle">Proses pembuatan undangan digital Anda semudah menghitung 1, 2, 3!</p>
                    <div class="features-grid">
                        <div class="feature-card">
                            <h3 data-step="">Mulai Dengan Akun</h3>
                            <p>Daftarkan akun Anda secara gratis untuk mengakses semua fitur kami dan simpan progres undangan Anda.</p>
                        </div>
                        <div class="feature-card">
                            <h3 data-step="">Kreasi & Kustomisasi</h3>
                            <p>Pilih desain favorit Anda, lalu personalisasikan dengan detail kisah cinta dan momen berharga Anda.</p>
                        </div>
                        <div class="feature-card">
                            <h3 data-step="">Bagikan Bahagia Anda</h3>
                            <p>Setelah sempurna, dapatkan tautan undangan unik Anda dan sebarkan ke seluruh daftar tamu via berbagai platform.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="main-footer">
            <div class="container">
                <p>&copy; 2025 NikahYuk. Hak Cipta Dilindungi.</p>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                    }, 7000); // Ganti gambar setiap 7 detik
                }
            });
        </script>
    </body>
    </html>
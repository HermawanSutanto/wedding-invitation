@php
    // Logika untuk menentukan action form dengan aman
    $formAction = '#'; // Default action jika tidak ada undangan
    if (isset($invitation) && !empty($invitation->id)) {
        $formAction = route('guestbook.store', $invitation);
    }
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedding Invitation | {{ $invitation->groom_name ?? '' }} & {{ $invitation->bride_name ?? '' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- Particles.js for hero section -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <!-- AOS - Animate On Scroll Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
       :root {
            /* Definisikan URL gambar untuk mobile (menggunakan cover_image) */
            --bg-mobile: url('{{ asset('storage/' . ($invitation->cover_image ?? 'images/defaults/default-cover.webp')) }}');
            
            /* Definisikan URL gambar untuk desktop (menggunakan hero_image) */
            --bg-desktop: url('{{ asset('storage/' . ($invitation->hero_image ?? 'images/defaults/default-hero.webp')) }}');
        }
      header{
          background-image: var(--bg-mobile);
      }
      header#home {
          /* Properti yang sudah ada (mengambil dari variabel) */
          background-image: var(--bg-mobile); /* Default untuk mobile */

          /* --- TAMBAHKAN 3 BARIS DI BAWAH INI --- */
          
          /* 1. Membuat gambar menutupi seluruh area tanpa merusak rasio */
          background-size: cover;
          
          /* 2. Memposisikan gambar di tengah-tengah */
          background-position: center center;
          
          /* 3. Mencegah gambar berulang */
          background-repeat: no-repeat;
      }
      body {
        font-family: 'Raleway', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background-color: #f8f8f8;
        color: #333;
        tracking-wide;
        overflow-x: hidden;
      }
      h1, h2, h3, h4, h5, h6, .font-serif {
        font-family: 'Playfair Display', serif;
      }
      .fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
      }
      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .fade-in {
         animation: fadeIn 0.3s ease-in-out forwards;
      }
      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }
      section.visible {
        opacity: 1;
      }
      
      /* Decorative elements */
      .floral-divider {
        position: relative;
        height: 40px;
        margin: 2rem 0;
        background-image: url('{{ asset('storage/' . 'images/invitations/floral_decoration.svg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        opacity: 0.7;
      }
      
      /* Parallax effect */
      .parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      
      /* Enhanced hover animations */
      .hover-float {
        transition: transform 0.3s ease;
      }
      .hover-float:hover {
        transform: translateY(-5px);
      }
      
      /* Animated background gradient */
      .gradient-bg {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
      }
      @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
      }
      
      /* Floating animation */
      .floating {
        animation: floating 3s ease-in-out infinite;
      }
      @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
      }
      
      /* Shine effect */
      .shine {
        position: relative;
        overflow: hidden;
      }
      .shine::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: rotate(30deg);
        animation: shine 6s infinite;
      }
      @keyframes shine {
        0% { transform: rotate(30deg) translateX(-100%); }
        100% { transform: rotate(30deg) translateX(100%); }
      }
      @media (min-width: 768px) {
          header#home {
              /* Ganti dengan gambar untuk desktop */
              background-image: var(--bg-desktop);
          }
      }
      /* Particles container */
      #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
      }
    </style>
</head>
<body>
    <!-- Music Player -->
    <div id="music-player" class="fixed bottom-4 right-4 z-50 bg-white/80 backdrop-blur-md shadow-md rounded-full p-3 cursor-pointer hover-float">
      <audio id="bg-music" loop preload="auto">
        <source src="{{ asset('audio/background-music.mp3') }}" type="audio/mpeg">
      </audio>
      <div id="play-button" class="text-gray-800 hover:text-gray-600 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
      </div>
      <div id="pause-button" class="hidden text-gray-800 hover:text-gray-600 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
      </div>
    </div>
    
    <!-- Navigation Bar -->
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md shadow-md transition-transform duration-500 ease-in-out -translate-y-full">
      <div class="max-w-5xl mx-auto px-6">
        <div id="nav-links" class="flex justify-center items-center h-20">
          <!-- JS will populate this -->
        </div>
      </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <header id="home" class=" relative h-screen flex flex-col justify-center items-center text-white text-center p-6">
            <div id="particles-js" class="absolute inset-0 z-0"></div>
            <div id="hero-bg" class="absolute inset-0 bg-cover bg-center filter grayscale parallax "></div>
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 fade-in-up">
                <div class="floating shine">
                    <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-32 h-auto mx-auto mb-4 opacity-70">
                </div>
                <p class="text-lg sm:text-xl tracking-wider mb-4">The Wedding Of</p>
                <h1 id="hero-couple-names" class="text-6xl sm:text-8xl font-serif shine">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
                <div class="h-px w-20 bg-white/50 mx-auto my-8"></div>
                <p id="hero-date" class="text-lg sm:text-xl font-semibold tracking-wider"></p>
                <div class="mt-12">
                    <p class="text-base sm:text-lg">Kepada Yth.</p>
                    <p id="hero-guest-name" class="text-2xl sm:text-3xl font-bold mt-2"></p>
                </div>
                <div class="floating shine">
                    <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-32 h-auto mx-auto mt-8 opacity-70 rotate-180">
                </div>
            </div>
        </header>

        <!-- Quote Section -->
        <section id="quote" class="py-24 px-6 sm:px-12 text-center bg-white transition-opacity duration-1000 ease-in opacity-0">
          <div class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <div class="floral-divider"></div>
            <blockquote id="quote-text" class="text-2xl sm:text-3xl font-serif italic text-gray-700 leading-relaxed relative px-12">
              <span class="absolute left-0 top-0 text-7xl text-gray-200 font-serif -mt-4">"</span>
              <span class="absolute right-0 bottom-0 text-7xl text-gray-200 font-serif -mb-8">"</span>
            </blockquote>
            <p id="quote-source" class="mt-6 text-lg text-gray-600"></p>
            <div class="floral-divider"></div>
          </div>
        </section>
        
        <!-- Couple Section -->
        <section id="couple" class="py-24 px-6 sm:px-12 bg-gray-50 transition-opacity duration-1000 ease-in opacity-0">
          <div class="text-center" data-aos="fade-up" data-aos-duration="800">
            <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-24 h-auto mx-auto mb-4 opacity-70">
            <h2 class="text-4xl sm:text-5xl font-serif text-center text-gray-800 uppercase tracking-widest pb-4 mb-4">The Couple</h2>
            <div class="h-px w-40 bg-gray-300 mx-auto mb-12 sm:mb-16"></div>
          </div>
          <div id="couple-container" class="flex flex-col md:flex-row justify-center items-center gap-12 md:gap-24">
            
          </div>
        </section>

        <!-- Story Section (Conditional) -->
        <section id="story" class="hidden py-24 px-6 sm:px-12 bg-white transition-opacity duration-1000 ease-in opacity-0">
           <div class="text-center" data-aos="fade-up" data-aos-duration="800">
             <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-24 h-auto mx-auto mb-4 opacity-70">
             <h2 class="text-4xl sm:text-5xl font-serif text-center text-gray-800 uppercase tracking-widest pb-4 mb-4">Our Story</h2>
             <div class="h-px w-40 bg-gray-300 mx-auto mb-12 sm:mb-16"></div>
           </div>
           <div class="relative">
             <div class="absolute left-5 md:left-1/2 w-0.5 h-full bg-gray-200 -translate-x-1/2 gradient-bg"></div>
             <div id="story-container" class="space-y-8">
               <!-- JS will populate this -->
             </div>
           </div>
        </section>

        <!-- Event Section -->
        <section id="event" class="py-24 px-6 sm:px-12 bg-gray-50 transition-opacity duration-1000 ease-in opacity-0">
           <div class="text-center" data-aos="fade-up" data-aos-duration="800">
             <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-24 h-auto mx-auto mb-4 opacity-70">
             <h2 class="text-4xl sm:text-5xl font-serif text-center text-gray-800 uppercase tracking-widest pb-4 mb-4">Wedding Event</h2>
             <div class="h-px w-40 bg-gray-300 mx-auto mb-12 sm:mb-16"></div>
           </div>
           <div id="event-container" class="flex flex-wrap justify-center gap-8">
              <!-- JS will populate this -->
           </div>
        </section>

        <!-- Gallery Section (Conditional) -->
        <section id="gallery" class="hidden py-24 px-6 sm:px-12 bg-white transition-opacity duration-1000 ease-in opacity-0">
            <div class="text-center" data-aos="fade-up" data-aos-duration="800">
              <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-24 h-auto mx-auto mb-4 opacity-70">
              <h2 class="text-4xl sm:text-5xl font-serif text-center text-gray-800 uppercase tracking-widest pb-4 mb-4">Our Moments</h2>
              <div class="h-px w-40 bg-gray-300 mx-auto mb-12 sm:mb-16"></div>
            </div>
            <div id="gallery-container" class="grid grid-cols-2 md:grid-cols-3 gap-2 sm:gap-4" data-aos="fade-up" data-aos-delay="200">
                <!-- JS will populate this -->
            </div>
        </section>

        <!-- Gift Section (Conditional) -->
        <section id="gift" class="hidden py-24 px-6 sm:px-12 bg-gray-50 transition-opacity duration-1000 ease-in opacity-0">
            <div class="text-center" data-aos="fade-up" data-aos-duration="800">
              <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-24 h-auto mx-auto mb-4 opacity-70">
              <h2 class="text-4xl sm:text-5xl font-serif text-center text-gray-800 uppercase tracking-widest pb-4 mb-4">Wedding Gift</h2>
              <div class="h-px w-40 bg-gray-300 mx-auto mb-12 sm:mb-16"></div>
            </div>
            <div class="max-w-2xl mx-auto text-center" data-aos="fade-up" data-aos-delay="200">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" class="w-16 h-16 mx-auto text-gray-400 mb-4 floating"><polyline points="20 12 20 22 4 22 4 12" /><rect x="2" y="7" width="20" height="5" /><line x1="12" y1="22" x2="12" y2="7" /><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" /><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" /></svg>
                <p class="text-gray-600 mb-10">
                    Doa restu Anda adalah hadiah terindah bagi kami. Namun, jika Anda ingin memberikan tanda kasih, kami akan menerimanya dengan senang hati.
                </p>
                <div id="gift-container" class="flex flex-wrap justify-center gap-6">
                   <!-- JS will populate this -->
                </div>
            </div>
        </section>

        <!-- RSVP Section (Conditional) -->
        @if(($invitation->package)->has_rsvp)

        <section id="rsvp" class="hidden py-24 px-6 sm:px-12 bg-white transition-opacity duration-1000 ease-in opacity-0">
            <div class="text-center" data-aos="fade-up" data-aos-duration="800">
              <img src="{{ asset('storage/images/decoration/floral_decoration.svg') }}" alt="Floral decoration" class="w-24 h-auto mx-auto mb-4 opacity-70">
              <h2 class="text-4xl sm:text-5xl font-serif text-center text-gray-800 uppercase tracking-widest pb-4 mb-4">RSVP</h2>
              <div class="h-px w-40 bg-gray-300 mx-auto mb-12 sm:mb-16"></div>
            </div>
            <div class="max-w-2xl mx-auto">
                <div id="form-container" data-aos="fade-up" data-aos-delay="200">
                    <form 
                        id="rsvp-form" 
                        action="{{ $formAction }}" 
                        method="POST"
                        class="bg-white p-8 sm:p-10 border border-gray-200 shadow-xl space-y-6 hover-float"
                    >
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300" />
                        </div>
                        <div>
                            <label for="attendance_status" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Kehadiran</label>
                            <select name="attendance_status" required class="w-full px-4 py-3 border border-gray-300 bg-white">
                                <option value="" disabled selected>Pilih status...</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Tidak Hadir">Tidak Hadir</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Ucapan & Doa</label>
                            <textarea name="message" required rows="4" maxlength="500" class="w-full px-4 py-3 border border-gray-300"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gray-800 text-white px-6 py-4">Kirim Konfirmasi</button>
                    </form>

                </div>
                <div class="mt-16" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-3xl font-serif text-center text-gray-800 mb-8">Ucapan & Doa</h3>
                    <div class="max-h-96 overflow-y-auto space-y-4 pr-4 bg-gray-50 p-6 border">
                       <div id="guestbook-container">
                           <!-- JS will populate this -->
                       </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>
    

    <!-- Footer -->
    <footer id="footer" class="bg-gray-800 text-gray-300 text-center py-10 px-6">
       <!-- JS will populate this -->
    </footer>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-black/90 z-[100] items-center justify-center p-4 fade-in">
        <button id="lightbox-close" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <img id="lightbox-img" src="" alt="Gallery view" class="max-w-full max-h-full object-contain" />
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // --- DATA ---
    const oneMonthFromNow = new Date();
    oneMonthFromNow.setMonth(oneMonthFromNow.getMonth() + 1);
    const dummyData = {
      groom_name: 'Aditya',
      groom_info: 'Putra dari Bpk. Surya & Ibu. Chandra',
      groom_photo_path: 'https://picsum.photos/id/1005/400/400',
      bride_name: 'Kirana',
      bride_info: 'Putri dari Bpk. Bintang & Ibu. Purnama',
      bride_photo_path: 'https://picsum.photos/id/1011/400/400',
      hero_image: 'https://picsum.photos/id/1043/1920/1080',
      quote: 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri...',
      quote_source: 'QS. Ar-Rum: 21',
      events: [
        { title: 'Akad Nikah', event_date: oneMonthFromNow, start_time: '09:00', venue_name: 'Masjid Agung Al-Azhar', venue_address: 'Jl. Sisingamangaraja, Selong, Kebayoran Baru, Jakarta Selatan', google_maps_link: 'https://maps.app.goo.gl/9vJqFkCtL5qZ4x7p8', livestream_link: 'https://www.youtube.com/live/example1' },
        { title: 'Resepsi', event_date: oneMonthFromNow, start_time: '19:00', venue_name: 'Grand Ballroom Hotel Indonesia', venue_address: 'Jl. M.H. Thamrin No.1, Menteng, Jakarta Pusat', google_maps_link: 'https://maps.app.goo.gl/9vJqFkCtL5qZ4x7p8' },
      ],
      stories: [
        { title: 'Pertama Bertemu', story_date: 'Juni 2022', description: 'Kami bertemu di sebuah pameran seni, di mana ketertarikan pada lukisan yang sama membawa kami pada perbincangan pertama yang tak terlupakan.' },
        { title: 'Kencan Pertama', story_date: 'Juli 2022', description: 'Makan malam sederhana di bawah bintang menjadi saksi bisu awal dari cerita kami. Momen di mana kami tahu, ini adalah sesuatu yang istimewa.' },
        { title: 'Lamaran', story_date: 'Desember 2024', description: 'Di puncak bukit saat matahari terbenam, sebuah pertanyaan sederhana dan jawaban "Ya" mengikat janji kami untuk selamanya.' },
      ],
      galleries: [
        { image_path: 'https://picsum.photos/id/10/800/600', alt: 'Prewedding Photo 1' }, { image_path: 'https://picsum.photos/id/20/800/600', alt: 'Prewedding Photo 2' }, { image_path: 'https://picsum.photos/id/30/800/600', alt: 'Prewedding Photo 3' }, { image_path: 'https://picsum.photos/id/40/800/600', alt: 'Prewedding Photo 4' }, { image_path: 'https://picsum.photos/id/50/800/600', alt: 'Prewedding Photo 5' }, { image_path: 'https://picsum.photos/id/60/800/600', alt: 'Prewedding Photo 6' },
      ],
      gifts: [
        { bank_name: 'Bank Central Asia (BCA)', account_number: '1234567890', account_holder_name: 'Aditya & Kirana' },
        { bank_name: 'Bank Mandiri', account_number: '0987654321', account_holder_name: 'Aditya & Kirana' },
      ],
      guestbooks : [
        { name: 'Budi Santoso', attendance_status: 'Hadir', message: 'Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin.', created_at: new Date(Date.now() - 2 * 60 * 60 * 1000) },
        { name: 'Citra Lestari', attendance_status: 'Hadir', message: 'Happy wedding! Semoga cinta kalian abadi selamanya. Turut berbahagia.', created_at: new Date(Date.now() - 5 * 60 * 60 * 1000) },
      ],
      package: { has_love_story: true, has_rsvp: true, has_live_streaming: true },
    };

    const invitationData = @json($invitation) || dummyData;
    console.log(invitationData);

    // --- HELPERS ---
    const formatDate = (date) => new Date(date).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    const timeSince = (date) => {
        const seconds = Math.floor((new Date() - new Date(date)) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) return Math.floor(interval) + " tahun lalu";
        interval = seconds / 2592000;
        if (interval > 1) return Math.floor(interval) + " bulan lalu";
        interval = seconds / 86400;
        if (interval > 1) return Math.floor(interval) + " hari lalu";
        interval = seconds / 3600;
        if (interval > 1) return Math.floor(interval) + " jam lalu";
        interval = seconds / 60;
        if (interval > 1) return Math.floor(interval) + " menit lalu";
        return "Baru saja";
    };

    // --- DOM POPULATION ---
    const populateContent = () => {
        document.title = `Wedding Invitation | ${invitationData.groom_name} & ${invitationData.bride_name}`;
        
        // Hero
        document.getElementById('hero-bg').style.backgroundImage = `url(${invitationData.hero_image})`;
        document.getElementById('hero-couple-names').innerHTML = `${invitationData.groom_name} &amp; ${invitationData.bride_name}`;
        document.getElementById('hero-date').textContent = invitationData.events[0] ? formatDate(invitationData.events[0].event_date) : 'Segera Hadir';
        const guestName = new URLSearchParams(window.location.search).get('to') || 'Tamu Undangan';
        document.getElementById('hero-guest-name').textContent = guestName;

        // Quote
        document.getElementById('quote-text').innerHTML += invitationData.quote;
        document.getElementById('quote-source').textContent = `- ${invitationData.quote_source} -`;

        // Couple
        const coupleContainer = document.getElementById('couple-container');
        coupleContainer.innerHTML = `
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('storage/' . ($invitation->groom_photo_path ?? 'images/defaults/default-groom.webp')) }}" alt="Foto ${invitationData.groom_name}" class="w-48 h-48 sm:w-56 sm:h-56 object-cover rounded-full border-4 border-white shadow-lg filter grayscale hover:filter-none transition-all duration-500" />
                <h3 class="text-4xl font-serif text-gray-800 mt-6">${invitationData.groom_name}</h3>
                <p class="mt-2 text-gray-600 max-w-xs">${invitationData.groom_info}</p>
            </div>
            <div class="text-6xl font-serif text-gray-300 my-4 md:my-0">&amp;</div>
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('storage/' . ($invitation->bride_photo_path ?? 'images/defaults/default-bride.webp')) }}" alt="Foto ${invitationData.bride_name}" class="w-48 h-48 sm:w-56 sm:h-56 object-cover rounded-full border-4 border-white shadow-lg filter grayscale hover:filter-none transition-all duration-500" />
                <h3 class="text-4xl font-serif text-gray-800 mt-6">${invitationData.bride_name}</h3>
                <p class="mt-2 text-gray-600 max-w-xs">${invitationData.bride_info}</p>
            </div>
        `;

        // Story
        if (invitationData.package.has_love_story && invitationData.stories.length > 0) {
            document.getElementById('story').classList.remove('hidden');
            const storyContainer = document.getElementById('story-container');

            storyContainer.innerHTML = invitationData.stories.map((story, index) => {
                const isOdd = index % 2 === 0; // Item pertama (index 0) akan dianggap GANJIL

                // Card konten cerita yang akan digunakan di kedua layout
                const contentHtml = `
                    <div class="transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1 bg-white p-6 rounded-lg shadow-md border border-gray-200 ">
                        <h3 class="text-2xl font-serif text-gray-800">${story.title}</h3>
                        <time class="text-sm italic text-gray-500 mb-2 block">${story.story_date}</time>
                        <p class="text-gray-600">${story.description}</p>
                    </div>
                `;

                // Menggabungkan layout mobile dan desktop dalam satu komponen
                return `
                    <div class="relative group cursor-pointer">
                        <div class="flex items-start gap-4 md:hidden">
                            <div class="relative z-10 mt-1 shrink-0">
                                <div class="transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1 flex items-center justify-center w-10 h-10 rounded-full border-2 border-gray-300 bg-white">
                                    ${index + 1}
                                </div>
                            </div>
                            <div class="w-full">
                                ${contentHtml}
                            </div>
                        </div>

                        <div class="hidden md:flex ${isOdd ? '' : 'flex-row-reverse'} items-start">
                            <div class="w-1/2 ${isOdd ? 'pl-8' : 'pr-8 text-right'}">
                                ${contentHtml}
                            </div>

                            <div class="w-10 shrink-0"></div>

                            <div class="w-1/2"></div>
                        </div>
                        
                        <div class="hidden md:block absolute top-1 left-1/2 -translate-x-1/2 z-10">
                            <div class="transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1 flex items-center justify-center w-10 h-10 rounded-full border-2 border-gray-300 bg-white">
                                ${index + 1}
                            </div>
                        </div>
                    </div>
                `;

            }).join('');
        }
        // Event
        const eventContainer = document.getElementById('event-container');
        eventContainer.innerHTML = invitationData.events.map(event => `
            <div class="bg-white p-8 border border-gray-200 shadow-lg text-center flex-1 min-w-[300px] transition-transform duration-300 hover:-translate-y-2">
                <h3 class="text-4xl font-serif text-gray-800 mb-6">${event.title}</h3>
                <div class="space-y-4 text-gray-600">
                    <div class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-3 text-gray-500"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg><span>${formatDate(event.event_date)}</span></div>
                    <div class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-3 text-gray-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><span>Pukul ${event.start_time} WIB</span></div>
                    <div class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-3 text-gray-500"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg><span>${event.venue_name}</span></div>
                    <p class="text-sm px-4">${event.venue_address}</p>
                </div>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                    ${event.google_maps_link ? `<a href="${event.google_maps_link}" target="_blank" rel="noopener noreferrer" class="inline-block bg-gray-800 text-white px-6 py-3 uppercase text-sm font-semibold tracking-wider hover:bg-gray-700 transition-colors">Lihat Peta</a>` : ''}
                    ${event.livestream_link ? `<a href="${event.livestream_link}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-red-600 text-white px-6 py-3 uppercase text-sm font-semibold tracking-wider hover:bg-red-500 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mr-2"><path d="M2.5 17a24.12 24.12 0 0 1 0-10C2.5 6 7.5 4 12 4s9.5 2 9.5 3a24.12 24.12 0 0 1 0 10c0 1-4.5 3-9.5 3s-9.5-2-9.5-3Z"/><path d="m10 15 5-3-5-3z"/></svg>Tonton Live</a>` : ''}
                </div>
            </div>
        `).join('');
        

        // --- Blok JavaScript Galeri dengan Fallback Dummy ---

        // 1. Definisikan data galeri dummy Anda
        const dummyGalleries = [
            { image_path: 'https://picsum.photos/id/10/800/600', alt: 'Prewedding Photo 1' }, 
            { image_path: 'https://picsum.photos/id/20/800/600', alt: 'Prewedding Photo 2' }, 
            { image_path: 'https://picsum.photos/id/30/800/600', alt: 'Prewedding Photo 3' }, 
            { image_path: 'https://picsum.photos/id/40/800/600', alt: 'Prewedding Photo 4' }, 
            { image_path: 'https://picsum.photos/id/50/800/600', alt: 'Prewedding Photo 5' }, 
            { image_path: 'https://picsum.photos/id/60/800/600', alt: 'Prewedding Photo 6' },
        ];

        // 2. Tentukan data mana yang akan dirender
        const galleriesToRender = (invitationData && invitationData.galleries && invitationData.galleries.length > 0) 
            ? invitationData.galleries 
            : dummyGalleries;

        // 3. Render galeri jika ada data (baik asli maupun dummy)
        if (galleriesToRender.length > 0) {
            document.getElementById('gallery').classList.remove('hidden');
            const galleryContainer = document.getElementById('gallery-container');
            const storageBaseUrl = "{{ asset('storage') }}/";

            galleryContainer.innerHTML = galleriesToRender.map(item => {
                // 4. Logika untuk menangani URL absolut (dummy) dan path relatif (server)
                let imageUrl;
                if (item.image_path.startsWith('http')) {
                    // Jika sudah URL lengkap (dari data dummy), gunakan langsung
                    imageUrl = item.image_path;
                } else {
                    // Jika hanya path (dari server), gabungkan dengan base URL
                    imageUrl = storageBaseUrl + item.image_path;
                }
                
                return `
                    <div class="overflow-hidden cursor-pointer group" data-src="${imageUrl}">
                        <img src="${imageUrl}" alt="${item.alt || 'Gallery Image'}" class="w-full h-full object-cover aspect-square filter grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500 ease-in-out" />
                    </div>
                `;
            }).join('');
        }

        // Gift
        if (invitationData.gifts.length > 0) {
            document.getElementById('gift').classList.remove('hidden');
            const giftContainer = document.getElementById('gift-container');
            giftContainer.innerHTML = invitationData.gifts.map(gift => `
                <div class="bg-white p-6 border border-gray-200 text-center flex-1 min-w-[280px]">
                    <h3 class="text-xl font-semibold text-gray-700">${gift.bank_name}</h3>
                    <p class="text-gray-500 text-sm mt-1 mb-4">${gift.account_holder_name}</p>
                    <div class="bg-gray-100 p-4 inline-flex items-center justify-center gap-4 rounded">
                        <span class="text-lg font-mono text-gray-800">${gift.account_number}</span>
                        <button data-copy="${gift.account_number}" title="Salin Nomor Rekening" class="copy-btn text-gray-500 hover:text-gray-800 transition-colors">
                            <span class="copy-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg></span>
                            <span class="check-icon hidden"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-green-500"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // RSVP & Guestbook
        if (invitationData.package.has_rsvp) {
            document.getElementById('rsvp').classList.remove('hidden');
            renderGuestbook();
        }

        // Footer
        document.getElementById('footer').innerHTML = `
            <p class="text-lg mb-2">Terima kasih atas doa dan kehadiran Anda.</p>
            <p class="text-sm text-gray-400">&copy; ${new Date().getFullYear()} ${invitationData.groom_name} & ${invitationData.bride_name}. All Rights Reserved.</p>
        `;
    };

    const renderGuestbook = () => {
    const guestbookContainer = document.getElementById('guestbook-container');
    if (invitationData.guestbooks.length === 0) {
        guestbookContainer.innerHTML = `<p class="text-center text-gray-500">Belum ada ucapan.</p>`;
        return;
    }
    guestbookContainer.innerHTML = invitationData.guestbooks.map(entry => `
        <div class="bg-white p-5 border-l-4 border-gray-300">
            <div class="flex justify-between items-center">
                <p class="font-bold text-gray-800">${entry.name}</p>
                <span class="text-xs font-semibold px-2 py-1 rounded-full ${entry.attendance_status === 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                    ${entry.attendance_status}
                </span>
            </div>
            <p class="text-gray-600 my-2">"${entry.message}"</p>
            <small class="text-gray-400 italic">${timeSince(entry.created_at)}</small>
        </div>
    `).join('');
};
    
    // --- NAVIGATION ---
    const setupNavigation = () => {
        const nav = document.getElementById('main-nav');
        const navLinksContainer = document.getElementById('nav-links');
        
        let links = [
            { href: '#couple', text: 'Couple' },
            invitationData.package.has_love_story && { href: '#story', text: 'Story' },
            { href: '#event', text: 'Event' },
            invitationData.galleries.length > 0 && { href: '#gallery', text: 'Gallery' },
            invitationData.package.has_rsvp && { href: '#rsvp', text: 'RSVP' }
        ].filter(Boolean);

        navLinksContainer.innerHTML = `<ul class="flex items-center space-x-4 sm:space-x-8">${links.map(link => `<li><a href="${link.href}" class="nav-link font-semibold text-xs uppercase tracking-wider text-gray-600 hover:text-gray-900 transition-colors duration-300">${link.text}</a></li>`).join('')}</ul>`;

        // Scroll listener
        window.addEventListener('scroll', () => {
            if (window.scrollY > window.innerHeight * 0.8) {
                nav.classList.remove('-translate-y-full');
            } else {
                nav.classList.add('-translate-y-full');
            }
        });

        // Smooth scroll for links
        document.querySelectorAll('.nav-link').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const offset = nav.offsetHeight;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    };

    // --- INTERACTIVITY ---
    const setupInteractivity = () => {
        // Gallery Lightbox
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        document.getElementById('gallery-container').addEventListener('click', (e) => {
            const item = e.target.closest('[data-src]');
            if (item) {
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                lightboxImg.src = item.dataset.src;
            }
        });
        const closeLightbox = () => {
             lightbox.classList.add('hidden');
             lightbox.classList.remove('flex');
        }
        lightbox.addEventListener('click', closeLightbox);
        document.getElementById('lightbox-close').addEventListener('click', closeLightbox);

        // Gift Copy to Clipboard
        document.getElementById('gift-container').addEventListener('click', (e) => {
            const button = e.target.closest('.copy-btn');
            if(button) {
                navigator.clipboard.writeText(button.dataset.copy);
                const copyIcon = button.querySelector('.copy-icon');
                const checkIcon = button.querySelector('.check-icon');
                copyIcon.classList.add('hidden');
                checkIcon.classList.remove('hidden');
                setTimeout(() => {
                    copyIcon.classList.remove('hidden');
                    checkIcon.classList.add('hidden');
                }, 2000);
            }
        });

        // RSVP Form
        const rsvpForm = document.getElementById('rsvp-form');
        rsvpForm.addEventListener('submit', async (e) => {
          e.preventDefault();

          const formData = new FormData(rsvpForm);

          try {
              const response = await fetch(rsvpForm.action, {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  },
                  body: formData
              });

              const result = await response.json();

              if (result.success) {
                  invitationData.guestbooks.unshift(result.entry); // tambahkan ke array
                  // guestbookEntries.unshift(result.entry);
                  renderGuestbook();

                  // Tampilkan pesan sukses
                  document.getElementById('form-container').innerHTML = `
                      <div class="bg-green-50 border border-green-200 text-green-800 p-6 text-center">
                          <h3 class="text-xl font-semibold">Terima Kasih!</h3>
                          <p>Konfirmasi Anda berhasil dikirim.</p>
                      </div>
                  `;
              } else {
                  alert(result.message || 'Gagal mengirim RSVP.');
              }
          } catch (error) {
              console.error(error);
              alert('Terjadi kesalahan, silakan coba lagi.');
          }
      });

    };

    // --- ANIMATIONS ---
    const setupAnimations = () => {
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
        
        // Initialize particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#ffffff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' }, polygon: { nb_sides: 5 } },
                opacity: { value: 0.5, random: true, anim: { enable: false, speed: 1, opacity_min: 0.1, sync: false } },
                size: { value: 3, random: true, anim: { enable: false, speed: 40, size_min: 0.1, sync: false } },
                line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.4, width: 1 },
                move: { enable: true, speed: 2, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false, attract: { enable: false, rotateX: 600, rotateY: 1200 } }
            },
            interactivity: {
                detect_on: 'canvas',
                events: { onhover: { enable: true, mode: 'repulse' }, onclick: { enable: true, mode: 'push' }, resize: true },
                modes: { grab: { distance: 400, line_linked: { opacity: 1 } }, bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 3 }, repulse: { distance: 200, duration: 0.4 }, push: { particles_nb: 4 }, remove: { particles_nb: 2 } }
            },
            retina_detect: true
        });
        
        // Legacy section visibility
        const sections = document.querySelectorAll('section[id]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        sections.forEach(section => observer.observe(section));
    };

    // --- MUSIC PLAYER ---
    const setupMusicPlayer = () => {
        const musicPlayer = document.getElementById('music-player');
        const audio = document.getElementById('bg-music');
        const playButton = document.getElementById('play-button');
        const pauseButton = document.getElementById('pause-button');
        if (audio) {
                    audio.play().catch(e => console.error("Autoplay diblokir oleh browser."));
                    playButton.classList.add('hidden');
                    pauseButton.classList.remove('hidden');
                }
        musicPlayer.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                playButton.classList.add('hidden');
                pauseButton.classList.remove('hidden');
            } else if(audio.play) {
                audio.pause();
                pauseButton.classList.add('hidden');
                playButton.classList.remove('hidden');
            }
        });
    };
    // --- INITIALIZATION ---
    populateContent();
    setupNavigation();
    setupInteractivity();
    setupAnimations();
    setupMusicPlayer();
});
</script>
</body>
</html>

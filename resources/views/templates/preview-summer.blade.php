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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

    <script>
      // Custom Tailwind theme configuration
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'summer-bg': '#fdfaf5', // Warm cream background
              'summer-text': '#4a4a4a', // Dark warm gray
              'summer-terracotta': '#e2725b', // Burnt orange / terracotta
              'summer-gold': '#ffc700', // Bright gold accent
              'summer-green': '#556b2f', // Olive/Lush green
            },
            fontFamily: {
              sans: ['Montserrat', 'sans-serif'],
              serif: ['Playfair Display', 'serif'],
            }
          }
        }
      }
    </script>
    
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
            background-color: #fdfaf5;
            color: #4a4a4a;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-open {
            transform: translateX(0);
        }
        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (min-width: 768px) {
          header#home {
              /* Ganti dengan gambar untuk desktop */
              background-image: var(--bg-desktop);
          }
      }
    </style>
</head>
<body class="font-sans">
    <div id="music-player" class="fixed bottom-4 right-4 z-50 bg-summer-gold backdrop-blur-md shadow-md rounded-full p-3 cursor-pointer hover-float">
      <audio id="bg-music" loop preload="auto">
        <source src="{{ asset('audio/background-music.mp3') }}" type="audio/mpeg">
      </audio>
        <div id="play-button" class="text-white hover:text-white/80 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
      </div>
        <div id="pause-button" class="hidden text-white hover:text-white/80 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
      </div>
    </div>
    
    <!-- Golden Dust Canvas -->
    <canvas id="dust-canvas" class="fixed inset-0 z-0 pointer-events-none"></canvas>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-summer-bg/90 backdrop-blur-lg shadow-2xl z-50 flex-col items-center justify-center space-y-8 text-center p-6 -translate-x-full md:translate-x-0 md:flex">
        <a href="#home" class="font-serif text-5xl text-summer-terracotta mb-8">A&R</a>
        <div id="nav-menu" class="flex flex-col space-y-6 text-lg text-summer-text">
            <!-- JS will populate nav links -->
        </div>
    </aside>

    <!-- Mobile Menu Toggle -->
    <button id="mobile-menu-toggle" class="md:hidden fixed top-6 left-6 z-[60] text-summer-terracotta bg-summer-bg/80 p-2 rounded-full shadow-md">
        <svg id="menu-open-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        <svg id="menu-close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    
    <main class="relative z-10 md:ml-64">
        <!-- Hero Section -->
        <header id="home" class="h-screen flex flex-col justify-center items-center text-center p-6 relative bg-cover bg-center bg-no-repeat">
            <div class="absolute inset-0 bg-black/30 z-0"></div>
            <div class="fade-in z-10">
                <h1 id="hero-couple-names" class="text-7xl sm:text-9xl font-serif text-white">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
                <p class="text-lg sm:text-xl text-summer-gold tracking-widest mt-4 mb-2">ARE GETTING MARRIED</p>
                <p id="hero-date" class="text-xl sm:text-2xl font-semibold text-white mb-8"></p>
                
                <!-- Countdown Timer -->
                <div id="countdown-container" class="flex justify-center space-x-4 sm:space-x-8 text-white">
                    <div>
                        <p id="countdown-days" class="text-4xl sm:text-5xl font-bold">00</p>
                        <p class="text-xs sm:text-sm uppercase tracking-wider">Days</p>
                    </div>
                    <div>
                        <p id="countdown-hours" class="text-4xl sm:text-5xl font-bold">00</p>
                        <p class="text-xs sm:text-sm uppercase tracking-wider">Hours</p>
                    </div>
                    <div>
                        <p id="countdown-minutes" class="text-4xl sm:text-5xl font-bold">00</p>
                        <p class="text-xs sm:text-sm uppercase tracking-wider">Minutes</p>
                    </div>
                    <div>
                        <p id="countdown-seconds" class="text-4xl sm:text-5xl font-bold">00</p>
                        <p class="text-xs sm:text-sm uppercase tracking-wider">Seconds</p>
                    </div>
                </div>
                
                <div class="mt-16">
                  <p class="text-white/80">To the respected,</p>
                  <p id="hero-guest-name" class="text-2xl font-bold mt-1 text-white"></p>
                </div>
            </div>
        </header>

        <div class="space-y-12 sm:space-y-24">
            <!-- Quote Section -->
            <section id="quote" class="pt-24 px-6 sm:px-12">
              <div class="max-w-4xl mx-auto text-center">
                <blockquote id="quote-text" class="text-2xl sm:text-3xl font-serif text-summer-text leading-relaxed relative"></blockquote>
                <p id="quote-source" class="mt-8 text-lg text-summer-terracotta font-semibold"></p>
              </div>
            </section>

            <!-- Couple Section -->
            <section id="couple" class="px-6 sm:px-12">
              <div id="couple-container" class="max-w-5xl mx-auto space-y-20">
                <!-- JS will populate this -->
              </div>
            </section>
            
            <!-- Event Section -->
            <section id="event" class="px-6 sm:px-12 py-20 bg-summer-terracotta text-white">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-5xl sm:text-6xl font-serif text-center text-white mb-16">Wedding Details</h2>
                    <div id="event-container" class="grid grid-cols-1 md:grid-cols-2 gap-12">
                       <!-- JS will populate this -->
                    </div>
                </div>
            </section>

            <!-- Livestream Section (Conditional) -->
            <section id="livestream" class="hidden px-6 sm:px-12">
               <!-- JS will populate this -->
            </section>
            
            <!-- Story Section (Conditional & Vertical) -->
            <section id="story" class="hidden py-12 px-6 sm:px-12">
               <h2 class="text-5xl sm:text-6xl font-serif text-center text-summer-text mb-20">Our Journey</h2>
               <div id="story-container" class="relative max-w-sm md:max-w-3xl mx-auto">
                  <div class="absolute top-0 bottom-0 left-5 md:left-1/2 w-0.5 bg-summer-terracotta/20 -translate-x-1/2"></div>
                  <!-- JS will populate this -->
               </div>
            </section>
            
            <!-- Gallery Section (Conditional) -->
            <section id="gallery" class="hidden px-6 sm:px-12">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-5xl sm:text-6xl font-serif text-center text-summer-text mb-16">Captured Moments</h2>
                    <div id="gallery-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- JS will populate this -->
                    </div>
                </div>
            </section>

            <!-- Gift & RSVP Section (Combined) -->
            <section id="rsvp" class="hidden px-6 sm:px-12">
                <div class="max-w-5xl mx-auto bg-white p-8 sm:p-12 rounded-2xl shadow-lg grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Gift Section -->
                    <div id="gift-section" class="hidden">
                        <h2 class="text-4xl font-serif text-summer-text text-center mb-8">Wedding Gift</h2>
                        <p class="text-center text-summer-text/80 mb-8">Your presence is the most cherished gift. However, if you wish to give a token of love, it is gratefully received.</p>
                        <div id="gift-container" class="space-y-6">
                            <!-- JS will populate gifts -->
                        </div>
                    </div>
                    <!-- RSVP Form -->
                    <div id="rsvp-section" class="md:col-start-2">
                        <h2 class="text-4xl font-serif text-summer-text text-center mb-8">Confirm Attendance</h2>
                        <form  id="rsvp-form" 
                                action="{{ $formAction }}" 
                                method="POST" 
                                class="space-y-6">
                             <div>
                                <label for="name" class="block text-sm font-semibold text-summer-text/80 mb-2">Name</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 bg-summer-bg border border-summer-terracotta/20 rounded-md focus:ring-2 focus:ring-summer-terracotta focus:border-summer-terracotta outline-none transition-shadow" />
                            </div>
                            <div>
                                <label for="attendance_status" class="block text-sm font-semibold text-summer-text/80 mb-2">Will you be attending?</label>
                                <select name="attendance_status" required class="w-full px-4 py-3 bg-summer-bg border border-summer-terracotta/20 rounded-md focus:ring-2 focus:ring-summer-terracotta focus:border-summer-terracotta outline-none transition-shadow">
                                    <option value="" disabled selected>Please select...</option>
                                    <option value="Attending">Yes, with pleasure</option>
                                    <option value="Not Attending">Regretfully, I cannot</option>
                                </select>
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-semibold text-summer-text/80 mb-2">Send your wishes</label>
                                <textarea name="message" required rows="4" class="w-full px-4 py-3 bg-summer-bg border border-summer-terracotta/20 rounded-md focus:ring-2 focus:ring-summer-terracotta focus:border-summer-terracotta outline-none transition-shadow" maxLength="500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-summer-terracotta text-white px-6 py-4 font-bold tracking-wider rounded-md hover:bg-opacity-90 transition-colors">Send Wishes</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Guestbook Section -->
            <section id="guestbook" class="hidden px-6 sm:px-12">
                 <div class="max-w-3xl mx-auto">
                    <h2 class="text-5xl sm:text-6xl font-serif text-center text-summer-text mb-16">Wishes & Blessings</h2>
                    <div id="guestbook-container" class="space-y-6">
                        <!-- JS will populate wishes -->
                    </div>
                 </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer" class="text-center py-12 px-6 mt-16 text-summer-text/70 md:ml-64">
       <!-- JS will populate this -->
    </footer>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-summer-bg/95 z-[100] flex items-center justify-center p-4">
        <button id="lightbox-close" class="absolute top-6 right-6 text-summer-text hover:text-summer-terracotta transition-colors" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-9 h-9"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <img id="lightbox-img" src="" alt="Gallery view" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl" />
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // --- DATA ---
    const oneMonthFromNow = new Date();
    oneMonthFromNow.setMonth(oneMonthFromNow.getMonth() + 1);
    oneMonthFromNow.setHours(16, 0, 0, 0); // Set time to 16:00 for countdown

    const dummyData = {
      groom_name: 'Aris',
      groom_info: 'Son of Mr. Surya & Mrs. Chandra',
      groom_photo_path: 'https://picsum.photos/id/1027/800/800',
      bride_name: 'Rina',
      bride_info: 'Daughter of Mr. Bintang & Mrs. Purnama',
      bride_photo_path: 'https://picsum.photos/id/1011/800/800',
      hero_background_image: 'https://picsum.photos/id/1015/1920/1080', // Sunny beach
      quote: 'You are my sun, my moon, and all my stars.',
      quote_source: 'E.E. Cummings',
      events: [
        { title: 'Garden Ceremony', event_date: oneMonthFromNow, start_time: '16:00', venue_name: 'The Sunny Meadow', venue_address: 'Jl. Kencana, Bandung', google_maps_link: '#' },
        { title: 'Sunset Reception', event_date: oneMonthFromNow, start_time: '18:30', venue_name: 'Terracotta Ballroom', venue_address: 'Jl. Kencana, Bandung', google_maps_link: '#' },
      ],
      livestream: {
        livestream_link: '#',
        platform: 'YouTube Live'
      },
      stories: [
        { title: 'First Ray of Light', story_date: 'June 2022', description: 'We met at a summer music festival, a chance encounter under the golden sun that sparked an instant connection.' },
        { title: 'Golden Hour', story_date: 'September 2024', description: 'As the sun set over the hills, a heartfelt proposal was met with a joyful "Yes", marking the start of our forever.' },
        { title: 'Endless Summer', story_date: 'Present Day', description: 'Now, we\'re excited to start our greatest adventure together, and we can\'t wait to celebrate with you.' },
      ],
      galleries: [
        { image_path: 'https://picsum.photos/id/145/800/800' }, { image_path: 'https://picsum.photos/id/163/800/1200' }, { image_path: 'https://picsum.photos/id/183/1200/800' }, { image_path: 'https://picsum.photos/id/218/800/800' }, { image_path: 'https://picsum.photos/id/249/1200/800' }, { image_path: 'https://picsum.photos/id/292/800/1200' }, { image_path: 'https://picsum.photos/id/309/800/800' }, { image_path: 'https://picsum.photos/id/375/1200/800' },
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

    let guestbookEntries = [
        { name: 'Dewi Anggraini', attendance_status: 'Attending', message: 'Can\'t wait to celebrate with you both! Wishing you a lifetime of sunshine and happiness. Congratulations!', created_at: new Date(Date.now() - 3 * 60 * 60 * 1000) },
        { name: 'Farhan Syah', attendance_status: 'Attending', message: 'Happy wedding, my friends! So happy for you. Let the adventure begin!', created_at: new Date(Date.now() - 6 * 60 * 60 * 1000) },
    ];
    const invitationData = @json($invitation) || dummyData;
    console.log(invitationData);
    // --- HELPERS ---
    const formatDate = (date) => new Date(date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });

    // --- DOM POPULATION ---
    const populateContent = () => {
        document.title = `Wedding Invitation | ${invitationData.groom_name} & ${invitationData.bride_name}`;
        
        // document.getElementById('home').style.backgroundImage = `url(${invitationData.hero_background_image})`;
        document.getElementById('hero-couple-names').innerHTML = `${invitationData.groom_name} &amp; ${invitationData.bride_name}`;
        document.getElementById('hero-date').textContent = invitationData.events[0] ? formatDate(invitationData.events[0].event_date) : 'Coming Soon';
        document.getElementById('hero-guest-name').textContent = new URLSearchParams(window.location.search).get('to') || 'Honored Guest';

        document.getElementById('quote-text').innerHTML = `&ldquo;${invitationData.quote}&rdquo;`;
        document.getElementById('quote-source').textContent = ` ${invitationData.quote_source}`;
        
        document.getElementById('couple-container').innerHTML = `
            <div class="flex flex-col md:flex-row items-center gap-12 text-center md:text-left">
                <img src="{{ asset('storage/' . ($invitation->groom_photo_path ?? 'images/defaults/default-groom.webp')) }}" class="w-64 h-64 object-cover rounded-full shadow-2xl border-4 border-summer-gold/50 flex-shrink-0" />
                <div>
                    <h3 class="text-6xl font-serif text-summer-text">${invitationData.groom_name}</h3>
                    <p class="text-summer-text/80 mt-2">${invitationData.groom_info}</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row-reverse items-center gap-12 text-center md:text-right">
                <img src="{{ asset('storage/' . ($invitation->bride_photo_path ?? 'images/defaults/default-bride.webp')) }}" class="w-64 h-64 object-cover rounded-full shadow-2xl border-4 border-summer-gold/50 flex-shrink-0" />
                <div>
                    <h3 class="text-6xl font-serif text-summer-text">${invitationData.bride_name}</h3>
                    <p class="text-summer-text/80 mt-2">${invitationData.bride_info}</p>
                </div>
            </div>
        `;
        
        const eventContainer = document.getElementById('event-container');
        const events = invitationData.events;

        // [MODIFIED] Tambahkan pengecekan ini sebelum me-render
        if (events.length === 1) {
            // Jika hanya ada satu acara, ubah layout container di desktop
            // Hapus 'grid-cols-2' dan ganti dengan 'flex justify-center'
            eventContainer.classList.remove('md:grid-cols-2');
            eventContainer.classList.add('md:flex', 'md:justify-center');
        }

        // Logika rendering tetap sama
        eventContainer.innerHTML = events.map(event => `
            <div class="text-center">
                <h3 class="text-4xl font-serif text-white mb-4">${event.title}</h3>
                <p class="font-bold text-lg text-summer-gold">${formatDate(event.event_date)} at ${event.start_time}</p>
                <div class="h-px w-16 bg-white/20 mx-auto my-6"></div>
                <p class="font-semibold">${event.venue_name}</p>
                <p class="text-sm text-white/80 mt-1">${event.venue_address}</p>
                ${event.google_maps_link ? `<a href="${event.google_maps_link}" target="_blank" rel="noopener noreferrer" class="inline-block mt-6 bg-white text-summer-terracotta px-6 py-2 rounded-lg hover:bg-opacity-90 transition-colors">View on Map</a>` : ''}
            </div>
        `).join('');
        
        // Ganti blok JavaScript untuk livestream dengan kode ini

        // 1. Cek dulu apakah ada acara di dalam array
        if (invitationData.events && invitationData.events.length > 0) {
            // 2. Cari event pertama yang memiliki livestream_link yang valid
            const eventWithLivestream = invitationData.events.find(event => event.livestream_link);

            // 3. Jika event dengan link ditemukan, tampilkan section-nya
            if (eventWithLivestream) {
                document.getElementById('livestream').classList.remove('hidden');
                document.getElementById('livestream').innerHTML = `
                    <div class="max-w-3xl mx-auto text-center bg-white p-8 sm:p-12 rounded-2xl shadow-lg">
                        <h2 class="text-5xl sm:text-6xl font-serif text-center text-summer-text mb-8">Watch Live</h2>
                        <p class="text-summer-text/80 mb-8">Join us virtually as we celebrate our special day from anywhere in the world.</p>
                        <a href="${eventWithLivestream.livestream_link}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-4 text-xl bg-summer-green text-white px-10 py-4 rounded-lg hover:bg-opacity-90 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"></path></svg>
                            <span>Watch The Ceremony</span>
                        </a>
                    </div>
                `;
            }
        }
        if (invitationData.package.has_love_story && invitationData.stories.length > 0) {
    document.getElementById('story').classList.remove('hidden');
    const storyContainer = document.getElementById('story-container');

    storyContainer.innerHTML = invitationData.stories.map((story, index) => {
        const isOdd = index % 2 === 0; // item ke-0,2,4... di kiri

        const contentHtml = `
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                <h3 class="text-2xl font-serif text-gray-800">${story.title}</h3>
                <time class="text-sm italic text-gray-500 mb-2 block">${story.story_date}</time>
                <p class="text-gray-600">${story.description}</p>
            </div>
        `;

        return `
            <div class="relative group mb-12">
                <!-- Mobile layout -->
                <div class="flex items-start gap-4 md:hidden">
                    <div class="mt-1 shrink-0 flex items-center justify-center w-10 h-10 rounded-full  bg-summer-gold  font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor" role="img" aria-label="Sun icon">
                                <path d="M12 4.5C11.72,4.5 11.5,4.28 11.5,4V2.5C11.5,2.22 11.72,2 12,2C12.28,2 12.5,2.22 12.5,2.5V4C12.5,4.28 12.28,4.5 12,4.5M18.36,6.64C18.27,6.64 18.18,6.6 18.1,6.53L17,5.47C16.85,5.32 16.85,5.08 17,4.94C17.15,4.79 17.39,4.79 17.53,4.94L18.6,6C18.74,6.15 18.74,6.39 18.6,6.53C18.52,6.6 18.44,6.64 18.36,6.64M5.64,19.36C5.55,19.36 5.46,19.32 5.39,19.25L4.34,18.2C4.19,18.05 4.19,17.81 4.34,17.67C4.48,17.52 4.72,17.52 4.87,17.67L5.93,18.73C6.08,18.88 6.08,19.12 5.93,19.26C5.86,19.33 5.75,19.36 5.64,19.36M12,20.5C11.72,20.5 11.5,20.28 11.5,20V21.5C11.5,21.78 11.72,22 12,22C12.28,22 12.5,21.78 12.5,21.5V20C12.5,19.72 12.28,19.5 12,19.5M4.5,12H2.5C2.22,12 2,11.78 2,11.5S2.22,11 2.5,11H4C4.28,11 4.5,11.22 4.5,11.5S4.28,12 4.5,12zM21.5,11H20c-0.28,0-0.5,0.22-0.5,0.5s0.22,0.5,0.5,0.5h1.5c0.28,0,0.5-0.22,0.5-0.5S21.78,11,21.5,11zM18.36,18.36C18.27,18.36 18.18,18.32 18.1,18.25L17,17.2c-0.15-0.15-0.15-0.39,0-0.54s0.39-0.15,0.54,0l1.06,1.06c0.15,0.15,0.15,0.39,0,0.54C18.52,18.33,18.44,18.36,18.36,18.36zM5.64,6.64C5.55,6.64,5.46,6.6,5.39,6.53L4.34,5.47c-0.15-0.15-0.15-0.39,0-0.54s0.39-0.15,0.54,0l1.06,1.06c0.15,0.15,0.15,0.39,0,0.54C5.86,6.6,5.75,6.64,5.64,6.64zM12,16.5c-2.48,0-4.5-2.02-4.5-4.5s2.02-4.5,4.5-4.5s4.5,2.02,4.5,4.5S14.48,16.5,12,16.5z"/>
                            </svg>                    
                            </div>
                    <div class="w-full">
                        ${contentHtml}
                    </div>
                </div>

                <!-- Desktop layout -->
                <div class="hidden md:flex ${isOdd ? '' : 'flex-row-reverse'} items-start">
                    <div class="w-1/2 ${isOdd ? 'pr-8 text-right' : 'pl-8'}">
                        ${contentHtml}
                    </div>
                    <div class="absolute left-5 md:left-1/2 -translate-x-1/2 flex items-center justify-center w-10 h-10 bg-summer-gold rounded-full z-10 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor" role="img" aria-label="Sun icon">
                            <path d="M12 4.5C11.72,4.5 11.5,4.28 11.5,4V2.5C11.5,2.22 11.72,2 12,2C12.28,2 12.5,2.22 12.5,2.5V4C12.5,4.28 12.28,4.5 12,4.5M18.36,6.64C18.27,6.64 18.18,6.6 18.1,6.53L17,5.47C16.85,5.32 16.85,5.08 17,4.94C17.15,4.79 17.39,4.79 17.53,4.94L18.6,6C18.74,6.15 18.74,6.39 18.6,6.53C18.52,6.6 18.44,6.64 18.36,6.64M5.64,19.36C5.55,19.36 5.46,19.32 5.39,19.25L4.34,18.2C4.19,18.05 4.19,17.81 4.34,17.67C4.48,17.52 4.72,17.52 4.87,17.67L5.93,18.73C6.08,18.88 6.08,19.12 5.93,19.26C5.86,19.33 5.75,19.36 5.64,19.36M12,20.5C11.72,20.5 11.5,20.28 11.5,20V21.5C11.5,21.78 11.72,22 12,22C12.28,22 12.5,21.78 12.5,21.5V20C12.5,19.72 12.28,19.5 12,19.5M4.5,12H2.5C2.22,12 2,11.78 2,11.5S2.22,11 2.5,11H4C4.28,11 4.5,11.22 4.5,11.5S4.28,12 4.5,12zM21.5,11H20c-0.28,0-0.5,0.22-0.5,0.5s0.22,0.5,0.5,0.5h1.5c0.28,0,0.5-0.22,0.5-0.5S21.78,11,21.5,11zM18.36,18.36C18.27,18.36 18.18,18.32 18.1,18.25L17,17.2c-0.15-0.15-0.15-0.39,0-0.54s0.39-0.15,0.54,0l1.06,1.06c0.15,0.15,0.15,0.39,0,0.54C18.52,18.33,18.44,18.36,18.36,18.36zM5.64,6.64C5.55,6.64,5.46,6.6,5.39,6.53L4.34,5.47c-0.15-0.15-0.15-0.39,0-0.54s0.39-0.15,0.54,0l1.06,1.06c0.15,0.15,0.15,0.39,0,0.54C5.86,6.6,5.75,6.64,5.64,6.64zM12,16.5c-2.48,0-4.5-2.02-4.5-4.5s2.02-4.5,4.5-4.5s4.5,2.02,4.5,4.5S14.48,16.5,12,16.5z"/>
                        </svg>
                    </div>
                    <div class="w-1/2"></div>
                </div>
            </div>
        `;
    }).join('');
}

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
                
                return  `
                <div class="overflow-hidden rounded-lg cursor-pointer group shadow-md" data-src="${imageUrl}">
                    <img src="${imageUrl}" alt="${item.alt || 'Gallery Image'}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                </div>
            `;}).join('');
        }
        
        if (invitationData.package.has_rsvp) {
    // Tampilkan RSVP & Guestbook
    document.getElementById('rsvp').classList.remove('hidden');
    document.getElementById('guestbook').classList.remove('hidden');

    // Jika ada hadiah (rekening)
    if (invitationData.gifts.length > 0) {
        document.getElementById('gift-section').classList.remove('hidden');
        document.getElementById('rsvp-section')?.classList.remove('md:col-start-2');

        document.getElementById('gift-container').innerHTML = invitationData.gifts.map(gift => `
            <div class="bg-summer-bg p-4 rounded-lg border">
                <h4 class="font-semibold text-summer-text">${gift.bank_name}</h4>
                <p class="text-sm text-summer-text/70">${gift.account_holder_name}</p>
                <div class="flex items-center justify-between mt-2 bg-white p-2 rounded">
                    <span class="font-mono text-summer-terracotta">${gift.account_number}</span>
                    <button 
                        data-copy="${gift.account_number}" 
                        class="copy-btn text-xs border border-summer-terracotta text-summer-terracotta px-2 py-1 rounded hover:bg-summer-terracotta hover:text-white transition-colors"
                    >
                        Copy
                    </button>
                </div>
            </div>
        `).join('');
    } else {
        // Kalau gift kosong, buat form RSVP lebih kecil
        const rsvpWrapper = document.getElementById('rsvp').firstElementChild;
        rsvpWrapper.classList.remove('md:grid-cols-2');
        rsvpWrapper.classList.add('max-w-xl');
    }

    // Render guestbook awal
    renderGuestbook();
    }

    // Listener form RSVP
    const rsvpForm = document.getElementById('rsvp-form');
    if (rsvpForm) {
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
                    // simpan entry ke data global
                    invitationData.guestbooks.unshift(result.entry);

                    // render ulang daftar
                    renderGuestbook();

                    // ubah form jadi pesan sukses
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
    }


        document.getElementById('footer').innerHTML = `
            <h3 class="text-5xl font-serif text-summer-text">${invitationData.groom_name} &amp; ${invitationData.bride_name}</h3>
            <p class="mt-4">Thank you for being part of our special day.</p>
            <p class="text-sm text-summer-text/50 mt-8">&copy; ${new Date().getFullYear()}. All Rights Reserved.</p>
        `;
    };
    
    const renderGuestbook = () => {
        const guestbookContainer = document.getElementById('guestbook-container');
        if (invitationData.guestbooks.length === 0) {
        guestbookContainer.innerHTML = `<p class="text-center text-gray-500">Belum ada ucapan.</p>`;
        return;
        }
        guestbookContainer.innerHTML = invitationData.guestbooks.map(entry => `
            <div class="bg-white p-5 rounded-lg shadow-md border-l-4 border-summer-gold">
                <div class="flex justify-between items-center">
                    <p class="font-bold text-summer-text">${entry.name}</p>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full ${entry.attendance_status === 'Attending' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        ${entry.attendance_status}
                    </span>
                </div>
                <p class="text-summer-text/80 my-2 italic">"${entry.message}"</p>
            </div>
        `).join('');
    };

    // --- GOLDEN DUST ANIMATION ---
    const setupDustAnimation = () => {
        const canvas = document.getElementById('dust-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = document.body.scrollHeight; // Cover entire scrollable height
        }

        function createParticles() {
            particles = [];
            const particleCount = window.innerWidth < 768 ? 50 : 100;
            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 2 + 1,
                    speedX: Math.random() * 0.5 - 0.25,
                    speedY: Math.random() * 0.5 + 0.2,
                    opacity: Math.random() * 0.5 + 0.3
                });
            }
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (const p of particles) {
                ctx.fillStyle = `rgba(255, 199, 0, ${p.opacity})`;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fill();
            }
            update();
        }

        function update() {
            for (const p of particles) {
                p.x += p.speedX;
                p.y += p.speedY;

                if (p.y > canvas.height) {
                    p.y = 0;
                    p.x = Math.random() * canvas.width;
                }
                if (p.x > canvas.width) p.x = 0;
                if (p.x < 0) p.x = canvas.width;
            }
        }
        
        let animationFrameId;
        function animate() {
            draw();
            animationFrameId = requestAnimationFrame(animate);
        }

        window.addEventListener('resize', () => {
            resizeCanvas();
            createParticles();
        });
        
        setTimeout(() => {
            resizeCanvas();
            createParticles();
            animate();
        }, 100);
    };
    
    // --- COUNTDOWN TIMER ---
    const setupCountdown = () => {
        const targetDate = new Date(invitationData.events[0].event_date).getTime();
        const countdownContainer = document.getElementById('countdown-container');
        if (!targetDate || !countdownContainer) return;
        
        const daysEl = document.getElementById('countdown-days');
        const hoursEl = document.getElementById('countdown-hours');
        const minutesEl = document.getElementById('countdown-minutes');
        const secondsEl = document.getElementById('countdown-seconds');

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                countdownContainer.innerHTML = `<p class="text-xl sm:text-2xl font-semibold text-white">The Day is Here!</p>`;
                clearInterval(interval);
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            daysEl.textContent = String(days).padStart(2, '0');
            hoursEl.textContent = String(hours).padStart(2, '0');
            minutesEl.textContent = String(minutes).padStart(2, '0');
            secondsEl.textContent = String(seconds).padStart(2, '0');
        };

        const interval = setInterval(updateCountdown, 1000);
        updateCountdown();
    };

    // --- NAVIGATION ---
    const setupNavigation = () => {
        const sidebar = document.getElementById('sidebar');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const openIcon = document.getElementById('menu-open-icon');
        const closeIcon = document.getElementById('menu-close-icon');

        mobileMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('sidebar-open');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        let links = [
            { href: '#couple', text: 'Couple' },
            { href: '#event', text: 'Event' },
            invitationData.livestream && { href: '#livestream', text: 'Live' },
            invitationData.package.has_love_story && { href: '#story', text: 'Story' },
            invitationData.galleries.length > 0 && { href: '#gallery', text: 'Gallery' },
            invitationData.package.has_rsvp && { href: '#rsvp', text: 'RSVP' }
        ].filter(Boolean);

        const linkHTML = links.map(l => `<a href="${l.href}" class="nav-link hover:text-summer-terracotta transition-colors">${l.text}</a>`).join('');
        document.getElementById('nav-menu').innerHTML = linkHTML;
        
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                if (window.innerWidth < 768 && sidebar.classList.contains('sidebar-open')) {
                   sidebar.classList.add('-translate-x-full');
                   sidebar.classList.remove('sidebar-open');
                   openIcon.classList.remove('hidden');
                   closeIcon.classList.add('hidden');
                }
            });
        });
    };
    
    // --- INTERACTIVITY ---
    const setupInteractivity = () => {
        document.getElementById('gallery-container')?.addEventListener('click', (e) => {
            const item = e.target.closest('[data-src]');
            if (item) {
                document.getElementById('lightbox').classList.remove('hidden');
                document.getElementById('lightbox-img').src = item.dataset.src;
            }
        });
        document.getElementById('lightbox')?.addEventListener('click', () => document.getElementById('lightbox').classList.add('hidden'));

        document.getElementById('rsvp')?.addEventListener('click', e => {
            const button = e.target.closest('.copy-btn');
            if (button) {
                navigator.clipboard.writeText(button.dataset.copy);
                button.textContent = 'Copied!';
                setTimeout(() => button.textContent = 'Copy', 2000);
            }
        });
        
        document.getElementById('rsvp-form')?.addEventListener('submit', e => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            guestbookEntries.unshift({
                name: formData.get('name'),
                attendance_status: formData.get('attendance_status'),
                message: formData.get('message'),
                created_at: new Date()
            });
            renderGuestbook();
            document.getElementById('rsvp-section').innerHTML = `
                <div class="text-center h-full flex flex-col justify-center items-center">
                    <h3 class="text-3xl font-serif text-summer-text">Thank You!</h3>
                    <p class="text-summer-text/80 mt-2">Your wishes have been received.</p>
                </div>
            `;
        });
    };

    // --- ANIMATIONS ---
    const setupAnimations = () => {
      const sections = document.querySelectorAll('section[id] > div');
      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.classList.add('fade-in');
                  observer.unobserve(entry.target);
              }
          });
      }, { threshold: 0.1 });
      sections.forEach(section => {
          observer.observe(section);
      });
    };
// --- MUSIC PLAYER ---
    const setupMusicPlayer = () => {
        const musicPlayer = document.getElementById('music-player');
        const audio = document.getElementById('bg-music');
        const playButton = document.getElementById('play-button');
        const pauseButton = document.getElementById('pause-button');
        
        musicPlayer.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                playButton.classList.add('hidden');
                pauseButton.classList.remove('hidden');
            } else {
                audio.pause();
                pauseButton.classList.add('hidden');
                playButton.classList.remove('hidden');
            }
        });
    };
    // --- INITIALIZATION ---
    populateContent();
    setupDustAnimation();
    setupCountdown();
    setupNavigation();
    setupInteractivity();
    setupAnimations();
    setupMusicPlayer();
});
</script>
</body>
</html>
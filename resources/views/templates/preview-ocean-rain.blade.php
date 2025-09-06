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
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Audio Elements -->
    <audio id="rain-sound" loop preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-light-rain-loop-2393.mp3" type="audio/mpeg">
    </audio>
    <audio id="thunder-sound" preload="auto">
        <source src="https://assets.mixkit.co/sfx/preview/mixkit-thunder-deep-rumble-1296.mp3" type="audio/mpeg">
    </audio>
    
    <script>
      // Custom Tailwind theme configuration
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'ocean-dark': '#0c1a3d', // Darker blue with purple tint
              'ocean-mid': '#1a2a5e',  // Mid blue-purple
              'ocean-light': '#2e3a7c', // Lighter blue-purple
              'seafoam-green': '#7bb5ff', // Changed to light blue
              'light-sand': '#d6e1ff', // Light blue-ish white
              'rain-blue': '#4a6baf', // Medium blue for rain effects
              'rain-purple': '#6a4ca3', // Purple accent for rain theme
              'lightning-blue': '#a7c6ff', // Light blue for lightning effects
            },
            fontFamily: {
              sans: ['Poppins', 'sans-serif'],
              serif: ['Great Vibes', 'cursive'],
            },
            textShadow: {
              'sm': '0 1px 2px rgba(0, 0, 0, 0.5)',
              'md': '0 2px 4px rgba(0, 0, 0, 0.5)',
              'lg': '0 4px 8px rgba(0, 0, 0, 0.5)',
              'glow': '0 0 5px rgba(123, 181, 255, 0.7), 0 0 10px rgba(123, 181, 255, 0.5)',
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
            background-size: cover;

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
        background-color: #0c1a3d; /* Updated to darker blue-purple */
        color: #d6e1ff; /* Updated to light blue-ish white */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      .gradient-bg {
        background: linear-gradient(to bottom, #7bb5ff, #6a4ca3, #0c1a3d);
      }
      .timeline-dot {
        @apply w-4 h-4 rounded-full bg-lightning-blue absolute left-0 transform -translate-x-1/2;
      }
      .timeline-card {
        @apply bg-ocean-mid rounded-lg p-4 shadow-lg border-l-4 border-rain-blue;
      }
      .nav-sticky {
        background-color: rgba(12, 26, 61, 0.85); /* Updated to match new ocean-dark */
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.7);
      }
      .btn-primary {
        @apply bg-rain-blue text-light-sand font-bold py-2 px-6 rounded-full transition-all duration-300 hover:shadow-lg hover:scale-105 hover:bg-rain-purple;
      }
      .btn-outline {
        @apply border-2 border-lightning-blue text-lightning-blue font-bold py-2 px-6 rounded-full transition-all duration-300 hover:bg-lightning-blue hover:text-ocean-dark hover:shadow-lg hover:scale-105;
      }
      
      /* Text shadow utility classes */
      .text-shadow-sm {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
      }
      .text-shadow-md {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      }
      .text-shadow-lg {
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
      }
      .text-shadow-glow {
        text-shadow: 0 0 5px rgba(123, 181, 255, 0.7), 0 0 10px rgba(123, 181, 255, 0.5);
      }
      .horizontal-timeline::-webkit-scrollbar {
        height: 8px;
      }
      .horizontal-timeline::-webkit-scrollbar-track {
        background: rgba(123, 181, 255, 0.1);
        border-radius: 10px;
      }
      .horizontal-timeline::-webkit-scrollbar-thumb {
        background: #7bb5ff;
        border-radius: 10px;
      }
      .fade-in {
        animation: fadeIn 1s ease-out forwards;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      section.visible {
        opacity: 1;
      }
      
      /* Water Ripple Effect */
      .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: ripple-animation 2s linear infinite;
      }
      @keyframes ripple-animation {
        0% {
          transform: scale(0);
          opacity: 0.7;
        }
        100% {
          transform: scale(1);
          opacity: 0;
        }
      }
      
      /* Raindrop Effect */
      .raindrop {
        position: absolute;
        width: 2px;
        height: 20px;
        background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(123, 181, 255, 0.7) 100%);
        border-radius: 0 0 5px 5px;
        transform-origin: top center;
        animation: drop 1s linear infinite;
        box-shadow: 0 0 4px rgba(123, 181, 255, 0.3);
      }
      @keyframes drop {
        0% { transform: translateY(-100px) scaleY(0); opacity: 0; }
        5% { opacity: 0.5; }
        50% { transform: translateY(0) scaleY(1); opacity: 1; }
        65% { transform: translateY(25px) scaleY(0.9); opacity: 0.8; }
        75% { transform: translateY(30px) scaleY(0.6); opacity: 0.6; }
        100% { transform: translateY(50px) scaleY(0); opacity: 0; }
      }
      
      /* Sound Control Button */
      .music-player {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 100;
        background-color: rgba(12, 26, 61, 0.7);
        border: 1px solid rgba(123, 181, 255, 0.3);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      .music-player:hover {
        background-color: rgba(26, 42, 94, 0.9);
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(123, 181, 255, 0.5);
      }
      
      /* Fog Effect */
      .fog {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxmaWx0ZXIgaWQ9ImZvZyIgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSI+CiAgICA8ZmVUdXJidWxlbmNlIHR5cGU9ImZyYWN0YWxOb2lzZSIgYmFzZUZyZXF1ZW5jeT0iMC4wMSIgbnVtT2N0YXZlcz0iMyIgc3RpdGNoVGlsZXM9InN0aXRjaCIgcmVzdWx0PSJub2lzZSIvPgogICAgPGZlQ29sb3JNYXRyaXggdHlwZT0ibWF0cml4IiB2YWx1ZXM9IjEgMCAwIDAgMCAwIDEgMCAwIDAgMCAwIDEgMCAwIDAgMCAwIDEgMCIgcmVzdWx0PSJjb2xvcmVkTm9pc2UiLz4KICAgIDxmZUNvbXBvc2l0ZSBpbj0iU291cmNlR3JhcGhpYyIgaW4yPSJjb2xvcmVkTm9pc2UiIG9wZXJhdG9yPSJhcml0aG1ldGljIiBrMT0iMCIgazI9IjAuMSIgazM9IjAiIGs0PSIwIiByZXN1bHQ9ImZvZyIvPgogIDwvZmlsdGVyPgogIDxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiMxYTJhNWUiIGZpbHRlcj0idXJsKCNmb2cpIiBvcGFjaXR5PSIwLjEiLz4KPC9zdmc+');
        pointer-events: none;
        z-index: 15;
        opacity: 0.4;
        animation: fog-movement 60s linear infinite;
      }
      
      /* Rainbow Effect */
      .rainbow {
        position: relative;
        overflow: hidden;
      }
      .rainbow::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, 
          rgba(255, 0, 0, 0.1), 
          rgba(255, 165, 0, 0.1), 
          rgba(255, 255, 0, 0.1), 
          rgba(0, 128, 0, 0.1), 
          rgba(0, 0, 255, 0.1), 
          rgba(75, 0, 130, 0.1), 
          rgba(238, 130, 238, 0.1));
        opacity: 0;
        border-radius: 50%;
        transform: scale(0);
        z-index: -1;
        animation: rainbow-appear 1s ease-out forwards;
        animation-play-state: paused;
      }
      .rainbow:hover::after {
        animation-play-state: running;
      }
      @keyframes rainbow-appear {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 0.7; }
      }
      @keyframes fog-movement {
        0% { background-position: 0% 0%; }
        50% { background-position: 100% 100%; }
        100% { background-position: 0% 0%; }
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
    
    <!-- Rain Canvas -->
    <canvas id="rain-canvas" class="fixed inset-0 z-20 pointer-events-none"></canvas>
    
    <!-- Fog Effect -->
    <div class="fog"></div>
    
    <!-- Sound Control -->
    <div class="music-player" id="sound-toggle">
        <audio id="bg-music" loop preload="auto">
        <source src="{{ asset('audio/background-music.mp3') }}" type="audio/mpeg">
      </audio>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-lightning-blue">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
            <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
        </svg>
    </div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 p-6 transition-all duration-300">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="#home" class="font-serif text-3xl text-lightning-blue">A&R</a>
            <div id="nav-menu" class="hidden md:flex items-center space-x-8 text-light-sand">
                <!-- JS will populate nav links -->
            </div>
            <button id="mobile-menu-toggle" class="md:hidden text-lightning-blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden flex-col items-center mt-6 space-y-4 bg-ocean-mid/95 p-6 rounded-lg">
             <!-- JS will populate mobile nav links -->
        </div>
    </nav>
    
    <main class="relative z-10">
        <!-- Hero Section -->
        <header id="home" class="h-screen flex flex-col justify-center items-center text-center p-6 relative bg-cover bg-center bg-no-repeat overflow-hidden">
            <div class="absolute inset-0 bg-black/50 z-0"></div>
            
            <!-- Water Ripple Container -->
            <div id="ripple-container" class="absolute inset-0 z-1 overflow-hidden"></div>
            
            <!-- Raindrops on Text -->
            <div id="raindrop-container" class="absolute inset-0 z-5 pointer-events-none"></div>
            
            <div class="fade-in z-10 relative">
                <h1 id="hero-couple-names" class="p-10 text-7xl sm:text-9xl font-serif text-white text-shadow-lg rainbow"></h1>
                <p class="text-lg sm:text-xl text-lightning-blue tracking-widest mt-4 mb-8 text-shadow-sm">ARE GETTING MARRIED</p>
                <p id="hero-date" class="text-xl sm:text-2xl font-semibold text-light-sand text-shadow-md"></p>
                <div class="mt-24 backdrop-blur-sm bg-ocean-dark/30 p-6 rounded-lg inline-block rainbow">
                  <p class="text-light-sand/80">To the respected,</p>
                  <p id="hero-guest-name" class="text-2xl font-bold mt-1 text-lightning-blue"></p>
                </div>
            </div>
        </header>

        <!-- Quote Section -->
        <section id="quote" class="py-24 px-6 sm:px-12 bg-ocean-mid">
          <div class="max-w-4xl mx-auto p-10 sm:p-16 text-center">
            <blockquote id="quote-text" class="text-2xl sm:text-3xl font-light italic text-light-sand leading-relaxed relative"></blockquote>
            <p id="quote-source" class="mt-8 text-lg text-seafoam-green font-semibold"></p>
          </div>
        </section>

        <!-- Couple Section -->
        <section id="couple" class="py-24 px-6 sm:px-12 bg-ocean-dark">
          <div id="couple-container" class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- JS will populate this -->
          </div>
        </section>
        
        <!-- Event Section -->
        <section id="event" class="py-24 px-6 sm:px-12 bg-ocean-light">
            <h2 class="text-5xl sm:text-6xl font-serif text-center text-white mb-16">Wedding Details</h2>
            <div id="event-container" class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
               <!-- JS will populate this -->
            </div>
        </section>

        <!-- Livestream Section (Conditional) -->
        <section id="livestream" class="hidden py-24 px-6 sm:px-12 bg-ocean-mid">
           <!-- JS will populate this -->
        </section>
        
        <!-- Story Section (Conditional & Horizontal) -->
        <section id="story" class="hidden py-24 bg-ocean-dark">
           <h2 class="text-5xl sm:text-6xl font-serif text-center text-white mb-4 px-6 sm:px-12">Our Journey</h2>
           <p class="text-center text-seafoam-green mb-12 animate-pulse">Scroll to see more &rarr;</p>
           <div class="horizontal-timeline relative w-full overflow-x-auto pb-8">
             <div id="story-container" class="inline-flex items-center space-x-0 px-6 sm:px-12">
               <!-- JS will populate this -->
             </div>
           </div>
        </section>
        
        <!-- Gallery Section (Conditional) -->
        <section id="gallery" class="hidden py-24 px-6 sm:px-12 bg-ocean-light">
            <h2 class="text-5xl sm:text-6xl font-serif text-center text-white mb-16">Captured Moments</h2>
            <div id="gallery-container" class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- JS will populate this -->
            </div>
        </section>

        <!-- Gift & RSVP Section (Combined) -->
        <section id="rsvp" class="hidden py-24 px-6 sm:px-12 bg-ocean-mid">
            <div class="max-w-5xl mx-auto p-8 sm:p-12 rounded-lg grid grid-cols-1 md:grid-cols-2 gap-12 border border-seafoam-green/20">
                <!-- Gift Section -->
                <div id="gift-section" class="hidden">
                    <h2 class="text-4xl font-serif text-white text-center mb-8">Wedding Gift</h2>
                    <p class="text-center text-light-sand/80 mb-8">Your presence is the most cherished gift. However, if you wish to give a token of love, it is gratefully received.</p>
                    <div id="gift-container" class="space-y-6">
                        <!-- JS will populate gifts -->
                    </div>
                </div>
                <!-- RSVP Form -->
                <div id="rsvp-section" class="md:col-start-2">
                    <h2 class="text-4xl font-serif text-white text-center mb-8">Confirm Attendance</h2>
                    <form id="rsvp-form" 
                        action="{{ $formAction }}" 
                        method="POST" 
                        class="space-y-6">
                         <div>
                            <label for="name" class="block text-sm font-semibold text-light-sand/80 mb-2">Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 bg-ocean-dark/70 border border-seafoam-green/20 rounded-md focus:ring-2 focus:ring-seafoam-green focus:border-seafoam-green outline-none transition-shadow text-light-sand" />
                        </div>
                        <div>
                            <label for="attendance_status" class="block text-sm font-semibold text-light-sand/80 mb-2">Will you be attending?</label>
                            <select name="attendance_status" required class="w-full px-4 py-3 bg-ocean-dark/70 border border-seafoam-green/20 rounded-md focus:ring-2 focus:ring-seafoam-green focus:border-seafoam-green outline-none transition-shadow text-light-sand">
                                <option value="" disabled selected>Please select...</option>
                                <option value="Attending">Yes, with pleasure</option>
                                <option value="Not Attending">Regretfully, I cannot</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-light-sand/80 mb-2">Send your wishes</label>
                            <textarea name="message" required rows="4" class="w-full px-4 py-3 bg-ocean-dark/70 border border-seafoam-green/20 rounded-md focus:ring-2 focus:ring-seafoam-green focus:border-seafoam-green outline-none transition-shadow text-light-sand" maxLength="500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-seafoam-green/10 text-seafoam-green border border-seafoam-green px-6 py-4 font-bold tracking-wider rounded-md hover:bg-seafoam-green/20 transition-colors">Send Wishes</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Guestbook Section -->
        <section id="guestbook" class="hidden py-24 px-6 sm:px-12 bg-ocean-dark">
             <h2 class="text-5xl sm:text-6xl font-serif text-center text-white mb-16">Wishes & Blessings</h2>
             <div id="guestbook-container" class="max-w-3xl mx-auto space-y-6">
                 <!-- JS will populate wishes -->
             </div>
        </section>

    </main>

    <!-- Footer -->
    <footer id="footer" class="text-center py-12 px-6 mt-16 text-light-sand/70 bg-ocean-dark">
       <!-- JS will populate this -->
    </footer>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-ocean-dark/95 z-[100] flex items-center justify-center p-4">
        <button id="lightbox-close" class="absolute top-6 right-6 text-white hover:text-seafoam-green transition-colors" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-9 h-9"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <img id="lightbox-img" src="" alt="Gallery view" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl" />
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // --- DATA ---
    const oneMonthFromNow = new Date();
    oneMonthFromNow.setMonth(oneMonthFromNow.getMonth() + 1);

    const dummyData = {
      groom_name: 'Aris',
      groom_info: 'Son of Mr. Surya & Mrs. Chandra',
      groom_photo_path: 'https://picsum.photos/id/1027/800/800',
      bride_name: 'Rina',
      bride_info: 'Daughter of Mr. Bintang & Mrs. Purnama',
      bride_photo_path: 'https://picsum.photos/id/1011/800/800',
      hero_background_image: 'https://picsum.photos/id/120/1920/1080', // Rainy window
      quote: 'The best love is the kind that awakens the soul; that makes us reach for more, that plants the fire in our hearts and brings peace to our minds. That’s what I hope to give you forever.',
      quote_source: 'The Notebook',
      events: [
        { title: 'Akad Nikah', event_date: oneMonthFromNow, start_time: '09:00', venue_name: 'Masjid Agung Al-Azhar', venue_address: 'Jl. Sisingamangaraja, Selong, Kebayoran Baru, Jakarta Selatan', google_maps_link: 'https://maps.app.goo.gl/9vJqFkCtL5qZ4x7p8', livestream_link: 'https://www.youtube.com/live/example1' },
        { title: 'Reception Dinner', event_date: oneMonthFromNow, start_time: '18:00', venue_name: 'The Lighthouse Ballroom', venue_address: 'Jl. Dermaga Senja, Bali', google_maps_link: 'https://maps.app.goo.gl/9vJqFkCtL5qZ4x7p8' },
      ],
      livestream: {
        link: '#', // Replace with actual live stream link
        platform: 'YouTube Live'
      },
      stories: [
        { title: 'A Rainy Afternoon', story_date: 'April 2022', description: 'Our story began in a small cafe, seeking shelter from the rain. A shared table led to a conversation that lasted for hours.' },
        { title: 'Sailing Together', story_date: 'August 2023', description: 'Under the vast open sky, we discovered our shared love for the sea, realizing we were navigating life in the same direction.' },
        { title: 'Message in a Bottle', story_date: 'January 2025', description: 'On a quiet beach, a simple question written on a scroll was answered with a tearful "Yes," setting our forever in motion.' },
      ],
      galleries: [
        { image_path: 'https://picsum.photos/id/2/800/800' }, { image_path: 'https://picsum.photos/id/24/800/1200' }, { image_path: 'https://picsum.photos/id/25/1200/800' }, { image_path: 'https://picsum.photos/id/48/800/800' }, { image_path: 'https://picsum.photos/id/58/1200/800' }, { image_path: 'https://picsum.photos/id/103/800/1200' }, { image_path: 'https://picsum.photos/id/111/800/800' }, { image_path: 'https://picsum.photos/id/119/1200/800' },
      ],
      guestbooks : [
        { name: 'Budi Santoso', attendance_status: 'Hadir', message: 'Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin.', created_at: new Date(Date.now() - 2 * 60 * 60 * 1000) },
        { name: 'Citra Lestari', attendance_status: 'Hadir', message: 'Happy wedding! Semoga cinta kalian abadi selamanya. Turut berbahagia.', created_at: new Date(Date.now() - 5 * 60 * 60 * 1000) },
      ],
      gifts: [
        { bank_name: 'Digital Wallet (GoPay)', account_number: '081234567890', account_holder_name: 'Aris' },
        { bank_name: 'Bank Central Asia (BCA)', account_number: '1234567890', account_holder_name: 'Rina' },
      ],
      package: { has_love_story: true, has_rsvp: true, has_live_streaming: true },
    };

    let guestbookEntries = [
        { name: 'Dewi Anggraini', attendance_status: 'Attending', message: 'So excited for you both! May your future be as beautiful as the ocean. Congratulations!', created_at: new Date(Date.now() - 3 * 60 * 60 * 1000) },
        { name: 'Farhan Syah', attendance_status: 'Attending', message: 'Happy wedding, my friends! Wishing you a lifetime of happiness and endless adventures.', created_at: new Date(Date.now() - 6 * 60 * 60 * 1000) },
    ];
    const invitationData = @json($invitation) || dummyData;
    console.log(invitationData);
    // --- HELPERS ---
    const formatDate = (date) => new Date(date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });

    // --- DOM POPULATION ---
    const populateContent = () => {
        document.title = `Wedding Invitation | ${invitationData.groom_name} & ${invitationData.bride_name}`;
        
        // Hero with static background
        // document.getElementById('home').style.backgroundImage = `url(${invitationData.hero_background_image})`;
        document.getElementById('hero-couple-names').innerHTML = `${invitationData.groom_name} &amp; ${invitationData.bride_name}`;
        document.getElementById('hero-date').textContent = invitationData.events[0] ? formatDate(invitationData.events[0].event_date) : 'Coming Soon';
        document.getElementById('hero-guest-name').textContent = new URLSearchParams(window.location.search).get('to') || 'Honored Guest';

        // Quote
        document.getElementById('quote-text').innerHTML = `&ldquo;${invitationData.quote}&rdquo;`;
        document.getElementById('quote-source').textContent = `&mdash; ${invitationData.quote_source}`;
        
        // Couple
        document.getElementById('couple-container').innerHTML = `
            <div class="text-center">
                <img src="{{ asset('storage/' . ($invitation->groom_photo_path ?? 'images/defaults/default-groom.webp')) }}" class="w-64 h-64 object-cover rounded-full mx-auto shadow-2xl border-4 border-seafoam-green/20" />
                <h3 class="text-6xl font-serif text-white mt-8">${invitationData.groom_name}</h3>
                <p class="text-light-sand/80 mt-2">${invitationData.groom_info}</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/' . ($invitation->bride_photo_path ?? 'images/defaults/default-bride.webp')) }}" class="w-64 h-64 object-cover rounded-full mx-auto shadow-2xl border-4 border-seafoam-green/20" />
                <h3 class="text-6xl font-serif text-white mt-8">${invitationData.bride_name}</h3>
                <p class="text-light-sand/80 mt-2">${invitationData.bride_info}</p>
            </div>
        `;
        
        // Event
        document.getElementById('event-container').innerHTML = invitationData.events.map(event => `
            <div class="border border-seafoam-green/20 p-8 rounded-lg text-center bg-ocean-dark/50">
                <h3 class="text-4xl font-serif text-white mb-4">${event.title}</h3>
                <p class="font-bold text-lg text-seafoam-green">${formatDate(event.event_date)} at ${event.start_time}</p>
                <div class="h-px w-16 bg-seafoam-green/20 mx-auto my-6"></div>
                <p class="font-semibold text-light-sand">${event.venue_name}</p>
                <p class="text-sm text-light-sand/80 mt-1">${event.venue_address}</p>
                ${event.google_maps_link ? `<a href="${event.google_maps_link}" target="_blank" rel="noopener noreferrer" class="inline-block mt-6 border border-seafoam-green text-seafoam-green px-6 py-2 rounded hover:bg-seafoam-green/10 transition-colors">View on Map</a>` : ''}
            </div>
        `).join('');
        
        // Livestream
        // Livestream (FIXED)
        if (invitationData.events && invitationData.events.length > 0) {
            // 1. Cari event pertama di dalam array yang memiliki livestream_link
            const eventWithLivestream = invitationData.events.find(event => event.livestream_link);

            // 2. Jika event dengan link ditemukan, tampilkan section-nya
            if (eventWithLivestream) {
                document.getElementById('livestream').classList.remove('hidden');
                document.getElementById('livestream').innerHTML = `
                    <div class="max-w-3xl mx-auto text-center">
                        <h2 class="text-5xl sm:text-6xl font-serif text-center text-white mb-8">Watch Live</h2>
                        <p class="text-light-sand/80 mb-8">Join us virtually as we celebrate our special day from anywhere in the world.</p>
                        <a href="${eventWithLivestream.livestream_link}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-4 text-xl border-2 border-seafoam-green text-seafoam-green px-10 py-4 rounded-lg hover:bg-seafoam-green/10 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"></path></svg>
                            <span>Watch on ${eventWithLivestream.platform || 'Platform'}</span>
                        </a>
                    </div>
                `;
            }
        }

        // Story (Horizontal with connectors)
        if (invitationData.package.has_love_story) {
            document.getElementById('story').classList.remove('hidden');
            const storiesHTML = invitationData.stories.map((story, index) => `
                <div class="p-6 rounded-lg w-80 flex-shrink-0 bg-ocean-mid border border-seafoam-green/10">
                    <time class="text-sm text-seafoam-green mb-2 block">${story.story_date}</time>
                    <h3 class="text-2xl font-semibold text-white mb-3">${story.title}</h3>
                    <p class="text-light-sand/80">${story.description}</p>
                </div>
                ${index < invitationData.stories.length - 1 ? `
                <div class="flex-shrink-0 w-24 flex items-center justify-center">
                    <svg width="100%" height="20" viewBox="0 0 100 20" preserveAspectRatio="none">
                        <path d="M0 10 L85 10" stroke="#64ffda" stroke-width="2" stroke-dasharray="4 4" fill="none" />
                        <path d="M85 10 L100 10 L92 5 M100 10 L92 15" stroke="#64ffda" stroke-width="2" fill="none" />
                    </svg>
                </div>
                ` : ''}
            `).join('');
            document.getElementById('story-container').innerHTML = storiesHTML;
        }

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

        // Gallery
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
                <div class="overflow-hidden rounded-lg cursor-pointer group" data-src="${imageUrl}">
                    <img src="${imageUrl}" alt="${item.alt || 'Gallery Image'}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                </div>
            `;
            }).join('');
        }
        
        // RSVP, Gift, Guestbook
        if (invitationData.package.has_rsvp) {
            document.getElementById('rsvp').classList.remove('hidden');
            document.getElementById('guestbook').classList.remove('hidden');
            if(invitationData.gifts.length > 0) {
                document.getElementById('gift-section').classList.remove('hidden');
                document.getElementById('rsvp-section').classList.remove('md:col-start-2');
                document.getElementById('gift-container').innerHTML = invitationData.gifts.map(gift => `
                    <div class="bg-ocean-dark/50 p-4 rounded-lg">
                        <h4 class="font-semibold text-white">${gift.bank_name}</h4>
                        <p class="text-sm text-light-sand/70">${gift.account_holder_name}</p>
                        <div class="flex items-center justify-between mt-2 bg-ocean-dark/50 p-2 rounded">
                            <span class="font-mono text-seafoam-green">${gift.account_number}</span>
                            <button data-copy="${gift.account_number}" class="copy-btn text-xs border border-seafoam-green text-seafoam-green px-2 py-1 rounded hover:bg-seafoam-green/10">Copy</button>
                        </div>
                    </div>
                `).join('');
            } else {
                 document.getElementById('rsvp').firstElementChild.classList.remove('md:grid-cols-2');
                 document.getElementById('rsvp').firstElementChild.classList.add('max-w-xl');
            }
            renderGuestbook();
        }

        // Footer
        document.getElementById('footer').innerHTML = `
            <h3 class="text-5xl font-serif text-white">${invitationData.groom_name} &amp; ${invitationData.bride_name}</h3>
            <p class="mt-4">Thank you for being part of our special day.</p>
            <p class="text-sm text-light-sand/50 mt-8">&copy; ${new Date().getFullYear()}. All Rights Reserved.</p>
        `;
    };
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
    const renderGuestbook = () => {
    const guestbookContainer = document.getElementById('guestbook-container');
    if (invitationData.guestbooks.length === 0) {
        guestbookContainer.innerHTML = `<p class="text-center text-gray-500">Belum ada ucapan.</p>`;
        return;
    }
    guestbookContainer.innerHTML = invitationData.guestbooks.map(entry => `
            <div class="bg-ocean-light p-5 rounded-lg border border-seafoam-green/10">
                <div class="flex justify-between items-center">
                    <p class="font-bold text-white">${entry.name}</p>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full ${entry.attendance_status === 'Attending' ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300'}">
                        ${entry.attendance_status}
                    </span>
                </div>
                <p class="text-light-sand/80 my-2 italic">"${entry.message}"</p>
                <small class="text-gray-400 italic">${timeSince(entry.created_at)}</small>

            </div>
        `).join('');
    };

    // --- RAIN ANIMATION WITH LIGHTNING ---
    const setupRainAnimation = () => {
        const canvas = document.getElementById('rain-canvas');
        const ctx = canvas.getContext('2d');
        let drops = [];
        let lightningTimer = null;
        let lightningAlpha = 0;
        let lightningFrequency = 10000; // Time between lightning strikes (ms)
        let lightningDuration = 200; // How long lightning flash lasts (ms)

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        function createDrops() {
            drops = [];
            const dropCount = window.innerWidth < 768 ? 100 : 200; // Increased drop count
            for (let i = 0; i < dropCount; i++) {
                drops.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    length: Math.random() * 25 + 15, // Longer rain drops
                    speed: Math.random() * 3 + 2, // Faster rain
                    opacity: Math.random() * 0.6 + 0.3, // More visible
                    width: Math.random() > 0.9 ? 2 : 1 // Some thicker drops
                });
            }
        }

        function createLightning() {
            // Create lightning effect
            lightningAlpha = 0.9; // Start with high opacity
            
            // Play thunder sound if audio is enabled
            const thunderSound = document.getElementById('thunder-sound');
            if (thunderSound && !thunderSound.paused) {
                thunderSound.currentTime = 0;
                thunderSound.play();
            }
            
            // Schedule next lightning at random interval
            const nextLightning = Math.random() * lightningFrequency + 5000;
            lightningTimer = setTimeout(createLightning, nextLightning);
        }

        function drawLightning() {
            if (lightningAlpha <= 0) return;
            
            // Create a lightning flash effect
            ctx.fillStyle = `rgba(200, 230, 255, ${lightningAlpha})`;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Fade out the lightning
            lightningAlpha -= 0.05;
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Draw lightning if active
            drawLightning();
            
            // Draw rain with blue-purple tint
            ctx.strokeStyle = `rgba(150, 200, 255, 0.6)`;
            
            for (const drop of drops) {
                ctx.globalAlpha = drop.opacity;
                ctx.lineWidth = drop.width;
                ctx.beginPath();
                ctx.moveTo(drop.x, drop.y);
                ctx.lineTo(drop.x - drop.width, drop.y + drop.length);
                ctx.stroke();
            }
            ctx.globalAlpha = 1;
            update();
        }

        function update() {
            for (const drop of drops) {
                drop.y += drop.speed;
                if (drop.y > canvas.height) {
                    drop.y = -drop.length;
                    drop.x = Math.random() * canvas.width;
                }
            }
        }

        let animationFrameId;
        function animate() {
            draw();
            animationFrameId = requestAnimationFrame(animate);
        }
        
        // Start and stop animation based on visibility to save power
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                if(!animationFrameId) animate();
                if(!lightningTimer) {
                    // Start lightning with random delay
                    lightningTimer = setTimeout(createLightning, Math.random() * 3000 + 1000);
                }
            } else {
                cancelAnimationFrame(animationFrameId);
                animationFrameId = null;
                if(lightningTimer) {
                    clearTimeout(lightningTimer);
                    lightningTimer = null;
                }
            }
        });
        observer.observe(document.body);


        window.addEventListener('resize', () => {
            resizeCanvas();
            createDrops();
        });

        resizeCanvas();
        createDrops();
        animate();
        
        // Start first lightning with delay
        setTimeout(createLightning, Math.random() * 3000 + 2000);
    };

    // --- NAVIGATION ---
    const setupNavigation = () => {
        const nav = document.getElementById('navbar');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('nav-sticky');
            } else {
                nav.classList.remove('nav-sticky');
            }
        });
        
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });

        let links = [
            { href: '#couple', text: 'Couple' },
            { href: '#event', text: 'Event' },
            invitationData.livestream && { href: '#livestream', text: 'Live' },
            invitationData.package.has_love_story && { href: '#story', text: 'Story' },
            invitationData.galleries.length > 0 && { href: '#gallery', text: 'Gallery' },
            invitationData.package.has_rsvp && { href: '#rsvp', text: 'RSVP' }
        ].filter(Boolean);

        const linkHTML = links.map(l => `<a href="${l.href}" class="nav-link hover:text-seafoam-green transition-colors">${l.text}</a>`).join('');
        document.getElementById('nav-menu').innerHTML = linkHTML;
        mobileMenu.innerHTML = linkHTML;
        
        // Close mobile menu on link click
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if(!mobileMenu.classList.contains('hidden')) {
                   mobileMenu.classList.add('hidden');
                   mobileMenu.classList.remove('flex');
                }
            });
        });

    };
    
    // --- INTERACTIVITY ---
    const setupInteractivity = () => {
        // Lightbox
        document.getElementById('gallery-container')?.addEventListener('click', (e) => {
            const item = e.target.closest('[data-src]');
            if (item) {
                document.getElementById('lightbox').classList.remove('hidden');
                document.getElementById('lightbox-img').src = item.dataset.src;
            }
        });
        document.getElementById('lightbox')?.addEventListener('click', () => document.getElementById('lightbox').classList.add('hidden'));

        // Copy button
        document.getElementById('rsvp')?.addEventListener('click', e => {
            const button = e.target.closest('.copy-btn');
            if (button) {
                navigator.clipboard.writeText(button.dataset.copy);
                button.textContent = 'Copied!';
                setTimeout(() => button.textContent = 'Copy', 2000);
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
                  document.getElementById('rsvp-section').innerHTML = `
                        <div class="text-center h-full flex flex-col justify-center items-center">
                            <h3 class="text-3xl font-serif text-white">Thank You!</h3>
                            <p class="text-light-sand mt-2">Your wishes have been received.</p>
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
      const sections = document.querySelectorAll('section[id] > div');
      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.classList.add('fade-in');
                  observer.unobserve(entry.target.parentElement);
              }
          });
      }, { threshold: 0.15 });
      sections.forEach(section => {
        // Exclude story section from this animation type
        if (section.parentElement.id !== 'story' && section.parentElement.id !== 'gallery') {
           observer.observe(section.parentElement)
        }
      });
    };

    // --- WATER RIPPLE EFFECT ---
    const setupWaterRipple = () => {
        const rippleContainer = document.getElementById('ripple-container');
        const raindropContainer = document.getElementById('raindrop-container');
        
        // Create random ripples
        function createRipple() {
            const ripple = document.createElement('div');
            ripple.classList.add('ripple');
            
            // Random position
            const x = Math.random() * rippleContainer.offsetWidth;
            const y = Math.random() * rippleContainer.offsetHeight;
            
            // Random size
            const size = Math.random() * 100 + 50;
            
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            ripple.style.width = `${size}px`;
            ripple.style.height = `${size}px`;
            
            rippleContainer.appendChild(ripple);
            
            // Remove after animation completes
            setTimeout(() => {
                ripple.remove();
            }, 2000);
        }
        
        // Create raindrops on text
        function createRaindrop() {
            const raindrop = document.createElement('div');
            raindrop.classList.add('raindrop');
            
            // Random position
            const x = Math.random() * raindropContainer.offsetWidth;
            const y = Math.random() * (raindropContainer.offsetHeight / 2); // Only in top half
            
            raindrop.style.left = `${x}px`;
            raindrop.style.top = `${y}px`;
            
            raindropContainer.appendChild(raindrop);
            
            // Remove after animation completes
            setTimeout(() => {
                raindrop.remove();
            }, 1000);
        }
        
        // Create ripples at intervals
        setInterval(createRipple, 300);
        
        // Create raindrops at intervals
        setInterval(createRaindrop, 100);
    };
    
    // --- SOUND CONTROL ---
    const setupSoundControl = () => {
        const soundToggle = document.getElementById('sound-toggle');
        const rainSound = document.getElementById('rain-sound');
        let soundEnabled = false;
        
        // Toggle sound on/off
        soundToggle.addEventListener('click', () => {
            if (soundEnabled) {
                rainSound.pause();
                soundToggle.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-seafoam-green">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <line x1="23" y1="9" x2="17" y2="15"></line>
                        <line x1="17" y1="9" x2="23" y2="15"></line>
                    </svg>
                `;
            } else {
                rainSound.volume = 0.3; // Set volume to 30%
                rainSound.play();
                soundToggle.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-seafoam-green">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
                    </svg>
                `;
            }
            soundEnabled = !soundEnabled;
        });
    };
    
    // --- INITIALIZATION ---
    populateContent();
    setupRainAnimation();
    setupNavigation();
    setupInteractivity();
    setupAnimations();
    setupWaterRipple();
    setupSoundControl();
});
</script>
</body>
</html>

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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <script>
      // Custom Tailwind theme configuration
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              cream: '#fdfbf6',
              charcoal: '#333d29',
              'sage-green': '#656d4a',
              'gold-accent': '#b08968',
            },
            fontFamily: {
              sans: ['Montserrat', 'sans-serif'],
              serif: ['Cormorant Garamond', 'serif'],
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
        background-color: #fdfbf6;
        color: #333d29;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      .scale-in-fade {
        animation: scaleInFade 1s ease-out forwards;
      }
      @keyframes scaleInFade {
        from {
          opacity: 0;
          transform: scale(0.95);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }
      section.visible {
        opacity: 1;
      }
      .floating-leaf {
        animation: floatAnimation 6s ease-in-out infinite;
      }
      @keyframes floatAnimation {
        0%, 100% { transform: translateY(0) rotate(-5deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
      }
      .gallery-item {
        break-inside: avoid;
        margin-bottom: 1rem;
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

    <!-- Floating Navigation -->
    <button id="nav-toggle" class="fixed bottom-6 right-6 z-50 w-16 h-16 bg-sage-green text-white rounded-full shadow-lg flex items-center justify-center transition-transform duration-300 hover:scale-110">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M4 17c.9-1.3 2.2-2.5 3.5-3.5s2.8-1.8 4.5-2.5c2.3-.9 4.9-1 7-1" /><path d="M4 7c.9 1.3 2.2 2.5 3.5 3.5s2.8 1.8 4.5 2.5c2.3.9 4.9 1 7 1" /><path d="M12 12c4.2 0 7.5 1.5 7.5 3S16.2 18 12 18s-7.5-1.5-7.5-3c0-1.1.9-2 2.2-2.6" /></svg>
    </button>
    
    <div id="nav-menu" class="hidden fixed inset-0 z-40 bg-cream/80 backdrop-blur-lg">
      <div class="flex flex-col items-center justify-center h-full space-y-8">
         <!-- JS will populate nav links -->
      </div>
    </div>
    
    <main class="overflow-x-hidden">
        <!-- Hero Section -->
        <header id="home" class="relative h-screen flex flex-col justify-center items-center text-charcoal text-center p-6">
            <div id="hero-bg" class="absolute inset-0 bg-cover bg-center transition-transform duration-500 ease-out scale-105"></div>
            <div class="absolute inset-0 bg-cream/70"></div>
            <div class="absolute inset-0 overflow-hidden">
                <div class="relative w-full h-full" id="falling-leaves-container">
                    <!-- JS will populate falling leaves -->
                </div>
            </div>
            <div class="relative z-10 scale-in-fade">
                <p class="text-xl sm:text-2xl tracking-wider mb-4 font-light">We Are Getting Married</p>
                <h1 id="hero-couple-names" class="text-6xl sm:text-8xl font-serif"></h1>
                <div class="h-px w-24 bg-charcoal/30 mx-auto my-8"></div>
                <p id="hero-date" class="text-xl sm:text-2xl font-semibold tracking-wider"></p>
            </div>
            <div class="absolute bottom-10 z-10 text-center">
              <p class="text-lg">Dear,</p>
              <p id="hero-guest-name" class="text-2xl font-bold mt-1"></p>
            </div>
        </header>

        <!-- Leaf Divider -->
        <div class="py-20 flex justify-center text-sage-green/50">
             <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-16 h-16"><path d="M4 17c.9-1.3 2.2-2.5 3.5-3.5s2.8-1.8 4.5-2.5c2.3-.9 4.9-1 7-1"/><path d="M12 12c4.2 0 7.5 1.5 7.5 3S16.2 18 12 18s-7.5-1.5-7.5-3c0-1.1.9-2 2.2-2.6"/></svg>
        </div>
        
        <!-- Couple Section -->
        <section id="couple" class="py-24 px-6 sm:px-12 transition-opacity duration-1000 ease-in opacity-0">
          <div class="max-w-5xl mx-auto space-y-20" id="couple-container">
            <!-- JS will populate this -->
          </div>
        </section>

        <!-- Quote Section -->
        <section id="quote" class="py-24 px-6 sm:px-12 text-center bg-cover bg-fixed bg-center transition-opacity duration-1000 ease-in opacity-0" style="background-image: url('https://picsum.photos/id/1015/1920/1080')">
          <div class="max-w-3xl mx-auto p-10 bg-cream/80 backdrop-blur-sm rounded-lg shadow-lg">
            <blockquote id="quote-text" class="text-2xl sm:text-3xl font-serif italic text-charcoal leading-relaxed relative px-4">
            </blockquote>
            <p id="quote-source" class="mt-6 text-lg text-charcoal/80 font-semibold"></p>
          </div>
        </section>

        <!-- Story Section (Conditional) -->
        <section id="story" class="hidden py-24 px-6 sm:px-12 transition-opacity duration-1000 ease-in opacity-0">
           <h2 class="text-5xl sm:text-6xl font-serif text-center text-charcoal mb-20">Our Love Story</h2>
           <div class="relative max-w-3xl mx-auto">
             <div class="absolute left-4 md:left-1/2 w-0.5 h-full bg-gold-accent/30 -translate-x-1/2"></div>
             <div id="story-container" class="space-y-16">
               <!-- JS will populate this -->
             </div>
           </div>
        </section>
        
        <!-- Event Section -->
        <section id="event" class="py-24 px-6 sm:px-12 bg-sage-green/10 transition-opacity duration-1000 ease-in opacity-0">
           <h2 class="text-5xl sm:text-6xl font-serif text-center text-charcoal mb-16">The Wedding Day</h2>
           <div id="event-container" class="max-w-4xl mx-auto flex flex-col md:flex-row justify-center items-stretch gap-8">
              <!-- JS will populate this -->
           </div>
        </section>

        <!-- Gallery Section (Conditional) -->
        <section id="gallery" class="hidden py-24 px-6 sm:px-12 transition-opacity duration-1000 ease-in opacity-0">
            <h2 class="text-5xl sm:text-6xl font-serif text-center text-charcoal mb-16">Happy Moments</h2>
            <div id="gallery-container" class="max-w-6xl mx-auto" style="column-count: 2; column-gap: 1rem; sm:column-count: 3;">
                <!-- JS will populate this -->
            </div>
        </section>

        <!-- Gift Section (Conditional) -->
        <section id="gift" class="hidden py-24 px-6 sm:px-12 bg-sage-green/10 transition-opacity duration-1000 ease-in opacity-0">
            <h2 class="text-5xl sm:text-6xl font-serif text-center text-charcoal mb-16">Wedding Gift</h2>
            <div class="max-w-4xl mx-auto text-center">
                <p class="text-charcoal/80 mb-12 max-w-2xl mx-auto">
                    Your presence and blessings are the greatest gift. However, should you wish to give a token of your love, we would be deeply grateful.
                </p>
                <div id="gift-container" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                   <!-- JS will populate this -->
                </div>
            </div>
        </section>

        <!-- RSVP Section (Conditional) -->
        @if(($invitation->package)->has_rsvp)

        <section id="rsvp" class="hidden py-24 px-6 sm:px-12 transition-opacity duration-1000 ease-in opacity-0">
            <h2 class="text-5xl sm:text-6xl font-serif text-center text-charcoal mb-16">Are You Attending?</h2>
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
                <div id="form-container">
                    <form id="rsvp-form" 
                        action="{{ $formAction }}" 
                        method="POST" class="bg-white p-8 sm:p-10 border border-gold-accent/20 shadow-xl space-y-6 rounded-lg">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-charcoal/80 mb-2">Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 border border-gold-accent/30 rounded-md focus:ring-2 focus:ring-gold-accent focus:border-gold-accent outline-none transition-shadow bg-cream/50" />
                        
                        </div>
                        <div>
                            <label for="attendance_status" class="block text-sm font-semibold text-charcoal/80 mb-2">Attendance Confirmation</label>
                            <select name="attendance_status" required class="w-full px-4 py-3 border border-gold-accent/30 rounded-md focus:ring-2 focus:ring-gold-accent focus:border-gold-accent outline-none transition-shadow bg-cream/50">
                                <option value="" disabled selected>Please select...</option>
                                <option value="Hadir">Yes, I will be there</option>
                                <option value="Tidak Hadir">Sorry, I can't make it</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-charcoal/80 mb-2">Wishes & Prayers</label>
                            <textarea name="message" required rows="4" class="w-full px-4 py-3 border border-gold-accent/30 rounded-md focus:ring-2 focus:ring-gold-accent focus:border-gold-accent outline-none transition-shadow bg-cream/50" maxLength="500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-sage-green text-white px-6 py-4 text-sm font-bold tracking-wider rounded-md hover:bg-charcoal transition-colors disabled:bg-sage-green/50">Send Confirmation</button>
                    </form>
                </div>
                <div class="mt-4 md:mt-0">
                    <h3 class="text-3xl font-serif text-charcoal text-center mb-6">Wishes from Friends</h3>
                    <div class="max-h-[30rem] overflow-y-auto space-y-4 pr-3">
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
    <footer id="footer" class="bg-charcoal text-cream text-center py-12 px-6 mt-16">
       <!-- JS will populate this -->
    </footer>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-charcoal/90 z-[100] items-center justify-center p-4" style="animation: fadeIn 0.3s ease-in-out forwards;">
        <button id="lightbox-close" class="absolute top-6 right-6 text-white hover:text-cream/80 transition-colors" aria-label="Close">
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
    const formatDate = (date) => new Date(date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
    const timeSince = (date) => {
        const seconds = Math.floor((new Date() - new Date(date)) / 1000);
        let interval = seconds / 31536000;
        if (interval > 1) return Math.floor(interval) + " years ago";
        interval = seconds / 2592000;
        if (interval > 1) return Math.floor(interval) + " months ago";
        interval = seconds / 86400;
        if (interval > 1) return Math.floor(interval) + " days ago";
        interval = seconds / 3600;
        if (interval > 1) return Math.floor(interval) + " hours ago";
        interval = seconds / 60;
        if (interval > 1) return Math.floor(interval) + " minutes ago";
        return "Just now";
    };

    // --- DOM POPULATION ---
    const populateContent = () => {
        document.title = `Wedding Invitation | ${invitationData.groom_name} & ${invitationData.bride_name}`;
        
        // Hero
        // document.getElementById('hero-bg').style.backgroundImage = `url(${invitationData.hero_image})`;
        document.getElementById('hero-couple-names').innerHTML = `${invitationData.groom_name} &amp; ${invitationData.bride_name}`;
        document.getElementById('hero-date').textContent = invitationData.events[0] ? formatDate(invitationData.events[0].event_date) : 'Coming Soon';
        const guestName = new URLSearchParams(window.location.search).get('to') || 'Honored Guest';
        document.getElementById('hero-guest-name').textContent = guestName;

        // Quote
        document.getElementById('quote-text').innerHTML += invitationData.quote;
        document.getElementById('quote-source').textContent = `- ${invitationData.quote_source} -`;

        // Couple
        document.getElementById('couple-container').innerHTML = `
            <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
                <div class="w-full md:w-1/2 flex justify-center">
                    <img src="{{ asset('storage/' . ($invitation->groom_photo_path ?? 'images/defaults/default-groom.webp')) }}" alt="Photo of ${invitationData.groom_name}" class="w-80 h-80 object-cover rounded-full shadow-2xl" />
                </div>
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <h3 class="text-6xl font-serif text-charcoal">${invitationData.groom_name}</h3>
                    <p class="mt-4 text-lg text-charcoal/80">${invitationData.groom_info}</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row-reverse items-center gap-10 md:gap-16">
                 <div class="w-full md:w-1/2 flex justify-center">
                    <img src="{{ asset('storage/' . ($invitation->bride_photo_path ?? 'images/defaults/default-bride.webp')) }}" alt="Photo of ${invitationData.bride_name}" class="w-80 h-80 object-cover rounded-full shadow-2xl" />
                </div>
                <div class="w-full md:w-1/2 text-center md:text-right">
                    <h3 class="text-6xl font-serif text-charcoal">${invitationData.bride_name}</h3>
                    <p class="mt-4 text-lg text-charcoal/80">${invitationData.bride_info}</p>
                </div>
            </div>
        `;

        // Story (REFINED)
        if (invitationData.package.has_love_story) {
            document.getElementById('story').classList.remove('hidden');
            document.getElementById('story-container').innerHTML = invitationData.stories.map((story, index) => {
                const isLeft = index % 2 === 0;
                const alignmentClass = isLeft ? 'md:mr-auto' : 'md:ml-auto';
                const content = `
                    <div class="pl-12 md:pl-0">
                        <div class="bg-white p-6 rounded-lg shadow-lg border border-gold-accent/20">
                            <time class="text-sm italic text-charcoal/60 mb-2 block">${story.story_date}</time>
                            <h3 class="text-2xl font-serif text-charcoal mb-3">${story.title}</h3>
                            <p class="text-charcoal/80">${story.description}</p>
                        </div>
                    </div>`;

                return `
                    <div class="relative md:w-1/2 ${alignmentClass}">
                        <div class="absolute top-1 -left-2 md:left-auto md:-right-2 w-5 h-5 rounded-full border-2 border-gold-accent/40 bg-cream flex items-center justify-center z-10">
                            <div class="w-2 h-2 bg-gold-accent rounded-full"></div>
                        </div>
                        <div class="absolute top-3 left-0 md:left-auto ${isLeft ? 'md:-right-8' : 'md:-left-8'} text-gold-accent/50 transform ${isLeft ? '' : '-scale-x-100'}">
                            <svg width="34" height="25" viewBox="0 0 34 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M33 1C21.1667 2.16667 2.4 10.2 1 24" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        ${content}
                    </div>
                `;
            }).join('');
        }


        // Event
        document.getElementById('event-container').innerHTML = invitationData.events.map(event => `
            <div class="bg-cream p-8 border border-gold-accent/20 shadow-lg text-center flex-1 min-w-[300px] rounded-lg relative overflow-hidden">
                <div class="absolute -top-4 -left-4 w-16 h-16 text-gold-accent/20">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M15 9l-6 6"/><path d="M9 9l6 6"/></svg>
                </div>
                <h3 class="text-4xl font-serif text-charcoal mb-6">${event.title}</h3>
                <div class="space-y-3 text-charcoal/80">
                    <p class="font-bold text-lg">${formatDate(event.event_date)}</p>
                    <p>At ${event.start_time}</p>
                    <div class="h-px w-16 bg-gold-accent/30 mx-auto my-4"></div>
                    <p class="font-semibold">${event.venue_name}</p>
                    <p class="text-sm px-4">${event.venue_address}</p>
                </div>
                ${event.google_maps_link ? `<a href="${event.google_maps_link}" target="_blank" rel="noopener noreferrer" class="inline-block mt-8 bg-sage-green text-white px-8 py-3 text-sm font-semibold tracking-wider rounded-md hover:bg-charcoal transition-colors">View Map</a>` : ''}
            </div>
        `).join('');
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
                <div class="gallery-item overflow-hidden rounded-lg shadow-md cursor-pointer group" data-src="${imageUrl}">
                    <img src="${imageUrl}" alt="${item.alt || 'Gallery Image'}" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" />
                </div>
            `;
            }).join('');
        }

        // Gift (REFINED)
        if (invitationData.gifts.length > 0) {
            document.getElementById('gift').classList.remove('hidden');
            document.getElementById('gift-container').innerHTML = invitationData.gifts.map(gift => `
                <div class="bg-white p-8 border border-gold-accent/20 text-center rounded-lg shadow-lg flex flex-col items-center">
                    <div class="w-16 h-16 mb-4 text-gold-accent flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12"><path d="M20 12v10H4V12"/><path d="M20 7H4V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3z"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                    </div>
                    <h3 class="text-2xl font-serif text-charcoal">${gift.bank_name}</h3>
                    <p class="text-charcoal/60 text-sm mt-1 mb-4">${gift.account_holder_name}</p>
                    <p class="text-2xl font-mono text-charcoal mb-4">${gift.account_number}</p>
                    <button data-copy="${gift.account_number}" class="copy-btn w-48 text-center bg-sage-green/10 text-sage-green border border-sage-green/30 px-6 py-2 rounded-full hover:bg-sage-green hover:text-white transition-colors duration-300">
                        <span class="copy-text">Copy Number</span>
                    </button>
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
            <p class="text-2xl font-serif mb-2">Thank you</p>
            <p class="text-base text-cream/70 mb-6">For your prayers and presence</p>
            <h3 class="text-5xl font-serif">${invitationData.groom_name} &amp; ${invitationData.bride_name}</h3>
            <p class="text-sm text-cream/50 mt-8">&copy; ${new Date().getFullYear()}. All Rights Reserved.</p>
        `;
    };

    const renderGuestbook = () => {
        const guestbookContainer = document.getElementById('guestbook-container');
        if (invitationData.guestbooks.length === 0) {
            guestbookContainer.innerHTML = `<p class="text-center text-charcoal/60">Be the first to leave a wish.</p>`;
            return;
        }
        guestbookContainer.innerHTML = invitationData.guestbooks.map(entry => `
            <div class="bg-white p-5 border-l-4 border-gold-accent/50 rounded-r-lg shadow-sm">
                <div class="flex justify-between items-center">
                    <p class="font-bold text-charcoal">${entry.name}</p>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full ${entry.attendance_status === 'Attending' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        ${entry.attendance_status}
                    </span>
                </div>
                <p class="text-charcoal/80 my-2">"${entry.message}"</p>
                <small class="text-charcoal/40 italic">${timeSince(entry.created_at)}</small>
            </div>
        `).join('');
    };
    
    // --- NAVIGATION ---
    const setupNavigation = () => {
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        
        let links = [
            { href: '#couple', text: 'Couple' },
            invitationData.package.has_love_story && { href: '#story', text: 'Story' },
            { href: '#event', text: 'Event' },
            invitationData.galleries.length > 0 && { href: '#gallery', text: 'Gallery' },
            invitationData.package.has_rsvp && { href: '#rsvp', text: 'RSVP' }
        ].filter(Boolean);

        navMenu.firstElementChild.innerHTML = links.map(link => `<a href="${link.href}" class="nav-link font-serif text-4xl text-charcoal hover:text-gold-accent transition-colors">${link.text}</a>`).join('');

        const toggleMenu = () => {
             navMenu.classList.toggle('hidden');
        }

        navToggle.addEventListener('click', toggleMenu);
        navMenu.addEventListener('click', (e) => {
            if (e.target.classList.contains('nav-link')) {
                toggleMenu();
            }
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

        // Gift Copy to Clipboard (REFINED)
        document.getElementById('gift-container')?.addEventListener('click', (e) => {
            const button = e.target.closest('.copy-btn');
            if(button && !button.disabled) {
                navigator.clipboard.writeText(button.dataset.copy);
                const originalText = button.querySelector('.copy-text').innerHTML;
                
                button.querySelector('.copy-text').innerHTML = 'Copied!';
                button.classList.add('bg-gold-accent', 'text-white');
                button.disabled = true;

                setTimeout(() => {
                    button.querySelector('.copy-text').innerHTML = originalText;
                    button.classList.remove('bg-gold-accent', 'text-white');
                    button.disabled = false;
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
        // Section scroll observer
        const sections = document.querySelectorAll('section[id]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible', 'scale-in-fade');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        sections.forEach(section => observer.observe(section));

        // Hero background zoom
        const heroBg = document.getElementById('hero-bg');
        setTimeout(() => heroBg.classList.remove('scale-105'), 100);

        // Falling leaves
        const leavesContainer = document.getElementById('falling-leaves-container');
        for (let i = 0; i < 15; i++) {
            const leaf = document.createElement('div');
            leaf.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="w-full h-full"><path d="M4 17c.9-1.3 2.2-2.5 3.5-3.5s2.8-1.8 4.5-2.5c2.3-.9 4.9-1 7-1" /><path d="M12 12c4.2 0 7.5 1.5 7.5 3S16.2 18 12 18s-7.5-1.5-7.5-3c0-1.1.9-2 2.2-2.6" /></svg>`;
            leaf.className = 'absolute text-sage-green/40';
            const size = Math.random() * 30 + 20; // 20px to 50px
            leaf.style.width = `${size}px`;
            leaf.style.height = `${size}px`;
            leaf.style.left = `${Math.random() * 100}vw`;
            leaf.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
            leaf.style.animationDelay = `${Math.random() * 10}s`;
            leavesContainer.appendChild(leaf);
        }
        const styleSheet = document.createElement("style");
        styleSheet.innerText = `@keyframes fall { 0% { top: -10%; transform: rotate(0deg); } 100% { top: 110%; transform: rotate(${Math.random() * 720}deg); } }`;
        document.head.appendChild(styleSheet);
    };

    // --- INITIALIZATION ---
    populateContent();
    setupNavigation();
    setupInteractivity();
    setupAnimations();
});
</script>
</body>
</html>
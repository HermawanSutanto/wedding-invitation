
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedding Invitation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bg-color: #0a192f;      /* Midnight Blue */
            --text-color: #e6f1ff;    /* Soft Off-White */
            --primary-color: #f7d794; /* Luminous Gold */
            --accent-color: #b8b5ff;  /* Soft Lavender */
            --bg-color-alt: #112240;  /* Lighter Navy */
            --font-heading: "Parisienne", cursive;
            --font-body: "Cormorant Garamond", serif;
        }

        /* --- Base & Typography --- */
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            color: var(--text-color);
            background-color: var(--bg-color);
            margin: 0;
            overflow: hidden;
        }
        .font-heading {
            font-family: var(--font-heading);
            color: var(--primary-color);
            font-weight: 400;
        }
        
        /* --- Animations --- */
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes pulse-glow {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 15px 0px rgba(247, 215, 148, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 25px 10px rgba(247, 215, 148, 0.6);
            }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes floatUp {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(-100vh); opacity: 0; }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(3rem) scale(0.95);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .animate-on-scroll.visible { opacity: 1; transform: translateY(0) scale(1); }

        /* --- Animated Background --- */
        #starry-sky-canvas, #fx-container {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        #fx-container { z-index: 999; }
        .firefly {
            position: absolute;
            bottom: -20px;
            background-color: var(--primary-color);
            border-radius: 50%;
            opacity: 0.7;
            animation: floatUp linear forwards;
            box-shadow: 0 0 8px 2px var(--primary-color);
        }

        /* --- Cover Section --- */
        #cover {
            position: fixed; inset: 0; z-index: 1000;
            display: flex; justify-content: center; align-items: center; text-align: center;
            color: var(--text-color);
            background: radial-gradient(ellipse at center, #112240 0%, #0a192f 100%);
            transition: opacity 1.5s ease-out, visibility 1.5s;
        }
        #cover.hidden { opacity: 0; visibility: hidden; }
        .cover-content {
            position: relative; z-index: 1; padding: 1.25rem;
            display: flex; flex-direction: column; align-items: center;
            animation: fadeIn 2.5s ease-in-out;
        }
        .cover-content h1 {
            font-size: 3.75rem;
            text-shadow: 0 0 10px var(--primary-color);
        }
        #guest-name {
            font-size: 1.5rem; font-weight: 600; color: var(--accent-color);
            margin: 0.5rem 0; padding: 0.5rem 1rem;
            border: 1px solid rgba(184, 181, 255, 0.3);
            border-radius: 20px;
            background: rgba(255,255,255,0.05);
        }
        #open-invitation {
            margin-top: 2rem; padding: 0.75rem 2rem;
            background-color: var(--primary-color); color: var(--bg-color);
            border: none; border-radius: 9999px;
            font-family: var(--font-body); font-size: 1.125rem; font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
            animation: pulse-glow 2.5s infinite;
        }
        #open-invitation:hover {
            animation-play-state: paused;
            background-color: var(--accent-color); color: white;
            transform: scale(1.05);
        }

        /* --- Main Content --- */
        main { display: none; }
        section {
            position: relative; padding: 5rem 1.25rem;
            text-align: center; overflow: hidden;
            background: transparent;
        }
        .section-title {
            font-size: 3.75rem; margin-bottom: 3rem;
            text-shadow: 0 0 8px var(--primary-color);
        }
        .container {
            max-width: 72rem;
            margin: 0 auto;
            padding: 2.5rem;
            background: rgba(173, 203, 255, 0.411);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(247, 215, 148, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        section:first-of-type .container {
             background: none; backdrop-filter: none; border: none; box-shadow: none;
        }


        /* --- Hero Section --- */
        #home {
            height: 100vh; display: flex; justify-content: center; align-items: center;
            text-align: center; color: white; position: relative;
            background-size: cover; background-position: center; padding: 0;
        }
        #home::before {
            content: ''; position: absolute; inset: 0; 
            background: linear-gradient(to top, var(--bg-color) 0%, rgba(10, 25, 47, 0.3) 50%, var(--bg-color) 100%);
        }
        .hero-content { position: relative; z-index: 1; padding: 1.25rem; }
        .hero-content h1 {
            font-size: 4.5rem; color: white;
            text-shadow: 0 0 15px rgba(255,255,255,0.7);
        }
        .hero-content .date {
            font-size: 1.25rem; margin-top: 1rem;
            letter-spacing: 0.1em; text-transform: uppercase; color: var(--accent-color);
        }
        
        /* --- Quote Section --- */
        #quote blockquote {
            font-size: 1.5rem;
            font-style: italic;
            border-left: 3px solid var(--primary-color);
            padding-left: 1.5rem;
            text-align: left;
        }
        #quote h4 { text-align: left; margin-left: 1.5rem; }

        /* --- Couple Section --- */
        #couple-container {
            display: flex; flex-direction: column; justify-content: center;
            align-items: center; gap: 1rem;
        }
        .couple-info img {
            width: 12rem; height: 12rem; border-radius: 9999px;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            padding: 5px;
            box-shadow: 0 0 25px 0px rgba(247, 215, 148, 0.5);
        }
        .couple-info h3 { font-size: 3rem; margin-top: 1rem; margin-bottom: 0.5rem; }
        .couple-separator { font-size: 4.5rem; margin: 1rem 0; color: var(--primary-color); }

        /* --- Love Story (Timeline) --- */
        #timeline-container { position: relative; max-width: 56rem; margin: 0 auto; }
        .timeline-line {
            position: absolute; width: 2px;
            background: linear-gradient(to bottom, transparent, var(--accent-color), transparent);
            top: 0; bottom: 0; left: 1.25rem;
        }
        .timeline-item {
            position: relative; padding-left: 3.5rem; margin-bottom: 2.5rem;
        }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-icon {
            position: absolute; left: 1.25rem; top: 0; transform: translateX(-50%);
            width: 2.5rem; height: 2.5rem; border-radius: 50%;
            background-color: var(--accent-color); color: white;
            display: flex; align-items: center; justify-content: center;
            border: 4px solid var(--bg-color); z-index: 1;
            box-shadow: 0 0 15px 2px var(--accent-color);
        }
        .timeline-content {
            background: transparent; padding: 1.5rem; border-radius: 0.5rem;
            text-align: left; position: relative;
        }
        .timeline-content h3 {
            font-size: 1.75rem; font-weight: 600; color: var(--primary-color);
            font-family: var(--font-body);
        }
        
        /* --- Event Details & Countdown --- */
        .countdown-timer {
            display: flex; justify-content: center; gap: 0.75rem; margin: 2rem 0;
        }
        .time-box {
            background: transparent; padding: 1rem; width: 6rem; border-radius: 0.5rem;
            border: 1px solid rgba(247, 215, 148, 0.3);
        }
        .time-box .time-value {
            display: block; font-size: 2.25rem; font-weight: 600; color: var(--primary-color);
        }
        .time-box .time-label { display: block; font-size: 0.875rem; font-weight: 400; }
        .events-container {
            display: flex; flex-wrap: wrap; justify-content: center;
            align-items: stretch; gap: 2rem; margin-top: 2rem;
        }
        .event-card {
            background: transparent; border-radius: 0.5rem;
            border: 1px solid rgba(184, 181, 255, 0.3);
            width: 100%; max-width: 24rem;
            text-align: center; flex: 1; min-width: 280px; overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px 0 rgba(184, 181, 255, 0.3);
        }
        .event-card-header {
            background-color: rgba(247, 215, 148, 0.1); color: var(--primary-color); padding: 1rem;
        }
        .event-card-header h3 { font-size: 1.875rem; }
        .event-card-body { padding: 1.5rem; }
        .event-card-body p {
            display: flex; align-items: center; justify-content: center;
            gap: 0.5rem; margin-bottom: 0.5rem;
        }
        .event-card-body i { width: 1rem; color: var(--accent-color); }
        .map-button {
            display: inline-block; margin-top: 1rem; padding: 0.5rem 1.5rem;
            background-color: transparent; color: var(--primary-color);
            border-radius: 9999px; text-decoration: none;
            border: 1px solid var(--primary-color);
            transition: background-color 0.3s, color 0.3s;
        }
        .map-button:hover { background-color: var(--primary-color); color: var(--bg-color); }

        /* --- Gallery --- */
        #gallery-grid {
            columns: 2;
            gap: 0.75rem;
        }
        .gallery-item {
            position: relative;
            overflow: hidden; border-radius: 0.5rem;
            cursor: pointer;
            margin-bottom: 0.75rem;
            break-inside: avoid;
            border: 2px solid rgba(247, 215, 148, 0.5);
        }
        .gallery-item img {
            width: 100%; height: auto; object-fit: cover;
            transition: transform 0.5s;
        }
        .gallery-item:hover img { transform: scale(1.10); }

        /* --- Gallery Modal --- */
        #gallery-modal {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.9);
            z-index: 1001; display: flex; align-items: center; justify-content: center;
            padding: 1rem; display: none;
            backdrop-filter: blur(5px);
        }
        #gallery-modal.visible { display: flex; animation: fadeIn 0.3s; }
        #modal-close {
            position: absolute; top: 1rem; right: 1.5rem; color: white;
            font-size: 2.5rem; cursor: pointer; z-index: 20;
        }
        #modal-image {
            max-width: 90vw; max-height: 90vh; object-fit: contain;
            border-radius: 0.5rem;
        }

        /* --- Dress Code --- */
        .color-palette {
            display: flex; justify-content: center; gap: 1rem; margin: 1.5rem 0;
        }
        .color-box {
            width: 4rem; height: 4rem; border-radius: 9999px;
            border: 2px solid var(--accent-color);
        }

        /* --- Wedding Gift --- */
        .gift-container {
            display: flex; flex-direction: column; align-items: center; gap: 1.5rem;
        }
        .gift-card {
            background: transparent; padding: 1.5rem; border-radius: 0.5rem;
            border: 1px solid rgba(247, 215, 148, 0.3);
            width: 100%; max-width: 28rem; text-align: center;
        }
        .gift-card h4 { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--accent-color); }
        .gift-card .account-number {
            font-size: 1.5rem; font-weight: 600;
            color: var(--primary-color); margin-bottom: 0.5rem;
        }
        .copy-button {
            padding: 0.5rem 1.5rem; border-radius: 9999px;
            color: var(--bg-color); cursor: pointer;
            background-color: var(--primary-color); border: none;
        }

        /* --- RSVP & Guestbook --- */
        #rsvp-form input, #rsvp-form select, #rsvp-form textarea {
            width: 100%; box-sizing: border-box; padding: 0.75rem;
            border: 1px solid rgba(184, 181, 255, 0.3);
            border-radius: 0.5rem;
            font-family: var(--font-body); font-size: 1.25rem;
            background: rgba(10, 25, 47, 0.8);
            color: var(--text-color);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        #rsvp-form input:focus, #rsvp-form select:focus, #rsvp-form textarea:focus {
            outline: none; border-color: transparent;
            box-shadow: 0 0 0 2px var(--primary-color);
        }
        #rsvp-form button {
            padding: 0.75rem; border: none; background: var(--primary-color);
            color: var(--bg-color); font-size: 1.125rem; border-radius: 9999px;
            cursor: pointer; font-weight: 600;
        }
        
        .guestbook-list {
            max-height: 24rem; overflow-y: auto; padding: 1rem;
            display: flex; flex-direction: column; gap: 1rem;
        }
        .guestbook-entry {
            background: transparent; padding: 1rem; border-radius: 0.5rem;
            border: 1px solid rgba(184, 181, 255, 0.2); text-align: left;
        }
        .guestbook-header .name { font-weight: 600; color: var(--primary-color); font-size: 1.2rem; }
        .guestbook-header .status {
            margin-left: 0.75rem; font-size: 0.75rem; font-weight: 600;
            padding: 0.25rem 0.5rem; border-radius: 9999px;
        }
        .status.hadir { background-color: rgba(184, 181, 255, 0.2); color: var(--accent-color); }
        .status.tidak-hadir { background-color: rgba(255, 181, 181, 0.2); color: #ffb5b5; }

        /* --- Footer --- */
        footer {
            padding: 4rem 1.25rem;
            background: linear-gradient(to top, #0a192f, transparent);
            text-align: center;
        }

        /* --- Floating Buttons (Music & Nav) --- */
        #music-toggle {
            position: fixed; bottom: 6rem; right: 1.25rem;
            width: 3rem; height: 3rem; background-color: var(--primary-color);
            color: var(--bg-color); border: none; border-radius: 9999px;
            font-size: 1.25rem; z-index: 999; display: flex; justify-content: center; align-items: center;
            cursor: pointer; transition: transform 0.3s;
        }
        #music-toggle.playing { animation: spin 8s linear infinite; }
        #music-toggle:hover { transform: scale(1.1); }
        #bottom-nav {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: rgba(10, 25, 47, 0.8); backdrop-filter: blur(4px);
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            display: flex; justify-content: space-around; padding: 0.5rem; z-index: 998;
            border-top: 1px solid rgba(247, 215, 148, 0.2);
        }
        #bottom-nav a { color: var(--text-color); text-decoration: none; }
        #bottom-nav a:hover { color: var(--primary-color); }

        /* --- Responsive Design --- */
        @media (min-width: 768px) {
            .cover-content h1 { font-size: 5rem; }
            .hero-content h1 { font-size: 6rem; }
            #couple-container { flex-direction: row; gap: 1rem; }
            .couple-info img { width: 14rem; height: 14rem; }
            .couple-info h3 { font-size: 3.75rem; }
            .couple-separator { margin: 0 2rem; font-size: 6rem; }
            .section-title { font-size: 4.5rem; }
            .countdown-timer { gap: 1.25rem; }
            #gallery-grid { columns: 3; }
            #bottom-nav { display: none; }
            #music-toggle { bottom: 2rem; }
            
            .timeline-line { left: 50%; }
            .timeline-item { width: 50%; }
            .timeline-item.right { align-self: flex-end; padding-left: 2.5rem; padding-right: 0; }
            .timeline-item.left { align-self: flex-start; padding-right: 2.5rem; text-align: right; }
            .timeline-item.left .timeline-content { text-align: right; }
            #timeline-container { display: flex; flex-direction: column; }
            .timeline-icon { left: 50%; }
        }
    </style>
</head>
<body>
    <canvas id="starry-sky-canvas"></canvas>
    <div id="fx-container"></div>

    <!-- Cover -->
    <div id="cover">
        <div class="cover-content">
            <p>The Wedding Of</p>
            <h1 class="font-heading" id="cover-names"></h1>
            <p class="mt-8">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h3 id="guest-name">Tamu Undangan</h3>
            <p class="mt-2 max-w-md">
                Tanpa mengurangi rasa hormat, kami mengundang Anda untuk hadir di acara pernikahan kami.
            </p>
            <button id="open-invitation">
                <i class="fa-solid fa-envelope-open mr-2"></i> Buka Undangan
            </button>
        </div>
    </div>
    
    <audio id="background-music" src="https://firebasestorage.googleapis.com/v0/b/frame-api-chat-2-dev.appspot.com/o/public%2Fbg-music.mp3?alt=media" loop></audio>
    
    <main id="main-content">
        <header id="home">
            <div class="hero-content">
                <h4>You're Invited To The Wedding Of</h4>
                <h1 class="font-heading" id="hero-names"></h1>
                <p class="date" id="hero-date"></p>
            </div>
        </header>

        <section id="quote" class="animate-on-scroll">
             <div class="container">
                <blockquote id="quote-text"></blockquote>
                <h4 class="font-heading text-4xl mt-4" id="quote-source"></h4>
            </div>
        </section>

        <section id="couple" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">The Bride & Groom</h2>
                <div id="couple-container">
                    <!-- Groom & Bride Info will be injected here -->
                </div>
            </div>
        </section>

        <section id="story" class="animate-on-scroll">
             <div class="container">
                <h2 class="font-heading section-title">Our Love Story</h2>
                <div id="timeline-container">
                    <div class="timeline-line"></div>
                </div>
            </div>
        </section>

        <section id="event" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Save The Date</h2>
                <div class="countdown-timer" id="countdown-timer"></div>
                <div class="events-container" id="events-container"></div>
            </div>
        </section>

        <section id="livestream" class="animate-on-scroll"></section>

        <section id="gallery" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Our Moments</h2>
                <div id="gallery-grid"></div>
            </div>
        </section>
        
        <div id="gallery-modal">
            <span id="modal-close">&times;</span>
            <img id="modal-image" alt="Enlarged gallery view"/>
        </div>

        <section id="dress-code" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Dress Code</h2>
                <p class="mb-6 max-w-lg mx-auto">Kami akan sangat berbahagia jika Anda mengenakan pakaian dengan nuansa warna berikut:</p>
                <div class="color-palette" id="color-palette"></div>
                <p class="italic" id="dress-code-info" style="color: #ccc;"></p>
            </div>
        </section>

        <section id="gift" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Wedding Gift</h2>
                <p class="mb-8 max-w-2xl mx-auto">
                    Doa restu Anda adalah hadiah terindah. Namun, jika Anda ingin memberikan tanda kasih, kami telah menyediakan cara yang mudah.
                </p>
                <div class="gift-container" id="gift-container"></div>
            </div>
        </section>

        <section id="rsvp" class="animate-on-scroll">
            <div class="container max-w-3xl mx-auto">
                <h2 class="font-heading section-title">Are You Attending?</h2>
                <form id="rsvp-form" class="flex flex-col gap-4 max-w-lg mx-auto text-left">
                    <input type="text" id="name" placeholder="Nama Anda" required />
                    <select id="attendance" required>
                        <option value="">Konfirmasi Kehadiran</option>
                        <option value="Hadir">Saya akan Hadir</option>
                        <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                    </select>
                    <textarea id="wishes" placeholder="Tulis ucapan dan doa Anda..." rows="4" required></textarea>
                    <button type="submit">Kirim Ucapan</button>
                </form>

                <div id="guestbook-container" class="mt-16">
                    <h2 class="font-heading section-title">Ucapan & Doa</h2>
                    <div class="guestbook-list" id="guestbook-list"></div>
                </div>
            </div>
        </section>

        <footer>
            <div class="max-w-3xl mx-auto text-center">
                <p>
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Anda berkenan hadir untuk memberikan doa restu.
                </p>
                <p class="font-heading text-4xl my-6" id="footer-names"></p>
                <p class="text-sm">&copy; <span id="footer-year"></span>. Crafted with Love under the Stars.</p>
            </div>
        </footer>

    </main>

    <div id="floating-ui-container"></div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const invitationData = {
                groom_name: 'Aditya', bride_name: 'Kirana',
                cover_image: 'https://picsum.photos/seed/cover-night/1200/1800', 
                hero_image: 'https://picsum.photos/seed/hero-night/1920/1080',   
                quote: 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.',
                quote_source: 'QS. Ar-Rum: 21',
                groom_photo_path: 'https://picsum.photos/seed/groom-night/400/400', 
                groom_info: 'Putra Bapak Subagio & Ibu Wati',
                bride_photo_path: 'https://picsum.photos/seed/bride-night/400/400', 
                bride_info: 'Putri Bapak Sutrisno & Ibu Murni',
                dress_code_info: 'Kenakan pakaian terbaik Anda dengan sentuhan warna malam yang elegan.',
                package: { has_love_story: true, has_live_streaming: true, has_rsvp: true, has_music: true },
                stories: [
                    { title: 'Pertemuan Pertama', story_date: '15 Juni 2022', description: 'Di bawah langit malam yang sama, takdir mempertemukan kami dalam sebuah acara komunitas.' },
                    { title: 'Lamaran', story_date: '20 Desember 2024', description: 'Di antara gemerlap bintang, Aditya melamarku, dan sebuah janji terucap.' },
                    { title: 'Menuju Hari Bahagia', story_date: 'Sekarang', description: 'Kini kami menanti hari di mana bintang-bintang akan menjadi saksi cinta abadi kami.' },
                ],
                events: [
                    { title: 'Akad Nikah', event_date: '2025-11-22', start_time: '09:00:00', venue_name: 'Masjid Istiqlal, Jakarta Pusat', google_maps_link: 'https://maps.app.goo.gl/abcdef123456', livestream_link: 'https://youtube.com/live/yourstreamid', dress_code_colors: ['#0a192f', '#f7d794', '#b8b5ff', '#e6f1ff'] },
                    { title: 'Resepsi Pernikahan', event_date: '2025-11-22', start_time: '19:00:00', venue_name: 'Gedung Balai Kartini, Jakarta Selatan', google_maps_link: 'https://maps.app.goo.gl/ghijkl789012', livestream_link: null, dress_code_colors: null },
                ],
                galleries: [
                    { image_path: 'https://picsum.photos/seed/gallery1-night/600/800' }, { image_path: 'https://picsum.photos/seed/gallery2-night/800/600' },
                    { image_path: 'https://picsum.photos/seed/gallery3-night/600/600' }, { image_path: 'https://picsum.photos/seed/gallery4-night/800/600' },
                    { image_path: 'https://picsum.photos/seed/gallery5-night/600/800' }, { image_path: 'https://picsum.photos/seed/gallery6-night/600/600' },
                ],
                gifts: [
                    { bank_name: 'BCA', account_number: '1234567890', account_holder_name: 'Aditya Putra' },
                    { bank_name: 'Mandiri', account_number: '0987654321', account_holder_name: 'Kirana Sari' },
                ],
                guestbooks: [
                    { name: 'Rina & Keluarga', attendance_status: 'Hadir', message: 'Selamat ya, Adit dan Kirana! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Kami pasti datang!' },
                    { name: 'Doni', attendance_status: 'Hadir', message: 'Congrats bro! Lancar sampai hari H. See you there!' },
                    { name: 'Siti Aisyah', attendance_status: 'Tidak Hadir', message: 'Selamat menempuh hidup baru, Kirana sayang. Mohon maaf belum bisa hadir, tapi doaku selalu menyertai kalian.' },
                ],
            };
            
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const audio = document.getElementById('background-music');
            const hero = document.getElementById('home');
            
            const populateContent = () => {
                const { groom_name, bride_name, hero_image, quote, quote_source, groom_photo_path, groom_info, bride_photo_path, bride_info, stories, events, galleries, dress_code_info, gifts, guestbooks, package: pkg } = invitationData;
                const formatDate = (dateString) => new Date(dateString).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                hero.style.backgroundImage = `url(${hero_image})`;
                const names = `${groom_name} & ${bride_name}`;
                ['cover-names', 'hero-names', 'footer-names'].forEach(id => document.getElementById(id).textContent = names);
                document.getElementById('hero-date').textContent = formatDate(events[0]?.event_date);
                document.getElementById('quote-text').textContent = `"${quote}"`;
                document.getElementById('quote-source').textContent = `(${quote_source})`;

                const coupleContainer = document.getElementById('couple-container');
                coupleContainer.innerHTML = `<div class="couple-info animate-on-scroll"><img src="${groom_photo_path}" alt="${groom_name}"><h3 class="font-heading">${groom_name}</h3><p>${groom_info}</p></div><div class="couple-separator font-heading">&</div><div class="couple-info animate-on-scroll"><img src="${bride_photo_path}" alt="${bride_name}"><h3 class="font-heading">${bride_name}</h3><p>${bride_info}</p></div>`;

                if (pkg.has_love_story) {
                    const timelineContainer = document.getElementById('timeline-container');
                    stories.forEach((story, index) => {
                        const icon = story.title.includes('Lamaran') ? 'fa-ring' : (story.title.includes('Pertemuan') ? 'fa-comments' : 'fa-heart');
                        timelineContainer.innerHTML += `<div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'} animate-on-scroll"><div class="timeline-icon"><i class="fa-solid ${icon}"></i></div><div class="timeline-content"><h3>${story.title}</h3><p class="text-sm text-gray-400 mb-2">${story.story_date}</p><p>${story.description}</p></div></div>`;
                    });
                } else document.getElementById('story').style.display = 'none';

                const eventsContainer = document.getElementById('events-container');
                events.forEach(event => {
                    eventsContainer.innerHTML += `<div class="event-card animate-on-scroll"><div class="event-card-header"><h3 class="font-heading">${event.title}</h3></div><div class="event-card-body"><p><i class="fa-solid fa-calendar-day"></i><span>${formatDate(event.event_date)}</span></p><p><i class="fa-solid fa-clock"></i><span>${event.start_time.substring(0, 5)} WIB</span></p><p><i class="fa-solid fa-map-marker-alt"></i><span>${event.venue_name}</span></p><a href="${event.google_maps_link}" target="_blank" class="map-button"><i class="fa-solid fa-map-location-dot mr-2"></i> Lihat Peta</a></div></div>`;
                });

                const liveStreamEvents = events.filter(e => e.livestream_link);
                if (pkg.has_live_streaming && liveStreamEvents.length > 0) {
                     const lsSection = document.getElementById('livestream');
                     let cards = liveStreamEvents.map(event => `<div class="event-card animate-on-scroll"><div class="event-card-header"><h3 class="font-heading">${event.title}</h3></div><div class="event-card-body"><p><i class="fa-solid fa-calendar-day"></i><span>${formatDate(event.event_date)}</span></p><p><i class="fa-solid fa-clock"></i><span>${event.start_time.substring(0, 5)} WIB</span></p><a href="${event.livestream_link}" target="_blank" class="map-button"><i class="fa-solid fa-video mr-2"></i> Tonton Live</a></div></div>`).join('');
                     lsSection.innerHTML = `<div class="container"><h2 class="font-heading section-title">Live Streaming</h2><p class="mb-8 max-w-2xl mx-auto">Saksikan siaran langsung pernikahan kami.</p><div class="events-container">${cards}</div></div>`;
                } else document.getElementById('livestream').style.display = 'none';

                document.getElementById('gallery-grid').innerHTML = galleries.map(p => `<div class="gallery-item animate-on-scroll"><img src="${p.image_path}" alt="Gallery moment" loading="lazy"></div>`).join('');
                document.getElementById('color-palette').innerHTML = (events[0]?.dress_code_colors || []).map(c => `<div class="color-box" style="background-color: ${c};"></div>`).join('');
                document.getElementById('dress-code-info').textContent = dress_code_info;

                if (pkg.has_rsvp) {
                    document.getElementById('gift-container').innerHTML = gifts.map(g => `<div class="gift-card animate-on-scroll"><h4>${g.bank_name}</h4><p class="account-number">${g.account_number}</p><p class="mb-4">a.n. ${g.account_holder_name}</p><button class="copy-button" data-account="${g.account_number}"><i class="fa-solid fa-copy mr-2"></i> Salin</button></div>`).join('');
                    guestbooks.forEach(addGuestbookEntry);
                } else {
                    document.getElementById('gift').style.display = 'none';
                    document.getElementById('rsvp').style.display = 'none';
                }

                document.getElementById('footer-year').textContent = new Date().getFullYear();
                const floatingUiContainer = document.getElementById('floating-ui-container');
                if (pkg.has_music) floatingUiContainer.innerHTML += `<button id="music-toggle"><i class="fa-solid fa-compact-disc"></i></button>`;
                floatingUiContainer.innerHTML += `<nav id="bottom-nav" class="flex items-center justify-around"><a href="#home"><i class="fas fa-home"></i></a><a href="#couple"><i class="fas fa-heart"></i></a><a href="#event"><i class="fas fa-calendar-check"></i></a><a href="#gallery"><i class="fas fa-images"></i></a>${pkg.has_rsvp ? `<a href="#rsvp"><i class="fas fa-envelope"></i></a>` : ''}</nav>`;
            };

            const guestName = new URLSearchParams(window.location.search).get("to") || "Tamu Undangan";
            document.getElementById("guest-name").textContent = guestName.replace(/\+/g, " ");

            const canvas = document.getElementById("starry-sky-canvas");
            const ctx = canvas.getContext("2d");
            let stars = [], shootingStars = [];
            const setupStars = () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                stars = [];
                for (let i = 0; i < 400; i++) {
                    stars.push({ x: Math.random() * canvas.width, y: Math.random() * canvas.height, radius: Math.random() * 1.5, alpha: Math.random() * 0.5 + 0.5, dAlpha: 0.01 * (Math.random() > 0.5 ? 1 : -1) });
                }
            };
            const animateStars = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                stars.forEach(star => {
                    star.alpha += star.dAlpha;
                    if (star.alpha < 0.1 || star.alpha > 1) star.dAlpha *= -1;
                    ctx.fillStyle = `rgba(255, 255, 255, ${star.alpha})`;
                    ctx.beginPath(); ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2); ctx.fill();
                });
                shootingStars.forEach((star, index) => {
                    star.x += star.vx; star.y += star.vy; star.len -= 2;
                    if(star.len <= 0) shootingStars.splice(index, 1);
                    ctx.strokeStyle = `rgba(247, 215, 148, ${star.alpha})`;
                    ctx.lineWidth = star.width; ctx.beginPath(); ctx.moveTo(star.x, star.y);
                    ctx.lineTo(star.x - star.vx * star.len, star.y - star.vy * star.len); ctx.stroke();
                });
                if (Math.random() < 0.01) {
                    shootingStars.push({ x: Math.random() * canvas.width, y: 0, vx: Math.random() * 4 - 2, vy: Math.random() * 4 + 2, len: Math.random() * 80 + 50, alpha: 1, width: Math.random() * 2 });
                }
                requestAnimationFrame(animateStars);
            };
            setupStars(); animateStars();
            window.addEventListener("resize", setupStars);

            const fxContainer = document.getElementById('fx-container');
            const createFirefly = () => {
                const firefly = document.createElement('div');
                firefly.className = 'firefly';
                firefly.style.left = `${Math.random() * 100}vw`;
                firefly.style.width = `${Math.random() * 2 + 1}px`;
                firefly.style.height = firefly.style.width;
                firefly.style.animationDuration = `${Math.random() * 5 + 4}s`;
                fxContainer.appendChild(firefly);
                setTimeout(() => firefly.remove(), 9000);
            };

            let ticking = false;
            const onScroll = () => {
                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        hero.style.backgroundPositionY = `${window.scrollY * 0.5}px`;
                        if (Math.random() > 0.7) createFirefly();
                        ticking = false;
                    });
                    ticking = true;
                }
            };
            
            document.getElementById('open-invitation').addEventListener('click', () => {
                cover.classList.add('hidden');
                mainContent.style.display = 'block';
                document.body.style.overflow = 'auto';
                if (audio) {
                    audio.play().catch(e => console.error("Autoplay failed"));
                    const musicToggle = document.getElementById('music-toggle');
                    if (musicToggle) musicToggle.classList.add('playing');
                }
                window.addEventListener('scroll', onScroll, { passive: true });
            });

            document.getElementById('floating-ui-container').addEventListener('click', (e) => {
                const musicToggle = e.target.closest('#music-toggle');
                if (musicToggle && audio) audio.paused ? (audio.play(), musicToggle.classList.add('playing')) : (audio.pause(), musicToggle.classList.remove('playing'));
            });
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const parent = entry.target.parentElement;
                        const isStaggered = ['timeline-container', 'events-container', 'gallery-grid', 'gift-container', 'couple-container'].includes(parent.id);
                        if (isStaggered) {
                            const index = Array.from(parent.children).filter(child => child.classList.contains('animate-on-scroll')).indexOf(entry.target);
                            entry.target.style.transitionDelay = `${index * 150}ms`;
                        }
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            const countdownContainer = document.getElementById('countdown-timer');
            const mainEventDate = invitationData.events.length > 0 ? `${invitationData.events[0].event_date}T${invitationData.events[0].start_time}` : '';
            if (mainEventDate) {
                 const interval = setInterval(() => {
                    const gap = new Date(mainEventDate).getTime() - new Date().getTime();
                    if (gap > 0) {
                        const d = String(Math.floor(gap / 864e5)).padStart(2, '0');
                        const h = String(Math.floor((gap % 864e5) / 36e5)).padStart(2, '0');
                        const m = String(Math.floor((gap % 36e5) / 6e4)).padStart(2, '0');
                        const s = String(Math.floor((gap % 6e4) / 1000)).padStart(2, '0');
                        countdownContainer.innerHTML = `<div class="time-box"><span class="time-value">${d}</span><span>Hari</span></div><div class="time-box"><span class="time-value">${h}</span><span>Jam</span></div><div class="time-box"><span class="time-value">${m}</span><span>Menit</span></div><div class="time-box"><span class="time-value">${s}</span><span>Detik</span></div>`;
                    } else {
                        countdownContainer.innerHTML = `<h4>Acara Telah Berlangsung</h4>`;
                        clearInterval(interval);
                    }
                }, 1000);
            }

            const galleryModal = document.getElementById('gallery-modal');
            document.getElementById('gallery-grid').addEventListener('click', e => {
                if(e.target.tagName === 'IMG') {
                    document.getElementById('modal-image').src = e.target.src;
                    galleryModal.classList.add('visible');
                }
            });
            document.getElementById('modal-close').addEventListener('click', () => galleryModal.classList.remove('visible'));
            galleryModal.addEventListener('click', e => { if (e.target === galleryModal) galleryModal.classList.remove('visible'); });

            document.getElementById('gift-container').addEventListener('click', e => {
                const button = e.target.closest('.copy-button');
                if (!button) return;
                navigator.clipboard.writeText(button.dataset.account).then(() => {
                    button.innerHTML = '<i class="fa-solid fa-check mr-2"></i> Tersalin!';
                    setTimeout(() => { button.innerHTML = '<i class="fa-solid fa-copy mr-2"></i> Salin'; }, 2000);
                });
            });

            function addGuestbookEntry(entry, isNew = false) {
                const list = document.getElementById('guestbook-list');
                const entryDiv = document.createElement('div');
                entryDiv.className = `guestbook-entry ${isNew ? 'newly-added' : ''}`;
                if (isNew) entryDiv.style.animation = 'fadeIn 0.5s ease-out';
                const statusClass = entry.attendance_status === 'Hadir' ? 'hadir' : 'tidak-hadir';
                const iconClass = entry.attendance_status === 'Hadir' ? 'fa-circle-check' : 'fa-circle-xmark';
                entryDiv.innerHTML = `<div class="guestbook-header flex items-center mb-2"><p class="name">${entry.name}</p><span class="status ${statusClass}"><i class="fa-solid ${iconClass} mr-1"></i> ${entry.attendance_status}</span></div><p class="italic">"${entry.message}"</p>`;
                list.prepend(entryDiv);
            }
            const rsvpForm = document.getElementById('rsvp-form');
            if(rsvpForm) {
                rsvpForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const btn = rsvpForm.querySelector('button');
                    btn.disabled = true; btn.textContent = 'Mengirim...';
                    const newEntry = { name: document.getElementById('name').value, attendance_status: document.getElementById('attendance').value, message: document.getElementById('wishes').value };
                    setTimeout(() => {
                        addGuestbookEntry(newEntry, true);
                        rsvpForm.reset();
                        btn.disabled = false; btn.textContent = 'Kirim Ucapan';
                    }, 1000);
                });
            }
            
            populateContent();
            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>

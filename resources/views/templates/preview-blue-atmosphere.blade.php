<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedding Invitation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bg-color: #2F4858;      /* Deep Forest Green */
            --text-color: #F4F1DE;    /* Creamy Off-White */
            --primary-color: #E07A5F; /* Terracotta */
            --accent-color: #81B29A;  /* Mossy Green */
            --bg-color-alt: #22343E;  /* Darker Green */
            --font-heading: "Cinzel Decorative", serif;
            --font-body: "Lora", serif;
        }

        /* --- Base & Typography --- */
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            color: var(--text-color);
            background-color: var(--bg-color);
            /* Added a dark overlay to the background image for better text contrast */
            background: 
                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('https://picsum.photos/seed/forest-bg/2000/3000');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            overflow: hidden;
            /* Added a subtle text shadow to all text for readability */
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }
        .font-heading {
            font-family: var(--font-heading);
            color: var(--primary-color);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        
        /* --- Animations --- */
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(2rem) scale(0.98);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .animate-on-scroll.visible { opacity: 1; transform: translateY(0) scale(1); }

        /* --- Animated Background --- */
        #particle-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        /* --- Cover Section --- */
        #cover {
            position: fixed; inset: 0; z-index: 1000;
            display: flex; justify-content: center; align-items: center; text-align: center;
            color: var(--text-color);
            background: rgba(47, 72, 88, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: opacity 1.5s ease-out, visibility 1.5s;
        }
        #cover.hidden { opacity: 0; visibility: hidden; }
        .cover-content {
            position: relative; z-index: 1; padding: 1.25rem;
            display: flex; flex-direction: column; align-items: center;
            animation: fadeIn 2.5s ease-in-out;
        }
        .cover-content h1 {
            font-size: 3rem;
            text-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        #guest-name {
            font-size: 1.5rem; font-weight: 600; color: var(--text-color);
            margin: 0.5rem 0; padding: 0.5rem 1rem;
            border: 1px solid var(--accent-color);
            border-radius: 20px;
            background: rgba(129, 178, 154, 0.2);
        }
        #open-invitation {
            margin-top: 2rem; padding: 0.75rem 2rem;
            background-color: var(--primary-color); color: var(--text-color);
            border: 2px solid var(--text-color); border-radius: 9999px;
            font-family: var(--font-body); font-size: 1.125rem; font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-shadow: none; /* Remove body text-shadow from button */
        }
        #open-invitation:hover {
            background-color: var(--accent-color);
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        /* --- Main Content --- */
        main { display: none; }
        section {
            position: relative; padding: 5rem 1.25rem;
            text-align: center; overflow: hidden;
            background: transparent;
        }
        .section-title {
            font-size: 2.5rem; margin-bottom: 1rem;
        }
        .section-divider {
            color: var(--accent-color);
            font-size: 1.5rem;
            margin-bottom: 3rem;
        }
        .container {
            max-width: 72rem;
            margin: 0 auto;
            padding: 2.5rem;
            /* Increased opacity for better readability */
            background: rgba(34, 52, 62, 0.9); 
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 1rem;
            border: 1px solid var(--accent-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }
        section:first-of-type .container {
             background: none; backdrop-filter: none; border: none; box-shadow: none;
        }


        /* --- Hero Section --- */
        #home {
            min-height: 100vh; display: flex; justify-content: center; align-items: center;
            text-align: center; color: white; position: relative;
            background-size: cover; background-position: center; padding: 0;
        }
        #home::before {
            content: ''; position: absolute; inset: 0; 
            background: radial-gradient(ellipse at center, rgba(47, 72, 88, 0.1) 0%, rgba(47, 72, 88, 0.9) 90%);
        }
        .hero-content { position: relative; z-index: 1; padding: 1.25rem; }
        .hero-content h1 {
            font-size: 3.5rem; color: white;
            text-shadow: 0 0 15px rgba(0,0,0,0.7);
        }
        .hero-content .date {
            font-size: 1.25rem; margin-top: 1rem;
            letter-spacing: 0.1em; color: var(--text-color);
        }
        
        /* --- Quote Section --- */
        #quote blockquote {
            font-size: 1.5rem;
            font-style: italic;
            border-left: 3px solid var(--primary-color);
            padding-left: 1.5rem;
            text-align: left;
            color: #f0eada;
        }
        #quote h4 { text-align: left; margin-left: 1.5rem; color: var(--accent-color); }

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
            box-shadow: 0 0 25px 0px rgba(224, 122, 95, 0.4);
        }
        .couple-info h3 { font-size: 2rem; margin-top: 1rem; margin-bottom: 0.5rem; }
        .couple-separator { font-size: 3.5rem; margin: 1rem 0; color: var(--primary-color); }

        /* --- Love Story (Timeline) --- */
        #timeline-container { position: relative; max-width: 56rem; margin: 0 auto; padding: 2rem 0; }
        .timeline-line {
            position: absolute; width: 2px;
            background: var(--accent-color);
            top: 0; bottom: 0; left: 1.25rem;
        }
        .timeline-item {
            position: relative; padding-left: 3.5rem; margin-bottom: 2.5rem;
        }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-icon {
            position: absolute; left: 1.25rem; top: 0; transform: translateX(-50%);
            width: 1.5rem; height: 1.5rem; border-radius: 50%;
            background-color: var(--primary-color);
            display: flex; align-items: center; justify-content: center;
            border: 4px solid var(--bg-color-alt); z-index: 1;
            box-shadow: 0 0 15px 2px var(--primary-color);
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
            background: rgba(129, 178, 154, 0.1); padding: 1rem; width: 6rem; border-radius: 0.5rem;
            border: 1px solid var(--accent-color);
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
            border: 1px solid var(--accent-color);
            width: 100%; max-width: 24rem;
            text-align: center; flex: 1; min-width: 280px; overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px 0 rgba(129, 178, 154, 0.4);
        }
        .event-card-header {
            background-color: rgba(224, 122, 95, 0.2); color: var(--primary-color); padding: 1rem;
        }
        .event-card-header h3 { font-size: 1.5rem; }
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
            text-shadow: none;
        }
        .map-button:hover { background-color: var(--primary-color); color: var(--text-color); }

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
            border: 2px solid var(--accent-color);
        }
        .gallery-item img {
            width: 100%; height: auto; object-fit: cover;
            transition: transform 0.5s;
            display: block; /* Fixes small gap under image */
        }
        .gallery-item:hover img { transform: scale(1.10); }

        /* --- Gallery Modal --- */
        #gallery-modal {
            position: fixed; inset: 0; background: rgba(0, 0, 0, 0.9);
            z-index: 1001; padding: 1rem;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
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
            border: 2px solid var(--text-color);
        }

        /* --- Wedding Gift --- */
        .gift-container {
            display: flex; flex-direction: column; align-items: center; gap: 1.5rem;
        }
        .gift-card {
            background: transparent; padding: 1.5rem; border-radius: 0.5rem;
            border: 1px solid var(--accent-color);
            width: 100%; max-width: 28rem; text-align: center;
        }
        .gift-card h4 { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--accent-color); }
        .gift-card .account-number {
            font-size: 1.5rem; font-weight: 600;
            color: var(--primary-color); margin-bottom: 0.5rem;
        }
        .copy-button {
            padding: 0.5rem 1.5rem; border-radius: 9999px;
            color: var(--text-color); cursor: pointer;
            background-color: var(--primary-color); border: none;
            text-shadow: none;
        }

        /* --- RSVP & Guestbook --- */
        #rsvp-form { display: flex; flex-direction: column; gap: 1rem; max-width: 32rem; margin: auto; text-align: left; }
        #rsvp-form input, #rsvp-form select, #rsvp-form textarea {
            width: 100%; box-sizing: border-box; padding: 0.75rem;
            border: 1px solid var(--accent-color);
            border-radius: 0.5rem;
            font-family: var(--font-body); font-size: 1.25rem;
            background: rgba(34, 52, 62, 0.8);
            color: var(--text-color);
            transition: border-color 0.3s, box-shadow 0.3s;
            text-shadow: none;
        }
        #rsvp-form input::placeholder, #rsvp-form textarea::placeholder {
            color: #ccc;
            opacity: 1;
        }
        #rsvp-form input:focus, #rsvp-form select:focus, #rsvp-form textarea:focus {
            outline: none; border-color: transparent;
            box-shadow: 0 0 0 2px var(--primary-color);
        }
        #rsvp-form button {
            padding: 0.75rem; border: none; background: var(--primary-color);
            color: var(--text-color); font-size: 1.125rem; border-radius: 9999px;
            cursor: pointer; font-weight: 600;
            text-shadow: none;
        }
        
        .guestbook-list {
            max-height: 24rem; overflow-y: auto; padding: 1rem;
            display: flex; flex-direction: column; gap: 1rem;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) transparent;
        }
        .guestbook-entry {
            background: transparent; padding: 1rem; border-radius: 0.5rem;
            border: 1px solid rgba(129, 178, 154, 0.4); text-align: left;
        }
        .guestbook-header { display: flex; align-items: center; margin-bottom: 0.5rem; }
        .guestbook-header .name { font-weight: 600; color: var(--primary-color); font-size: 1.2rem; }
        .guestbook-header .status {
            margin-left: 0.75rem; font-size: 0.75rem; font-weight: 600;
            padding: 0.25rem 0.5rem; border-radius: 9999px;
        }
        .status.hadir { background-color: rgba(129, 178, 154, 0.3); color: var(--text-color); }
        .status.tidak-hadir { background-color: rgba(224, 122, 95, 0.3); color: var(--text-color); }

        /* --- Footer --- */
        footer {
            padding: 4rem 1.25rem;
            background: linear-gradient(to top, var(--bg-color), transparent);
            text-align: center;
        }

        /* --- Floating Buttons (Music & Nav) --- */
        #music-toggle {
            position: fixed; bottom: 6rem; right: 1.25rem;
            width: 3rem; height: 3rem; background-color: var(--primary-color);
            color: var(--text-color); border: none; border-radius: 9999px;
            font-size: 1.25rem; z-index: 999; display: flex; justify-content: center; align-items: center;
            cursor: pointer; transition: transform 0.3s;
            text-shadow: none;
        }
        #music-toggle.playing { animation: spin 8s linear infinite; }
        #music-toggle:hover { transform: scale(1.1); }
        #bottom-nav {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: rgba(34, 52, 62, 0.8); backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            display: flex; justify-content: space-around; padding: 0.5rem; z-index: 998;
            border-top: 1px solid var(--accent-color);
        }
        #bottom-nav a { color: var(--text-color); text-decoration: none; padding: 0.5rem; }
        #bottom-nav a:hover { color: var(--primary-color); }

        /* --- Responsive Design --- */
        @media (min-width: 768px) {
            .cover-content h1 { font-size: 4rem; }
            .hero-content h1 { font-size: 5rem; }
            #couple-container { flex-direction: row; gap: 1rem; }
            .couple-info img { width: 14rem; height: 14rem; }
            .couple-info h3 { font-size: 2.5rem; }
            .couple-separator { margin: 0 2rem; font-size: 4.5rem; }
            .section-title { font-size: 3rem; }
            .countdown-timer { gap: 1.25rem; }
            #gallery-grid { columns: 3; }
            #bottom-nav { display: none; }
            #music-toggle { bottom: 2rem; }
            
            .timeline-line { left: 50%; }
            #timeline-container { display: flex; flex-direction: column; }
            .timeline-item { width: 50%; padding-left: 0; padding-right: 3.5rem; }
            .timeline-item.right { align-self: flex-end; padding-left: 3.5rem; padding-right: 0; text-align: left; }
            .timeline-item.left { align-self: flex-start; padding-right: 3.5rem; text-align: right; }
            .timeline-item.left .timeline-content { text-align: right; }
            .timeline-icon { left: 50%; }
        }
    </style>
</head>
<body>
    <canvas id="particle-canvas"></canvas>

    <!-- Cover -->
    <div id="cover">
        <div class="cover-content">
            <p>The Wedding Of</p>
            <h1 class="font-heading" id="cover-names"></h1>
            <p style="margin-top: 1.5rem;">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h3 id="guest-name">Tamu Undangan</h3>
            <p style="margin-top: 0.5rem; max-width: 28rem;">
                Tanpa mengurangi rasa hormat, kami mengundang Anda untuk hadir di acara pernikahan kami.
            </p>
            <button id="open-invitation">
                <i class="fa-solid fa-leaf" style="margin-right: 0.5rem;"></i> Buka Undangan
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
                <h4 style="font-size: 1.25rem; margin-top: 1rem; font-family: var(--font-body);" id="quote-source"></h4>
            </div>
        </section>

        <section id="couple" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">The Bride & Groom</h2>
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                <div id="couple-container">
                    <!-- Groom & Bride Info will be injected here -->
                </div>
            </div>
        </section>

        <section id="story" class="animate-on-scroll">
             <div class="container">
                <h2 class="font-heading section-title">Our Love Story</h2>
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                <div id="timeline-container">
                    <div class="timeline-line"></div>
                </div>
            </div>
        </section>

        <section id="event" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Save The Date</h2>
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                <div class="countdown-timer" id="countdown-timer"></div>
                <div class="events-container" id="events-container"></div>
            </div>
        </section>

        <section id="livestream" class="animate-on-scroll"></section>

        <section id="gallery" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Our Moments</h2>
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
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
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                <p style="margin-bottom: 1.5rem; max-width: 32rem; margin-left: auto; margin-right: auto;">Kami akan sangat berbahagia jika Anda mengenakan pakaian dengan nuansa warna berikut:</p>
                <div class="color-palette" id="color-palette"></div>
                <p class="italic" id="dress-code-info" style="color: #ccc;"></p>
            </div>
        </section>

        <section id="gift" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Wedding Gift</h2>
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                <p style="margin-bottom: 2rem; max-width: 42rem; margin-left: auto; margin-right: auto;">
                    Doa restu Anda adalah hadiah terindah. Namun, jika Anda ingin memberikan tanda kasih, kami telah menyediakan cara yang mudah.
                </p>
                <div class="gift-container" id="gift-container"></div>
            </div>
        </section>

        <section id="rsvp" class="animate-on-scroll">
            <div class="container" style="max-width: 48rem;">
                <h2 class="font-heading section-title">Are You Attending?</h2>
                <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                <form id="rsvp-form">
                    <input type="text" id="name" placeholder="Nama Anda" required />
                    <select id="attendance" required>
                        <option value="">Konfirmasi Kehadiran</option>
                        <option value="Hadir">Saya akan Hadir</option>
                        <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                    </select>
                    <textarea id="wishes" placeholder="Tulis ucapan dan doa Anda..." rows="4" required></textarea>
                    <button type="submit">Kirim Ucapan</button>
                </form>

                <div id="guestbook-container" style="margin-top: 4rem;">
                    <h2 class="font-heading section-title">Ucapan & Doa</h2>
                    <div class="section-divider"><i class="fa-solid fa-leaf"></i></div>
                    <div class="guestbook-list" id="guestbook-list"></div>
                </div>
            </div>
        </section>

        <footer>
            <div style="max-width: 48rem; margin: auto; text-align: center;">
                <p>
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Anda berkenan hadir untuk memberikan doa restu.
                </p>
                <p class="font-heading" style="font-size: 2.25rem; margin: 1.5rem 0;" id="footer-names"></p>
                <p style="font-size: 0.875rem;">&copy; <span id="footer-year"></span>. Crafted with Love in the Enchanted Forest.</p>
            </div>
        </footer>

    </main>

    <div id="floating-ui-container"></div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const invitationData = {
                groom_name: 'Aditya', bride_name: 'Kirana',
                hero_image: 'https://picsum.photos/seed/hero-forest/1920/1080',   
                quote: 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.',
                quote_source: 'QS. Ar-Rum: 21',
                groom_photo_path: 'https://picsum.photos/seed/groom-forest/400/400', 
                groom_info: 'Putra Bapak Subagio & Ibu Wati',
                bride_photo_path: 'https://picsum.photos/seed/bride-forest/400/400', 
                bride_info: 'Putri Bapak Sutrisno & Ibu Murni',
                dress_code_info: 'Kenakan pakaian terbaik Anda dengan sentuhan warna alam yang elegan.',
                package: { has_love_story: true, has_live_streaming: true, has_rsvp: true, has_music: true },
                stories: [
                    { title: 'Pertemuan Pertama', story_date: '15 Juni 2022', description: 'Di bawah naungan pepohonan, takdir mempertemukan kami dalam sebuah acara komunitas.' },
                    { title: 'Lamaran', story_date: '20 Desember 2024', description: 'Di antara cahaya kunang-kunang, Aditya melamarku, dan sebuah janji terucap.' },
                    { title: 'Menuju Hari Bahagia', story_date: 'Sekarang', description: 'Kini kami menanti hari di mana alam akan menjadi saksi cinta abadi kami.' },
                ],
                events: [
                    { title: 'Akad Nikah', event_date: '2025-11-22', start_time: '09:00:00', venue_name: 'Taman Hutan Raya, Bandung', google_maps_link: 'https://maps.app.goo.gl/abcdef123456', livestream_link: 'https://youtube.com/live/yourstreamid', dress_code_colors: ['#2F4858', '#E07A5F', '#81B29A', '#F4F1DE'] },
                    { title: 'Resepsi Pernikahan', event_date: '2025-11-22', start_time: '19:00:00', venue_name: 'Gedung Kriya Asri, Jakarta', google_maps_link: 'https://maps.app.goo.gl/ghijkl789012', livestream_link: null, dress_code_colors: null },
                ],
                galleries: [
                    { image_path: 'https://picsum.photos/seed/gallery1-forest/600/800' }, { image_path: 'https://picsum.photos/seed/gallery2-forest/800/600' },
                    { image_path: 'https://picsum.photos/seed/gallery3-forest/600/600' }, { image_path: 'https://picsum.photos/seed/gallery4-forest/800/600' },
                    { image_path: 'https://picsum.photos/seed/gallery5-forest/600/800' }, { image_path: 'https://picsum.photos/seed/gallery6-forest/600/600' },
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
                if(hero) hero.style.backgroundImage = `url(${hero_image})`;
                const names = `${groom_name} & ${bride_name}`;
                ['cover-names', 'hero-names', 'footer-names'].forEach(id => { if(document.getElementById(id)) document.getElementById(id).textContent = names});
                if(document.getElementById('hero-date')) document.getElementById('hero-date').textContent = formatDate(events[0]?.event_date);
                if(document.getElementById('quote-text')) document.getElementById('quote-text').textContent = `"${quote}"`;
                if(document.getElementById('quote-source')) document.getElementById('quote-source').textContent = `(${quote_source})`;

                const coupleContainer = document.getElementById('couple-container');
                if(coupleContainer) coupleContainer.innerHTML = `<div class="couple-info animate-on-scroll"><img src="${groom_photo_path}" alt="${groom_name}"><h3 class="font-heading">${groom_name}</h3><p>${groom_info}</p></div><div class="couple-separator font-heading animate-on-scroll">&</div><div class="couple-info animate-on-scroll"><img src="${bride_photo_path}" alt="${bride_name}"><h3 class="font-heading">${bride_name}</h3><p>${bride_info}</p></div>`;

                if (pkg.has_love_story) {
                    const timelineContainer = document.getElementById('timeline-container');
                    if(timelineContainer){
                        stories.forEach((story, index) => {
                            const icon = story.title.includes('Lamaran') ? 'fa-ring' : (story.title.includes('Pertemuan') ? 'fa-comments' : 'fa-heart');
                            timelineContainer.innerHTML += `<div class="timeline-item ${index % 2 === 0 ? 'left' : 'right'} animate-on-scroll"><div class="timeline-icon"><i class="fa-solid fa-xs ${icon}"></i></div><div class="timeline-content"><h3>${story.title}</h3><p style="font-size: 0.875rem; color: #ccc; margin-bottom: 0.5rem;">${story.story_date}</p><p>${story.description}</p></div></div>`;
                        });
                    }
                } else if (document.getElementById('story')) document.getElementById('story').style.display = 'none';

                const eventsContainer = document.getElementById('events-container');
                if(eventsContainer){
                    events.forEach(event => {
                        eventsContainer.innerHTML += `<div class="event-card animate-on-scroll"><div class="event-card-header"><h3 class="font-heading">${event.title}</h3></div><div class="event-card-body"><p><i class="fa-solid fa-calendar-day"></i><span>${formatDate(event.event_date)}</span></p><p><i class="fa-solid fa-clock"></i><span>${event.start_time.substring(0, 5)} WIB</span></p><p><i class="fa-solid fa-tree"></i><span>${event.venue_name}</span></p><a href="${event.google_maps_link}" target="_blank" class="map-button"><i class="fa-solid fa-map-location-dot" style="margin-right: 0.5rem;"></i> Lihat Peta</a></div></div>`;
                    });
                }

                const liveStreamEvents = events.filter(e => e.livestream_link);
                const lsSection = document.getElementById('livestream');
                if (pkg.has_live_streaming && liveStreamEvents.length > 0 && lsSection) {
                     let cards = liveStreamEvents.map(event => `<div class="event-card animate-on-scroll"><div class="event-card-header"><h3 class="font-heading">${event.title}</h3></div><div class="event-card-body"><p><i class="fa-solid fa-calendar-day"></i><span>${formatDate(event.event_date)}</span></p><p><i class="fa-solid fa-clock"></i><span>${event.start_time.substring(0, 5)} WIB</span></p><a href="${event.livestream_link}" target="_blank" class="map-button"><i class="fa-solid fa-video" style="margin-right: 0.5rem;"></i> Tonton Live</a></div></div>`).join('');
                     lsSection.innerHTML = `<div class="container"><h2 class="font-heading section-title">Live Streaming</h2><div class="section-divider"><i class="fa-solid fa-leaf"></i></div><p style="margin-bottom: 2rem; max-width: 42rem; margin: auto;">Saksikan siaran langsung pernikahan kami.</p><div class="events-container">${cards}</div></div>`;
                } else if(lsSection) lsSection.style.display = 'none';

                if(document.getElementById('gallery-grid')) document.getElementById('gallery-grid').innerHTML = galleries.map(p => `<div class="gallery-item animate-on-scroll"><img src="${p.image_path}" alt="Gallery moment" loading="lazy"></div>`).join('');
                if(document.getElementById('color-palette')) document.getElementById('color-palette').innerHTML = (events[0]?.dress_code_colors || []).map(c => `<div class="color-box" style="background-color: ${c};"></div>`).join('');
                if(document.getElementById('dress-code-info')) document.getElementById('dress-code-info').textContent = dress_code_info;

                if (pkg.has_rsvp) {
                    if(document.getElementById('gift-container')) document.getElementById('gift-container').innerHTML = gifts.map(g => `<div class="gift-card animate-on-scroll"><h4>${g.bank_name}</h4><p class="account-number">${g.account_number}</p><p style="margin-bottom: 1rem;">a.n. ${g.account_holder_name}</p><button class="copy-button" data-account="${g.account_number}"><i class="fa-solid fa-copy" style="margin-right: 0.5rem;"></i> Salin</button></div>`).join('');
                    guestbooks.forEach(addGuestbookEntry);
                } else {
                    if(document.getElementById('gift')) document.getElementById('gift').style.display = 'none';
                    if(document.getElementById('rsvp')) document.getElementById('rsvp').style.display = 'none';
                }

                if(document.getElementById('footer-year')) document.getElementById('footer-year').textContent = new Date().getFullYear();
                const floatingUiContainer = document.getElementById('floating-ui-container');
                if(floatingUiContainer){
                    if (pkg.has_music) floatingUiContainer.innerHTML += `<button id="music-toggle"><i class="fa-solid fa-music"></i></button>`;
                    floatingUiContainer.innerHTML += `<nav id="bottom-nav"><a href="#home"><i class="fas fa-home"></i></a><a href="#couple"><i class="fas fa-heart"></i></a><a href="#event"><i class="fas fa-calendar-check"></i></a><a href="#gallery"><i class="fas fa-images"></i></a>${pkg.has_rsvp ? `<a href="#rsvp"><i class="fas fa-envelope"></i></a>` : ''}</nav>`;
                }
            };

            const guestNameEl = document.getElementById("guest-name");
            if (guestNameEl) {
                const guestName = new URLSearchParams(window.location.search).get("to") || "Tamu Undangan";
                guestNameEl.textContent = guestName.replace(/\+/g, " ");
            }

            const canvas = document.getElementById("particle-canvas");
            const ctx = canvas.getContext("2d");
            let particles = [];
            const setupParticles = () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                particles = [];
                 const particleCount = Math.floor(canvas.width / 15);
                for (let i = 0; i < particleCount; i++) {
                    particles.push({
                        x: Math.random() * canvas.width,
                        y: Math.random() * canvas.height,
                        vx: Math.random() * 0.4 - 0.2,
                        vy: Math.random() * 0.4 - 0.2,
                        radius: Math.random() * 2 + 0.5,
                        alpha: Math.random() * 0.5 + 0.2
                    });
                }
            };
            const animateParticles = () => {
                if(!ctx || !canvas) return;
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => {
                    p.x += p.vx;
                    p.y += p.vy;
                    if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                    if (p.y < 0 || p.y > canvas.height) p.vy *= -1;

                    ctx.fillStyle = `rgba(224, 122, 95, ${p.alpha})`;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fill();
                });
                requestAnimationFrame(animateParticles);
            };
            
            if (canvas && ctx) {
                setupParticles();
                animateParticles();
                window.addEventListener("resize", setupParticles);
            }
            
            document.getElementById('open-invitation')?.addEventListener('click', () => {
                if(cover) cover.classList.add('hidden');
                if(mainContent) mainContent.style.display = 'block';
                document.body.style.overflow = 'auto';
                if (audio) {
                    audio.play().catch(e => console.error("Autoplay failed"));
                    const musicToggle = document.getElementById('music-toggle');
                    if (musicToggle) musicToggle.classList.add('playing');
                }
            });

            document.getElementById('floating-ui-container')?.addEventListener('click', (e) => {
                const musicToggle = e.target.closest('#music-toggle');
                if (musicToggle && audio) audio.paused ? (audio.play(), musicToggle.classList.add('playing')) : (audio.pause(), musicToggle.classList.remove('playing'));
            });
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const parent = target.parentElement;
                        const isStaggered = parent && ['timeline-container', 'events-container', 'gallery-grid', 'gift-container', 'couple-container'].includes(parent.id);
                        if (isStaggered) {
                            const index = Array.from(parent.children).filter(child => child.classList.contains('animate-on-scroll')).indexOf(target);
                            target.style.transitionDelay = `${index * 150}ms`;
                        }
                        target.classList.add('visible');
                        observer.unobserve(target);
                    }
                });
            }, { threshold: 0.1 });
            
            const countdownContainer = document.getElementById('countdown-timer');
            if(countdownContainer){
                const mainEventDate = invitationData.events.length > 0 ? `${invitationData.events[0].event_date}T${invitationData.events[0].start_time}` : '';
                if (mainEventDate) {
                     const interval = setInterval(() => {
                        const gap = new Date(mainEventDate).getTime() - new Date().getTime();
                        if (gap > 0) {
                            const d = String(Math.floor(gap / 864e5)).padStart(2, '0');
                            const h = String(Math.floor((gap % 864e5) / 36e5)).padStart(2, '0');
                            const m = String(Math.floor((gap % 36e5) / 6e4)).padStart(2, '0');
                            const s = String(Math.floor((gap % 6e4) / 1000)).padStart(2, '0');
                            countdownContainer.innerHTML = `<div class="time-box"><span class="time-value">${d}</span><span class="time-label">Hari</span></div><div class="time-box"><span class="time-value">${h}</span><span class="time-label">Jam</span></div><div class="time-box"><span class="time-value">${m}</span><span class="time-label">Menit</span></div><div class="time-box"><span class="time-value">${s}</span><span class="time-label">Detik</span></div>`;
                        } else {
                            countdownContainer.innerHTML = `<h4 style="font-family: var(--font-body);">Acara Telah Berlangsung</h4>`;
                            clearInterval(interval);
                        }
                    }, 1000);
                }
            }

            const galleryModal = document.getElementById('gallery-modal');
            document.getElementById('gallery-grid')?.addEventListener('click', e => {
                const target = e.target;
                if(target && target.tagName === 'IMG') {
                    const modalImage = document.getElementById('modal-image');
                    if (modalImage) modalImage.src = target.src;
                    galleryModal?.classList.add('visible');
                }
            });
            document.getElementById('modal-close')?.addEventListener('click', () => galleryModal?.classList.remove('visible'));
            galleryModal?.addEventListener('click', e => { if (e.target === galleryModal) galleryModal.classList.remove('visible'); });

            document.getElementById('gift-container')?.addEventListener('click', e => {
                const button = e.target.closest('.copy-button');
                if (!button || !button.dataset.account) return;
                navigator.clipboard.writeText(button.dataset.account).then(() => {
                    button.innerHTML = '<i class="fa-solid fa-check" style="margin-right: 0.5rem;"></i> Tersalin!';
                    setTimeout(() => { button.innerHTML = '<i class="fa-solid fa-copy" style="margin-right: 0.5rem;"></i> Salin'; }, 2000);
                });
            });

            function addGuestbookEntry(entry, isNew = false) {
                const list = document.getElementById('guestbook-list');
                if(!list) return;
                const entryDiv = document.createElement('div');
                entryDiv.className = `guestbook-entry`;
                if (isNew) {
                    entryDiv.style.opacity = 0;
                    requestAnimationFrame(() => {
                        entryDiv.style.transition = 'opacity 0.5s ease-out';
                        entryDiv.style.opacity = 1;
                    });
                }
                const statusClass = entry.attendance_status === 'Hadir' ? 'hadir' : 'tidak-hadir';
                const iconClass = entry.attendance_status === 'Hadir' ? 'fa-circle-check' : 'fa-circle-xmark';
                entryDiv.innerHTML = `<div class="guestbook-header"><p class="name">${entry.name}</p><span class="status ${statusClass}"><i class="fa-solid ${iconClass}" style="margin-right: 0.25rem;"></i> ${entry.attendance_status}</span></div><p class="italic">"${entry.message}"</p>`;
                list.prepend(entryDiv);
            }
            const rsvpForm = document.getElementById('rsvp-form');
            if(rsvpForm) {
                rsvpForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const btn = rsvpForm.querySelector('button');
                    if(!btn) return;
                    btn.disabled = true; btn.textContent = 'Mengirim...';
                    
                    const nameInput = document.getElementById('name');
                    const attendanceSelect = document.getElementById('attendance');
                    const wishesTextarea = document.getElementById('wishes');

                    const newEntry = { 
                        name: nameInput.value, 
                        attendance_status: attendanceSelect.value, 
                        message: wishesTextarea.value 
                    };

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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $invitation->groom_name }} & {{ $invitation->bride_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        /* ... CSS Anda tetap sama ... */
        :root {
            --bg-color: #fdfaf6; /* Off-white */
            --text-color: #5d5d5d;
            --primary-color: #c8a18f; /* Dusty Rose */
            --gold-color: #bfa06b;
            --font-heading: "Great Vibes", cursive;
            --font-body: "Poppins", sans-serif;
        }

        body {
            font-family: var(--font-body);
            margin: 0;
            color: var(--text-color);
            background-color: var(--bg-color);
            overflow: hidden;
        }

        h1, h2, h3, h4 { font-weight: 400; }
        .script-font { font-family: var(--font-heading); color: var(--primary-color); }
        h2.script-font { font-size: 3.5em; margin-bottom: 20px; }

        section {
            padding: 80px 20px;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        /* Halaman Cover & Partikel */
        .cover {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            display: flex; justify-content: center; align-items: center; text-align: center;
            color: white; z-index: 1000; transition: opacity 1.5s ease-out;
        }
        #particle-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        .cover::before {
            content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }
        .cover-content { position: relative; z-index: 1; padding: 20px; }
        .cover h1 { font-size: 5em; margin: 10px 0; color: white; }
        #guest-name { font-size: 1.5em; color: var(--gold-color); font-weight: 600; margin-top: 20px; }
        #open-invitation {
            margin-top: 20px; padding: 12px 25px; background: var(--primary-color);
            color: white; border: none; border-radius: 50px; font-size: 1em;
            cursor: pointer; transition: transform 0.3s;
        }
        #open-invitation:hover { transform: scale(1.05); }

        /* Hero Section */
        .hero {
            background-attachment: fixed; height: 100vh; display: flex;
            justify-content: center; align-items: center; color: white; text-align: center;
        }
        .hero::before {
            content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }
        .hero-content { position: relative; z-index: 1; }
        .hero h1 { font-size: 6em; margin: 0; color: white; }
        .hero .date { font-size: 1.5em; margin-top: 10px; letter-spacing: 2px; }

        /* Animasi Saat Scroll */
        .animate-on-scroll {
            opacity: 0; transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .animate-on-scroll.visible { opacity: 1; transform: translateY(0); }

        /* Pasangan Mempelai */
        .couple { background: white; }
        .couple-container { display: flex; justify-content: center; align-items: center; gap: 30px; flex-wrap: wrap; }
        .couple-info img {
            width: 200px; height: 200px; border-radius: 50%; object-fit: cover;
            border: 8px solid var(--bg-color); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .couple-info h3 { font-size: 3em; margin: 15px 0 5px 0; }
        .couple-separator { font-size: 6em; }

        /* Kisah Cinta (Timeline) */
        .love-story { background-color: var(--bg-color); }
        .timeline { position: relative; max-width: 800px; margin: 0 auto; }
        .timeline::after {
            content: ""; position: absolute; width: 2px; background-color: var(--primary-color);
            top: 0; bottom: 0; left: 50%; margin-left: -1px;
        }
        .timeline-item { padding: 10px 40px; position: relative; width: 50%; box-sizing: border-box; }
        .timeline-item::after {
            content: ""; position: absolute; width: 16px; height: 16px; right: -8px;
            background-color: var(--bg-color); border: 3px solid var(--primary-color);
            top: 20px; border-radius: 50%; z-index: 1;
        }
        .timeline-item.left { left: 0; text-align: right; }
        .timeline-item.right { left: 50%; text-align: left; }
        .timeline-item.right::after { left: -8px; }
        .timeline-content { padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); }

        /* Dress Code Section */
        .dress-code { background-color: white; }
        .color-palette { display: flex; justify-content: center; gap: 15px; margin-top: 20px; }
        .color-box { width: 60px; height: 60px; border-radius: 50%; border: 2px solid #ddd; }
        .dress-code-note { margin-top: 20px; font-style: italic; }

        /* Buku Tamu (Guestbook) */
        .guestbook { background: var(--bg-color); }
        .guestbook-container {
            max-width: 700px; margin: 0 auto; max-height: 400px; overflow-y: auto;
            padding: 10px; border-top: 1px solid #ddd;
        }
        .guestbook-entry {
            background: white; padding: 15px; border-radius: 8px; margin-bottom: 15px;
            text-align: left; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .guestbook-entry .name { font-weight: 600; color: var(--primary-color); }
        .guestbook-entry .attendance { font-size: 0.8em; font-style: italic; color: #999; margin-left: 8px; }
        .guestbook-entry .message { margin-top: 8px; }

        /* Navigasi Bawah */
        .bottom-nav {
            display: none; position: fixed; bottom: 0; left: 0; right: 0;
            background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(5px);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); display: flex;
            justify-content: space-around; padding: 10px 0; z-index: 999;
        }
        .bottom-nav a { color: var(--primary-color); text-decoration: none; text-align: center; font-size: 0.7em; }
        .bottom-nav a i { font-size: 1.5em; display: block; margin-bottom: 2px; }

        /* Tombol Musik */
        #music-toggle {
            position: fixed; bottom: 80px; right: 20px; width: 50px; height: 50px;
            background-color: var(--primary-color); color: white; border: none;
            border-radius: 50%; font-size: 1.2em; cursor: pointer; z-index: 999;
            animation: spin 8s linear infinite; display: flex; justify-content: center; align-items: center;
        }
        #music-toggle.paused { animation-play-state: paused; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* Responsif */
        @media (max-width: 768px) {
            h2.script-font { font-size: 2.8em; }
            .hero h1, .cover h1 { font-size: 3em; }
            .couple-container { flex-direction: column; }
            .timeline::after { left: 10px; }
            .timeline-item { width: 100%; padding-left: 50px; padding-right: 10px; }
            .timeline-item.left, .timeline-item.right { left: 0%; text-align: left; }
            .timeline-item::after { left: 2px; }
            body { padding-bottom: 70px; }
        }
        @media (min-width: 769px) { .bottom-nav { display: none; } }

        .quote { background-color: var(--bg-color); font-style: italic; font-size: 1.2em; max-width: 800px; margin: 0 auto; }
        .countdown { background: white; }
        #countdown-timer { display: flex; justify-content: center; gap: 20px; margin-top: 20px; }
        .time-box { background: var(--bg-color); padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); }
        .time-box span { display: block; font-size: 2em; font-weight: bold; color: var(--primary-color); }
        .time-box span:last-child { font-size: 1em; font-weight: 300; color: var(--text-color); }
        .event { background: var(--bg-color); }
        .event-container { display: flex; justify-content: center; gap: 30px; margin-top: 20px; flex-wrap: wrap; }
        .event-card {
            background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 300px; border-top: 4px solid var(--primary-color);
        }
        .map-button {
            display: inline-block; margin-top: 15px; padding: 10px 20px;
            background: var(--text-color); color: white; text-decoration: none; border-radius: 50px;
        }
        .gallery-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; }
        .gallery-item {
            width: 100%; height: 100%; object-fit: cover; border-radius: 5px;
            cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;
        }
        .gallery-item:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
        .modal {
            display: none; position: fixed; z-index: 1001; padding-top: 50px;
            left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.9);
        }
        .modal-content { margin: auto; display: block; width: 80%; max-width: 700px; }
        .close-modal {
            position: absolute; top: 15px; right: 35px; color: #f1f1f1;
            font-size: 40px; font-weight: bold; cursor: pointer;
        }
        .gift { background-color: white; }
        .gift-card {
            background: var(--bg-color); max-width: 400px; margin: 20px auto;
            padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .copy-button {
            margin-top: 15px; padding: 10px 20px; border: none;
            background-color: var(--primary-color); color: white; border-radius: 5px; cursor: pointer;
        }
        .rsvp { background: var(--bg-color); }
        #rsvp-form { display: flex; flex-direction: column; gap: 15px; max-width: 500px; margin: 0 auto; }
        #rsvp-form input, #rsvp-form select, #rsvp-form textarea {
            padding: 15px; border: 1px solid #ddd; border-radius: 8px;
            font-size: 1em; font-family: var(--font-body);
        }
        #rsvp-form button {
            padding: 15px; border: none; background: var(--primary-color);
            color: white; font-size: 1em; border-radius: 50px; cursor: pointer;
            transition: background-color 0.3s;
        }
        #rsvp-form button:hover { background-color: var(--gold-color); }
        footer { text-align: center; padding: 40px 20px; background: var(--text-color); color: #fdfaf6; }

    </style>
</head>
<body
    style="
        background: url('{{ asset('storage/' . $invitation->hero_image) }}') no-repeat center center/cover;
        background-attachment: fixed;
    "
>

    <div
        class="cover"
        id="cover"
        style="
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('{{ asset('storage/' . $invitation->cover_image) }}') no-repeat
                center center/cover;
        "
    >
        <canvas id="particle-canvas"></canvas>
        <div class="cover-content">
            <h4>The Wedding Of</h4>
            <h1 class="script-font">
                {{ $invitation->groom_name }} & {{ $invitation->bride_name }}
            </h1>
            <p>Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h3 id="guest-name">
                {{ request()->query('to') ?? 'Tamu Undangan' }}
            </h3>
            <p>
                Tanpa mengurangi rasa hormat, kami mengundang Anda untuk hadir di
                acara pernikahan kami.
            </p>
            <button id="open-invitation">
                <i class="fa-solid fa-envelope-open"></i> Buka Undangan
            </button>
        </div>
    </div>

    <main id="main-content" style="display: none;">
        <header
            class="hero"
            id="home"
            style="
                background: url('{{ asset('storage/' . $invitation->hero_image) }}') no-repeat center center/cover;
                background-attachment: fixed;
            "
        >
            <div class="hero-content">
                <h4>You're Invited To The Wedding Of</h4>
                <h1 class="script-font">
                    {{ $invitation->groom_name }} & {{ $invitation->bride_name }}
                </h1>
                <p class="date">
                    @if($invitation->events->first())
                    {{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('dddd, D MMMM YYYY') }}
                    @endif
                </p>
            </div>
        </header>

        <section class="quote animate-on-scroll">
            <p>"{{ $invitation->quote }}"</p>
            <h4 class="script-font">({{ $invitation->quote_source }})</h4>
        </section>

        <section class="couple animate-on-scroll" id="couple">
            <h2 class="script-font">The Bride & Groom</h2>
            <div class="couple-container">
                <div class="couple-info animate-on-scroll">
                    <img
                        src="{{ asset('storage/' . $invitation->groom_photo_path) }}"
                        alt="Mempelai Pria"
                    />
                    <h3 class="script-font">{{ $invitation->groom_name }}</h3>
                    <p>Putra Pertama dari:</p>
                    <p>{{ $invitation->groom_info }}</p>
                </div>
                <div class="couple-separator script-font">&</div>
                <div
                    class="couple-info animate-on-scroll"
                    style="transition-delay: 0.2s;"
                >
                    <img
                        src="{{ asset('storage/' . $invitation->bride_photo_path) }}"
                        alt="Mempelai Wanita"
                    />
                    <h3 class="script-font">{{ $invitation->bride_name }}</h3>
                    <p>Putri Kedua dari:</p>
                    <p>{{ $invitation->bride_info }}</p>
                </div>
            </div>
        </section>

        <section class="love-story animate-on-scroll" id="story">
            <h2 class="script-font">Our Love Story</h2>
            <div class="timeline">
                @foreach($invitation->stories as $index => $story)
                <div
                    class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }} animate-on-scroll"
                >
                    <div class="timeline-content">
                        <h3>{{ $story->title }}</h3>
                        <p>
                            {{ $story->story_date }} - {{ $story->description }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section class="event animate-on-scroll" id="event">
            <h2 class="script-font">Save The Date</h2>
            @if($invitation->events->first())
            <div
                id="countdown-timer"
                data-event-date="{{ $invitation->events->first()->event_date }} {{ $invitation->events->first()->start_time }}"
            >
                </div>
            @endif
            <div class="event-container">
                @foreach($invitation->events as $event)
                <div class="event-card animate-on-scroll">
                    <h3>{{ $event->title }}</h3>
                    <p>
                        <i class="fa-solid fa-calendar-day"></i>
                        {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                    <p>
                        <i class="fa-solid fa-clock"></i>
                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB
                    </p>
                    <p>
                        <i class="fa-solid fa-map-marker-alt"></i>
                        {{ $event->venue_name }}
                    </p>
                    <a
                        href="{{ $event->google_maps_link }}"
                        target="_blank"
                        class="map-button"
                        >Lihat Peta</a
                    >
                </div>
                @endforeach
            </div>
        </section>

        <section class="gallery animate-on-scroll" id="gallery">
            <h2 class="script-font">Our Moments</h2>
            <div class="gallery-container">
                @foreach($invitation->galleries as $galleryImage)
                <img
                    src="{{ asset('storage/' . $galleryImage->image_path) }}"
                    alt="Foto Pre-wedding"
                    class="gallery-item animate-on-scroll"
                />
                @endforeach
            </div>
        </section>

        <section class="dress-code animate-on-scroll">
            <h2 class="script-font">Dress Code</h2>
            <p>
                Kami akan sangat berbahagia jika Anda mengenakan pakaian dengan
                nuansa warna berikut:
            </p>
            <div class="color-palette">
                @if($invitation->events->first() && $invitation->events->first()->dress_code_colors)
                    @foreach($invitation->events->first()->dress_code_colors as $color)
                        <div class="color-box" style="background-color: {{ $color }};"></div>
                    @endforeach
                @else
                    <div class="color-box" style="background-color: #e3d5d1;"></div>
                    <div class="color-box" style="background-color: #bfa06b;"></div>
                    <div class="color-box" style="background-color: #8e8d8a;"></div>
                    <div class="color-box" style="background-color: #fdfaf6;"></div>
                @endif
            </div>
            <p class="dress-code-note">
                @if($invitation->dress_code_info)
                    {{ $invitation->dress_code_info }}
                @else
                    Mohon untuk tidak menggunakan pakaian berwarna putih.
                @endif
            </p>
        </section>

        <section class="gift animate-on-scroll">
            <h2 class="script-font">Wedding Gift</h2>
            <p>
                Doa restu Anda adalah hadiah terindah. Namun, jika Anda ingin
                memberikan tanda kasih, kami telah menyediakan amplop digital
                untuk memudahkan Anda.
            </p>
            @foreach($invitation->gifts as $gift)
            <div class="gift-card animate-on-scroll">
                <h4>
                    <i class="fa-solid fa-building-columns"></i>
                    {{ $gift->bank_name }}
                </h4>
                <p id="account-number">{{ $gift->account_number }}</p>
                <p>a.n. {{ $gift->account_holder_name }}</p>
                <button
                    class="copy-button"
                    data-account="{{ $gift->account_number }}"
                >
                    <i class="fa-solid fa-copy"></i> Salin Rekening
                </button>
            </div>
            @endforeach
        </section>

        <section class="rsvp animate-on-scroll" id="rsvp">
            <h2 class="script-font">Are you Attending?</h2>
            <form id="rsvp-form">
                @csrf
                <input type="text" id="name" placeholder="Nama Anda" required />
                <select id="attendance" required>
                    <option value="">Konfirmasi Kehadiran</option>
                    <option value="Hadir">Saya akan Hadir</option>
                    <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                </select>
                <textarea
                    id="wishes"
                    placeholder="Tulis ucapan dan doa Anda..."
                    rows="4"
                    required
                ></textarea>
                <button type="submit">Kirim Ucapan</button>
            </form>
        </section>

        <section class="guestbook animate-on-scroll">
            <h2 class="script-font">Ucapan & Doa</h2>
            <div class="guestbook-container" id="guestbook-container">
                @foreach($invitation->guestbooks as $guestbookEntry)
                <div class="guestbook-entry">
                    <div class="header">
                        <span class="name">{{ $guestbookEntry->name }}</span>
                        <span class="attendance"
                            ><i class="fa-solid fa-circle-check"></i>
                            {{ $guestbookEntry->attendance_status }}</span
                        >
                    </div>
                    <p class="message">{{ $guestbookEntry->message }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <footer>
            <p>
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila
                Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
            </p>
            <p class="script-font" style="font-size: 2.5em; margin: 20px 0;">
                {{ $invitation->groom_name }} & {{ $invitation->bride_name }}
            </p>
            <p>© 2025. Dibuat dengan ❤.</p>
        </footer>
    </main>

    <div id="gallery-modal" class="modal">
        <span class="close-modal">×</span>
        <img class="modal-content" id="modal-image" />
    </div>

    <button id="music-toggle" class="music-button">
        <i class="fa-solid fa-compact-disc"></i>
    </button>
    <audio id="background-music" src="{{ asset('audio/background-music.mp3') }}" loop></audio>  
    <nav class="bottom-nav">
        <a href="#home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="#couple"><i class="fas fa-heart"></i><span>Couple</span></a>
        <a href="#event"><i class="fas fa-calendar-check"></i><span>Event</span></a>
        <a href="#gallery"><i class="fas fa-images"></i><span>Gallery</span></a>
        <a href="#rsvp"><i class="fas fa-envelope"></i><span>RSVP</span></a>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // --- Personalisasi Nama Tamu ---
            const urlParams = new URLSearchParams(window.location.search);
            const guestName = urlParams.get("to") || "Tamu Undangan";
            document.getElementById("guest-name").textContent = guestName.replace(
                /\+/g,
                " "
            );

            // --- Efek Partikel di Cover ---
            const canvas = document.getElementById("particle-canvas");
            if (canvas) {
                const ctx = canvas.getContext("2d");
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                let particles = [];
                const particleCount = 100;

                class Particle {
                    constructor() {
                        this.x = Math.random() * canvas.width;
                        this.y = Math.random() * canvas.height;
                        this.size = Math.random() * 2 + 1;
                        this.speedX = Math.random() * 1 - 0.5;
                        this.speedY = Math.random() * 1 - 0.5;
                        this.opacity = Math.random() * 0.5 + 0.5;
                    }
                    update() {
                        this.x += this.speedX;
                        this.y += this.speedY;
                        if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                        if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
                    }
                    draw() {
                        ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                        ctx.fill();
                    }
                }

                function initParticles() {
                    for (let i = 0; i < particleCount; i++) {
                        particles.push(new Particle());
                    }
                }

                function animateParticles() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    for (let i = 0; i < particles.length; i++) {
                        particles[i].update();
                        particles[i].draw();
                    }
                    requestAnimationFrame(animateParticles);
                }

                initParticles();
                animateParticles();

                window.addEventListener("resize", () => {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                    particles = [];
                    initParticles();
                });
            }

            // --- Buka Undangan ---
            const openButton = document.getElementById("open-invitation");
            const cover = document.getElementById("cover");
            const mainContent = document.getElementById("main-content");
            const audio = document.getElementById("background-music");
            const musicToggleButton = document.getElementById("music-toggle");

            openButton.addEventListener("click", () => {
                cover.style.opacity = "0";
                setTimeout(() => {
                    cover.style.display = "none";
                }, 1500); // Sesuaikan dengan durasi transisi CSS

                mainContent.style.display = "block";
                document.body.style.overflow = "auto";
                audio.play().catch((e) => console.error(e));
                musicToggleButton.classList.remove("paused");
            });

            // --- Kontrol Musik ---
            musicToggleButton.addEventListener("click", () => {
                if (audio.paused) {
                    audio.play();
                    musicToggleButton.classList.remove("paused");
                } else {
                    audio.pause();
                    musicToggleButton.classList.add("paused");
                }
            });

            // --- Animasi Saat Scroll ---
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                        }
                    });
                },
                { threshold: 0.1 }
            );
            document
                .querySelectorAll(".animate-on-scroll")
                .forEach((el) => observer.observe(el));

            // --- Hitung Mundur ---
            const countdown = () => {
                const countDateElement = document.getElementById("countdown-timer");
                if (!countDateElement) return;

                const eventDateString = countDateElement.dataset.eventDate;
                const countDate = new Date(eventDateString).getTime();
                const now = new Date().getTime();
                const gap = countDate - now;
                const timerContainer = document.getElementById("countdown-timer");

                if (gap > 0) {
                    const second = 1000,
                        minute = second * 60,
                        hour = minute * 60,
                        day = hour * 24;
                    timerContainer.innerHTML = `
                        <div class="time-box"><span id="days">${Math.floor(
                            gap / day
                        )}</span><span>Hari</span></div>
                        <div class="time-box"><span id="hours">${Math.floor(
                            (gap % day) / hour
                        )}</span><span>Jam</span></div>
                        <div class="time-box"><span id="minutes">${Math.floor(
                            (gap % hour) / minute
                        )}</span><span>Menit</span></div>
                        <div class="time-box"><span id="seconds">${Math.floor(
                            (gap % minute) / second
                        )}</span><span>Detik</span></div>`;
                } else {
                    timerContainer.innerHTML = "<h4>Acara Telah Berlangsung</h4>";
                }
            };
            setInterval(countdown, 1000);

            // --- Modal Galeri ---
            const modal = document.getElementById("gallery-modal");
            const modalImg = document.getElementById("modal-image");
            document.querySelectorAll(".gallery-item").forEach((item) => {
                item.addEventListener("click", () => {
                    modal.style.display = "block";
                    modalImg.src = item.src;
                });
            });
            document
                .querySelector(".close-modal")
                .addEventListener("click", () => (modal.style.display = "none"));
            window.addEventListener("click", (e) => {
                if (e.target == modal) modal.style.display = "none";
            });

            // --- Salin Rekening ---
            document.querySelectorAll(".copy-button").forEach((button) => {
                button.addEventListener("click", () => {
                    navigator.clipboard.writeText(button.dataset.account).then(() => {
                        button.innerHTML =
                            '<i class="fa-solid fa-check"></i> Tersalin!';
                        setTimeout(() => {
                            button.innerHTML =
                                '<i class="fa-solid fa-copy"></i> Salin Rekening';
                        }, 2000);
                    });
                });
            });

            // --- Buku Tamu (Guest Book) ---
            const rsvpForm = document.getElementById("rsvp-form");
            const guestbookContainer = document.getElementById("guestbook-container");

            const displayGuestbookEntry = (name, attendance, wishes) => {
                const entryDiv = document.createElement("div");
                entryDiv.className = "guestbook-entry";
                entryDiv.innerHTML = `
                    <div class="header">
                        <span class="name">${name}</span>
                        <span class="attendance"><i class="fa-solid fa-circle-check"></i> ${attendance}</span>
                    </div>
                    <p class="message">${wishes}</p>`;
                guestbookContainer.prepend(entryDiv);
            };

            // Contoh ucapan awal
            displayGuestbookEntry(
                "Budi Santoso",
                "Hadir",
                "Selamat berbahagia John & Jane! Semoga menjadi keluarga yang sakinah, mawadah, warahmah."
            );
            displayGuestbookEntry(
                "Citra Lestari",
                "Hadir",
                "Congrats on your wedding! Wishing you a lifetime of love and happiness."
            );

            rsvpForm.addEventListener("submit", function (event) {
                event.preventDefault();
                const name = document.getElementById("name").value;
                const attendance = document.getElementById("attendance").value;
                const wishes = document.getElementById("wishes").value;

                displayGuestbookEntry(name, attendance, wishes);
                alert(`Terima kasih ${name} atas konfirmasi dan ucapannya!`);
                this.reset();
            });
        });
    </script>
</body>
</html>


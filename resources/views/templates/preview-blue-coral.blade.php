@php
$data = [
    'id' => 2,
    'groom_name' => 'Rian',
    'bride_name' => 'Lestari',
    'cover_image' => 'https://picsum.photos/seed/cover-bamboo/1200/1800',
    'hero_image' => 'https://picsum.photos/seed/hero-bamboo/1920/1080',
    'quote' => 'Cinta bukanlah mencari pasangan yang sempurna, tapi belajar melihat pasangan yang tidak sempurna menjadi sempurna.',
    'quote_source' => 'Sam Keen',
    'groom_photo_path' => 'https://picsum.photos/seed/groom-bamboo/400/400',
    'groom_info' => 'Putra Bapak Hartono & Ibu Sri Lestari',
    'bride_photo_path' => 'https://picsum.photos/seed/bride-bamboo/400/400',
    'bride_info' => 'Putri Bapak Budiman & Ibu Endang',
    'dress_code_info' => 'Kenakan pakaian terbaik Anda dengan sentuhan warna alam.',
    'package' => [
        'has_love_story' => true,
        'has_live_streaming' => false,
        'has_rsvp' => true,
        'has_music' => true
    ],
    'stories' => [
        [
            'title' => 'Awal Mula',
            'story_date' => '10 April 2021',
            'description' => 'Bertemu di sebuah kedai kopi, kami tidak menyangka secangkir latte akan menjadi awal dari segalanya.'
        ],
        [
            'title' => 'Satu Tujuan',
            'story_date' => '5 Mei 2024',
            'description' => 'Di puncak bukit yang tenang, kami berjanji untuk selalu berjalan beriringan, apapun rintangannya.'
        ],
        [
            'title' => 'Hari Ini',
            'story_date' => 'Sekarang',
            'description' => 'Dengan hati yang mantap, kami siap melangkah ke babak baru dan membangun masa depan bersama.'
        ]
    ],
    'events' => [
        [
            'title' => 'Pemberkatan',
            'event_date' => '2025-10-18',
            'start_time' => '10:00:00',
            'venue_name' => 'Gereja Katedral, Bandung',
            'google_maps_link' => 'https://maps.app.goo.gl/abcdef123456',
            'livestream_link' => null,
            'dress_code_colors' => ['#fbf9f6', '#6b7a5a', '#e0a98f', '#4a4441']
        ],
        [
            'title' => 'Syukuran & Resepsi',
            'event_date' => '2025-10-18',
            'start_time' => '18:30:00',
            'venue_name' => 'Gedong Putih, Bandung',
            'google_maps_link' => 'https://maps.app.goo.gl/ghijkl789012',
            'livestream_link' => null,
            'dress_code_colors' => null
        ]
    ],
    'galleries' => [
        ['image_path' => 'https://picsum.photos/seed/gallery1-bamboo/600/800'],
        ['image_path' => 'https://picsum.photos/seed/gallery2-bamboo/800/600'],
        ['image_path' => 'https://picsum.photos/seed/gallery3-bamboo/600/600'],
        ['image_path' => 'https://picsum.photos/seed/gallery4-bamboo/800/600'],
        ['image_path' => 'https://picsum.photos/seed/gallery5-bamboo/600/900'],
        ['image_path' => 'https://picsum.photos/seed/gallery6-bamboo/600/600']
    ],
    'gifts' => [
        [
            'bank_name' => 'BRI',
            'account_number' => '1122334455',
            'account_holder_name' => 'Rian Prasetyo'
        ],
        [
            'bank_name' => 'BNI',
            'account_number' => '5544332211',
            'account_holder_name' => 'Lestari Indah'
        ]
    ],
    'guestbooks' => [
        [
            'id' => 1,
            'name' => 'Budi Santoso',
            'attendance_status' => 'Hadir',
            'message' => 'Selamat Rian dan Lestari! Turut berbahagia, semoga langgeng selamanya. Sampai jumpa di Bandung!'
        ],
        [
            'id' => 2,
            'name' => 'Citra',
            'attendance_status' => 'Hadir',
            'message' => 'Aaaa selamat bestie! Akhirnya ya. Lancar-lancar sampai hari H. Aku pasti dataaang!'
        ],
        [
            'id' => 3,
            'name' => 'Keluarga Bapak Ahmad',
            'attendance_status' => 'Tidak Hadir',
            'message' => 'Selamat menempuh hidup baru untuk kedua mempelai. Mohon maaf kami tidak bisa hadir karena ada acara keluarga di luar kota. Doa terbaik untuk kalian.'
        ]
    ]
];
$invitation = (object) $data;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedding Invitation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bg-color: #F8F9FA;
            --text-color: #343a40;
            --primary-color: #6B8A99; /* Dusty Blue */
            --gold-color: #C0A062;   /* Soft Gold */
            --font-heading: "Great Vibes", cursive;
            --font-body: "Poppins", sans-serif;
        }

        /* --- Base & Typography --- */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            color: var(--text-color);
            background-color: var(--bg-color);
            margin: 0;
            overflow: hidden; /* Hide scroll until invitation is opened */
        }

        .font-heading {
            font-family: var(--font-heading);
            color: var(--primary-color);
        }
        
        /* --- Animations --- */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(2rem);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* --- Cover Section --- */
        #cover {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            background-size: cover;
            background-position: center;
            transition: opacity 1.5s ease-out;
        }
        #cover.hidden {
            opacity: 0;
            pointer-events: none;
        }
        #cover::before {
            content: '';
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
        }
        #particle-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .cover-content {
            position: relative;
            z-index: 1;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .cover-content h1 {
            font-size: 3.75rem; /* 6xl */
        }
        #guest-name {
            font-size: 1.5rem; /* 2xl */
            font-weight: 600;
            color: var(--gold-color);
            margin: 0.5rem 0;
            padding: 0.5rem 1rem;
            border-top: 2px solid rgba(192, 160, 98, 0.5);
            border-bottom: 2px solid rgba(192, 160, 98, 0.5);
        }
        #open-invitation {
            margin-top: 2rem;
            padding: 0.75rem 2rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 9999px;
            font-size: 1.125rem; /* lg */
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        #open-invitation:hover {
            background-color: #55707d;
            transform: scale(1.05);
        }

        /* --- Main Content --- */
        main {
            display: none;
        }

        /* --- General Section Styling --- */
        section {
            position: relative;
            padding: 5rem 1.25rem;
            text-align: center;
            overflow: hidden;
        }
        section .container {
             max-width: 80rem; /* 7xl */
             margin-left: auto;
             margin-right: auto;
        }
        .section-title {
            font-size: 3.75rem; /* 6xl */
            margin-bottom: 3rem;
        }

        /* --- Hero Section --- */
        #home {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 0; /* Override section padding */
        }
        #home::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }
        .hero-content {
            position: relative;
            z-index: 1;
            padding: 1.25rem;
        }
        .hero-content h1 {
            font-size: 4.5rem; /* 7xl */
        }
        .hero-content .date {
            font-size: 1.25rem; /* xl */
            margin-top: 1rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* --- Couple Section --- */
        #couple-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }
        .couple-info img {
            width: 12rem; /* 48 */
            height: 12rem; /* 48 */
            border-radius: 9999px;
            object-fit: cover;
            border: 8px solid rgba(107, 138, 153, 0.2);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }
        .couple-info h3 {
            font-size: 3rem; /* 5xl */
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        .couple-separator {
            font-size: 4.5rem; /* 7xl */
            margin: 1rem 0;
        }

        /* --- Love Story (Timeline) --- */
        #story {
            background-color: white;
        }
        #timeline-container {
            position: relative;
            max-width: 56rem;
            margin: 0 auto;
        }
        .timeline-line {
            position: absolute;
            width: 3px;
            background-color: #dee2e6;
            top: 0;
            bottom: 0;
            left: 1.25rem;
        }
        .timeline-item {
            position: relative;
            padding-left: 3.5rem;
            margin-bottom: 2.5rem;
            width: 100%;
            box-sizing: border-box;
        }
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        .timeline-icon {
            position: absolute;
            left: 1.25rem;
            top: 0;
            transform: translateX(-50%);
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid var(--bg-color);
            z-index: 1;
        }
        .timeline-content {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            text-align: left;
            position: relative;
        }
        .timeline-content h3 {
            font-size: 1.5rem; /* 2xl */
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        /* --- Event Details & Countdown --- */
        #event {
            background-color: white;
        }
        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin: 2rem 0;
        }
        .time-box {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            padding: 1rem;
            width: 6rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            text-align: center;
        }
        .time-box .time-value {
            display: block;
            font-size: 2.25rem; /* 4xl */
            font-weight: 700;
            color: var(--primary-color);
        }
        .time-box .time-label {
            display: block;
            font-size: 0.875rem; /* sm */
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .events-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: stretch;
            gap: 2rem;
            margin-top: 2rem;
        }
        .event-card {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            width: 100%;
            max-width: 24rem; /* sm */
            border-top: 4px solid var(--primary-color);
            text-align: center;
            flex: 1;
            min-width: 280px;
        }
        .event-card h3 {
            font-size: 1.875rem; /* 3xl */
        }
        .event-card p {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .event-card i {
            width: 1rem;
            color: var(--gold-color);
        }
        .map-button {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1.5rem;
            background-color: var(--text-color);
            color: white;
            border-radius: 9999px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .map-button:hover {
            background-color: var(--gold-color);
        }

        /* --- Gallery --- */
        #gallery {
            background-color: white;
        }
        #gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
        .gallery-item {
            overflow: hidden;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .gallery-item:hover img {
            transform: scale(1.10);
        }

        /* --- Gallery Modal --- */
        #gallery-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            display: none; /* Initially hidden */
        }
        #gallery-modal.visible {
            display: flex;
        }
        #modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            cursor: pointer;
            z-index: 20;
        }
        #modal-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 0.5rem;
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }

        /* --- Dress Code --- */
        .color-palette {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .color-box {
            width: 4rem; /* 16 */
            height: 4rem; /* 16 */
            border-radius: 9999px;
            border: 2px solid #eee;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 0.05);
        }

        /* --- Wedding Gift --- */
        #gift {
             background-color: white;
        }
        .gift-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }
        .gift-card {
            background: var(--bg-color);
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            width: 100%;
            max-width: 28rem; /* md */
            text-align: center;
        }
        .gift-card h4 {
            font-size: 1.25rem; /* xl */
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .gift-card .account-number {
            font-size: 1.5rem; /* 2xl */
            font-weight: 700;
            letter-spacing: 0.05em;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        .copy-button {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 9999px;
            color: white;
            cursor: pointer;
            width: 12rem;
            transition: background-color 0.3s;
        }

        /* --- RSVP & Guestbook --- */
        #rsvp-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-width: 32rem; /* lg */
            margin: 2rem auto 0;
            text-align: left;
        }
        #rsvp-form input, #rsvp-form select, #rsvp-form textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            font-family: var(--font-body);
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        #rsvp-form input:focus, #rsvp-form select:focus, #rsvp-form textarea:focus {
            outline: none;
            border-color: transparent;
            box-shadow: 0 0 0 2px var(--gold-color);
        }
        #rsvp-form button {
            padding: 0.75rem;
            border: none;
            background: var(--primary-color);
            color: white;
            font-size: 1.125rem; /* lg */
            border-radius: 9999px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #rsvp-form button:disabled {
            background-color: #999;
            cursor: not-allowed;
        }
        #guestbook-container {
            margin-top: 4rem;
        }
        .guestbook-list {
            max-height: 24rem; /* 96 */
            overflow-y: auto;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: inset 0 2px 4px 0 rgb(0 0 0 / 0.05);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .guestbook-entry {
            background: var(--bg-color);
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 0.05);
            text-align: left;
        }
        .guestbook-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        .guestbook-header .name {
            font-weight: 700;
            color: var(--primary-color);
        }
        .guestbook-header .status {
            margin-left: 0.75rem;
            font-size: 0.75rem; /* xs */
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
        }
        .status.hadir {
            background-color: #E6F5F2;
            color: #005C53;
        }
        .status.tidak-hadir {
            background-color: #F8E6E6;
            color: #991B1B;
        }

        /* --- Footer --- */
        footer {
            padding: 4rem 1.25rem;
            background-color: var(--primary-color);
            color: rgba(255, 255, 255, 0.9);
        }
        footer .font-heading {
            color: white;
            font-size: 2.5rem; /* 5xl */
            margin: 1.5rem 0;
        }

        /* --- Floating Buttons (Music & Nav) --- */
        #music-toggle {
            position: fixed;
            bottom: 6rem;
            right: 1.25rem;
            width: 3rem;
            height: 3rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 9999px;
            font-size: 1.25rem; /* xl */
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s;
        }
        #music-toggle.playing {
            animation: spin 8s linear infinite;
        }
        #music-toggle:hover {
            transform: scale(1.1);
        }

        #bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-around;
            padding: 0.5rem;
            z-index: 998;
        }
        #bottom-nav a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.75rem; /* xs */
            width: 100%;
            transition: color 0.3s;
        }
        #bottom-nav a:hover {
            color: var(--gold-color);
        }
        #bottom-nav i {
            font-size: 1.25rem; /* xl */
            margin-bottom: 0.25rem;
        }

        /* --- Responsive Design --- */
        @media (min-width: 768px) { /* md */
            .cover-content h1 { font-size: 5rem; /* 8xl */ }
            .hero-content h1 { font-size: 6rem; /* 9xl */ }
            #couple-container { flex-direction: row; gap: 1rem; }
            .couple-info img { width: 14rem; height: 14rem; }
            .couple-info h3 { font-size: 3.75rem; /* 6xl */ }
            .couple-separator { margin: 0 2rem; font-size: 6rem; /* 8xl */ }
            .section-title { font-size: 4.5rem; /* 7xl */ }
            .countdown-timer { gap: 1.25rem; }
            #gallery-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
            #bottom-nav { display: none; }
            #music-toggle { bottom: 2rem; }
            
            /* --- Desktop Timeline --- */
            .timeline-line {
                left: 50%;
                transform: translateX(-50%);
            }
            .timeline-item {
                padding-left: 0;
                width: 50%;
            }
            .timeline-item.right {
                align-self: flex-end;
                padding-left: 2.5rem;
            }
            .timeline-item.left {
                align-self: flex-start;
                padding-right: 2.5rem;
                text-align: right;
            }
            .timeline-item.left .timeline-content {
                text-align: right;
            }
            #timeline-container {
                display: flex;
                flex-direction: column;
            }
            .timeline-icon {
                left: 50%;
            }
            .timeline-content::before {
                content: '';
                position: absolute;
                top: 1rem;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 10px;
            }
            .timeline-item.left .timeline-content::before {
                right: -20px;
                border-color: transparent transparent transparent white;
            }
             .timeline-item.right .timeline-content::before {
                left: -20px;
                border-color: transparent white transparent transparent;
            }
        }

    </style>
</head>
<body>

    <!-- Cover -->
    <div id="cover">
        <canvas id="particle-canvas"></canvas>
        <div class="cover-content">
            <p class="text-lg">The Wedding Of</p>
            <h1 class="font-heading" id="cover-names"></h1>
            <p class="mt-8 text-sm">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h3 id="guest-name">Tamu Undangan</h3>
            <p class="mt-2 max-w-md text-sm">
                Tanpa mengurangi rasa hormat, kami mengundang Anda untuk hadir di acara pernikahan kami.
            </p>
            <button id="open-invitation">
                <i class="fa-solid fa-envelope-open mr-2"></i> Buka Undangan
            </button>
        </div>
    </div>
    
    <!-- Audio Player -->
    <audio id="background-music" src="https://firebasestorage.googleapis.com/v0/b/frame-api-chat-2-dev.appspot.com/o/public%2Fbg-music.mp3?alt=media" loop></audio>
    
    <!-- Main Content -->
    <main id="main-content">
        <!-- Hero Section -->
        <header id="home">
            <div class="hero-content">
                <h4 class="text-xl">You're Invited To The Wedding Of</h4>
                <h1 class="font-heading" id="hero-names"></h1>
                <p class="date" id="hero-date"></p>
            </div>
        </header>

        <!-- Quote Section -->
        <section id="quote" class="bg-white animate-on-scroll">
             <div class="container">
                <blockquote class="text-lg md:text-xl italic max-w-3xl mx-auto" id="quote-text"></blockquote>
                <h4 class="font-heading text-4xl mt-4" id="quote-source"></h4>
            </div>
        </section>

        <!-- Couple Section -->
        <section id="couple" class="bg-white animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">The Bride & Groom</h2>
                <div id="couple-container">
                    <!-- Groom Info will be injected here -->
                    <div class="couple-separator font-heading">&</div>
                    <!-- Bride Info will be injected here -->
                </div>
            </div>
        </section>

        <!-- Love Story Section -->
        <section id="story" class="animate-on-scroll">
             <div class="container">
                <h2 class="font-heading section-title">Our Love Story</h2>
                <div id="timeline-container">
                    <div class="timeline-line"></div>
                    <!-- Timeline items will be injected here -->
                </div>
            </div>
        </section>

        <!-- Event Details Section -->
        <section id="event" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Save The Date</h2>
                <div class="countdown-timer" id="countdown-timer"></div>
                <div class="events-container" id="events-container">
                    <!-- Event cards will be injected here -->
                </div>
            </div>
        </section>

        <!-- Live Stream Section -->
        <section id="livestream" class="animate-on-scroll">
            <!-- Content will be injected if available -->
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Our Moments</h2>
                <div id="gallery-grid">
                    <!-- Gallery images will be injected here -->
                </div>
            </div>
        </section>
        
        <!-- Gallery Modal -->
        <div id="gallery-modal">
            <span id="modal-close">&times;</span>
            <img id="modal-image" alt="Enlarged gallery view"/>
        </div>

        <!-- Dress Code Section -->
        <section id="dress-code" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Dress Code</h2>
                <p class="mb-6 max-w-lg mx-auto">Kami akan sangat berbahagia jika Anda mengenakan pakaian dengan nuansa warna berikut:</p>
                <div class="color-palette" id="color-palette"></div>
                <p class="italic text-gray-600" id="dress-code-info"></p>
            </div>
        </section>

        <!-- Wedding Gift Section -->
        <section id="gift" class="animate-on-scroll">
            <div class="container">
                <h2 class="font-heading section-title">Wedding Gift</h2>
                <p class="mb-8 max-w-2xl mx-auto">
                    Doa restu Anda adalah hadiah terindah. Namun, jika Anda ingin memberikan tanda kasih, kami telah menyediakan amplop digital untuk memudahkan Anda.
                </p>
                <div class="gift-container" id="gift-container">
                    <!-- Gift cards will be injected here -->
                </div>
            </div>
        </section>

        <!-- RSVP Section -->
        <section id="rsvp" class="animate-on-scroll">
            <div class="container max-w-3xl mx-auto">
                <h2 class="font-heading section-title">Are You Attending?</h2>
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

                <div id="guestbook-container">
                    <h2 class="font-heading section-title mt-16">Ucapan & Doa</h2>
                    <div class="guestbook-list" id="guestbook-list">
                        <!-- Guestbook entries will be injected here -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="max-w-3xl mx-auto">
                <p class="text-lg">
                    Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
                </p>
                <p class="font-heading" id="footer-names"></p>
                <p class="text-sm">&copy; <span id="footer-year"></span>. Dibuat dengan ❤.</p>
            </div>
        </footer>

    </main>

    <!-- Floating UI -->
    <div id="floating-ui-container">
        <!-- Music toggle and bottom nav will be injected here -->
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const dummyData = {
            id: 2,
            groom_name: 'Rian',
            bride_name: 'Lestari',
            cover_image: 'https://picsum.photos/seed/cover-rustic/1200/1800',
            hero_image: 'https://picsum.photos/seed/hero-rustic/1920/1080',
            quote: 'Cinta bukanlah mencari pasangan yang sempurna, tapi belajar melihat pasangan yang tidak sempurna menjadi sempurna.',
            quote_source: 'Sam Keen',
            groom_photo_path: 'https://picsum.photos/seed/groom-rustic/400/400',
            groom_info: 'Putra Bapak Hartono & Ibu Sri Lestari',
            bride_photo_path: 'https://picsum.photos/seed/bride-rustic/400/400',
            bride_info: 'Putri Bapak Budiman & Ibu Endang',
            dress_code_info: 'Kenakan pakaian terbaik Anda dengan sentuhan warna alam.',
            package: { has_love_story: true, has_live_streaming: false, has_rsvp: true, has_music: true },
            stories: [
                { title: 'Awal Mula', story_date: '10 April 2021', description: 'Bertemu di sebuah kedai kopi, kami tidak menyangka secangkir latte akan menjadi awal dari segalanya.' },
                { title: 'Satu Tujuan', story_date: '5 Mei 2024', description: 'Di puncak bukit yang tenang, kami berjanji untuk selalu berjalan beriringan, apapun rintangannya.' },
                { title: 'Hari Ini', story_date: 'Sekarang', description: 'Dengan hati yang mantap, kami siap melangkah ke babak baru dan membangun masa depan bersama.' },
            ],
            events: [
                {
                    title: 'Pemberkatan',
                    event_date: '2025-10-18',
                    start_time: '10:00:00',
                    venue_name: 'Gereja Katedral, Bandung',
                    google_maps_link: 'https://maps.app.goo.gl/abcdef123456',
                    livestream_link: null, 
                    dress_code_colors: ['#fbf9f6', '#6b7a5a', '#e0a98f', '#4a4441'], 
                },
                {
                    title: 'Syukuran & Resepsi',
                    event_date: '2025-10-18',
                    start_time: '18:30:00',
                    venue_name: 'Gedong Putih, Bandung',
                    google_maps_link: 'https://maps.app.goo.gl/ghijkl789012',
                    livestream_link: null, dress_code_colors: null,
                },
            ],
            galleries: [
                { image_path: 'https://picsum.photos/seed/gallery1-rustic/600/800' },
                { image_path: 'https://picsum.photos/seed/gallery2-rustic/800/600' },
                { image_path: 'https://picsum.photos/seed/gallery3-rustic/600/600' },
                { image_path: 'https://picsum.photos/seed/gallery4-rustic/800/600' },
                { image_path: 'https://picsum.photos/seed/gallery5-rustic/600/900' },
                { image_path: 'https://picsum.photos/seed/gallery6-rustic/600/600' },
            ],
            gifts: [
                { bank_name: 'BRI', account_number: '1122334455', account_holder_name: 'Rian Prasetyo' },
                { bank_name: 'BNI', account_number: '5544332211', account_holder_name: 'Lestari Indah' },
            ],
            guestbooks: [
                { id: 1, name: 'Budi Santoso', attendance_status: 'Hadir', message: 'Selamat Rian dan Lestari! Turut berbahagia, semoga langgeng selamanya. Sampai jumpa di Bandung!' },
                { id: 2, name: 'Citra', attendance_status: 'Hadir', message: 'Aaaa selamat bestie! Akhirnya ya. Lancar-lancar sampai hari H. Aku pasti dataaang!' },
                { id: 3, name: 'Keluarga Bapak Ahmad', attendance_status: 'Tidak Hadir', message: 'Selamat menempuh hidup baru untuk kedua mempelai. Mohon maaf kami tidak bisa hadir karena ada acara keluarga di luar kota. Doa terbaik untuk kalian.' },
            ],
            };
            const invitationData = @json($invitation) || dummyData;
            
            // --- ELEMENT SELECTORS ---
            const cover = document.getElementById('cover');
            const openButton = document.getElementById('open-invitation');
            const mainContent = document.getElementById('main-content');
            const audio = document.getElementById('background-music');
            
            // --- INJECT DATA INTO THE DOM ---
            const populateContent = () => {
                const { groom_name, bride_name, cover_image, hero_image, quote, quote_source, groom_photo_path, groom_info, bride_photo_path, bride_info, stories, events, galleries, dress_code_info, gifts, guestbooks, package: pkg } = invitationData;
                
                // Helper for date formatting
                const formatDate = (dateString) => {
                    if (!dateString) return 'Coming Soon';
                    try {
                        return new Date(dateString).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                    } catch (e) { return 'Coming Soon'; }
                };
                
                // Cover & Hero
                cover.style.backgroundImage = `url(${cover_image})`;
                document.getElementById('home').style.backgroundImage = `url(${hero_image})`;
                const names = `${groom_name} & ${bride_name}`;
                document.getElementById('cover-names').textContent = names;
                document.getElementById('hero-names').textContent = names;
                document.getElementById('hero-date').textContent = formatDate(events[0]?.event_date);

                // Quote
                document.getElementById('quote-text').textContent = `"${quote}"`;
                document.getElementById('quote-source').textContent = `(${quote_source})`;

                // Couple
                const coupleContainer = document.getElementById('couple-container');
                coupleContainer.insertAdjacentHTML('afterbegin', `
                    <div class="couple-info">
                        <img src="${groom_photo_path}" alt="${groom_name}">
                        <h3 class="font-heading">${groom_name}</h3>
                        <p>${groom_info}</p>
                    </div>`);
                coupleContainer.insertAdjacentHTML('beforeend', `
                     <div class="couple-info">
                        <img src="${bride_photo_path}" alt="${bride_name}">
                        <h3 class="font-heading">${bride_name}</h3>
                        <p>${bride_info}</p>
                    </div>`);

                // Love Story
                if (pkg.has_love_story) {
                    const timelineContainer = document.getElementById('timeline-container');
                    const getStoryIcon = (title) => {
                        const lowerTitle = title.toLowerCase();
                        if (lowerTitle.includes('lamaran') || lowerTitle.includes('proposal')) return 'fa-ring';
                        if (lowerTitle.includes('bertemu') || lowerTitle.includes('first')) return 'fa-comments';
                        if (lowerTitle.includes('menuju') || lowerTitle.includes('bahagia')) return 'fa-heart';
                        return 'fa-star'; // Default icon
                    };
                    stories.forEach((story, index) => {
                        const side = index % 2 === 0 ? 'left' : 'right';
                        const iconClass = getStoryIcon(story.title);
                        timelineContainer.innerHTML += `
                            <div class="timeline-item ${side}">
                                <div class="timeline-icon"><i class="fa-solid ${iconClass}"></i></div>
                                <div class="timeline-content">
                                    <h3>${story.title}</h3>
                                    <p class="text-sm text-gray-500 mb-2">${story.story_date}</p>
                                    <p>${story.description}</p>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    document.getElementById('story').style.display = 'none';
                }

                // Events
                const eventsContainer = document.getElementById('events-container');
                events.forEach(event => {
                    const time = event.start_time.substring(0, 5) + ' WIB';
                    eventsContainer.innerHTML += `
                        <div class="event-card">
                            <h3 class="font-heading">${event.title}</h3>
                            <p><i class="fa-solid fa-calendar-day"></i><span>${formatDate(event.event_date)}</span></p>
                            <p><i class="fa-solid fa-clock"></i><span>${time}</span></p>
                            <p><i class="fa-solid fa-map-marker-alt"></i><span>${event.venue_name}</span></p>
                            <a href="${event.google_maps_link}" target="_blank" class="map-button">
                                <i class="fa-solid fa-map-location-dot mr-2"></i> Lihat Peta
                            </a>
                        </div>
                    `;
                });

                // Live Stream
                const liveStreamEvents = events.filter(e => e.livestream_link);
                if (pkg.has_live_streaming && liveStreamEvents.length > 0) {
                     const livestreamSection = document.getElementById('livestream');
                     let liveStreamCards = '';
                     liveStreamEvents.forEach(event => {
                        liveStreamCards += `
                            <div class="event-card">
                                <h3 class="font-heading">${event.title}</h3>
                                <p><i class="fa-solid fa-calendar-day"></i><span>${formatDate(event.event_date)}</span></p>
                                <p><i class="fa-solid fa-clock"></i><span>${event.start_time.substring(0, 5)} WIB</span></p>
                                <a href="${event.livestream_link}" target="_blank" class="map-button bg-[var(--primary-color)]">
                                    <i class="fa-solid fa-video mr-2"></i> Tonton Live
                                </a>
                            </div>`;
                     });
                     livestreamSection.innerHTML = `
                        <div class="container">
                             <h2 class="font-heading section-title">Live Streaming</h2>
                            <p class="mb-8 max-w-2xl mx-auto">Bagi Anda yang tidak dapat hadir, saksikan siaran langsung pernikahan kami melalui tautan di bawah ini.</p>
                            <div class="events-container">${liveStreamCards}</div>
                        </div>`;
                } else {
                    document.getElementById('livestream').style.display = 'none';
                }

                // Gallery
                const galleryGrid = document.getElementById('gallery-grid');
                galleries.forEach(photo => {
                    galleryGrid.innerHTML += `
                        <div class="gallery-item">
                            <img src="${photo.image_path}" alt="Gallery moment" loading="lazy">
                        </div>
                    `;
                });
                
                // Dress Code
                const colorPalette = document.getElementById('color-palette');
                let colors = events[0]?.dress_code_colors;

                // FIX: Check if colors is a valid array before using forEach
                if (!Array.isArray(colors) || colors.length === 0) {
                    // Provide a fallback if no colors are defined
                    colors = ['#FEFBF6', '#E6B4B4', '#D4AFB9', '#A2B29F'];
                }
                
                colors.forEach(color => {
                    colorPalette.innerHTML += `<div class="color-box" style="background-color: ${color};"></div>`;
                });

                document.getElementById('dress-code-info').textContent = dress_code_info;

                // Gifts & RSVP
                if (pkg.has_rsvp) {
                    const giftContainer = document.getElementById('gift-container');
                    gifts.forEach(gift => {
                        giftContainer.innerHTML += `
                        <div class="gift-card">
                            <h4>${gift.bank_name}</h4>
                            <p class="account-number">${gift.account_number}</p>
                            <p class="mb-4">a.n. ${gift.account_holder_name}</p>
                            <button class="copy-button bg-[var(--primary-color)]" data-account="${gift.account_number}">
                                <i class="fa-solid fa-copy mr-2"></i> Salin Rekening
                            </button>
                        </div>
                        `;
                    });

                    // Initial Guestbook
                    guestbooks.forEach(addGuestbookEntry);
                } else {
                    document.getElementById('gift').style.display = 'none';
                    document.getElementById('rsvp').style.display = 'none';
                }

                // Footer
                document.getElementById('footer-names').textContent = names;
                document.getElementById('footer-year').textContent = new Date().getFullYear();

                // Floating UI
                const floatingUiContainer = document.getElementById('floating-ui-container');
                if (pkg.has_music) {
                    floatingUiContainer.innerHTML += `<button id="music-toggle"><i class="fa-solid fa-compact-disc"></i></button>`;
                }
                floatingUiContainer.innerHTML += `
                    <nav id="bottom-nav">
                        <a href="#home"><i class="fas fa-home"></i><span>Home</span></a>
                        <a href="#couple"><i class="fas fa-heart"></i><span>Couple</span></a>
                        <a href="#event"><i class="fas fa-calendar-check"></i><span>Event</span></a>
                        <a href="#gallery"><i class="fas fa-images"></i><span>Gallery</span></a>
                        ${pkg.has_rsvp ? `<a href="#rsvp"><i class="fas fa-envelope"></i><span>RSVP</span></a>` : ''}
                    </nav>
                `;
            };

            // --- GUEST NAME FROM URL ---
            const urlParams = new URLSearchParams(window.location.search);
            const guestName = urlParams.get("to") || "Tamu Undangan";
            document.getElementById("guest-name").textContent = guestName.replace(/\+/g, " ");

            // --- PARTICLE EFFECT ---
            const canvas = document.getElementById("particle-canvas");
            if (canvas) {
                const ctx = canvas.getContext("2d");
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                let particles = [];
                const createParticle = () => ({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    size: Math.random() * 2 + 1,
                    speedX: Math.random() * 1 - 0.5,
                    speedY: Math.random() * 1 - 0.5,
                    opacity: Math.random() * 0.5 + 0.5,
                });
                const initParticles = () => {
                    particles = [];
                    for (let i = 0; i < 100; i++) particles.push(createParticle());
                };
                const animateParticles = () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    particles.forEach(p => {
                        p.x += p.speedX; p.y += p.speedY;
                        if (p.x < 0 || p.x > canvas.width) p.speedX *= -1;
                        if (p.y < 0 || p.y > canvas.height) p.speedY *= -1;
                        ctx.fillStyle = `rgba(255, 255, 255, ${p.opacity})`;
                        ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2); ctx.fill();
                    });
                    requestAnimationFrame(animateParticles);
                };
                initParticles();
                animateParticles();
                window.addEventListener("resize", () => {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                    initParticles();
                });
            }
            
            // --- OPEN INVITATION ---
            openButton.addEventListener('click', () => {
                cover.classList.add('hidden');
                setTimeout(() => {
                    cover.style.display = 'none';
                }, 1500);
                mainContent.style.display = 'block';
                document.body.style.overflow = 'auto';

                if (audio) {
                    audio.play().catch(e => console.error("Autoplay was prevented by browser."));
                    const musicToggle = document.getElementById('music-toggle');
                    if (musicToggle) musicToggle.classList.add('playing');
                }
            });

            // --- MUSIC CONTROL ---
            document.getElementById('floating-ui-container').addEventListener('click', (e) => {
                const musicToggle = e.target.closest('#music-toggle');
                if (!musicToggle) return;
                
                if (audio.paused) {
                    audio.play();
                    musicToggle.classList.add('playing');
                } else {
                    audio.pause();
                    musicToggle.classList.remove('playing');
                }
            });
            
            // --- SCROLL ANIMATION ---
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            animatedElements.forEach(el => observer.observe(el));

            // --- COUNTDOWN TIMER ---
            const countdownContainer = document.getElementById('countdown-timer');
            const mainEventDate = invitationData.events.length > 0 ? `${invitationData.events[0].event_date}T${invitationData.events[0].start_time}` : '';
            if (mainEventDate) {
                 const countdownInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const target = new Date(mainEventDate).getTime();
                    const gap = target - now;
                    
                    if (gap > 0) {
                        const days = Math.floor(gap / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((gap % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((gap % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((gap % (1000 * 60)) / 1000);
                        countdownContainer.innerHTML = `
                            <div class="time-box"><span class="time-value">${days}</span><span class="time-label">Hari</span></div>
                            <div class="time-box"><span class="time-value">${hours}</span><span class="time-label">Jam</span></div>
                            <div class="time-box"><span class="time-value">${minutes}</span><span class="time-label">Menit</span></div>
                            <div class="time-box"><span class="time-value">${seconds}</span><span class="time-label">Detik</span></div>
                        `;
                    } else {
                        countdownContainer.innerHTML = `<h4 class="text-2xl font-semibold">Acara Telah Berlangsung</h4>`;
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }

            // --- GALLERY MODAL ---
            const galleryModal = document.getElementById('gallery-modal');
            const modalImage = document.getElementById('modal-image');
            document.getElementById('gallery-grid').addEventListener('click', (e) => {
                if(e.target.tagName === 'IMG') {
                    modalImage.src = e.target.src;
                    galleryModal.classList.add('visible');
                }
            });
            document.getElementById('modal-close').addEventListener('click', () => galleryModal.classList.remove('visible'));
            galleryModal.addEventListener('click', () => galleryModal.classList.remove('visible'));

            // --- COPY ACCOUNT NUMBER ---
            document.getElementById('gift-container').addEventListener('click', e => {
                const button = e.target.closest('.copy-button');
                if (!button) return;

                navigator.clipboard.writeText(button.dataset.account).then(() => {
                    button.innerHTML = '<i class="fa-solid fa-check mr-2"></i> Tersalin!';
                    button.style.backgroundColor = '#28a745';
                    setTimeout(() => {
                       button.innerHTML = '<i class="fa-solid fa-copy mr-2"></i> Salin Rekening';
                       button.style.backgroundColor = 'var(--primary-color)';
                    }, 2000);
                });
            });

            // --- RSVP & GUESTBOOK ---
            function addGuestbookEntry(entry) {
                const list = document.getElementById('guestbook-list');
                const entryDiv = document.createElement('div');
                entryDiv.className = 'guestbook-entry';
                const statusClass = entry.attendance_status === 'Hadir' ? 'hadir' : 'tidak-hadir';
                const iconClass = entry.attendance_status === 'Hadir' ? 'fa-circle-check' : 'fa-circle-xmark';
                
                entryDiv.innerHTML = `
                    <div class="guestbook-header">
                        <p class="name">${entry.name}</p>
                        <span class="status ${statusClass}">
                            <i class="fa-solid ${iconClass} mr-1"></i>
                            ${entry.attendance_status}
                        </span>
                    </div>
                    <p class="text-gray-700">${entry.message}</p>
                `;
                list.prepend(entryDiv); // Add new entries to the top
            }

            const rsvpForm = document.getElementById('rsvp-form');
            if(rsvpForm) {
                rsvpForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const submitButton = rsvpForm.querySelector('button');
                    submitButton.disabled = true;
                    submitButton.textContent = 'Mengirim...';
                    
                    const newEntry = {
                        name: document.getElementById('name').value,
                        attendance_status: document.getElementById('attendance').value,
                        message: document.getElementById('wishes').value,
                    };
                    
                    setTimeout(() => { // Simulate API call
                        addGuestbookEntry(newEntry);
                        rsvpForm.reset();
                        submitButton.disabled = false;
                        submitButton.textContent = 'Kirim Ucapan';
                    }, 1000);
                });
            }

            // --- INITIALIZE ---
            populateContent();
        });
    </script>
</body>
</html>
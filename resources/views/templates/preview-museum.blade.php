@php
    // Logika untuk menentukan action form dengan aman
    $formAction = '#'; // Default action jika tidak ada undangan
    if (isset($invitation) && !empty($invitation->id)) {
        $formAction = route('guestbook.store', $invitation);
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Undangan | {{ $invitation->groom_name }} & {{ $invitation->bride_name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* [Seluruh CSS dari prompt Anda diletakkan di sini] */
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
         }

         :root {
             --primary-dark: #0a0a0a;
             --secondary-dark: #1a1a1a;
             --accent-gray: #2a2a2a;
             --light-gray: #8a8a8a;
             --white: #ffffff;
             --gold: #c9a961;
             --bg-mobile: url('{{ asset('storage/' . ($invitation->cover_image ?? 'images/defaults/default-cover.webp')) }}');
           
             /* Definisikan URL gambar untuk desktop (menggunakan hero_image) */
             --bg-desktop: url('{{ asset('storage/'  . ($invitation->hero_image ?? 'images/defaults/default-hero.webp')) }}');
         }

         body {
             font-family: 'Times New Roman', serif;
             background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 50%, var(--accent-gray) 100%);
             color: var(--white);
             line-height: 1.6;
             overflow-x: hidden;
         }

         /* Curtain Animation */
         .curtain {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100vh;
             background: linear-gradient(45deg, var(--primary-dark), var(--secondary-dark));
             z-index: 9999;
             display: flex;
             align-items: center;
             justify-content: center;
             transition: transform 1.5s cubic-bezier(0.4, 0, 0.2, 1);
         }

         .curtain.open {
             transform: translateY(-100%);
         }

         .curtain-content {
             text-align: center;
             opacity: 0;
             animation: fadeInOut 3s ease-in-out;
         }

         .curtain h1 {
             font-size: 3rem;
             font-weight: 300;
             letter-spacing: 0.2rem;
             color: var(--gold);
             margin-bottom: 1rem;
         }

         .curtain p {
             font-size: 1.2rem;
             color: var(--light-gray);
             letter-spacing: 0.1rem;
         }

         @keyframes fadeInOut {
             0%, 100% { opacity: 0; }
             50% { opacity: 1; }
         }

         /* Main Container */
         .container {
             max-width: 1200px;
             margin: 0 auto;
             padding: 0 2rem;
         }

         /* Museum Frame Style */
         .museum-frame {
             background: var(--secondary-dark);
             border: 3px solid var(--accent-gray);
             box-shadow: 
                 inset 0 0 20px rgba(0,0,0,0.5),
                 0 10px 30px rgba(0,0,0,0.8);
             margin: 2rem 0;
             position: relative;
             transform: translateY(50px);
             opacity: 0;
             transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
         }

         .museum-frame.visible {
             transform: translateY(0);
             opacity: 1;
         }

         .museum-frame::before {
             content: '';
             position: absolute;
             top: -10px;
             left: -10px;
             right: -10px;
             bottom: -10px;
             background: linear-gradient(45deg, var(--gold), transparent, var(--gold));
             z-index: -1;
             opacity: 0.3;
         }

         /* Header Section */
         header {
             height: 100vh;
             display: flex;
             align-items: center;
             justify-content: center;
             text-align: center;
             background: 
                 radial-gradient(ellipse at center, rgba(201, 169, 97, 0.1) 0%, transparent 70%),
                 linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
            background-image: var(--bg-mobile);
            background-size: cover;

             position: relative;
             overflow: hidden;
         }

         header::before {
             content: '';
             position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23333" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
             opacity: 0.1;
         }

         header h1 {
             font-size: 4rem;
             font-weight: 300;
             letter-spacing: 0.3rem;
             margin-bottom: 1rem;
             color: var(--white);
             text-shadow: 0 4px 20px rgba(0,0,0,0.8);
             animation: titleSlide 2s ease-out 0.5s both;
         }

         header p {
             font-size: 1.5rem;
             color: var(--light-gray);
             letter-spacing: 0.1rem;
             margin-bottom: 0.5rem;
             animation: subtitleSlide 2s ease-out 1s both;
         }

         .guest-name {
             color: var(--gold);
             font-style: italic;
             animation: guestSlide 2s ease-out 1.5s both;
         }

         @keyframes titleSlide {
             from { transform: translateY(-50px); opacity: 0; }
             to { transform: translateY(0); opacity: 1; }
         }

         @keyframes subtitleSlide {
             from { transform: translateX(-50px); opacity: 0; }
             to { transform: translateX(0); opacity: 1; }
         }

         @keyframes guestSlide {
             from { transform: translateX(50px); opacity: 0; }
             to { transform: translateX(0); opacity: 1; }
         }

         /* Section Styling */
         section {
             padding: 5rem 0;
             position: relative;
         }

         section h2 {
             font-size: 2.5rem;
             font-weight: 300;
             text-align: center;
             margin-bottom: 3rem;
             color: var(--gold);
             letter-spacing: 0.2rem;
             position: relative;
         }

         section h2::after {
             content: '';
             width: 100px;
             height: 2px;
             background: linear-gradient(90deg, transparent, var(--gold), transparent);
             position: absolute;
             bottom: -10px;
             left: 50%;
             transform: translateX(-50%);
         }
         
         section h3.section-subtitle {
            font-size: 1.8rem;
            font-weight: 300;
            text-align: center;
            margin-top: -1rem;
            margin-bottom: 3rem;
            color: var(--light-gray);
            letter-spacing: 0.1rem;
        }

         /* Quote Section */
         #quote {
             background: var(--secondary-dark);
             text-align: center;
             padding: 6rem 2rem;
         }

         blockquote {
             font-size: 1.8rem;
             font-style: italic;
             color: var(--white);
             margin-bottom: 2rem;
             line-height: 1.8;
             max-width: 800px;
             margin-left: auto;
             margin-right: auto;
         }

         blockquote::before,
         blockquote::after {
             content: '"';
             font-size: 3rem;
             color: var(--gold);
             opacity: 0.7;
         }

         /* Couple Section */
         #couple {
             background: var(--primary-dark);
         }

         .couple-container {
             display: grid;
             grid-template-columns: 1fr 1fr;
             gap: 4rem;
             max-width: 1000px;
             margin: 0 auto;
         }

         .couple-card {
             background: var(--secondary-dark);
             border: 2px solid var(--accent-gray);
             padding: 3rem 2rem;
             text-align: center;
             transform: perspective(1000px) rotateY(5deg);
             transition: all 0.5s ease;
             box-shadow: 0 20px 40px rgba(0,0,0,0.6);
         }

         .couple-card:hover {
             transform: perspective(1000px) rotateY(0deg) scale(1.05);
             box-shadow: 0 30px 60px rgba(0,0,0,0.8);
         }

         .couple-card h3 {
             font-size: 2rem;
             color: var(--gold);
             margin-bottom: 1.5rem;
             letter-spacing: 0.1rem;
         }

         .couple-card img {
             width: 200px;
             height: 200px;
             border-radius: 50%;
             border: 3px solid var(--gold);
             margin-bottom: 1.5rem;
             object-fit: cover;
             filter: grayscale(100%);
             transition: filter 0.3s ease;
         }

         .couple-card:hover img {
             filter: grayscale(0%);
         }

         /* Story Section */
         #story {
             background: var(--accent-gray);
         }

         .story-timeline {
             max-width: 800px;
             margin: 0 auto;
             position: relative;
         }

         .story-timeline::before {
             content: '';
             position: absolute;
             left: 50%;
             top: 0;
             bottom: 0;
             width: 2px;
             background: var(--gold);
             transform: translateX(-50%);
         }

         .story-item {
             margin-bottom: 3rem;
             position: relative;
             animation: storyFloat 6s ease-in-out infinite;
         }

         .story-item:nth-child(even) {
             animation-delay: 3s;
         }

         .story-content {
             background: var(--secondary-dark);
             padding: 2rem;
             border-radius: 10px;
             width: calc(50% - 2rem);
             border: 1px solid var(--accent-gray);
             box-shadow: 0 10px 30px rgba(0,0,0,0.5);
         }

         .story-item:nth-child(even) .story-content {
             margin-left: auto;
         }

         .story-item::before {
             content: '';
             position: absolute;
             top: 2rem;
             width: 20px;
             height: 20px;
             background: var(--gold);
             border-radius: 50%;
             left: 50%;
             transform: translateX(-50%);
             border: 4px solid var(--secondary-dark);
         }

         @keyframes storyFloat {
             0%, 100% { transform: translateY(0px); }
             50% { transform: translateY(-10px); }
         }

         /* Event Section */
         #event {
             background: var(--primary-dark);
         }

         .event-grid {
             display: grid;
             grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
             gap: 2rem;
             max-width: 1000px;
             margin: 0 auto;
         }

         .event-card {
             background: var(--secondary-dark);
             border: 1px solid var(--accent-gray);
             padding: 2.5rem;
             text-align: center;
             transform: translateY(0);
             transition: all 0.3s ease;
             border-radius: 10px;
             box-shadow: 0 15px 30px rgba(0,0,0,0.6);
         }

         .event-card:hover {
             transform: translateY(-10px);
             box-shadow: 0 25px 50px rgba(0,0,0,0.8);
         }

         .event-card h3 {
             color: var(--gold);
             font-size: 1.8rem;
             margin-bottom: 1.5rem;
         }
         
         .event-buttons {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .event-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 1px solid var(--gold);
            gap: 0.5rem;
            cursor: pointer;
        }

        .event-btn.map-btn {
            background-color: transparent;
            color: var(--gold);
        }

        .event-btn.map-btn:hover {
            background-color: var(--gold);
            color: var(--primary-dark);
        }

        .event-btn.live-btn {
            background-color: var(--gold);
            color: var(--primary-dark);
        }

        .event-btn.live-btn:hover {
            background-color: transparent;
            color: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(201, 169, 97, 0.3);
        }

        .event-btn svg {
            width: 20px;
            height: 20px;
        }

         /* Gallery Section */
         #gallery {
             background: var(--secondary-dark);
             padding: 5rem 0;
         }

         .gallery-grid {
             display: grid;
             grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
             gap: 1.5rem;
             max-width: 1000px;
             margin: 0 auto;
         }

         .gallery-item {
             background: var(--accent-gray);
             aspect-ratio: 1;
             border: 2px solid var(--light-gray);
             display: flex;
             align-items: center;
             justify-content: center;
             position: relative;
             overflow: hidden;
             transition: all 0.3s ease;
             transform: scale(1);
         }
         
         .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
         }

         .gallery-item:hover {
             transform: scale(1.05);
             border-color: var(--gold);
         }
         
         .gallery-item:hover img {
            transform: scale(1.1);
         }

         /* RSVP Section */
         #rsvp {
             background: var(--accent-gray);
             padding: 5rem 0;
         }

         .rsvp-container {
            max-width: 700px;
            margin: 0 auto;
         }

         .rsvp-form {
             background: var(--secondary-dark);
             padding: 3rem;
             border-radius: 15px;
             border: 1px solid var(--light-gray);
             box-shadow: 0 20px 40px rgba(0,0,0,0.7);
             margin-bottom: 4rem; /* Space between form and guestbook */
         }

         .form-group {
             margin-bottom: 2rem;
         }

         .form-group label {
             display: block;
             color: var(--gold);
             margin-bottom: 0.5rem;
             font-size: 1.1rem;
             letter-spacing: 0.05rem;
         }

         .form-group input,
         .form-group select,
         .form-group textarea {
             width: 100%;
             padding: 1rem;
             background: var(--primary-dark);
             border: 1px solid var(--accent-gray);
             border-radius: 5px;
             color: var(--white);
             font-size: 1rem;
             transition: all 0.3s ease;
         }

         .form-group input:focus,
         .form-group select:focus,
         .form-group textarea:focus {
             outline: none;
             border-color: var(--gold);
             box-shadow: 0 0 10px rgba(201, 169, 97, 0.3);
         }

         .submit-btn {
             background: linear-gradient(135deg, var(--gold), #b8984a);
             color: var(--primary-dark);
             padding: 1rem 2rem;
             border: none;
             border-radius: 30px;
             font-size: 1.1rem;
             font-weight: bold;
             cursor: pointer;
             transition: all 0.3s ease;
             width: 100%;
             letter-spacing: 0.1rem;
         }

         .submit-btn:hover {
             transform: translateY(-2px);
             box-shadow: 0 10px 20px rgba(201, 169, 97, 0.4);
         }
        
         /* --- NEW GUESTBOOK STYLES --- */
        .guestbook-display {
            background-color: var(--secondary-dark);
            border-radius: 15px;
            padding: 2rem;
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid var(--accent-gray);
        }

        .guestbook-entry {
            background: var(--primary-dark);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--gold);
        }
        
        .guestbook-entry:last-child {
            margin-bottom: 0;
        }

        .guestbook-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .guestbook-name {
            font-weight: bold;
            color: var(--white);
            font-size: 1.1rem;
        }

        .guestbook-status {
            font-size: 0.8rem;
            font-weight: bold;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            color: var(--primary-dark);
        }

        .guestbook-status.attending {
            background-color: #a7f3d0; /* Green */
            color: #064e3b;
        }

        .guestbook-status.not-attending {
            background-color: #fecaca; /* Red */
            color: #7f1d1d;
        }

        .guestbook-message {
            color: var(--light-gray);
            font-style: italic;
            margin-bottom: 1rem;
        }

        .guestbook-time {
            font-size: 0.8rem;
            color: var(--light-gray);
            text-align: right;
        }

         /* --- END OF NEW STYLES --- */

         /* Footer */
         footer {
             background: var(--primary-dark);
             text-align: center;
             padding: 3rem 0;
             border-top: 1px solid var(--accent-gray);
         }

         footer p {
             color: var(--light-gray);
             margin-bottom: 0.5rem;
         }

        @media (min-width: 768px) {
             header#home {
                 background-image: var(--bg-desktop);
             }
         }
         
         /* Responsive Design */
         @media (max-width: 768px) {
             .container {
                 padding: 0 1rem;
             }

             header h1 {
                 font-size: 2.5rem;
             }

             .couple-container {
                 grid-template-columns: 1fr;
                 gap: 2rem;
             }

             .couple-card {
                 transform: none;
             }

             .story-timeline::before {
                 left: 2rem;
             }

             .story-content {
                 width: calc(100% - 4rem);
                 margin-left: 4rem;
             }

             .story-item:nth-child(even) .story-content {
                 margin-left: 4rem;
             }

             .story-item::before {
                 left: 2rem;
                 transform: translateX(-50%);
             }
         }
    </style>
</head>
<body>
    <div class="curtain" id="curtain">
        <div class="curtain-content">
            <h1>Wedding Invitation</h1>
            <p>You are cordially invited</p>
        </div>
    </div>

    <header id="home">
        <div class="container">
            <h1>{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
            @if($invitation->events->first())
                <p>{{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('dddd, D MMMM YYYY') }}</p>
            @endif
            <p class="guest-name">Dear {{ $guestName }}</p>
        </div>
    </header>

    <section id="quote" class="museum-frame fade-in">
        <div class="container">
            <blockquote>{{ $invitation->quote }}</blockquote>
            <p>- {{ $invitation->quote_source }}</p>
        </div>
    </section>

    <section id="couple" class="museum-frame fade-in">
        <div class="container">
            <h2>The Couple</h2>
            <div class="couple-container">
                <div class="couple-card">
                    <h3>{{ $invitation->groom_name }}</h3>
                    <img src="{{ asset('storage/' . ($invitation->groom_photo_path ?? 'images/defaults/default-groom.webp')) }}" alt="Foto {{ $invitation->groom_name }}"/>
                    <p>{{ $invitation->groom_info }}</p>
                </div>
                <div class="couple-card">
                    <h3>{{ $invitation->bride_name }}</h3>
                    <img src="{{ asset('storage/' . ($invitation->bride_photo_path ?? 'images/defaults/default-bride.webp')) }}" alt="Foto {{ $invitation->bride_name }}"/>
                    <p>{{ $invitation->bride_info }}</p>
                </div>
            </div>
        </div>
    </section>

    @if(optional($invitation->package)->has_love_story && $invitation->stories->isNotEmpty())
    <section id="story" class="museum-frame fade-in">
        <div class="container">
            <h2>Our Love Story</h2>
            <div class="story-timeline">
                @foreach($invitation->stories as $story)
                <div class="story-item">
                    <div class="story-content">
                        <h3>{{ $story->title }}</h3>
                        <p><small>{{ $story->story_date }}</small></p>
                        <p>{{ $story->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section id="event" class="museum-frame fade-in">
        <div class="container">
            <h2>Event Details</h2>
            <div class="event-grid">
                @forelse($invitation->events as $event)
                <div class="event-card">
                    <h3>{{ $event->title }}</h3>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM YYYY') }}</p>
                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</p>
                    <p><strong>Venue:</strong> {{ $event->venue_name }}</p>
                    <p><strong>Address:</strong> {{ $event->venue_address }}</p>
                    
                    <div class="event-buttons">
                        @if(isset($event->google_maps_link) && $event->google_maps_link)
                            <a href="{{ $event->google_maps_link }}" target="_blank" rel="noopener noreferrer" class="event-btn map-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>View Map</span>
                            </a>
                        @endif
                        @if(isset($event->livestream_link) && $event->livestream_link)
                            <a href="{{ $event->livestream_link }}" target="_blank" rel="noopener noreferrer" class="event-btn live-btn">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2A29 29 0 0 0 23 11.75a29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                                <span>Watch Live</span>
                            </a>
                        @endif
                    </div>
                </div>
                @empty
                <p>Event details will be announced soon.</p>
                @endforelse
            </div>
        </div>
    </section>

    @if($invitation->galleries->isNotEmpty())
    <section id="gallery" class="museum-frame fade-in">
        <div class="container">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                @foreach($invitation->galleries as $item)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' .  $item->image_path ?? 'https://placehold.co/400x400/1a1a1a/c9a961?text=Moment') }}" alt="Gallery Image">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @else
    <section id="gallery" class="hidden museum-frame fade-in">
        <div class="container">
            <h2>Gallery</h2>
            <div id="gallery-container" class="gallery-grid">
                </div>
        </div>
    </section>
    @endif

    @if(($invitation->package)->has_rsvp)
    <section id="rsvp" class="museum-frame fade-in">
        <div class="container">
            <div class="rsvp-container">
                <h2>RSVP</h2>
                <form  id="rsvp-form" 
                        action="{{ $formAction }}" 
                        method="POST"class="rsvp-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="attendance">Attendance Status</label>
                        <select id="attendance" name="attendance_status" required>
                            <option value="">Please Select</option>
                            <option value="Hadir">Will Attend</option>
                            <option value="Tidak Hadir">Cannot Attend</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" maxlength="500" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send RSVP</button>
                </form>

                <h3 class="section-subtitle">Wishes & Greetings</h3>
                <div class="guestbook-display">
                    <div id="guestbook-container">
                        </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <footer>
        <div class="container">
            <p>Thank you for your prayers and presence</p>
            <p>© {{ date('Y') }} {{ $invitation->groom_name }} & {{ $invitation->bride_name }}</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Dummy Data for Frontend Preview ---
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
                { title: 'Akad Nikah', event_date: oneMonthFromNow, start_time: '09:00', venue_name: 'Masjid Agung Al-Azhar', venue_address: 'Jl. Sisingamangaraja, Selong, Kebayoran Baru, Jakarta Selatan', google_maps_link: 'https://maps.app.goo.gl/9vJqFkCtL5qZ4x7p8', livestream_link: 'http://googleusercontent.com/youtube.com/0' },
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
            guestbooks : [
                { name: 'Budi Santoso', attendance_status: 'Hadir', message: 'Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin.', created_at: new Date(Date.now() - 2 * 60 * 60 * 1000) },
                { name: 'Citra Lestari', attendance_status: 'Hadir', message: 'Happy wedding! Semoga cinta kalian abadi selamanya. Turut berbahagia.', created_at: new Date(Date.now() - 5 * 60 * 60 * 1000) },
                { name: 'Rian Pratama', attendance_status: 'Tidak Hadir', message: 'Mohon maaf tidak bisa hadir, semoga acaranya lancar. Selamat berbahagia Aditya & Kirana!', created_at: new Date(Date.now() - 24 * 60 * 60 * 1000) },
            ],
            package: { has_love_story: true, has_rsvp: true, has_live_streaming: true },
        };

        const invitationData = @json($invitation) || dummyData;
        
        // --- Curtain Animation ---
        setTimeout(() => {
            document.getElementById('curtain').classList.add('open');
        }, 3000);

        // --- Fallback Gallery Logic ---
        if (!invitationData.galleries || invitationData.galleries.length === 0) {
            const gallerySection = document.getElementById('gallery');
            const galleryContainer = document.getElementById('gallery-container');
            
            if (gallerySection && galleryContainer) {
                gallerySection.classList.remove('hidden');
                galleryContainer.innerHTML = dummyData.galleries.map(item => `
                    <div class="gallery-item">
                        <img src="${item.image_path}" alt="${item.alt || 'Gallery Image'}">
                    </div>
                `).join('');
            }
        }
        
        // --- Guestbook Logic ---
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

        const renderGuestbook = () => {
            const guestbookContainer = document.getElementById('guestbook-container');
            if (!guestbookContainer) return;
            
            const guestbookData = invitationData.guestbooks || [];

            if (guestbookData.length === 0) {
                guestbookContainer.innerHTML = `<p style="text-align:center; color: var(--light-gray);">Be the first to leave a message!</p>`;
                return;
            }

            guestbookContainer.innerHTML = guestbookData.map(entry => {
                const statusClass = entry.attendance_status === 'Hadir' ? 'attending' : 'not-attending';
                return `
                    <div class="guestbook-entry">
                        <div class="guestbook-header">
                            <p class="guestbook-name">${entry.name}</p>
                            <span class="guestbook-status ${statusClass}">
                                ${entry.attendance_status}
                            </span>
                        </div>
                        <p class="guestbook-message">"${entry.message}"</p>
                        <p class="guestbook-time">${timeSince(entry.created_at)}</p>
                    </div>
                `;
            }).join('');
        };
        
        if (invitationData.package.has_rsvp) {
            renderGuestbook();
        }
        
        // --- Scroll Animations ---
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in, .museum-frame').forEach(el => {
            observer.observe(el);
        });

        // --- RSVP Form Handling ---
        const rsvpForm = document.getElementById('rsvp-form');
        if (rsvpForm) {
            rsvpForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const name = formData.get('name');
                const attendance = formData.get('attendance_status');
                const message = formData.get('message');
                
                if (!name || !attendance || !message) {
                    alert('Please fill in all fields');
                    return;
                }
                
                const submitBtn = this.querySelector('.submit-btn');
                const originalText = submitBtn.textContent;
                
                submitBtn.textContent = 'Sending...';
                submitBtn.disabled = true;
                
                // Simulate form submission
                setTimeout(() => {
                    alert('Thank you for your RSVP! Your response has been recorded.');
                    
                    // Add the new entry to the dummy data and re-render
                    const newEntry = {
                        name: name,
                        attendance_status: attendance,
                        message: message,
                        created_at: new Date()
                    };
                    invitationData.guestbooks.unshift(newEntry); // Add to the beginning
                    renderGuestbook();

                    this.reset();
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            });
        }

        // --- Typing effect for the main title ---
        function typeWriter(element, text, speed = 150) {
            let i = 0;
            element.textContent = '';
            
            function type() {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing effect after the curtain opens
        setTimeout(() => {
            const title = document.querySelector('header h1');
            if (title) {
                const originalText = title.textContent;
                typeWriter(title, originalText);
            }
        }, 4000); 
    });
    </script>
</body>
</html>
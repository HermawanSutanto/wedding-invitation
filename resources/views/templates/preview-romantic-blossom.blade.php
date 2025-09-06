

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Asumsi variabel $invitation selalu ada. Jika tidak, tambahkan pengecekan --}}
    <title>Wedding Invitation | {{ $invitation->groom_name ?? '' }} & {{ $invitation->bride_name ?? '' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --bg-color: #fefefe;      /* Soft White for purity */
            --text-color: #4a3c3c;    /* Deep Rose Brown */
            --primary-color: #e8a5a5; /* Soft Cherry Blossom Pink */
            --gold-color: #d4a5a5;    /* Romantic Rose */
            --accent-color: #f4c2c2;  /* Light Blossom Pink */
            --bg-color-alt: #fdf7f7;  /* Very Light Pink */
            --secondary-accent: #f9e6e6; /* Pale Rose */
            --tertiary-accent: #e8f5e8; /* Light Mint for leaves */
            --shadow-light: rgba(228, 165, 165, 0.1);
            --shadow-medium: rgba(228, 165, 165, 0.15);
            --shadow-dark: rgba(74, 60, 60, 0.2);

            /* Enhanced Gradient Colors for Romantic Blossom */
            --gradient-primary: linear-gradient(135deg, #e8a5a5 0%, #d4a5a5 50%, #f4c2c2 100%);
            --gradient-secondary: linear-gradient(135deg, #f4c2c2 0%, #f9e6e6 50%, #e8f5e8 100%);
            --gradient-accent: linear-gradient(135deg, #fdf7f7 0%, #fefefe 50%, #f9e6e6 100%);
            --gradient-gold: linear-gradient(135deg, #d4a5a5 0%, #f4c2c2 50%, #f9e6e6 100%);
            --gradient-sage: linear-gradient(135deg, #e8a5a5 0%, #e8f5e8 50%, #f9e6e6 100%);
            --gradient-rose: linear-gradient(135deg, #f4c2c2 0%, #d4a5a5 50%, #e8a5a5 100%);
            --gradient-mint: linear-gradient(135deg, #e8f5e8 0%, #e8a5a5 50%, #d4a5a5 100%);

            /* Enhanced Typography */
            --font-heading: "Great Vibes", "Dancing Script", cursive;
            --font-body: "Poppins", "Segoe UI", "Helvetica Neue", Arial, sans-serif;
            --font-secondary: "Dancing Script", "Great Vibes", cursive;
            --font-mono: "JetBrains Mono", "Fira Code", "Monaco", monospace;

            /* Text Shadow Effects */
            --text-shadow-light: 0 2px 4px rgba(228, 165, 165, 0.3);
            --text-shadow-medium: 0 4px 8px rgba(228, 165, 165, 0.4);
            --text-shadow-dark: 0 6px 12px rgba(74, 60, 60, 0.3);
            --text-shadow-glow: 0 0 20px rgba(228, 165, 165, 0.5);

            /* Additional Color Variations for Blossom Theme */
            --primary-light: #f0c5c5;
            --primary-dark: #d48a8a;
            --gold-light: #e0b5b5;
            --gold-dark: #c89595;
            --accent-light: #fadada;
            --accent-dark: #e0a5a5;
            --text-light: #6b5b5b;
            --text-dark: #2d2525;

            /* Sakura Theme Colors */
            --sakura-pink: #ffb7c5;
            --sakura-light: #ffe4e8;
            --sakura-dark: #e8a5a5;
            --sakura-gradient: linear-gradient(135deg, #ffb7c5 0%, #e8a5a5 50%, #ffe4e8 100%);
            --sakura-shadow: rgba(255, 183, 197, 0.3);

            /* Additional Decorative Colors */
            --butterfly-gold: #f4d03f;
            --butterfly-pink: #ff69b4;
            --vine-green: #a8d5ba;
            --leaf-shadow: rgba(168, 213, 186, 0.2);
            --heart-rose: #ff1493;
            --sparkle-silver: #c0c0c0;
            --ornament-bronze: #cd853f;
            --lace-cream: #fff8dc;
            --petal-coral: #ff7f50;
            --dew-drop: rgba(255, 255, 255, 0.8);
        }

        /* --- Base & Typography --- */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            color: var(--text-color);
            background-color: var(--bg-color-alt);
            margin: 0;
            overflow: hidden; /* Hide scroll until invitation is opened */
        }

        .font-heading {
            font-family: var(--font-heading);
            color: var(--primary-color);
        }
        
        /* --- Enhanced Animations --- */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes pulse-glow {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 15px 0px var(--shadow-light);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 25px 8px var(--shadow-medium);
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes glow-pulse {
            0%, 100% {
                text-shadow: 0 0 5px rgba(212, 175, 185, 0.5);
            }
            50% {
                text-shadow: 0 0 20px rgba(212, 175, 185, 0.8), 0 0 30px rgba(230, 180, 180, 0.6);
            }
        }

        @keyframes particle-float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        @keyframes text-shimmer {
            0% {
                background-position: -200% center;
            }
            100% {
                background-position: 200% center;
            }
        }

        @keyframes border-glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(212, 175, 185, 0.3);
            }
            50% {
                box-shadow: 0 0 20px rgba(212, 175, 185, 0.6), 0 0 30px rgba(230, 180, 180, 0.4);
            }
        }

        @keyframes elegant-fade-in {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
                filter: blur(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        @keyframes fall {
            0% {
                transform: translateY(-10vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(105vh) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes petal-fall {
            0% {
                transform: translateY(-5vh) translateX(0) rotate(0deg);
                opacity: 0.9;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) translateX(20px) rotate(720deg);
                opacity: 0;
            }
        }

        /* Enhanced Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(4rem) scale(0.95);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .animate-fade-in {
            animation: fadeInScale 0.8s ease-out forwards;
        }

        .animate-slide-up {
            animation: slideInUp 0.8s ease-out forwards;
        }

        .animate-slide-down {
            animation: slideInDown 0.8s ease-out forwards;
        }

        .animate-slide-left {
            animation: slideInLeft 0.8s ease-out forwards;
        }

        .animate-slide-right {
            animation: slideInRight 0.8s ease-out forwards;
        }

        .animate-bounce-in {
            animation: bounceIn 0.8s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200px 100%;
            animation: shimmer 2s infinite;
        }

        /* --- Blossom Animation --- */
        #blossom-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
            overflow: hidden;
        }
        .blossom {
            position: absolute;
            width: 15px;
            height: 15px;
            background-color: var(--accent-color);
            border-radius: 50% 0;
            opacity: 0.8;
            animation: fall linear forwards;
        }
        .blossom::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: var(--gold-color);
            border-radius: 50% 0;
            transform: rotate(90deg);
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
            transition: opacity 1.5s ease-out, visibility 1.5s;
        }
        #cover.hidden {
            opacity: 0;
            visibility: hidden;
        }
        #cover::before {
            content: '';
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.65);
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
            border-top: 2px solid rgba(212, 175, 185, 0.5);
            border-bottom: 2px solid rgba(212, 175, 185, 0.5);
        }
        #open-invitation {
            margin-top: 2rem;
            padding: 0.75rem 2rem;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 9999px;
            font-size: 1.125rem; /* lg */
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            animation: pulse-glow 2.5s infinite;
        }
        #open-invitation:hover {
            animation-play-state: paused;
            background-color: #d19a9a;
            transform: scale(1.05);
        }

        /* --- Main Content --- */
        main {
            display: none;
        }

        /* --- Enhanced Section Styling --- */
        section {
            position: relative;
            padding: 6rem 1.5rem;
            text-align: center;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold-color), transparent);
            opacity: 0.6;
        }

        section .container {
             max-width: 85rem; /* 7xl */
             margin-left: auto;
             margin-right: auto;
             position: relative;
             z-index: 2;
        }

        /* Glassmorphism Effects */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            box-shadow:
                0 8px 32px rgba(31, 38, 135, 0.37),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .glass-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0.05) 50%,
                rgba(255, 255, 255, 0.1) 100%);
            border-radius: inherit;
            backdrop-filter: blur(10px);
        }

        /* Floating Particles */
        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--gold-color);
            border-radius: 50%;
            animation: particle-float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        .particle:nth-child(2n) {
            background: var(--accent-color);
            animation-duration: 8s;
            animation-delay: 1s;
        }

        .particle:nth-child(3n) {
            background: var(--primary-color);
            animation-duration: 10s;
            animation-delay: 2s;
        }

        /* Enhanced Button Styles */
        .btn-glow {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--gold-color), var(--accent-color));
            color: white;
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow:
                0 4px 15px rgba(212, 175, 185, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 25px rgba(212, 175, 185, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            animation: border-glow 2s infinite;
        }

        /* Text Effects */
        .text-glow {
            animation: glow-pulse 3s ease-in-out infinite;
        }

        .text-shimmer {
            background: linear-gradient(90deg,
                var(--text-color) 0%,
                var(--gold-color) 50%,
                var(--text-color) 100%);
            background-size: 200% 100%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: text-shimmer 3s ease-in-out infinite;
        }

        /* Corner Decorations */
        .corner-decoration {
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid var(--gold-color);
            opacity: 0.6;
        }

        .corner-decoration.top-left {
            top: 10px;
            left: 10px;
            border-right: none;
            border-bottom: none;
            border-top-left-radius: 10px;
        }

        .corner-decoration.top-right {
            top: 10px;
            right: 10px;
            border-left: none;
            border-bottom: none;
            border-top-right-radius: 10px;
        }

        .corner-decoration.bottom-left {
            bottom: 10px;
            left: 10px;
            border-right: none;
            border-top: none;
            border-bottom-left-radius: 10px;
        }

        .corner-decoration.bottom-right {
            bottom: 10px;
            right: 10px;
            border-left: none;
            border-top: none;
            border-bottom-right-radius: 10px;
        }

        /* Ornate Borders */
        .ornate-border {
            position: relative;
            border: 3px solid transparent;
            background: linear-gradient(var(--bg-color), var(--bg-color)) padding-box,
                        linear-gradient(135deg, var(--gold-color), var(--accent-color), var(--primary-color)) border-box;
            border-radius: 1rem;
        }

        .ornate-border::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(135deg, var(--gold-color), var(--accent-color), var(--primary-color));
            border-radius: 1.2rem;
            z-index: -1;
            opacity: 0.3;
            filter: blur(2px);
        }

        .section-title {
            font-size: 3.75rem; /* 6xl */
            margin-bottom: 4rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        /* Enhanced spacing utilities */
        .section-spacing {
            margin-bottom: 8rem;
        }

        .section-spacing:last-child {
            margin-bottom: 4rem;
        }

        /* --- Decorative Elements --- */
        /* Floral Background Pattern */
        .floral-pattern {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(212, 175, 185, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(162, 178, 159, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(230, 180, 180, 0.05) 0%, transparent 50%);
            background-size: 200px 200px, 150px 150px, 100px 100px;
            background-position: 0 0, 100px 100px, 50px 50px;
            background-repeat: repeat;
        }

        /* Elegant Borders and Shadows */
        .elegant-shadow {
            box-shadow:
                0 10px 25px -5px rgba(93, 84, 81, 0.1),
                0 10px 10px -5px rgba(93, 84, 81, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .decorative-border {
            position: relative;
            border: 2px solid transparent;
            background: linear-gradient(var(--bg-color), var(--bg-color)) padding-box,
                        linear-gradient(135deg, var(--gold-color), var(--accent-color)) border-box;
            border-radius: 0.75rem;
        }

        .decorative-border::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            background: linear-gradient(135deg, var(--gold-color), var(--accent-color));
            border-radius: 0.875rem;
            z-index: -1;
            opacity: 0.3;
        }

        /* Enhanced Timeline Design */
        .timeline-line {
            position: absolute;
            width: 4px;
            background: linear-gradient(to bottom, var(--gold-color), var(--accent-color), var(--primary-color));
            top: 0;
            bottom: 0;
            left: 1.25rem;
            border-radius: 2px;
        }

        .timeline-icon {
            position: absolute;
            left: 1.25rem;
            top: 0;
            transform: translateX(-50%);
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid var(--bg-color-alt);
            z-index: 1;
            box-shadow: 0 4px 12px rgba(212, 175, 185, 0.3);
        }

        .timeline-content {
            background: linear-gradient(135deg, var(--bg-color-alt) 0%, rgba(255, 255, 255, 0.9) 100%);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow:
                0 10px 25px -5px rgba(93, 84, 81, 0.1),
                0 4px 6px -2px rgba(93, 84, 81, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            text-align: left;
            position: relative;
            border-left: 5px solid var(--gold-color);
            backdrop-filter: blur(10px);
        }

        .timeline-content::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 2rem;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid var(--bg-color-alt);
        }

        /* Enhanced Card Designs */
        .event-card, .gift-card, .guestbook-entry {
            background: linear-gradient(135deg, var(--bg-color) 0%, rgba(255, 255, 255, 0.9) 100%);
            border-radius: 1rem;
            box-shadow:
                0 10px 25px -5px rgba(93, 84, 81, 0.1),
                0 4px 6px -2px rgba(93, 84, 81, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(212, 175, 185, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .event-card::before, .gift-card::before, .guestbook-entry::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold-color), var(--accent-color), var(--primary-color));
        }

        .event-card:hover, .gift-card:hover, .guestbook-entry:hover {
            transform: translateY(-5px);
            box-shadow:
                0 20px 40px -10px rgba(93, 84, 81, 0.15),
                0 10px 20px -5px rgba(93, 84, 81, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        /* Gallery Item Enhancements */
        .gallery-item {
            overflow: hidden;
            border-radius: 1rem;
            box-shadow:
                0 10px 25px -5px rgba(93, 84, 81, 0.1),
                0 4px 6px -2px rgba(93, 84, 81, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212, 175, 185, 0.1), rgba(162, 178, 159, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .gallery-item:hover::before {
            opacity: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
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
            /* Parallax is handled by JS, not fixed attachment */
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
        
        /* General button hover lift effect */
        .map-button, .copy-button, #rsvp-form button {
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
        }
        .map-button:hover, .copy-button:hover, #rsvp-form button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
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
            border: 8px solid rgba(212, 175, 185, 0.4);
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
            color: var(--gold-color);
        }

        /* --- Love Story (Timeline) --- */
           /* Soft Ivory */

        
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
            border: 4px solid var(--bg-color-alt);
            z-index: 1;
        }
        .timeline-content {
            background-color: var(--bg-color-alt);
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            text-align: left;
            position: relative;
            border-left: 4px solid var(--gold-color);
        }
        .timeline-content h3 {
            font-size: 1.5rem; /* 2xl */
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        /* --- Event Details & Countdown --- */
        #event {
            background-color: var(--bg-color-alt);
        }
        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin: 2rem 0;
        }
        .time-box {
            background: var(--bg-color);
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
            color: var(--accent-color);
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
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.05), 0 4px 6px -4px rgb(0 0 0 / 0.05);
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
        }
        .map-button:hover {
            background-color: var(--accent-color);
        }

        /* --- Gallery --- */
        #gallery {
            background-color: var(--bg-color-alt);
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
             background-color: var(--bg-color-alt);
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
            color: var(--accent-color);
            margin-bottom: 0.5rem;
        }
        .copy-button {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 9999px;
            color: white;
            cursor: pointer;
            width: 12rem;
            background-color: var(--primary-color);
        }
        .copy-button:hover {
             background-color: #8a9a87;
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
            background: var(--accent-color);
            color: white;
            font-size: 1.125rem; /* lg */
            border-radius: 9999px;
            cursor: pointer;
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
            background: var(--bg-color-alt);
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
        .guestbook-entry.newly-added {
            animation: slideInDown 0.5s ease-out;
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
            background-color: #e9f0e7;
            color: #5a7d5a;
        }
        .status.tidak-hadir {
            background-color: #f8e6e6;
            color: #991b1b;
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
            background-color: var(--accent-color);
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
        @media (max-width: 480px) { /* Mobile Small */
            .cover-content h1 { font-size: 2.5rem; }
            .hero-content h1 { font-size: 3rem; }
            .section-title { font-size: 2.5rem; margin-bottom: 3rem; }
            .couple-info img { width: 10rem; height: 10rem; }
            .couple-info h3 { font-size: 2rem; }
            .couple-separator { font-size: 3rem; margin: 1rem 0; }
            .time-box { width: 5rem; padding: 0.75rem; }
            .time-box .time-value { font-size: 1.75rem; }
            .event-card, .gift-card, .guestbook-entry { padding: 1.5rem; }
            .gallery-item { border-radius: 0.75rem; }
            #gallery-grid { grid-template-columns: repeat(1, 1fr); gap: 0.75rem; }
            .timeline-content { padding: 1.5rem; }
            .timeline-icon { width: 2.5rem; height: 2.5rem; }
            .timeline-line { width: 3px; }
            .timeline-item { padding-left: 2.5rem; }
            .section-spacing { margin-bottom: 6rem; }
            .section-spacing:last-child { margin-bottom: 3rem; }
            #music-toggle { bottom: 5rem; right: 1rem; width: 2.5rem; height: 2.5rem; }
            #bottom-nav { padding: 0.75rem 0.5rem; }
            #bottom-nav i { font-size: 1rem; }
            #bottom-nav a { font-size: 0.625rem; }
            .copy-button { width: 10rem; padding: 0.5rem 1rem; }
            .map-button { padding: 0.5rem 1rem; font-size: 0.875rem; }
            #rsvp-form button { padding: 0.75rem; font-size: 1rem; }
            .guestbook-entry { padding: 0.75rem; }
            .guestbook-header .name { font-size: 0.875rem; }
            .guestbook-header .status { font-size: 0.625rem; padding: 0.125rem 0.375rem; }
        }

        @media (min-width: 481px) and (max-width: 767px) { /* Mobile Large / Tablet Small */
            .cover-content h1 { font-size: 3.5rem; }
            .hero-content h1 { font-size: 4rem; }
            .section-title { font-size: 3rem; margin-bottom: 3.5rem; }
            .couple-info img { width: 12rem; height: 12rem; }
            .couple-info h3 { font-size: 2.5rem; }
            .couple-separator { font-size: 4rem; margin: 1rem 0; }
            .time-box { width: 6rem; padding: 1rem; }
            .time-box .time-value { font-size: 2rem; }
            .event-card, .gift-card, .guestbook-entry { padding: 1.75rem; }
            .gallery-item { border-radius: 1rem; }
            #gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
            .timeline-content { padding: 1.75rem; }
            .timeline-icon { width: 2.75rem; height: 2.75rem; }
            .timeline-line { width: 3px; }
            .timeline-item { padding-left: 2.75rem; }
            .section-spacing { margin-bottom: 7rem; }
            .section-spacing:last-child { margin-bottom: 4rem; }
            #music-toggle { bottom: 5.5rem; right: 1.25rem; width: 2.75rem; height: 2.75rem; }
            #bottom-nav { padding: 0.75rem; }
            #bottom-nav i { font-size: 1.125rem; }
            #bottom-nav a { font-size: 0.6875rem; }
            .copy-button { width: 11rem; padding: 0.5rem 1.25rem; }
            .map-button { padding: 0.5rem 1.25rem; font-size: 0.9375rem; }
            #rsvp-form button { padding: 0.875rem; font-size: 1.0625rem; }
            .guestbook-entry { padding: 0.875rem; }
            .guestbook-header .name { font-size: 0.9375rem; }
            .guestbook-header .status { font-size: 0.6875rem; padding: 0.1875rem 0.4375rem; }
        }

        @media (min-width: 768px) and (max-width: 1023px) { /* Tablet */
            .cover-content h1 { font-size: 4.5rem; }
            .hero-content h1 { font-size: 5rem; }
            .section-title { font-size: 3.75rem; margin-bottom: 4rem; }
            #couple-container { flex-direction: row; gap: 1.5rem; }
            .couple-info img { width: 13rem; height: 13rem; }
            .couple-info h3 { font-size: 3rem; }
            .couple-separator { margin: 0 1.5rem; font-size: 5rem; }
            .time-box { width: 7rem; padding: 1.25rem; }
            .time-box .time-value { font-size: 2.25rem; }
            .event-card, .gift-card, .guestbook-entry { padding: 2rem; }
            .gallery-item { border-radius: 1rem; }
            #gallery-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
            .timeline-content { padding: 2rem; }
            .timeline-icon { width: 3rem; height: 3rem; }
            .timeline-line { width: 4px; }
            .timeline-item { padding-left: 3rem; }
            .section-spacing { margin-bottom: 8rem; }
            .section-spacing:last-child { margin-bottom: 4rem; }
            #music-toggle { bottom: 2rem; right: 1.5rem; width: 3rem; height: 3rem; }
            #bottom-nav { display: none; }
            .copy-button { width: 12rem; padding: 0.5rem 1.5rem; }
            .map-button { padding: 0.5rem 1.5rem; font-size: 1rem; }
            #rsvp-form button { padding: 0.875rem; font-size: 1.125rem; }
            .guestbook-entry { padding: 1rem; }
            .guestbook-header .name { font-size: 1rem; }
            .guestbook-header .status { font-size: 0.75rem; padding: 0.25rem 0.5rem; }

            /* --- Tablet Timeline --- */
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
                border-left: none;
                border-right: 4px solid var(--gold-color);
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
                border-color: transparent;
            }
            .timeline-item.left .timeline-content::before {
                right: -20px;
                border-left-color: var(--bg-color-alt);
            }
             .timeline-item.right .timeline-content::before {
                left: -20px;
                border-right-color: var(--bg-color-alt);
            }
        }

        @media (min-width: 1024px) and (max-width: 1279px) { /* Desktop Small */
            .cover-content h1 { font-size: 5rem; }
            .hero-content h1 { font-size: 5.5rem; }
            .section-title { font-size: 4rem; margin-bottom: 4rem; }
            #couple-container { flex-direction: row; gap: 2rem; }
            .couple-info img { width: 14rem; height: 14rem; }
            .couple-info h3 { font-size: 3.25rem; }
            .couple-separator { margin: 0 2rem; font-size: 5.5rem; }
            .time-box { width: 7.5rem; padding: 1.25rem; }
            .time-box .time-value { font-size: 2.5rem; }
            .event-card, .gift-card, .guestbook-entry { padding: 2.25rem; }
            .gallery-item { border-radius: 1rem; }
            #gallery-grid { grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
            .timeline-content { padding: 2.25rem; }
            .timeline-icon { width: 3.25rem; height: 3.25rem; }
            .timeline-line { width: 4px; }
            .timeline-item { padding-left: 3.25rem; }
            .section-spacing { margin-bottom: 8rem; }
            .section-spacing:last-child { margin-bottom: 4rem; }
            #music-toggle { bottom: 2rem; right: 1.5rem; width: 3rem; height: 3rem; }
            #bottom-nav { display: none; }
            .copy-button { width: 12rem; padding: 0.5rem 1.5rem; }
            .map-button { padding: 0.5rem 1.5rem; font-size: 1rem; }
            #rsvp-form button { padding: 0.875rem; font-size: 1.125rem; }
            .guestbook-entry { padding: 1rem; }
            .guestbook-header .name { font-size: 1rem; }
            .guestbook-header .status { font-size: 0.75rem; padding: 0.25rem 0.5rem; }

            /* --- Desktop Small Timeline --- */
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
                border-left: none;
                border-right: 4px solid var(--gold-color);
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
                border-color: transparent;
            }
            .timeline-item.left .timeline-content::before {
                right: -20px;
                border-left-color: var(--bg-color-alt);
            }
             .timeline-item.right .timeline-content::before {
                left: -20px;
                border-right-color: var(--bg-color-alt);
            }
        }

        @media (min-width: 1280px) { /* Desktop Large */
            .cover-content h1 { font-size: 5.5rem; }
            .hero-content h1 { font-size: 6rem; }
            .section-title { font-size: 4.5rem; margin-bottom: 4rem; }
            #couple-container { flex-direction: row; gap: 2rem; }
            .couple-info img { width: 15rem; height: 15rem; }
            .couple-info h3 { font-size: 3.75rem; }
            .couple-separator { margin: 0 2rem; font-size: 6rem; }
            .time-box { width: 8rem; padding: 1.5rem; }
            .time-box .time-value { font-size: 2.75rem; }
            .event-card, .gift-card, .guestbook-entry { padding: 2.5rem; }
            .gallery-item { border-radius: 1.25rem; }
            #gallery-grid { grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
            .timeline-content { padding: 2.5rem; }
            .timeline-icon { width: 3.5rem; height: 3.5rem; }
            .timeline-line { width: 4px; }
            .timeline-item { padding-left: 3.5rem; }
            .section-spacing { margin-bottom: 8rem; }
            .section-spacing:last-child { margin-bottom: 4rem; }
            #music-toggle { bottom: 2rem; right: 1.5rem; width: 3rem; height: 3rem; }
            #bottom-nav { display: none; }
            .copy-button { width: 12rem; padding: 0.5rem 1.5rem; }
            .map-button { padding: 0.5rem 1.5rem; font-size: 1rem; }
            #rsvp-form button { padding: 0.875rem; font-size: 1.125rem; }
            .guestbook-entry { padding: 1rem; }
            .guestbook-header .name { font-size: 1rem; }
            .guestbook-header .status { font-size: 0.75rem; padding: 0.25rem 0.5rem; }

            /* --- Desktop Large Timeline --- */
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
                border-left: none;
                border-right: 4px solid var(--gold-color);
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
                border-color: transparent;
            }
            .timeline-item.left .timeline-content::before {
                right: -20px;
                border-left-color: var(--bg-color-alt);
            }
             .timeline-item.right .timeline-content::before {
                left: -20px;
                border-right-color: var(--bg-color-alt);
            }
        }

        /* Touch-friendly enhancements for mobile */
        @media (hover: none) and (pointer: coarse) {
            .map-button, .copy-button, #rsvp-form button, #open-invitation {
                min-height: 44px;
                min-width: 44px;
                padding: 0.75rem 1.5rem;
                font-size: 1.125rem;
            }
            .gallery-item {
                cursor: pointer;
            }
            .gallery-item:hover {
                transform: none;
            }
            .event-card:hover, .gift-card:hover, .guestbook-entry:hover {
                transform: none;
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --bg-color: #ffffff;
                --text-color: #000000;
                --primary-color: #000000;
                --gold-color: #000000;
                --accent-color: #000000;
                --bg-color-alt: #ffffff;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

    </style>
</head>
<body>
    <div id="blossom-container"></div>

    <div id="cover" style="background-image: url('{{ asset('storage/' . $invitation->cover_image) }}')">
        <canvas id="particle-canvas"></canvas>
        <div class="cover-content">
            <p class="text-lg">The Wedding Of</p>
            <h1 class="font-heading">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
            <p class="mt-8 text-sm">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
            <h3 id="guest-name">Tamu Undangan</h3>
            <p class="mt-2 max-w-md text-sm">Tanpa mengurangi rasa hormat, kami mengundang Anda untuk hadir di acara pernikahan kami.</p>
            <button id="open-invitation"><i class="fa-solid fa-envelope-open mr-2"></i> Buka Undangan</button>
        </div>
    </div>
    
    <audio id="background-music" src="{{ asset('audio/music.mp3') }}" loop></audio>
    
    <main id="main-content" style="display: none;">
        <header id="home" style="background-image: url('{{ asset('storage/' . $invitation->hero_image) }}')">
            <div class="hero-content">
                <h4 class="text-xl">You're Invited To The Wedding Of</h4>
                <h1 class="font-heading">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
                @if($invitation->events->first())
                <p class="date">{{ \Carbon\Carbon::parse($invitation->events->first()->event_date)->isoFormat('dddd, D MMMM YYYY') }}</p>
                @endif
            </div>
        </header>

        <section id="quote" class="animate-on-scroll">
            <div class="container">
                <blockquote class="text-lg md:text-xl italic max-w-3xl mx-auto">"{{ $invitation->quote }}"</blockquote>
                <h4 class="font-heading text-4xl mt-4">({{ $invitation->quote_source }})</h4>
            </div>
        </section>

        <section id="couple" class="animate-on-scroll" style="background-color: var(--bg-color);">
            <div class="container">
                <h2 class="font-heading section-title">The Bride & Groom</h2>
                <div id="couple-container">
                    <div class="couple-info animate-on-scroll">
                        <img src="{{ asset('storage/' . $invitation->groom_photo_path) }}" alt="{{ $invitation->groom_name }}">
                        <h3 class="font-heading">{{ $invitation->groom_name }}</h3>
                        <p>{{ $invitation->groom_info }}</p>
                    </div>
                    <div class="couple-separator font-heading">&</div>
                    <div class="couple-info animate-on-scroll" style="transition-delay: 200ms;">
                        <img src="{{ asset('storage/' . $invitation->bride_photo_path) }}" alt="{{ $invitation->bride_name }}">
                        <h3 class="font-heading">{{ $invitation->bride_name }}</h3>
                        <p>{{ $invitation->bride_info }}</p>
                    </div>
                </div>
            </div>
        </section>

        @if($invitation->package->has_love_story)
        <section id="story" class="animate-on-scroll" style="background-color: var(--bg-color-alt);">
            <div class="container">
                <h2 class="font-heading section-title">Our Love Story</h2>
                <div id="timeline-container">
                    <div class="timeline-line"></div>
                    @foreach($invitation->stories as $index => $story)
                        @php
                            $side = $index % 2 === 0 ? 'left' : 'right';
                            $lowerTitle = strtolower($story->title);
                            $iconClass = 'fa-star';
                            if (str_contains($lowerTitle, 'lamaran')) $iconClass = 'fa-ring';
                            if (str_contains($lowerTitle, 'bertemu')) $iconClass = 'fa-comments';
                            if (str_contains($lowerTitle, 'menuju')) $iconClass = 'fa-heart';
                        @endphp
                        <div class="timeline-item {{ $side }} animate-on-scroll" style="transition-delay: {{ $index * 150 }}ms;">
                            <div class="timeline-icon"><i class="fa-solid {{ $iconClass }}"></i></div>
                            <div class="timeline-content">
                                <h3>{{ $story->title }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $story->story_date }}</p>
                                <p>{{ $story->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <section id="event" class="animate-on-scroll" style="background-color: var(--bg-color);">
            <div class="container">
                <h2 class="font-heading section-title">Save The Date</h2>
                @if($invitation->events->first())
                <div class="countdown-timer" id="countdown-timer" data-event-date="{{ $invitation->events->first()->event_date }}T{{ $invitation->events->first()->start_time }}">
                    </div>
                @endif
                <div class="events-container">
                    @foreach($invitation->events as $index => $event)
                    <div class="event-card animate-on-scroll" style="transition-delay: {{ $index * 150 }}ms;">
                        <h3 class="font-heading">{{ $event->title }}</h3>
                        <p><i class="fa-solid fa-calendar-day"></i><span>{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM YYYY') }}</span></p>
                        <p><i class="fa-solid fa-clock"></i><span>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</span></p>
                        <p><i class="fa-solid fa-map-marker-alt"></i><span>{{ $event->venue_name }}</span></p>
                        <a href="{{ $event->google_maps_link }}" target="_blank" class="map-button">
                            <i class="fa-solid fa-map-location-dot mr-2"></i> Lihat Peta
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @if($invitation->package && $invitation->package->has_live_streaming)
            @php
                $hasLivestream = $invitation->events->some(fn($event) => !empty($event->livestream_link));
            @endphp

            @if($hasLivestream)
            <section class="livestream animate-on-scroll" id="livestream">
                <div class="container">

                <h2 class="script-font">Live Streaming</h2>
                <p class="mb-6">Bagi Anda yang tidak dapat hadir, kami mengundang Anda untuk menyaksikan siaran langsung pernikahan kami melalui tautan di bawah ini.</p>
                
                <div class="events-container">
                    @foreach($invitation->events as $event)
                        @if($event->livestream_link)
                            <div class="event-card">
                                <h3>{{ $event->title }}</h3>
                                <p><i class="fa-solid fa-calendar-day"></i> {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM YYYY') }}</p>
                                <p><i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</p>
                                <a href="{{ $event->livestream_link }}" target="_blank" class="map-button mt-4">
                                    <i class="fa-solid fa-video mr-2"></i> Tonton Siaran Langsung
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                </div>

            </section>
            @endif
        @endif
        <section id="gallery" class="animate-on-scroll" style="background-color: var(--bg-color-alt);">
            <div class="container">
                <h2 class="font-heading section-title">Our Moments</h2>
                <div id="gallery-grid">
                    @foreach($invitation->galleries as $index => $photo)
                    <div class="gallery-item animate-on-scroll" style="transition-delay: {{ $index * 100 }}ms;">
                        <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Gallery moment" loading="lazy">
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if($invitation->package->has_rsvp)
        <section id="rsvp" class="animate-on-scroll" style="background-color: var(--bg-color);">
            <div class="container max-w-3xl mx-auto">
                <h2 class="font-heading section-title">Are You Attending?</h2>
                <form id="rsvp-form"     action="{{ $isPreview ? '#' : route('guestbook.store', $invitation) }}" 
                 method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Anda" required />
                    <select name="attendance_status" required>
                        <option value="">Konfirmasi Kehadiran</option>
                        <option value="Hadir">Saya akan Hadir</option>
                        <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                    </select>
                    <textarea name="message" placeholder="Tulis ucapan dan doa Anda..." rows="4" required maxlength="500"></textarea>
                    <div class="character-counter">
                        <span id="char-count">0</span>/500 karakter
                    </div>
                    <button type="submit" id="submit-button">Kirim Ucapan</button>
                </form>

                <div id="guestbook-container">
                    <h2 class="font-heading section-title mt-16">Ucapan & Doa</h2>
                    <div class="guestbook-list" id="guestbook-list">
                        @forelse($invitation->guestbooks->sortByDesc('created_at') as $entry)
                        <div class="guestbook-entry">
                            <div class="guestbook-header">
                                <p class="name">{{ $entry->name }}</p>
                                <span class="status {{ $entry->attendance_status === 'Hadir' ? 'hadir' : 'tidak-hadir' }}">
                                    <i class="fa-solid {{ $entry->attendance_status === 'Hadir' ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>
                                    {{ $entry->attendance_status }}
                                </span>
                            </div>
                            <p>{{ $entry->message }}</p>
                        </div>
                        @empty
                        <p>Jadilah yang pertama memberikan ucapan dan doa.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        @endif
        
        </main>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // --- Elemen Penting ---
        const cover = document.getElementById("cover");
        const openButton = document.getElementById("open-invitation");
        const mainContent = document.getElementById("main-content");
        const audio = document.getElementById("background-music");
        const musicToggleButton = document.getElementById("music-toggle");
        const hero = document.getElementById('home');
        const blossomContainer = document.getElementById('blossom-container');

        // --- Buka Undangan ---
        openButton.addEventListener("click", () => {
            cover.classList.add('hidden'); // Menggunakan class untuk transisi yang lebih halus
            mainContent.style.display = "block";
            document.body.style.overflow = "auto";
            if (audio) {
                audio.play().catch(e => console.error("Autoplay diblokir oleh browser."));
                if (musicToggleButton) musicToggleButton.classList.add("playing");
            }
            // Listener untuk parallax dan bunga baru diaktifkan setelah undangan dibuka
            window.addEventListener('scroll', onScroll, { passive: true });
        });

        // --- Efek Parallax & Bunga Jatuh Saat Scroll ---
        let ticking = false;
        const onScroll = () => {
            let lastScrollY = window.scrollY;
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    if (hero) {
                        hero.style.backgroundPositionY = `${lastScrollY * 0.5}px`;
                    }
                    if (Math.random() > 0.7) { // Buat bunga secara acak agar tidak terlalu ramai
                        createBlossom();
                    }
                    ticking = false;
                });
                ticking = true;
            }
        };
        
        const createBlossom = () => {
            if (!blossomContainer) return;
            const blossom = document.createElement('div');
            blossom.className = 'blossom';
            blossom.style.left = `${Math.random() * 100}vw`;
            blossom.style.animationDuration = `${Math.random() * 5 + 5}s`;
            blossom.style.animationDelay = `${Math.random() * 2}s`;
            blossomContainer.appendChild(blossom);
            setTimeout(() => { blossom.remove(); }, 10000);
        };

        // --- Animasi Saat Scroll (Intersection Observer) ---
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll(".animate-on-scroll").forEach((el) => observer.observe(el));

        // --- Hitung Mundur ---
        const countdownContainer = document.getElementById("countdown-timer");
        if (countdownContainer) {
            // Mengambil tanggal dari atribut `data-event-date` yang di-set oleh Blade
            const eventDateString = countdownContainer.dataset.eventDate;
            if (eventDateString) {
                const countDate = new Date(eventDateString).getTime();
                const countdownInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const gap = countDate - now;

                    if (gap > 0) {
                        const format = (val) => String(val).padStart(2, '0');
                        const days = format(Math.floor(gap / (1000 * 60 * 60 * 24)));
                        const hours = format(Math.floor((gap % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                        const minutes = format(Math.floor((gap % (1000 * 60 * 60)) / (1000 * 60)));
                        const seconds = format(Math.floor((gap % (1000 * 60)) / 1000));
                        
                        countdownContainer.innerHTML = `
                            <div class="time-box"><span class="time-value">${days}</span><span class="time-label">Hari</span></div>
                            <div class="time-box"><span class="time-value">${hours}</span><span class="time-label">Jam</span></div>
                            <div class="time-box"><span class="time-value">${minutes}</span><span class="time-label">Menit</span></div>
                            <div class="time-box"><span class="time-value">${seconds}</span><span class="time-label">Detik</span></div>`;
                    } else {
                        countdownContainer.innerHTML = `<h4 class="font-heading" style="font-size: 1.5rem;">Acara Telah Berlangsung</h4>`;
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }
        }
        
        // --- Character Counter for Message Field ---
        const messageTextarea = document.querySelector('textarea[name="message"]');
        const charCount = document.getElementById('char-count');
        if (messageTextarea && charCount) {
            messageTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCount.textContent = currentLength;
                charCount.style.color = currentLength > 450 ? '#e74c3c' : currentLength > 400 ? '#f39c12' : '#5D5451';
            });
        }

        // --- Formulir RSVP (Guest Book) ---
        const rsvpForm = document.getElementById("rsvp-form");
        if (rsvpForm) {
            rsvpForm.addEventListener("submit", function (event) {
                event.preventDefault();
                const submitButton = document.getElementById('submit-button');
                const formData = new FormData(this);
                const data = Object.fromEntries(formData.entries());

                submitButton.disabled = true;
                submitButton.textContent = 'Mengirim...';

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        const guestbookList = document.getElementById('guestbook-list');
                        const newEntry = document.createElement('div');
                        newEntry.className = 'guestbook-entry newly-added'; // Animasi untuk entri baru
                        const statusClass = result.entry.attendance_status === 'Hadir' ? 'hadir' : 'tidak-hadir';
                        const iconClass = result.entry.attendance_status === 'Hadir' ? 'fa-circle-check' : 'fa-circle-xmark';
                        
                        newEntry.innerHTML = `
                            <div class="guestbook-header">
                                <p class="name">${result.entry.name}</p>
                                <span class="status ${statusClass}">
                                    <i class="fa-solid ${iconClass}"></i> ${result.entry.attendance_status}
                                </span>
                            </div>
                            <p>${result.entry.message}</p>`;
                        
                        guestbookList.prepend(newEntry);
                        this.reset();
                        alert('Terima kasih atas konfirmasi dan ucapannya!');
                    } else {
                        let errors = Object.values(result.errors).join('\n');
                        alert('Gagal mengirim:\n' + errors);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Kirim Ucapan';
                });
            });
        }

        // --- Logika Interaktif Tambahan (Modal Galeri, Salin Rekening, dll.) ---
        const galleryModal = document.getElementById('gallery-modal');
        if (galleryModal) {
            const modalImage = document.getElementById('modal-image');
            document.getElementById('gallery-grid').addEventListener('click', (e) => {
                if (e.target.tagName === 'IMG') {
                    modalImage.src = e.target.src;
                    galleryModal.classList.add('visible');
                }
            });
            document.getElementById('modal-close').addEventListener('click', () => galleryModal.classList.remove('visible'));
            galleryModal.addEventListener('click', (e) => {
                if (e.target.id === 'gallery-modal') galleryModal.classList.remove('visible');
            });
        }

        document.querySelectorAll(".copy-button").forEach(button => {
            button.addEventListener("click", () => {
                navigator.clipboard.writeText(button.dataset.account).then(() => {
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
                    setTimeout(() => { button.innerHTML = originalText; }, 2000);
                });
            });
        });
    });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'PayToWin - Platform Top Up Game Online Terpercaya')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts - Modern Selection -->
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
        <!-- AOS Animation Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <style>
            :root {
                /* === MODERN DARK PALETTE === */
                --bg-primary: #0a0a0f;
                --bg-secondary: #12121a;
                --bg-tertiary: #1a1a25;
                --bg-card: rgba(22, 22, 32, 0.7);
                --bg-glass: rgba(255, 255, 255, 0.03);
                
                /* === VIBRANT ACCENT COLORS === */
                --accent-primary: #6366f1;
                --accent-secondary: #8b5cf6;
                --accent-tertiary: #a855f7;
                --accent-glow: #818cf8;
                --accent-cyan: #22d3ee;
                --accent-emerald: #10b981;
                --accent-rose: #f43f5e;
                --accent-amber: #f59e0b;
                --accent-orange: #f97316;
                
                /* === TEXT COLORS === */
                --text-primary: #ffffff;
                --text-secondary: #e2e8f0;
                --text-muted: #94a3b8;
                --text-dark: #64748b;
                
                /* === GLASS MORPHISM === */
                --glass-bg: rgba(255, 255, 255, 0.05);
                --glass-border: rgba(255, 255, 255, 0.1);
                --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                
                /* === GRADIENTS === */
                --gradient-primary: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
                --gradient-glow: linear-gradient(135deg, rgba(99, 102, 241, 0.4) 0%, rgba(168, 85, 247, 0.4) 100%);
                --gradient-card: linear-gradient(145deg, rgba(26, 26, 40, 0.9) 0%, rgba(15, 15, 25, 0.95) 100%);
                --gradient-hero: linear-gradient(135deg, #0f0f1a 0%, #1a1025 25%, #0f1a20 50%, #151520 75%, #0a0a0f 100%);
                
                /* === TRANSITIONS === */
                --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-normal: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-bounce: 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

            /* === LIGHT MODE === */
            body.light-mode {
                --bg-primary: #fafafa;
                --bg-secondary: #ffffff;
                --bg-tertiary: #f8fafc;
                --bg-card: rgba(255, 255, 255, 0.9);
                --bg-glass: rgba(255, 255, 255, 0.7);
                
                --text-primary: #0f172a;
                --text-secondary: #334155;
                --text-muted: #64748b;
                
                --glass-bg: rgba(255, 255, 255, 0.8);
                --glass-border: rgba(0, 0, 0, 0.08);
                --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                
                --gradient-card: linear-gradient(145deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.98) 100%);
            }

            /* === GLOBAL RESET === */
            *, *::before, *::after {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
                scrollbar-width: thin;
                scrollbar-color: var(--accent-primary) var(--bg-secondary);
            }

            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: var(--bg-secondary);
            }

            ::-webkit-scrollbar-thumb {
                background: var(--gradient-primary);
                border-radius: 10px;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background: var(--gradient-hero);
                background-attachment: fixed;
                color: var(--text-secondary);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
                line-height: 1.6;
            }

            /* === ANIMATED BACKGROUND === */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(ellipse at 20% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 80%, rgba(168, 85, 247, 0.1) 0%, transparent 50%),
                    radial-gradient(ellipse at 40% 60%, rgba(236, 72, 153, 0.08) 0%, transparent 50%),
                    radial-gradient(ellipse at 90% 20%, rgba(34, 211, 238, 0.06) 0%, transparent 40%);
                pointer-events: none;
                z-index: -1;
                animation: bgPulse 15s ease-in-out infinite;
            }

            @keyframes bgPulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.8; transform: scale(1.02); }
            }

            /* === FLOATING PARTICLES === */
            .particles {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: -1;
                overflow: hidden;
            }

            .particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: var(--accent-primary);
                border-radius: 50%;
                animation: floatParticle 20s infinite;
                opacity: 0.3;
            }

            @keyframes floatParticle {
                0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
                10% { opacity: 0.5; }
                90% { opacity: 0.5; }
                100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
            }

            /* ====== NAVBAR - GLASSMORPHISM ====== */
            .navbar {
                background: rgba(10, 10, 15, 0.8);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid var(--glass-border);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
                padding: 1rem 0 !important;
                position: sticky;
                top: 0;
                z-index: 1000;
                transition: var(--transition-normal);
            }

            .navbar.scrolled {
                padding: 0.6rem 0 !important;
                background: rgba(10, 10, 15, 0.95);
            }

            .navbar-brand {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 700;
                font-size: 1.5rem;
                background: var(--gradient-primary);
                background-size: 200% 200%;
                animation: gradientShift 4s ease infinite;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: 1px;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: var(--transition-normal);
            }

            .navbar-brand:hover {
                transform: scale(1.05);
                filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.5));
            }

            .navbar-brand i {
                font-size: 1.8rem;
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes gradientShift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }

            .navbar .nav-link {
                color: var(--text-muted) !important;
                transition: var(--transition-normal);
                margin: 0 8px;
                padding: 0.5rem 1rem !important;
                position: relative;
                font-weight: 500;
                font-size: 0.9rem;
                letter-spacing: 0.5px;
                border-radius: 8px;
            }

            .navbar .nav-link:hover {
                color: var(--text-primary) !important;
                background: var(--glass-bg);
            }

            .navbar .nav-link::before {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 2px;
                background: var(--gradient-primary);
                transition: var(--transition-normal);
                transform: translateX(-50%);
                border-radius: 2px;
            }

            .navbar .nav-link:hover::before {
                width: 80%;
            }

            .navbar .nav-link i {
                transition: var(--transition-fast);
            }

            .navbar .nav-link:hover i {
                transform: translateY(-2px);
            }

            /* ====== MODERN BUTTONS ====== */
            .btn {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: var(--transition-normal);
                position: relative;
                overflow: hidden;
            }

            .btn-primary {
                background: var(--gradient-primary);
                background-size: 200% 200%;
                border: none;
                color: white !important;
                padding: 0.75rem 1.75rem;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: var(--transition-slow);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5), 0 0 60px rgba(168, 85, 247, 0.2);
                animation: gradientShift 2s ease infinite;
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-primary:active {
                transform: translateY(-1px);
            }

            .btn-outline-secondary {
                border: 2px solid var(--glass-border);
                color: var(--text-muted);
                background: transparent;
                padding: 0.7rem 1.5rem;
                border-radius: 12px;
            }

            .btn-outline-secondary:hover {
                border-color: var(--accent-primary);
                color: var(--accent-primary);
                background: rgba(99, 102, 241, 0.1);
                box-shadow: 0 0 30px rgba(99, 102, 241, 0.2);
            }

            .btn-glass {
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border: 1px solid var(--glass-border);
                color: var(--text-secondary);
                border-radius: 12px;
            }

            .btn-glass:hover {
                background: rgba(255, 255, 255, 0.1);
                border-color: var(--accent-primary);
                color: var(--text-primary);
                transform: translateY(-2px);
            }

            /* ====== GLASSMORPHISM CARDS ====== */
            .card {
                background: var(--gradient-card);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                transition: var(--transition-normal);
                position: relative;
                overflow: hidden;
            }

            .card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            }

            .card::after {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(99, 102, 241, 0.15) 0%, transparent 50%);
                opacity: 0;
                transition: var(--transition-normal);
                pointer-events: none;
            }

            .card:hover {
                transform: translateY(-8px) scale(1.02);
                border-color: rgba(99, 102, 241, 0.3);
                box-shadow: 
                    0 25px 50px rgba(0, 0, 0, 0.4),
                    0 0 100px rgba(99, 102, 241, 0.1),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }

            .card:hover::after {
                opacity: 1;
            }

            .card-header {
                background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, rgba(168, 85, 247, 0.05) 100%);
                border-bottom: 1px solid var(--glass-border);
                font-weight: 600;
                color: var(--text-primary);
            }

            /* ====== GAME CARD - MODERN STYLING ====== */
            .game-card {
                background: var(--gradient-card);
                border: 1px solid var(--glass-border);
                border-radius: 24px;
                transition: var(--transition-normal);
                position: relative;
                overflow: hidden;
                cursor: pointer;
            }

            .game-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(99, 102, 241, 0) 0%, rgba(168, 85, 247, 0) 100%);
                transition: var(--transition-normal);
                z-index: 1;
                pointer-events: none;
            }

            .game-card::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
                transition: var(--transition-slow);
                transform: translate(-50%, -50%);
                pointer-events: none;
            }

            .game-card:hover {
                transform: translateY(-12px) scale(1.02);
                border-color: var(--accent-primary);
                box-shadow: 
                    0 30px 60px rgba(0, 0, 0, 0.4),
                    0 0 80px rgba(99, 102, 241, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }

            .game-card:hover::before {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
            }

            .game-card:hover::after {
                width: 300%;
                height: 300%;
            }

            .game-card img {
                transition: var(--transition-normal);
                width: 100%;
                height: 220px;
                object-fit: cover;
            }

            .game-card:hover img {
                transform: scale(1.1);
                filter: brightness(1.1);
            }

            .game-card .card-body {
                position: relative;
                z-index: 2;
            }

            /* ====== BADGES - MODERN ====== */
            .badge {
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 600;
                padding: 0.5rem 1rem;
                border-radius: 50px;
                letter-spacing: 0.5px;
                font-size: 0.75rem;
                transition: var(--transition-fast);
            }

            .badge-price {
                background: var(--gradient-primary);
                color: white;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
                font-size: 1rem;
                padding: 0.8rem 1.5rem;
                font-weight: 700;
            }

            .badge-bg-pending {
                background: rgba(245, 158, 11, 0.15);
                color: var(--accent-amber);
                border: 1px solid var(--accent-amber);
            }

            .badge-bg-completed {
                background: rgba(16, 185, 129, 0.15);
                color: var(--accent-emerald);
                border: 1px solid var(--accent-emerald);
            }

            .badge-bg-failed {
                background: rgba(244, 63, 94, 0.15);
                color: var(--accent-rose);
                border: 1px solid var(--accent-rose);
            }

            /* ====== FORM STYLING - MODERN ====== */
            .form-control, .form-select {
                background: var(--bg-tertiary);
                border: 2px solid var(--glass-border);
                color: var(--text-secondary);
                border-radius: 12px;
                padding: 0.875rem 1rem;
                transition: var(--transition-normal);
                font-weight: 500;
            }

            .form-control:focus, .form-select:focus {
                background: var(--bg-secondary);
                border-color: var(--accent-primary);
                color: var(--text-primary);
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15), 0 0 30px rgba(99, 102, 241, 0.1);
            }

            .form-control::placeholder {
                color: var(--text-dark);
                font-weight: 400;
            }

            .form-label {
                color: var(--text-secondary);
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 600;
                font-size: 0.875rem;
                letter-spacing: 0.5px;
                margin-bottom: 0.75rem;
            }

            .invalid-feedback {
                color: var(--accent-rose);
                font-weight: 500;
                font-size: 0.85rem;
                display: block;
                margin-top: 0.5rem;
            }

            .is-invalid {
                border-color: var(--accent-rose) !important;
                box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.15) !important;
            }

            /* ====== ALERT STYLING - MODERN ====== */
            .alert {
                border-radius: 16px;
                border: 1px solid;
                font-weight: 500;
                backdrop-filter: blur(10px);
                padding: 1rem 1.5rem;
            }

            .alert-info {
                background: rgba(34, 211, 238, 0.1);
                border-color: var(--accent-cyan);
                color: var(--accent-cyan);
            }

            .alert-warning {
                background: rgba(245, 158, 11, 0.1);
                border-color: var(--accent-amber);
                color: var(--accent-amber);
            }

            .alert-success {
                background: rgba(16, 185, 129, 0.1);
                border-color: var(--accent-emerald);
                color: var(--accent-emerald);
            }

            .alert-danger {
                background: rgba(244, 63, 94, 0.1);
                border-color: var(--accent-rose);
                color: var(--accent-rose);
            }

            /* ====== HERO SECTION - DRAMATIC REDESIGN ====== */
            .hero-section {
                background: linear-gradient(180deg, rgba(10, 10, 15, 0.3) 0%, rgba(10, 10, 15, 0.9) 100%);
                border-radius: 32px;
                padding: 100px 50px;
                border: 1px solid var(--glass-border);
                box-shadow: var(--glass-shadow);
                text-align: center;
                margin-bottom: 80px;
                position: relative;
                overflow: hidden;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: 
                    radial-gradient(circle at 30% 30%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 70% 70%, rgba(168, 85, 247, 0.1) 0%, transparent 50%);
                animation: heroRotate 30s linear infinite;
            }

            @keyframes heroRotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            .hero-section h1 {
                font-family: 'Space Grotesk', sans-serif;
                color: var(--text-primary);
                font-size: clamp(2.5rem, 6vw, 4.5rem);
                font-weight: 700;
                margin-bottom: 24px;
                letter-spacing: -1px;
                position: relative;
                z-index: 1;
                text-shadow: 0 0 60px rgba(99, 102, 241, 0.3);
            }

            .hero-section h1 i {
                background: var(--gradient-primary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                animation: pulse 2s ease-in-out infinite;
            }

            .hero-section p {
                font-size: 1.25rem;
                color: var(--text-muted);
                font-weight: 400;
                position: relative;
                z-index: 1;
                max-width: 600px;
                margin: 0 auto;
            }

            .hero-section .btn {
                position: relative;
                z-index: 1;
            }

            /* ====== DROPDOWN STYLING ====== */
            .dropdown-menu {
                background: var(--gradient-card);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                box-shadow: var(--glass-shadow);
                border-radius: 16px;
                padding: 0.5rem;
                margin-top: 0.5rem !important;
            }

            .dropdown-item {
                color: var(--text-muted);
                transition: var(--transition-fast);
                font-weight: 500;
                border-radius: 10px;
                padding: 0.75rem 1rem;
                margin: 0.25rem 0;
            }

            .dropdown-item:hover {
                background: rgba(99, 102, 241, 0.15);
                color: var(--accent-primary);
                transform: translateX(5px);
            }

            .dropdown-item i {
                width: 20px;
                text-align: center;
            }

            .dropdown-divider {
                border-color: var(--glass-border);
                margin: 0.5rem 0;
            }

            /* ====== PAGINATION STYLING ====== */
            .pagination {
                gap: 8px;
            }

            .page-link {
                background: var(--bg-tertiary);
                border: 1px solid var(--glass-border);
                color: var(--text-muted);
                font-weight: 600;
                transition: var(--transition-fast);
                border-radius: 10px;
                padding: 0.5rem 1rem;
            }

            .page-link:hover {
                background: rgba(99, 102, 241, 0.15);
                border-color: var(--accent-primary);
                color: var(--accent-primary);
                transform: translateY(-2px);
            }

            .page-item.active .page-link {
                background: var(--gradient-primary);
                border-color: var(--accent-primary);
                color: white;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            }

            /* ====== FOOTER - MODERN ====== */
            footer {
                background: var(--gradient-card);
                backdrop-filter: blur(20px);
                border-top: 1px solid var(--glass-border);
                color: var(--text-muted);
                margin-top: 100px;
                padding: 60px 0 30px;
                position: relative;
            }

            footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: var(--gradient-primary);
            }

            footer h5 {
                font-family: 'Space Grotesk', sans-serif;
                color: var(--text-primary);
                font-weight: 600;
                margin-bottom: 1.25rem;
            }

            footer a {
                color: var(--text-muted);
                text-decoration: none;
                transition: var(--transition-fast);
                display: inline-block;
            }

            footer a:hover {
                color: var(--accent-primary);
                transform: translateX(5px);
            }

            footer ul li {
                margin-bottom: 0.75rem;
            }

            /* ====== TYPOGRAPHY ====== */
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Space Grotesk', sans-serif;
                color: var(--text-primary);
                font-weight: 700;
                letter-spacing: -0.5px;
            }

            .text-muted {
                color: var(--text-muted) !important;
            }

            .text-danger {
                color: var(--accent-rose) !important;
            }

            .text-success {
                color: var(--accent-emerald) !important;
            }

            .text-warning {
                color: var(--accent-amber) !important;
            }

            .text-info {
                color: var(--accent-cyan) !important;
            }

            /* ====== UTILITY CLASSES - ENHANCED ====== */
            .border-glow {
                border: 1px solid var(--accent-primary);
                box-shadow: 0 0 30px rgba(99, 102, 241, 0.3);
            }

            .text-glow {
                color: var(--accent-primary);
                text-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
            }

            .text-gradient {
                background: var(--gradient-primary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .glass-effect {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
            }

            /* ====== FLOATING ANIMATION ====== */
            .float-animation {
                animation: floating 3s ease-in-out infinite;
            }

            @keyframes floating {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }

            /* ====== SHIMMER EFFECT ====== */
            .shimmer {
                position: relative;
                overflow: hidden;
            }

            .shimmer::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 50%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                animation: shimmer 2s infinite;
            }

            @keyframes shimmer {
                100% { left: 200%; }
            }

            /* ====== GLOW ON HOVER ====== */
            .hover-glow {
                transition: var(--transition-normal);
            }

            .hover-glow:hover {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.4);
            }

            /* ====== SCALE ANIMATION ====== */
            .hover-scale {
                transition: var(--transition-normal);
            }

            .hover-scale:hover {
                transform: scale(1.05);
            }

            /* ====== RESPONSIVE DESIGN ====== */
            @media (max-width: 1200px) {
                .hero-section {
                    padding: 80px 40px;
                }
            }

            @media (max-width: 992px) {
                .hero-section h1 {
                    font-size: 2.5rem;
                }

                .card:hover {
                    transform: translateY(-5px) scale(1.01);
                }

                .game-card:hover {
                    transform: translateY(-8px) scale(1.01);
                }
            }

            @media (max-width: 768px) {
                .hero-section {
                    padding: 60px 25px;
                    border-radius: 24px;
                    margin-bottom: 50px;
                }

                .hero-section h1 {
                    font-size: 2rem;
                    letter-spacing: 0;
                }

                .hero-section p {
                    font-size: 1rem;
                }

                .navbar {
                    padding: 0.75rem 0 !important;
                }

                .navbar-brand {
                    font-size: 1.25rem;
                }

                .btn-primary {
                    padding: 0.6rem 1.25rem;
                    font-size: 0.9rem;
                }

                .card {
                    border-radius: 16px;
                }

                footer {
                    padding: 40px 0 25px;
                    margin-top: 60px;
                }
            }

            @media (max-width: 576px) {
                .hero-section {
                    padding: 50px 20px;
                }

                .hero-section h1 {
                    font-size: 1.75rem;
                }

                .navbar-brand i {
                    font-size: 1.4rem;
                }

                .game-card img {
                    height: 180px;
                }
            }

            /* === DARK MODE TOGGLE BUTTON - MODERN === */
            .dark-mode-toggle {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                color: var(--text-muted);
                padding: 10px 16px;
                border-radius: 50px;
                cursor: pointer;
                transition: var(--transition-normal);
                font-weight: 600;
                margin: 0 10px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .dark-mode-toggle:hover {
                background: rgba(99, 102, 241, 0.2);
                border-color: var(--accent-primary);
                color: var(--accent-primary);
                transform: scale(1.05);
            }

            .dark-mode-toggle i {
                font-size: 1rem;
                transition: var(--transition-normal);
            }

            .dark-mode-toggle:hover i {
                transform: rotate(20deg);
            }

            /* === LIGHT MODE ADJUSTMENTS - ENHANCED === */
            body.light-mode {
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%, #f8fafc 100%) !important;
            }

            body.light-mode::before {
                background: 
                    radial-gradient(ellipse at 20% 20%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 80%, rgba(168, 85, 247, 0.05) 0%, transparent 50%) !important;
            }

            body.light-mode .navbar {
                background: rgba(255, 255, 255, 0.85);
                border-bottom: 1px solid rgba(0, 0, 0, 0.08);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            }

            body.light-mode .navbar-brand {
                filter: brightness(0.9) contrast(1.1);
            }

            body.light-mode .card,
            body.light-mode .game-card {
                background: rgba(255, 255, 255, 0.9) !important;
                border-color: rgba(0, 0, 0, 0.08) !important;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            }

            body.light-mode .card:hover,
            body.light-mode .game-card:hover {
                background: rgba(255, 255, 255, 0.98) !important;
                border-color: var(--accent-primary) !important;
                box-shadow: 0 20px 50px rgba(99, 102, 241, 0.15) !important;
            }

            body.light-mode .form-control,
            body.light-mode .form-select {
                background: rgba(255, 255, 255, 0.9) !important;
                border: 2px solid rgba(0, 0, 0, 0.1) !important;
                color: var(--text-secondary) !important;
            }

            body.light-mode .form-control:focus,
            body.light-mode .form-select:focus {
                background: rgba(255, 255, 255, 1) !important;
                border-color: var(--accent-primary) !important;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
            }

            body.light-mode .hero-section {
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.5) 0%, rgba(248, 250, 252, 0.9) 100%);
            }

            body.light-mode .table {
                color: var(--text-secondary);
            }

            body.light-mode .table thead {
                background: rgba(99, 102, 241, 0.1);
                color: var(--text-secondary);
            }

            body.light-mode .progress {
                background-color: #e9ecef;
            }

            body.light-mode .alert {
                background-color: rgba(255, 255, 255, 0.9);
            }

            body.light-mode .modal-content {
                background: rgba(255, 255, 255, 0.98) !important;
                border-color: rgba(0, 0, 0, 0.1) !important;
            }

            body.light-mode .modal-header {
                border-bottom-color: rgba(0, 0, 0, 0.1) !important;
                color: var(--text-secondary) !important;
            }

            body.light-mode .modal-footer {
                border-top-color: rgba(0, 212, 255, 0.2) !important;
            }

            body.light-mode .dropdown-menu {
                background: rgba(255, 255, 255, 0.95) !important;
                border-color: rgba(0, 212, 255, 0.2) !important;
            }

            body.light-mode .dropdown-item {
                color: var(--text-secondary) !important;
            }

            body.light-mode .dropdown-item:hover,
            body.light-mode .dropdown-item:focus {
                background-color: rgba(0, 212, 255, 0.1) !important;
                color: var(--neon-cyan) !important;
            }
        </style>

        @yield('styles')
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-gamepad me-2"></i>Pay to Win
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Navigation -->
                    <ul class="navbar-nav me-auto ms-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('topup.index') }}">
                                <i class="fas fa-star me-1"></i>Top Up
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('wishlist.index') }}">
                                    <i class="fas fa-heart me-1"></i>Wishlist
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('export.create') }}">
                                    <i class="fas fa-download me-1"></i>Export
                                </a>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="#help">
                                <i class="fas fa-question-circle me-1"></i>Bantuan
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side - Dark Mode Toggle & Auth Links -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Dark Mode Toggle -->
                        <li class="nav-item">
                            <button type="button" class="dark-mode-toggle" onclick="toggleDarkMode()">
                                <i class="fas fa-moon me-1"></i><span id="mode-text">Dark</span>
                            </button>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>Masuk
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>Daftar
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('topup.myTransactions') }}">
                                    <i class="fas fa-history me-1"></i>Riwayat
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-cog me-2"></i>Pengaturan Profil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-5">
            <div class="container-fluid px-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Oops! Ada Kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Kesalahan!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <div class="container-fluid px-4">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-gamepad fa-2x me-3" style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                            <h5 class="mb-0 text-gradient">Pay to Win</h5>
                        </div>
                        <p class="mb-4">Platform top up game online terpercaya. Top up game favorit Anda dengan aman, cepat, dan harga terbaik.</p>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-glass p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-glass p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-glass p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-discord"></i>
                            </a>
                            <a href="#" class="btn btn-glass p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5>Navigasi</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}"><i class="fas fa-home me-2"></i>Beranda</a></li>
                            <li><a href="{{ route('topup.index') }}"><i class="fas fa-gamepad me-2"></i>Top Up</a></li>
                            <li><a href="#"><i class="fas fa-tags me-2"></i>Promo</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Bantuan</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fas fa-question-circle me-2"></i>FAQ</a></li>
                            <li><a href="#"><i class="fas fa-headset me-2"></i>Layanan Pelanggan</a></li>
                            <li><a href="#"><i class="fas fa-book me-2"></i>Panduan</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Informasi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fas fa-shield-alt me-2"></i>Kebijakan Privasi</a></li>
                            <li><a href="#"><i class="fas fa-file-contract me-2"></i>Syarat & Ketentuan</a></li>
                            <li><a href="#"><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4" style="border-color: var(--glass-border);">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="small mb-0">&copy; 2025 Pay to Win. Semua hak dilindungi.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="small mb-0">
                            <span class="me-3"><i class="fas fa-lock me-1" style="color: var(--accent-emerald);"></i>Aman</span>
                            <span class="me-3"><i class="fas fa-shield-alt me-1" style="color: var(--accent-primary);"></i>Terpercaya</span>
                            <span><i class="fas fa-bolt me-1" style="color: var(--accent-amber);"></i>Cepat</span>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Floating Particles Background -->
        <div class="particles" id="particles">
            <script>
                // Generate floating particles
                const particlesContainer = document.getElementById('particles');
                for (let i = 0; i < 30; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 20 + 's';
                    particle.style.animationDuration = (15 + Math.random() * 20) + 's';
                    particle.style.width = (2 + Math.random() * 4) + 'px';
                    particle.style.height = particle.style.width;
                    particlesContainer.appendChild(particle);
                }
            </script>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- AOS Animation Library -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
        <!-- Modern Interactive Scripts -->
        <script>
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50
            });

            // Initialize dark mode from localStorage
            document.addEventListener('DOMContentLoaded', function() {
                const isDarkMode = localStorage.getItem('darkMode') === 'false';
                if (isDarkMode) {
                    document.body.classList.add('light-mode');
                    document.getElementById('mode-text').textContent = 'Light';
                    document.querySelector('.dark-mode-toggle i').classList.remove('fa-moon');
                    document.querySelector('.dark-mode-toggle i').classList.add('fa-sun');
                }

                // Card mouse tracking effect
                document.querySelectorAll('.card, .game-card').forEach(card => {
                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = ((e.clientX - rect.left) / rect.width) * 100;
                        const y = ((e.clientY - rect.top) / rect.height) * 100;
                        card.style.setProperty('--mouse-x', x + '%');
                        card.style.setProperty('--mouse-y', y + '%');
                    });
                });

                // Navbar scroll effect
                window.addEventListener('scroll', () => {
                    const navbar = document.querySelector('.navbar');
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });

                // Smooth reveal animation for elements
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.card, .game-card, .alert').forEach(el => {
                    observer.observe(el);
                });
            });

            function toggleDarkMode() {
                const body = document.body;
                const toggle = document.querySelector('.dark-mode-toggle i');
                const modeText = document.getElementById('mode-text');
                
                // Toggle light mode class with smooth transition
                body.style.transition = 'background 0.5s ease, color 0.3s ease';
                body.classList.toggle('light-mode');
                
                if (body.classList.contains('light-mode')) {
                    // Light mode
                    localStorage.setItem('darkMode', 'false');
                    toggle.classList.remove('fa-moon');
                    toggle.classList.add('fa-sun');
                    modeText.textContent = 'Light';
                } else {
                    // Dark mode
                    localStorage.setItem('darkMode', 'true');
                    toggle.classList.remove('fa-sun');
                    toggle.classList.add('fa-moon');
                    modeText.textContent = 'Dark';
                }
            }

            // Ripple effect for buttons
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Add ripple animation keyframes
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                
                .revealed {
                    animation: fadeInUp 0.6s ease forwards;
                }
                
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);
        </script>

        @yield('scripts')
    </body>
</html>

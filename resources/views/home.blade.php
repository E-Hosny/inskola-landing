@php
    $locale = app()->getLocale();
    $isRTL = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنسكولا - {{ __('messages.hero.subtitle') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #18b596;
            --primary-dark: #149479;
            --primary-light: #20d4ae;
            --secondary-color: #ff9800;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 30px rgba(24, 181, 150, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
            background: var(--white);
        }

        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }

        [dir="ltr"] {
            direction: ltr;
            text-align: left;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(24, 181, 150, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.12);
            border-bottom: 2px solid var(--primary-color);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 3rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo img {
            height: auto;
            width: 500px;
            max-width: 500px;
            max-height: 70px;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
            transition: all 0.3s ease;
        }

        .logo:hover img {
            filter: drop-shadow(0 4px 8px rgba(24, 181, 150, 0.3));
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            flex: 1;
            justify-content: center;
        }

        .nav-menu li {
            position: relative;
        }

        .nav-menu li a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            display: block;
        }

        .nav-menu li a::before {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            {{ $isRTL ? 'right' : 'left' }}: 50%;
            transform: translateX({{ $isRTL ? '50%' : '-50%' }});
            background: var(--primary-color);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-menu li a:hover {
            color: var(--primary-color);
            background: rgba(24, 181, 150, 0.05);
        }

        .nav-menu li a:hover::before {
            width: 80%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .language-switcher {
            display: flex;
            gap: 0.3rem;
            background: var(--bg-light);
            padding: 0.3rem;
            border-radius: 30px;
            border: 1px solid rgba(24, 181, 150, 0.2);
        }

        .language-switcher a {
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .language-switcher a:hover {
            background: rgba(24, 181, 150, 0.1);
            color: var(--primary-color);
        }

        .language-switcher a.active {
            background: var(--primary-color);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(24, 181, 150, 0.3);
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-color);
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(24, 181, 150, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(24, 181, 150, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            border: 2px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(24, 181, 150, 0.3);
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001;
            position: relative;
        }

        .hamburger span {
            width: 28px;
            height: 3px;
            background: var(--primary-color);
            margin: 4px 0;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(9px, 9px);
            background: var(--primary-color);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
            background: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 200px 2rem 120px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease;
        }

        .hero-logo-container img {
            height: 120px;
            width: auto;
            max-width: 400px;
            object-fit: contain;
            filter: drop-shadow(0 4px 15px rgba(0, 0, 0, 0.2));
            background: rgba(255, 255, 255, 0.1);
            padding: 0.8rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            animation: fadeInUp 0.8s ease 0.2s;
            animation-fill-mode: both;
        }

        .hero-text h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            opacity: 0.95;
            animation: fadeInUp 0.8s ease 0.4s;
            animation-fill-mode: both;
        }

        .hero-text p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            line-height: 1.8;
            animation: fadeInUp 0.8s ease 0.6s;
            animation-fill-mode: both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.8s;
            animation-fill-mode: both;
        }

        .hero-buttons .btn-primary {
            background: var(--white);
            color: var(--primary-color);
            border-color: var(--white);
            font-size: 1.1rem;
            padding: 1rem 2.5rem;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }

        .hero-buttons .btn-primary:hover {
            background: var(--bg-light);
            border-color: var(--bg-light);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .hero-buttons .btn-secondary {
            border-color: var(--white);
            color: var(--white);
            font-size: 1.1rem;
            padding: 1rem 2.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .hero-buttons .btn-secondary:hover {
            background: var(--white);
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }

        .hero-image {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            animation: fadeIn 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .hero-logo-large {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .hero-logo-large img {
            height: 300px;
            width: auto;
            max-width: 500px;
            object-fit: contain;
            filter: drop-shadow(0 10px 40px rgba(0, 0, 0, 0.3));
            background: rgba(255, 255, 255, 0.15);
            padding: 2rem;
            border-radius: 25px;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        .hero-illustration {
            font-size: 12rem;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.2));
            animation: float 3s ease-in-out infinite 0.5s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Features Section */
        .features {
            padding: 100px 2rem;
            background: var(--bg-light);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.3rem;
            color: var(--text-light);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .feature-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .feature-card h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Subjects Section */
        .subjects {
            padding: 100px 2rem;
            background: var(--white);
        }

        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .subject-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            padding: 2.5rem;
            border-radius: 20px;
            text-align: center;
            color: var(--white);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .subject-card::before {
            content: '';
            position: absolute;
            top: -50%;
            {{ $isRTL ? 'right' : 'left' }}: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .subject-card:hover::before {
            opacity: 1;
        }

        .subject-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .subject-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .subject-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Stats Section */
        .stats {
            padding: 100px 2rem;
            background: var(--primary-color);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 40%);
            pointer-events: none;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 3rem;
            position: relative;
            z-index: 1;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            display: block;
            background: linear-gradient(to bottom, var(--white), rgba(255,255,255,0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 1.3rem;
            opacity: 0.95;
            font-weight: 600;
        }

        /* Contact Section */
        .contact {
            padding: 100px 2rem;
            background: var(--bg-light);
        }

        .contact-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-form {
            background: var(--white);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.05rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(24, 181, 150, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-button {
            background: var(--primary-color);
            color: var(--white);
            padding: 1rem 3rem;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-color);
        }

        .submit-button:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .success-message {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: var(--white);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
            animation: fadeInDown 0.5s ease;
        }

        .error-message {
            background: #ef4444;
            color: var(--white);
            padding: 0.7rem 1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 0.95rem;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: var(--white);
            padding: 4rem 2rem 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Animations */
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .nav-container {
                padding: 1rem 1.5rem;
            }

            .logo img {
                width: 400px;
                max-width: 400px;
                max-height: 60px;
                height: auto;
            }

            .nav-menu {
                position: fixed;
                {{ $isRTL ? 'right' : 'left' }}: -100%;
                top: 80px;
                flex-direction: column;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                width: 100%;
                text-align: center;
                transition: 0.3s;
                box-shadow: var(--shadow-lg);
                padding: 2rem 0;
                gap: 0;
                border-top: 2px solid var(--primary-color);
            }

            .nav-menu.active {
                {{ $isRTL ? 'right' : 'left' }}: 0;
            }

            .nav-menu li {
                padding: 0.5rem 0;
                width: 100%;
            }

            .nav-menu li a {
                padding: 1rem 2rem;
                width: 100%;
            }

            .hamburger {
                display: flex;
            }

            .nav-actions {
                position: fixed;
                {{ $isRTL ? 'right' : 'left' }}: -100%;
                top: calc(80px + 300px);
                width: 100%;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                padding: 2rem;
                flex-direction: column;
                box-shadow: var(--shadow-lg);
                transition: 0.3s;
                gap: 1.5rem;
                border-top: 1px solid rgba(24, 181, 150, 0.2);
            }

            .nav-actions.active {
                {{ $isRTL ? 'right' : 'left' }}: 0;
            }

            .language-switcher {
                width: 100%;
                justify-content: center;
            }

            .nav-actions .btn-primary {
                width: 100%;
                text-align: center;
            }

            .hero {
                padding: 160px 1rem 100px;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .hero-logo-container {
                justify-content: center;
            }

            .hero-logo-container img {
                height: 90px;
                max-width: 300px;
            }

            .hero-text h1 {
                font-size: 2.5rem;
                text-align: center;
            }

            .hero-text h2 {
                font-size: 1.4rem;
                text-align: center;
            }

            .hero-text p {
                text-align: center;
            }

            .hero-logo-large img {
                height: 220px;
                max-width: 400px;
            }

            .hero-illustration {
                font-size: 8rem;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }

            .hero-buttons {
                flex-direction: column;
                justify-content: center;
            }

            .hero-buttons a {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 0.8rem 1rem;
            }

            .logo img {
                width: 320px;
                max-width: 320px;
                max-height: 50px;
                height: auto;
            }

            .hero {
                padding: 140px 1rem 80px;
            }

            .hero-logo-container img {
                height: 70px;
                max-width: 250px;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text h2 {
                font-size: 1.2rem;
            }

            .hero-text p {
                font-size: 1rem;
            }

            .hero-logo-large img {
                height: 180px;
                max-width: 350px;
            }

            .hero-illustration {
                font-size: 6rem;
            }

            .features,
            .subjects,
            .stats,
            .contact {
                padding: 60px 1rem;
            }

            .section-header h2 {
                font-size: 1.8rem;
            }

            .features-grid,
            .subjects-grid {
                grid-template-columns: 1fr;
            }

            .stat-number {
                font-size: 3rem;
            }

            .contact-form {
                padding: 2rem 1.5rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#home" class="logo">
                <img src="{{ asset('600-200_pp_wh_page-0001-removebg-preview.png') }}" alt="Inskola Logo" style="display: block; width: 500px; max-width: 500px; max-height: 70px; height: auto;">
            </a>
            
            <ul class="nav-menu" id="navMenu">
                <li><a href="#home">{{ __('messages.nav.home') }}</a></li>
                <li><a href="#subjects">{{ __('messages.nav.subjects') }}</a></li>
                <li><a href="#about">{{ __('messages.nav.about') }}</a></li>
                <li><a href="#contact">{{ __('messages.nav.contact') }}</a></li>
            </ul>

            <div class="nav-actions" id="navActions">
                <div class="language-switcher">
                    <a href="{{ route('language.switch', 'ar') }}" class="{{ $locale === 'ar' ? 'active' : '' }}">العربية</a>
                    <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">English</a>
                </div>
                <a href="#" class="btn-primary">{{ __('messages.nav.login') }}</a>
            </div>

            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-logo-container">
                    <img src="{{ asset('600-200_pp_gr_page-0001-removebg-preview.png') }}" alt="Inskola Logo">
                </div>
                <h1>{{ __('messages.hero.title') }}</h1>
                <h2>{{ __('messages.hero.subtitle') }}</h2>
                <p>{{ __('messages.hero.description') }}</p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn-primary">{{ __('messages.hero.cta') }}</a>
                    <a href="#about" class="btn-secondary">{{ __('messages.hero.cta_secondary') }}</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-logo-large">
                    <img src="{{ asset('600-200_pp_gr_page-0001-removebg-preview.png') }}" alt="Inskola Logo">
                </div>
                <div class="hero-illustration">🎓</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="about">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('messages.features.title') }}</h2>
                <p>{{ __('messages.features.subtitle') }}</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎮</div>
                    <h3>{{ __('messages.features.interactive_lessons.title') }}</h3>
                    <p>{{ __('messages.features.interactive_lessons.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>{{ __('messages.features.track_progress.title') }}</h3>
                    <p>{{ __('messages.features.track_progress.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👨‍🏫</div>
                    <h3>{{ __('messages.features.certified_teachers.title') }}</h3>
                    <p>{{ __('messages.features.certified_teachers.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>{{ __('messages.features.safe_environment.title') }}</h3>
                    <p>{{ __('messages.features.safe_environment.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>{{ __('messages.features.curriculum_aligned.title') }}</h3>
                    <p>{{ __('messages.features.curriculum_aligned.description') }}</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⏰</div>
                    <h3>{{ __('messages.features.anytime_learning.title') }}</h3>
                    <p>{{ __('messages.features.anytime_learning.description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Subjects Section -->
    <section class="subjects" id="subjects">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('messages.subjects.title') }}</h2>
                <p>{{ __('messages.subjects.subtitle') }}</p>
            </div>
            <div class="subjects-grid">
                <div class="subject-card">
                    <div class="subject-icon">➕</div>
                    <h3>{{ __('messages.subjects.math') }}</h3>
                </div>
                <div class="subject-card">
                    <div class="subject-icon">📖</div>
                    <h3>{{ __('messages.subjects.arabic') }}</h3>
                </div>
                <div class="subject-card">
                    <div class="subject-icon">🔤</div>
                    <h3>{{ __('messages.subjects.english') }}</h3>
                </div>
                <div class="subject-card">
                    <div class="subject-icon">🔬</div>
                    <h3>{{ __('messages.subjects.science') }}</h3>
                </div>
                <div class="subject-card">
                    <div class="subject-icon">🌍</div>
                    <h3>{{ __('messages.subjects.social') }}</h3>
                </div>
                <div class="subject-card">
                    <div class="subject-icon">🕌</div>
                    <h3>{{ __('messages.subjects.quran') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="section-header">
                <h2 style="color: white;">{{ __('messages.stats.title') }}</h2>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">15,000+</span>
                    <span class="stat-label">{{ __('messages.stats.active_students') }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">250+</span>
                    <span class="stat-label">{{ __('messages.stats.qualified_teachers') }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">5,000+</span>
                    <span class="stat-label">{{ __('messages.stats.lessons') }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">{{ __('messages.stats.satisfaction_rate') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-container">
            <div class="section-header">
                <h2>{{ __('messages.contact.title') }}</h2>
                <p>{{ __('messages.contact.subtitle') }}</p>
            </div>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('messages.contact.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{ __('messages.contact.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">{{ __('messages.contact.message') }}</label>
                    <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="submit-button">{{ __('messages.contact.send') }}</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{ __('messages.nav.home') }}</h3>
                <p>{{ __('messages.footer.description') }}</p>
            </div>
            <div class="footer-section">
                <h3>{{ __('messages.footer.about_us') }}</h3>
                <a href="#">{{ __('messages.nav.about') }}</a>
                <a href="#">{{ __('messages.nav.subjects') }}</a>
                <a href="#">{{ __('messages.nav.contact') }}</a>
            </div>
            <div class="footer-section">
                <h3>{{ __('messages.footer.support') }}</h3>
                <a href="#">{{ __('messages.footer.privacy') }}</a>
                <a href="#">{{ __('messages.footer.terms') }}</a>
                <a href="#">{{ __('messages.footer.support') }}</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>{{ __('messages.footer.copyright') }}</p>
        </div>
    </footer>

    <script>
        // Hamburger Menu Toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const navActions = document.getElementById('navActions');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            navActions.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                navActions.classList.remove('active');
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

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>

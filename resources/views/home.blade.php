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
            --primary-lighter: #2ee5c4;
            --secondary-color: #ff9800;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --bg-light: #f8f9fa;
            --bg-lighter: #fafbfc;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 8px 20px rgba(24, 181, 150, 0.12);
            --shadow-lg: 0 15px 40px rgba(24, 181, 150, 0.18);
            --shadow-xl: 0 20px 60px rgba(24, 181, 150, 0.25);
            --gradient-primary: linear-gradient(135deg, #18b596 0%, #149479 50%, #20d4ae 100%);
            --gradient-overlay: linear-gradient(180deg, rgba(24, 181, 150, 0.05) 0%, transparent 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            line-height: 1.7;
            color: var(--text-dark);
            overflow-x: hidden;
            background: var(--white);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }

        [dir="ltr"] {
            direction: ltr;
            text-align: left;
        }

        /* Navbar Styles - New Design */
        .navbar {
            background: var(--white);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(24, 181, 150, 0.15);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 4rem;
            position: relative;
        }

        /* Logo - RTL Support */
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            order: {{ $isRTL ? '3' : '1' }};
        }

        .logo:hover {
            transform: scale(1.03);
        }

        .logo img {
            height: auto;
            width: 500px;
            max-width: 500px;
            max-height: 70px;
            object-fit: contain;
            display: block;
            transition: all 0.3s ease;
        }

        /* Navigation Menu - RTL Support */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            list-style: none;
            margin: 0;
            padding: 0;
            order: {{ $isRTL ? '1' : '2' }};
            flex: 1;
            justify-content: {{ $isRTL ? 'flex-end' : 'flex-start' }};
            margin-{{ $isRTL ? 'left' : 'right' }}: 2rem;
        }

        .nav-menu li {
            position: relative;
        }

        .nav-menu li a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            display: block;
            white-space: nowrap;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            bottom: 0.5rem;
            {{ $isRTL ? 'right' : 'left' }}: 50%;
            transform: translateX({{ $isRTL ? '50%' : '-50%' }});
            width: 0;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover {
            color: var(--primary-color);
            background: rgba(24, 181, 150, 0.08);
        }

        .nav-menu li a:hover::after {
            width: 60%;
        }

        /* Nav Actions - RTL Support */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            order: {{ $isRTL ? '2' : '3' }};
        }

        .language-switcher {
            display: flex;
            gap: 0.4rem;
            background: var(--bg-light);
            padding: 0.4rem;
            border-radius: 50px;
            border: 2px solid rgba(24, 181, 150, 0.15);
        }

        .language-switcher a {
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .language-switcher a:hover {
            background: rgba(24, 181, 150, 0.1);
            color: var(--primary-color);
        }

        .language-switcher a.active {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(24, 181, 150, 0.3);
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 0.85rem 2.2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(24, 181, 150, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(24, 181, 150, 0.35);
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001;
            position: relative;
            order: {{ $isRTL ? '1' : '4' }};
        }

        .hamburger span {
            width: 30px;
            height: 3px;
            background: var(--primary-color);
            margin: 4px 0;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(10px, 10px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(9px, -9px);
        }

        /* Hero Section - New Design */
        .hero {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 0;
            margin-top: 0;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at {{ $isRTL ? '85%' : '15%' }} 30%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at {{ $isRTL ? '15%' : '85%' }} 70%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            pointer-events: none;
            animation: pulse 10s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: -30%;
            {{ $isRTL ? 'right' : 'left' }}: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.05); }
        }

        .hero-content {
            max-width: 1600px;
            margin: 0 auto;
            padding: 180px 4rem 120px;
            display: grid;
            grid-template-columns: {{ $isRTL ? '0.9fr 1.1fr' : '1.1fr 0.9fr' }};
            gap: 8rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text {
            text-align: {{ $isRTL ? 'right' : 'left' }};
        }

        .hero-logo-container {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.8s ease;
            background: rgba(255, 255, 255, 0.12);
            padding: 1.2rem 2rem;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-logo-container img {
            height: 100px;
            width: auto;
            max-width: 350px;
            object-fit: contain;
            filter: drop-shadow(0 4px 20px rgba(0, 0, 0, 0.2));
        }

        .hero-text h1 {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 2rem;
            line-height: 1.1;
            letter-spacing: -0.03em;
            text-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.8s ease 0.2s;
            animation-fill-mode: both;
        }

        .hero-text h2 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            opacity: 0.98;
            letter-spacing: -0.01em;
            animation: fadeInUp 0.8s ease 0.4s;
            animation-fill-mode: both;
        }

        .hero-text p {
            font-size: 1.3rem;
            margin-bottom: 3.5rem;
            opacity: 0.95;
            line-height: 1.9;
            max-width: 95%;
            animation: fadeInUp 0.8s ease 0.6s;
            animation-fill-mode: both;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.8s;
            animation-fill-mode: both;
            flex-direction: {{ $isRTL ? 'row-reverse' : 'row' }};
        }

        .hero-buttons .btn-primary {
            background: var(--white);
            color: var(--primary-color);
            border: none;
            font-size: 1.2rem;
            padding: 1.2rem 3rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
            border-radius: 50px;
        }

        .hero-buttons .btn-primary:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .hero-buttons .btn-secondary {
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: var(--white);
            font-size: 1.2rem;
            padding: 1.2rem 3rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 50px;
        }

        .hero-buttons .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--white);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .hero-image {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 3rem;
            animation: fadeIn 1s ease 0.4s;
            animation-fill-mode: both;
            position: relative;
        }

        .hero-logo-large {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero-logo-large img {
            height: 350px;
            width: auto;
            max-width: 550px;
            object-fit: contain;
            filter: drop-shadow(0 15px 50px rgba(0, 0, 0, 0.3));
            background: rgba(255, 255, 255, 0.18);
            padding: 2.5rem;
            border-radius: 30px;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.25);
            animation: float 4s ease-in-out infinite;
            position: relative;
            z-index: 2;
        }

        .hero-logo-large::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 6s ease-in-out infinite;
            z-index: 1;
        }

        .hero-illustration {
            font-size: 14rem;
            filter: drop-shadow(0 15px 40px rgba(0, 0, 0, 0.25));
            animation: float 4s ease-in-out infinite 0.8s;
            position: relative;
            z-index: 2;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(2deg); }
        }

        /* Features Section */
        .features {
            padding: 120px 2rem;
            background: var(--bg-lighter);
            position: relative;
        }

        .features::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-primary);
            opacity: 0.3;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
        }

        .section-header h2 {
            font-size: 3.2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1.2rem;
            letter-spacing: -0.02em;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            {{ $isRTL ? 'right' : 'left' }}: 50%;
            transform: translateX({{ $isRTL ? '50%' : '-50%' }});
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .section-header p {
            font-size: 1.35rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            padding: 3rem 2.5rem;
            border-radius: 24px;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            {{ $isRTL ? 'right' : 'left' }}: 0;
            width: 4px;
            height: 0;
            background: var(--gradient-primary);
            transition: height 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-color);
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-icon {
            font-size: 4.5rem;
            margin-bottom: 1.8rem;
            display: inline-block;
            transition: transform 0.4s ease;
            filter: drop-shadow(0 4px 8px rgba(24, 181, 150, 0.2));
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.15) rotate(5deg);
        }

        .feature-card h3 {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.2rem;
            letter-spacing: -0.01em;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.85;
            font-size: 1.08rem;
        }

        /* Subjects Section */
        .subjects {
            padding: 120px 2rem;
            background: var(--white);
            position: relative;
        }

        .subjects::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-primary);
            opacity: 0.3;
        }

        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .subject-card {
            background: var(--gradient-primary);
            padding: 3rem 2.5rem;
            border-radius: 24px;
            text-align: center;
            color: var(--white);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .subject-card::before {
            content: '';
            position: absolute;
            top: -50%;
            {{ $isRTL ? 'right' : 'left' }}: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.25) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .subject-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .subject-card:hover::before,
        .subject-card:hover::after {
            opacity: 1;
        }

        .subject-card:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: var(--shadow-xl);
        }

        .subject-icon {
            font-size: 4.5rem;
            margin-bottom: 1.2rem;
            display: inline-block;
            transition: transform 0.4s ease;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
        }

        .subject-card:hover .subject-icon {
            transform: scale(1.2) rotate(-5deg);
        }

        .subject-card h3 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        /* Stats Section */
        .stats {
            padding: 120px 2rem;
            background: var(--gradient-primary);
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
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
            pointer-events: none;
            animation: pulse 10s ease-in-out infinite;
        }

        .stats::after {
            content: '';
            position: absolute;
            top: -30%;
            {{ $isRTL ? 'right' : 'left' }}: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite;
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
            padding: 2.5rem 2rem;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px) scale(1.05);
        }

        .stat-number {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 0.8rem;
            display: block;
            background: linear-gradient(135deg, var(--white) 0%, rgba(255,255,255,0.9) 50%, var(--white) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            filter: drop-shadow(0 2px 8px rgba(255, 255, 255, 0.3));
        }

        .stat-label {
            font-size: 1.35rem;
            opacity: 0.98;
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        /* Contact Section */
        .contact {
            padding: 120px 2rem;
            background: var(--bg-lighter);
            position: relative;
        }

        .contact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-primary);
            opacity: 0.3;
        }

        .contact-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-form {
            background: var(--white);
            padding: 3.5rem;
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(24, 181, 150, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .contact-form:hover {
            box-shadow: var(--shadow-xl);
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
            padding: 1.2rem 1.5rem;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            font-family: inherit;
            background: var(--bg-lighter);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(24, 181, 150, 0.12);
            transform: translateY(-2px);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-button {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 1.2rem 3rem;
            border: none;
            border-radius: 30px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            box-shadow: var(--shadow-md);
            letter-spacing: 0.02em;
        }

        .submit-button:hover {
            background: var(--gradient-primary);
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .submit-button:active {
            transform: translateY(-2px) scale(1);
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
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            color: var(--white);
            padding: 5rem 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
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
            font-size: 1.6rem;
            margin-bottom: 1.8rem;
            color: var(--primary-color);
            font-weight: 700;
            letter-spacing: -0.01em;
            position: relative;
            padding-bottom: 1rem;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            {{ $isRTL ? 'right' : 'left' }}: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: block;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .footer-section a {
            padding: 0.3rem 0;
        }

        .footer-section a:hover {
            color: var(--primary-color);
            transform: translateX({{ $isRTL ? '-5px' : '5px' }});
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.05rem;
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
                padding: 1rem 2rem;
            }

            .logo {
                order: {{ $isRTL ? '2' : '1' }} !important;
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
                top: 0;
                flex-direction: column;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(15px);
                width: 100%;
                height: 100vh;
                text-align: {{ $isRTL ? 'right' : 'left' }};
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: var(--shadow-xl);
                padding: 100px 2rem 2rem;
                gap: 0.5rem;
                justify-content: flex-start;
                z-index: 999;
            }

            .nav-menu.active {
                {{ $isRTL ? 'right' : 'left' }}: 0;
            }

            .nav-menu li {
                padding: 0.3rem 0;
                width: 100%;
            }

            .nav-menu li a {
                padding: 1.2rem 2rem;
                width: 100%;
                font-size: 1.15rem;
                border-radius: 15px;
            }

            .hamburger {
                display: flex;
                order: {{ $isRTL ? '1' : '3' }} !important;
            }

            .nav-actions {
                position: fixed;
                {{ $isRTL ? 'right' : 'left' }}: -100%;
                top: auto;
                bottom: 2rem;
                width: calc(100% - 4rem);
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(15px);
                padding: 1.5rem;
                flex-direction: column;
                box-shadow: var(--shadow-xl);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                gap: 1.5rem;
                border-radius: 20px;
                border: 2px solid rgba(24, 181, 150, 0.2);
                z-index: 998;
            }

            .nav-actions.active {
                {{ $isRTL ? 'right' : 'left' }}: 2rem;
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
                min-height: 100vh;
            }

            .hero-content {
                padding: 140px 2rem 80px;
                grid-template-columns: 1fr;
                gap: 4rem;
            }

            .hero-text {
                text-align: center !important;
            }

            .hero-logo-container {
                justify-content: center;
                margin: 0 auto 2rem;
            }

            .hero-logo-container img {
                height: 90px;
                max-width: 300px;
            }

            .hero-text h1 {
                font-size: 3rem;
                text-align: center;
            }

            .hero-text h2 {
                font-size: 1.6rem;
                text-align: center;
            }

            .hero-text p {
                text-align: center;
                max-width: 100%;
            }

            .hero-logo-large img {
                height: 250px;
                max-width: 400px;
            }

            .hero-illustration {
                font-size: 10rem;
            }

            .hero-buttons {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .hero-buttons a {
                width: 100%;
                max-width: 400px;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 0.8rem 1.5rem;
            }

            .logo img {
                width: 320px;
                max-width: 320px;
                max-height: 50px;
                height: auto;
            }

            .hero-content {
                padding: 120px 1.5rem 60px;
                gap: 3rem;
            }

            .hero-logo-container {
                padding: 1rem 1.5rem;
            }

            .hero-logo-container img {
                height: 70px;
                max-width: 250px;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .hero-text h2 {
                font-size: 1.4rem;
            }

            .hero-text p {
                font-size: 1.1rem;
            }

            .hero-buttons .btn-primary,
            .hero-buttons .btn-secondary {
                font-size: 1.1rem;
                padding: 1rem 2rem;
            }

            .hero-logo-large img {
                height: 200px;
                max-width: 350px;
            }

            .hero-illustration {
                font-size: 8rem;
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
                <img src="{{ asset('600-200_pp_wh_page-0001-removebg-preview (2).png') }}" alt="Inskola Logo" style="display: block; width: 500px; max-width: 500px; max-height: 70px; height: auto;">
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
                <a href="#contact" class="btn-primary">{{ __('messages.nav.register') }}</a>
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

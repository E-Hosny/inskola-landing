@php
    $locale = $locale ?? app()->getLocale();
    $isRTL = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #18b596;
            --primary-dark: #149479;
            --primary-light: #20d4ae;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --gradient-primary: linear-gradient(135deg, #18b596 0%, #149479 50%, #20d4ae 100%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            line-height: 1.8;
            color: var(--text-dark);
            background:
                radial-gradient(circle at top {{ $isRTL ? 'left' : 'right' }}, rgba(24, 181, 150, 0.08), transparent 28%),
                linear-gradient(180deg, #f7faf9 0%, #ffffff 40%, #f8f9fa 100%);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        [dir="rtl"] { direction: rtl; text-align: right; }
        [dir="ltr"] { direction: ltr; text-align: left; }

        a { color: inherit; }

        .navbar {
            background: rgba(255, 255, 255, 0.98);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(24, 181, 150, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 1.5rem;
            gap: 1rem;
        }

        .logo img {
            height: auto;
            max-width: 200px;
            max-height: 40px;
            display: block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.88rem;
            padding: 0.4rem 0.75rem;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-dark);
            background: rgba(24, 181, 150, 0.08);
        }

        .language-switcher {
            display: flex;
            gap: 0.25rem;
            background: var(--bg-light);
            padding: 0.25rem;
            border-radius: 8px;
        }

        .language-switcher a {
            padding: 0.35rem 0.7rem;
            border-radius: 6px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.75rem;
        }

        .language-switcher a.active {
            background: var(--gradient-primary);
            color: var(--white);
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white) !important;
            text-decoration: none;
            padding: 0.55rem 1.1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-block;
        }

        .page-hero {
            padding: 2.8rem 1.5rem 1.2rem;
            text-align: center;
        }

        .page-hero h1 {
            font-size: clamp(1.6rem, 3.5vw, 2.2rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 0.7rem;
        }

        .page-hero h1::after {
            content: '';
            display: block;
            width: 72px;
            height: 3px;
            margin: 0.8rem auto 0;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .page-hero p {
            color: var(--text-light);
            max-width: 680px;
            margin: 0.9rem auto 0;
            font-size: 1rem;
        }

        .blog-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1.5rem 4rem;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.4rem;
            margin-top: 1.5rem;
        }

        .article-card {
            background: var(--white);
            border: 1px solid rgba(24, 181, 150, 0.12);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(24, 181, 150, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(24, 181, 150, 0.14);
        }

        .article-card-cover {
            aspect-ratio: 16 / 9;
            background:
                linear-gradient(135deg, rgba(24, 181, 150, 0.18), rgba(20, 148, 121, 0.28)),
                url('{{ asset('studentimg.jpeg') }}') center/cover;
        }

        .article-card-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .article-card-body {
            padding: 1.25rem 1.2rem 1.4rem;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            flex: 1;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem;
            color: var(--text-light);
            font-size: 0.82rem;
            font-weight: 600;
        }

        .article-card h2 {
            font-size: 1.1rem;
            line-height: 1.5;
            font-weight: 800;
        }

        .article-card h2 a {
            text-decoration: none;
            color: var(--text-dark);
        }

        .article-card h2 a:hover {
            color: var(--primary-dark);
        }

        .article-card p {
            color: var(--text-light);
            font-size: 0.92rem;
            flex: 1;
        }

        .read-more {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-light);
            background: var(--white);
            border-radius: 18px;
            border: 1px dashed rgba(24, 181, 150, 0.25);
        }

        .pagination-wrap {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .pagination-wrap nav {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 0.75rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            border: 1px solid rgba(24, 181, 150, 0.18);
            background: var(--white);
            color: var(--text-dark);
        }

        .pagination-wrap .active span,
        .pagination-wrap a:hover {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            align-items: center;
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 1.2rem;
        }

        .breadcrumb a {
            text-decoration: none;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .article-hero {
            margin-bottom: 1.5rem;
        }

        .article-hero h1 {
            font-size: clamp(1.6rem, 3.4vw, 2.3rem);
            font-weight: 800;
            line-height: 1.35;
            margin: 0.8rem 0 1rem;
            letter-spacing: -0.02em;
        }

        .article-cover {
            border-radius: 18px;
            overflow: hidden;
            margin: 1.3rem 0 1.6rem;
            border: 1px solid rgba(24, 181, 150, 0.12);
            background: rgba(24, 181, 150, 0.08);
        }

        .article-cover img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            display: block;
        }

        .article-content {
            background: var(--white);
            border: 1px solid rgba(24, 181, 150, 0.12);
            border-radius: 18px;
            padding: 1.8rem 1.6rem;
            box-shadow: 0 8px 24px rgba(24, 181, 150, 0.06);
            font-size: 1.02rem;
        }

        .article-content h2 {
            font-size: 1.25rem;
            margin: 1.6rem 0 0.7rem;
            color: var(--primary-dark);
        }

        .article-content p,
        .article-content li {
            margin-bottom: 0.9rem;
            color: var(--text-dark);
        }

        .article-content ul {
            {{ $isRTL ? 'padding-right' : 'padding-left' }}: 1.2rem;
            margin-bottom: 1rem;
        }

        .article-content a {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .related-section {
            margin-top: 2.5rem;
        }

        .related-section h2 {
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .cta-box {
            margin-top: 2rem;
            padding: 1.5rem;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(24, 181, 150, 0.12), rgba(20, 148, 121, 0.18));
            border: 1px solid rgba(24, 181, 150, 0.18);
            text-align: center;
        }

        .cta-box p {
            margin-bottom: 1rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        footer {
            background: var(--white);
            border-top: 1px solid rgba(24, 181, 150, 0.12);
            padding: 1.5rem;
            text-align: center;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0.7rem;
        }

        .footer-links a {
            text-decoration: none;
            color: var(--primary-dark);
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .articles-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 680px) {
            .articles-grid { grid-template-columns: 1fr; }
            .nav-links a:not(.btn-primary) { display: none; }
            .article-content { padding: 1.25rem 1rem; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('200-600 out icon gr -- EH.png') }}" alt="{{ $isRTL ? 'شعار إنسكولا' : 'Inskola Logo' }}">
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
                <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">{{ __('messages.nav.blog') }}</a>
                <a href="{{ route('home') }}#contact" class="btn-primary">{{ __('messages.nav.register') }}</a>
                <div class="language-switcher">
                    <a href="{{ route('language.switch', 'ar') }}" class="{{ $locale === 'ar' ? 'active' : '' }}">العربية</a>
                    <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">English</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="footer-links">
            <a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
            <a href="{{ route('blog.index') }}">{{ __('messages.nav.blog') }}</a>
            <a href="{{ route('terms') }}">{{ __('messages.footer.terms') }}</a>
            <a href="{{ route('privacy') }}">{{ __('messages.footer.privacy') }}</a>
        </div>
        <p>{{ __('messages.footer.copyright') }}</p>
    </footer>
</body>
</html>

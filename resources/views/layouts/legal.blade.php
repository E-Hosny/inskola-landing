@php
    $locale = app()->getLocale();
    $isRTL = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $seoTitle = ($pageTitle ? $pageTitle . ' - ' : '') . config('seo.site_name.' . $locale);
        $seoDescription = trim($__env->yieldContent('seo_description')) ?: config('seo.default_description.' . $locale);
        $seoKeywords = config('seo.default_keywords.' . $locale);
        $seoCanonical = url()->current();
        $seoType = 'website';
        $seoRobots = 'index, follow';
        $seoJsonLd = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => $seoTitle,
                'description' => $seoDescription,
                'url' => $seoCanonical,
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => config('seo.site_name.' . $locale),
                    'url' => route('home'),
                ],
            ],
        ];
    @endphp
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #18b596;
            --primary-dark: #149479;
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
            background: linear-gradient(180deg, #f7faf9 0%, #ffffff 40%, #f8f9fa 100%);
            -webkit-font-smoothing: antialiased;
        }

        [dir="rtl"] { direction: rtl; text-align: right; }
        [dir="ltr"] { direction: ltr; text-align: left; }

        .navbar {
            background: rgba(255, 255, 255, 0.98);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(24, 181, 150, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 960px;
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

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.8rem;
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

        .btn-home {
            background: var(--gradient-primary);
            color: var(--white);
            text-decoration: none;
            padding: 0.5rem 1.1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.82rem;
            white-space: nowrap;
        }

        .page-hero {
            padding: 2.5rem 1.5rem 1.5rem;
            text-align: center;
        }

        .page-hero h1 {
            font-size: clamp(1.4rem, 3vw, 1.9rem);
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.6rem;
            letter-spacing: -0.02em;
        }

        .page-hero h1::after {
            content: '';
            display: block;
            width: 64px;
            height: 3px;
            margin: 0.7rem auto 0;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .page-hero p {
            color: var(--text-light);
            max-width: 640px;
            margin: 0.9rem auto 0;
            font-size: 0.95rem;
        }

        .legal-nav {
            max-width: 860px;
            margin: 0 auto 1.5rem;
            padding: 0 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            justify-content: center;
        }

        .legal-nav a {
            text-decoration: none;
            color: var(--primary-dark);
            background: rgba(24, 181, 150, 0.08);
            border: 1px solid rgba(24, 181, 150, 0.18);
            padding: 0.45rem 0.95rem;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .legal-nav a:hover,
        .legal-nav a.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .terms-container {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 1.5rem 4rem;
        }

        .terms-section {
            background: var(--white);
            border: 1px solid rgba(24, 181, 150, 0.12);
            border-radius: 16px;
            padding: 1.6rem 1.5rem;
            margin-bottom: 1.1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            scroll-margin-top: 90px;
        }

        .terms-section h2 {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 1rem;
            padding-bottom: 0.6rem;
            border-bottom: 2px solid rgba(24, 181, 150, 0.15);
        }

        .terms-section ol {
            {{ $isRTL ? 'padding-right' : 'padding-left' }}: 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .terms-section li {
            color: var(--text-dark);
            font-size: 0.95rem;
            line-height: 1.85;
        }

        footer {
            background: var(--white);
            border-top: 1px solid rgba(24, 181, 150, 0.12);
            padding: 1.5rem;
            text-align: center;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 24px;
            {{ $isRTL ? 'left' : 'right' }}: 24px;
            z-index: 9999;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            transform: translateY(-3px) scale(1.06);
            box-shadow: 0 12px 30px rgba(37, 211, 102, 0.5);
        }

        .whatsapp-float svg {
            width: 30px;
            height: 30px;
            fill: #fff;
        }

        .whatsapp-float::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            animation: waPulse 2s infinite;
            border: 2px solid rgba(37, 211, 102, 0.5);
        }

        @keyframes waPulse {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.45); opacity: 0; }
        }

        @media (max-width: 600px) {
            .terms-section { padding: 1.25rem 1rem; }
            .whatsapp-float {
                width: 54px;
                height: 54px;
                bottom: 18px;
                {{ $isRTL ? 'left' : 'right' }}: 16px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('200-600 out icon gr -- EH.png') }}" alt="Inskola Logo">
            </a>
            <div class="nav-actions">
                <a href="{{ route('blog.index') }}" style="text-decoration:none;color:var(--primary-dark);font-weight:700;font-size:0.82rem;">{{ __('messages.nav.blog') }}</a>
                <div class="language-switcher">
                    <a href="{{ route('language.switch', 'ar') }}" class="{{ $locale === 'ar' ? 'active' : '' }}">العربية</a>
                    <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">English</a>
                </div>
                <a href="{{ route('home') }}" class="btn-home">{{ __('messages.legal.back_home') }}</a>
            </div>
        </div>
    </nav>

    <header class="page-hero">
        <h1>@yield('page_title')</h1>
        <p>@yield('page_subtitle')</p>
    </header>

    <nav class="legal-nav" aria-label="{{ __('messages.legal.nav_label') }}">
        <a href="{{ route('terms') }}" class="{{ ($activePage ?? '') === 'terms' ? 'active' : '' }}">{{ __('messages.legal.nav_terms') }}</a>
        <a href="{{ route('privacy') }}" class="{{ ($activePage ?? '') === 'privacy' ? 'active' : '' }}">{{ __('messages.legal.nav_privacy') }}</a>
        <a href="{{ route('refund') }}" class="{{ ($activePage ?? '') === 'refund' ? 'active' : '' }}">{{ __('messages.legal.nav_refund') }}</a>
    </nav>

    <main class="terms-container">
        @yield('content')
    </main>

    <footer>
        <p>
            <a href="{{ route('blog.index') }}" style="color:var(--primary-dark);text-decoration:none;font-weight:600;margin:0 0.5rem;">{{ __('messages.nav.blog') }}</a>
            ·
            {{ __('messages.footer.copyright') }}
        </p>
    </footer>

    <a href="https://wa.me/966554966258" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="{{ __('messages.whatsapp_float.label') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
</body>
</html>

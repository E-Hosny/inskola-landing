@php
    $locale = $locale ?? app()->getLocale();
    $isRTL = $locale === 'ar';
    $whatsappNumber = config('seo.whatsapp');
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
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    @include('partials.analytics')
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
                linear-gradient(180deg, #f7faf9 0%, #ffffff 42%, #f8f9fa 100%);
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
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 1.5rem;
            gap: 1rem;
        }
        .logo img { height: auto; max-width: 200px; max-height: 40px; display: block; }
        .nav-links { display: flex; align-items: center; gap: 0.7rem; flex-wrap: wrap; }
        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.88rem;
            padding: 0.4rem 0.75rem;
            border-radius: 10px;
        }
        .nav-links a:hover { color: var(--primary-dark); background: rgba(24, 181, 150, 0.08); }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            text-decoration: none;
            font-weight: 700;
            border-radius: 12px;
            padding: 0.85rem 1.4rem;
            transition: all 0.25s ease;
        }
        .btn-primary { background: var(--gradient-primary); color: #fff; box-shadow: 0 8px 20px rgba(24, 181, 150, 0.25); }
        .btn-primary:hover { transform: translateY(-2px); }
        .btn-secondary { background: #fff; color: var(--primary-dark); border: 1.5px solid rgba(24, 181, 150, 0.35); }
        .page {
            max-width: 860px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
        }
        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            align-items: center;
            color: var(--text-light);
            font-size: 0.88rem;
            margin-bottom: 1.5rem;
        }
        .breadcrumb a { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .hero-block {
            background: linear-gradient(160deg, rgba(24, 181, 150, 0.08), rgba(255,255,255,0.95));
            border: 1px solid rgba(24, 181, 150, 0.12);
            border-radius: 22px;
            padding: 2rem 1.6rem;
            margin-bottom: 2rem;
        }
        .hero-block h1 {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            line-height: 1.35;
            color: var(--primary-dark);
            margin-bottom: 0.9rem;
        }
        .hero-block .intro { font-size: 1.05rem; color: var(--text-dark); margin-bottom: 1.3rem; }
        .cta-row { display: flex; flex-wrap: wrap; gap: 0.75rem; }
        .content-section { margin-bottom: 1.8rem; }
        .content-section h2 {
            font-size: 1.25rem;
            color: var(--primary-dark);
            margin-bottom: 0.55rem;
        }
        .content-section p { color: var(--text-dark); }
        .bullets {
            list-style: none;
            display: grid;
            gap: 0.7rem;
            margin: 1.2rem 0 1.8rem;
        }
        .bullets li {
            background: #fff;
            border: 1px solid rgba(24, 181, 150, 0.14);
            border-radius: 14px;
            padding: 0.85rem 1rem;
            position: relative;
            {{ $isRTL ? 'padding-right' : 'padding-left' }}: 2.2rem;
        }
        .bullets li::before {
            content: '';
            position: absolute;
            top: 1.15rem;
            {{ $isRTL ? 'right' : 'left' }}: 0.9rem;
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 50%;
            background: var(--primary-color);
        }
        .price-note {
            background: var(--gradient-primary);
            color: #fff;
            border-radius: 18px;
            padding: 1.3rem 1.4rem;
            margin: 1.5rem 0;
        }
        .price-note strong { font-size: 1.5rem; }
        .related h2 { margin-bottom: 0.9rem; color: var(--primary-dark); }
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.75rem;
        }
        .related-grid a {
            text-decoration: none;
            background: #fff;
            border: 1px solid rgba(24, 181, 150, 0.14);
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-weight: 700;
            color: var(--primary-dark);
        }
        .related-grid a:hover { border-color: var(--primary-color); box-shadow: 0 8px 18px rgba(24, 181, 150, 0.12); }
        .bottom-cta {
            margin-top: 2.5rem;
            padding: 1.6rem;
            border-radius: 18px;
            background: #fff;
            border: 1px solid rgba(24, 181, 150, 0.16);
            text-align: center;
        }
        .bottom-cta p { margin-bottom: 1rem; }
        .whatsapp-float {
            position: fixed;
            width: 58px;
            height: 58px;
            bottom: 22px;
            {{ $isRTL ? 'left' : 'right' }}: 18px;
            background: #25d366;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            z-index: 999;
        }
        .whatsapp-float svg { width: 28px; height: 28px; fill: currentColor; }
        footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        footer a { color: var(--primary-dark); text-decoration: none; font-weight: 600; margin: 0 0.35rem; }
        @media (max-width: 640px) {
            .nav-container { padding: 0.65rem 1rem; }
            .page { padding: 1.3rem 1rem 3.5rem; }
            .hero-block { padding: 1.4rem 1.1rem; }
            .cta-row .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('200-600 out icon gr -- EH.png') }}" alt="{{ $isRTL ? 'شعار إنسكولا' : 'Inskola logo' }}" width="200" height="40">
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
                <a href="{{ route('blog.index') }}">{{ __('messages.nav.blog') }}</a>
                <a href="{{ route('home') }}#contact"
                   class="btn btn-primary"
                   style="padding:0.45rem 0.9rem;font-size:0.82rem;"
                   data-analytics-event="click_booking"
                   data-analytics-location="seo_nav">
                    {{ __('messages.nav.register') }}
                </a>
            </div>
        </div>
    </nav>

    <main class="page">
        @yield('content')
    </main>

    <footer>
        <a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>·
        <a href="{{ route('blog.index') }}">{{ __('messages.nav.blog') }}</a>·
        <a href="{{ route('terms') }}">{{ __('messages.footer.terms') }}</a>·
        <a href="{{ route('privacy') }}">{{ __('messages.footer.privacy') }}</a>
        <p style="margin-top:0.7rem;">{{ __('messages.footer.copyright') }}</p>
    </footer>

    @php
        $waText = $whatsappText ?? ($isRTL
            ? 'السلام عليكم، أرغب بالاستفسار عن حجز حصة خصوصية عبر إنسكولا'
            : 'Hello, I want to ask about booking a private lesson with Inskola');
        $waUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($waText);
    @endphp
    <a href="{{ $waUrl }}"
       class="whatsapp-float"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="{{ __('messages.whatsapp_float.label') }}"
       data-analytics-event="click_whatsapp"
       data-analytics-location="seo_float">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
</body>
</html>

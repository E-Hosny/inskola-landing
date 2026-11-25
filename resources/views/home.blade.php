@php
    $locale = app()->getLocale();
    $isRTL = $locale === 'ar';
    $whatsappNumber = config('seo.whatsapp');
    $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode(
        $isRTL
            ? 'السلام عليكم، أرغب بحجز حصة خصوصية أونلاين عبر إنسكولا'
            : 'Hello, I want to book an online private lesson with Inskola'
    );
    $subjectLinks = [
        'math' => 'math',
        'arabic' => 'arabic',
        'english' => 'english',
        'science' => 'science',
        'social' => null,
        'quran' => 'quran',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $seoTitle = config('seo.default_title.' . $locale);
        $seoDescription = config('seo.default_description.' . $locale);
        $seoKeywords = config('seo.default_keywords.' . $locale);
        $seoCanonical = route('home');
        $seoType = 'website';
        $seoImage = asset(config('seo.og_image'));
        $faqEntities = collect(__('messages.seo.faq'))->map(function ($item) {
            return [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['answer'],
                ],
            ];
        })->values()->all();
        $seoJsonLd = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'EducationalOrganization',
                'name' => config('seo.organization.name'),
                'alternateName' => config('seo.organization.alternate_name'),
                'url' => route('home'),
                'logo' => asset('200-600 out icon gr -- EH.png'),
                'image' => $seoImage,
                'description' => $seoDescription,
                'telephone' => config('seo.phone'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => config('seo.organization.address_country'),
                    'addressLocality' => config('seo.organization.address_locality'),
                ],
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'Saudi Arabia',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => config('seo.site_name.' . $locale),
                'url' => route('home'),
                'inLanguage' => $locale === 'ar' ? 'ar-SA' : 'en-US',
                'potentialAction' => [
                    '@type' => 'CommunicateAction',
                    'target' => route('home') . '#contact',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'Offer',
                'name' => $isRTL ? 'حصة خصوصية أونلاين' : 'Online private lesson',
                'description' => $seoDescription,
                'price' => __('messages.pricing.amount'),
                'priceCurrency' => 'SAR',
                'availability' => 'https://schema.org/InStock',
                'url' => route('home') . '#pricing',
                'seller' => [
                    '@type' => 'EducationalOrganization',
                    'name' => config('seo.organization.name'),
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqEntities,
            ],
        ];
    @endphp
    @include('partials.seo')
    @include('partials.analytics')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #18b596;
            --brand-dark: #0f7669;
            --brand-deep: #0b5c52;
            --brand-soft: #e7f7f3;
            --ink: #14302a;
            --muted: #5b6b66;
            --line: rgba(20, 48, 42, 0.1);
            --white: #ffffff;
            --sand: #f3f7f5;
            --shadow: 0 18px 50px rgba(15, 118, 105, 0.14);
            --radius: 18px;
            --container: 1120px;
            --nav-h: 72px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: {{ $isRTL ? "'Cairo', sans-serif" : "'Outfit', sans-serif" }};
            color: var(--ink);
            background: var(--white);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        [dir="rtl"] { direction: rtl; text-align: right; }
        [dir="ltr"] { direction: ltr; text-align: left; }

        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        button, input, textarea { font: inherit; }

        .container {
            width: min(100% - 2.5rem, var(--container));
            margin-inline: auto;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            inset-inline: 0;
            top: 0;
            z-index: 1000;
            height: var(--nav-h);
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid transparent;
            backdrop-filter: blur(14px);
            transition: box-shadow 0.3s ease, border-color 0.3s ease, background 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            border-bottom-color: var(--line);
            box-shadow: 0 8px 30px rgba(15, 118, 105, 0.08);
        }

        .nav-inner {
            width: min(100% - 2rem, var(--container));
            margin-inline: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .logo img {
            height: 40px;
            width: auto;
            max-width: 220px;
            object-fit: contain;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 0.15rem;
        }

        .nav-menu a {
            display: block;
            padding: 0.55rem 0.85rem;
            border-radius: 999px;
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--ink);
            transition: background 0.2s ease, color 0.2s ease;
        }

        .nav-menu a:hover { background: var(--brand-soft); color: var(--brand-dark); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .lang-switch {
            display: inline-flex;
            gap: 0.2rem;
            padding: 0.2rem;
            border-radius: 999px;
            background: var(--sand);
            border: 1px solid var(--line);
        }

        .lang-switch a {
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--muted);
        }

        .lang-switch a.active {
            background: var(--brand);
            color: var(--white);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            min-height: 48px;
            padding: 0.75rem 1.35rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.95rem;
            border: 2px solid transparent;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease, color 0.25s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
            color: var(--white);
            box-shadow: 0 12px 28px rgba(24, 181, 150, 0.28);
        }

        .btn-primary:hover { box-shadow: 0 16px 34px rgba(24, 181, 150, 0.36); }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.14);
            color: var(--white);
            border-color: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(8px);
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--brand-dark);
        }

        .btn-ghost {
            background: var(--white);
            color: var(--brand-dark);
            border-color: rgba(24, 181, 150, 0.25);
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: var(--white);
            box-shadow: 0 12px 28px rgba(37, 211, 102, 0.28);
        }

        .hamburger {
            display: none;
            width: 44px;
            height: 44px;
            border: 0;
            background: transparent;
            cursor: pointer;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
        }

        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            margin-inline: auto;
            background: var(--brand-dark);
            border-radius: 2px;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }

        .hamburger.active span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* Hero */
        .hero {
            position: relative;
            min-height: 100vh;
            min-height: 100svh;
            display: flex;
            align-items: flex-end;
            color: var(--white);
            overflow: hidden;
            isolation: isolate;
        }

        .hero-media {
            position: absolute;
            inset: 0;
            z-index: -2;
        }

        .hero-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 30%;
            transform: scale(1.04);
            animation: heroZoom 18s ease-in-out infinite alternate;
        }

        .hero-shade {
            position: absolute;
            inset: 0;
            z-index: -1;
            background:
                linear-gradient(180deg, rgba(8, 32, 28, 0.35) 0%, rgba(8, 32, 28, 0.55) 42%, rgba(8, 32, 28, 0.88) 100%),
                linear-gradient({{ $isRTL ? '270deg' : '90deg' }}, rgba(11, 92, 82, 0.55) 0%, rgba(11, 92, 82, 0.05) 55%);
        }

        .hero-content {
            width: min(100% - 2.5rem, var(--container));
            margin: 0 auto;
            padding: calc(var(--nav-h) + 4rem) 0 4.5rem;
            max-width: 760px;
            {{ $isRTL ? 'margin-right: max(1.25rem, calc((100% - var(--container)) / 2)); margin-left: auto;' : 'margin-left: max(1.25rem, calc((100% - var(--container)) / 2)); margin-right: auto;' }}
        }

        .brand-mark {
            display: block;
            font-size: clamp(2.8rem, 7vw, 4.6rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 1rem;
            animation: fadeUp 0.8s ease both;
        }

        .hero h1 {
            font-size: clamp(1.55rem, 3.4vw, 2.35rem);
            font-weight: 700;
            line-height: 1.35;
            max-width: 18ch;
            margin-bottom: 1rem;
            animation: fadeUp 0.8s ease 0.12s both;
        }

        .hero-lead {
            font-size: clamp(1rem, 2vw, 1.15rem);
            color: rgba(255, 255, 255, 0.9);
            max-width: 38ch;
            margin-bottom: 1.8rem;
            animation: fadeUp 0.8s ease 0.22s both;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            animation: fadeUp 0.8s ease 0.32s both;
        }

        /* Trust */
        .trust {
            background: var(--brand-deep);
            color: var(--white);
            padding: 1.1rem 0;
        }

        .trust-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            text-align: center;
        }

        .trust-list li {
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            padding: 0.35rem 0.5rem;
            position: relative;
        }

        .trust-list li:not(:last-child)::after {
            content: '';
            position: absolute;
            inset-inline-end: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Sections */
        section { padding: 5rem 0; }

        .section-head {
            max-width: 640px;
            margin-bottom: 2.5rem;
        }

        .section-head.center {
            text-align: center;
            margin-inline: auto;
        }

        .section-head h2 {
            font-size: clamp(1.7rem, 3vw, 2.2rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 0.65rem;
            color: var(--ink);
        }

        .section-head p {
            color: var(--muted);
            font-size: 1.02rem;
        }

        .features { background: var(--white); }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem 2.5rem;
        }

        .feature-item {
            padding-block: 0.35rem;
            border-top: 1px solid var(--line);
            padding-top: 1.25rem;
        }

        .feature-item h3 {
            font-size: 1.15rem;
            font-weight: 750;
            margin-bottom: 0.45rem;
            color: var(--brand-dark);
        }

        .feature-item p {
            color: var(--muted);
            font-size: 0.98rem;
            max-width: 42ch;
        }

        .how {
            background:
                radial-gradient(circle at {{ $isRTL ? 'left' : 'right' }} top, rgba(24, 181, 150, 0.12), transparent 32%),
                linear-gradient(180deg, var(--sand) 0%, #eef6f3 100%);
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            counter-reset: step;
        }

        .step {
            position: relative;
            padding: 1.6rem 1.4rem 1.4rem;
            border-top: 3px solid var(--brand);
        }

        .step::before {
            counter-increment: step;
            content: counter(step, decimal-leading-zero);
            display: block;
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--brand-dark);
            letter-spacing: 0.08em;
            margin-bottom: 0.8rem;
        }

        .step h3 {
            font-size: 1.15rem;
            margin-bottom: 0.45rem;
        }

        .step p {
            color: var(--muted);
            font-size: 0.96rem;
        }

        .subjects { background: var(--white); }

        .subject-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.9rem;
        }

        .subject-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            min-height: 84px;
            padding: 1.1rem 1.25rem;
            border-bottom: 2px solid rgba(24, 181, 150, 0.18);
            background: linear-gradient(180deg, #ffffff 0%, var(--brand-soft) 140%);
            transition: border-color 0.25s ease, transform 0.25s ease, background 0.25s ease;
        }

        .subject-link:hover {
            transform: translateY(-3px);
            border-bottom-color: var(--brand);
            background: linear-gradient(180deg, #ffffff 0%, #d9f3ec 160%);
        }

        .subject-link strong {
            font-size: 1.08rem;
            font-weight: 750;
        }

        .subject-link span {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--brand-dark);
            white-space: nowrap;
        }

        .pricing {
            background:
                radial-gradient(ellipse at 20% 20%, rgba(255, 255, 255, 0.12), transparent 45%),
                linear-gradient(155deg, #0b5c52 0%, #18b596 55%, #20d4ae 100%);
            color: var(--white);
        }

        .pricing .section-head h2,
        .pricing .section-head p { color: var(--white); }

        .pricing .section-head p { opacity: 0.9; }

        .price-panel {
            max-width: 520px;
            margin-inline: auto;
            text-align: center;
        }

        .price-amount {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 0.55rem;
            margin: 0.4rem 0 0.35rem;
        }

        .price-amount .value {
            font-size: clamp(3.5rem, 8vw, 4.6rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.04em;
        }

        .price-amount .currency {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .price-unit {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 0.55rem;
        }

        .price-note {
            opacity: 0.9;
            margin-bottom: 1.5rem;
        }

        .price-includes {
            list-style: none;
            text-align: {{ $isRTL ? 'right' : 'left' }};
            max-width: 360px;
            margin: 0 auto 1.8rem;
            display: grid;
            gap: 0.7rem;
        }

        .price-includes li {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-weight: 500;
        }

        .price-includes li::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.22);
            flex-shrink: 0;
        }

        .pricing .btn-primary {
            background: var(--white);
            color: var(--brand-dark);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
        }

        .faq { background: var(--sand); }

        .faq-list {
            max-width: 760px;
            margin-inline: auto;
            display: grid;
            gap: 0.75rem;
        }

        .faq-item {
            border-bottom: 1px solid var(--line);
            background: transparent;
        }

        .faq-item summary {
            list-style: none;
            cursor: pointer;
            padding: 1.1rem 0;
            font-weight: 750;
            font-size: 1.05rem;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
        }

        .faq-item summary::-webkit-details-marker { display: none; }

        .faq-item summary::after {
            content: '+';
            color: var(--brand-dark);
            font-size: 1.4rem;
            line-height: 1;
            flex-shrink: 0;
        }

        .faq-item[open] summary::after { content: '–'; }

        .faq-item p {
            padding: 0 0 1.15rem;
            color: var(--muted);
            max-width: 62ch;
        }

        .contact {
            background:
                radial-gradient(circle at {{ $isRTL ? 'right' : 'left' }} top, rgba(24, 181, 150, 0.1), transparent 30%),
                var(--white);
        }

        .contact-layout {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 2rem;
            align-items: start;
        }

        .contact-aside {
            padding: 1.6rem 0;
        }

        .contact-aside .phone {
            display: inline-block;
            margin: 1rem 0 1.2rem;
            font-size: 1.35rem;
            font-weight: 800;
            direction: ltr;
            unicode-bidi: bidi-override;
            color: var(--brand-dark);
        }

        .contact-form {
            padding: 1.5rem;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, #ffffff 0%, #f7fbfa 100%);
            border-radius: var(--radius);
        }

        .form-note {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--brand-dark);
            margin-bottom: 1rem;
        }

        .form-group { margin-bottom: 0.95rem; }

        .form-group label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1.5px solid #d7e4e0;
            border-radius: 12px;
            background: var(--white);
            color: var(--ink);
            font-size: 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(24, 181, 150, 0.12);
        }

        .form-group textarea { min-height: 110px; resize: vertical; }

        .submit-button { width: 100%; }

        .error-message {
            margin-top: 0.35rem;
            color: #b42318;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .success-message {
            margin-top: 1rem;
            padding: 0.95rem 1rem;
            border-radius: 12px;
            background: #ecfdf3;
            color: #067647;
            font-weight: 700;
            border: 1px solid #abefc6;
        }

        footer {
            background: #0f1f1c;
            color: rgba(255, 255, 255, 0.82);
            padding: 3rem 0 1.5rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand img {
            height: 42px;
            width: auto;
            max-width: 240px;
            margin-bottom: 0.9rem;
            filter: brightness(0) invert(1);
            opacity: 0.95;
        }

        .footer-brand p {
            max-width: 34ch;
            font-size: 0.92rem;
            line-height: 1.75;
        }

        .footer-grid h3 {
            color: var(--white);
            font-size: 1rem;
            margin-bottom: 0.9rem;
        }

        .footer-grid a {
            display: block;
            margin-bottom: 0.55rem;
            font-size: 0.92rem;
            color: rgba(255, 255, 255, 0.72);
            transition: color 0.2s ease;
        }

        .footer-grid a:hover { color: #7de3cb; }

        .footer-phone {
            direction: ltr;
            unicode-bidi: bidi-override;
            display: inline-block;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.2rem;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.55);
            text-align: center;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 22px;
            {{ $isRTL ? 'left' : 'right' }}: 22px;
            z-index: 1200;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            box-shadow: 0 10px 28px rgba(37, 211, 102, 0.4);
            transition: transform 0.25s ease;
        }

        .whatsapp-float:hover { transform: translateY(-3px) scale(1.05); }

        .whatsapp-float svg { width: 28px; height: 28px; fill: #fff; }

        .whatsapp-float::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid rgba(37, 211, 102, 0.45);
            animation: pulse 2s infinite;
        }

        .menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(8, 32, 28, 0.4);
            z-index: 998;
        }

        .menu-overlay.active { display: block; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes heroZoom {
            from { transform: scale(1.04); }
            to { transform: scale(1.1); }
        }

        @keyframes pulse {
            from { transform: scale(1); opacity: 0.8; }
            to { transform: scale(1.45); opacity: 0; }
        }

        @media (max-width: 980px) {
            .hamburger { display: flex; }

            .nav-menu {
                position: fixed;
                top: var(--nav-h);
                inset-inline: 1rem;
                display: none;
                flex-direction: column;
                align-items: stretch;
                gap: 0.2rem;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.98);
                border: 1px solid var(--line);
                border-radius: 16px;
                box-shadow: var(--shadow);
                z-index: 999;
            }

            .nav-menu.active { display: flex; }

            .nav-actions { display: none; }

            .nav-menu .mobile-only {
                display: flex;
                flex-direction: column;
                gap: 0.7rem;
                margin-top: 0.7rem;
                padding-top: 0.9rem;
                border-top: 1px solid var(--line);
            }

            .trust-list { grid-template-columns: repeat(2, 1fr); }
            .trust-list li:nth-child(2)::after { display: none; }

            .feature-grid,
            .steps,
            .subject-grid,
            .contact-layout,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .hero-content {
                padding-bottom: 3.2rem;
                max-width: 100%;
            }

            .hero h1 { max-width: 100%; }
        }

        @media (max-width: 640px) {
            :root { --nav-h: 64px; }

            .container,
            .hero-content { width: min(100% - 1.5rem, var(--container)); }

            section { padding: 3.5rem 0; }

            .logo img { height: 34px; max-width: 180px; }

            .hero-actions .btn { width: 100%; }

            .trust-list { gap: 0.35rem; }

            .trust-list li::after { display: none; }

            .contact-form { padding: 1.15rem; }

            .whatsapp-float {
                width: 54px;
                height: 54px;
                bottom: 16px;
                {{ $isRTL ? 'left' : 'right' }}: 16px;
            }
        }

        .desktop-only { display: flex; }
        .mobile-only { display: none; }

        @media (max-width: 980px) {
            .desktop-only { display: none !important; }
            .mobile-only { display: flex; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar" aria-label="{{ $isRTL ? 'القائمة الرئيسية' : 'Main navigation' }}">
        <div class="nav-inner">
            <a href="#home" class="logo">
                <img src="{{ asset('200-600 out icon gr -- EH.png') }}" alt="{{ __('messages.brand.name') }}">
            </a>

            <ul class="nav-menu" id="navMenu">
                <li><a href="#about">{{ __('messages.nav.about') }}</a></li>
                <li><a href="#how">{{ __('messages.nav.how') }}</a></li>
                <li><a href="#subjects">{{ __('messages.nav.subjects') }}</a></li>
                <li><a href="#pricing">{{ __('messages.nav.pricing') }}</a></li>
                <li><a href="#faq">{{ __('messages.nav.faq') }}</a></li>
                <li><a href="{{ route('blog.index') }}">{{ __('messages.nav.blog') }}</a></li>
                <li><a href="#contact">{{ __('messages.nav.contact') }}</a></li>
                <li class="mobile-only">
                    <div class="lang-switch">
                        <a href="{{ route('language.switch', 'ar') }}" class="{{ $locale === 'ar' ? 'active' : '' }}">العربية</a>
                        <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">English</a>
                    </div>
                    <a href="#contact" class="btn btn-primary" data-analytics-event="click_booking" data-analytics-location="nav_mobile">
                        {{ __('messages.nav.register') }}
                    </a>
                </li>
            </ul>

            <div class="nav-actions desktop-only">
                <div class="lang-switch">
                    <a href="{{ route('language.switch', 'ar') }}" class="{{ $locale === 'ar' ? 'active' : '' }}">العربية</a>
                    <a href="{{ route('language.switch', 'en') }}" class="{{ $locale === 'en' ? 'active' : '' }}">English</a>
                </div>
                <a href="#contact" class="btn btn-primary" data-analytics-event="click_booking" data-analytics-location="nav">
                    {{ __('messages.nav.register') }}
                </a>
            </div>

            <button class="hamburger" id="hamburger" type="button" aria-label="{{ $isRTL ? 'فتح القائمة' : 'Open menu' }}" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>
    <div class="menu-overlay" id="menuOverlay"></div>

    <header class="hero" id="home">
        <div class="hero-media">
            <img src="{{ asset('studentimg.jpeg') }}" alt="{{ __('messages.hero.image_alt') }}">
        </div>
        <div class="hero-shade" aria-hidden="true"></div>
        <div class="hero-content">
            <span class="brand-mark">{{ __('messages.brand.name') }}</span>
            <h1>{{ __('messages.hero.title') }}</h1>
            <p class="hero-lead">{{ __('messages.hero.description') }}</p>
            <div class="hero-actions">
                <a href="#contact" class="btn btn-primary" data-analytics-event="click_booking" data-analytics-location="hero">
                    {{ __('messages.hero.cta') }}
                </a>
                <a href="{{ $whatsappUrl }}" class="btn btn-secondary" target="_blank" rel="noopener noreferrer" data-analytics-event="click_whatsapp" data-analytics-location="hero">
                    {{ __('messages.hero.cta_whatsapp') }}
                </a>
            </div>
        </div>
    </header>

    <div class="trust">
        <div class="container">
            <ul class="trust-list">
                <li>{{ __('messages.trust.curriculum') }}</li>
                <li>{{ __('messages.trust.stages') }}</li>
                <li>{{ __('messages.trust.price') }}</li>
                <li>{{ __('messages.trust.live') }}</li>
            </ul>
        </div>
    </div>

    <section class="features" id="about">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('messages.features.title') }}</h2>
                <p>{{ __('messages.features.subtitle') }}</p>
            </div>
            <div class="feature-grid">
                <article class="feature-item">
                    <h3>{{ __('messages.features.curriculum_aligned.title') }}</h3>
                    <p>{{ __('messages.features.curriculum_aligned.description') }}</p>
                </article>
                <article class="feature-item">
                    <h3>{{ __('messages.features.certified_teachers.title') }}</h3>
                    <p>{{ __('messages.features.certified_teachers.description') }}</p>
                </article>
                <article class="feature-item">
                    <h3>{{ __('messages.features.track_progress.title') }}</h3>
                    <p>{{ __('messages.features.track_progress.description') }}</p>
                </article>
                <article class="feature-item">
                    <h3>{{ __('messages.features.anytime_learning.title') }}</h3>
                    <p>{{ __('messages.features.anytime_learning.description') }}</p>
                </article>
            </div>
        </div>
    </section>

    <section class="how" id="how">
        <div class="container">
            <div class="section-head center">
                <h2>{{ __('messages.how.title') }}</h2>
                <p>{{ __('messages.how.subtitle') }}</p>
            </div>
            <div class="steps">
                <article class="step">
                    <h3>{{ __('messages.how.step1_title') }}</h3>
                    <p>{{ __('messages.how.step1_text') }}</p>
                </article>
                <article class="step">
                    <h3>{{ __('messages.how.step2_title') }}</h3>
                    <p>{{ __('messages.how.step2_text') }}</p>
                </article>
                <article class="step">
                    <h3>{{ __('messages.how.step3_title') }}</h3>
                    <p>{{ __('messages.how.step3_text') }}</p>
                </article>
            </div>
        </div>
    </section>

    <section class="subjects" id="subjects">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('messages.subjects.title') }}</h2>
                <p>{{ __('messages.subjects.subtitle') }}</p>
            </div>
            <div class="subject-grid">
                @foreach($subjectLinks as $key => $slug)
                    @php
                        $href = $slug ? route('seo.show', $slug) : '#contact';
                    @endphp
                    <a class="subject-link" href="{{ $href }}">
                        <strong>{{ __('messages.subjects.' . $key) }}</strong>
                        <span>{{ __('messages.subjects.cta') }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="pricing" id="pricing">
        <div class="container">
            <div class="section-head center">
                <h2>{{ __('messages.pricing.title') }}</h2>
                <p>{{ __('messages.pricing.subtitle') }}</p>
            </div>
            <div class="price-panel">
                <div class="price-amount">
                    <span class="value">{{ __('messages.pricing.amount') }}</span>
                    <span class="currency">{{ __('messages.pricing.currency') }}</span>
                </div>
                <p class="price-unit">{{ __('messages.pricing.unit') }}</p>
                <p class="price-note">{{ __('messages.pricing.note') }}</p>
                <ul class="price-includes" aria-label="{{ __('messages.pricing.includes_title') }}">
                    <li>{{ __('messages.pricing.include_1') }}</li>
                    <li>{{ __('messages.pricing.include_2') }}</li>
                    <li>{{ __('messages.pricing.include_3') }}</li>
                </ul>
                <a href="#contact" class="btn btn-primary" data-analytics-event="click_booking" data-analytics-location="pricing">
                    {{ __('messages.pricing.cta') }}
                </a>
            </div>
        </div>
    </section>

    <section class="faq" id="faq">
        <div class="container">
            <div class="section-head center">
                <h2>{{ __('messages.faq.title') }}</h2>
                <p>{{ __('messages.faq.subtitle') }}</p>
            </div>
            <div class="faq-list">
                @foreach(__('messages.seo.faq') as $item)
                    <details class="faq-item">
                        <summary>{{ $item['question'] }}</summary>
                        <p>{{ $item['answer'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('messages.contact.title') }}</h2>
                <p>{{ __('messages.contact.subtitle') }}</p>
            </div>
            <div class="contact-layout">
                <div class="contact-aside">
                    <a href="tel:+966554966258" class="phone">966 55 496 6258</a>
                    <div>
                        <a href="{{ $whatsappUrl }}" class="btn btn-whatsapp" target="_blank" rel="noopener noreferrer" data-analytics-event="click_whatsapp" data-analytics-location="contact">
                            {{ __('messages.contact.whatsapp') }}
                        </a>
                    </div>
                </div>

                <div class="contact-form-wrap">
                    <form class="contact-form" action="{{ route('contact.store') }}" method="POST" novalidate>
                        @csrf
                        <p class="form-note">{{ __('messages.contact.or_form') }}</p>
                        <div class="form-group">
                            <label for="name">{{ __('messages.contact.name') }}</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name">
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('messages.contact.phone') }}</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel" inputmode="tel">
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">{{ __('messages.contact.message') }}</label>
                            <textarea id="message" name="message" placeholder="{{ __('messages.contact.message_placeholder') }}">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary submit-button">
                            {{ __('messages.contact.send') }}
                        </button>
                    </form>

                    @if(session('success'))
                        <div class="success-message">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="#home">
                        <img src="{{ asset('600-200_pp_wh_page-0001-removebg-preview (2).png') }}" alt="{{ __('messages.brand.name') }}">
                    </a>
                    <p>{{ __('messages.footer.description') }}</p>
                </div>
                <div>
                    <h3>{{ __('messages.footer.about_us') }}</h3>
                    <a href="#about">{{ __('messages.nav.about') }}</a>
                    <a href="#subjects">{{ __('messages.nav.subjects') }}</a>
                    <a href="#pricing">{{ __('messages.nav.pricing') }}</a>
                    <a href="{{ route('blog.index') }}">{{ __('messages.nav.blog') }}</a>
                    <a href="#contact">{{ __('messages.nav.contact') }}</a>
                </div>
                <div>
                    <h3>{{ __('messages.nav.contact') }}</h3>
                    <a href="tel:+966554966258"><span class="footer-phone">966 55 496 6258</span></a>
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" data-analytics-event="click_whatsapp" data-analytics-location="footer">
                        {{ __('messages.contact.whatsapp') }}
                    </a>
                    <a href="{{ route('terms') }}">{{ __('messages.footer.terms') }}</a>
                    <a href="{{ route('privacy') }}">{{ __('messages.footer.privacy') }}</a>
                    <a href="{{ route('refund') }}">{{ __('messages.footer.refund') }}</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>{{ __('messages.footer.copyright') }}</p>
            </div>
        </div>
    </footer>

    <a href="{{ $whatsappUrl }}" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="{{ __('messages.whatsapp_float.label') }}" data-analytics-event="click_whatsapp" data-analytics-location="float">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        function closeMenu() {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            hamburger.setAttribute('aria-expanded', 'false');
        }

        function openMenu() {
            hamburger.classList.add('active');
            navMenu.classList.add('active');
            menuOverlay.classList.add('active');
            hamburger.setAttribute('aria-expanded', 'true');
        }

        hamburger.addEventListener('click', () => {
            navMenu.classList.contains('active') ? closeMenu() : openMenu();
        });

        menuOverlay.addEventListener('click', closeMenu);

        document.querySelectorAll('.nav-menu a').forEach((link) => {
            link.addEventListener('click', closeMenu);
        });

        window.addEventListener('scroll', () => {
            document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });

        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (!href || href === '#') return;
                const target = document.querySelector(href);
                if (!target) return;
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        const contactForm = document.querySelector('.contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('.submit-button');
                const originalButtonText = submitButton.textContent;

                submitButton.disabled = true;
                submitButton.textContent = '{{ $locale === "ar" ? "جاري الإرسال..." : "Sending..." }}';

                const existingMessage = document.querySelector('.success-message');
                if (existingMessage) existingMessage.remove();

                this.querySelectorAll('.error-message').forEach((el) => el.remove());

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(async (response) => {
                    const data = await response.json().catch(() => ({}));
                    if (!response.ok) {
                        if (response.status === 422 && data.errors) {
                            Object.keys(data.errors).forEach((field) => {
                                const input = this.querySelector('[name="' + field + '"]');
                                if (!input) return;
                                const error = document.createElement('div');
                                error.className = 'error-message';
                                error.textContent = data.errors[field][0];
                                input.parentElement.appendChild(error);
                            });
                            throw new Error('validation');
                        }
                        throw new Error('network');
                    }
                    return data;
                })
                .then((data) => {
                    if (window.InskolaAnalytics) {
                        window.InskolaAnalytics.bookingSubmit('contact_form');
                    }
                    showSuccessMessage((data && data.message) ? data.message : @json(__('messages.contact.success')));
                    this.reset();
                })
                .catch((error) => {
                    if (error.message === 'validation') return;
                    const fail = document.createElement('div');
                    fail.className = 'error-message';
                    fail.style.marginTop = '0.75rem';
                    fail.textContent = '{{ $locale === "ar" ? "تعذر الإرسال. حاول مرة أخرى أو تواصل عبر واتساب." : "Could not send. Please try again or use WhatsApp." }}';
                    this.appendChild(fail);
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.textContent = originalButtonText;
                });
            });
        }

        function showSuccessMessage(message) {
            const existingMessage = document.querySelector('.success-message');
            if (existingMessage) existingMessage.remove();

            const successDiv = document.createElement('div');
            successDiv.className = 'success-message';
            successDiv.textContent = message;

            const wrap = document.querySelector('.contact-form-wrap');
            if (wrap) {
                wrap.appendChild(successDiv);
                successDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    </script>
</body>
</html>

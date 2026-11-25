@extends('layouts.seo')

@section('seo')
    @php
        $seoTitle = $content['title'];
        $seoDescription = $content['meta_description'];
        $seoKeywords = $content['keywords'];
        $seoCanonical = route('seo.show', $slug);
        $seoType = 'website';
        $seoImage = asset(config('seo.og_image'));
        $price = __('messages.pricing.amount');
        $currency = $locale === 'ar' ? 'SAR' : 'SAR';
        $whatsappText = $content['whatsapp_text'];
        $seoJsonLd = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => $content['h1'],
                'description' => $seoDescription,
                'provider' => [
                    '@type' => 'EducationalOrganization',
                    'name' => config('seo.organization.name'),
                    'url' => route('home'),
                    'telephone' => config('seo.phone'),
                ],
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'Saudi Arabia',
                ],
                'offers' => [
                    '@type' => 'Offer',
                    'price' => $price,
                    'priceCurrency' => $currency,
                    'availability' => 'https://schema.org/InStock',
                    'url' => $seoCanonical,
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => __('messages.nav.home'),
                        'item' => route('home'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => $content['nav_label'],
                        'item' => $seoCanonical,
                    ],
                ],
            ],
        ];
    @endphp
    @include('partials.seo', [
        'locale' => $locale,
        'seoTitle' => $seoTitle,
        'seoDescription' => $seoDescription,
        'seoKeywords' => $seoKeywords,
        'seoCanonical' => $seoCanonical,
        'seoType' => $seoType,
        'seoImage' => $seoImage,
        'seoJsonLd' => $seoJsonLd,
    ])
@endsection

@section('content')
    @php
        $waUrl = 'https://wa.me/' . config('seo.whatsapp') . '?text=' . rawurlencode($content['whatsapp_text']);
        $isRTL = $locale === 'ar';
    @endphp

    <nav class="breadcrumb" aria-label="breadcrumb">
        <a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
        <span>/</span>
        <span>{{ $content['nav_label'] }}</span>
    </nav>

    <section class="hero-block">
        <h1>{{ $content['h1'] }}</h1>
        <p class="intro">{{ $content['intro'] }}</p>
        <div class="cta-row">
            <a href="{{ route('home') }}#contact"
               class="btn btn-primary"
               data-analytics-event="click_booking"
               data-analytics-location="seo_hero_{{ $slug }}">
                {{ $content['cta'] }}
            </a>
            <a href="{{ $waUrl }}"
               class="btn btn-secondary"
               target="_blank"
               rel="noopener noreferrer"
               data-analytics-event="click_whatsapp"
               data-analytics-location="seo_hero_{{ $slug }}">
                {{ __('messages.contact.whatsapp') }}
            </a>
        </div>
    </section>

    @foreach($content['body'] as $block)
        <section class="content-section">
            <h2>{{ $block['heading'] }}</h2>
            <p>{{ $block['text'] }}</p>
        </section>
    @endforeach

    <ul class="bullets">
        @foreach($content['bullets'] as $bullet)
            <li>{{ $bullet }}</li>
        @endforeach
    </ul>

    <div class="price-note">
        <p>
            @if($isRTL)
                سعر الحصة الواحدة: <strong>{{ __('messages.pricing.amount') }} {{ __('messages.pricing.currency') }}</strong>
            @else
                Lesson price: <strong>{{ __('messages.pricing.amount') }} {{ __('messages.pricing.currency') }}</strong>
            @endif
        </p>
        <p style="opacity:0.95;margin-top:0.35rem;">{{ __('messages.pricing.note') }}</p>
    </div>

    @if(!empty($related))
        <section class="related">
            <h2>{{ $isRTL ? 'صفحات ذات صلة' : 'Related pages' }}</h2>
            <div class="related-grid">
                @foreach($related as $item)
                    <a href="{{ route('seo.show', $item['slug']) }}">{{ $item['label'] }}</a>
                @endforeach
            </div>
        </section>
    @endif

    <div class="bottom-cta">
        <p>{{ $isRTL ? 'جاهز تبدأ؟ احجز حصة مباشرة خلال دقائق.' : 'Ready to start? Book a live lesson in minutes.' }}</p>
        <div class="cta-row" style="justify-content:center;">
            <a href="{{ route('home') }}#contact"
               class="btn btn-primary"
               data-analytics-event="click_booking"
               data-analytics-location="seo_bottom_{{ $slug }}">
                {{ $content['cta'] }}
            </a>
            <a href="{{ $waUrl }}"
               class="btn btn-secondary"
               target="_blank"
               rel="noopener noreferrer"
               data-analytics-event="click_whatsapp"
               data-analytics-location="seo_bottom_{{ $slug }}">
                WhatsApp
            </a>
        </div>
    </div>
@endsection

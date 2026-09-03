@php
    $locale = $locale ?? app()->getLocale();
    $seoConfig = config('seo');

    $seoTitle = $seoTitle
        ?? ($locale === 'ar' ? $seoConfig['default_title']['ar'] : $seoConfig['default_title']['en']);

    $seoDescription = $seoDescription
        ?? ($locale === 'ar' ? $seoConfig['default_description']['ar'] : $seoConfig['default_description']['en']);

    $seoKeywords = $seoKeywords
        ?? ($locale === 'ar' ? $seoConfig['default_keywords']['ar'] : $seoConfig['default_keywords']['en']);

    $seoCanonical = $seoCanonical ?? url()->current();
    $seoRobots = $seoRobots ?? $seoConfig['robots'];
    $seoType = $seoType ?? 'website';
    $seoImage = $seoImage ?? asset($seoConfig['og_image']);
    $siteName = $locale === 'ar' ? $seoConfig['site_name']['ar'] : $seoConfig['site_name']['en'];
    $seoJsonLd = $seoJsonLd ?? [];
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="author" content="{{ $siteName }}">
<meta name="geo.region" content="SA">
<meta name="geo.placename" content="Saudi Arabia">
<link rel="canonical" href="{{ $seoCanonical }}">

<meta property="og:locale" content="{{ $locale === 'ar' ? 'ar_SA' : 'en_US' }}">
<meta property="og:type" content="{{ $seoType }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:image:alt" content="{{ $seoTitle }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
@if(!empty($seoConfig['twitter_handle']))
<meta name="twitter:site" content="{{ $seoConfig['twitter_handle'] }}">
@endif

@if(!empty($seoHreflang) && is_array($seoHreflang))
    @foreach($seoHreflang as $lang => $url)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $url }}">
    @endforeach
@else
    <link rel="alternate" hreflang="ar" href="{{ $seoCanonical }}">
    <link rel="alternate" hreflang="x-default" href="{{ $seoCanonical }}">
@endif

@foreach($seoJsonLd as $schema)
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
@endforeach

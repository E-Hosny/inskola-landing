@extends('layouts.blog')

@section('seo')
    @php
        $pageLocale = $locale ?? app()->getLocale();
        $seoTitle = $article->seo_title . ' | ' . config('seo.site_name.' . $pageLocale);
        $seoDescription = $article->seo_description;
        $seoImage = $article->cover_url ?: asset(config('seo.og_image'));
        $seoCanonical = route('blog.show', $article->slug);
    @endphp
    @include('partials.seo', [
        'locale' => $pageLocale,
        'seoTitle' => $seoTitle,
        'seoDescription' => $seoDescription,
        'seoKeywords' => $article->meta_keywords ?: __('messages.blog.index_seo_keywords'),
        'seoCanonical' => $seoCanonical,
        'seoType' => 'article',
        'seoImage' => $seoImage,
        'seoJsonLd' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $article->title,
                'description' => $seoDescription,
                'image' => [$seoImage],
                'datePublished' => optional($article->published_at)->toAtomString(),
                'dateModified' => optional($article->updated_at)->toAtomString(),
                'author' => [
                    '@type' => 'Organization',
                    'name' => config('seo.organization.name'),
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => config('seo.organization.name'),
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('200-600 out icon gr -- EH.png'),
                    ],
                ],
                'mainEntityOfPage' => $seoCanonical,
                'inLanguage' => $article->locale === 'ar' ? 'ar-SA' : 'en-US',
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
                        'name' => __('messages.nav.blog'),
                        'item' => route('blog.index'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 3,
                        'name' => $article->title,
                        'item' => $seoCanonical,
                    ],
                ],
            ],
        ],
    ])
@endsection

@section('content')
    @php $isRTL = ($locale ?? app()->getLocale()) === 'ar'; @endphp

    <main class="blog-container" style="padding-top: 2rem;">
        <nav class="breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home') }}">{{ __('messages.nav.home') }}</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}">{{ __('messages.nav.blog') }}</a>
            <span>/</span>
            <span>{{ \Illuminate\Support\Str::limit($article->title, 48) }}</span>
        </nav>

        <article>
            <header class="article-hero">
                <div class="article-meta">
                    <span>{{ optional($article->published_at)->translatedFormat($isRTL ? 'd F Y' : 'M d, Y') }}</span>
                    <span>{{ $article->reading_time }} {{ __('messages.blog.min_read') }}</span>
                </div>
                <h1>{{ $article->title }}</h1>
                @if($article->excerpt)
                    <p style="color: var(--text-light); font-size: 1.05rem;">{{ $article->excerpt }}</p>
                @endif
            </header>

            @if($article->cover_url)
                <div class="article-cover">
                    <img src="{{ $article->cover_url }}" alt="{{ $article->title }}">
                </div>
            @endif

            <div class="article-content">
                {!! $article->content !!}
            </div>

            <div class="cta-box">
                <p>{{ __('messages.blog.cta_text') }}</p>
                <a href="{{ route('home') }}#contact" class="btn-primary">{{ __('messages.blog.cta_button') }}</a>
            </div>
        </article>

        @if($related->count())
            <section class="related-section">
                <h2>{{ __('messages.blog.related') }}</h2>
                <div class="articles-grid">
                    @foreach($related as $item)
                        <article class="article-card">
                            <a href="{{ route('blog.show', $item->slug) }}" class="article-card-cover" aria-label="{{ $item->title }}">
                                @if($item->cover_url)
                                    <img src="{{ $item->cover_url }}" alt="{{ $item->title }}">
                                @endif
                            </a>
                            <div class="article-card-body">
                                <h2>
                                    <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                                </h2>
                                <p>{{ $item->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
@endsection

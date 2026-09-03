@extends('layouts.blog')

@section('seo')
    @include('partials.seo', [
        'locale' => $locale ?? app()->getLocale(),
        'seoTitle' => __('messages.blog.index_seo_title'),
        'seoDescription' => __('messages.blog.index_seo_description'),
        'seoKeywords' => __('messages.blog.index_seo_keywords'),
        'seoCanonical' => route('blog.index'),
        'seoType' => 'website',
        'seoJsonLd' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                'name' => __('messages.blog.index_seo_title'),
                'description' => __('messages.blog.index_seo_description'),
                'url' => route('blog.index'),
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => config('seo.site_name.' . ($locale ?? 'ar')),
                    'url' => route('home'),
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
                        'name' => __('messages.nav.blog'),
                        'item' => route('blog.index'),
                    ],
                ],
            ],
        ],
    ])
@endsection

@section('content')
    @php $isRTL = ($locale ?? app()->getLocale()) === 'ar'; @endphp

    <header class="page-hero">
        <h1>{{ __('messages.blog.title') }}</h1>
        <p>{{ __('messages.blog.subtitle') }}</p>
    </header>

    <main class="blog-container">
        @if($articles->count())
            <div class="articles-grid">
                @foreach($articles as $article)
                    <article class="article-card">
                        <a href="{{ route('blog.show', $article->slug) }}" class="article-card-cover" aria-label="{{ $article->title }}">
                            @if($article->cover_url)
                                <img src="{{ $article->cover_url }}" alt="{{ $article->title }}">
                            @endif
                        </a>
                        <div class="article-card-body">
                            <div class="article-meta">
                                <span>{{ optional($article->published_at)->translatedFormat($isRTL ? 'd F Y' : 'M d, Y') }}</span>
                                <span>{{ $article->reading_time }} {{ __('messages.blog.min_read') }}</span>
                            </div>
                            <h2>
                                <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p>{{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 140) }}</p>
                            <a class="read-more" href="{{ route('blog.show', $article->slug) }}">{{ __('messages.blog.read_more') }}</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination-wrap">
                {{ $articles->links('pagination.simple') }}
            </div>
        @else
            <div class="empty-state">
                <h2>{{ __('messages.blog.empty_title') }}</h2>
                <p>{{ __('messages.blog.empty_text') }}</p>
            </div>
        @endif
    </main>
@endsection

@extends('layouts.legal')

@section('title', __('messages.terms_page.title'))
@section('seo_description', __('messages.terms_page.subtitle'))
@section('page_title', __('messages.terms_page.title'))
@section('page_subtitle', __('messages.terms_page.subtitle'))

@section('content')
    @foreach(__('messages.terms_page.sections') as $index => $section)
        <section class="terms-section" id="section-{{ $index + 1 }}">
            <h2>{{ $section['title'] }}</h2>
            <ol>
                @foreach($section['items'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </section>
    @endforeach
@endsection

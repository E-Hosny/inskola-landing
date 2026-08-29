@extends('layouts.legal')

@section('title', __('messages.refund_page.title'))
@section('page_title', __('messages.refund_page.title'))
@section('page_subtitle', __('messages.refund_page.subtitle'))

@section('content')
    <section class="terms-section">
        <h2>{{ __('messages.refund_page.section_title') }}</h2>
        <ol>
            @foreach(__('messages.refund_page.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ol>
    </section>
@endsection

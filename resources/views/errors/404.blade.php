@php
    $locale = session('locale', 'ar');
    app()->setLocale($locale);
    $isRTL = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, follow">
    <title>{{ $isRTL ? 'الصفحة غير موجودة | إنسكولا' : 'Page not found | Inskola' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#18b596; --dark:#149479; --text:#2c3e50; }
        body {
            margin:0; min-height:100vh; display:flex; align-items:center; justify-content:center;
            font-family: {{ $isRTL ? "'Cairo'" : "'Poppins'" }}, sans-serif;
            background: linear-gradient(160deg, #f7faf9, #ffffff 45%, #eef8f5);
            color: var(--text); padding: 1.5rem; text-align:center;
        }
        .box { max-width: 520px; }
        h1 { color: var(--dark); font-size: 2rem; margin-bottom: 0.7rem; }
        p { margin-bottom: 1.4rem; line-height: 1.7; }
        a {
            display:inline-block; background: linear-gradient(135deg,#18b596,#149479);
            color:#fff; text-decoration:none; font-weight:700; border-radius:12px; padding:0.85rem 1.3rem;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>404</h1>
        <p>{{ $isRTL ? 'عذراً، الصفحة التي تبحث عنها غير موجودة.' : 'Sorry, the page you are looking for does not exist.' }}</p>
        <a href="{{ url('/') }}">{{ $isRTL ? 'العودة للرئيسية' : 'Back to home' }}</a>
    </div>
</body>
</html>

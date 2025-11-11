@php
    $locale = app()->getLocale();
    $isRTL = $locale === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $isRTL ? 'تسجيل الدخول - لوحة التحكم' : 'Login - Admin Dashboard' }}</title>
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
            --border-color: #e0e0e0;
            --error-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(24, 181, 150, 0.1);
        }

        .form-group input::placeholder {
            color: var(--text-light);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me input {
            width: auto;
            margin-{{ $isRTL ? 'left' : 'right' }}: 0.5rem;
            cursor: pointer;
        }

        .remember-me label {
            color: var(--text-light);
            font-size: 0.9rem;
            cursor: pointer;
            margin: 0;
        }

        .error-message {
            background: rgba(220, 53, 69, 0.1);
            color: var(--error-color);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            border-left: 3px solid var(--error-color);
        }

        .submit-button {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(24, 181, 150, 0.3);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>{{ $isRTL ? 'تسجيل الدخول' : 'Login' }}</h1>
            <p>{{ $isRTL ? 'لوحة تحكم الأدمن' : 'Admin Dashboard' }}</p>
        </div>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ $isRTL ? 'البريد الإلكتروني' : 'Email' }}</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    placeholder="{{ $isRTL ? 'أدخل بريدك الإلكتروني' : 'Enter your email' }}"
                >
            </div>

            <div class="form-group">
                <label for="password">{{ $isRTL ? 'كلمة المرور' : 'Password' }}</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="{{ $isRTL ? 'أدخل كلمة المرور' : 'Enter your password' }}"
                >
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">{{ $isRTL ? 'تذكرني' : 'Remember me' }}</label>
            </div>

            <button type="submit" class="submit-button">
                {{ $isRTL ? 'تسجيل الدخول' : 'Login' }}
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            {{ $isRTL ? '← العودة للصفحة الرئيسية' : '← Back to Home' }}
        </a>
    </div>
</body>
</html>


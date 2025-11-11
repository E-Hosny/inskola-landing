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
    <title>{{ $isRTL ? 'لوحة التحكم - الطلبات' : 'Admin Dashboard - Contacts' }}</title>
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(24, 181, 150, 0.2);
        }

        .admin-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .admin-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .admin-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .back-link {
            display: inline-block;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-dark);
            transform: translateX({{ $isRTL ? '5px' : '-5px' }});
        }

        .logout-form {
            display: inline-block;
        }

        .logout-button {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 2px solid #dc3545;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .logout-button:hover {
            background: #dc3545;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .contacts-table {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--bg-light);
        }

        th {
            padding: 1rem;
            text-align: {{ $isRTL ? 'right' : 'left' }};
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.9rem;
            border-bottom: 2px solid var(--border-color);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        tbody tr:hover {
            background: var(--bg-light);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-light);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-new {
            background: rgba(24, 181, 150, 0.1);
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }

            .admin-header {
                padding: 1.5rem;
            }

            .admin-header h1 {
                font-size: 1.5rem;
            }

            table {
                font-size: 0.85rem;
            }

            th, td {
                padding: 0.7rem 0.5rem;
            }

            .contacts-table {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-actions">
            <a href="{{ route('home') }}" class="back-link">
                {{ $isRTL ? '← العودة للصفحة الرئيسية' : '← Back to Home' }}
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">
                    {{ $isRTL ? 'تسجيل الخروج' : 'Logout' }}
                </button>
            </form>
        </div>

        <div class="admin-header">
            <h1>{{ $isRTL ? 'لوحة التحكم - الطلبات' : 'Admin Dashboard - Contacts' }}</h1>
            <p>{{ $isRTL ? 'عرض جميع طلبات التواصل' : 'View all contact requests' }}</p>
        </div>

        <div class="contacts-table">
            @if($contacts->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>{{ $isRTL ? '#' : '#' }}</th>
                            <th>{{ $isRTL ? 'الاسم' : 'Name' }}</th>
                            <th>{{ $isRTL ? 'رقم الجوال' : 'Phone' }}</th>
                            <th>{{ $isRTL ? 'الرسالة' : 'Message' }}</th>
                            <th>{{ $isRTL ? 'التاريخ' : 'Date' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $index => $contact)
                            <tr>
                                <td>{{ $contacts->count() - $index }}</td>
                                <td>{{ $contact->name ?: ($isRTL ? 'غير محدد' : 'Not specified') }}</td>
                                <td>{{ $contact->phone ?: ($isRTL ? 'غير محدد' : 'Not specified') }}</td>
                                <td>{{ $contact->message ?: ($isRTL ? 'لا توجد رسالة' : 'No message') }}</td>
                                <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <h3>{{ $isRTL ? 'لا توجد طلبات' : 'No Contacts' }}</h3>
                    <p>{{ $isRTL ? 'لم يتم إرسال أي طلبات بعد' : 'No contact requests yet' }}</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>


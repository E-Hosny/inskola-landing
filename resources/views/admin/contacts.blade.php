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
            --danger: #dc3545;
            --warning: #f59e0b;
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
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

        .logout-button {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 2px solid var(--danger);
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .logout-button:hover {
            background: var(--danger);
            color: var(--white);
        }

        .alert-success {
            background: rgba(24, 181, 150, 0.12);
            color: var(--primary-dark);
            border: 1px solid rgba(24, 181, 150, 0.25);
            padding: 0.85rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: var(--white);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            min-width: 140px;
        }

        .stat-card strong {
            display: block;
            font-size: 1.4rem;
            color: var(--primary-color);
        }

        .stat-card span {
            font-size: 0.85rem;
            color: var(--text-light);
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
            padding: 0.9rem 0.75rem;
            text-align: {{ $isRTL ? 'right' : 'left' }};
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.85rem;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
        }

        td {
            padding: 0.9rem 0.75rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.88rem;
            vertical-align: top;
        }

        tbody tr:hover {
            background: #fafbfc;
        }

        tbody tr.row-marked {
            background: rgba(24, 181, 150, 0.04);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .message-cell {
            max-width: 220px;
            word-break: break-word;
        }

        .badge {
            display: inline-block;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-new {
            background: rgba(245, 158, 11, 0.12);
            color: #b45309;
        }

        .badge-marked {
            background: rgba(24, 181, 150, 0.12);
            color: var(--primary-dark);
        }

        .note-form {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            min-width: 200px;
        }

        .note-form textarea {
            width: 100%;
            min-height: 70px;
            padding: 0.55rem 0.65rem;
            border: 1.5px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.85rem;
            resize: vertical;
            background: var(--bg-light);
        }

        .note-form textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--white);
        }

        .mark-label {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            user-select: none;
        }

        .mark-label input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary-color);
        }

        .form-actions {
            display: flex;
            gap: 0.45rem;
            flex-wrap: wrap;
        }

        .btn-save {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-save:hover {
            background: var(--primary-dark);
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.08);
            color: var(--danger);
            border: 1.5px solid rgba(220, 53, 69, 0.35);
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: var(--white);
            border-color: var(--danger);
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

        @media (max-width: 992px) {
            .admin-container {
                padding: 1rem;
            }

            .contacts-table {
                overflow-x: auto;
            }

            table {
                min-width: 980px;
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
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    {{ $isRTL ? 'تسجيل الخروج' : 'Logout' }}
                </button>
            </form>
        </div>

        <div class="admin-header">
            <h1>{{ $isRTL ? 'لوحة التحكم - الطلبات' : 'Admin Dashboard - Contacts' }}</h1>
            <p>{{ $isRTL ? 'عرض وإدارة جميع طلبات التواصل' : 'View and manage all contact requests' }}</p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="stats-row">
            <div class="stat-card">
                <strong>{{ $contacts->count() }}</strong>
                <span>{{ $isRTL ? 'إجمالي الرسائل' : 'Total Messages' }}</span>
            </div>
            <div class="stat-card">
                <strong>{{ $contacts->where('is_marked', false)->count() }}</strong>
                <span>{{ $isRTL ? 'غير معلّمة' : 'Unmarked' }}</span>
            </div>
            <div class="stat-card">
                <strong>{{ $contacts->where('is_marked', true)->count() }}</strong>
                <span>{{ $isRTL ? 'معلّمة' : 'Marked' }}</span>
            </div>
        </div>

        <div class="contacts-table">
            @if($contacts->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>{{ $isRTL ? '#' : '#' }}</th>
                            <th>{{ $isRTL ? 'الحالة' : 'Status' }}</th>
                            <th>{{ $isRTL ? 'الاسم' : 'Name' }}</th>
                            <th>{{ $isRTL ? 'رقم الجوال' : 'Phone' }}</th>
                            <th>{{ $isRTL ? 'الرسالة' : 'Message' }}</th>
                            <th>{{ $isRTL ? 'التاريخ' : 'Date' }}</th>
                            <th>{{ $isRTL ? 'الملاحظة والإجراءات' : 'Note & Actions' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $index => $contact)
                            <tr class="{{ $contact->is_marked ? 'row-marked' : '' }}">
                                <td>{{ $contacts->count() - $index }}</td>
                                <td>
                                    @if($contact->is_marked)
                                        <span class="badge badge-marked">{{ $isRTL ? 'معلّمة' : 'Marked' }}</span>
                                    @else
                                        <span class="badge badge-new">{{ $isRTL ? 'جديدة' : 'New' }}</span>
                                    @endif
                                </td>
                                <td>{{ $contact->name ?: ($isRTL ? 'غير محدد' : 'Not specified') }}</td>
                                <td dir="ltr" style="text-align: {{ $isRTL ? 'right' : 'left' }};">
                                    {{ $contact->phone ?: ($isRTL ? 'غير محدد' : 'Not specified') }}
                                </td>
                                <td class="message-cell">{{ $contact->message ?: ($isRTL ? 'لا توجد رسالة' : 'No message') }}</td>
                                <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form class="note-form" method="POST" action="{{ route('admin.contacts.update', $contact) }}">
                                        @csrf
                                        @method('PATCH')
                                        <textarea name="admin_note" placeholder="{{ $isRTL ? 'أضف ملاحظة...' : 'Add a note...' }}">{{ old('admin_note', $contact->admin_note) }}</textarea>
                                        <label class="mark-label">
                                            <input type="checkbox" name="is_marked" value="1" {{ $contact->is_marked ? 'checked' : '' }}>
                                            <span>{{ $isRTL ? 'تعليم الرسالة كمُعالجة' : 'Mark as handled' }}</span>
                                        </label>
                                        <div class="form-actions">
                                            <button type="submit" class="btn-save">{{ $isRTL ? 'حفظ' : 'Save' }}</button>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" style="margin-top: 0.5rem;" onsubmit="return confirm('{{ $isRTL ? 'هل أنت متأكد من حذف هذه الرسالة؟' : 'Are you sure you want to delete this message?' }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">{{ $isRTL ? 'حذف' : 'Delete' }}</button>
                                    </form>
                                </td>
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

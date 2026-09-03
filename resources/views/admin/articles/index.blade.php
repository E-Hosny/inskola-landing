@php
    $isRTL = ($locale ?? app()->getLocale()) === 'ar';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $isRTL ? 'إدارة المقالات' : 'Manage Articles' }}</title>
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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        .admin-container { max-width: 1400px; margin: 0 auto; padding: 2rem; }
        .admin-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .back-link { color: var(--primary-color); text-decoration: none; font-weight: 600; }
        .logout-button {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 2px solid var(--danger);
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
        }
        .admin-nav {
            display: flex;
            gap: 0.6rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .admin-nav a {
            text-decoration: none;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.85rem;
            background: rgba(24, 181, 150, 0.08);
            color: var(--primary-dark);
            border: 1px solid rgba(24, 181, 150, 0.18);
        }
        .admin-nav a.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }
        .admin-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }
        .admin-header h1 { font-size: 1.8rem; margin-bottom: 0.4rem; }
        .btn-new {
            background: var(--white);
            color: var(--primary-dark);
            text-decoration: none;
            padding: 0.7rem 1.1rem;
            border-radius: 8px;
            font-weight: 800;
        }
        .alert-success {
            background: rgba(24, 181, 150, 0.12);
            color: var(--primary-dark);
            border: 1px solid rgba(24, 181, 150, 0.25);
            padding: 0.85rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .articles-table {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.9rem 1rem; border-bottom: 1px solid var(--border-color); text-align: {{ $isRTL ? 'right' : 'left' }}; vertical-align: top; }
        th { background: #f3faf8; font-size: 0.85rem; }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-published { background: rgba(24, 181, 150, 0.12); color: var(--primary-dark); }
        .badge-draft { background: rgba(245, 158, 11, 0.12); color: #b45309; }
        .actions { display: flex; gap: 0.45rem; flex-wrap: wrap; }
        .btn-edit, .btn-view, .btn-delete {
            border-radius: 8px;
            padding: 0.4rem 0.75rem;
            font-weight: 700;
            font-size: 0.8rem;
            text-decoration: none;
            font-family: inherit;
            cursor: pointer;
            border: none;
        }
        .btn-edit { background: rgba(24, 181, 150, 0.12); color: var(--primary-dark); }
        .btn-view { background: var(--bg-light); color: var(--text-dark); border: 1px solid var(--border-color); }
        .btn-delete { background: rgba(220, 53, 69, 0.08); color: var(--danger); border: 1.5px solid rgba(220, 53, 69, 0.35); }
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--text-light); }
        .pagination-wrap { padding: 1rem; display: flex; justify-content: center; }
        @media (max-width: 900px) {
            .admin-container { padding: 1rem; }
            .articles-table { overflow-x: auto; }
            table { min-width: 860px; }
        }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="admin-actions">
        <a href="{{ route('home') }}" class="back-link">{{ $isRTL ? '← العودة للصفحة الرئيسية' : '← Back to Home' }}</a>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">{{ $isRTL ? 'تسجيل الخروج' : 'Logout' }}</button>
        </form>
    </div>

    <div class="admin-nav">
        <a href="{{ route('admin.contacts') }}">{{ $isRTL ? 'الطلبات' : 'Contacts' }}</a>
        <a href="{{ route('admin.articles.index') }}" class="active">{{ $isRTL ? 'المقالات' : 'Articles' }}</a>
    </div>

    <div class="admin-header">
        <div>
            <h1>{{ $isRTL ? 'إدارة المقالات' : 'Manage Articles' }}</h1>
            <p>{{ $isRTL ? 'انشر مقالاً أسبوعياً لتعزيز ظهورك في محركات البحث' : 'Publish weekly articles to grow your search visibility' }}</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn-new">{{ $isRTL ? '+ مقال جديد' : '+ New Article' }}</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="articles-table">
        @if($articles->count())
            <table>
                <thead>
                <tr>
                    <th>{{ $isRTL ? 'العنوان' : 'Title' }}</th>
                    <th>{{ $isRTL ? 'الحالة' : 'Status' }}</th>
                    <th>{{ $isRTL ? 'التاريخ' : 'Date' }}</th>
                    <th>{{ $isRTL ? 'وقت القراءة' : 'Read time' }}</th>
                    <th>{{ $isRTL ? 'إجراءات' : 'Actions' }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <strong>{{ $article->title }}</strong>
                            <div style="color: var(--text-light); font-size: 0.8rem; margin-top: 0.25rem;" dir="ltr">/blog/{{ $article->slug }}</div>
                        </td>
                        <td>
                            @if($article->status === 'published')
                                <span class="badge badge-published">{{ $isRTL ? 'منشور' : 'Published' }}</span>
                            @else
                                <span class="badge badge-draft">{{ $isRTL ? 'مسودة' : 'Draft' }}</span>
                            @endif
                        </td>
                        <td>{{ optional($article->published_at ?? $article->created_at)->format('Y-m-d H:i') }}</td>
                        <td>{{ $article->reading_time }} {{ $isRTL ? 'دقيقة' : 'min' }}</td>
                        <td>
                            <div class="actions">
                                @if($article->isPublished())
                                    <a class="btn-view" href="{{ route('blog.show', $article->slug) }}" target="_blank">{{ $isRTL ? 'عرض' : 'View' }}</a>
                                @endif
                                <a class="btn-edit" href="{{ route('admin.articles.edit', $article) }}">{{ $isRTL ? 'تعديل' : 'Edit' }}</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('{{ $isRTL ? 'حذف هذا المقال؟' : 'Delete this article?' }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">{{ $isRTL ? 'حذف' : 'Delete' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrap">
                {{ $articles->links('pagination.simple') }}
            </div>
        @else
            <div class="empty-state">
                <h3>{{ $isRTL ? 'لا توجد مقالات بعد' : 'No articles yet' }}</h3>
                <p>{{ $isRTL ? 'ابدأ بإنشاء أول مقال لتعزيز السيو' : 'Create your first article to boost SEO' }}</p>
            </div>
        @endif
    </div>
</div>
</body>
</html>

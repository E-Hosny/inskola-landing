@php
    $isRTL = ($locale ?? app()->getLocale()) === 'ar';
    $isEdit = isset($article);
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $isEdit ? ($isRTL ? 'تعديل مقال' : 'Edit Article') : ($isRTL ? 'مقال جديد' : 'New Article') }}</title>
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
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: {{ $isRTL ? "'Cairo', 'Segoe UI', sans-serif" : "'Poppins', 'Segoe UI', sans-serif" }};
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        .admin-container { max-width: 980px; margin: 0 auto; padding: 2rem; }
        .admin-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap; }
        .back-link { color: var(--primary-color); text-decoration: none; font-weight: 600; }
        .admin-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 1.6rem 1.8rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        .admin-header h1 { font-size: 1.5rem; margin-bottom: 0.35rem; }
        .form-card {
            background: var(--white);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        label { display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 0.4rem; }
        input[type="text"], input[type="datetime-local"], select, textarea {
            width: 100%;
            padding: 0.7rem 0.85rem;
            border: 1.5px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.92rem;
            background: var(--bg-light);
        }
        textarea { min-height: 120px; resize: vertical; }
        textarea.content-area { min-height: 280px; }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--white);
        }
        .hint { color: var(--text-light); font-size: 0.78rem; margin-top: 0.3rem; }
        .error { color: var(--danger); font-size: 0.8rem; margin-top: 0.3rem; }
        .form-actions { display: flex; gap: 0.7rem; flex-wrap: wrap; margin-top: 0.5rem; }
        .btn-save {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }
        .btn-cancel {
            background: transparent;
            color: var(--text-dark);
            border: 1.5px solid var(--border-color);
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
        }
        .cover-preview { margin-top: 0.6rem; }
        .cover-preview img { max-width: 220px; border-radius: 10px; display: block; }
        .check-label { display: flex; align-items: center; gap: 0.45rem; font-weight: 600; margin-top: 0.6rem; }
        @media (max-width: 760px) {
            .admin-container { padding: 1rem; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="admin-actions">
        <a href="{{ route('admin.articles.index') }}" class="back-link">{{ $isRTL ? '← العودة للمقالات' : '← Back to articles' }}</a>
    </div>

    <div class="admin-header">
        <h1>{{ $isEdit ? ($isRTL ? 'تعديل المقال' : 'Edit Article') : ($isRTL ? 'إضافة مقال جديد' : 'Create Article') }}</h1>
        <p>{{ $isRTL ? 'املأ المحتوى وحقول SEO ثم احفظ كمسودة أو انشر مباشرة' : 'Fill content and SEO fields, then save as draft or publish' }}</p>
    </div>

    <form class="form-card" method="POST" enctype="multipart/form-data"
          action="{{ $isEdit ? route('admin.articles.update', $article) : route('admin.articles.store') }}">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div>
            <label for="title">{{ $isRTL ? 'العنوان' : 'Title' }} *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
            @error('title') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-row">
            <div>
                <label for="slug">{{ $isRTL ? 'الرابط (Slug)' : 'Slug' }}</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug ?? '') }}" dir="ltr">
                <div class="hint">{{ $isRTL ? 'اتركه فارغاً ليُنشأ تلقائياً من العنوان' : 'Leave empty to auto-generate from title' }}</div>
                @error('slug') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label for="locale">{{ $isRTL ? 'لغة المقال' : 'Locale' }}</label>
                <select id="locale" name="locale">
                    <option value="ar" @selected(old('locale', $article->locale ?? 'ar') === 'ar')>العربية</option>
                    <option value="en" @selected(old('locale', $article->locale ?? 'ar') === 'en')>English</option>
                </select>
            </div>
        </div>

        <div>
            <label for="excerpt">{{ $isRTL ? 'مقتطف قصير' : 'Excerpt' }}</label>
            <textarea id="excerpt" name="excerpt">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
            @error('excerpt') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="content">{{ $isRTL ? 'المحتوى (HTML بسيط مسموح)' : 'Content (simple HTML allowed)' }} *</label>
            <textarea id="content" name="content" class="content-area" required>{{ old('content', $article->content ?? '') }}</textarea>
            <div class="hint">{{ $isRTL ? 'يمكنك استخدام: &lt;p&gt; &lt;h2&gt; &lt;ul&gt; &lt;li&gt; &lt;strong&gt; &lt;a&gt;' : 'You can use: &lt;p&gt; &lt;h2&gt; &lt;ul&gt; &lt;li&gt; &lt;strong&gt; &lt;a&gt;' }}</div>
            @error('content') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-row">
            <div>
                <label for="status">{{ $isRTL ? 'الحالة' : 'Status' }}</label>
                <select id="status" name="status">
                    <option value="draft" @selected(old('status', $article->status ?? 'draft') === 'draft')>{{ $isRTL ? 'مسودة' : 'Draft' }}</option>
                    <option value="published" @selected(old('status', $article->status ?? 'draft') === 'published')>{{ $isRTL ? 'منشور' : 'Published' }}</option>
                </select>
            </div>
            <div>
                <label for="published_at">{{ $isRTL ? 'تاريخ النشر' : 'Publish date' }}</label>
                <input type="datetime-local" id="published_at" name="published_at"
                       value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d\\TH:i') : '') }}">
            </div>
        </div>

        <div>
            <label for="cover_image">{{ $isRTL ? 'صورة الغلاف' : 'Cover image' }}</label>
            <input type="file" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image') <div class="error">{{ $message }}</div> @enderror
            @if($isEdit && $article->cover_url)
                <div class="cover-preview">
                    <img src="{{ $article->cover_url }}" alt="">
                    <label class="check-label">
                        <input type="checkbox" name="remove_cover" value="1">
                        <span>{{ $isRTL ? 'حذف الصورة الحالية' : 'Remove current cover' }}</span>
                    </label>
                </div>
            @endif
        </div>

        <div>
            <label for="meta_title">{{ $isRTL ? 'عنوان SEO' : 'SEO Title' }}</label>
            <input type="text" id="meta_title" name="meta_title" maxlength="255" value="{{ old('meta_title', $article->meta_title ?? '') }}">
            <div class="hint"><span id="metaTitleCount">0</span>/60 {{ $isRTL ? 'حرفاً موصى بها' : 'chars recommended' }}</div>
        </div>

        <div>
            <label for="meta_description">{{ $isRTL ? 'وصف SEO' : 'SEO Description' }}</label>
            <textarea id="meta_description" name="meta_description" maxlength="500">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
            <div class="hint"><span id="metaDescCount">0</span>/160 {{ $isRTL ? 'حرفاً موصى بها' : 'chars recommended' }}</div>
        </div>

        <div>
            <label for="meta_keywords">{{ $isRTL ? 'كلمات مفتاحية' : 'Keywords' }}</label>
            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords ?? '') }}">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">{{ $isRTL ? 'حفظ المقال' : 'Save Article' }}</button>
            <a href="{{ route('admin.articles.index') }}" class="btn-cancel">{{ $isRTL ? 'إلغاء' : 'Cancel' }}</a>
        </div>
    </form>
</div>
<script>
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const metaTitle = document.getElementById('meta_title');
    const metaDesc = document.getElementById('meta_description');
    const metaTitleCount = document.getElementById('metaTitleCount');
    const metaDescCount = document.getElementById('metaDescCount');
    let slugTouched = {{ $isEdit ? 'true' : 'false' }};

    function slugify(value) {
        return value.trim().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\u0600-\u06FFa-z0-9\-]+/g, '')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    }

    slugInput.addEventListener('input', () => { slugTouched = true; });
    titleInput.addEventListener('input', () => {
        if (!slugTouched || slugInput.value.trim() === '') {
            slugInput.value = slugify(titleInput.value);
            slugTouched = false;
        }
    });

    function updateCounters() {
        metaTitleCount.textContent = (metaTitle.value || '').length;
        metaDescCount.textContent = (metaDesc.value || '').length;
    }
    metaTitle.addEventListener('input', updateCounters);
    metaDesc.addEventListener('input', updateCounters);
    updateCounters();
</script>
</body>
</html>

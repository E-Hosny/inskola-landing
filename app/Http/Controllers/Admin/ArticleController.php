<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $this->setLocale();

        $articles = Article::ordered()->paginate(20);
        $locale = app()->getLocale();

        return view('admin.articles.index', compact('articles', 'locale'));
    }

    public function create(): View
    {
        $this->setLocale();

        $locale = app()->getLocale();

        return view('admin.articles.create', compact('locale'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->setLocale();

        if (!$request->filled('slug')) {
            $request->merge(['slug' => null]);
        }

        $validated = $this->validateArticle($request);
        $data = $this->prepareArticleData($request, $validated);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', app()->getLocale() === 'ar' ? 'تم إنشاء المقال بنجاح.' : 'Article created successfully.');
    }

    public function edit(Article $article): View
    {
        $this->setLocale();

        $locale = app()->getLocale();

        return view('admin.articles.edit', compact('article', 'locale'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $this->setLocale();

        if (!$request->filled('slug')) {
            $request->merge(['slug' => null]);
        }

        $validated = $this->validateArticle($request, $article->id);
        $data = $this->prepareArticleData($request, $validated, $article);

        if ($request->boolean('remove_cover') && $article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
            $data['cover_image'] = null;
        }

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', app()->getLocale() === 'ar' ? 'تم تحديث المقال بنجاح.' : 'Article updated successfully.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->setLocale();

        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', app()->getLocale() === 'ar' ? 'تم حذف المقال بنجاح.' : 'Article deleted successfully.');
    }

    private function validateArticle(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . ($ignoreId ?? 'NULL') . ',id',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'locale' => 'required|in:ar,en',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|max:4096',
            'remove_cover' => 'nullable|boolean',
        ]);
    }

    private function prepareArticleData(Request $request, array $validated, ?Article $article = null): array
    {
        $slug = !empty($validated['slug'])
            ? Article::slugify($validated['slug'])
            : Article::makeUniqueSlug($validated['title'], $article?->id);

        if ($slug === '') {
            $slug = Article::makeUniqueSlug($validated['title'], $article?->id);
        } elseif (!$article || $slug !== $article->slug) {
            $slug = Article::makeUniqueSlug($slug, $article?->id);
        }

        $status = $validated['status'];
        $publishedAt = $validated['published_at'] ?? null;

        if ($status === 'published' && empty($publishedAt)) {
            $publishedAt = now();
        }

        if ($status === 'draft') {
            $publishedAt = $publishedAt ?: null;
        }

        return [
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'locale' => $validated['locale'],
            'status' => $status,
            'published_at' => $publishedAt,
            'reading_time' => Article::estimateReadingTime($validated['content']),
        ];
    }

    private function setLocale(): void
    {
        $locale = Session::get('locale', 'ar');

        if (!Session::has('locale')) {
            Session::put('locale', 'ar');
        }

        App::setLocale($locale);
    }
}

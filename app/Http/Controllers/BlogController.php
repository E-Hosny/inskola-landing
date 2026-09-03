<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $this->setLocale();

        $articles = Article::published()->ordered()->paginate(9);

        return view('blog.index', [
            'articles' => $articles,
            'locale' => app()->getLocale(),
        ]);
    }

    public function show(string $slug): View
    {
        $this->setLocale();

        $article = Article::published()->where('slug', $slug)->firstOrFail();

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('blog.show', [
            'article' => $article,
            'related' => $related,
            'locale' => app()->getLocale(),
        ]);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SeoLandingController extends Controller
{
    public function show(string $slug): View|Response
    {
        $pages = config('seo_pages', []);

        if (!isset($pages[$slug])) {
            abort(404);
        }

        $this->setLocale();

        $locale = app()->getLocale();
        $page = $pages[$slug];
        $content = $page[$locale] ?? $page['ar'];

        $related = collect($page['related'] ?? [])
            ->filter(fn ($relatedSlug) => isset($pages[$relatedSlug]))
            ->map(function ($relatedSlug) use ($pages, $locale) {
                return [
                    'slug' => $relatedSlug,
                    'label' => $pages[$relatedSlug][$locale]['nav_label']
                        ?? $pages[$relatedSlug]['ar']['nav_label'],
                ];
            })
            ->values()
            ->all();

        return view('seo.show', [
            'slug' => $slug,
            'page' => $page,
            'content' => $content,
            'related' => $related,
            'locale' => $locale,
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

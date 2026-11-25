<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoLandingTest extends TestCase
{
    public function test_home_page_is_reachable(): void
    {
        $this->get(route('home'))->assertOk();
    }

    public function test_robots_txt_disallows_admin_and_points_to_sitemap(): void
    {
        $response = $this->get(route('robots'));

        $response->assertOk();
        $response->assertSee('Disallow: /admin', false);
        $response->assertSee('Sitemap:', false);
        $response->assertSee('/sitemap.xml', false);
    }

    public function test_sitemap_includes_tutoring_pages(): void
    {
        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('/tutoring/math', false);
        $response->assertSee('/tutoring/elementary', false);
    }

    public function test_seo_landing_pages_render(): void
    {
        foreach (array_keys(config('seo_pages')) as $slug) {
            $this->get(route('seo.show', $slug))->assertOk();
        }
    }

    public function test_unknown_seo_slug_returns_404(): void
    {
        $this->get('/tutoring/secondary-physics')->assertNotFound();
    }

    public function test_contact_requires_phone(): void
    {
        $this->postJson(route('contact.store'), [
            'name' => 'Parent',
            'message' => 'Need a math lesson',
        ])->assertStatus(422);
    }
}

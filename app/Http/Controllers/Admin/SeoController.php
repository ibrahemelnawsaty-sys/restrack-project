<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $pages = SeoMeta::all();
        return view('admin.seo.index', compact('pages'));
    }

    public function edit(string $pageSlug)
    {
        $seo = SeoMeta::firstOrCreate(['page_slug' => $pageSlug]);
        return view('admin.seo.edit', compact('seo', 'pageSlug'));
    }

    public function update(Request $request, string $pageSlug)
    {
        $validated = $request->validate([
            'meta_title_ar' => ['nullable', 'string', 'max:255'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_description_ar' => ['nullable', 'string', 'max:500'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_keywords_ar' => ['nullable', 'string', 'max:500'],
            'meta_keywords_en' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'max:2048'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'robots' => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        SeoMeta::updateOrCreate(
            ['page_slug' => $pageSlug],
            $validated
        );

        return back()->with('success', __('messages.seo_updated'));
    }
}

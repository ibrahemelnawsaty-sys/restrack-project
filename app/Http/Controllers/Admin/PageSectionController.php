<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function edit(string $pageSlug)
    {
        $sections = PageSection::where('page_slug', $pageSlug)->orderBy('display_order')->get();
        return view('admin.pages.edit', compact('pageSlug', 'sections'));
    }

    public function update(Request $request, string $pageSlug)
    {
        $validated = $request->validate([
            'sections' => ['required', 'array'],
            'sections.*.section_key' => ['required', 'string'],
            'sections.*.title_ar' => ['nullable', 'string'],
            'sections.*.title_en' => ['nullable', 'string'],
            'sections.*.subtitle_ar' => ['nullable', 'string'],
            'sections.*.subtitle_en' => ['nullable', 'string'],
            'sections.*.content_ar' => ['nullable', 'string'],
            'sections.*.content_en' => ['nullable', 'string'],
            'sections.*.cta_text_ar' => ['nullable', 'string'],
            'sections.*.cta_text_en' => ['nullable', 'string'],
            'sections.*.cta_url' => ['nullable', 'string', 'max:500'],
            'sections.*.is_visible' => ['boolean'],
        ]);

        foreach ($validated['sections'] as $sectionData) {
            PageSection::updateOrCreate(
                ['page_slug' => $pageSlug, 'section_key' => $sectionData['section_key']],
                [
                    ...$sectionData,
                    'updated_by' => auth()->id(),
                ]
            );
        }

        return back()->with('success', __('messages.page_updated'));
    }
}

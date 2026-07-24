<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::ordered()->paginate(20);
        return view('admin.speakers.index', compact('speakers'));
    }

    public function create()
    {
        return view('admin.speakers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'specialization_ar' => ['nullable', 'string', 'max:255'],
            'specialization_en' => ['nullable', 'string', 'max:255'],
            'bio_ar' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'short_bio_ar' => ['nullable', 'string', 'max:500'],
            'short_bio_en' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'years_of_experience' => ['nullable', 'integer', 'min:0', 'max:99'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name_en']);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('speakers', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        Speaker::create($validated);

        return redirect()->route('admin.speakers.index')
            ->with('success', __('messages.speaker_created'));
    }

    public function edit(Speaker $speaker)
    {
        return view('admin.speakers.edit', compact('speaker'));
    }

    public function update(Request $request, Speaker $speaker)
    {
        $validated = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'specialization_ar' => ['nullable', 'string', 'max:255'],
            'specialization_en' => ['nullable', 'string', 'max:255'],
            'bio_ar' => ['nullable', 'string'],
            'bio_en' => ['nullable', 'string'],
            'short_bio_ar' => ['nullable', 'string', 'max:500'],
            'short_bio_en' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'years_of_experience' => ['nullable', 'integer', 'min:0', 'max:99'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
        ]);

        if ($request->hasFile('photo')) {
            if ($speaker->photo) {
                Storage::disk('public')->delete($speaker->photo);
            }
            $validated['photo'] = $request->file('photo')->store('speakers', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        $speaker->update($validated);

        return redirect()->route('admin.speakers.index')
            ->with('success', __('messages.speaker_updated'));
    }

    public function destroy(Speaker $speaker)
    {
        if ($speaker->photo) {
            Storage::disk('public')->delete($speaker->photo);
        }

        $speaker->delete();

        return redirect()->route('admin.speakers.index')
            ->with('success', __('messages.speaker_deleted'));
    }
}

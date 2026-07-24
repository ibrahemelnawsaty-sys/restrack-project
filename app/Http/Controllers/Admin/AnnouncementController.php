<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::ordered()->paginate(20);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:bar,popup'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'body_ar' => ['nullable', 'string'],
            'body_en' => ['nullable', 'string'],
            'link_url' => ['nullable', 'url', 'max:500'],
            'link_text_ar' => ['nullable', 'string', 'max:255'],
            'link_text_en' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'bg_color' => ['nullable', 'string', 'max:20'],
            'text_color' => ['nullable', 'string', 'max:20'],
            'is_active' => ['boolean'],
            'is_dismissible' => ['boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_dismissible'] = $request->boolean('is_dismissible', true);

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', __('messages.saved'));
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:bar,popup'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'body_ar' => ['nullable', 'string'],
            'body_en' => ['nullable', 'string'],
            'link_url' => ['nullable', 'url', 'max:500'],
            'link_text_ar' => ['nullable', 'string', 'max:255'],
            'link_text_en' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'bg_color' => ['nullable', 'string', 'max:20'],
            'text_color' => ['nullable', 'string', 'max:20'],
            'is_active' => ['boolean'],
            'is_dismissible' => ['boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                Storage::disk('public')->delete($announcement->image);
            }
            $validated['image'] = $request->file('image')->store('announcements', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_dismissible'] = $request->boolean('is_dismissible', true);

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')
            ->with('success', __('messages.saved'));
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }

        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', __('messages.saved'));
    }
}

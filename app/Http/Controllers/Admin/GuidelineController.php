<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guideline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuidelineController extends Controller
{
    public function index()
    {
        $guidelines = Guideline::orderBy('display_order')->paginate(20);
        return view('admin.guidelines.index', compact('guidelines'));
    }

    public function create()
    {
        return view('admin.guidelines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image', 'max:1024'],
            'url' => ['nullable', 'url', 'max:500'],
            'type' => ['required', 'in:international,national'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ]);

        $validated['logo'] = $request->file('logo')->store('guidelines', 'public');
        $validated['is_visible'] = $request->boolean('is_visible', true);

        Guideline::create($validated);

        return redirect()->route('admin.guidelines.index')
            ->with('success', __('messages.guideline_created'));
    }

    public function edit(Guideline $guideline)
    {
        return view('admin.guidelines.edit', compact('guideline'));
    }

    public function update(Request $request, Guideline $guideline)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:1024'],
            'url' => ['nullable', 'url', 'max:500'],
            'type' => ['required', 'in:international,national'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_visible' => ['boolean'],
        ]);

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($guideline->logo);
            $validated['logo'] = $request->file('logo')->store('guidelines', 'public');
        }

        $validated['is_visible'] = $request->boolean('is_visible', true);

        $guideline->update($validated);

        return redirect()->route('admin.guidelines.index')
            ->with('success', __('messages.guideline_updated'));
    }

    public function destroy(Guideline $guideline)
    {
        Storage::disk('public')->delete($guideline->logo);
        $guideline->delete();

        return redirect()->route('admin.guidelines.index')
            ->with('success', __('messages.guideline_deleted'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*.group' => ['required', 'string'],
            'settings.*.key' => ['required', 'string'],
            'settings.*.value_ar' => ['nullable', 'string'],
            'settings.*.value_en' => ['nullable', 'string'],
        ]);

        foreach ($validated['settings'] as $setting) {
            SiteSetting::set(
                $setting['group'],
                $setting['key'],
                $setting['value_ar'] ?? null,
                $setting['value_en'] ?? null
            );
        }

        return back()->with('success', __('messages.settings_updated'));
    }
}

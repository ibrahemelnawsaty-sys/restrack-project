<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share site settings with all views
        View::composer('*', function ($view) {
            static $siteSettings = null;
            if ($siteSettings === null && Schema::hasTable('site_settings')) {
                $siteSettings = SiteSetting::all()->keyBy('key');
            }
            $view->with('siteSettings', $siteSettings ?? collect());
        });

        // Share the active admin-managed announcements with the public layout only
        // (one query per request, memoized; guarded so it never breaks before migration).
        View::composer('layouts.app', function ($view) {
            static $loaded = false, $bar = null, $popup = null;
            if (! $loaded) {
                $loaded = true;
                if (Schema::hasTable('announcements')) {
                    $bar = \App\Models\Announcement::active()->ofType('bar')->ordered()->first();
                    $popup = \App\Models\Announcement::active()->ofType('popup')->ordered()->first();
                }
            }
            $view->with('announcementBar', $bar)->with('announcementPopup', $popup);
        });
    }
}

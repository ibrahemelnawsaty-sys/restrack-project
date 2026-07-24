<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Support\Facades\Schema;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            [
                'loc' => route('home'),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('speakers'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('contact'),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ],
        ];

        if (Schema::hasTable('speakers')) {
            foreach (Speaker::visible()->get() as $speaker) {
                $urls[] = [
                    'loc' => route('speakers.show', $speaker->slug),
                    'lastmod' => optional($speaker->updated_at)->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                ];
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= '    <url>'."\n";
            $xml .= '        <loc>'.htmlspecialchars($url['loc'], ENT_XML1).'</loc>'."\n";
            if (! empty($url['lastmod'])) {
                $xml .= '        <lastmod>'.$url['lastmod'].'</lastmod>'."\n";
            }
            $xml .= '        <changefreq>'.$url['changefreq'].'</changefreq>'."\n";
            $xml .= '        <priority>'.$url['priority'].'</priority>'."\n";
            $xml .= '    </url>'."\n";
        }

        $xml .= '</urlset>'."\n";

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}

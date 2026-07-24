<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Guideline;
use App\Models\Level;
use App\Models\PageSection;
use App\Models\Speaker;

class HomeController extends Controller
{
    public function index()
    {
        $sections = PageSection::forPage('home')->get()->keyBy('section_key');
        $speakers = Speaker::visible()->featured()->ordered()->limit(6)->get();
        $levels = Level::published()->withCount('lectures')->ordered()->get();
        $guidelines = Guideline::visible()->get();
        $faqs = Faq::visible()->get();

        return view('pages.home', compact('sections', 'speakers', 'levels', 'guidelines', 'faqs'));
    }

    public function speakers()
    {
        $speakers = Speaker::visible()->ordered()->get();
        return view('pages.speakers', compact('speakers'));
    }

    public function speakerShow(string $slug)
    {
        $speaker = Speaker::where('slug', $slug)->visible()->firstOrFail();
        return view('pages.speaker-show', compact('speaker'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}

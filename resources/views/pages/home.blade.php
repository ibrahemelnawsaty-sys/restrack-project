@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'منصة البحث الطبي — ريستراك' : 'Research Track Platform — Restrack')

@section('content')

    {{-- Premium glass home — assembled from section partials (docs/design/mockups/03-premium-glass.html).
         Each partial is self-contained and inherits $sections, $speakers, $levels, $guidelines, $faqs. --}}

    @include('partials.home.hero')
    @include('partials.home.stats')
    @include('partials.home.about')
    @include('partials.home.program')
    @include('partials.home.levels')
    @include('partials.home.why')
    @include('partials.home.speakers')
    @include('partials.home.guidelines')
    @include('partials.home.faq')
    @include('partials.home.cta')

@endsection

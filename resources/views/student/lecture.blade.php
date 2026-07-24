@extends('layouts.student')

@section('title', $lecture->title)
@section('page-title', $lecture->title)

@section('content')
<div class="grid gap-6 lg:grid-cols-3">
    {{-- Video player --}}
    <div class="lg:col-span-2">
        <div class="overflow-hidden rounded-xl bg-black">
            @if($lecture->video_provider === 'youtube')
                <div class="aspect-video">
                    <div id="yt-player"></div>
                </div>
            @elseif($lecture->video_provider === 'vimeo')
                <div class="aspect-video">
                    <iframe id="vimeo-player" src="https://player.vimeo.com/video/{{ $lecture->video_url }}" class="h-full w-full" allowfullscreen></iframe>
                </div>
            @endif
        </div>

        {{-- Lecture info --}}
        <div class="mt-4">
            <h2 class="text-xl font-semibold text-navy">{{ $lecture->title }}</h2>
            @if($lecture->speaker)
                <p class="mt-1 text-sm text-gold">{{ $lecture->speaker->name }}</p>
            @endif
            @if($lecture->description)
                <p class="mt-3 text-sm text-gray-600">{{ $lecture->description }}</p>
            @endif
            @if($lecture->duration_minutes)
                <p class="mt-2 text-xs text-gray-400">{{ $lecture->duration_minutes }} {{ __('general.minutes') }}</p>
            @endif
        </div>

        {{-- Resources --}}
        @if($lecture->resources && count($lecture->resources))
        <div class="mt-6 rounded-xl border border-gray-100 bg-white p-5">
            <h3 class="font-semibold text-navy">{{ __('general.resources') }}</h3>
            <ul class="mt-3 space-y-2">
                @foreach($lecture->resources as $resource)
                <li>
                    <a href="{{ Storage::url($resource['path'] ?? '#') }}" target="_blank" class="flex items-center gap-2 text-sm text-gold hover:text-gold-dark">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        {{ $resource['name'] ?? __('general.download') }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Mark complete --}}
        <div id="completion-status" class="mt-4">
            @if(!$isCompleted)
            <button id="btn-mark-complete" onclick="markComplete()" class="rounded-lg bg-green-600 px-6 py-2 text-sm font-medium text-white hover:bg-green-700">
                {{ __('general.mark_complete') }}
            </button>
            @else
            <div class="inline-flex items-center gap-2 rounded-lg bg-green-50 px-4 py-2 text-sm font-medium text-green-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                {{ __('general.completed') }}
            </div>
            @endif
        </div>
    </div>

    {{-- Sidebar: Lecture list --}}
    <div>
        <div class="rounded-xl border border-gray-100 bg-white p-4">
            <h3 class="mb-3 font-semibold text-navy">{{ $level->title }}</h3>
            <ul class="space-y-1">
                @foreach($level->lectures()->ordered()->get() as $lec)
                @php $lecCompleted = $completedLectureIds->contains($lec->id); @endphp
                <li>
                    <a href="{{ route('student.lectures.show', $lec->id) }}"
                       class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition {{ $lec->id === $lecture->id ? 'bg-gold/10 font-medium text-navy' : 'text-gray-600 hover:bg-gray-50' }}">
                        @if($lecCompleted)
                            <svg class="h-4 w-4 shrink-0 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        @else
                            <span class="flex h-4 w-4 shrink-0 items-center justify-center rounded-full border border-gray-300 text-[10px] text-gray-400">{{ $lec->order }}</span>
                        @endif
                        <span class="truncate">{{ $lec->title }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let completed = {{ $isCompleted ? 'true' : 'false' }};

    function markComplete() {
        if (completed) return;
        fetch("{{ route('student.lectures.progress', $lecture->id) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ position: 0, duration: 0, completed: true })
        }).then(r => r.json()).then(() => {
            completed = true;
            document.getElementById('completion-status').innerHTML = `
                <div class="inline-flex items-center gap-2 rounded-lg bg-green-50 px-4 py-2 text-sm font-medium text-green-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ __('general.completed') }}
                </div>`;
            // Update sidebar icon
            const sidebarLinks = document.querySelectorAll('[data-lecture-id="{{ $lecture->id }}"]');
            sidebarLinks.forEach(el => {
                const icon = el.querySelector('.lecture-status');
                if (icon) icon.innerHTML = '<svg class="h-4 w-4 shrink-0 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
            });
        });
    }
</script>

@if($lecture->video_provider === 'youtube')
<script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.head.appendChild(tag);

    function onYouTubeIframeAPIReady() {
        new YT.Player('yt-player', {
            videoId: '{{ $lecture->video_url }}',
            width: '100%',
            height: '100%',
            events: {
                'onStateChange': function(e) {
                    if (e.data === YT.PlayerState.ENDED && !completed) {
                        markComplete();
                    }
                }
            }
        });
    }
</script>
@elseif($lecture->video_provider === 'vimeo')
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    var vPlayer = new Vimeo.Player(document.getElementById('vimeo-player'));
    vPlayer.on('ended', function() {
        if (!completed) markComplete();
    });
</script>
@endif
@endpush

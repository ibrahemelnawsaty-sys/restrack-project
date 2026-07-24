{{-- International references & standards — tasteful grayscale->color logo strip.
     Self-contained fragment @included inside home.blade.php's @section('content'). --}}
@if(isset($guidelines) && $guidelines->count())
<section class="relative py-16 sm:py-20" aria-labelledby="guidelines-heading">
    <div class="mx-auto max-w-6xl px-6">
        <div class="reveal text-center">
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.22em] text-gold-ink">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><use href="#i-shield"/></svg>
                {{ app()->getLocale() === 'ar' ? 'موثوقية' : 'Trusted' }}
            </span>
            <h2 id="guidelines-heading" class="mt-3 text-2xl font-extrabold text-ink theme-t sm:text-3xl">
                {{ app()->getLocale() === 'ar' ? 'مراجع ومعايير عالمية' : 'International references & standards' }}
            </h2>
        </div>

        <div class="glass-panel reveal mt-10 px-6 py-8 sm:px-10">
            <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-8">
                @foreach($guidelines as $guideline)
                    <a class="group block transition duration-500 hover:scale-105"
                       @if($guideline->url) href="{{ $guideline->url }}" target="_blank" rel="noopener noreferrer" @endif
                       aria-label="{{ $guideline->name }}">
                        @if(filled($guideline->logo))
                            <img src="{{ Storage::url($guideline->logo) }}" alt="{{ $guideline->name }}"
                                 loading="lazy" decoding="async" width="150" height="48"
                                 onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'text-ink-soft text-base font-extrabold opacity-70',textContent:this.alt}))"
                                 class="h-12 w-auto max-w-[150px] object-contain opacity-60 grayscale transition duration-500 group-hover:opacity-100 group-hover:grayscale-0">
                        @else
                            <span class="text-ink-soft text-base font-extrabold opacity-70 transition group-hover:text-ink group-hover:opacity-100">{{ $guideline->name }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

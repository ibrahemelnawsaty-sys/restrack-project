{{-- ============================================================
     STATS — row of 4 glass stat cards with [data-counter] animation.
     Self-contained fragment. No @extends/@section.
     ============================================================ --}}
@php $isAr = app()->getLocale() === 'ar'; @endphp

<section class="mx-auto w-full max-w-6xl px-6 py-14">
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-5">

        {{-- students --}}
        <div class="reveal glass-panel glass-sheen card-lift theme-t p-6 text-center">
            <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl gradient-joy text-white">
                <svg class="h-6 w-6" aria-hidden="true"><use href="#i-users"/></svg>
            </div>
            <div class="mt-4 text-3xl font-extrabold text-ink" style="font-variant-numeric:tabular-nums">
                <span data-counter="1500" data-suffix="+">0</span>
            </div>
            <p class="mt-1 text-sm font-semibold text-ink-soft">{{ $isAr ? 'طالب وطالبة' : 'Students' }}</p>
        </div>

        {{-- lectures --}}
        <div class="reveal glass-panel glass-sheen card-lift theme-t p-6 text-center">
            <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl gradient-joy text-white">
                <svg class="h-6 w-6" aria-hidden="true"><use href="#i-video"/></svg>
            </div>
            <div class="mt-4 text-3xl font-extrabold text-ink" style="font-variant-numeric:tabular-nums">
                <span data-counter="50" data-suffix="+">0</span>
            </div>
            <p class="mt-1 text-sm font-semibold text-ink-soft">{{ $isAr ? 'محاضرة مسجّلة' : 'Recorded lectures' }}</p>
        </div>

        {{-- speakers --}}
        <div class="reveal glass-panel glass-sheen card-lift theme-t p-6 text-center">
            <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl gradient-joy text-white">
                <svg class="h-6 w-6" aria-hidden="true"><use href="#i-users"/></svg>
            </div>
            <div class="mt-4 text-3xl font-extrabold text-ink" style="font-variant-numeric:tabular-nums">
                <span data-counter="12" data-suffix="+">0</span>
            </div>
            <p class="mt-1 text-sm font-semibold text-ink-soft">{{ $isAr ? 'متحدّث وخبير' : 'Speakers' }}</p>
        </div>

        {{-- satisfaction --}}
        <div class="reveal glass-panel glass-sheen card-lift theme-t p-6 text-center">
            <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl gradient-joy text-white">
                <svg class="h-6 w-6" aria-hidden="true"><use href="#i-check"/></svg>
            </div>
            <div class="mt-4 text-3xl font-extrabold text-ink" style="font-variant-numeric:tabular-nums">
                <span data-counter="98" data-suffix="%">0</span>
            </div>
            <p class="mt-1 text-sm font-semibold text-ink-soft">{{ $isAr ? 'رضا المتعلّمين' : 'Satisfaction' }}</p>
        </div>

    </div>
</section>

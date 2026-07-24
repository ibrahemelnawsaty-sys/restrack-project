@php($isAr = app()->getLocale() === 'ar')

{{-- ============================================================
     LEVELS — the ladder (3 glass-dark cards on a navy stage)
     Only renders when levels exist. Inherits $levels.
     ============================================================ --}}
@if (isset($levels) && $levels->count())
<section id="levels" class="gradient-navy relative overflow-hidden py-20 sm:py-28">

    {{-- decorative aurora orbs (transform/opacity only) --}}
    <div class="floater animate-float-slow" style="width:22rem;height:22rem;background:#7c6cfc;inset-block-start:-6rem;inset-inline-end:-5rem;opacity:.25"></div>
    <div class="floater animate-float" style="width:18rem;height:18rem;background:#10b4a0;inset-block-end:-5rem;inset-inline-start:-4rem;opacity:.2"></div>

    <div class="relative mx-auto max-w-6xl px-6">

        {{-- heading --}}
        <div class="reveal mb-14 text-center">
            <span class="pill mb-4 text-gold" style="background:rgba(175,145,54,.14);border:1px solid rgba(175,145,54,.25)">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-chart"/></svg>
                {{ $isAr ? 'سُلّم واحد · ثلاثة مستويات' : 'One ladder · three levels' }}
            </span>
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="text-gradient-gold">{{ $isAr ? 'من المبتدئ إلى الخبير' : 'From Beginner to Expert' }}</span>
            </h2>
            <p class="mx-auto mt-4 max-w-2xl text-base sm:text-lg" style="color:#a9b2c3">
                {{ $isAr
                    ? 'تدرّج منظّم: محاضرات مسجّلة في كل مستوى، ثم اختبار بمحاولات لا محدودة.'
                    : 'A structured progression: recorded lectures at every level, then an exam with unlimited attempts.' }}
            </p>
        </div>

        {{-- ladder --}}
        <div class="reveal grid items-stretch gap-6 md:grid-cols-3">
            @foreach ($levels as $index => $level)
                <div class="relative">
                    <div class="glass-dark glass-sheen card-lift relative h-full rounded-3xl p-7">

                        {{-- order badge --}}
                        <div class="mb-5 flex items-center justify-between">
                            <span class="gradient-gold grid h-12 w-12 place-items-center rounded-2xl text-lg font-extrabold text-navy shadow-lg"
                                  style="font-variant-numeric:tabular-nums">{{ $level->order }}</span>
                            <span class="pill text-violet-light" style="background:rgba(124,108,252,.16);border:1px solid rgba(124,108,252,.28)">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><use href="#i-sparkle"/></svg>
                                {{ $isAr ? 'المستوى' : 'Level' }} {{ $level->order }}
                            </span>
                        </div>

                        {{-- title + description --}}
                        <h3 class="mb-2 text-xl font-extrabold text-white">{{ $level->title }}</h3>
                        @if ($level->description)
                            <p class="mb-6 text-sm leading-relaxed" style="color:#a9b2c3">{{ $level->description }}</p>
                        @endif

                        {{-- meta pills --}}
                        <div class="mt-auto space-y-2.5 border-t pt-5" style="border-color:rgba(175,145,54,.18)">
                            <div class="flex items-center gap-2.5 text-sm font-medium" style="color:#e8ecf5">
                                <svg class="text-violet-light h-5 w-5 flex-none" fill="none" viewBox="0 0 24 24"><use href="#i-video"/></svg>
                                <span>
                                    <span style="font-variant-numeric:tabular-nums">{{ $level->lectures_count ?? $level->lectures->count() }}</span>
                                    {{ $isAr ? 'محاضرة مسجّلة' : 'recorded lectures' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2.5 text-sm font-medium" style="color:#e8ecf5">
                                <svg class="text-teal-light h-5 w-5 flex-none" fill="none" viewBox="0 0 24 24"><use href="#i-check"/></svg>
                                <span>
                                    <span style="font-variant-numeric:tabular-nums">{{ $level->passing_score }}%</span>
                                    ({{ $isAr ? 'محاولات لا محدودة' : 'unlimited attempts' }})
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- SVG connector between cards (hidden after the last, hidden on mobile) --}}
                    @if (! $loop->last)
                        <div class="pointer-events-none absolute top-1/2 z-10 hidden -translate-y-1/2 md:block"
                             style="inset-inline-end:-1.85rem" aria-hidden="true">
                            <svg class="h-8 w-8 text-gold rtl:rotate-180" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 12h14M13 6l6 6-6 6" stroke-dasharray="2.5 3" opacity=".9"/>
                            </svg>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

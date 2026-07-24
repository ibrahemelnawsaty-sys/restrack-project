{{-- "Why choose us" — 4 premium glass value cards with SVG icons.
     Self-contained fragment @included inside home.blade.php's @section('content'). --}}
<section class="relative py-16 sm:py-24" aria-labelledby="why-heading">
    <div class="mx-auto max-w-6xl px-6">

        <div class="reveal mx-auto max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.22em] text-gold-ink">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><use href="#i-sparkle"/></svg>
                {{ app()->getLocale() === 'ar' ? 'لماذا ريستراك' : 'Why Restrack' }}
            </span>
            <h2 id="why-heading" class="mt-3 text-3xl font-extrabold leading-tight text-ink theme-t sm:text-4xl">
                {{ app()->getLocale() === 'ar' ? 'لماذا تختار منصّتنا' : 'Why choose us' }}
            </h2>
            <p class="mt-5 text-lg leading-relaxed text-ink-soft theme-t">
                {{ app()->getLocale() === 'ar'
                    ? 'تجربة تعليمية فاخرة تجمع بين المرونة والحماية والإتقان — اشتراك واحد يفتح المسار كاملاً.'
                    : 'A premium learning experience that blends flexibility, protection, and mastery — one subscription unlocks the whole track.' }}
            </p>
        </div>

        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $whyItems = [
                    [
                        'icon'  => 'i-clock',
                        'tint'  => 'linear-gradient(150deg,rgba(16,180,160,.22),rgba(124,108,252,.12))',
                        'color' => 'text-teal',
                        'title' => app()->getLocale() === 'ar' ? 'تعلّم بإيقاعك' : 'Learn at your pace',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'محاضرات مسجّلة تُعاد متى شئت — دون مواعيد ثابتة تقيّدك.'
                            : 'Recorded lectures you can rewatch anytime — no fixed schedule to tie you down.',
                    ],
                    [
                        'icon'  => 'i-shield',
                        'tint'  => 'linear-gradient(150deg,rgba(217,180,88,.22),rgba(124,108,252,.12))',
                        'color' => 'text-gold',
                        'title' => app()->getLocale() === 'ar' ? 'محتوى محميّ' : 'Protected content',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'بث داخل المنصة وعلامة مائية باسمك — أي تسريب يُتتبَّع لصاحبه.'
                            : 'In-platform streaming with a watermark bearing your name — any leak is traceable to its owner.',
                    ],
                    [
                        'icon'  => 'i-infinity',
                        'tint'  => 'linear-gradient(150deg,rgba(124,108,252,.22),rgba(16,180,160,.12))',
                        'color' => 'text-violet',
                        'title' => app()->getLocale() === 'ar' ? 'محاولات لا محدودة' : 'Unlimited attempts',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'اختبر بلا خوف — النجاح 70% وأعد المحاولة كما تشاء حتى تتقن.'
                            : 'Test without fear — pass at 70% and retry as many times as you like until you master it.',
                    ],
                    [
                        'icon'  => 'i-award',
                        'tint'  => 'linear-gradient(150deg,rgba(217,180,88,.24),rgba(16,180,160,.10))',
                        'color' => 'text-gold',
                        'title' => app()->getLocale() === 'ar' ? 'شهادة موثّقة' : 'Verified certificate',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'شهادة إكمال موثّقة ثنائية اللغة عند إتمام المسار.'
                            : 'A verified, bilingual certificate of completion when you finish the track.',
                    ],
                ];
            @endphp

            @foreach($whyItems as $i => $item)
                <div class="glass-panel glass-sheen card-lift reveal p-6" style="transition-delay: {{ $i * 0.08 }}s">
                    <span class="grid place-items-center rounded-2xl border border-hair {{ $item['color'] }}"
                          style="background: {{ $item['tint'] }}; width:3.25rem; height:3.25rem;">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><use href="#{{ $item['icon'] }}"/></svg>
                    </span>
                    <h3 class="mt-5 text-base font-extrabold text-ink theme-t">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink-soft theme-t">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

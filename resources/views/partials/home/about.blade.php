{{-- Premium glass "About" section — eyebrow + heading + exact ABOUT paragraph + 3 feature cards.
     Self-contained fragment @included inside home.blade.php's @section('content'). --}}
<section class="relative py-16 sm:py-24" aria-labelledby="about-heading">
    <div class="mx-auto max-w-6xl px-6">

        {{-- heading block --}}
        <div class="reveal mx-auto max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-[0.22em] text-gold-ink">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><use href="#i-sparkle"/></svg>
                {{ app()->getLocale() === 'ar' ? 'من نحن' : 'About us' }}
            </span>
            <h2 id="about-heading" class="mt-3 text-3xl font-extrabold leading-tight text-ink theme-t sm:text-4xl">
                {{ app()->getLocale() === 'ar' ? 'منصة احترافية لإتقان البحث الطبي' : 'A professional platform to master medical research' }}
            </h2>
            <p class="mt-5 text-lg leading-relaxed text-ink-soft theme-t">
                {{ app()->getLocale() === 'ar'
                    ? 'ريستراك منصة تعليمية احترافية تُنمّي مهارات البحث الطبي عبر برامج منظّمة، وتقود المتعلّمين من مستوى المبتدئ إلى الخبير.'
                    : 'Restrack is a professional learning platform that develops medical research skills through structured programs, guiding learners from beginner to expert levels' }}
            </p>
        </div>

        {{-- 3 feature cards --}}
        <div class="mt-14 grid gap-6 md:grid-cols-3">
            @php
                $aboutCards = [
                    [
                        'icon'  => 'i-chart',
                        'tint'  => 'linear-gradient(150deg,rgba(124,108,252,.22),rgba(16,180,160,.12))',
                        'color' => 'text-violet',
                        'title' => app()->getLocale() === 'ar' ? 'برامج منظّمة' : 'Structured programs',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'مسار مرتّب في ثلاثة مستويات يقودك من المبتدئ إلى الخبير خطوة بخطوة.'
                            : 'A tidy three-level track that takes you from beginner to expert, step by step.',
                    ],
                    [
                        'icon'  => 'i-video',
                        'tint'  => 'linear-gradient(150deg,rgba(16,180,160,.22),rgba(124,108,252,.12))',
                        'color' => 'text-teal',
                        'title' => app()->getLocale() === 'ar' ? 'محاضرات مسجّلة' : 'Recorded lectures',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'محاضرات مسجّلة تُعاد متى شئت — تعلّم بإيقاعك الخاص دون قيد زمني.'
                            : 'Recorded lectures you can revisit anytime — learn at your own pace.',
                    ],
                    [
                        'icon'  => 'i-users',
                        'tint'  => 'linear-gradient(150deg,rgba(217,180,88,.22),rgba(124,108,252,.12))',
                        'color' => 'text-gold',
                        'title' => app()->getLocale() === 'ar' ? 'عربي وإنجليزي' : 'Bilingual AR / EN',
                        'desc'  => app()->getLocale() === 'ar'
                            ? 'محتوى عربي وإنجليزي متكامل، بتصميم يدعم الاتجاهين بسلاسة.'
                            : 'Full Arabic and English content, with a design built for both directions.',
                    ],
                ];
            @endphp

            @foreach($aboutCards as $i => $card)
                <div class="glass-panel glass-sheen card-lift reveal p-7" style="transition-delay: {{ $i * 0.08 }}s">
                    <span class="grid place-items-center rounded-2xl border border-hair {{ $card['color'] }}"
                          style="background: {{ $card['tint'] }}; width:3.25rem; height:3.25rem;">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><use href="#{{ $card['icon'] }}"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-extrabold text-ink theme-t">{{ $card['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-ink-soft theme-t">{{ $card['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

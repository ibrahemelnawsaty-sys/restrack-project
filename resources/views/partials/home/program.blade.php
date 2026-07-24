@php($isAr = app()->getLocale() === 'ar')

{{-- ============================================================
     PROGRAM — premium glass pricing card + read-more details
     Self-contained fragment. Inherits $levels from HomeController.
     ============================================================ --}}
<section id="program" class="py-20 sm:py-28">
    <div class="mx-auto max-w-6xl px-6">

        {{-- section heading --}}
        <div class="reveal mb-12 text-center">
            <span class="pill gradient-joy mb-4 text-white">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-sparkle"/></svg>
                {{ $isAr ? 'اشتراك واحد' : 'One subscription' }}
            </span>
            <h2 class="section-title text-ink text-3xl font-extrabold tracking-tight sm:text-4xl">
                <span class="text-gradient-gold">Research Track Programs (1)</span>
            </h2>
            <p class="text-ink-soft mx-auto mt-4 max-w-2xl text-base sm:text-lg">
                {{ $isAr
                    ? 'اشتراك واحد يفتح المسار كاملاً — محاضرات مسجّلة، اختبارات بمحاولات لا محدودة، وشهادة إكمال موثّقة.'
                    : 'A single subscription unlocks the whole track — recorded lectures, exams with unlimited attempts, and a verified certificate of completion.' }}
            </p>
        </div>

        {{-- pricing card --}}
        <div class="reveal mx-auto max-w-xl">
            <div class="glass-panel glass-sheen theme-t card-lift relative p-8 sm:p-10">

                {{-- top ribbon --}}
                <div class="mb-6 flex items-center justify-between gap-4">
                    <span class="pill text-teal border-hair" style="background:rgba(16,180,160,.12)">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-infinity"/></svg>
                        {{ $isAr ? 'وصول كامل' : 'Full access' }}
                    </span>
                    <span class="pill text-violet border-hair" style="background:rgba(124,108,252,.12)">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-grid"/></svg>
                        {{ $isAr ? '٣ مستويات' : '3 levels' }}
                    </span>
                </div>

                {{-- price --}}
                <div class="mb-2 flex items-end gap-2">
                    <span class="text-gradient-gold text-5xl font-extrabold leading-none sm:text-6xl" style="font-variant-numeric:tabular-nums">899</span>
                    <span class="text-ink-soft mb-1 text-lg font-bold">{{ $isAr ? 'ريال' : 'SAR' }}</span>
                </div>
                <p class="text-ink-soft mb-6 text-sm">
                    {{ $isAr ? 'دفعة واحدة تفتح كل محتوى المنصة' : 'One payment unlocks all platform content' }}
                </p>

                {{-- features --}}
                <ul class="mb-8 space-y-3">
                    @foreach ([
                        $isAr ? 'محاضرات مسجّلة تُعاد متى شئت' : 'Recorded lectures, rewatch anytime',
                        $isAr ? 'محاولات اختبار لا محدودة' : 'Unlimited exam attempts',
                        $isAr ? 'شهادة إكمال موثّقة' : 'Verified certificate of completion',
                        $isAr ? 'محتوى محميّ بعلامة مائية باسمك' : 'Protected content, watermarked to you',
                    ] as $feature)
                        <li class="text-ink flex items-start gap-3 text-sm font-medium sm:text-base">
                            <svg class="text-teal mt-0.5 h-5 w-5 flex-none" fill="none" viewBox="0 0 24 24"><use href="#i-check"/></svg>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>

                {{-- primary CTA --}}
                <a href="{{ route('checkout') }}"
                   class="btn-fun btn-magnetic w-full justify-center text-base">
                    {{ $isAr ? 'اشترك الآن وافتح المسار' : 'Subscribe now & unlock the track' }}
                    <svg class="h-5 w-5 rtl:rotate-180" fill="none" viewBox="0 0 24 24"><use href="#i-arrow"/></svg>
                </a>

                {{-- read-more toggle --}}
                <div x-data="{ open: false }" class="mt-6">
                    <button type="button" @click="open = !open"
                            class="text-ink-soft hover:text-gold theme-t flex w-full items-center justify-center gap-2 text-sm font-bold"
                            :aria-expanded="open.toString()">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-sparkle"/></svg>
                        <span x-show="!open">{{ $isAr ? 'تفاصيل البرنامج' : 'Read more about the program' }}</span>
                        <span x-show="open" x-cloak>{{ $isAr ? 'إخفاء التفاصيل' : 'Hide details' }}</span>
                        <svg class="h-4 w-4 transition-transform duration-300" :class="open && '-rotate-90'" fill="none" viewBox="0 0 24 24"><use href="#i-arrow"/></svg>
                    </button>

                    <div x-show="open" x-cloak x-collapse class="border-hair mt-5 border-t pt-5">
                        <p class="text-ink-soft mb-5 text-sm leading-relaxed">
                            {{ $isAr
                                ? 'برنامج «Research Track Programs (1)» مقسّم إلى ثلاثة مستويات متدرّجة. كل مستوى يحتوي على محاضرات مسجّلة يمكنك مراجعتها متى شئت، ويليه اختبار. محاولات الاختبار لا محدودة — لا داعي للخوف من الدفع ثم الرسوب، أعد المحاولة حتى تُتقن. وعند إكمال المسار تحصل على شهادة إكمال موثّقة.'
                                : 'The "Research Track Programs (1)" is split into three progressive levels. Each level has recorded lectures you can revisit anytime, followed by an exam. Exam attempts are unlimited — no fear of paying and failing; retry until you master it. Finishing the track earns you a verified certificate of completion.' }}
                        </p>

                        @if (isset($levels) && $levels->count())
                            <ul class="space-y-3">
                                @foreach ($levels as $level)
                                    <li class="bg-surface-2 border-hair theme-t flex items-start gap-3 rounded-2xl border p-4">
                                        <span class="gradient-joy grid h-8 w-8 flex-none place-items-center rounded-xl text-sm font-extrabold text-white"
                                              style="font-variant-numeric:tabular-nums">{{ $level->order }}</span>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-ink text-sm font-bold">{{ $level->title }}</p>
                                            <div class="text-ink-soft mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="text-violet h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-video"/></svg>
                                                    <span style="font-variant-numeric:tabular-nums">{{ $level->lectures_count ?? $level->lectures->count() }}</span>
                                                    {{ $isAr ? 'محاضرة مسجّلة' : 'recorded lectures' }}
                                                </span>
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="text-teal h-4 w-4" fill="none" viewBox="0 0 24 24"><use href="#i-check"/></svg>
                                                    <span style="font-variant-numeric:tabular-nums">{{ $level->passing_score }}%</span>
                                                    ({{ $isAr ? 'محاولات لا محدودة' : 'unlimited attempts' }})
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul class="space-y-2">
                                @foreach ([
                                    $isAr ? 'المستوى الأول — أساسيات البحث الطبي' : 'Level 1 — Foundations of medical research',
                                    $isAr ? 'المستوى الثاني — التصميم والتحليل' : 'Level 2 — Design & analysis',
                                    $isAr ? 'المستوى الثالث — النشر والاحتراف' : 'Level 3 — Publishing & expertise',
                                ] as $i => $fallbackLevel)
                                    <li class="text-ink flex items-center gap-3 text-sm">
                                        <span class="gradient-joy grid h-7 w-7 flex-none place-items-center rounded-lg text-xs font-extrabold text-white"
                                              style="font-variant-numeric:tabular-nums">{{ $i + 1 }}</span>
                                        <span>{{ $fallbackLevel }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

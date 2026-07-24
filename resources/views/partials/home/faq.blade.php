{{-- ============================================================
     Home · FAQ — glass Alpine accordion
     Self-contained partial (@include'd inside home.blade.php).
     Inherits $faqs from HomeController.
     ============================================================ --}}
@if(isset($faqs) && $faqs->count())
    @php($isAr = app()->getLocale() === 'ar')
    <section class="relative py-20 sm:py-24">
        <div class="mx-auto w-full max-w-3xl px-6">

            {{-- heading --}}
            <div class="reveal mx-auto mb-12 max-w-2xl text-center">
                <span class="pill glass-panel mx-auto mb-4 !px-4 !py-1.5 text-gold">
                    <svg class="h-4 w-4" aria-hidden="true"><use href="#i-sparkle"/></svg>
                    {{ $isAr ? 'أسئلة متكررة' : 'Got questions?' }}
                </span>
                <h2 class="section-title text-3xl font-extrabold text-ink sm:text-4xl">
                    {{ __('general.faqs') }}
                </h2>
            </div>

            {{-- accordion --}}
            <div x-data="{ open: 0 }" class="space-y-4">
                @foreach($faqs as $i => $faq)
                    <div class="glass-panel theme-t reveal overflow-hidden">
                        <button type="button"
                                @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                                :aria-expanded="(open === {{ $i }}).toString()"
                                class="flex w-full items-center gap-4 p-5 text-start">
                            <span class="grid h-9 w-9 flex-none place-items-center rounded-xl bg-surface-2 text-sm font-extrabold text-violet"
                                  aria-hidden="true">{{ $i + 1 }}</span>
                            <span class="flex-1 text-base font-bold text-ink">{{ $faq->question }}</span>
                            <svg class="h-5 w-5 flex-none text-gold transition-transform duration-300"
                                 :class="open === {{ $i }} ? 'rotate-90 rtl:-rotate-90' : 'rtl:rotate-180'"
                                 aria-hidden="true"><use href="#i-arrow"/></svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse x-cloak>
                            <p class="border-t border-hair px-5 pb-5 pt-4 text-sm leading-relaxed text-ink-soft">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endif

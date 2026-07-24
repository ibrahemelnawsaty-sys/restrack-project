{{-- ============================================================
     Home · Speakers — premium glass speaker cards
     Self-contained partial (@include'd inside home.blade.php).
     Inherits $speakers from HomeController.
     ============================================================ --}}
@if(isset($speakers) && $speakers->count())
    @php($isAr = app()->getLocale() === 'ar')
    <section class="relative py-20 sm:py-24">
        <div class="mx-auto w-full max-w-6xl px-6">

            {{-- heading --}}
            <div class="reveal mx-auto mb-12 max-w-2xl text-center">
                <span class="pill glass-panel mx-auto mb-4 !px-4 !py-1.5 text-gold">
                    <svg class="h-4 w-4" aria-hidden="true"><use href="#i-users"/></svg>
                    {{ $isAr ? 'نخبة من المتحدثين' : 'Our Speakers' }}
                </span>
                <h2 class="section-title text-3xl font-extrabold text-ink sm:text-4xl">
                    {{ $isAr ? 'خبراء يقودون مسارك البحثي' : 'Experts guiding your research track' }}
                </h2>
                <p class="mt-4 text-base text-ink-soft">
                    {{ $isAr
                        ? 'أساتذة وباحثون بخبرة عملية يشاركونك أدق تفاصيل البحث الطبي.'
                        : 'Seasoned researchers sharing the finest details of medical research.' }}
                </p>
            </div>

            {{-- cards --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($speakers as $speaker)
                    <article class="glass-panel glass-sheen card-lift reveal theme-t flex flex-col p-6 text-center">
                        {{-- avatar --}}
                        <div class="mx-auto mb-5">
                            @if($speaker->photo)
                                <img src="{{ \Storage::url($speaker->photo) }}"
                                     alt="{{ $speaker->name }}"
                                     width="112" height="112" loading="lazy" decoding="async"
                                     class="mx-auto h-28 w-28 rounded-2xl object-cover shadow-pop ring-1 ring-white/20"/>
                            @else
                                <span class="mx-auto grid h-28 w-28 place-items-center rounded-2xl bg-surface-2 text-gold shadow-pop ring-1 ring-white/10"
                                      aria-hidden="true">
                                    <svg class="h-14 w-14"><use href="#i-user"/></svg>
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-extrabold text-ink">{{ $speaker->name }}</h3>
                        @if($speaker->title)
                            <p class="mt-1 text-sm font-semibold text-gold">{{ $speaker->title }}</p>
                        @endif

                        @php($bio = $isAr ? $speaker->short_bio_ar : $speaker->short_bio_en)
                        @if($bio)
                            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-ink-soft">{{ $bio }}</p>
                        @endif

                        <a href="{{ route('speakers.show', $speaker->slug) }}"
                           class="link-underline mt-5 inline-flex items-center gap-1.5 self-center text-sm font-bold text-violet">
                            {{ __('general.read_more') }}
                            <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true"><use href="#i-arrow"/></svg>
                        </a>
                    </article>
                @endforeach
            </div>

            {{-- view all --}}
            <div class="reveal mt-12 text-center">
                <a href="{{ route('speakers') }}"
                   class="glass-panel glass-sheen theme-t inline-flex items-center gap-2 rounded-2xl px-6 py-3 text-sm font-bold text-ink transition hover:text-gold">
                    <svg class="h-5 w-5" aria-hidden="true"><use href="#i-users"/></svg>
                    {{ __('general.view_all_speakers') }}
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
            </div>

        </div>
    </section>
@endif

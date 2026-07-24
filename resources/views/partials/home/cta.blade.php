{{-- ============================================================
     Home · Final CTA — dark aurora call-to-action
     Self-contained partial (@include'd inside home.blade.php).
     ============================================================ --}}
@php($isAr = app()->getLocale() === 'ar')
<section class="relative py-20 sm:py-24">
    <div class="mx-auto w-full max-w-6xl px-6">
        <div class="glass-sheen reveal relative isolate overflow-hidden rounded-3xl gradient-navy px-6 py-16 text-center shadow-2xl ring-1 ring-gold/20 sm:px-12 sm:py-20">

            {{-- aurora orbs (transform/opacity only, decorative) --}}
            <span class="floater animate-float-slow -start-16 -top-16 h-64 w-64"
                  style="background:#7c6cfc" aria-hidden="true"></span>
            <span class="floater animate-float -bottom-20 -end-10 h-72 w-72"
                  style="background:#10b4a0" aria-hidden="true"></span>
            <span class="floater animate-pulse-soft start-1/2 top-1/3 h-40 w-40"
                  style="background:#af9136;opacity:.35" aria-hidden="true"></span>

            <div class="relative">
                <span class="pill glass mx-auto mb-6 !px-4 !py-1.5 text-white">
                    <svg class="h-4 w-4 text-gold" aria-hidden="true"><use href="#i-sparkle"/></svg>
                    {{ $isAr ? 'اشتراك واحد يفتح المسار كاملاً' : 'One subscription unlocks it all' }}
                </span>

                <h2 class="mx-auto max-w-2xl text-3xl font-extrabold leading-tight text-white sm:text-5xl">
                    {{ $isAr ? 'ابدأ رحلتك البحثية اليوم' : 'Start your research journey today' }}
                </h2>

                <p class="mx-auto mt-5 max-w-xl text-base text-white/70 sm:text-lg">
                    {{ $isAr
                        ? 'محاضرات مسجّلة تُعاد متى شئت، محاولات اختبار لا محدودة، ومحتوى محميّ — من المبتدئ إلى الخبير.'
                        : 'Recorded lectures you can rewatch anytime, unlimited exam attempts, and protected content — from beginner to expert.' }}
                </p>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="btn-magnetic gradient-gold inline-flex items-center gap-2 rounded-2xl px-8 py-4 text-base font-extrabold text-navy shadow-pop">
                        {{ $isAr ? 'ابدأ الآن مجاناً' : 'Get started now' }}
                        <svg class="h-5 w-5 rtl:rotate-180" aria-hidden="true"><use href="#i-arrow"/></svg>
                    </a>
                    <a href="{{ route('contact') }}"
                       class="glass inline-flex items-center gap-2 rounded-2xl px-8 py-4 text-base font-bold text-white transition hover:text-gold-light">
                        <svg class="h-5 w-5" aria-hidden="true"><use href="#i-mail"/></svg>
                        {{ $isAr ? 'تواصل معنا' : 'Contact us' }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

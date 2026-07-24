{{-- Announcement bar (slim top strip) — expects $a (App\Models\Announcement|null).
     Uses $a->bg_color / $a->text_color inline. Dismissal persists in
     localStorage key 'rt_ann_bar_'+$a->id. No layout shift, light inline JS. --}}
@if($a)
    @php $rtAnnBarId = 'rt-ann-bar-'.$a->id; @endphp
    <div id="{{ $rtAnnBarId }}"
         class="rt-ann-bar"
         role="region"
         aria-label="{{ app()->getLocale() === 'ar' ? 'إعلان' : 'Announcement' }}"
         style="background: {{ $a->bg_color ?: '#af9136' }}; color: {{ $a->text_color ?: '#16264b' }};">
        <div class="rt-ann-bar__inner">
            <span class="rt-ann-bar__spark" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                     stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><use href="#i-sparkle"/></svg>
            </span>

            @if($a->title)
                <span class="rt-ann-bar__title">{{ $a->title }}</span>
            @endif

            @if($a->link_url)
                <a href="{{ $a->link_url }}" class="rt-ann-bar__cta"
                   style="color: {{ $a->text_color ?: '#16264b' }};">
                    <span>{{ $a->link_text ?: (app()->getLocale() === 'ar' ? 'اعرف المزيد' : 'Learn more') }}</span>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                         stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"
                         class="rt-ann-bar__arrow" aria-hidden="true"><use href="#i-arrow"/></svg>
                </a>
            @endif
        </div>

        @if($a->is_dismissible)
            <button type="button" class="rt-ann-bar__close"
                    data-rt-ann-bar-close
                    style="color: {{ $a->text_color ?: '#16264b' }};"
                    aria-label="{{ app()->getLocale() === 'ar' ? 'إغلاق الإعلان' : 'Dismiss announcement' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                     stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>
        @endif
    </div>

    <style>
        .rt-ann-bar{
            display:flex;align-items:center;gap:.75rem;
            padding:.5rem clamp(.9rem,4vw,1.5rem);
            font-size:.9rem;font-weight:600;line-height:1.35;
            position:relative;z-index:30;
        }
        .rt-ann-bar__inner{
            display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;
            justify-content:center;flex:1;min-width:0;text-align:center;
        }
        .rt-ann-bar__spark{display:inline-flex;flex:none;opacity:.9}
        .rt-ann-bar__spark svg{animation:pulse-soft 3s ease-in-out infinite}
        .rt-ann-bar__title{font-weight:700}
        .rt-ann-bar__cta{
            display:inline-flex;align-items:center;gap:.3rem;
            font-weight:800;text-decoration:none;
            padding:.15rem .55rem;border-radius:999px;
            background:rgba(255,255,255,.16);
            transition:background .25s ease,transform .25s ease;
            -webkit-backdrop-filter:blur(4px);backdrop-filter:blur(4px);
        }
        .rt-ann-bar__cta:hover{background:rgba(255,255,255,.28);transform:translateY(-1px)}
        .rt-ann-bar__arrow{transition:transform .25s ease}
        [dir="rtl"] .rt-ann-bar__arrow{transform:scaleX(-1)}
        .rt-ann-bar__cta:hover .rt-ann-bar__arrow{transform:translateX(2px)}
        [dir="rtl"] .rt-ann-bar__cta:hover .rt-ann-bar__arrow{transform:scaleX(-1) translateX(2px)}
        .rt-ann-bar__close{
            display:inline-flex;align-items:center;justify-content:center;flex:none;
            width:28px;height:28px;border-radius:9px;border:none;cursor:pointer;
            background:transparent;opacity:.75;
            transition:opacity .2s ease,background .2s ease;
            -webkit-tap-highlight-color:transparent;
        }
        .rt-ann-bar__close:hover{opacity:1;background:rgba(255,255,255,.18)}
        @media (prefers-reduced-motion:reduce){
            .rt-ann-bar__spark svg,.rt-ann-bar__cta,.rt-ann-bar__arrow{animation:none!important;transition:none!important}
        }
    </style>

    <script>
        (function(){
            var el = document.getElementById(@json($rtAnnBarId));
            if(!el) return;
            var key = 'rt_ann_bar_' + @json($a->id);
            try{ if(localStorage.getItem(key) === '1'){ el.style.display = 'none'; return; } }catch(e){}
            var btn = el.querySelector('[data-rt-ann-bar-close]');
            if(btn){
                btn.addEventListener('click', function(){
                    el.style.display = 'none';
                    try{ localStorage.setItem(key, '1'); }catch(e){}
                });
            }
        })();
    </script>
@endif

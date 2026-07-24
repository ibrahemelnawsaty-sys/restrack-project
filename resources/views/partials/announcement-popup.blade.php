{{-- Announcement popup (luxurious glass modal) — expects $a (App\Models\Announcement|null).
     Auto-opens once per browser session (sessionStorage 'rt_ann_popup_seen_'+id) and stays
     dismissed permanently via localStorage 'rt_ann_popup_'+id. Close on X / backdrop / Esc.
     Respects prefers-reduced-motion. Self-contained + light. --}}
@if($a)
    @php $rtAnnPopId = 'rt-ann-popup-'.$a->id; @endphp
    <div id="{{ $rtAnnPopId }}"
         class="rt-ann-popup"
         role="dialog" aria-modal="true"
         aria-label="{{ app()->getLocale() === 'ar' ? 'إعلان' : 'Announcement' }}"
         hidden>
        <div class="rt-ann-popup__backdrop" data-rt-ann-pop-close></div>

        <div class="rt-ann-popup__card glass-panel glass-sheen theme-t" role="document">
            <button type="button" class="rt-ann-popup__close" data-rt-ann-pop-close
                    aria-label="{{ app()->getLocale() === 'ar' ? 'إغلاق' : 'Close' }}">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                     stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18"/>
                </svg>
            </button>

            @if($a->image)
                <div class="rt-ann-popup__media">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($a->image) }}"
                         alt="{{ $a->title ?? '' }}" loading="lazy" decoding="async">
                </div>
            @endif

            <div class="rt-ann-popup__body">
                <span class="rt-ann-popup__badge">
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor"
                         stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true"><use href="#i-sparkle"/></svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'جديد' : 'What\'s new' }}</span>
                </span>

                @if($a->title)
                    <h2 class="rt-ann-popup__title text-ink-strong">{{ $a->title }}</h2>
                @endif

                @if($a->body)
                    <p class="rt-ann-popup__text text-ink-soft">{{ $a->body }}</p>
                @endif

                @if($a->link_url)
                    <a href="{{ $a->link_url }}" class="btn-fun rt-ann-popup__cta">
                        <span>{{ $a->link_text ?: (app()->getLocale() === 'ar' ? 'اكتشف الآن' : 'Discover now') }}</span>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                             class="rt-ann-popup__arrow" aria-hidden="true"><use href="#i-arrow"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <style>
        .rt-ann-popup{
            position:fixed;inset:0;z-index:80;
            display:flex;align-items:center;justify-content:center;
            padding:1.25rem;
        }
        .rt-ann-popup[hidden]{display:none}
        .rt-ann-popup__backdrop{
            position:absolute;inset:0;
            background:rgba(9,14,30,.55);
            -webkit-backdrop-filter:blur(8px) saturate(120%);backdrop-filter:blur(8px) saturate(120%);
            opacity:0;transition:opacity .35s ease;
        }
        .rt-ann-popup.is-open .rt-ann-popup__backdrop{opacity:1}
        .rt-ann-popup__card{
            position:relative;width:100%;max-width:440px;
            padding:0;border-radius:24px;
            opacity:0;transform:translateY(14px) scale(.94);
            transition:opacity .4s cubic-bezier(.2,.8,.2,1),transform .4s cubic-bezier(.2,.8,.2,1);
            will-change:opacity,transform;
        }
        .rt-ann-popup.is-open .rt-ann-popup__card{opacity:1;transform:none}
        .rt-ann-popup__close{
            position:absolute;inset-block-start:.65rem;inset-inline-end:.65rem;z-index:2;
            display:inline-flex;align-items:center;justify-content:center;
            width:34px;height:34px;border-radius:11px;border:none;cursor:pointer;
            color:var(--ink);background:color-mix(in srgb, var(--surface) 65%, transparent);
            -webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);
            box-shadow:0 6px 18px -10px rgba(0,0,0,.5);
            opacity:.85;transition:opacity .2s ease,transform .2s ease;
            -webkit-tap-highlight-color:transparent;
        }
        .rt-ann-popup__close:hover{opacity:1;transform:rotate(90deg)}
        .rt-ann-popup__media{
            position:relative;aspect-ratio:16/9;overflow:hidden;
            border-start-start-radius:24px;border-start-end-radius:24px;
        }
        .rt-ann-popup__media img{width:100%;height:100%;object-fit:cover;display:block}
        .rt-ann-popup__body{padding:1.6rem clamp(1.25rem,5vw,1.9rem) 1.75rem}
        .rt-ann-popup__badge{
            display:inline-flex;align-items:center;gap:.35rem;
            font-size:.7rem;font-weight:800;letter-spacing:.04em;
            padding:.32rem .7rem;border-radius:999px;color:var(--color-gold-dark);
            background:linear-gradient(150deg,rgba(175,145,54,.18),rgba(124,108,252,.14));
            border:1px solid var(--hairline);
        }
        :root[data-theme="dark"] .rt-ann-popup__badge{color:var(--color-gold-light)}
        @media (prefers-color-scheme:dark){
            :root:not([data-theme="light"]) .rt-ann-popup__badge{color:var(--color-gold-light)}
        }
        .rt-ann-popup__title{
            font-size:clamp(1.35rem,4vw,1.65rem);font-weight:800;
            line-height:1.25;margin-top:.85rem;
        }
        .rt-ann-popup__text{
            font-size:.98rem;line-height:1.65;margin-top:.6rem;
        }
        .rt-ann-popup__cta{margin-top:1.4rem}
        .rt-ann-popup__arrow{transition:transform .25s ease}
        [dir="rtl"] .rt-ann-popup__arrow{transform:scaleX(-1)}
        .rt-ann-popup__cta:hover .rt-ann-popup__arrow{transform:translateX(3px)}
        [dir="rtl"] .rt-ann-popup__cta:hover .rt-ann-popup__arrow{transform:scaleX(-1) translateX(3px)}
        @media (prefers-reduced-motion:reduce){
            .rt-ann-popup__card{transform:none!important;transition:opacity .3s ease!important}
            .rt-ann-popup__backdrop{transition:none!important}
            .rt-ann-popup__close:hover{transform:none}
        }
    </style>

    <script>
        (function(){
            var el = document.getElementById(@json($rtAnnPopId));
            if(!el) return;
            var id = @json((string) $a->id);
            var dismissKey = 'rt_ann_popup_' + id;
            var seenKey = 'rt_ann_popup_seen_' + id;

            function isDismissed(){ try{ return localStorage.getItem(dismissKey) === '1'; }catch(e){ return false; } }
            function isSeen(){ try{ return sessionStorage.getItem(seenKey) === '1'; }catch(e){ return false; } }

            function open(){
                if(isDismissed() || isSeen()) return;
                try{ sessionStorage.setItem(seenKey, '1'); }catch(e){}
                el.hidden = false;
                // next frame → trigger transition
                requestAnimationFrame(function(){ requestAnimationFrame(function(){ el.classList.add('is-open'); }); });
                document.addEventListener('keydown', onKey);
            }

            function close(){
                el.classList.remove('is-open');
                try{ localStorage.setItem(dismissKey, '1'); }catch(e){}
                document.removeEventListener('keydown', onKey);
                var reduce = matchMedia('(prefers-reduced-motion:reduce)').matches;
                if(reduce){ el.hidden = true; }
                else{ setTimeout(function(){ el.hidden = true; }, 380); }
            }

            function onKey(e){ if(e.key === 'Escape' || e.key === 'Esc'){ close(); } }

            el.querySelectorAll('[data-rt-ann-pop-close]').forEach(function(n){
                n.addEventListener('click', close);
            });

            if(isDismissed() || isSeen()) return;
            setTimeout(open, 1200);
        })();
    </script>
@endif

{{-- Glass bottom navigation (mobile/tablet only) — Telegram-iOS style.
     Expects $items: array of ['label','url','icon','active'].
     Desktop hides it via CSS (.bottom-nav @ min-width:1024px). --}}
@php $items = $items ?? []; @endphp
@if(count($items))
    <nav class="bottom-nav" aria-label="{{ app()->getLocale() === 'ar' ? 'التنقل السفلي' : 'Bottom navigation' }}">
        @foreach($items as $it)
            <a href="{{ $it['url'] }}"
               class="bn-item {{ ($it['active'] ?? false) ? 'is-active' : '' }}"
               @if($it['active'] ?? false) aria-current="page" @endif>
                <span class="bn-ico">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><use href="#{{ $it['icon'] }}"/></svg>
                </span>
                <span>{{ $it['label'] }}</span>
            </a>
        @endforeach
    </nav>
@endif

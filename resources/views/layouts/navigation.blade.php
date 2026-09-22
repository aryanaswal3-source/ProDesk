@php
    $initials = collect(explode(' ', Auth::user()->name))
        ->map(fn($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<style>
    .pd-navbar{
        background:#fff;
        padding:12px 28px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        border-bottom:1px solid #e6ece8;
        position:relative;
    }
    .pd-navbar::after{
        content:"";
        position:absolute; left:0; right:0; bottom:-1px; height:2px;
        background:linear-gradient(90deg, #12372A 0%, #C9A227 100%);
        opacity:.7;
    }
    .pd-brand{ display:flex; align-items:center; gap:10px; text-decoration:none; }
    .pd-brand-icon{
        width:40px; height:40px; border-radius:10px;
        background:linear-gradient(135deg,#C9A227,#e8c265);
        display:flex; align-items:center; justify-content:center; font-size:20px;
        box-shadow:0 3px 8px rgba(201,162,39,.28);
        transition:transform .18s ease;
    }
    .pd-brand:hover .pd-brand-icon{ transform:scale(1.06) rotate(-3deg); }
    .pd-brand-text b{ font-size:18px; color:#12372A; display:block; line-height:1.1; }
    .pd-brand-text small{ display:block; color:#8a9a92; font-size:11px; letter-spacing:.2px; }
    .pd-nav-right{ display:flex; align-items:center; gap:16px; }
    .pd-bell{
        width:38px; height:38px; border-radius:50%; background:#f0f6f3;
        display:flex; align-items:center; justify-content:center; font-size:16px;
        border:none; cursor:pointer; position:relative; transition:background .15s ease;
    }
    .pd-bell:hover{ background:#e2ede7; }
    .pd-bell .dot{
        position:absolute; top:8px; right:9px; width:7px; height:7px;
        background:#e0483a; border-radius:50%; box-shadow:0 0 0 2px #fff;
    }
    .pd-avatar-btn{
        display:flex; align-items:center; gap:9px; background:#f7faf8; border:1px solid transparent;
        cursor:pointer; padding:5px 12px 5px 5px; border-radius:30px; transition:background .15s ease, border-color .15s ease;
    }
    .pd-avatar-btn:hover{ background:#eef4f0; border-color:#dce8e1; }
    .pd-avatar{
        width:34px; height:34px; border-radius:50%;
        background:linear-gradient(135deg,#12372A,#1d4d3c); color:#fff; display:flex; align-items:center; justify-content:center;
        font-weight:700; font-size:12.5px; box-shadow:0 2px 6px rgba(18,55,42,.25);
    }
    .pd-username{ font-size:13.5px; color:#202522; font-weight:600; }
    .pd-caret{ font-size:10px; color:#8a9a92; margin-left:2px; }
</style>

<nav class="pd-navbar">
    <a href="{{ route('dashboard') }}" class="pd-brand">
        <div class="pd-brand-icon">🏠</div>
        <div class="pd-brand-text">
            <b>ProDesk</b>
            <small>Your Property Partner</small>
        </div>
    </a>

    <div class="pd-nav-right">
        {{-- <button type="button" class="pd-bell" title="Notifications">
            🔔
            <span class="dot"></span>
        </button> --}}

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button type="button" class="pd-avatar-btn">
                    <div class="pd-avatar">{{ $initials }}</div>
                    <span class="pd-username d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    <span class="pd-caret">▾</span>
                </button>
            </x-slot>

            <x-slot name="content">
                @if(request()->routeIs('profile.edit'))
                    <x-dropdown-link :href="route('dashboard')">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>
                @else
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
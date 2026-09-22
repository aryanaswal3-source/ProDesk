@php
    $initials = collect(explode(' ', Auth::user()->name))
        ->map(fn($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<style>
    .pd-navbar {
        min-height: 72px;
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        padding: 12px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e7eee9;
        position: relative;
        z-index: 1000;
    }

    .pd-navbar::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1px;
        height: 2px;
        background: linear-gradient(
            90deg,
            #12372A 0%,
            #C9A227 50%,
            #12372A 100%
        );
        opacity: .75;
    }

    /* =========================
       BRAND
    ========================= */

    .pd-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        transition: .25s ease;
    }

    .pd-brand:hover {
        text-decoration: none;
        transform: translateY(-1px);
    }

    .pd-brand-icon {
        width: 43px;
        height: 43px;
        border-radius: 13px;
        background: linear-gradient(
            135deg,
            #C9A227 0%,
            #e8c96d 100%
        );
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        box-shadow:
            0 6px 16px rgba(201, 162, 39, .22),
            inset 0 1px 0 rgba(255,255,255,.4);
        transition: .25s ease;
    }

    .pd-brand:hover .pd-brand-icon {
        transform: scale(1.06) rotate(-3deg);
        box-shadow:
            0 8px 20px rgba(201, 162, 39, .3);
    }

    .pd-brand-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .pd-brand-text b {
        font-size: 19px;
        font-weight: 800;
        color: #12372A;
        line-height: 1;
        letter-spacing: -.3px;
    }

    .pd-brand-text small {
        margin-top: 5px;
        color: #8a9a92;
        font-size: 10.5px;
        font-weight: 500;
        letter-spacing: .35px;
    }

    /* =========================
       RIGHT SIDE
    ========================= */

    .pd-nav-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* =========================
       USER BUTTON
    ========================= */

    .pd-avatar-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8faf9;
        border: 1px solid #e3ebe6;
        cursor: pointer;
        padding: 5px 11px 5px 5px;
        border-radius: 50px;
        transition: all .2s ease;
        outline: none;
    }

    .pd-avatar-btn:hover,
    .pd-avatar-btn:focus {
        background: #f0f6f3;
        border-color: #cddbd3;
        box-shadow: 0 5px 16px rgba(18,55,42,.08);
    }

    .pd-avatar {
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        border-radius: 50%;
        background: linear-gradient(
            135deg,
            #12372A,
            #1f5945
        );
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 12px;
        letter-spacing: .4px;
        box-shadow:
            0 3px 8px rgba(18,55,42,.22),
            inset 0 1px 0 rgba(255,255,255,.12);
        position: relative;
    }

    .pd-avatar::after {
        content: "";
        position: absolute;
        right: -1px;
        bottom: 1px;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #35b86b;
        border: 2px solid #fff;
    }

    .pd-user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 80px;
    }

    .pd-username {
        max-width: 145px;
        font-size: 13px;
        color: #202522;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pd-user-role {
        font-size: 10px;
        color: #8a9a92;
        margin-top: 2px;
        font-weight: 500;
    }

    .pd-caret {
        font-size: 11px;
        color: #718078;
        margin-left: 3px;
        transition: transform .2s ease;
    }

    .pd-avatar-btn[aria-expanded="true"] .pd-caret {
        transform: rotate(180deg);
    }

    /* =========================
       DROPDOWN
    ========================= */

    .pd-navbar .dropdown-menu {
        margin-top: 12px !important;
        border: 1px solid #e2ebe5 !important;
        border-radius: 16px !important;
        padding: 8px !important;
        min-width: 205px;
        box-shadow:
            0 18px 45px rgba(18,55,42,.13),
            0 4px 12px rgba(18,55,42,.05);
        background: #fff;
    }

    .pd-navbar .dropdown-menu a {
        border-radius: 10px;
        transition: .18s ease;
    }

    .pd-navbar .dropdown-menu a:hover {
        background: #f1f7f3;
        color: #12372A;
    }

    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 576px) {

        .pd-navbar {
            padding: 11px 16px;
            min-height: 66px;
        }

        .pd-brand {
            gap: 9px;
        }

        .pd-brand-icon {
            width: 39px;
            height: 39px;
            border-radius: 11px;
            font-size: 18px;
        }

        .pd-brand-text b {
            font-size: 17px;
        }

        .pd-brand-text small {
            display: none;
        }

        .pd-avatar-btn {
            padding: 4px;
            border-radius: 50%;
            border-color: transparent;
            background: #f4f8f5;
        }

        .pd-avatar {
            width: 36px;
            height: 36px;
        }

        .pd-caret {
            display: none;
        }

        .pd-navbar .dropdown-menu {
            margin-top: 9px !important;
            min-width: 190px;
        }
    }
</style>

<nav class="pd-navbar">

    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="pd-brand">

        <div class="pd-brand-icon">
            🏠
        </div>

        <div class="pd-brand-text">
            <b>ProDesk</b>
            <small>Your Property Partner</small>
        </div>

    </a>


    {{-- Right Side --}}
    <div class="pd-nav-right">

        <x-dropdown align="right" width="48">

            <x-slot name="trigger">

                <button type="button" class="pd-avatar-btn">

                    <div class="pd-avatar">
                        {{ $initials }}
                    </div>

                    <div class="pd-user-info d-none d-sm-flex">

                        <span class="pd-username">
                            {{ Auth::user()->name }}
                        </span>

                        <span class="pd-user-role">
                            Property Dealer
                        </span>

                    </div>

                    <span class="pd-caret">
                        ▾
                    </span>

                </button>

            </x-slot>


            <x-slot name="content">

                {{-- Dashboard / Profile --}}
                @if(request()->routeIs('profile.edit'))

                    <x-dropdown-link :href="route('dashboard')">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>

                @else

                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                @endif


                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-dropdown-link>

                </form>

            </x-slot>

        </x-dropdown>

    </div>

</nav>
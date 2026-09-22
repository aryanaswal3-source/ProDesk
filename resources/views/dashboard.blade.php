<x-app-layout>

    <x-slot name="header">

        <div class="pd-header">

            <div>

                <div class="pd-eyebrow">
                    <span></span>
                    PRODESK OVERVIEW
                </div>

                <h2>Dashboard</h2>

                <p>
                    Your property business at a glance
                    · {{ now()->format('l, d M Y') }}
                </p>

            </div>


            <a
                href="{{ route('properties.create') }}"
                class="pd-add-btn"
            >
                <span>＋</span>
                Add Property
            </a>

        </div>

    </x-slot>


    @php

        $user = auth()->user();

        $totalProperties = $user->properties()->count();

        $forSale = $user->properties()
            ->where('purpose', 'sale')
            ->count();

        $forRent = $user->properties()
            ->where('purpose', 'rent')
            ->count();

        $available = $user->properties()
            ->where('status', 'available')
            ->count();

        $sold = $user->properties()
            ->where('status', 'sold')
            ->count();

        $rented = $user->properties()
            ->where('status', 'rented')
            ->count();

        $onHold = $user->properties()
            ->where('status', 'hold')
            ->count();

        $recentProperties = $user->properties()
            ->with('media')
            ->latest()
            ->take(6)
            ->get();

        $hour = now()->hour;

        $greeting = $hour < 12
            ? 'Good Morning'
            : ($hour < 17 ? 'Good Afternoon' : 'Good Evening');

        $salePercentage = $totalProperties > 0
            ? round(($forSale / $totalProperties) * 100)
            : 0;

        $rentPercentage = $totalProperties > 0
            ? round(($forRent / $totalProperties) * 100)
            : 0;

        $availablePercentage = $totalProperties > 0
            ? round(($available / $totalProperties) * 100)
            : 0;

    @endphp


    <style>

        :root {
            --pd-green:#12372A;
            --pd-green-2:#1d4d3c;
            --pd-green-3:#285c49;
            --pd-gold:#C9A227;
            --pd-gold-light:#f7efc9;
            --pd-cream:#F7F5EF;
            --pd-charcoal:#202522;
            --pd-muted:#89918c;
            --pd-border:#e7ebe7;
            --pd-blue:#477bd2;
            --pd-purple:#7556c6;
            --pd-orange:#df8a34;
            --pd-red:#d84d42;
        }


        /* =========================
           HEADER
        ========================= */

        .pd-header {

            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            flex-wrap:wrap;

        }

        .pd-eyebrow {

            display:flex;
            align-items:center;
            gap:8px;

            color:var(--pd-gold);

            font-size:10px;
            font-weight:850;

            letter-spacing:2px;

            margin-bottom:7px;

        }

        .pd-eyebrow span {

            width:28px;
            height:3px;

            border-radius:20px;

            background:var(--pd-gold);

        }

        .pd-header h2 {

            margin:0;

            color:var(--pd-green);

            font-size:27px;
            font-weight:850;

            letter-spacing:-.6px;

        }

        .pd-header p {

            margin:5px 0 0;

            color:#929994;

            font-size:12.5px;

        }

        .pd-add-btn {

            display:inline-flex;
            align-items:center;
            gap:7px;

            padding:11px 18px;

            background:var(--pd-green);
            color:#fff;

            border-radius:11px;

            text-decoration:none;

            font-size:12px;
            font-weight:800;

            box-shadow:
                0 7px 18px rgba(18,55,42,.16);

            transition:.2s ease;

        }

        .pd-add-btn span {

            font-size:17px;
            line-height:1;

        }

        .pd-add-btn:hover {

            background:var(--pd-green-2);
            color:#fff;

            transform:translateY(-2px);

        }


        /* =========================
           PAGE
        ========================= */

        .pd-page {

            min-height:100%;

            background:
                radial-gradient(
                    circle at 5% 4%,
                    rgba(201,162,39,.07),
                    transparent 24%
                ),
                radial-gradient(
                    circle at 95% 20%,
                    rgba(18,55,42,.06),
                    transparent 26%
                );

        }

        .pd-container {

            max-width:1450px;
            margin:auto;

        }


        /* =========================
           HERO
        ========================= */

        .pd-hero {

            position:relative;
            overflow:hidden;

            border-radius:25px;

            padding:31px 34px;

            color:#fff;

            background:
                linear-gradient(
                    130deg,
                    #12372A 0%,
                    #1b4938 55%,
                    #285c49 100%
                );

            box-shadow:
                0 18px 45px rgba(18,55,42,.15);

        }

        .pd-hero:before {

            content:"";

            position:absolute;

            width:330px;
            height:330px;

            border:1px solid rgba(255,255,255,.07);

            border-radius:50%;

            right:-100px;
            top:-190px;

        }

        .pd-hero:after {

            content:"";

            position:absolute;

            width:210px;
            height:210px;

            border:1px solid rgba(201,162,39,.15);

            border-radius:50%;

            right:120px;
            bottom:-165px;

        }

        .pd-hero-content {

            position:relative;
            z-index:2;

            display:flex;

            justify-content:space-between;
            align-items:center;

            gap:30px;

        }

        .pd-hero-left {

            max-width:680px;

        }

        .pd-hero-badge {

            display:inline-flex;

            align-items:center;
            gap:7px;

            padding:6px 11px;

            border-radius:30px;

            background:rgba(255,255,255,.1);

            border:1px solid rgba(255,255,255,.13);

            color:#fff;

            font-size:9px;
            font-weight:800;

            letter-spacing:1px;

            margin-bottom:13px;

        }

        .pd-live-dot {

            width:6px;
            height:6px;

            border-radius:50%;

            background:#63d897;

            box-shadow:
                0 0 0 4px rgba(99,216,151,.09);

        }

        .pd-hero h1 {

            margin:0 0 7px;

            font-size:28px;
            font-weight:850;

            letter-spacing:-.6px;

        }

        .pd-hero-description {

            margin:0;

            color:rgba(255,255,255,.66);

            font-size:12px;

            line-height:1.7;

            max-width:570px;

        }

        .pd-hero-features {

            display:flex;

            flex-wrap:wrap;

            gap:8px;

            margin-top:20px;

        }

        .pd-hero-feature {

            display:flex;
            align-items:center;

            gap:7px;

            padding:7px 10px;

            border-radius:9px;

            background:rgba(255,255,255,.07);

            border:1px solid rgba(255,255,255,.08);

            font-size:9.5px;

            font-weight:650;

            color:rgba(255,255,255,.78);

        }

        .pd-hero-feature span {

            font-size:13px;

        }


        /* Hero right */

        .pd-hero-side {

            min-width:210px;

            padding:18px;

            border-radius:18px;

            background:rgba(255,255,255,.07);

            border:1px solid rgba(255,255,255,.09);

            backdrop-filter:blur(8px);

        }

        .pd-hero-side-label {

            color:rgba(255,255,255,.55);

            font-size:9px;

            font-weight:750;

            text-transform:uppercase;

            letter-spacing:1px;

        }

        .pd-hero-side-number {

            font-size:34px;

            font-weight:850;

            margin-top:2px;

        }

        .pd-hero-side-text {

            color:rgba(255,255,255,.55);

            font-size:10px;

        }


        /* =========================
           STATS
        ========================= */

        .pd-stat {

            height:100%;

            background:#fff;

            border:1px solid rgba(18,55,42,.055);

            border-radius:19px;

            padding:20px;

            box-shadow:
                0 7px 24px rgba(18,55,42,.045);

            transition:.22s ease;

        }

        .pd-stat:hover {

            transform:translateY(-4px);

            box-shadow:
                0 14px 32px rgba(18,55,42,.09);

        }

        .pd-stat-top {

            display:flex;

            justify-content:space-between;

            align-items:flex-start;

        }

        .pd-stat-icon {

            width:46px;
            height:46px;

            border-radius:14px;

            display:flex;

            align-items:center;
            justify-content:center;

            font-size:19px;

            transition:.25s ease;

        }

        .pd-stat:hover .pd-stat-icon {

            transform:scale(1.08) rotate(-4deg);

        }

        .pd-stat-label {

            color:#8d948f;

            font-size:11px;
            font-weight:650;

            margin-bottom:5px;

        }

        .pd-stat-number {

            color:var(--pd-charcoal);

            font-size:27px;

            font-weight:850;

            line-height:1;

        }

        .pd-stat-footer {

            margin-top:17px;

            padding-top:11px;

            border-top:1px solid #f0f1ee;

            display:flex;

            align-items:center;

            justify-content:space-between;

        }

        .pd-stat-footer-text {

            color:#9ca29e;

            font-size:9.5px;

        }

        .pd-stat-arrow {

            width:24px;
            height:24px;

            border-radius:7px;

            background:#f3f5f2;

            display:flex;

            align-items:center;
            justify-content:center;

            font-size:11px;

            color:var(--pd-green);

        }


        /* =========================
           SECTION CARD
        ========================= */

        .pd-card {

            background:#fff;

            border:1px solid rgba(18,55,42,.055);

            border-radius:21px;

            box-shadow:
                0 7px 25px rgba(18,55,42,.045);

            overflow:hidden;

        }

        .pd-card-header {

            display:flex;

            justify-content:space-between;

            align-items:center;

            padding:21px 22px;

            border-bottom:1px solid #f0f1ee;

        }

        .pd-card-title {

            color:var(--pd-charcoal);

            font-size:15px;

            font-weight:850;

            margin-bottom:3px;

        }

        .pd-card-sub {

            color:#9aa09c;

            font-size:10.5px;

        }

        .pd-view-all {

            color:var(--pd-green);

            text-decoration:none;

            font-size:10.5px;

            font-weight:800;

        }

        .pd-view-all:hover {

            text-decoration:underline;
            color:var(--pd-green-2);

        }


        /* =========================
           PROPERTY CARDS
        ========================= */

        .pd-property-grid {

            padding:18px;

            display:grid;

            grid-template-columns:
                repeat(2,minmax(0,1fr));

            gap:14px;

        }

        .pd-property {

            border:1px solid #e9ece8;

            border-radius:15px;

            overflow:hidden;

            background:#fff;

            transition:.22s ease;

        }

        .pd-property:hover {

            transform:translateY(-3px);

            box-shadow:
                0 10px 27px rgba(18,55,42,.09);

            border-color:#dbe2dd;

        }

        .pd-property-image {

            height:145px;

            position:relative;

            overflow:hidden;

            background:#f0f3f0;

        }

        .pd-property-image img {

            width:100%;
            height:100%;

            object-fit:cover;

            display:block;

            transition:.35s ease;

        }

        .pd-property:hover
        .pd-property-image img {

            transform:scale(1.05);

        }

        .pd-property-placeholder {

            width:100%;
            height:100%;

            display:flex;

            align-items:center;
            justify-content:center;

            font-size:35px;

            background:
                linear-gradient(
                    135deg,
                    #eef4f0,
                    #f8f7f2
                );

        }

        .pd-property-status {

            position:absolute;

            top:9px;
            left:9px;

            padding:5px 8px;

            border-radius:30px;

            background:rgba(255,255,255,.94);

            font-size:8px;

            font-weight:850;

            box-shadow:0 4px 10px rgba(0,0,0,.08);

        }

        .status-available {
            color:#23834d;
        }

        .status-sold {
            color:#c7433b;
        }

        .status-rented {
            color:#477bd2;
        }

        .status-hold {
            color:#a27808;
        }

        .pd-property-purpose {

            position:absolute;

            right:9px;
            top:9px;

            padding:5px 8px;

            border-radius:30px;

            color:#fff;

            font-size:8px;

            font-weight:850;

            background:var(--pd-green);

        }

        .pd-property-body {

            padding:13px;

        }

        .pd-property-type {

            color:#66706b;

            font-size:8.5px;

            font-weight:750;

            text-transform:uppercase;

            letter-spacing:.5px;

            margin-bottom:4px;

        }

        .pd-property-title {

            color:var(--pd-charcoal);

            font-size:13px;

            font-weight:850;

            margin-bottom:5px;

            white-space:nowrap;

            overflow:hidden;

            text-overflow:ellipsis;

        }

        .pd-property-address {

            color:#969c98;

            font-size:9.5px;

            white-space:nowrap;

            overflow:hidden;

            text-overflow:ellipsis;

            margin-bottom:10px;

        }

        .pd-property-bottom {

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:8px;

            padding-top:10px;

            border-top:1px solid #f0f1ee;

        }

        .pd-property-price {

            color:var(--pd-green);

            font-size:13px;

            font-weight:850;

        }

        .pd-property-price small {

            color:#999;

            font-size:8px;

            font-weight:500;

        }

        .pd-property-view {

            padding:6px 10px;

            border-radius:8px;

            background:#edf5f0;

            color:var(--pd-green);

            text-decoration:none;

            font-size:9px;

            font-weight:800;

            transition:.2s;

        }

        .pd-property-view:hover {

            background:var(--pd-green);

            color:#fff;

        }


        /* =========================
           EMPTY
        ========================= */

        .pd-empty {

            padding:50px 20px;

            text-align:center;

        }

        .pd-empty-icon {

            width:65px;
            height:65px;

            margin:auto;

            border-radius:19px;

            background:#eef4f0;

            display:flex;

            align-items:center;
            justify-content:center;

            font-size:29px;

        }

        .pd-empty h5 {

            color:var(--pd-charcoal);

            font-size:14px;

            font-weight:850;

            margin:14px 0 5px;

        }

        .pd-empty p {

            color:#9ba19d;

            font-size:10.5px;

            margin-bottom:15px;

        }


        /* =========================
           ANALYTICS
        ========================= */

        .pd-analytics {

            padding:20px;

        }

        .pd-progress-row {

            margin-bottom:17px;

        }

        .pd-progress-top {

            display:flex;

            justify-content:space-between;

            margin-bottom:7px;

        }

        .pd-progress-label {

            display:flex;

            align-items:center;

            gap:7px;

            color:#606863;

            font-size:10px;

            font-weight:700;

        }

        .pd-progress-dot {

            width:8px;
            height:8px;

            border-radius:50%;

        }

        .pd-progress-value {

            color:var(--pd-charcoal);

            font-size:10px;

            font-weight:850;

        }

        .pd-progress {

            height:7px;

            background:#f0f2ef;

            border-radius:30px;

            overflow:hidden;

        }

        .pd-progress-bar {

            height:100%;

            border-radius:30px;

            transition:width .5s ease;

        }

        .pd-mini-stats {

            display:grid;

            grid-template-columns:
                repeat(3,1fr);

            gap:8px;

            margin-top:22px;

        }

        .pd-mini-stat {

            padding:11px;

            border-radius:11px;

            background:#f8f9f7;

            text-align:center;

        }

        .pd-mini-number {

            font-size:17px;

            font-weight:850;

            color:var(--pd-charcoal);

        }

        .pd-mini-label {

            font-size:8px;

            color:#9ca29e;

            margin-top:2px;

        }


        /* =========================
           QUICK ACTIONS
        ========================= */

        .pd-actions {

            padding:18px;

        }

        .pd-action {

            display:flex;

            align-items:center;

            gap:12px;

            padding:12px;

            border-radius:13px;

            text-decoration:none;

            color:var(--pd-charcoal);

            transition:.2s ease;

            margin-bottom:7px;

        }

        .pd-action:last-child {

            margin-bottom:0;

        }

        .pd-action:hover {

            background:#f6f8f6;

            color:var(--pd-charcoal);

            transform:translateX(4px);

        }

        .pd-action-icon {

            width:37px;
            height:37px;

            border-radius:11px;

            display:flex;

            align-items:center;
            justify-content:center;

            font-size:15px;

            flex-shrink:0;

        }

        .pd-action-text {

            flex:1;

        }

        .pd-action-title {

            font-size:10.5px;

            font-weight:800;

        }

        .pd-action-sub {

            color:#9ba19d;

            font-size:8.5px;

            margin-top:2px;

        }

        .pd-action-arrow {

            color:#adb3af;

            font-size:16px;

        }


        /* =========================
           BOTTOM CTA
        ========================= */

        .pd-cta {

            position:relative;

            overflow:hidden;

            padding:25px 27px;

            border-radius:21px;

            background:
                linear-gradient(
                    135deg,
                    #f7f5ef,
                    #f2f0e7
                );

            border:1px solid #e9e5d9;

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:20px;

        }

        .pd-cta:after {

            content:"✦";

            position:absolute;

            right:30px;
            top:-17px;

            color:rgba(201,162,39,.16);

            font-size:100px;

        }

        .pd-cta-content {

            position:relative;
            z-index:2;

        }

        .pd-cta h4 {

            color:var(--pd-green);

            font-size:17px;

            font-weight:850;

            margin:0 0 5px;

        }

        .pd-cta p {

            color:#8d948f;

            font-size:10.5px;

            margin:0;

        }

        .pd-cta-btn {

            position:relative;
            z-index:2;

            display:inline-flex;

            align-items:center;

            gap:7px;

            background:var(--pd-green);

            color:#fff;

            text-decoration:none;

            padding:10px 17px;

            border-radius:10px;

            font-size:10.5px;

            font-weight:800;

            white-space:nowrap;

        }

        .pd-cta-btn:hover {

            background:var(--pd-green-2);

            color:#fff;

        }


        /* =========================
           MOBILE
        ========================= */

        @media(max-width:991px) {

            .pd-property-grid {

                grid-template-columns:1fr;

            }

        }

        @media(max-width:767px) {

            .pd-header h2 {

                font-size:23px;

            }

            .pd-add-btn {

                width:100%;

                justify-content:center;

            }

            .pd-hero {

                padding:23px;

            }

            .pd-hero-content {

                display:block;

            }

            .pd-hero h1 {

                font-size:23px;

            }

            .pd-hero-side {

                margin-top:18px;

                min-width:0;

            }

            .pd-property-grid {

                padding:13px;

            }

            .pd-card-header {

                padding:17px;

            }

            .pd-analytics,
            .pd-actions {

                padding:16px;

            }

            .pd-mini-stats {

                grid-template-columns:
                    repeat(3,1fr);

            }

            .pd-cta {

                display:block;

                padding:22px;

            }

            .pd-cta-btn {

                margin-top:15px;

                width:100%;

                justify-content:center;

            }

        }

    </style>


    <div class="pd-page py-4">

        <div class="container-fluid px-4 pd-container">


            {{-- ================= HERO ================= --}}

            <div class="pd-hero mb-4">

                <div class="pd-hero-content">

                    <div class="pd-hero-left">

                        <div class="pd-hero-badge">

                            <span class="pd-live-dot"></span>

                            PRODESK DASHBOARD

                        </div>

                        <h1>
                            {{ $greeting }}, {{ $user->name }} 👋
                        </h1>

                        <p class="pd-hero-description">

                            Manage your properties, organize your catalogue
                            and keep everything ready for your next client
                            presentation.

                        </p>


                        <div class="pd-hero-features">

                            <div class="pd-hero-feature">
                                <span>🏠</span>
                                Property Catalogue
                            </div>

                            <div class="pd-hero-feature">
                                <span>📸</span>
                                Media Management
                            </div>

                            <div class="pd-hero-feature">
                                <span>📍</span>
                                Property Locations
                            </div>

                            <div class="pd-hero-feature">
                                <span>⚡</span>
                                Fast Presentation
                            </div>

                        </div>

                    </div>


                    <div class="pd-hero-side">

                        <div class="pd-hero-side-label">
                            Total Listings
                        </div>

                        <div class="pd-hero-side-number">
                            {{ $totalProperties }}
                        </div>

                        <div class="pd-hero-side-text">
                            properties in your catalogue
                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= STAT CARDS ================= --}}

            <div class="row g-3 mb-4">


                {{-- TOTAL --}}

                <div class="col-6 col-xl-3">

                    <div class="pd-stat">

                        <div class="pd-stat-top">

                            <div>

                                <div class="pd-stat-label">
                                    Total Properties
                                </div>

                                <div class="pd-stat-number">
                                    {{ $totalProperties }}
                                </div>

                            </div>

                            <div
                                class="pd-stat-icon"
                                style="background:#eaf4ee;"
                            >
                                🏠
                            </div>

                        </div>


                        <div class="pd-stat-footer">

                            <span class="pd-stat-footer-text">
                                All listings
                            </span>

                            <span class="pd-stat-arrow">
                                →
                            </span>

                        </div>

                    </div>

                </div>


                {{-- SALE --}}

                <div class="col-6 col-xl-3">

                    <div class="pd-stat">

                        <div class="pd-stat-top">

                            <div>

                                <div class="pd-stat-label">
                                    For Sale
                                </div>

                                <div class="pd-stat-number">
                                    {{ $forSale }}
                                </div>

                            </div>

                            <div
                                class="pd-stat-icon"
                                style="background:#fff5d9;"
                            >
                                🏷️
                            </div>

                        </div>


                        <div class="pd-stat-footer">

                            <span class="pd-stat-footer-text">
                                {{ $salePercentage }}% of catalogue
                            </span>

                            <span class="pd-stat-arrow">
                                ↗
                            </span>

                        </div>

                    </div>

                </div>


                {{-- RENT --}}

                <div class="col-6 col-xl-3">

                    <div class="pd-stat">

                        <div class="pd-stat-top">

                            <div>

                                <div class="pd-stat-label">
                                    For Rent
                                </div>

                                <div class="pd-stat-number">
                                    {{ $forRent }}
                                </div>

                            </div>

                            <div
                                class="pd-stat-icon"
                                style="background:#edf4ff;"
                            >
                                🔑
                            </div>

                        </div>


                        <div class="pd-stat-footer">

                            <span class="pd-stat-footer-text">
                                {{ $rentPercentage }}% of catalogue
                            </span>

                            <span class="pd-stat-arrow">
                                ↗
                            </span>

                        </div>

                    </div>

                </div>


                {{-- AVAILABLE --}}

                <div class="col-6 col-xl-3">

                    <div class="pd-stat">

                        <div class="pd-stat-top">

                            <div>

                                <div class="pd-stat-label">
                                    Available
                                </div>

                                <div class="pd-stat-number">
                                    {{ $available }}
                                </div>

                            </div>

                            <div
                                class="pd-stat-icon"
                                style="background:#eaf7ef;"
                            >
                                ✓
                            </div>

                        </div>


                        <div class="pd-stat-footer">

                            <span class="pd-stat-footer-text">
                                {{ $availablePercentage }}% active
                            </span>

                            <span class="pd-stat-arrow">
                                ●
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= MAIN GRID ================= --}}

            <div class="row g-4 mb-4">


                {{-- RECENT PROPERTIES --}}

                <div class="col-xl-8">

                    <div class="pd-card h-100">

                        <div class="pd-card-header">

                            <div>

                                <div class="pd-card-title">
                                    Recent Properties
                                </div>

                                <div class="pd-card-sub">
                                    Your latest listings
                                </div>

                            </div>

                            <a
                                href="{{ route('properties.index') }}"
                                class="pd-view-all"
                            >
                                View All →
                            </a>

                        </div>


                        @if($recentProperties->count())

                            <div class="pd-property-grid">

                                @foreach($recentProperties as $property)

                                    @php

                                        $cover = $property->media
                                            ->where('type','image')
                                            ->where('is_cover',true)
                                            ->first();

                                        if (!$cover) {

                                            $cover = $property->media
                                                ->where('type','image')
                                                ->first();

                                        }

                                    @endphp


                                    <div class="pd-property">


                                        <div class="pd-property-image">

                                            @if($cover)

                                                <img
                                                    src="{{ asset('storage/' . $cover->file_path) }}"
                                                    alt="{{ $property->title }}"
                                                >

                                            @else

                                                <div class="pd-property-placeholder">
                                                    🏠
                                                </div>

                                            @endif


                                            <div
                                                class="pd-property-status status-{{ $property->status }}"
                                            >
                                                ● {{ ucfirst($property->status) }}
                                            </div>


                                            <div class="pd-property-purpose">

                                                {{ strtoupper($property->purpose) }}

                                            </div>

                                        </div>


                                        <div class="pd-property-body">

                                            <div class="pd-property-type">

                                                {{ ucfirst($property->property_type) }}

                                            </div>


                                            <div
                                                class="pd-property-title"
                                                title="{{ $property->title }}"
                                            >
                                                {{ $property->title }}
                                            </div>


                                            <div
                                                class="pd-property-address"
                                                title="{{ $property->address }}"
                                            >
                                                📍 {{ $property->address }}
                                            </div>


                                            <div class="pd-property-bottom">

                                                <div class="pd-property-price">

                                                    ₹{{ number_format($property->price) }}

                                                    @if($property->purpose === 'rent')

                                                        <small>
                                                            / month
                                                        </small>

                                                    @endif

                                                </div>


                                                <a
                                                    href="{{ route('properties.show', $property) }}"
                                                    class="pd-property-view"
                                                >
                                                    View →
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="pd-empty">

                                <div class="pd-empty-icon">
                                    🏠
                                </div>

                                <h5>
                                    No properties yet
                                </h5>

                                <p>
                                    Add your first property to start building your showroom.
                                </p>

                                <a
                                    href="{{ route('properties.create') }}"
                                    class="pd-add-btn"
                                >
                                    ＋ Add Property
                                </a>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- RIGHT COLUMN --}}

                <div class="col-xl-4">


                    {{-- ANALYTICS --}}

                    <div class="pd-card mb-4">

                        <div class="pd-card-header">

                            <div>

                                <div class="pd-card-title">
                                    Catalogue Overview
                                </div>

                                <div class="pd-card-sub">
                                    Property distribution
                                </div>

                            </div>

                            <span style="font-size:18px;">
                                📊
                            </span>

                        </div>


                        <div class="pd-analytics">


                            {{-- SALE --}}

                            <div class="pd-progress-row">

                                <div class="pd-progress-top">

                                    <div class="pd-progress-label">

                                        <span
                                            class="pd-progress-dot"
                                            style="background:#C9A227;"
                                        ></span>

                                        For Sale

                                    </div>

                                    <div class="pd-progress-value">
                                        {{ $forSale }}
                                    </div>

                                </div>


                                <div class="pd-progress">

                                    <div
                                        class="pd-progress-bar"
                                        style="
                                            width:{{ $salePercentage }}%;
                                            background:#C9A227;
                                        "
                                    ></div>

                                </div>

                            </div>


                            {{-- RENT --}}

                            <div class="pd-progress-row">

                                <div class="pd-progress-top">

                                    <div class="pd-progress-label">

                                        <span
                                            class="pd-progress-dot"
                                            style="background:#477bd2;"
                                        ></span>

                                        For Rent

                                    </div>

                                    <div class="pd-progress-value">
                                        {{ $forRent }}
                                    </div>

                                </div>


                                <div class="pd-progress">

                                    <div
                                        class="pd-progress-bar"
                                        style="
                                            width:{{ $rentPercentage }}%;
                                            background:#477bd2;
                                        "
                                    ></div>

                                </div>

                            </div>


                            {{-- AVAILABLE --}}

                            <div class="pd-progress-row mb-0">

                                <div class="pd-progress-top">

                                    <div class="pd-progress-label">

                                        <span
                                            class="pd-progress-dot"
                                            style="background:#36a56b;"
                                        ></span>

                                        Available

                                    </div>

                                    <div class="pd-progress-value">
                                        {{ $available }}
                                    </div>

                                </div>


                                <div class="pd-progress">

                                    <div
                                        class="pd-progress-bar"
                                        style="
                                            width:{{ $availablePercentage }}%;
                                            background:#36a56b;
                                        "
                                    ></div>

                                </div>

                            </div>


                            <div class="pd-mini-stats">

                                <div class="pd-mini-stat">

                                    <div class="pd-mini-number">
                                        {{ $sold }}
                                    </div>

                                    <div class="pd-mini-label">
                                        Sold
                                    </div>

                                </div>


                                <div class="pd-mini-stat">

                                    <div class="pd-mini-number">
                                        {{ $rented }}
                                    </div>

                                    <div class="pd-mini-label">
                                        Rented
                                    </div>

                                </div>


                                <div class="pd-mini-stat">

                                    <div class="pd-mini-number">
                                        {{ $onHold }}
                                    </div>

                                    <div class="pd-mini-label">
                                        Hold
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- QUICK ACTIONS --}}

                    <div class="pd-card">

                        <div class="pd-card-header">

                            <div>

                                <div class="pd-card-title">
                                    Quick Actions
                                </div>

                                <div class="pd-card-sub">
                                    Manage your workspace
                                </div>

                            </div>

                            <span style="font-size:18px;">
                                ⚡
                            </span>

                        </div>


                        <div class="pd-actions">


                            <a
                                href="{{ route('properties.create') }}"
                                class="pd-action"
                            >

                                <div
                                    class="pd-action-icon"
                                    style="background:#eaf4ee;"
                                >
                                    ➕
                                </div>

                                <div class="pd-action-text">

                                    <div class="pd-action-title">
                                        Add Property
                                    </div>

                                    <div class="pd-action-sub">
                                        Create a new listing
                                    </div>

                                </div>

                                <div class="pd-action-arrow">
                                    ›
                                </div>

                            </a>


                            <a
                                href="{{ route('properties.index') }}"
                                class="pd-action"
                            >

                                <div
                                    class="pd-action-icon"
                                    style="background:#fff5d9;"
                                >
                                    🏘️
                                </div>

                                <div class="pd-action-text">

                                    <div class="pd-action-title">
                                        Manage Properties
                                    </div>

                                    <div class="pd-action-sub">
                                        View and edit listings
                                    </div>

                                </div>

                                <div class="pd-action-arrow">
                                    ›
                                </div>

                            </a>


                            <a
                                href="{{ route('profile.edit') }}"
                                class="pd-action"
                            >

                                <div
                                    class="pd-action-icon"
                                    style="background:#edf4ff;"
                                >
                                    👤
                                </div>

                                <div class="pd-action-text">

                                    <div class="pd-action-title">
                                        Profile Settings
                                    </div>

                                    <div class="pd-action-sub">
                                        Manage your account
                                    </div>

                                </div>

                                <div class="pd-action-arrow">
                                    ›
                                </div>

                            </a>


                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= CTA ================= --}}

            <div class="pd-cta">

                <div class="pd-cta-content">

                    <h4>
                        Your Properties. One Digital Showroom.
                    </h4>

                    <p>
                        Keep your listings organized and ready for every client presentation.
                    </p>

                </div>


                <a
                    href="{{ route('properties.index') }}"
                    class="pd-cta-btn"
                >
                    Manage Properties →
                </a>

            </div>


        </div>

    </div>

</x-app-layout>
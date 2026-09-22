<x-app-layout>

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="pd-header">

            <div>
                <div class="pd-gold-line"></div>

                <h2 class="pd-page-title">
                    Properties
                </h2>

                <p class="pd-page-subtitle">
                    Manage, showcase and grow your property listings
                </p>
            </div>


            <div class="pd-header-actions">

                <a href="{{ route('dashboard') }}"
                   class="pd-btn pd-btn-outline">

                    ← Back

                </a>

                <a href="{{ route('properties.create') }}"
                   class="pd-btn pd-btn-primary">

                    <span>+</span>
                    Add Property

                </a>

            </div>

        </div>

    </x-slot>


    {{-- =========================================================
        DATA
    ========================================================== --}}

    @php

        $allProperties = method_exists($properties, 'items')
            ? collect($properties->items())
            : collect($properties);

        $totalCount = $allProperties->count();

        $saleCount = $allProperties
            ->where('purpose', 'sale')
            ->count();

        $rentCount = $allProperties
            ->where('purpose', 'rent')
            ->count();

        $availableCount = $allProperties
            ->where('status', 'available')
            ->count();


        $statusColors = [

            'available' => [
                'bg' => '#E8F7EF',
                'text' => '#16834A',
                'label' => 'Available'
            ],

            'hold' => [
                'bg' => '#FFF4D6',
                'text' => '#A97800',
                'label' => 'On Hold'
            ],

            'sold' => [
                'bg' => '#FDEBE9',
                'text' => '#C0392B',
                'label' => 'Sold'
            ],

            'rented' => [
                'bg' => '#EAF2FF',
                'text' => '#3265B5',
                'label' => 'Rented'
            ],

        ];

    @endphp



    {{-- =========================================================
        PAGE
    ========================================================== --}}

    <div class="pd-page">

        <div class="container-fluid px-4">


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="pd-alert pd-alert-success">

                    <div>
                        ✓
                        {{ session('success') }}
                    </div>

                    <button type="button"
                            class="pd-alert-close"
                            onclick="this.parentElement.remove()">

                        ×

                    </button>

                </div>

            @endif



            {{-- =================================================
                STAT CARDS
            ================================================== --}}

            <div class="row g-4 mb-4">


                {{-- TOTAL --}}
                <div class="col-6 col-xl-3">

                    <div class="pd-stat-card stat-green">

                        <div class="pd-stat-content">

                            <div>

                                <p>
                                    Total Properties
                                </p>

                                <h3>
                                    {{ $totalCount }}
                                </h3>

                                <span>
                                    All listings
                                </span>

                            </div>


                            <div class="pd-stat-icon green-icon">

                                🏠

                            </div>

                        </div>

                    </div>

                </div>



                {{-- SALE --}}
                <div class="col-6 col-xl-3">

                    <div class="pd-stat-card stat-gold">

                        <div class="pd-stat-content">

                            <div>

                                <p>
                                    For Sale
                                </p>

                                <h3>
                                    {{ $saleCount }}
                                </h3>

                                <span>
                                    Sale listings
                                </span>

                            </div>


                            <div class="pd-stat-icon gold-icon">

                                🏷️

                            </div>

                        </div>

                    </div>

                </div>



                {{-- RENT --}}
                <div class="col-6 col-xl-3">

                    <div class="pd-stat-card stat-blue">

                        <div class="pd-stat-content">

                            <div>

                                <p>
                                    For Rent
                                </p>

                                <h3>
                                    {{ $rentCount }}
                                </h3>

                                <span>
                                    Rental listings
                                </span>

                            </div>


                            <div class="pd-stat-icon blue-icon">

                                🔑

                            </div>

                        </div>

                    </div>

                </div>



                {{-- AVAILABLE --}}
                <div class="col-6 col-xl-3">

                    <div class="pd-stat-card stat-purple">

                        <div class="pd-stat-content">

                            <div>

                                <p>
                                    Available
                                </p>

                                <h3>
                                    {{ $availableCount }}
                                </h3>

                                <span>
                                    Ready for clients
                                </span>

                            </div>


                            <div class="pd-stat-icon purple-icon">

                                ✓

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                SEARCH + FILTER
            ================================================== --}}

            <div class="pd-toolbar">


                <div class="pd-search-wrapper">

                    <span class="pd-search-icon">
                        🔍
                    </span>

                    <input type="text"
                           id="pdSearchInput"
                           class="pd-search"
                           placeholder="Search property by title or location...">

                </div>



                <div class="pd-filter-area">

                    <span class="pd-filter-label">
                        Filter:
                    </span>


                    <div class="pd-filter-tabs"
                         id="pdFilterTabs">

                        <button type="button"
                                class="pd-tab active"
                                data-filter="all">

                            All

                        </button>


                        <button type="button"
                                class="pd-tab"
                                data-filter="sale">

                            For Sale

                        </button>


                        <button type="button"
                                class="pd-tab"
                                data-filter="rent">

                            For Rent

                        </button>

                    </div>

                </div>

            </div>



            {{-- =================================================
                PROPERTY GRID
            ================================================== --}}

            <div class="row g-4"
                 id="pdPropertyGrid">


                @forelse($properties as $property)


                    @php

                        $media = $property->media;

                        $cover = $media
                            ->where('type', 'image')
                            ->where('is_cover', true)
                            ->first();

                    @endphp


                    <div class="col-md-6 col-xl-4 pd-property-item"
                         data-purpose="{{ $property->purpose }}"
                         data-search="{{ strtolower($property->title . ' ' . $property->address) }}">


                        {{-- PROPERTY CARD --}}

                        <div class="pd-property-card">


                            {{-- =================================================
                                IMAGE AREA
                            ================================================== --}}

                            <div class="pd-property-image">


                                {{-- Status --}}
                                <span class="pd-status-badge"
                                      style="
                                        background:
                                        {{ $statusColors[$property->status]['bg'] ?? '#f1f1ee' }};

                                        color:
                                        {{ $statusColors[$property->status]['text'] ?? '#555' }};
                                      ">

                                    {{ $statusColors[$property->status]['label'] ?? ucfirst($property->status) }}

                                </span>



                                {{-- Purpose --}}
                                <span class="pd-purpose-badge">

                                    {{ ucfirst($property->purpose) }}

                                </span>



                                {{-- Cover --}}
                                @if($cover)

                                    <span class="pd-cover-badge">

                                        ⭐ Cover

                                    </span>

                                @endif



                                {{-- MEDIA --}}

                                @if($media->count() > 0)


                                    <div id="propertyCarousel{{ $property->id }}"
                                         class="carousel slide h-100"
                                         data-bs-ride="false">


                                        <div class="carousel-inner h-100">


                                            @foreach($media as $index => $item)


                                                <div class="carousel-item h-100
                                                    {{ $index === 0 ? 'active' : '' }}">


                                                    @if($item->type === 'image')

                                                        <img src="{{ asset('storage/' . $item->file_path) }}"
                                                             class="pd-property-img"
                                                             alt="{{ $property->title }}">

                                                    @elseif($item->type === 'video')

                                                        <video class="pd-property-img"
                                                               controls
                                                               preload="metadata">

                                                            <source src="{{ asset('storage/' . $item->file_path) }}">

                                                            Your browser does not support video playback.

                                                        </video>

                                                    @endif


                                                </div>


                                            @endforeach

                                        </div>



                                        {{-- Carousel buttons --}}

                                        @if($media->count() > 1)

                                            <button class="carousel-control-prev"
                                                    type="button"
                                                    data-bs-target="#propertyCarousel{{ $property->id }}"
                                                    data-bs-slide="prev">

                                                <span class="carousel-control-prev-icon"></span>

                                                <span class="visually-hidden">
                                                    Previous
                                                </span>

                                            </button>


                                            <button class="carousel-control-next"
                                                    type="button"
                                                    data-bs-target="#propertyCarousel{{ $property->id }}"
                                                    data-bs-slide="next">

                                                <span class="carousel-control-next-icon"></span>

                                                <span class="visually-hidden">
                                                    Next
                                                </span>

                                            </button>

                                        @endif


                                    </div>


                                @else


                                    {{-- No Image --}}

                                    <div class="pd-no-media">

                                        <div class="pd-house-icon">
                                            🏠
                                        </div>

                                        <span>
                                            No property image
                                        </span>

                                    </div>


                                @endif


                            </div>



                            {{-- =================================================
                                PROPERTY CONTENT
                            ================================================== --}}

                            <div class="pd-property-body">


                                {{-- Property type --}}

                                <div class="pd-property-top">

                                    <span class="pd-type-badge">

                                        {{ ucfirst($property->property_type) }}

                                    </span>


                                    @if($media->count())

                                        <span class="pd-media-count">

                                            📷 {{ $media->count() }}

                                        </span>

                                    @endif

                                </div>



                                {{-- Title --}}

                                <h5 class="pd-property-title">

                                    {{ $property->title }}

                                </h5>



                                {{-- Location --}}

                                <div class="pd-location">

                                    <span>
                                        📍
                                    </span>

                                    <span>
                                        {{ $property->address }}
                                    </span>

                                </div>



                                {{-- Price --}}

                                <div class="pd-price">

                                    ₹{{ number_format($property->price) }}

                                    @if($property->purpose === 'rent')

                                        <small>
                                            / month
                                        </small>

                                    @endif

                                </div>



                                {{-- Meta --}}

                                <div class="pd-property-meta">


                                    @if($property->bedrooms)

                                        <span>

                                            🛏

                                            {{ $property->bedrooms }}

                                            Beds

                                        </span>

                                    @endif


                                    @if($property->bathrooms)

                                        <span>

                                            🚿

                                            {{ $property->bathrooms }}

                                            Baths

                                        </span>

                                    @endif


                                    @if($property->area)

                                        <span>

                                            📐

                                            {{ $property->area }}

                                            sq.ft.

                                        </span>

                                    @endif


                                </div>



                                {{-- Divider --}}

                                <div class="pd-divider"></div>



                                {{-- Actions --}}

                                <div class="pd-actions">


                                    <a href="{{ route('properties.show', $property) }}"
                                       class="pd-view-btn">

                                        View Property →

                                    </a>


                                    <a href="{{ route('properties.edit', $property) }}"
                                       class="pd-edit-btn">

                                        Edit

                                    </a>


                                    <form action="{{ route('properties.destroy', $property) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf

                                        @method('DELETE')


                                        <button type="submit"
                                                class="pd-delete-btn"
                                                onclick="return confirm('Delete this property?')">

                                            🗑

                                        </button>

                                    </form>


                                </div>


                            </div>


                        </div>


                    </div>


                @empty


                    {{-- EMPTY STATE --}}

                    <div class="col-12">

                        <div class="pd-empty">

                            <div class="pd-empty-icon">
                                🏠
                            </div>

                            <h4>
                                No Properties Yet
                            </h4>

                            <p>
                                Start building your digital property showroom.
                            </p>

                            <a href="{{ route('properties.create') }}"
                               class="pd-btn pd-btn-primary">

                                + Add Your First Property

                            </a>

                        </div>

                    </div>

                @endforelse


            </div>



            {{-- =================================================
                NO SEARCH RESULTS
            ================================================== --}}

            <div id="pdNoResults"
                 class="pd-no-results"
                 style="display:none;">

                <div>
                    🔍
                </div>

                <h5>
                    No matching properties
                </h5>

                <p>
                    Try a different search or filter.
                </p>

            </div>



            {{-- =================================================
                PAGINATION
            ================================================== --}}

            @if(method_exists($properties, 'links'))

                <div class="pd-pagination">

                    {{ $properties->links() }}

                </div>

            @endif


        </div>

    </div>



    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>

        /* =====================================================
           VARIABLES
        ====================================================== */

        :root {

            --pd-green: #12372A;
            --pd-green-2: #1D4D3C;
            --pd-green-3: #2D6A52;

            --pd-gold: #C9A227;
            --pd-gold-light: #FFF4D6;

            --pd-cream: #F7F5EF;

            --pd-charcoal: #202522;

            --pd-blue: #4169E1;
            --pd-blue-light: #EEF3FF;

            --pd-purple: #7654C7;
            --pd-purple-light: #F2EDFF;

            --pd-red: #D9534F;
            --pd-red-light: #FFF0EF;

            --pd-border: #E8EBE7;

        }



        /* =====================================================
           HEADER
        ====================================================== */

        .pd-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            flex-wrap: wrap;

            gap: 20px;

        }


        .pd-gold-line {

            width: 42px;

            height: 4px;

            background: linear-gradient(
                90deg,
                var(--pd-gold),
                #E8C75A
            );

            border-radius: 10px;

            margin-bottom: 10px;

        }


        .pd-page-title {

            color: var(--pd-green);

            font-weight: 800;

            font-size: 28px;

            margin: 0;

            letter-spacing: -.5px;

        }


        .pd-page-subtitle {

            color: #7A817D;

            margin: 5px 0 0;

            font-size: 14px;

        }


        .pd-header-actions {

            display: flex;

            gap: 10px;

            align-items: center;

        }



        /* =====================================================
           BUTTONS
        ====================================================== */

        .pd-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 11px 20px;

            border-radius: 11px;

            font-size: 14px;

            font-weight: 700;

            text-decoration: none;

            transition: all .2s ease;

        }


        .pd-btn-primary {

            background:
                linear-gradient(
                    135deg,
                    var(--pd-green),
                    var(--pd-green-3)
                );

            color: white;

            border: none;

            box-shadow:
                0 6px 16px rgba(18,55,42,.16);

        }


        .pd-btn-primary:hover {

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 9px 22px rgba(18,55,42,.24);

        }


        .pd-btn-outline {

            border: 1px solid #D9DDD9;

            color: var(--pd-charcoal);

            background: white;

        }


        .pd-btn-outline:hover {

            color: white;

            background: var(--pd-charcoal);

            border-color: var(--pd-charcoal);

        }



        /* =====================================================
           PAGE
        ====================================================== */

        .pd-page {

            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #F7F8F5 0%,
                    #F7F5EF 100%
                );

            padding: 24px 0 50px;

        }



        /* =====================================================
           ALERT
        ====================================================== */

        .pd-alert {

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 13px 16px;

            border-radius: 13px;

            margin-bottom: 22px;

            font-size: 14px;

            font-weight: 600;

        }


        .pd-alert-success {

            color: #167346;

            background: #E8F7EF;

            border: 1px solid #C8EAD6;

        }


        .pd-alert-close {

            border: none;

            background: transparent;

            font-size: 20px;

            color: inherit;

            cursor: pointer;

        }



        /* =====================================================
           STAT CARDS
        ====================================================== */

        .pd-stat-card {

            position: relative;

            background: white;

            border-radius: 20px;

            padding: 22px;

            overflow: hidden;

            border: 1px solid rgba(18,55,42,.05);

            box-shadow:
                0 5px 20px rgba(18,55,42,.06);

            transition:
                transform .25s ease,
                box-shadow .25s ease;

        }


        .pd-stat-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 15px 32px rgba(18,55,42,.11);

        }


        .pd-stat-card::before {

            content: "";

            position: absolute;

            left: 0;

            top: 0;

            width: 100%;

            height: 4px;

        }


        .stat-green::before {
            background: var(--pd-green);
        }


        .stat-gold::before {
            background: var(--pd-gold);
        }


        .stat-blue::before {
            background: var(--pd-blue);
        }


        .stat-purple::before {
            background: var(--pd-purple);
        }


        .pd-stat-content {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

        }


        .pd-stat-content p {

            color: #747C77;

            font-size: 13px;

            margin: 0 0 5px;

            font-weight: 600;

        }


        .pd-stat-content h3 {

            color: var(--pd-charcoal);

            font-size: 30px;

            font-weight: 800;

            margin: 0;

        }


        .pd-stat-content span {

            color: #9A9F9B;

            font-size: 11px;

            display: block;

            margin-top: 4px;

        }


        .pd-stat-icon {

            width: 55px;

            height: 55px;

            border-radius: 16px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            flex-shrink: 0;

            transition: transform .25s ease;

        }


        .pd-stat-card:hover .pd-stat-icon {

            transform: scale(1.1) rotate(-4deg);

        }


        .green-icon {

            background: #E8F3ED;

        }


        .gold-icon {

            background: #FFF4D6;

        }


        .blue-icon {

            background: #EEF3FF;

        }


        .purple-icon {

            background: #F2EDFF;

        }



        /* =====================================================
           TOOLBAR
        ====================================================== */

        .pd-toolbar {

            background: white;

            border-radius: 20px;

            padding: 17px 20px;

            margin-bottom: 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            flex-wrap: wrap;

            border: 1px solid rgba(18,55,42,.05);

            box-shadow:
                0 5px 18px rgba(18,55,42,.05);

        }


        .pd-search-wrapper {

            position: relative;

            flex: 1;

            min-width: 260px;

            max-width: 430px;

        }


        .pd-search-icon {

            position: absolute;

            left: 14px;

            top: 50%;

            transform: translateY(-50%);

            color: #9A9F9B;

            font-size: 14px;

            pointer-events: none;

        }


        .pd-search {

            width: 100%;

            height: 44px;

            border-radius: 12px;

            border: 1.5px solid #E4E8E3;

            padding: 0 15px 0 40px;

            font-size: 13px;

            background: #FAFBF9;

            transition: all .2s ease;

        }


        .pd-search:focus {

            outline: none;

            background: white;

            border-color: var(--pd-green);

            box-shadow:
                0 0 0 4px rgba(18,55,42,.07);

        }


        .pd-filter-area {

            display: flex;

            align-items: center;

            gap: 10px;

            flex-wrap: wrap;

        }


        .pd-filter-label {

            color: #8A918C;

            font-size: 12px;

            font-weight: 700;

        }


        .pd-filter-tabs {

            display: flex;

            gap: 6px;

            background: #F4F6F3;

            padding: 5px;

            border-radius: 12px;

        }


        .pd-tab {

            border: none;

            background: transparent;

            color: #68706B;

            padding: 8px 15px;

            border-radius: 8px;

            font-size: 12px;

            font-weight: 700;

            cursor: pointer;

            transition: all .2s ease;

        }


        .pd-tab:hover {

            color: var(--pd-green);

            background: white;

        }


        .pd-tab.active {

            color: white;

            background: var(--pd-green);

            box-shadow:
                0 4px 10px rgba(18,55,42,.16);

        }



        /* =====================================================
           PROPERTY CARD
        ====================================================== */

        .pd-property-card {

            height: 100%;

            background: white;

            border-radius: 22px;

            overflow: hidden;

            border: 1px solid rgba(18,55,42,.06);

            box-shadow:
                0 6px 22px rgba(18,55,42,.06);

            transition:
                transform .25s ease,
                box-shadow .25s ease;

        }


        .pd-property-card:hover {

            transform: translateY(-7px);

            box-shadow:
                0 18px 40px rgba(18,55,42,.13);

        }



        /* =====================================================
           IMAGE
        ====================================================== */

        .pd-property-image {

            height: 235px;

            position: relative;

            overflow: hidden;

            background: #EDEFEA;

        }


        .pd-property-img {

            width: 100%;

            height: 235px;

            object-fit: cover;

            transition: transform .55s ease;

        }


        .pd-property-card:hover .pd-property-img {

            transform: scale(1.06);

        }


        .pd-status-badge {

            position: absolute;

            top: 14px;

            left: 14px;

            z-index: 10;

            padding: 6px 11px;

            border-radius: 30px;

            font-size: 10px;

            font-weight: 800;

            backdrop-filter: blur(8px);

            box-shadow:
                0 4px 12px rgba(0,0,0,.10);

        }


        .pd-purpose-badge {

            position: absolute;

            top: 14px;

            right: 14px;

            z-index: 10;

            padding: 6px 12px;

            border-radius: 30px;

            background: rgba(18,55,42,.93);

            color: white;

            font-size: 10px;

            font-weight: 800;

            box-shadow:
                0 4px 12px rgba(0,0,0,.15);

        }


        .pd-cover-badge {

            position: absolute;

            bottom: 14px;

            left: 14px;

            z-index: 10;

            background: rgba(201,162,39,.95);

            color: #202522;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 10px;

            font-weight: 800;

        }


        .pd-no-media {

            height: 100%;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            color: #8B928D;

            background:
                linear-gradient(
                    135deg,
                    #F0F3EF,
                    #E7ECE8
                );

        }


        .pd-house-icon {

            font-size: 48px;

            margin-bottom: 7px;

        }


        .pd-no-media span {

            font-size: 12px;

        }



        /* =====================================================
           PROPERTY BODY
        ====================================================== */

        .pd-property-body {

            padding: 19px;

        }


        .pd-property-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 10px;

            margin-bottom: 10px;

        }


        .pd-type-badge {

            display: inline-flex;

            align-items: center;

            padding: 5px 10px;

            border-radius: 20px;

            background: var(--pd-purple-light);

            color: var(--pd-purple);

            font-size: 10px;

            font-weight: 800;

        }


        .pd-media-count {

            color: #89918C;

            font-size: 11px;

            font-weight: 600;

        }


        .pd-property-title {

            color: var(--pd-charcoal);

            font-size: 17px;

            font-weight: 800;

            margin: 0 0 7px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;

        }


        .pd-location {

            display: flex;

            align-items: flex-start;

            gap: 5px;

            color: #7A817D;

            font-size: 12px;

            min-height: 34px;

        }


        .pd-price {

            color: var(--pd-green);

            font-size: 22px;

            font-weight: 850;

            margin: 13px 0;

            letter-spacing: -.4px;

        }


        .pd-price small {

            color: #8B928D;

            font-size: 11px;

            font-weight: 600;

        }


        .pd-property-meta {

            display: flex;

            gap: 7px;

            flex-wrap: wrap;

        }


        .pd-property-meta span {

            background: #F5F7F4;

            border: 1px solid #E9EDE9;

            color: #646C67;

            padding: 6px 9px;

            border-radius: 8px;

            font-size: 10px;

            font-weight: 700;

        }


        .pd-divider {

            height: 1px;

            background: #EDF0EC;

            margin: 17px 0 14px;

        }



        /* =====================================================
           ACTIONS
        ====================================================== */

        .pd-actions {

            display: flex;

            align-items: center;

            gap: 7px;

        }


        .pd-view-btn {

            flex: 1;

            text-align: center;

            background:
                linear-gradient(
                    135deg,
                    var(--pd-green),
                    var(--pd-green-3)
                );

            color: white;

            padding: 9px 12px;

            border-radius: 9px;

            font-size: 11px;

            font-weight: 800;

            text-decoration: none;

            transition: all .2s ease;

        }


        .pd-view-btn:hover {

            color: white;

            transform: translateY(-1px);

            box-shadow:
                0 5px 13px rgba(18,55,42,.18);

        }


        .pd-edit-btn {

            padding: 9px 13px;

            border-radius: 9px;

            border: 1px solid #DDE2DD;

            background: #FAFBF9;

            color: #4E5752;

            font-size: 11px;

            font-weight: 800;

            text-decoration: none;

            transition: all .2s ease;

        }


        .pd-edit-btn:hover {

            color: var(--pd-green);

            border-color: var(--pd-gold);

            background: var(--pd-cream);

        }


        .pd-delete-btn {

            width: 36px;

            height: 36px;

            border-radius: 9px;

            border: 1px solid #F1C7C4;

            background: #FFF8F7;

            color: var(--pd-red);

            font-size: 13px;

            cursor: pointer;

            transition: all .2s ease;

        }


        .pd-delete-btn:hover {

            background: var(--pd-red);

            border-color: var(--pd-red);

            color: white;

        }



        /* =====================================================
           EMPTY
        ====================================================== */

        .pd-empty {

            text-align: center;

            background: white;

            border-radius: 22px;

            padding: 70px 20px;

            border: 1px dashed #D8DED9;

        }


        .pd-empty-icon {

            width: 80px;

            height: 80px;

            border-radius: 50%;

            background: var(--pd-green);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 35px;

            margin: auto;

        }


        .pd-empty h4 {

            color: var(--pd-charcoal);

            font-weight: 800;

            margin-top: 20px;

        }


        .pd-empty p {

            color: #858D88;

            font-size: 13px;

            margin-bottom: 20px;

        }



        /* =====================================================
           NO RESULTS
        ====================================================== */

        .pd-no-results {

            text-align: center;

            padding: 55px 20px;

            color: #777;

        }


        .pd-no-results > div {

            font-size: 45px;

            margin-bottom: 10px;

        }


        .pd-no-results h5 {

            font-weight: 800;

            color: var(--pd-charcoal);

        }


        .pd-no-results p {

            font-size: 13px;

        }



        /* =====================================================
           PAGINATION
        ====================================================== */

        .pd-pagination {

            margin-top: 35px;

            display: flex;

            justify-content: center;

        }



        /* =====================================================
           MOBILE
        ====================================================== */

        @media(max-width: 767px) {

            .pd-page {

                padding: 18px 0 35px;

            }


            .pd-page-title {

                font-size: 24px;

            }


            .pd-page-subtitle {

                font-size: 12px;

            }


            .pd-header-actions {

                width: 100%;

            }


            .pd-header-actions .pd-btn {

                flex: 1;

            }


            .pd-stat-card {

                padding: 16px;

            }


            .pd-stat-content h3 {

                font-size: 24px;

            }


            .pd-stat-icon {

                width: 45px;

                height: 45px;

                font-size: 18px;

            }


            .pd-toolbar {

                align-items: stretch;

                padding: 14px;

            }


            .pd-search-wrapper {

                max-width: none;

                min-width: 100%;

            }


            .pd-filter-area {

                width: 100%;

                justify-content: space-between;

            }


            .pd-filter-tabs {

                flex: 1;

                justify-content: space-between;

            }


            .pd-tab {

                flex: 1;

                padding: 8px 7px;

            }


            .pd-property-image,
            .pd-property-img {

                height: 220px;

            }


            .pd-property-body {

                padding: 17px;

            }


            .pd-property-title {

                font-size: 16px;

            }


            .pd-price {

                font-size: 20px;

            }

        }


        @media(max-width: 400px) {

            .pd-stat-content span {

                display: none;

            }


            .pd-stat-content h3 {

                font-size: 21px;

            }


            .pd-stat-icon {

                width: 40px;

                height: 40px;

            }

        }

    </style>



    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {


            const searchInput =
                document.getElementById('pdSearchInput');


            const tabs =
                document.querySelectorAll(
                    '#pdFilterTabs .pd-tab'
                );


            const items =
                document.querySelectorAll(
                    '.pd-property-item'
                );


            const noResults =
                document.getElementById('pdNoResults');


            let activeFilter = 'all';



            function applyFilters() {


                const query =
                    (searchInput.value || '')
                    .toLowerCase()
                    .trim();


                let visibleCount = 0;



                items.forEach(function (item) {


                    const matchesFilter =
                        activeFilter === 'all' ||
                        item.dataset.purpose === activeFilter;


                    const matchesSearch =
                        !query ||
                        item.dataset.search.includes(query);


                    const show =
                        matchesFilter &&
                        matchesSearch;


                    item.style.display =
                        show ? '' : 'none';


                    if (show) {

                        visibleCount++;

                    }

                });



                if (noResults) {

                    noResults.style.display =
                        visibleCount === 0 && items.length > 0
                            ? 'block'
                            : 'none';

                }

            }



            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    applyFilters
                );

            }



            tabs.forEach(function (tab) {


                tab.addEventListener(
                    'click',
                    function () {


                        tabs.forEach(function (t) {

                            t.classList.remove('active');

                        });


                        tab.classList.add('active');


                        activeFilter =
                            tab.dataset.filter;


                        applyFilters();

                    }
                );

            });


        });

    </script>


</x-app-layout>
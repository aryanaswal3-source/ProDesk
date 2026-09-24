<x-app-layout>

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="pd-show-header">

            <div>

                <div class="pd-gold-line"></div>

                <h2 class="pd-show-title">
                    {{ $property->title }}
                </h2>

                <p class="pd-show-location">
                    📍 {{ $property->address }}
                </p>

            </div>


            <div class="pd-header-actions">

                <a href="{{ route('properties.index') }}" class="pd-btn pd-btn-outline">

                    ← Back

                </a>

                <a href="{{ route('properties.edit', $property) }}" class="pd-btn pd-btn-primary">

                    ✎ Edit Property

                </a>

                <a href="{{ route('properties.public', $property) }}" target="_blank" rel="noopener noreferrer"
                    class="pd-btn pd-btn-outline">

                    ↗ Public View

                </a>

                <button type="button" class="pd-btn pd-btn-outline" onclick="shareProperty()">
                    🔗 Share Property
                </button>


            </div>

        </div>

    </x-slot>



    {{-- =========================================================
        DATA
    ========================================================== --}}

    @php

        $images = $property->media->where('type', 'image');

        $videos = $property->media->where('type', 'video');

        $cover = $images->where('is_cover', true)->first() ?? $images->first();

        $statusColors = [
            'available' => [
                'bg' => '#E8F7EF',
                'text' => '#16834A',
                'label' => 'Available',
            ],

            'hold' => [
                'bg' => '#FFF4D6',
                'text' => '#A97800',
                'label' => 'On Hold',
            ],

            'sold' => [
                'bg' => '#FDEBE9',
                'text' => '#C0392B',
                'label' => 'Sold',
            ],

            'rented' => [
                'bg' => '#EAF2FF',
                'text' => '#3265B5',
                'label' => 'Rented',
            ],
        ];

        $statusColor = $statusColors[$property->status] ?? [
            'bg' => '#F1F1EE',
            'text' => '#555',
            'label' => ucfirst($property->status),
        ];

    @endphp



    {{-- =========================================================
        PAGE
    ========================================================== --}}

    <div class="pd-show-page">

        <div class="container-fluid px-4">


            {{-- SUCCESS MESSAGE --}}

            @if (session('success'))
                <div class="pd-alert">

                    <span>
                        ✓ {{ session('success') }}
                    </span>

                    <button type="button" onclick="this.parentElement.remove()">

                        ×

                    </button>

                </div>
            @endif



            {{-- =================================================
                HERO / GALLERY + INFO
            ================================================== --}}

            <div class="row g-4 mb-4">


                {{-- =============================================
                    GALLERY
                ============================================== --}}

                <div class="col-xl-8">


                    <div class="pd-gallery-card">


                        {{-- MAIN IMAGE --}}

                        <div class="pd-main-media">


                            @if ($cover)
                                <img id="pdMainImage" src="{{ asset('storage/' . $cover->file_path) }}"
                                    class="pd-main-image" alt="{{ $property->title }}">


                                {{-- IMAGE COUNTER --}}

                                <div class="pd-image-counter">

                                    📷 {{ $images->count() }}

                                </div>


                                {{-- COVER LABEL --}}

                                <div class="pd-gallery-label">

                                    ⭐ Cover Photo

                                </div>
                            @else
                                <div class="pd-gallery-placeholder">

                                    <div>
                                        🏠
                                    </div>

                                    <span>
                                        No property image available
                                    </span>

                                </div>
                            @endif

                        </div>



                        {{-- THUMBNAILS --}}

                        @if ($images->count() > 0)

                            <div class="pd-thumb-wrapper">

                                <div class="pd-thumb-strip">


                                    @foreach ($images as $media)
                                        <div
                                            class="pd-thumb-item
                                            {{ $cover && $cover->id === $media->id ? 'active' : '' }}">

                                            <img src="{{ asset('storage/' . $media->file_path) }}" class="pd-thumb"
                                                alt="Property photo"
                                                onclick="
                                                    document.getElementById('pdMainImage').src = this.src;

                                                    document.querySelectorAll('.pd-thumb-item')
                                                        .forEach(el => el.classList.remove('active'));

                                                    this.parentElement.classList.add('active');
                                                 ">

                                        </div>
                                    @endforeach


                                </div>

                            </div>

                        @endif


                    </div>


                </div>



                {{-- =============================================
                    INFO CARD
                ============================================== --}}

                <div class="col-xl-4">


                    <div class="pd-info-card">


                        {{-- STATUS --}}

                        <div class="pd-info-top">

                            <span class="pd-status"
                                style="
                                    background:{{ $statusColor['bg'] }};
                                    color:{{ $statusColor['text'] }};
                                  ">

                                {{ $statusColor['label'] }}

                            </span>


                            <span class="pd-purpose">

                                {{ ucfirst($property->purpose) }}

                            </span>

                        </div>



                        {{-- PRICE --}}

                        <div class="pd-big-price">

                            ₹{{ number_format($property->price) }}

                            @if ($property->purpose === 'rent')
                                <small>
                                    / month
                                </small>
                            @endif

                        </div>



                        <div class="pd-type-line">

                            {{ ucfirst($property->property_type) }}

                            <span>•</span>

                            {{ ucfirst($property->purpose) }}

                        </div>



                        {{-- QUICK SPECS --}}

                        <div class="pd-spec-grid">


                            <div class="pd-spec">

                                <div class="pd-spec-icon green">
                                    📐
                                </div>

                                <div>

                                    <small>
                                        Area
                                    </small>

                                    <strong>
                                        {{ $property->area ?? 'N/A' }}
                                        @if ($property->area)
                                            sq.ft.
                                        @endif
                                    </strong>

                                </div>

                            </div>



                            <div class="pd-spec">

                                <div class="pd-spec-icon gold">
                                    🛏
                                </div>

                                <div>

                                    <small>
                                        Bedrooms
                                    </small>

                                    <strong>
                                        {{ $property->bedrooms ?? 'N/A' }}
                                    </strong>

                                </div>

                            </div>



                            <div class="pd-spec">

                                <div class="pd-spec-icon blue">
                                    🚿
                                </div>

                                <div>

                                    <small>
                                        Bathrooms
                                    </small>

                                    <strong>
                                        {{ $property->bathrooms ?? 'N/A' }}
                                    </strong>

                                </div>

                            </div>



                            <div class="pd-spec">

                                <div class="pd-spec-icon purple">
                                    🏠
                                </div>

                                <div>

                                    <small>
                                        Type
                                    </small>

                                    <strong>
                                        {{ ucfirst($property->property_type) }}
                                    </strong>

                                </div>

                            </div>


                        </div>



                        {{-- ADDRESS --}}

                        <div class="pd-address-box">

                            <div class="pd-address-icon">
                                📍
                            </div>

                            <div>

                                <small>
                                    Property Location
                                </small>

                                <strong>
                                    {{ $property->address }}
                                </strong>

                            </div>

                        </div>



                        {{-- EDIT BUTTON --}}

                        <a href="{{ route('properties.edit', $property) }}" class="pd-edit-main-btn">

                            ✎ Edit Property & Media

                        </a>


                    </div>


                </div>


            </div>



            {{-- =================================================
                DESCRIPTION
            ================================================== --}}

            <div class="pd-section-card mb-4">


                <div class="pd-section-heading">

                    <div class="pd-section-icon green">
                        📝
                    </div>

                    <div>

                        <h4>
                            Property Description
                        </h4>

                        <p>
                            Property details and information
                        </p>

                    </div>

                </div>


                <div class="pd-description">

                    {{ $property->description ?? 'No description added yet.' }}

                </div>


            </div>



            {{-- =================================================
                PROPERTY VIDEOS
            ================================================== --}}

            @if ($videos->count())


                <div class="pd-section-heading standalone">

                    <div class="pd-section-icon purple">
                        ▶
                    </div>

                    <div>

                        <h4>
                            Property Videos
                        </h4>

                        <p>
                            Walkthroughs and property presentations
                        </p>

                    </div>

                </div>



                <div class="row g-4 mb-4">


                    @foreach ($videos as $media)
                        <div class="col-md-6 col-xl-4">


                            <div class="pd-video-card">


                                <div class="pd-video-wrapper">

                                    <video controls preload="metadata">

                                        <source src="{{ asset('storage/' . $media->file_path) }}">

                                        Your browser does not support video playback.

                                    </video>

                                </div>


                                <div class="pd-video-footer">

                                    <span>
                                        🎥 Property Video
                                    </span>

                                </div>


                            </div>


                        </div>
                    @endforeach


                </div>
            @else
                <div class="pd-no-video">

                    <div class="pd-no-video-icon">
                        🎥
                    </div>

                    <h5>
                        No Property Videos
                    </h5>

                    <p>
                        Add a property video from the Edit Property page.
                    </p>


                    <a href="{{ route('properties.edit', $property) }}" class="pd-btn pd-btn-primary">

                        + Add Video

                    </a>

                </div>


            @endif


        </div>

    </div>



    {{-- =========================================================
        CSS
    ========================================================== --}}

    <style>
        :root {

            --pd-green: #12372A;
            --pd-green-2: #1d5140;
            --pd-green-3: #2c6b53;

            --pd-gold: #C9A227;
            --pd-gold-light: #FFF4D6;

            --pd-cream: #F7F5EF;

            --pd-charcoal: #202522;

            --pd-blue: #4169E1;
            --pd-blue-light: #EEF3FF;

            --pd-purple: #7654C7;
            --pd-purple-light: #F2EDFF;

            --pd-border: rgba(18,55,42,.07);

            --pd-surface: #ffffff;
            --pd-surface-2: #F8FAF8;

        }


        html,
        body {

            background:
                radial-gradient(
                    circle at 10% 8%,
                    rgba(201,162,39,.10),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 15%,
                    rgba(76,110,220,.12),
                    transparent 34%
                ),
                radial-gradient(
                    circle at 15% 90%,
                    rgba(30,140,120,.10),
                    transparent 36%
                ),
                radial-gradient(
                    circle at 90% 92%,
                    rgba(118,84,199,.10),
                    transparent 36%
                ),
                linear-gradient(160deg,#0a100d 0%,#0b1310 45%,#0c1210 100%) !important;

            background-attachment: fixed;

        }



        /* =====================================================
           PAGE
        ====================================================== */

        .pd-show-page {

            min-height: 100vh;

            background: transparent;

            padding: 25px 0 55px;

        }



        /* =====================================================
           HEADER
        ====================================================== */

        .pd-show-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            flex-wrap: wrap;

            gap: 20px;

        }


        .pd-gold-line {

            width: 42px;

            height: 4px;

            background:
                linear-gradient(90deg,
                    var(--pd-gold),
                    #f3d787);

            border-radius: 10px;

            margin-bottom: 10px;

        }


        .pd-show-title {

            color: #f4f7f4;

            font-size: 27px;

            font-weight: 800;

            margin: 0;

            letter-spacing: -.4px;

        }


        .pd-show-location {

            color: #9aa39c;

            font-size: 13px;

            margin: 5px 0 0;

        }


        .pd-header-actions {

            display: flex;

            gap: 9px;

        }


        .pd-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding: 10px 19px;

            border-radius: 10px;

            font-size: 13px;

            font-weight: 700;

            text-decoration: none;

            transition: all .2s ease;

        }


        .pd-btn-primary {

            background:
                linear-gradient(135deg,
                    var(--pd-green-2),
                    var(--pd-green-3));

            color: white;

            box-shadow:
                0 6px 15px rgba(0, 0, 0, .35);

        }


        .pd-btn-primary:hover {

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 9px 20px rgba(0, 0, 0, .45);

        }


        .pd-btn-outline {

            background: var(--pd-surface);

            border: 1px solid var(--pd-border);

            color: var(--pd-charcoal);

        }


        .pd-btn-outline:hover {

            background: var(--pd-gold);

            color: #201d12;

            border-color: var(--pd-gold);

        }



        /* =====================================================
           ALERT
        ====================================================== */

        .pd-alert {

            display: flex;

            align-items: center;

            justify-content: space-between;

            background: #E8F7EF;

            color: #167346;

            border: 1px solid #C8EAD6;

            border-radius: 13px;

            padding: 12px 16px;

            margin-bottom: 22px;

            font-size: 13px;

            font-weight: 600;

        }


        .pd-alert button {

            border: none;

            background: transparent;

            color: inherit;

            font-size: 20px;

            cursor: pointer;

        }



        /* =====================================================
           GALLERY
        ====================================================== */

        .pd-gallery-card {

            background: var(--pd-surface);

            border-radius: 22px;

            padding: 10px;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .35);

            border: 1px solid var(--pd-border);

        }


        .pd-main-media {

            height: 500px;

            position: relative;

            overflow: hidden;

            border-radius: 17px;

            background: #E9EDE9;

        }


        .pd-main-image {

            width: 100%;

            height: 100%;

            object-fit: cover;

            transition: transform .4s ease;

        }


        .pd-main-image:hover {

            transform: scale(1.02);

        }


        .pd-image-counter {

            position: absolute;

            bottom: 15px;

            right: 15px;

            background: rgba(0, 0, 0, .65);

            color: white;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;

            backdrop-filter: blur(4px);

        }


        .pd-gallery-label {

            position: absolute;

            bottom: 15px;

            left: 15px;

            background: rgba(227, 185, 74, .95);

            color: #201d12;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 10px;

            font-weight: 800;

        }


        .pd-gallery-placeholder {

            height: 100%;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            color: #858D88;

            background:
                linear-gradient(135deg,
                    #F0F3EF,
                    #E7ECE8);

        }


        .pd-gallery-placeholder div {

            font-size: 70px;

            margin-bottom: 10px;

        }


        .pd-gallery-placeholder span {

            font-size: 13px;

        }



        /* =====================================================
           THUMBNAILS
        ====================================================== */

        .pd-thumb-wrapper {

            padding: 10px 3px 2px;

        }


        .pd-thumb-strip {

            display: flex;

            gap: 9px;

            overflow-x: auto;

            padding-bottom: 3px;

        }


        .pd-thumb-item {

            flex-shrink: 0;

            padding: 3px;

            border-radius: 11px;

            border: 2px solid transparent;

            transition: all .2s ease;

        }


        .pd-thumb-item.active {

            border-color: var(--pd-gold);

        }


        .pd-thumb-item:hover {

            border-color: var(--pd-green-3);

        }


        .pd-thumb {

            width: 90px;

            height: 65px;

            object-fit: cover;

            border-radius: 7px;

            display: block;

            cursor: pointer;

        }



        /* =====================================================
           INFO CARD
        ====================================================== */

        .pd-info-card {

            height: 100%;

            background: var(--pd-surface);

            border-radius: 22px;

            padding: 27px;

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .35);

            border: 1px solid var(--pd-border);

        }


        .pd-info-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 10px;

            margin-bottom: 18px;

        }


        .pd-status {

            padding: 7px 13px;

            border-radius: 30px;

            font-size: 10px;

            font-weight: 800;

        }


        .pd-purpose {

            color: #0c1512;

            background: var(--pd-gold);

            padding: 7px 13px;

            border-radius: 30px;

            font-size: 10px;

            font-weight: 800;

        }


        .pd-big-price {

            color: var(--pd-green);

            font-size: 31px;

            font-weight: 850;

            letter-spacing: -.7px;

        }


        .pd-big-price small {

            color: #8B928D;

            font-size: 12px;

            font-weight: 600;

        }


        .pd-type-line {

            color: #858D88;

            font-size: 12px;

            margin-top: 4px;

            margin-bottom: 23px;

        }


        .pd-type-line span {

            margin: 0 5px;

            color: var(--pd-gold);

        }



        /* =====================================================
           SPEC GRID
        ====================================================== */

        .pd-spec-grid {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 10px;

            margin-bottom: 18px;

        }


        .pd-spec {

            display: flex;

            align-items: center;

            gap: 9px;

            padding: 12px;

            background: var(--pd-surface-2);

            border: 1px solid var(--pd-border);

            border-radius: 12px;

        }


        .pd-spec-icon {

            width: 35px;

            height: 35px;

            border-radius: 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 15px;

            flex-shrink: 0;

        }


        .pd-spec-icon.green {

            background: linear-gradient(135deg,#1d5140,#2c6b53);

        }


        .pd-spec-icon.gold {

            background: linear-gradient(135deg,#7a5f14,#a4832a);

        }


        .pd-spec-icon.blue {

            background: linear-gradient(135deg,#243876,#3a54a8);

        }


        .pd-spec-icon.purple {

            background: linear-gradient(135deg,#3a2a63,#5a3f96);

        }


        .pd-spec small {

            display: block;

            color: #85908a;

            font-size: 9px;

            margin-bottom: 2px;

        }


        .pd-spec strong {

            display: block;

            color: var(--pd-charcoal);

            font-size: 11px;

            font-weight: 800;

        }



        /* =====================================================
           ADDRESS
        ====================================================== */

        .pd-address-box {

            display: flex;

            align-items: flex-start;

            gap: 10px;

            padding: 13px;

            background: var(--pd-cream);

            border: 1px solid #eee7d1;

            border-radius: 13px;

            margin-bottom: 20px;

        }


        .pd-address-icon {

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: var(--pd-surface);

            border-radius: 9px;

            flex-shrink: 0;

        }


        .pd-address-box small {

            display: block;

            color: #8a7b47;

            font-size: 9px;

            margin-bottom: 3px;

        }


        .pd-address-box strong {

            display: block;

            color: #4E5752;

            font-size: 11px;

            line-height: 1.5;

        }


        .pd-edit-main-btn {

            display: block;

            text-align: center;

            padding: 12px;

            border-radius: 11px;

            background:
                linear-gradient(135deg,
                    var(--pd-green-2),
                    var(--pd-green-3));

            color: white;

            text-decoration: none;

            font-size: 12px;

            font-weight: 800;

            transition: all .2s ease;

        }


        .pd-edit-main-btn:hover {

            color: white;

            transform: translateY(-2px);

            box-shadow:
                0 7px 17px rgba(0, 0, 0, .4);

        }



        /* =====================================================
           SECTION
        ====================================================== */

        .pd-section-card {

            background: var(--pd-surface);

            border-radius: 20px;

            padding: 25px;

            border: 1px solid var(--pd-border);

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .3);

        }


        .pd-section-heading {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .pd-section-heading.standalone {

            margin: 8px 0 18px;

        }


        .pd-section-icon {

            width: 42px;

            height: 42px;

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

            flex-shrink: 0;

        }


        .pd-section-icon.green {

            background: linear-gradient(135deg,#1d5140,#2c6b53);

        }


        .pd-section-icon.purple {

            background: linear-gradient(135deg,#3a2a63,#5a3f96);

        }


        .pd-section-heading h4 {

            margin: 0;

            color: var(--pd-charcoal);

            font-size: 16px;

            font-weight: 800;

        }


        .pd-section-heading p {

            margin: 3px 0 0;

            color: #919892;

            font-size: 11px;

        }


        .pd-description {

            margin-top: 18px;

            padding-top: 17px;

            border-top: 1px solid var(--pd-border);

            color: #656D68;

            font-size: 13px;

            line-height: 1.8;

            white-space: pre-line;

        }



        /* =====================================================
           VIDEO
        ====================================================== */

        .pd-video-card {

            background: var(--pd-surface);

            border-radius: 19px;

            overflow: hidden;

            border: 1px solid var(--pd-border);

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .3);

            transition: all .25s ease;

        }


        .pd-video-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 18px 36px rgba(0, 0, 0, .45);

        }


        .pd-video-wrapper {

            background: #050806;

            aspect-ratio: 16 / 9;

        }


        .pd-video-wrapper video {

            width: 100%;

            height: 100%;

            display: block;

            object-fit: cover;

        }


        .pd-video-footer {

            padding: 13px 15px;

            color: #68706B;

            font-size: 11px;

            font-weight: 700;

        }



        /* =====================================================
           NO VIDEO
        ====================================================== */

        .pd-no-video {

            background: var(--pd-surface);

            border: 1px dashed var(--pd-border);

            border-radius: 20px;

            text-align: center;

            padding: 45px 20px;

            margin-top: 5px;

        }


        .pd-no-video-icon {

            width: 60px;

            height: 60px;

            border-radius: 50%;

            background: linear-gradient(135deg,#3a2a63,#5a3f96);

            display: flex;

            align-items: center;

            justify-content: center;

            margin: auto;

            font-size: 25px;

        }


        .pd-no-video h5 {

            color: var(--pd-charcoal);

            font-weight: 800;

            margin: 15px 0 5px;

        }


        .pd-no-video p {

            color: #8B928D;

            font-size: 12px;

            margin-bottom: 17px;

        }



        /* =====================================================
           MOBILE
        ====================================================== */

        @media(max-width: 767px) {


            .pd-show-page {

                padding: 18px 0 35px;

            }


            .pd-show-title {

                font-size: 22px;

            }


            .pd-header-actions {

                width: 100%;

            }


            .pd-header-actions .pd-btn {

                flex: 1;

            }


            .pd-main-media {

                height: 300px;

            }


            .pd-info-card {

                padding: 20px;

            }


            .pd-big-price {

                font-size: 27px;

            }


            .pd-section-card {

                padding: 20px;

            }


            .pd-thumb {

                width: 78px;

                height: 58px;

            }

        }


        @media(max-width: 400px) {


            .pd-header-actions {

                gap: 6px;

            }


            .pd-btn {

                padding: 9px 12px;

                font-size: 11px;

            }


            .pd-main-media {

                height: 250px;

            }


            .pd-spec {

                padding: 9px;

            }


            .pd-spec-icon {

                width: 30px;

                height: 30px;

                font-size: 13px;

            }

        }
    </style>

</x-app-layout>

<script>
async function shareProperty() {
    const shareUrl = @json(route('properties.public', $property));
    const shareTitle = @json($property->title);

    const shareData = {
        title: shareTitle,
        text: 'Check out this property on ProDesk: ' + shareTitle,
        url: shareUrl
    };

    try {
        if (navigator.share) {
            await navigator.share(shareData);
        } else {
            await navigator.clipboard.writeText(shareUrl);
            alert('Property link copied successfully!');
        }
    } catch (error) {
        console.log('Share cancelled.');
    }
}
</script>
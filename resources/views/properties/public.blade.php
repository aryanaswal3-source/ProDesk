<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $property->title }} | ProDesk</title>

    <meta name="description"
        content="{{ Str::limit($property->description ?? 'View property details on ProDesk.', 150) }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --green: #12372A;
            --green-2: #1d5140;
            --gold: #C9A227;
            --gold-light: #ead27a;
            --cream: #f8f6ef;
            --text: #202522;
            --muted: #7c8982;
            --border: #e5ebe7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f9f7;
            color: var(--text);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
        }

        /* =========================================
           NAVBAR
        ========================================= */

        .public-navbar {
            height: 72px;
            background: rgba(255, 255, 255, .96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg,
                    var(--gold),
                    var(--gold-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 5px 15px rgba(201, 162, 39, .2);
        }

        .brand-text strong {
            display: block;
            color: var(--green);
            font-size: 19px;
            line-height: 1;
        }

        .brand-text small {
            color: #89958f;
            font-size: 10px;
            letter-spacing: .3px;
        }

        .powered {
            color: #8b9690;
            font-size: 12px;
        }


        /* =========================================
           PAGE
        ========================================= */

        .public-wrapper {
            max-width: 1250px;
            margin: auto;
            padding: 35px 20px 70px;
        }


        /* =========================================
           TOP BAR
        ========================================= */

        .property-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        /* =========================================
           MAIN GRID
        ========================================= */

        .property-layout {
            display: grid;
            grid-template-columns: 1.35fr .65fr;
            gap: 24px;
            align-items: start;
        }


        /* =========================================
           GALLERY
        ========================================= */

        .gallery-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 12px;
            box-shadow: 0 12px 35px rgba(18, 55, 42, .06);
        }

        .main-media {
            width: 100%;
            height: 510px;
            border-radius: 17px;
            overflow: hidden;
            background: #edf2ef;
            position: relative;
        }

        .main-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #89958f;
            font-size: 15px;
        }

        .cover-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(18, 55, 42, .9);
            color: #fff;
            padding: 7px 11px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
        }

        .thumbs {
            display: flex;
            gap: 9px;
            overflow-x: auto;
            padding: 12px 3px 2px;
        }

        .thumb {
            width: 82px;
            height: 64px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid transparent;
            background: #eef2ef;
            cursor: pointer;
        }

        .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumb:hover {
            border-color: var(--gold);
        }


        /* =========================================
           DETAILS CARD
        ========================================= */

        .details-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 27px;
            box-shadow: 0 12px 35px rgba(18, 55, 42, .06);
        }

        .badges {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .badge-purpose {
            background: #f4ecd1;
            color: #846b13;
        }

        .badge-status {
            background: #e8f4ed;
            color: #28724b;
        }

        .details-card h1 {
            margin: 0;
            font-size: 29px;
            line-height: 1.2;
            color: var(--green);
            font-weight: 800;
        }

        .price {
            color: var(--gold);
            font-size: 27px;
            font-weight: 850;
            margin-top: 17px;
        }

        .address {
            margin-top: 12px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .address i {
            color: var(--gold);
            margin-right: 5px;
        }


        /* =========================================
           SPECS
        ========================================= */

        .spec-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 23px;
        }

        .spec {
            background: #f6f9f7;
            border: 1px solid #e8eeea;
            border-radius: 13px;
            padding: 14px;
        }

        .spec i {
            color: var(--gold);
            font-size: 17px;
        }

        .spec small {
            display: block;
            color: #8a968f;
            font-size: 10px;
            margin-top: 6px;
        }

        .spec strong {
            color: var(--green);
            font-size: 14px;
        }


        /* =========================================
           LOCATION
        ========================================= */

        .location-box {
            margin-top: 17px;
            padding: 14px;
            background: var(--cream);
            border: 1px solid #eee7d1;
            border-radius: 13px;
        }

        .location-box small {
            display: block;
            color: #8a7b47;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .location-box span {
            font-size: 13px;
            color: #4d574f;
        }


        /* =========================================
           ACTIONS
        ========================================= */

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr;
            gap: 9px;
            margin-top: 20px;
        }

        .action-btn {
            border: none;
            padding: 12px;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 750;
            text-decoration: none;
            text-align: center;
            transition: .2s ease;
        }

        .btn-map {
            background: #f4f7f5;
            color: var(--green);
            border: 1px solid #e0e9e3;
        }

        .btn-map:hover {
            background: #eaf1ed;
            color: var(--green);
        }


        /* =========================================
           DESCRIPTION
        ========================================= */

        .content-section {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 25px;
            margin-top: 24px;
            box-shadow: 0 10px 30px rgba(18, 55, 42, .04);
        }

        .section-title {
            color: var(--green);
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .description {
            color: #68746d;
            font-size: 14px;
            line-height: 1.8;
            white-space: pre-line;
        }


        /* =========================================
           VIDEO
        ========================================= */

        .video-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .video-card {
            background: #f4f7f5;
            border-radius: 15px;
            overflow: hidden;
        }

        .video-card video {
            width: 100%;
            height: 270px;
            display: block;
            object-fit: cover;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .public-footer {
            margin-top: 40px;
            text-align: center;
            color: #89958f;
            font-size: 11px;
        }

        .public-footer strong {
            color: var(--green);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 992px) {

            .property-layout {
                grid-template-columns: 1fr;
            }

            .main-media {
                height: 450px;
            }

            .details-card h1 {
                font-size: 25px;
            }
        }


        @media (max-width: 768px) {

            .public-navbar {
                height: 64px;
                padding: 0 16px;
            }

            .brand-icon {
                width: 37px;
                height: 37px;
            }

            .brand-text strong {
                font-size: 17px;
            }

            .brand-text small,
            .powered {
                display: none;
            }

            .public-wrapper {
                padding: 22px 14px 45px;
            }

            .property-top {
                align-items: stretch;
                flex-direction: column;
            }

            .main-media {
                height: 300px;
                border-radius: 14px;
            }

            .gallery-card {
                padding: 8px;
                border-radius: 17px;
            }

            .details-card {
                padding: 20px;
                border-radius: 17px;
            }

            .details-card h1 {
                font-size: 22px;
            }

            .price {
                font-size: 23px;
            }

            .content-section {
                padding: 19px;
                border-radius: 17px;
            }

            .video-grid {
                grid-template-columns: 1fr;
            }

            .video-card video {
                height: 230px;
            }
        }


        @media (max-width: 420px) {

            .main-media {
                height: 240px;
            }

            .details-card h1 {
                font-size: 20px;
            }

            .price {
                font-size: 21px;
            }

            .spec-grid {
                gap: 7px;
            }

            .spec {
                padding: 11px;
            }

            .video-card video {
                height: 210px;
            }
        }
    </style>
</head>


<body>

    {{-- =========================
         NAVBAR
    ========================== --}}

    <nav class="public-navbar">

        <a href="{{ url('/') }}" class="brand">

            <div class="brand-icon">
                🏠
            </div>

            <div class="brand-text">
                <strong>ProDesk</strong>
                <small>Your Property Partner</small>
            </div>

        </a>

        <span class="powered">
            Digital Property Showcase
        </span>

    </nav>


    <main class="public-wrapper">

        {{-- MAIN PROPERTY --}}
        <div class="property-layout">


            {{-- =========================
                 GALLERY
            ========================== --}}

            <div class="gallery-card">

                @php
                    $images = $property->media->where('type', 'image');
                    $videos = $property->media->where('type', 'video');

                    $cover = $images->firstWhere('is_cover', true) ?? $images->first();
                @endphp


                <div class="main-media" id="mainMedia">

                    @if ($cover)
                        <img id="mainImage" src="{{ asset('storage/' . $cover->file_path) }}"
                            alt="{{ $property->title }}">

                        <span class="cover-badge">
                            <i class="bi bi-star-fill"></i>
                            Property Preview
                        </span>
                    @else
                        <div class="no-image">
                            <i class="bi bi-image me-2"></i>
                            No property image available
                        </div>
                    @endif

                </div>


                @if ($images->count() > 0)

                    <div class="thumbs">

                        @foreach ($images as $image)
                            <button type="button" class="thumb"
                                onclick="changeImage('{{ asset('storage/' . $image->file_path) }}')">
                                <img src="{{ asset('storage/' . $image->file_path) }}" alt="Property image">
                            </button>
                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =========================
                 DETAILS
            ========================== --}}

            <div class="details-card">

                <div class="badges">

                    <span class="badge-soft badge-purpose">
                        {{ ucfirst($property->purpose) }}
                    </span>

                    <span class="badge-soft badge-status">
                        {{ ucfirst($property->status) }}
                    </span>

                </div>


                <h1>
                    {{ $property->title }}
                </h1>


                <div class="price">
                    ₹{{ number_format($property->price) }}
                </div>


                <div class="address">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $property->address }}
                </div>


                <div class="spec-grid">

                    <div class="spec">

                        <i class="bi bi-buildings"></i>

                        <small>Property Type</small>

                        <strong>
                            {{ ucfirst($property->property_type) }}
                        </strong>

                    </div>


                    <div class="spec">

                        <i class="bi bi-bounding-box"></i>

                        <small>Area</small>

                        <strong>
                            {{ $property->area ? number_format($property->area) . ' sq.ft' : 'N/A' }}
                        </strong>

                    </div>


                    <div class="spec">

                        <i class="bi bi-door-open"></i>

                        <small>Bedrooms</small>

                        <strong>
                            {{ $property->bedrooms ?? 'N/A' }}
                        </strong>

                    </div>


                    <div class="spec">

                        <i class="bi bi-droplet"></i>

                        <small>Bathrooms</small>

                        <strong>
                            {{ $property->bathrooms ?? 'N/A' }}
                        </strong>

                    </div>

                </div>

                <div class="location-box">

                    <small>
                        <i class="bi bi-geo-alt-fill"></i>
                        PROPERTY LOCATION
                    </small>

                    <span>
                        {{ $property->address }}
                    </span>

                </div>

                <div class="action-buttons">

                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($property->address) }}"
                        target="_blank" rel="noopener noreferrer" class="action-btn btn-map">
                        <i class="bi bi-sign-turn-right-fill me-1"></i>
                        Get Directions
                    </a>
                </div>

            </div>

        </div>


        {{-- =========================
             DESCRIPTION
        ========================== --}}

        @if ($property->description)
            <section class="content-section">

                <div class="section-title">
                    <i class="bi bi-file-text me-2"></i>
                    About This Property
                </div>

                <div class="description">
                    {{ $property->description }}
                </div>

            </section>
        @endif


        {{-- =========================
             VIDEOS
        ========================== --}}

        @if ($videos->count())

            <section class="content-section">

                <div class="section-title">
                    <i class="bi bi-play-circle me-2"></i>
                    Property Videos
                </div>

                <div class="video-grid">

                    @foreach ($videos as $video)
                        <div class="video-card">

                            <video controls preload="metadata">
                                <source src="{{ asset('storage/' . $video->file_path) }}">
                                Your browser does not support video playback.
                            </video>

                        </div>
                    @endforeach

                </div>

            </section>

        @endif


        {{-- FOOTER --}}

        <div class="public-footer">

            Powered by
            <strong>ProDesk</strong>
            · Digital Property Showcase

        </div>

    </main>


    <script>
        function changeImage(src) {

            const image = document.getElementById('mainImage');

            if (image) {
                image.src = src;
            }
        }
    </script>

</body>

</html>
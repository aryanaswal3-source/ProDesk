<x-app-layout>

    <x-slot name="header">

        <div class="pd-header">

            <div>
                <div class="pd-eyebrow">
                    <span></span>
                    PROPERTY CATALOGUE
                </div>

                <h2>Create New Property</h2>

                <p>
                    Add a new property to your digital showroom.
                </p>
            </div>

            <a
                href="{{ route('properties.index') }}"
                class="pd-header-back"
            >
                ← Back to Properties
            </a>

        </div>

    </x-slot>


    <style>

        :root {
            --pd-green:#12372A;
            --pd-green-2:#1d4d3c;
            --pd-green-3:#285c49;
            --pd-gold:#C9A227;
            --pd-gold-light:#f8f0cf;
            --pd-cream:#F7F5EF;
            --pd-charcoal:#202522;
            --pd-muted:#8a928d;
            --pd-border:#e8ebe7;
            --pd-red:#d94b3d;
            --pd-blue:#3978d4;
            --pd-purple:#7555c7;
            --pd-orange:#e58a31;
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
            font-weight:800;
            letter-spacing:2px;
            margin-bottom:7px;
        }

        .pd-eyebrow span {
            width:27px;
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
            font-size:13px;
        }

        .pd-header-back {
            display:inline-flex;
            align-items:center;
            gap:7px;
            padding:10px 17px;
            border:1px solid #dedfdb;
            border-radius:11px;
            background:#fff;
            color:var(--pd-charcoal);
            text-decoration:none;
            font-size:12px;
            font-weight:750;
            transition:.2s;
        }

        .pd-header-back:hover {
            background:var(--pd-charcoal);
            color:#fff;
            border-color:var(--pd-charcoal);
        }


        /* =========================
           PAGE BACKGROUND
        ========================= */

        .pd-page {
            min-height:100%;
            background:
                radial-gradient(
                    circle at 8% 3%,
                    rgba(201,162,39,.08),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 95% 20%,
                    rgba(18,55,42,.07),
                    transparent 25%
                );
        }

        .pd-container {
            max-width:1000px;
            margin:auto;
        }


        /* =========================
           TOP HERO
        ========================= */

        .pd-hero {
            position:relative;
            overflow:hidden;
            border-radius:24px;
            padding:28px;
            margin-bottom:22px;
            background:
                linear-gradient(
                    135deg,
                    #12372A,
                    #1c4b3a 60%,
                    #285b48
                );
            color:#fff;
            box-shadow:0 15px 40px rgba(18,55,42,.13);
        }

        .pd-hero:before {
            content:"";
            position:absolute;
            width:270px;
            height:270px;
            border:1px solid rgba(255,255,255,.08);
            border-radius:50%;
            right:-90px;
            top:-150px;
        }

        .pd-hero:after {
            content:"";
            position:absolute;
            width:180px;
            height:180px;
            border:1px solid rgba(201,162,39,.18);
            border-radius:50%;
            right:80px;
            bottom:-130px;
        }

        .pd-hero-content {
            position:relative;
            z-index:2;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:25px;
        }

        .pd-hero-icon {
            width:55px;
            height:55px;
            border-radius:17px;
            background:rgba(255,255,255,.1);
            border:1px solid rgba(255,255,255,.12);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:25px;
            margin-bottom:13px;
        }

        .pd-hero-title {
            font-size:23px;
            font-weight:850;
            margin-bottom:5px;
        }

        .pd-hero-text {
            color:rgba(255,255,255,.65);
            font-size:12px;
            max-width:570px;
            line-height:1.6;
        }

        .pd-hero-side {
            display:flex;
            flex-direction:column;
            align-items:flex-end;
            gap:7px;
        }

        .pd-hero-badge {
            background:rgba(255,255,255,.09);
            border:1px solid rgba(255,255,255,.14);
            padding:7px 12px;
            border-radius:30px;
            font-size:10px;
            font-weight:750;
            white-space:nowrap;
        }

        .pd-hero-gold {
            color:#f2d56a;
            font-size:11px;
            font-weight:750;
        }


        /* =========================
           ERROR
        ========================= */

        .pd-error-box {
            background:#fff0ee;
            border:1px solid #f2c5bf;
            border-radius:16px;
            padding:16px 20px;
            color:#8d3026;
            margin-bottom:20px;
        }

        .pd-error-title {
            font-size:13px;
            font-weight:800;
            margin-bottom:6px;
        }

        .pd-error-box ul {
            margin:0;
            padding-left:18px;
            font-size:12px;
        }


        /* =========================
           CARDS
        ========================= */

        .pd-card {
            background:#fff;
            border:1px solid rgba(18,55,42,.06);
            border-radius:21px;
            overflow:hidden;
            margin-bottom:20px;
            box-shadow:0 8px 28px rgba(18,55,42,.055);
            transition:.25s ease;
        }

        .pd-card:hover {
            box-shadow:0 15px 38px rgba(18,55,42,.09);
            transform:translateY(-1px);
        }

        .pd-card-header {
            padding:22px 25px 18px;
            border-bottom:1px solid #f0f1ee;
            display:flex;
            align-items:center;
            gap:13px;
        }

        .pd-section-icon {
            width:44px;
            height:44px;
            border-radius:14px;
            background:#eaf4ee;
            color:var(--pd-green);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            flex-shrink:0;
        }

        .pd-section-icon.gold {
            background:#fbf3d6;
            color:#9b7808;
        }

        .pd-section-icon.blue {
            background:#edf4ff;
            color:var(--pd-blue);
        }

        .pd-section-icon.purple {
            background:#f2edff;
            color:var(--pd-purple);
        }

        .pd-section-icon.orange {
            background:#fff1e4;
            color:var(--pd-orange);
        }

        .pd-card-title {
            font-size:15px;
            font-weight:850;
            color:var(--pd-charcoal);
            margin-bottom:3px;
        }

        .pd-card-sub {
            font-size:11.5px;
            color:#969d98;
        }

        .pd-card-body {
            padding:25px;
        }


        /* =========================
           FORM
        ========================= */

        .pd-label {
            display:block;
            color:#343a37;
            font-size:12px;
            font-weight:750;
            margin-bottom:7px;
        }

        .pd-required {
            color:var(--pd-red);
        }

        .pd-input,
        .pd-select,
        .pd-textarea {
            width:100%;
            border:1.5px solid #e3e6e2;
            background:#fff;
            color:var(--pd-charcoal);
            border-radius:12px;
            padding:12px 14px;
            font-size:13px;
            outline:none;
            transition:.2s ease;
        }

        .pd-input:hover,
        .pd-select:hover,
        .pd-textarea:hover {
            border-color:#cbd3ce;
        }

        .pd-input:focus,
        .pd-select:focus,
        .pd-textarea:focus {
            border-color:var(--pd-green);
            box-shadow:0 0 0 4px rgba(18,55,42,.07);
        }

        .pd-input::placeholder,
        .pd-textarea::placeholder {
            color:#b0b5b1;
        }

        .pd-textarea {
            min-height:150px;
            resize:vertical;
            line-height:1.7;
        }

        .pd-input-wrap {
            position:relative;
        }

        .pd-prefix {
            position:absolute;
            left:14px;
            top:50%;
            transform:translateY(-50%);
            font-weight:850;
            color:var(--pd-green);
            z-index:2;
        }

        .pd-price-input {
            padding-left:31px;
        }

        .pd-help {
            margin-top:6px;
            font-size:10.5px;
            color:#9ca29e;
        }


        /* =========================
           PURPOSE CARDS
        ========================= */

        .pd-choice-grid {
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:10px;
        }

        .pd-choice {
            position:relative;
        }

        .pd-choice input {
            position:absolute;
            opacity:0;
            pointer-events:none;
        }

        .pd-choice label {
            display:flex;
            align-items:center;
            gap:10px;
            border:1.5px solid #e4e7e3;
            border-radius:12px;
            padding:11px 13px;
            cursor:pointer;
            transition:.2s;
            background:#fff;
        }

        .pd-choice label:hover {
            border-color:#bdcbc3;
        }

        .pd-choice input:checked + label {
            border-color:var(--pd-green);
            background:#f2f8f4;
            box-shadow:0 0 0 3px rgba(18,55,42,.06);
        }

        .pd-choice-icon {
            width:31px;
            height:31px;
            border-radius:9px;
            background:#eef4f0;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:15px;
        }

        .pd-choice-text {
            font-size:11px;
            font-weight:800;
            color:var(--pd-charcoal);
        }

        .pd-choice-sub {
            display:block;
            color:#9aa09c;
            font-size:9px;
            font-weight:500;
            margin-top:2px;
        }


        /* =========================
           DETAILS
        ========================= */

        .pd-detail-box {
            position:relative;
        }

        .pd-detail-icon {
            position:absolute;
            right:13px;
            top:37px;
            font-size:15px;
            opacity:.45;
        }


        /* =========================
           LOCATION
        ========================= */

        .pd-location-box {
            background:
                linear-gradient(
                    135deg,
                    #fafcf9,
                    #fff
                );
            border:1px solid #e6ebe7;
            border-radius:16px;
            padding:17px;
        }

        .pd-location-title {
            display:flex;
            align-items:center;
            gap:8px;
            font-size:11px;
            font-weight:800;
            color:var(--pd-green);
            margin-bottom:10px;
        }

        .pd-location-pin {
            width:29px;
            height:29px;
            border-radius:9px;
            background:#eaf4ee;
            display:flex;
            align-items:center;
            justify-content:center;
        }


        /* =========================
           MEDIA
        ========================= */

        .pd-dropzone {
            position:relative;
            border:2px dashed #d7d4c5;
            border-radius:19px;
            padding:36px 22px;
            text-align:center;
            background:
                radial-gradient(
                    circle at 50% 0,
                    rgba(201,162,39,.08),
                    transparent 55%
                ),
                #fcfbf8;
            cursor:pointer;
            transition:.25s ease;
        }

        .pd-dropzone:hover,
        .pd-dropzone.dragging {
            border-color:var(--pd-gold);
            background:#fffdf5;
            transform:translateY(-1px);
        }

        .pd-drop-icon {
            width:64px;
            height:64px;
            border-radius:19px;
            background:#fbf3d8;
            color:#9b790b;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto 13px;
            font-size:27px;
        }

        .pd-drop-title {
            color:var(--pd-charcoal);
            font-size:15px;
            font-weight:850;
            margin-bottom:5px;
        }

        .pd-drop-sub {
            color:#969c98;
            font-size:11px;
            line-height:1.5;
        }

        .pd-drop-types {
            display:flex;
            justify-content:center;
            gap:7px;
            flex-wrap:wrap;
            margin-top:13px;
        }

        .pd-type-pill {
            background:#fff;
            border:1px solid #e4e4dd;
            color:#777c79;
            border-radius:30px;
            padding:5px 9px;
            font-size:9px;
            font-weight:700;
        }

        .pd-dropzone input {
            display:none;
        }

        .pd-media-limits {
            display:flex;
            justify-content:center;
            gap:8px;
            flex-wrap:wrap;
            margin-top:10px;
        }

        .pd-limit-pill {
            display:inline-flex;
            align-items:center;
            gap:5px;
            background:#eef4f0;
            color:var(--pd-green);
            border-radius:30px;
            padding:5px 11px;
            font-size:9.5px;
            font-weight:800;
        }

        .pd-limit-pill.video {
            background:#fff1e4;
            color:var(--pd-orange);
        }

        .pd-limit-pill span.pd-limit-count {
            font-weight:850;
        }


        /* =========================
           PREVIEW
        ========================= */

        .pd-preview-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-top:20px;
            margin-bottom:12px;
        }

        .pd-preview-title {
            font-size:12px;
            font-weight:850;
            color:var(--pd-charcoal);
        }

        .pd-preview-count {
            background:#eef4f0;
            color:var(--pd-green);
            padding:4px 9px;
            border-radius:30px;
            font-size:9px;
            font-weight:800;
        }

        .pd-preview-grid {
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:10px;
        }

        .pd-preview-card {
            position:relative;
            overflow:hidden;
            height:120px;
            border-radius:13px;
            background:#f1f2ef;
            border:1px solid #e4e7e3;
        }

        .pd-preview-card img {
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .pd-preview-video {
            width:100%;
            height:100%;
            background:#111;
            object-fit:cover;
        }

        .pd-preview-overlay {
            position:absolute;
            left:7px;
            bottom:7px;
            right:7px;
            background:rgba(18,55,42,.88);
            color:#fff;
            padding:5px 7px;
            border-radius:7px;
            font-size:8px;
            font-weight:700;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .pd-preview-badge {
            position:absolute;
            left:7px;
            top:7px;
            background:rgba(18,55,42,.88);
            color:#fff;
            padding:3px 7px;
            border-radius:6px;
            font-size:8px;
            font-weight:800;
            letter-spacing:.4px;
        }

        .pd-preview-badge.video {
            background:rgba(229,138,49,.92);
        }

        .pd-preview-remove {
            position:absolute;
            right:6px;
            top:6px;
            width:24px;
            height:24px;
            border:none;
            border-radius:7px;
            background:rgba(255,255,255,.92);
            color:var(--pd-red);
            font-size:12px;
            font-weight:800;
            cursor:pointer;
        }

        .pd-media-warning {
            margin-top:10px;
            background:#fff0ee;
            border:1px solid #f2c5bf;
            color:#8d3026;
            border-radius:10px;
            padding:9px 13px;
            font-size:11px;
            font-weight:650;
            display:none;
        }

        .pd-media-warning.show {
            display:block;
        }


        /* =========================
           SAVE BAR
        ========================= */

        .pd-save-bar {
            position:sticky;
            bottom:12px;
            z-index:50;
            background:rgba(255,255,255,.94);
            backdrop-filter:blur(14px);
            border:1px solid #e2e5e1;
            box-shadow:0 15px 40px rgba(18,55,42,.13);
            border-radius:17px;
            padding:12px 14px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
        }

        .pd-save-info {
            display:flex;
            align-items:center;
            gap:8px;
            color:#737975;
            font-size:10.5px;
            font-weight:650;
        }

        .pd-save-dot {
            width:8px;
            height:8px;
            border-radius:50%;
            background:#32a269;
            box-shadow:0 0 0 4px rgba(50,162,105,.09);
        }

        .pd-save-actions {
            display:flex;
            gap:8px;
        }

        .pd-cancel {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:10px 17px;
            border:1px solid #ddd;
            border-radius:10px;
            color:#555;
            background:#fff;
            text-decoration:none;
            font-size:11px;
            font-weight:750;
        }

        .pd-cancel:hover {
            background:#f5f5f3;
            color:#333;
        }

        .pd-submit {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            border:none;
            padding:10px 21px;
            border-radius:10px;
            background:var(--pd-green);
            color:#fff;
            font-size:11px;
            font-weight:800;
            box-shadow:0 6px 17px rgba(18,55,42,.2);
            transition:.2s;
        }

        .pd-submit:hover {
            background:var(--pd-green-2);
            transform:translateY(-1px);
        }


        /* =========================
           MOBILE
        ========================= */

        @media(max-width:767px) {

            .pd-header h2 {
                font-size:23px;
            }

            .pd-header-back {
                width:100%;
                justify-content:center;
            }

            .pd-hero {
                padding:22px;
            }

            .pd-hero-content {
                display:block;
            }

            .pd-hero-side {
                align-items:flex-start;
                margin-top:15px;
            }

            .pd-card-header,
            .pd-card-body {
                padding:19px;
            }

            .pd-choice-grid {
                grid-template-columns:1fr;
            }

            .pd-preview-grid {
                grid-template-columns:repeat(2,1fr);
            }

            .pd-preview-card {
                height:130px;
            }

            .pd-save-info {
                display:none;
            }

            .pd-save-bar {
                justify-content:flex-end;
            }

            .pd-save-actions {
                width:100%;
            }

            .pd-cancel,
            .pd-submit {
                flex:1;
            }
        }

    </style>


    <div class="pd-page py-4">

        <div class="container pd-container">


            {{-- ERROR --}}
            @if ($errors->any())

                <div class="pd-error-box">

                    <div class="pd-error-title">
                        ⚠️ Please check the information
                    </div>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- HERO --}}
            <div class="pd-hero">

                <div class="pd-hero-content">

                    <div>

                        <div class="pd-hero-icon">
                            🏡
                        </div>

                        <div class="pd-hero-title">
                            Build Your Property Listing
                        </div>

                        <div class="pd-hero-text">
                            Add complete property information, location,
                            pricing and media to create a professional
                            digital presentation for your clients.
                        </div>

                    </div>


                    <div class="pd-hero-side">

                        <div class="pd-hero-badge">
                            ✦ PRODESK SHOWROOM
                        </div>

                        <div class="pd-hero-gold">
                            Showcase Better. Close Faster.
                        </div>

                    </div>

                </div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('properties.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="propertyCreateForm"
            >

                @csrf


                {{-- ================= BASIC INFO ================= --}}
                <div class="pd-card">

                    <div class="pd-card-header">

                        <div class="pd-section-icon">
                            🏠
                        </div>

                        <div>
                            <div class="pd-card-title">
                                Basic Information
                            </div>

                            <div class="pd-card-sub">
                                Start with the identity, type and pricing of your property.
                            </div>
                        </div>

                    </div>


                    <div class="pd-card-body">

                        <div class="row g-4">

                            <div class="col-md-8">

                                <label class="pd-label">
                                    Property Title
                                    <span class="pd-required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="pd-input"
                                    placeholder="e.g. Premium 3 BHK Villa in Dehradun"
                                    required
                                >

                                <div class="pd-help">
                                    Use a clear and attractive title for client presentations.
                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Property Type
                                    <span class="pd-required">*</span>
                                </label>

                                <select
                                    name="property_type"
                                    class="pd-select"
                                    required
                                >

                                    <option value="">
                                        Select Property Type
                                    </option>

                                    <option
                                        value="house"
                                        {{ old('property_type') == 'house' ? 'selected' : '' }}
                                    >
                                        🏠 House
                                    </option>

                                    <option
                                        value="flat"
                                        {{ old('property_type') == 'flat' ? 'selected' : '' }}
                                    >
                                        🏢 Flat / Apartment
                                    </option>

                                    <option
                                        value="plot"
                                        {{ old('property_type') == 'plot' ? 'selected' : '' }}
                                    >
                                        🌳 Plot
                                    </option>

                                    <option
                                        value="shop"
                                        {{ old('property_type') == 'shop' ? 'selected' : '' }}
                                    >
                                        🏪 Shop
                                    </option>

                                    <option
                                        value="office"
                                        {{ old('property_type') == 'office' ? 'selected' : '' }}
                                    >
                                        🏢 Office
                                    </option>

                                </select>

                            </div>


                            {{-- PURPOSE --}}
                            <div class="col-md-4">

                                <label class="pd-label">
                                    Purpose
                                    <span class="pd-required">*</span>
                                </label>

                                <div class="pd-choice-grid">

                                    <div class="pd-choice">

                                        <input
                                            type="radio"
                                            name="purpose"
                                            value="sale"
                                            id="purposeSale"
                                            {{ old('purpose') == 'sale' ? 'checked' : '' }}
                                            required
                                        >

                                        <label for="purposeSale">

                                            <div class="pd-choice-icon">
                                                🏷️
                                            </div>

                                            <div>
                                                <div class="pd-choice-text">
                                                    Sale
                                                </div>

                                                <span class="pd-choice-sub">
                                                    Sell property
                                                </span>
                                            </div>

                                        </label>

                                    </div>


                                    <div class="pd-choice">

                                        <input
                                            type="radio"
                                            name="purpose"
                                            value="rent"
                                            id="purposeRent"
                                            {{ old('purpose') == 'rent' ? 'checked' : '' }}
                                        >

                                        <label for="purposeRent">

                                            <div
                                                class="pd-choice-icon"
                                                style="background:#fff4e7;"
                                            >
                                                🔑
                                            </div>

                                            <div>
                                                <div class="pd-choice-text">
                                                    Rent
                                                </div>

                                                <span class="pd-choice-sub">
                                                    Rent property
                                                </span>
                                            </div>

                                        </label>

                                    </div>

                                </div>

                            </div>


                            {{-- PRICE --}}
                            <div class="col-md-4">

                                <label class="pd-label">
                                    Property Price
                                    <span class="pd-required">*</span>
                                </label>

                                <div class="pd-input-wrap">

                                    <span class="pd-prefix">
                                        ₹
                                    </span>

                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ old('price') }}"
                                        class="pd-input pd-price-input"
                                        placeholder="e.g. 8500000"
                                        min="0"
                                        required
                                    >

                                </div>

                                <div class="pd-help">
                                    Enter the total property price.
                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-4">

                                <label class="pd-label">
                                    Status
                                    <span class="pd-required">*</span>
                                </label>

                                <select
                                    name="status"
                                    class="pd-select"
                                    required
                                >

                                    <option
                                        value="available"
                                        {{ old('status','available') == 'available' ? 'selected' : '' }}
                                    >
                                        🟢 Available
                                    </option>

                                    <option
                                        value="hold"
                                        {{ old('status') == 'hold' ? 'selected' : '' }}
                                    >
                                        🟡 On Hold
                                    </option>

                                    <option
                                        value="sold"
                                        {{ old('status') == 'sold' ? 'selected' : '' }}
                                    >
                                        🔴 Sold
                                    </option>

                                    <option
                                        value="rented"
                                        {{ old('status') == 'rented' ? 'selected' : '' }}
                                    >
                                        🔵 Rented
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================= PROPERTY DETAILS ================= --}}
                <div class="pd-card">

                    <div class="pd-card-header">

                        <div class="pd-section-icon gold">
                            📐
                        </div>

                        <div>

                            <div class="pd-card-title">
                                Property Details
                            </div>

                            <div class="pd-card-sub">
                                Add size and room information.
                            </div>

                        </div>

                    </div>


                    <div class="pd-card-body">

                        <div class="row g-4">

                            <div class="col-md-4">

                                <label class="pd-label">
                                    Area
                                </label>

                                <div class="pd-input-wrap">

                                    <input
                                        type="number"
                                        name="area"
                                        value="{{ old('area') }}"
                                        class="pd-input"
                                        placeholder="e.g. 1800"
                                        min="0"
                                    >

                                </div>

                                <div class="pd-help">
                                    Square feet
                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Bedrooms
                                </label>

                                <input
                                    type="number"
                                    name="bedrooms"
                                    value="{{ old('bedrooms') }}"
                                    class="pd-input"
                                    placeholder="e.g. 3"
                                    min="0"
                                >

                                <div class="pd-help">
                                    Number of bedrooms
                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Bathrooms
                                </label>

                                <input
                                    type="number"
                                    name="bathrooms"
                                    value="{{ old('bathrooms') }}"
                                    class="pd-input"
                                    placeholder="e.g. 2"
                                    min="0"
                                >

                                <div class="pd-help">
                                    Number of bathrooms
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================= LOCATION ================= --}}
                <div class="pd-card">

                    <div class="pd-card-header">

                        <div class="pd-section-icon blue">
                            📍
                        </div>

                        <div>

                            <div class="pd-card-title">
                                Property Location
                            </div>

                            <div class="pd-card-sub">
                                Help clients understand exactly where the property is.
                            </div>

                        </div>

                    </div>


                    <div class="pd-card-body">

                        <div class="pd-location-box">

                            <div class="pd-location-title">

                                <div class="pd-location-pin">
                                    📍
                                </div>

                                Property Address

                            </div>

                            <textarea
                                name="address"
                                class="pd-textarea"
                                rows="3"
                                placeholder="Enter complete property address, locality, city and nearby landmark..."
                                required
                            >{{ old('address') }}</textarea>

                            <div class="pd-help">
                                Example: Rajpur Road, Near Pacific Mall, Dehradun, Uttarakhand
                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================= DESCRIPTION ================= --}}
                <div class="pd-card">

                    <div class="pd-card-header">

                        <div class="pd-section-icon purple">
                            ✍️
                        </div>

                        <div>

                            <div class="pd-card-title">
                                Property Description
                            </div>

                            <div class="pd-card-sub">
                                Tell your clients what makes this property special.
                            </div>

                        </div>

                    </div>


                    <div class="pd-card-body">

                        <textarea
                            name="description"
                            class="pd-textarea"
                            rows="6"
                            placeholder="Describe the property, amenities, surroundings, location advantages, parking, nearby facilities..."
                        >{{ old('description') }}</textarea>

                        <div class="pd-help">
                            A detailed description makes your property presentation more professional.
                        </div>

                    </div>

                </div>


                {{-- ================= MEDIA ================= --}}
                <div class="pd-card">

                    <div class="pd-card-header">

                        <div class="pd-section-icon orange">
                            📸
                        </div>

                        <div>

                            <div class="pd-card-title">
                                Property Media
                            </div>

                            <div class="pd-card-sub">
                                Upload photos and videos to make the property presentation more attractive.
                            </div>

                        </div>

                    </div>


                    <div class="pd-card-body">


                        <label
                            class="pd-dropzone"
                            id="pdDropzone"
                        >

                            <div class="pd-drop-icon">
                                📤
                            </div>

                            <div class="pd-drop-title">
                                Upload Property Photos & Videos
                            </div>

                            <div class="pd-drop-sub">
                                Drag & drop files here or click to browse. You can add photos and videos
                                separately — new selections are added to what you already picked.
                            </div>


                            <div class="pd-drop-types">

                                <span class="pd-type-pill">
                                    JPG
                                </span>

                                <span class="pd-type-pill">
                                    PNG
                                </span>

                                <span class="pd-type-pill">
                                    WEBP
                                </span>

                                <span class="pd-type-pill">
                                    MP4
                                </span>

                                <span class="pd-type-pill">
                                    MOV
                                </span>

                                <span class="pd-type-pill">
                                    WEBM
                                </span>

                            </div>


                            <div class="pd-media-limits">

                                <span class="pd-limit-pill photo">
                                    🖼️ Photos:
                                    <span class="pd-limit-count" id="pdPhotoCount">0</span>/5
                                </span>

                                <span class="pd-limit-pill video">
                                    🎬 Videos:
                                    <span class="pd-limit-count" id="pdVideoCount">0</span>/3
                                </span>

                            </div>


                            <input
                                type="file"
                                name="media[]"
                                id="pdMediaInput"
                                accept="image/*,video/*"
                                multiple
                            >

                        </label>


                        <div
                            class="pd-media-warning"
                            id="pdMediaWarning"
                        ></div>


                        {{-- PREVIEW --}}
                        <div
                            id="pdPreviewSection"
                            style="display:none;"
                        >

                            <div class="pd-preview-header">

                                <div class="pd-preview-title">
                                    Selected Media
                                </div>

                                <div
                                    class="pd-preview-count"
                                    id="pdPreviewCount"
                                >
                                    0 Files
                                </div>

                            </div>


                            <div
                                class="pd-preview-grid"
                                id="pdFilePreview"
                            >
                            </div>

                        </div>


                        <div class="pd-help mt-3">
                            💡 You can upload up to 5 photos and 3 videos. Add them in as many separate selections
                            as you like — each new pick adds on top of what's already selected. The first photo
                            will be used as the cover photo.
                        </div>

                    </div>

                </div>


            </form>


            {{-- SAVE BAR --}}
            <div class="pd-save-bar">

                <div class="pd-save-info">

                    <span class="pd-save-dot"></span>

                    Your property will be added to your ProDesk catalogue.

                </div>


                <div class="pd-save-actions">

                    <a
                        href="{{ route('properties.index') }}"
                        class="pd-cancel"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        form="propertyCreateForm"
                        class="pd-submit"
                    >
                        ✓ Save Property
                    </button>

                </div>

            </div>


        </div>

    </div>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const MAX_PHOTOS = 5;
            const MAX_VIDEOS = 3;

            const dropzone =
                document.getElementById('pdDropzone');

            const input =
                document.getElementById('pdMediaInput');

            const preview =
                document.getElementById('pdFilePreview');

            const previewSection =
                document.getElementById('pdPreviewSection');

            const previewCount =
                document.getElementById('pdPreviewCount');

            const photoCountEl =
                document.getElementById('pdPhotoCount');

            const videoCountEl =
                document.getElementById('pdVideoCount');

            const warningBox =
                document.getElementById('pdMediaWarning');


            /* This is the single source of truth for everything the
               user has picked so far, across every dialog open / drop.
               We never let the browser's native input.files silently
               replace this — we always merge into it instead. */
            let selectedFiles = [];


            function isImage(file) {

                return file.type.startsWith('image/');

            }


            function isVideo(file) {

                return file.type.startsWith('video/');

            }


            function currentPhotoCount() {

                return selectedFiles.filter(isImage).length;

            }


            function currentVideoCount() {

                return selectedFiles.filter(isVideo).length;

            }


            function formatSize(bytes) {

                if (bytes < 1024)
                    return bytes + ' B';

                if (bytes < 1024 * 1024)
                    return (bytes / 1024).toFixed(1) + ' KB';

                return (bytes / (1024 * 1024)).toFixed(1) + ' MB';

            }


            function showWarning(message) {

                warningBox.textContent = message;

                warningBox.classList.add('show');

            }


            function clearWarning() {

                warningBox.textContent = '';

                warningBox.classList.remove('show');

            }


            /* Rebuilds the real <input type="file"> so the form still
               submits every file the user has selected, since we are
               managing the actual list ourselves in `selectedFiles`. */
            function syncInputFiles() {

                const dataTransfer =
                    new DataTransfer();

                selectedFiles.forEach(function (file) {

                    dataTransfer.items.add(file);

                });

                input.files =
                    dataTransfer.files;

            }


            function updateCounts() {

                photoCountEl.textContent =
                    currentPhotoCount();

                videoCountEl.textContent =
                    currentVideoCount();

            }


            /* Adds new files on top of whatever is already selected,
               skipping anything that would push a type over its limit
               (and skipping exact duplicates of an already-picked file). */
            function addFiles(newFiles) {

                clearWarning();

                let addedCount = 0;

                let skippedLimit = 0;


                Array.from(newFiles).forEach(function (file) {

                    const alreadyPicked =
                        selectedFiles.some(function (existing) {

                            return existing.name === file.name &&
                                existing.size === file.size &&
                                existing.lastModified === file.lastModified;

                        });

                    if (alreadyPicked) {

                        return;

                    }


                    if (isImage(file)) {

                        if (currentPhotoCount() >= MAX_PHOTOS) {

                            skippedLimit++;

                            return;

                        }

                        selectedFiles.push(file);

                        addedCount++;

                    } else if (isVideo(file)) {

                        if (currentVideoCount() >= MAX_VIDEOS) {

                            skippedLimit++;

                            return;

                        }

                        selectedFiles.push(file);

                        addedCount++;

                    }

                });


                if (skippedLimit > 0) {

                    showWarning(
                        '⚠️ ' + skippedLimit +
                        ' file(s) were not added — limit is ' +
                        MAX_PHOTOS + ' photos and ' + MAX_VIDEOS +
                        ' videos.'
                    );

                }


                syncInputFiles();

                renderPreview();

            }


            function removeFile(file) {

                selectedFiles = selectedFiles.filter(function (existing) {

                    return existing !== file;

                });

                syncInputFiles();

                renderPreview();

            }


            function renderPreview() {

                preview.innerHTML = '';

                updateCounts();


                if (!selectedFiles.length) {

                    previewSection.style.display = 'none';

                    return;

                }


                previewSection.style.display = 'block';

                previewCount.textContent =
                    selectedFiles.length +
                    (selectedFiles.length === 1 ? ' File' : ' Files');


                selectedFiles.forEach(function (file) {

                    const card =
                        document.createElement('div');

                    card.className =
                        'pd-preview-card';


                    const badge =
                        document.createElement('div');

                    if (isImage(file)) {

                        const img =
                            document.createElement('img');

                        img.src =
                            URL.createObjectURL(file);

                        card.appendChild(img);


                        badge.className =
                            'pd-preview-badge';

                        badge.textContent = 'PHOTO';

                    } else {

                        const video =
                            document.createElement('video');

                        video.src =
                            URL.createObjectURL(file);

                        video.className =
                            'pd-preview-video';

                        video.muted = true;

                        video.preload = 'metadata';

                        card.appendChild(video);


                        badge.className =
                            'pd-preview-badge video';

                        badge.textContent = 'VIDEO';

                    }

                    card.appendChild(badge);


                    const overlay =
                        document.createElement('div');

                    overlay.className =
                        'pd-preview-overlay';

                    overlay.textContent =
                        file.name +
                        ' • ' +
                        formatSize(file.size);


                    card.appendChild(overlay);


                    const remove =
                        document.createElement('button');

                    remove.type = 'button';

                    remove.className =
                        'pd-preview-remove';

                    remove.innerHTML = '×';

                    remove.title =
                        'Remove';


                    remove.addEventListener(
                        'click',
                        function (event) {

                            event.preventDefault();

                            removeFile(file);

                        }
                    );


                    card.appendChild(remove);

                    preview.appendChild(card);

                });

            }


            /* CLICK */

            dropzone.addEventListener(
                'click',
                function () {

                    input.click();

                }
            );


            /* PREVENT LABEL DOUBLE CLICK */

            input.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                }
            );


            /* CHANGE — merge new picks into what's already selected
               instead of letting the browser replace the whole list. */

            input.addEventListener(
                'change',
                function () {

                    addFiles(input.files);

                }
            );


            /* DRAG OVER */

            dropzone.addEventListener(
                'dragover',
                function (event) {

                    event.preventDefault();

                    dropzone.classList.add('dragging');

                }
            );


            /* DRAG LEAVE */

            dropzone.addEventListener(
                'dragleave',
                function () {

                    dropzone.classList.remove('dragging');

                }
            );


            /* DROP — also merged, same as a normal file-dialog pick. */

            dropzone.addEventListener(
                'drop',
                function (event) {

                    event.preventDefault();

                    dropzone.classList.remove('dragging');

                    if (event.dataTransfer.files.length) {

                        addFiles(event.dataTransfer.files);

                    }

                }
            );

        });

    </script>

</x-app-layout>
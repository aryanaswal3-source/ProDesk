<x-app-layout>

    <x-slot name="header">
        <div class="pd-page-header">
            <div>
                <div class="pd-eyebrow">
                    <span></span>
                    PROPERTY MANAGEMENT
                </div>

                <h2>Edit Property</h2>

                <p>
                    Update and manage
                    <strong>{{ $property->title }}</strong>
                </p>
            </div>

            <div class="pd-header-actions">
                <a href="{{ route('properties.show', $property) }}" class="pd-btn pd-btn-light">
                    <span>👁</span>
                    View Property
                </a>

                <a href="{{ route('properties.index') }}" class="pd-btn pd-btn-outline">
                    ← Back
                </a>
            </div>
        </div>
    </x-slot>


    <style>

        :root {
            --pd-green: #12372A;
            --pd-green-2: #1d4d3c;
            --pd-green-3: #285c49;
            --pd-gold: #C9A227;
            --pd-gold-light: #f5e9b9;
            --pd-cream: #F7F5EF;
            --pd-charcoal: #202522;
            --pd-muted: #7b827e;
            --pd-border: #e8e8e2;
            --pd-red: #d94a3d;
            --pd-blue: #3478d4;
            --pd-purple: #7656c8;
            --pd-orange: #e88a2f;
            --pd-shadow: 0 10px 35px rgba(18,55,42,.07);
        }

        .pd-page-header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:25px;
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
            margin-bottom:8px;
        }

        .pd-eyebrow span {
            width:28px;
            height:3px;
            border-radius:10px;
            background:var(--pd-gold);
        }

        .pd-page-header h2 {
            color:var(--pd-green);
            font-size:27px;
            font-weight:800;
            margin:0 0 4px;
            letter-spacing:-.5px;
        }

        .pd-page-header p {
            color:#8a908c;
            margin:0;
            font-size:13px;
        }

        .pd-page-header strong {
            color:var(--pd-charcoal);
        }

        .pd-header-actions {
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }

        .pd-btn {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            padding:10px 18px;
            border-radius:11px;
            text-decoration:none;
            font-size:13px;
            font-weight:700;
            transition:.2s ease;
            border:1px solid transparent;
        }

        .pd-btn-light {
            background:#fff;
            color:var(--pd-green);
            border-color:#e7e7e2;
        }

        .pd-btn-light:hover {
            background:#f4f7f4;
            color:var(--pd-green);
            transform:translateY(-1px);
        }

        .pd-btn-outline {
            background:transparent;
            color:var(--pd-charcoal);
            border-color:#d8d9d5;
        }

        .pd-btn-outline:hover {
            background:var(--pd-charcoal);
            color:#fff;
        }

        .pd-wrapper {
            background:
                radial-gradient(circle at 10% 5%, rgba(201,162,39,.08), transparent 25%),
                radial-gradient(circle at 90% 15%, rgba(18,55,42,.06), transparent 25%);
            min-height:100%;
        }

        .pd-container {
            max-width:1050px;
            margin:auto;
        }

        .pd-card {
            background:#fff;
            border:1px solid rgba(18,55,42,.06);
            border-radius:22px;
            box-shadow:var(--pd-shadow);
            overflow:hidden;
        }

        .pd-card-header {
            padding:23px 26px 18px;
            border-bottom:1px solid #f0f0ec;
            display:flex;
            align-items:center;
            gap:14px;
        }

        .pd-section-icon {
            width:43px;
            height:43px;
            border-radius:13px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:19px;
            background:#edf5f0;
            color:var(--pd-green);
            flex-shrink:0;
        }

        .pd-section-icon.gold {
            background:#fbf4d9;
            color:#a17c08;
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

        .pd-card-header h4 {
            font-size:16px;
            font-weight:800;
            color:var(--pd-charcoal);
            margin:0 0 3px;
        }

        .pd-card-header p {
            margin:0;
            color:#969c98;
            font-size:12px;
        }

        .pd-card-body {
            padding:25px 26px;
        }

        .pd-label {
            display:block;
            color:#343a37;
            font-size:12px;
            font-weight:750;
            margin-bottom:7px;
        }

        .pd-label .required {
            color:var(--pd-red);
        }

        .pd-input,
        .pd-select,
        .pd-textarea {
            width:100%;
            border:1.5px solid #e5e7e3;
            background:#fff;
            color:var(--pd-charcoal);
            border-radius:12px;
            padding:12px 14px;
            font-size:13px;
            outline:none;
            transition:.2s ease;
        }

        .pd-input::placeholder,
        .pd-textarea::placeholder {
            color:#b1b5b2;
        }

        .pd-input:hover,
        .pd-select:hover,
        .pd-textarea:hover {
            border-color:#cfd4d0;
        }

        .pd-input:focus,
        .pd-select:focus,
        .pd-textarea:focus {
            border-color:var(--pd-green);
            box-shadow:0 0 0 4px rgba(18,55,42,.07);
        }

        .pd-textarea {
            min-height:145px;
            resize:vertical;
            line-height:1.7;
        }

        .pd-input-group {
            position:relative;
        }

        .pd-input-prefix {
            position:absolute;
            left:14px;
            top:50%;
            transform:translateY(-50%);
            font-weight:800;
            color:var(--pd-green);
            font-size:13px;
            z-index:2;
        }

        .pd-input-price {
            padding-left:32px;
        }

        .pd-help {
            font-size:10.5px;
            color:#9da39f;
            margin-top:6px;
        }

        .pd-error {
            color:var(--pd-red);
            font-size:11px;
            margin-top:5px;
            font-weight:600;
        }

        /* Summary */

        .pd-summary {
            background:
                linear-gradient(135deg, #12372A 0%, #1c4c3b 60%, #285b48 100%);
            border-radius:22px;
            padding:23px;
            color:#fff;
            position:relative;
            overflow:hidden;
            margin-bottom:20px;
        }

        .pd-summary:before {
            content:"";
            position:absolute;
            width:230px;
            height:230px;
            border:1px solid rgba(255,255,255,.08);
            border-radius:50%;
            right:-80px;
            top:-110px;
        }

        .pd-summary:after {
            content:"";
            position:absolute;
            width:150px;
            height:150px;
            border:1px solid rgba(201,162,39,.18);
            border-radius:50%;
            right:45px;
            bottom:-105px;
        }

        .pd-summary-content {
            position:relative;
            z-index:2;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            flex-wrap:wrap;
        }

        .pd-summary-label {
            color:rgba(255,255,255,.65);
            font-size:10px;
            font-weight:800;
            letter-spacing:1.5px;
            text-transform:uppercase;
        }

        .pd-summary-title {
            font-size:22px;
            font-weight:800;
            margin-top:5px;
            max-width:600px;
        }

        .pd-summary-address {
            color:rgba(255,255,255,.68);
            font-size:12px;
            margin-top:5px;
        }

        .pd-summary-price {
            color:#f5dc75;
            font-size:25px;
            font-weight:850;
            white-space:nowrap;
        }

        .pd-summary-badges {
            display:flex;
            gap:7px;
            margin-top:12px;
            flex-wrap:wrap;
        }

        .pd-summary-badge {
            border:1px solid rgba(255,255,255,.15);
            background:rgba(255,255,255,.08);
            border-radius:30px;
            padding:5px 10px;
            font-size:10px;
            font-weight:700;
        }

        /* Media */

        .pd-upload {
            border:2px dashed #d8ded9;
            border-radius:17px;
            background:linear-gradient(135deg,#fafcf9,#fff);
            padding:25px;
            text-align:center;
            transition:.2s ease;
            margin-bottom:25px;
        }

        .pd-upload:hover {
            border-color:var(--pd-green);
            background:#f8fbf9;
        }

        .pd-upload-icon {
            width:50px;
            height:50px;
            border-radius:15px;
            background:#edf5f0;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto 10px;
            font-size:21px;
        }

        .pd-upload-title {
            font-size:14px;
            font-weight:800;
            color:var(--pd-charcoal);
            margin-bottom:3px;
        }

        .pd-upload-sub {
            color:#969c98;
            font-size:11px;
            margin-bottom:15px;
        }

        .pd-upload-row {
            max-width:650px;
            margin:auto;
            display:flex;
            gap:10px;
            align-items:center;
        }

        .pd-file {
            flex:1;
            font-size:12px;
            padding:9px;
            border:1px solid #e4e6e2;
            border-radius:10px;
            background:#fff;
        }

        .pd-upload-btn {
            border:none;
            background:var(--pd-green);
            color:#fff;
            padding:10px 18px;
            border-radius:10px;
            font-size:12px;
            font-weight:750;
            white-space:nowrap;
        }

        .pd-upload-btn:hover {
            background:var(--pd-green-2);
        }

        .pd-media-heading {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:13px;
        }

        .pd-media-heading h5 {
            font-size:13px;
            font-weight:800;
            margin:0;
            color:var(--pd-charcoal);
        }

        .pd-count {
            background:#f0f3f0;
            color:var(--pd-green);
            border-radius:30px;
            padding:4px 9px;
            font-size:10px;
            font-weight:800;
        }

        .pd-photo-card {
            border:1px solid #eceeea;
            border-radius:15px;
            overflow:hidden;
            background:#fff;
            transition:.2s ease;
            height:100%;
        }

        .pd-photo-card:hover {
            transform:translateY(-3px);
            box-shadow:0 8px 25px rgba(18,55,42,.09);
        }

        .pd-photo {
            height:155px;
            position:relative;
            background:#f1f1ed;
            overflow:hidden;
        }

        .pd-photo img {
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
            transition:.3s ease;
        }

        .pd-photo-card:hover img {
            transform:scale(1.04);
        }

        .pd-cover {
            position:absolute;
            top:10px;
            left:10px;
            background:var(--pd-green);
            color:#fff;
            padding:5px 9px;
            border-radius:30px;
            font-size:9px;
            font-weight:800;
            box-shadow:0 4px 12px rgba(0,0,0,.15);
        }

        .pd-photo-body {
            padding:11px;
        }

        .pd-photo-actions {
            display:flex;
            gap:6px;
            flex-wrap:wrap;
        }

        .pd-mini-btn {
            border-radius:8px;
            padding:6px 9px;
            font-size:10px;
            font-weight:750;
            background:#fff;
            transition:.2s ease;
        }

        .pd-cover-btn {
            border:1px solid #d6c06a;
            color:#9a7809;
        }

        .pd-cover-btn:hover {
            background:#fbf4d9;
        }

        .pd-delete-btn {
            border:1px solid #f0bbb6;
            color:var(--pd-red);
        }

        .pd-delete-btn:hover {
            background:#fff0ee;
        }

        .pd-video-card {
            border:1px solid #e9ebe8;
            border-radius:15px;
            overflow:hidden;
            background:#fff;
            height:100%;
        }

        .pd-video {
            width:100%;
            height:190px;
            background:#101412;
            display:block;
        }

        .pd-video-body {
            padding:11px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:10px;
        }

        .pd-video-name {
            font-size:11px;
            color:#737975;
            font-weight:600;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
        }

        .pd-empty {
            background:#fafbf9;
            border:1px dashed #dfe3df;
            border-radius:14px;
            padding:22px;
            text-align:center;
            color:#9ba19d;
            font-size:12px;
        }

        /* Save bar */

        .pd-save-bar {
            position:sticky;
            bottom:14px;
            z-index:20;
            margin-top:20px;
            background:rgba(255,255,255,.94);
            backdrop-filter:blur(12px);
            border:1px solid #e5e7e3;
            box-shadow:0 12px 35px rgba(18,55,42,.12);
            border-radius:17px;
            padding:12px 15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:15px;
        }

        .pd-save-note {
            display:flex;
            align-items:center;
            gap:8px;
            color:#737975;
            font-size:11px;
            font-weight:600;
        }

        .pd-save-dot {
            width:8px;
            height:8px;
            background:#35a46c;
            border-radius:50%;
        }

        .pd-save-actions {
            display:flex;
            gap:8px;
        }

        .pd-cancel {
            border:1px solid #ddd;
            background:#fff;
            color:#555;
            padding:10px 18px;
            border-radius:10px;
            font-size:12px;
            font-weight:750;
            text-decoration:none;
        }

        .pd-cancel:hover {
            background:#f5f5f3;
            color:#333;
        }

        .pd-save {
            border:none;
            background:var(--pd-green);
            color:#fff;
            padding:10px 21px;
            border-radius:10px;
            font-size:12px;
            font-weight:800;
            box-shadow:0 5px 15px rgba(18,55,42,.2);
        }

        .pd-save:hover {
            background:var(--pd-green-2);
        }

        /* Alerts */

        .pd-alert {
            border-radius:15px;
            padding:15px 18px;
            margin-bottom:18px;
        }

        .pd-alert-danger {
            background:#fff1ef;
            border:1px solid #f4c5bf;
            color:#8f2f25;
        }

        .pd-alert-title {
            font-size:13px;
            font-weight:800;
            margin-bottom:5px;
        }

        .pd-alert ul {
            margin:0;
            padding-left:18px;
            font-size:12px;
        }

        @media(max-width:767px) {

            .pd-page-header h2 {
                font-size:23px;
            }

            .pd-header-actions {
                width:100%;
            }

            .pd-header-actions .pd-btn {
                flex:1;
            }

            .pd-card-header,
            .pd-card-body {
                padding:19px;
            }

            .pd-summary {
                padding:20px;
            }

            .pd-summary-title {
                font-size:18px;
            }

            .pd-summary-price {
                font-size:21px;
            }

            .pd-upload-row {
                flex-direction:column;
                align-items:stretch;
            }

            .pd-upload-btn {
                width:100%;
            }

            .pd-photo {
                height:135px;
            }

            .pd-save-bar {
                bottom:8px;
            }

            .pd-save-note {
                display:none;
            }

            .pd-save-bar {
                justify-content:flex-end;
            }
        }

    </style>


    <div class="pd-wrapper py-4">

        <div class="container pd-container">


            {{-- ERROR MESSAGE --}}
            @if ($errors->any())

                <div class="pd-alert pd-alert-danger">

                    <div class="pd-alert-title">
                        ⚠️ Please fix the following errors
                    </div>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- PROPERTY SUMMARY --}}
            <div class="pd-summary">

                <div class="pd-summary-content">

                    <div>

                        <div class="pd-summary-label">
                            Currently Editing
                        </div>

                        <div class="pd-summary-title">
                            {{ $property->title }}
                        </div>

                        <div class="pd-summary-address">
                            📍 {{ $property->address }}
                        </div>

                        <div class="pd-summary-badges">

                            <span class="pd-summary-badge">
                                {{ ucfirst($property->property_type) }}
                            </span>

                            <span class="pd-summary-badge">
                                {{ ucfirst($property->purpose) }}
                            </span>

                            <span class="pd-summary-badge">
                                {{ ucfirst($property->status) }}
                            </span>

                        </div>

                    </div>

                    <div class="pd-summary-price">
                        ₹{{ number_format($property->price) }}
                    </div>

                </div>

            </div>


            {{-- MAIN PROPERTY FORM --}}
            <form
                action="{{ route('properties.update', $property) }}"
                method="POST"
                id="propertyUpdateForm"
            >

                @csrf
                @method('PUT')


                {{-- BASIC INFORMATION --}}
                <div class="pd-card mb-4">

                    <div class="pd-card-header">

                        <div class="pd-section-icon">
                            🏡
                        </div>

                        <div>
                            <h4>Basic Information</h4>
                            <p>Update the main information of your property.</p>
                        </div>

                    </div>


                    <div class="pd-card-body">

                        <div class="row g-4">

                            <div class="col-md-8">

                                <label class="pd-label">
                                    Property Title <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title', $property->title) }}"
                                    class="pd-input"
                                    placeholder="e.g. Premium 3BHK Villa in Dehradun"
                                    required
                                >

                                @error('title')
                                    <div class="pd-error">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Property Type <span class="required">*</span>
                                </label>

                                <select name="property_type" class="pd-select" required>

                                    <option value="house"
                                        {{ old('property_type', $property->property_type) == 'house' ? 'selected' : '' }}>
                                        🏠 House
                                    </option>

                                    <option value="flat"
                                        {{ old('property_type', $property->property_type) == 'flat' ? 'selected' : '' }}>
                                        🏢 Flat
                                    </option>

                                    <option value="plot"
                                        {{ old('property_type', $property->property_type) == 'plot' ? 'selected' : '' }}>
                                        🌳 Plot
                                    </option>

                                    <option value="shop"
                                        {{ old('property_type', $property->property_type) == 'shop' ? 'selected' : '' }}>
                                        🏪 Shop
                                    </option>

                                    <option value="office"
                                        {{ old('property_type', $property->property_type) == 'office' ? 'selected' : '' }}>
                                        🏢 Office
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Purpose <span class="required">*</span>
                                </label>

                                <select name="purpose" class="pd-select" required>

                                    <option value="sale"
                                        {{ old('purpose', $property->purpose) == 'sale' ? 'selected' : '' }}>
                                        🏷️ For Sale
                                    </option>

                                    <option value="rent"
                                        {{ old('purpose', $property->purpose) == 'rent' ? 'selected' : '' }}>
                                        🔑 For Rent
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Property Price <span class="required">*</span>
                                </label>

                                <div class="pd-input-group">

                                    <span class="pd-input-prefix">₹</span>

                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ old('price', $property->price) }}"
                                        class="pd-input pd-input-price"
                                        min="0"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Current Status <span class="required">*</span>
                                </label>

                                <select name="status" class="pd-select" required>

                                    <option value="available"
                                        {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>
                                        🟢 Available
                                    </option>

                                    <option value="hold"
                                        {{ old('status', $property->status) == 'hold' ? 'selected' : '' }}>
                                        🟡 On Hold
                                    </option>

                                    <option value="sold"
                                        {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>
                                        🔴 Sold
                                    </option>

                                    <option value="rented"
                                        {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>
                                        🔵 Rented
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- PROPERTY DETAILS --}}
                <div class="pd-card mb-4">

                    <div class="pd-card-header">

                        <div class="pd-section-icon gold">
                            📐
                        </div>

                        <div>
                            <h4>Property Details</h4>
                            <p>Update size and room configuration.</p>
                        </div>

                    </div>


                    <div class="pd-card-body">

                        <div class="row g-4">

                            <div class="col-md-4">

                                <label class="pd-label">
                                    Area <span style="color:#999;">(sq.ft.)</span>
                                </label>

                                <input
                                    type="number"
                                    name="area"
                                    value="{{ old('area', $property->area) }}"
                                    class="pd-input"
                                    min="0"
                                    placeholder="e.g. 1800"
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Bedrooms
                                </label>

                                <input
                                    type="number"
                                    name="bedrooms"
                                    value="{{ old('bedrooms', $property->bedrooms) }}"
                                    class="pd-input"
                                    min="0"
                                    placeholder="e.g. 3"
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="pd-label">
                                    Bathrooms
                                </label>

                                <input
                                    type="number"
                                    name="bathrooms"
                                    value="{{ old('bathrooms', $property->bathrooms) }}"
                                    class="pd-input"
                                    min="0"
                                    placeholder="e.g. 2"
                                >

                            </div>

                        </div>

                    </div>

                </div>


                {{-- LOCATION --}}
                <div class="pd-card mb-4">

                    <div class="pd-card-header">

                        <div class="pd-section-icon blue">
                            📍
                        </div>

                        <div>
                            <h4>Property Location</h4>
                            <p>Keep the property address clear and accurate.</p>
                        </div>

                    </div>


                    <div class="pd-card-body">

                        <label class="pd-label">
                            Full Address <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="address"
                            value="{{ old('address', $property->address) }}"
                            class="pd-input"
                            placeholder="Enter complete property address"
                            required
                        >

                        <div class="pd-help">
                            Tip: Add locality, city and nearby landmark for better client presentations.
                        </div>

                    </div>

                </div>


                {{-- DESCRIPTION --}}
                <div class="pd-card mb-4">

                    <div class="pd-card-header">

                        <div class="pd-section-icon purple">
                            ✍️
                        </div>

                        <div>
                            <h4>Property Description</h4>
                            <p>Describe the property for your clients.</p>
                        </div>

                    </div>


                    <div class="pd-card-body">

                        <textarea
                            name="description"
                            class="pd-textarea"
                            placeholder="Write about the property, amenities, location advantages, nearby facilities..."
                        >{{ old('description', $property->description) }}</textarea>

                        <div class="pd-help">
                            A detailed description makes your property presentation more informative.
                        </div>

                    </div>

                </div>

            </form>


            {{-- PROPERTY MEDIA --}}
            <div class="pd-card mb-4">

                <div class="pd-card-header">

                    <div class="pd-section-icon orange">
                        📸
                    </div>

                    <div>
                        <h4>Property Media</h4>
                        <p>Manage photos and videos displayed in your property showroom.</p>
                    </div>

                </div>


                <div class="pd-card-body">


                    {{-- UPLOAD --}}
                    <form
                        action="{{ route('properties.media.store', $property) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="pd-upload">

                            <div class="pd-upload-icon">
                                📤
                            </div>

                            <div class="pd-upload-title">
                                Add New Property Media
                            </div>

                            <div class="pd-upload-sub">
                                Upload high-quality property photos or videos
                            </div>

                            <div class="pd-upload-row">

                                <input
                                    type="file"
                                    name="media"
                                    class="pd-file"
                                    accept="image/*,video/*"
                                    required
                                >

                                <button type="submit" class="pd-upload-btn">
                                    + Upload Media
                                </button>

                            </div>

                        </div>

                    </form>


                    @php

                        $images = $property->media->where('type', 'image');
                        $videos = $property->media->where('type', 'video');

                    @endphp


                    {{-- PHOTOS --}}
                    <div class="pd-media-heading">

                        <h5>
                            📷 Property Photos
                        </h5>

                        <span class="pd-count">
                            {{ $images->count() }} Photos
                        </span>

                    </div>


                    @if($images->count())

                        <div class="row g-3 mb-4">

                            @foreach($images as $media)

                                <div class="col-lg-4 col-md-6">

                                    <div class="pd-photo-card">

                                        <div class="pd-photo">

                                            <img
                                                src="{{ asset('storage/' . $media->file_path) }}"
                                                alt="Property photo"
                                            >

                                            @if($media->is_cover)

                                                <div class="pd-cover">
                                                    ⭐ COVER PHOTO
                                                </div>

                                            @endif

                                        </div>


                                        <div class="pd-photo-body">

                                            @if($media->is_cover)

                                                <div
                                                    style="
                                                        font-size:10px;
                                                        color:#12372A;
                                                        font-weight:800;
                                                        margin-bottom:8px;
                                                    "
                                                >
                                                    ✓ Main property image
                                                </div>

                                            @endif


                                            <div class="pd-photo-actions">

                                                @if(!$media->is_cover)

                                                    <form
                                                        action="{{ route('properties.media.cover', $media) }}"
                                                        method="POST"
                                                    >

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="pd-mini-btn pd-cover-btn"
                                                        >
                                                            ⭐ Set Cover
                                                        </button>

                                                    </form>

                                                @endif


                                                <form
                                                    action="{{ route('properties.media.destroy', $media) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="pd-mini-btn pd-delete-btn pd-confirm-delete"
                                                        data-title="Delete Photo?"
                                                        data-message="This photo will be permanently removed."
                                                    >
                                                        🗑 Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="pd-empty mb-4">
                            📷 No photos uploaded yet.
                        </div>

                    @endif


                    {{-- VIDEOS --}}
                    <div class="pd-media-heading">

                        <h5>
                            🎬 Property Videos
                        </h5>

                        <span class="pd-count">
                            {{ $videos->count() }} Videos
                        </span>

                    </div>


                    @if($videos->count())

                        <div class="row g-3">

                            @foreach($videos as $media)

                                <div class="col-lg-6">

                                    <div class="pd-video-card">

                                        <video
                                            controls
                                            preload="metadata"
                                            class="pd-video"
                                        >

                                            <source
                                                src="{{ asset('storage/' . $media->file_path) }}"
                                            >

                                            Your browser does not support video playback.

                                        </video>


                                        <div class="pd-video-body">

                                            <div class="pd-video-name">
                                                🎬 Property Video
                                            </div>


                                            <form
                                                action="{{ route('properties.media.destroy', $media) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="pd-mini-btn pd-delete-btn pd-confirm-delete"
                                                    data-title="Delete Video?"
                                                    data-message="This video will be permanently removed."
                                                >
                                                    🗑 Delete
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="pd-empty">
                            🎬 No videos uploaded yet.
                        </div>

                    @endif

                </div>

            </div>


            {{-- SAVE BAR --}}
            <div class="pd-save-bar">

                <div class="pd-save-note">
                    <span class="pd-save-dot"></span>
                    Changes are saved when you click Update Property.
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
                        form="propertyUpdateForm"
                        class="pd-save"
                    >
                        ✓ Update Property
                    </button>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>
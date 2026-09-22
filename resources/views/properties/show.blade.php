<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div style="width:36px; height:4px; background:#C9A227; border-radius:4px; margin-bottom:10px;"></div>
                <h2 class="fw-bold mb-1" style="color:#12372A;">{{ $property->title }}</h2>
                <p class="text-muted mb-0">📍 {{ $property->address }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('properties.edit', $property) }}" class="btn-pd-primary">Edit Property</a>
                <a href="{{ route('properties.index') }}" class="btn-pd-outline">← Back</a>
            </div>
        </div>
    </x-slot>

    @php
        $images = $property->media->where('type', 'image');
        $videos = $property->media->where('type', 'video');
        $cover = $images->where('is_cover', true)->first() ?? $images->first();

        $statusColors = [
            'available' => ['bg' => '#e8f7ef', 'text' => '#1a8a4a'],
            'hold'      => ['bg' => '#fff4dd', 'text' => '#b8860b'],
            'sold'      => ['bg' => '#fdecea', 'text' => '#c0392b'],
            'rented'    => ['bg' => '#edf5ff', 'text' => '#2b6cb0'],
        ];
        $statusColor = $statusColors[$property->status] ?? ['bg' => '#f1f1ee', 'text' => '#555'];
    @endphp

    <style>
        :root{
            --pd-green:#12372A; --pd-green-2:#1d4d3c; --pd-gold:#C9A227;
            --pd-cream:#F7F5EF; --pd-charcoal:#202522;
        }
        .pd-card{ background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); border:none; }
        .btn-pd-primary{ background:var(--pd-green); color:#fff; border:none; padding:10px 22px; border-radius:10px; font-weight:600; font-size:14px; text-decoration:none; display:inline-block; }
        .btn-pd-primary:hover{ background:var(--pd-green-2); color:#fff; }
        .btn-pd-outline{ border:1.5px solid var(--pd-charcoal); background:transparent; padding:9px 20px; border-radius:10px; font-weight:600; text-decoration:none; color:var(--pd-charcoal); display:inline-block; }
        .btn-pd-outline:hover{ background:var(--pd-charcoal); color:#fff; }
        .pd-status-badge{ display:inline-block; padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700; background:{{ $statusColor['bg'] }}; color:{{ $statusColor['text'] }}; }
        .pd-cover-img{ width:100%; height:460px; object-fit:cover; border-radius:18px; cursor:pointer; }
        .pd-cover-placeholder{ width:100%; height:460px; border-radius:18px; background:#f1f4f2; display:flex; align-items:center; justify-content:center; font-size:60px; }
        .pd-thumb-strip{ display:flex; gap:10px; overflow-x:auto; margin-top:10px; padding-bottom:4px; }
        .pd-thumb{ width:110px; height:80px; object-fit:cover; border-radius:10px; flex-shrink:0; cursor:pointer; border:2px solid transparent; transition:border-color .15s ease; }
        .pd-thumb:hover{ border-color:var(--pd-gold); }
        .pd-info-row{ display:flex; justify-content:space-between; padding:12px 0; border-bottom:1px solid #f0f0f0; font-size:14px; }
        .pd-info-row:last-child{ border-bottom:none; }
        .pd-info-label{ color:#999; }
        .pd-info-value{ font-weight:600; }
        .pd-price{ font-size:26px; font-weight:800; color:var(--pd-green); }
        .pd-section-title{ font-weight:700; font-size:17px; margin-bottom:2px; color:var(--pd-charcoal); }
        .pd-video-card{ background:#fff; border-radius:16px; box-shadow:0 2px 10px rgba(0,0,0,.04); overflow:hidden; }
        .pd-empty{ background:#faf9f6; border:1.5px dashed #ddd8c9; border-radius:14px; padding:26px; text-align:center; color:#999; font-size:14px; }
    </style>

    <div class="py-4">
        <div class="container-fluid px-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" style="border-radius:14px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4 mb-4">
                {{-- GALLERY --}}
                <div class="col-lg-8">
                    @if($cover)
                        <img id="pdMainImage" src="{{ asset('storage/' . $cover->file_path) }}" class="pd-cover-img" alt="{{ $property->title }}">
                    @else
                        <div class="pd-cover-placeholder">🏠</div>
                    @endif

                    @if($images->count() > 1)
                        <div class="pd-thumb-strip">
                            @foreach($images as $media)
                                <img src="{{ asset('storage/' . $media->file_path) }}" class="pd-thumb" alt="Property photo" onclick="document.getElementById('pdMainImage').src = this.src">
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- INFO CARD --}}
                <div class="col-lg-4">
                    <div class="pd-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="pd-status-badge">{{ ucfirst($property->status) }}</span>
                        </div>

                        <div class="pd-price mb-1">
                            ₹{{ number_format($property->price) }}{{ $property->purpose === 'rent' ? ' /mo' : '' }}
                        </div>
                        <div class="text-muted small mb-3">{{ ucfirst($property->purpose) }} · {{ ucfirst($property->property_type) }}</div>

                        <div class="pd-info-row">
                            <span class="pd-info-label">Area</span>
                            <span class="pd-info-value">{{ $property->area ?? 'N/A' }} sq.ft.</span>
                        </div>
                        <div class="pd-info-row">
                            <span class="pd-info-label">Bedrooms</span>
                            <span class="pd-info-value">{{ $property->bedrooms ?? 'N/A' }}</span>
                        </div>
                        <div class="pd-info-row">
                            <span class="pd-info-label">Bathrooms</span>
                            <span class="pd-info-value">{{ $property->bathrooms ?? 'N/A' }}</span>
                        </div>
                        <div class="pd-info-row">
                            <span class="pd-info-label">Property Type</span>
                            <span class="pd-info-value">{{ ucfirst($property->property_type) }}</span>
                        </div>

                        <a href="{{ route('properties.edit', $property) }}" class="btn-pd-primary w-100 text-center mt-4">Edit Property & Media</a>
                    </div>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="pd-card p-4 mb-4">
                <div class="pd-section-title mb-2">Description</div>
                <p class="text-muted mb-0">{{ $property->description ?? 'No description added.' }}</p>
            </div>

            {{-- VIDEOS --}}
            @if($videos->count())
                <div class="pd-section-title mb-3">Property Videos</div>
                <div class="row g-3">
                    @foreach($videos as $media)
                        <div class="col-md-6">
                            <div class="pd-video-card">
                                <video controls class="w-100" preload="metadata" style="max-height:320px; background:#000;">
                                    <source src="{{ asset('storage/' . $media->file_path) }}">
                                    Your browser does not support video playback.
                                </video>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
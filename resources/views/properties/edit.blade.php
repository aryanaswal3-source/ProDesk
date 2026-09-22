<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div style="width:36px; height:4px; background:#C9A227; border-radius:4px; margin-bottom:10px;"></div>
                <h2 class="fw-bold mb-1" style="color:#12372A;">Edit Property</h2>
                <p class="text-muted mb-0">Update details for "{{ $property->title }}"</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('properties.show', $property) }}" class="btn-pd-ghost">View Property</a>
                <a href="{{ route('properties.index') }}" class="btn-pd-outline">← Back</a>
            </div>
        </div>
    </x-slot>

    <style>
        :root{
            --pd-green:#12372A;
            --pd-green-2:#1d4d3c;
            --pd-gold:#C9A227;
            --pd-cream:#F7F5EF;
            --pd-charcoal:#202522;
        }
        .pd-card{ background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); border:none; }
        .btn-pd-primary{
            background:var(--pd-green); color:#fff; border:none; padding:11px 26px;
            border-radius:10px; font-weight:600; font-size:14px;
        }
        .btn-pd-primary:hover{ background:var(--pd-green-2); color:#fff; }
        .btn-pd-outline{
            border:1.5px solid var(--pd-charcoal); background:transparent; padding:10px 20px;
            border-radius:10px; font-weight:600; text-decoration:none; color:var(--pd-charcoal); display:inline-block;
        }
        .btn-pd-outline:hover{ background:var(--pd-charcoal); color:#fff; }
        .btn-pd-ghost{
            border:1.5px solid #ddd; background:#fff; padding:10px 22px;
            border-radius:10px; font-weight:600; color:#555; text-decoration:none; display:inline-block;
        }
        .btn-pd-ghost:hover{ background:#f5f5f3; color:#555; }
        .pd-section-num{
            width:30px; height:30px; border-radius:50%; background:#e8f3ed; color:var(--pd-green);
            display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; flex-shrink:0;
        }
        .pd-section-title{ font-weight:700; font-size:16px; margin-bottom:2px; }
        .pd-section-sub{ color:#999; font-size:12.5px; }
        .form-label{ font-weight:600; font-size:13px; color:var(--pd-charcoal); margin-bottom:6px; }
        .form-control, .form-select{
            border-radius:10px; border:1.5px solid #e6e6e2; padding:10px 14px; font-size:14px;
        }
        .form-control:focus, .form-select:focus{
            border-color:var(--pd-green); box-shadow:0 0 0 3px rgba(18,55,42,0.08);
        }
        textarea.form-control{ border-radius:14px; }
        .alert-pd-danger{
            background:#fdecea; border:1px solid #f6c6c1; color:#8a2e22; border-radius:14px; padding:16px 20px;
        }
    </style>

    <div class="py-4">
        <div class="container" style="max-width: 900px;">

            @if ($errors->any())
                <div class="alert-pd-danger mb-4">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('properties.update', $property) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- SECTION 1: BASIC INFORMATION --}}
                <div class="pd-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">1</div>
                        <div>
                            <div class="pd-section-title">Basic Information</div>
                            <div class="pd-section-sub">Title, type and pricing for this listing</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Property Title</label>
                            <input type="text" name="title" value="{{ old('title', $property->title) }}"
                                   class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Property Type</label>
                            <select name="property_type" class="form-select" required>
                                <option value="house" {{ old('property_type', $property->property_type) == 'house' ? 'selected' : '' }}>House</option>
                                <option value="flat" {{ old('property_type', $property->property_type) == 'flat' ? 'selected' : '' }}>Flat</option>
                                <option value="plot" {{ old('property_type', $property->property_type) == 'plot' ? 'selected' : '' }}>Plot</option>
                                <option value="shop" {{ old('property_type', $property->property_type) == 'shop' ? 'selected' : '' }}>Shop</option>
                                <option value="office" {{ old('property_type', $property->property_type) == 'office' ? 'selected' : '' }}>Office</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Purpose</label>
                            <select name="purpose" class="form-select" required>
                                <option value="sale" {{ old('purpose', $property->purpose) == 'sale' ? 'selected' : '' }}>Sale</option>
                                <option value="rent" {{ old('purpose', $property->purpose) == 'rent' ? 'selected' : '' }}>Rent</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Price (₹)</label>
                            <input type="number" name="price" value="{{ old('price', $property->price) }}"
                                   class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="available" {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="hold" {{ old('status', $property->status) == 'hold' ? 'selected' : '' }}>Hold</option>
                                <option value="sold" {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="rented" {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>Rented</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: PROPERTY DETAILS --}}
                <div class="pd-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">2</div>
                        <div>
                            <div class="pd-section-title">Property Details</div>
                            <div class="pd-section-sub">Size and room configuration</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Area (sq.ft.)</label>
                            <input type="number" name="area" value="{{ old('area', $property->area) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Bedrooms</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Bathrooms</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: LOCATION --}}
                <div class="pd-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">3</div>
                        <div>
                            <div class="pd-section-title">Location</div>
                            <div class="pd-section-sub">Where is this property located</div>
                        </div>
                    </div>

                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address', $property->address) }}"
                           class="form-control" required>
                </div>

                {{-- SECTION 4: DESCRIPTION --}}
                <div class="pd-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">4</div>
                        <div>
                            <div class="pd-section-title">Description</div>
                            <div class="pd-section-sub">Tell buyers or tenants more about this property</div>
                        </div>
                    </div>

                    <textarea name="description" class="form-control" rows="5">{{ old('description', $property->description) }}</textarea>
                </div>

                {{-- SECTION 5: PROPERTY MEDIA --}}
                <div class="pd-card p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">5</div>
                        <div>
                            <div class="pd-section-title">Property Media</div>
                            <div class="pd-section-sub">Manage photos and videos for this property</div>
                        </div>
                    </div>

                    {{-- Upload new media --}}
                    <form action="{{ route('properties.media.store', $property) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-wrap gap-3 align-items-end mb-4 pb-4" style="border-bottom:1px solid #f0f0f0;">
                        @csrf
                        <div class="flex-grow-1" style="min-width:240px;">
                            <label class="form-label">Upload Photo / Video</label>
                            <input type="file" name="media" class="form-control" accept="image/*,video/*" required>
                        </div>
                        <button type="submit" class="btn-pd-primary" style="padding:10px 22px;">Upload</button>
                    </form>

                    @php
                        $images = $property->media->where('type', 'image');
                        $videos = $property->media->where('type', 'video');
                    @endphp

                    {{-- Existing photos --}}
                    <div class="fw-semibold mb-2" style="font-size:14px;">Photos</div>
                    @if($images->count())
                        <div class="row g-3 mb-4">
                            @foreach($images as $media)
                                <div class="col-md-4 col-6">
                                    <div style="border-radius:12px; overflow:hidden; border:1px solid #eee;">
                                        <img src="{{ asset('storage/' . $media->file_path) }}" style="width:100%; height:120px; object-fit:cover;" alt="Property photo">
                                        <div class="p-2">
                                            @if($media->is_cover)
                                                <span class="d-block mb-2" style="background:#12372A; color:#fff; font-size:10.5px; padding:3px 9px; border-radius:20px; font-weight:600; width:fit-content;">⭐ Cover</span>
                                            @endif
                                            <div class="d-flex gap-1 flex-wrap">
                                                @if(!$media->is_cover)
                                                    <form action="{{ route('properties.media.cover', $media) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" style="border:1.3px solid #12372A; color:#12372A; background:transparent; padding:4px 10px; border-radius:7px; font-size:11px; font-weight:600;">⭐ Cover</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('properties.media.destroy', $media) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="pd-confirm-delete" data-title="Delete Photo?" data-message="This photo will be permanently removed." style="border:1.3px solid #e0483a; color:#e0483a; background:transparent; padding:4px 10px; border-radius:7px; font-size:11px; font-weight:600;">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small mb-4">No photos uploaded yet.</p>
                    @endif

                    {{-- Existing videos --}}
                    <div class="fw-semibold mb-2" style="font-size:14px;">Videos</div>
                    @if($videos->count())
                        <div class="row g-3">
                            @foreach($videos as $media)
                                <div class="col-md-6">
                                    <div style="border-radius:12px; overflow:hidden; border:1px solid #eee;">
                                        <video controls preload="metadata" style="width:100%; max-height:180px; background:#000;">
                                            <source src="{{ asset('storage/' . $media->file_path) }}">
                                        </video>
                                        <div class="p-2">
                                            <form action="{{ route('properties.media.destroy', $media) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="pd-confirm-delete" data-title="Delete Video?" data-message="This video will be permanently removed." style="border:1.3px solid #e0483a; color:#e0483a; background:transparent; padding:4px 10px; border-radius:7px; font-size:11px; font-weight:600;">Delete Video</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small mb-0">No videos uploaded yet.</p>
                    @endif
                </div>

                <div class="d-flex justify-content-end gap-2 pb-2">
                    <a href="{{ route('properties.index') }}" class="btn-pd-ghost">Cancel</a>
                    <button type="submit" class="btn-pd-primary">Update Property</button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
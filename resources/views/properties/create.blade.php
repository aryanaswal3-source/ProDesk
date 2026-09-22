<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div style="width:36px; height:4px; background:#C9A227; border-radius:4px; margin-bottom:10px;"></div>
                <h2 class="fw-bold mb-1" style="color:#12372A;">Add Property</h2>
                <p class="text-muted mb-0">Add a new property to your catalogue.</p>
            </div>
            <a href="{{ route('properties.index') }}" class="btn-pd-outline">← Back</a>
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
        .pd-card{
            background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); border:none;
            transition:box-shadow .2s ease; position:relative;
        }
        .pd-card:hover{ box-shadow:0 10px 26px rgba(18,55,42,.08); }

        .btn-pd-primary{
            background:var(--pd-green); color:#fff; border:none; padding:11px 26px;
            border-radius:10px; font-weight:600; font-size:14px; transition:background .15s ease, transform .15s ease;
        }
        .btn-pd-primary:hover{ background:var(--pd-green-2); color:#fff; transform:translateY(-1px); }
        .btn-pd-outline{
            border:1.5px solid var(--pd-charcoal); background:transparent; padding:10px 20px;
            border-radius:10px; font-weight:600; text-decoration:none; color:var(--pd-charcoal); display:inline-block;
            transition:background .15s ease, color .15s ease;
        }
        .btn-pd-outline:hover{ background:var(--pd-charcoal); color:#fff; }
        .btn-pd-ghost{
            border:1.5px solid #ddd; background:#fff; padding:10px 22px;
            border-radius:10px; font-weight:600; color:#555; text-decoration:none; display:inline-block;
            transition:background .15s ease;
        }
        .btn-pd-ghost:hover{ background:#f5f5f3; color:#555; }

        .pd-section-num{
            width:32px; height:32px; border-radius:50%; background:#e8f3ed; color:var(--pd-green);
            display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; flex-shrink:0;
            position:relative; z-index:1; transition:background .2s ease, color .2s ease;
        }
        .pd-card:hover .pd-section-num{ background:var(--pd-green); color:#fff; }
        .pd-section-connector{
            position:absolute; left:38px; top:-16px; width:2px; height:16px; background:#e6ece8;
        }
        .pd-section-title{ font-weight:700; font-size:16px; margin-bottom:2px; }
        .pd-section-sub{ color:#999; font-size:12.5px; }

        .form-label{ font-weight:600; font-size:13px; color:var(--pd-charcoal); margin-bottom:6px; }
        .form-control, .form-select{
            border-radius:10px; border:1.5px solid #e6e6e2; padding:10px 14px; font-size:14px;
            transition:border-color .15s ease, box-shadow .15s ease;
        }
        .form-control:hover, .form-select:hover{ border-color:#c9d4cd; }
        .form-control:focus, .form-select:focus{
            border-color:var(--pd-green); box-shadow:0 0 0 3px rgba(18,55,42,0.08);
        }
        textarea.form-control{ border-radius:14px; }
        .alert-pd-danger{
            background:#fdecea; border:1px solid #f6c6c1; color:#8a2e22; border-radius:14px; padding:16px 20px;
        }

        /* MEDIA DROPZONE */
        .pd-dropzone{
            border:2px dashed #d8d3c0; border-radius:16px; padding:32px 20px; text-align:center;
            background:#faf9f6; cursor:pointer; transition:border-color .2s ease, background .2s ease;
        }
        .pd-dropzone:hover, .pd-dropzone.pd-drag-over{ border-color:var(--pd-gold); background:#fdfaf0; }
        .pd-dropzone .ic{ font-size:34px; margin-bottom:10px; }
        .pd-dropzone .title{ font-weight:600; color:var(--pd-charcoal); margin-bottom:4px; font-size:14px; }
        .pd-dropzone .sub{ color:#999; font-size:12px; }
        .pd-dropzone input[type="file"]{ display:none; }
        .pd-file-preview{ display:flex; flex-wrap:wrap; gap:10px; margin-top:16px; }
        .pd-file-chip{
            display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #eee;
            border-radius:10px; padding:6px 12px 6px 8px; font-size:12.5px; color:#444;
        }
        .pd-file-chip .thumb{ width:28px; height:28px; border-radius:6px; object-fit:cover; background:#eee; display:flex; align-items:center; justify-content:center; font-size:14px; }
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

            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="form-control" placeholder="e.g. Luxury 3 BHK House" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Property Type</label>
                            <select name="property_type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>House</option>
                                <option value="flat" {{ old('property_type') == 'flat' ? 'selected' : '' }}>Flat / Apartment</option>
                                <option value="plot" {{ old('property_type') == 'plot' ? 'selected' : '' }}>Plot</option>
                                <option value="shop" {{ old('property_type') == 'shop' ? 'selected' : '' }}>Shop</option>
                                <option value="office" {{ old('property_type') == 'office' ? 'selected' : '' }}>Office</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Purpose</label>
                            <select name="purpose" class="form-select" required>
                                <option value="">Select Purpose</option>
                                <option value="sale" {{ old('purpose') == 'sale' ? 'selected' : '' }}>For Sale</option>
                                <option value="rent" {{ old('purpose') == 'rent' ? 'selected' : '' }}>For Rent</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Price (₹)</label>
                            <input type="number" name="price" value="{{ old('price') }}"
                                   class="form-control" placeholder="e.g. 8500000" min="0" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="hold" {{ old('status') == 'hold' ? 'selected' : '' }}>Hold</option>
                                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: PROPERTY DETAILS --}}
                <div class="pd-card p-4 mb-4">
                    <div class="pd-section-connector"></div>
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
                            <input type="number" name="area" value="{{ old('area') }}"
                                   class="form-control" placeholder="e.g. 1800" min="0">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Bedrooms</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms') }}"
                                   class="form-control" min="0" placeholder="e.g. 3">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Bathrooms</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms') }}"
                                   class="form-control" min="0" placeholder="e.g. 2">
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: LOCATION --}}
                <div class="pd-card p-4 mb-4">
                    <div class="pd-section-connector"></div>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">3</div>
                        <div>
                            <div class="pd-section-title">Location</div>
                            <div class="pd-section-sub">Where is this property located</div>
                        </div>
                    </div>

                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"
                              placeholder="Enter complete property address" required>{{ old('address') }}</textarea>
                </div>

                {{-- SECTION 4: DESCRIPTION --}}
                <div class="pd-card p-4 mb-4">
                    <div class="pd-section-connector"></div>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">4</div>
                        <div>
                            <div class="pd-section-title">Description</div>
                            <div class="pd-section-sub">Tell buyers or tenants more about this property</div>
                        </div>
                    </div>

                    <textarea name="description" class="form-control" rows="5"
                              placeholder="Describe the property...">{{ old('description') }}</textarea>
                </div>

                {{-- SECTION 5: PROPERTY MEDIA --}}
                <div class="pd-card p-4 mb-4">
                    <div class="pd-section-connector"></div>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="pd-section-num">5</div>
                        <div>
                            <div class="pd-section-title">Property Media</div>
                            <div class="pd-section-sub">Upload photos and videos (optional — you can also add these later)</div>
                        </div>
                    </div>

                    <label class="pd-dropzone d-block" id="pdDropzone">
                        <div class="ic">📸</div>
                        <div class="title">Click to upload or drag & drop</div>
                        <div class="sub">JPG, PNG, WebP, MP4, MOV, WebM · up to 50MB each</div>
                        <input type="file" name="media[]" id="pdMediaInput" accept="image/*,video/*" multiple>
                    </label>

                    <div class="pd-file-preview" id="pdFilePreview"></div>

                    <small class="text-muted d-block mt-2">The first photo you add becomes the cover photo.</small>
                </div>

                <div class="d-flex justify-content-end gap-2 pb-2">
                    <a href="{{ route('properties.index') }}" class="btn-pd-ghost">Cancel</a>
                    <button type="submit" class="btn-pd-primary">Save Property</button>
                </div>

            </form>

        </div>
    </div>

    <script>
        (function () {
            const dropzone = document.getElementById('pdDropzone');
            const input = document.getElementById('pdMediaInput');
            const preview = document.getElementById('pdFilePreview');

            function renderPreview(files) {
                preview.innerHTML = '';
                Array.from(files).forEach(function (file) {
                    const chip = document.createElement('div');
                    chip.className = 'pd-file-chip';

                    const thumb = document.createElement('div');
                    thumb.className = 'thumb';

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '6px';
                        thumb.appendChild(img);
                    } else {
                        thumb.textContent = '🎬';
                    }

                    const name = document.createElement('span');
                    name.textContent = file.name.length > 22 ? file.name.slice(0, 20) + '…' : file.name;

                    chip.appendChild(thumb);
                    chip.appendChild(name);
                    preview.appendChild(chip);
                });
            }

            dropzone.addEventListener('dragover', function (e) {
                e.preventDefault();
                dropzone.classList.add('pd-drag-over');
            });
            dropzone.addEventListener('dragleave', function () {
                dropzone.classList.remove('pd-drag-over');
            });
            dropzone.addEventListener('drop', function (e) {
                e.preventDefault();
                dropzone.classList.remove('pd-drag-over');
                input.files = e.dataTransfer.files;
                renderPreview(input.files);
            });
            input.addEventListener('change', function () {
                renderPreview(input.files);
            });
        })();
    </script>

</x-app-layout>
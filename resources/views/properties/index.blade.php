<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div style="width:36px; height:4px; background:#C9A227; border-radius:4px; margin-bottom:10px;"></div>
                <h2 class="fw-bold mb-1" style="color:#12372A;">Properties</h2>
                <p class="text-muted mb-0">Manage, showcase and grow your property listings</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard') }}" class="btn-pd-outline">← Back</a>
                <a href="{{ route('properties.create') }}" class="btn-pd-primary">+ Add Property</a>
            </div>
        </div>
    </x-slot>

    @php
        $allProperties = method_exists($properties, 'items') ? collect($properties->items()) : collect($properties);
        $totalCount = $allProperties->count();
        $saleCount = $allProperties->where('purpose', 'sale')->count();
        $rentCount = $allProperties->where('purpose', 'rent')->count();
        $availableCount = $allProperties->where('status', 'available')->count();

        $statusColors = [
            'available' => ['bg' => '#e8f7ef', 'text' => '#1a8a4a', 'label' => 'Available'],
            'hold'      => ['bg' => '#fff4dd', 'text' => '#b8860b', 'label' => 'On Hold'],
            'sold'      => ['bg' => '#fdecea', 'text' => '#c0392b', 'label' => 'Sold'],
            'rented'    => ['bg' => '#edf5ff', 'text' => '#2b6cb0', 'label' => 'Rented'],
        ];
    @endphp

    <style>
        :root{ --pd-green:#12372A; --pd-green-2:#1d4d3c; --pd-gold:#C9A227; --pd-cream:#F7F5EF; --pd-charcoal:#202522; }
        .pd-card{ background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); border:none; }
        .btn-pd-primary{ background:var(--pd-green); color:#fff; border:none; padding:10px 22px; border-radius:10px; font-weight:600; font-size:14px; text-decoration:none; display:inline-block; }
        .btn-pd-primary:hover{ background:var(--pd-green-2); color:#fff; }
        .btn-pd-outline{ border:1.5px solid var(--pd-charcoal); background:transparent; padding:9px 20px; border-radius:10px; font-weight:600; text-decoration:none; color:var(--pd-charcoal); display:inline-block; }
        .btn-pd-outline:hover{ background:var(--pd-charcoal); color:#fff; }
        .pd-stat-icon{ width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; }
        .pd-toolbar{ background:#fff; border-radius:16px; padding:16px 18px; box-shadow:0 2px 10px rgba(0,0,0,.04); margin-bottom:22px; }
        .pd-search{ border-radius:10px; border:1.5px solid #e6e6e2; padding:10px 14px 10px 40px; font-size:14px; width:100%; background:#fafaf8 url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23999" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>') no-repeat 12px center; }
        .pd-search:focus{ outline:none; border-color:var(--pd-green); box-shadow:0 0 0 3px rgba(18,55,42,0.08); }
        .pd-tab{ border:none; background:transparent; padding:8px 18px; border-radius:20px; font-weight:600; font-size:13.5px; color:#777; cursor:pointer; }
        .pd-tab.active{ background:var(--pd-green); color:#fff; }
        .pd-prop-card{ background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.05); overflow:hidden; height:100%; transition:transform .15s ease, box-shadow .15s ease; }
        .pd-prop-card:hover{ transform:translateY(-3px); box-shadow:0 8px 22px rgba(0,0,0,.08); }
        .pd-prop-media{ height:210px; }
        .pd-prop-media img, .pd-prop-media video{ height:210px; object-fit:cover; }
        .pd-badge-status{ position:absolute; top:12px; left:12px; padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700; z-index:2; }
        .pd-badge-purpose{ position:absolute; top:12px; right:12px; padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700; z-index:2; background:rgba(18,55,42,.9); color:#fff; }
        .pd-tag{ display:inline-block; font-size:11px; padding:2px 9px; border-radius:20px; margin-right:5px; font-weight:600; background:#eef2ff; color:#4c5fd5; }
        .pd-price{ font-size:19px; font-weight:800; color:var(--pd-green); }
        .pd-meta{ display:flex; gap:14px; font-size:12.5px; color:#888; flex-wrap:wrap; }
        .btn-pd-view{ background:var(--pd-green); color:#fff; border:none; padding:7px 16px; border-radius:8px; font-size:12.5px; font-weight:600; text-decoration:none; }
        .btn-pd-view:hover{ background:var(--pd-green-2); color:#fff; }
        .btn-pd-edit{ border:1.3px solid #ccc; color:#555; background:#fff; padding:7px 16px; border-radius:8px; font-size:12.5px; font-weight:600; text-decoration:none; }
        .btn-pd-edit:hover{ background:#f5f5f3; color:#555; }
        .btn-pd-delete{ border:1.3px solid #e0483a; color:#e0483a; background:transparent; padding:7px 12px; border-radius:8px; font-size:12.5px; font-weight:600; }
        .btn-pd-delete:hover{ background:#e0483a; color:#fff; }
        .carousel-control-prev, .carousel-control-next{ width:15%; }
    </style>

    <div class="py-4">
        <div class="container-fluid px-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" style="border-radius:14px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- STAT CARDS --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-xl-3">
                    <div class="pd-card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><p class="text-muted small mb-1">Total Properties</p><h4 class="fw-bold mb-0">{{ $totalCount }}</h4></div>
                            <div class="pd-stat-icon" style="background:#e8f3ed;">🏠</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="pd-card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><p class="text-muted small mb-1">For Sale</p><h4 class="fw-bold mb-0">{{ $saleCount }}</h4></div>
                            <div class="pd-stat-icon" style="background:#fff5d9;">🏷️</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="pd-card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><p class="text-muted small mb-1">For Rent</p><h4 class="fw-bold mb-0">{{ $rentCount }}</h4></div>
                            <div class="pd-stat-icon" style="background:#edf5ff;">🔑</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="pd-card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><p class="text-muted small mb-1">Available</p><h4 class="fw-bold mb-0">{{ $availableCount }}</h4></div>
                            <div class="pd-stat-icon" style="background:#e8f7ef;">✓</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOOLBAR: SEARCH + FILTER TABS --}}
            <div class="pd-toolbar d-flex flex-wrap gap-3 align-items-center justify-content-between">
                <div style="max-width:320px; flex:1; min-width:220px;">
                    <input type="text" id="pdSearchInput" class="pd-search" placeholder="Search by title or location...">
                </div>
                <div class="d-flex gap-2 flex-wrap" id="pdFilterTabs">
                    <button type="button" class="pd-tab active" data-filter="all">All Properties</button>
                    <button type="button" class="pd-tab" data-filter="sale">For Sale</button>
                    <button type="button" class="pd-tab" data-filter="rent">For Rent</button>
                </div>
            </div>

            {{-- PROPERTIES GRID --}}
            <div class="row g-4" id="pdPropertyGrid">

                @forelse($properties as $property)
                    @php $media = $property->media; @endphp

                    <div class="col-md-6 col-lg-4 pd-property-item"
                         data-purpose="{{ $property->purpose }}"
                         data-search="{{ strtolower($property->title . ' ' . $property->address) }}">

                        <div class="pd-prop-card">

                            <div class="position-relative pd-prop-media">
                                <span class="pd-badge-status" style="background:{{ $statusColors[$property->status]['bg'] ?? '#f1f1ee' }}; color:{{ $statusColors[$property->status]['text'] ?? '#555' }};">
                                    {{ $statusColors[$property->status]['label'] ?? ucfirst($property->status) }}
                                </span>
                                <span class="pd-badge-purpose">{{ ucfirst($property->purpose) }}</span>

                                @if ($media->count() > 0)
                                    <div id="propertyCarousel{{ $property->id }}" class="carousel slide h-100" data-bs-ride="false">
                                        <div class="carousel-inner h-100">
                                            @foreach ($media as $index => $item)
                                                <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                                                    @if ($item->type === 'image')
                                                        <img src="{{ asset('storage/' . $item->file_path) }}" class="d-block w-100" alt="{{ $property->title }}">
                                                    @elseif($item->type === 'video')
                                                        <video class="d-block w-100" controls preload="metadata">
                                                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                                            Your browser does not support video playback.
                                                        </video>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($media->count() > 1)
                                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center text-muted">
                                            <div style="font-size: 40px;">🏠</div>
                                            <div class="small">No media</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="p-3">
                                <span class="pd-tag">{{ ucfirst($property->property_type) }}</span>

                                <h6 class="fw-bold mt-2 mb-1">{{ $property->title }}</h6>
                                <p class="text-muted small mb-2">📍 {{ $property->address }}</p>

                                <div class="pd-price mb-2">
                                    ₹{{ number_format($property->price) }}{{ $property->purpose === 'rent' ? ' /mo' : '' }}
                                </div>

                                <div class="pd-meta mb-3">
                                    @if ($property->bedrooms)<span>🛏 {{ $property->bedrooms }} Beds</span>@endif
                                    @if ($property->bathrooms)<span>🚿 {{ $property->bathrooms }} Baths</span>@endif
                                    @if ($property->area)<span>📐 {{ $property->area }} sq.ft.</span>@endif
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('properties.show', $property) }}" class="btn-pd-view">View</a>
                                    <a href="{{ route('properties.edit', $property) }}" class="btn-pd-edit">Edit</a>
                                    <form action="{{ route('properties.destroy', $property) }}" method="POST" class="d-inline ms-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-pd-delete" onclick="return confirm('Delete this property?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div style="font-size: 60px;">🏠</div>
                            <h4 class="mt-3">No properties yet</h4>
                            <p class="text-muted">Start by adding your first property.</p>
                            <a href="{{ route('properties.create') }}" class="btn-pd-primary">+ Add Property</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div id="pdNoResults" class="text-center py-5" style="display:none;">
                <div style="font-size: 50px;">🔍</div>
                <h5 class="mt-3">No matching properties</h5>
                <p class="text-muted">Try a different search or filter.</p>
            </div>

        </div>
    </div>

    {{-- Client-side search + filter (does not touch backend/routes) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('pdSearchInput');
            const tabs = document.querySelectorAll('#pdFilterTabs .pd-tab');
            const items = document.querySelectorAll('.pd-property-item');
            const noResults = document.getElementById('pdNoResults');
            let activeFilter = 'all';

            function applyFilters() {
                const query = (searchInput.value || '').toLowerCase().trim();
                let visibleCount = 0;

                items.forEach(function (item) {
                    const matchesFilter = activeFilter === 'all' || item.dataset.purpose === activeFilter;
                    const matchesSearch = !query || item.dataset.search.includes(query);
                    const show = matchesFilter && matchesSearch;
                    item.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });

                noResults.style.display = (visibleCount === 0 && items.length > 0) ? '' : 'none';
            }

            if (searchInput) searchInput.addEventListener('input', applyFilters);

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    activeFilter = tab.dataset.filter;
                    applyFilters();
                });
            });
        });
    </script>

</x-app-layout>
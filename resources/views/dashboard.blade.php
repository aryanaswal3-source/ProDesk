<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div style="width:36px; height:4px; background:#C9A227; border-radius:4px; margin-bottom:10px;"></div>
                <h2 class="fw-bold mb-1" style="color:#12372A;">Dashboard</h2>
                <p class="text-muted mb-0">Here's what's happening with your properties today · {{ now()->format('l, d M Y') }}</p>
            </div>
            <a href="{{ route('properties.create') }}" class="btn-pd-primary">+ Add Property</a>
        </div>
    </x-slot>

    @php
        $user = auth()->user();
        $totalProperties = $user->properties()->count();
        $forSale = $user->properties()->where('purpose', 'sale')->count();
        $forRent = $user->properties()->where('purpose', 'rent')->count();
        $available = $user->properties()->where('status', 'available')->count();
        $recentProperties = $user->properties()->with('media')->latest()->take(5)->get();

        $hour = now()->hour;
        $greeting = $hour < 12 ? 'Good Morning' : ($hour < 17 ? 'Good Afternoon' : 'Good Evening');
    @endphp

    <style>
        :root{
            --pd-green:#12372A;
            --pd-green-2:#1d4d3c;
            --pd-green-3:#285f4b;
            --pd-gold:#C9A227;
            --pd-cream:#F7F5EF;
            --pd-charcoal:#202522;
        }
        .pd-card{ background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); border:none; transition:transform .18s ease, box-shadow .18s ease; }
        .pd-card.pd-hoverable:hover{ transform:translateY(-4px); box-shadow:0 10px 26px rgba(18,55,42,.09); }
        .btn-pd-primary{
            background:var(--pd-green); color:#fff; border:none; padding:11px 22px;
            border-radius:10px; font-weight:600; font-size:14px; text-decoration:none; display:inline-block;
            transition:background .15s ease, transform .15s ease;
        }
        .btn-pd-primary:hover{ background:var(--pd-green-2); color:#fff; transform:translateY(-1px); }
        .pd-hero{
            border-radius:20px; overflow:hidden; position:relative; color:#fff; padding:34px 38px;
            background:linear-gradient(120deg, var(--pd-green) 0%, var(--pd-green-2) 55%, var(--pd-green-3) 100%);
        }
        .pd-hero::after{
            content:""; position:absolute; inset:0; pointer-events:none;
            background: radial-gradient(circle at 85% 30%, rgba(255,255,255,.08), transparent 40%);
        }
        .pd-hero-badge{
            display:inline-block; background:rgba(255,255,255,.9); color:var(--pd-charcoal);
            padding:5px 14px; border-radius:20px; font-size:12px; font-weight:600; margin-bottom:14px;
        }
        .pd-hero-feat{ display:flex; align-items:center; gap:8px; font-size:13px; opacity:.9; transition:opacity .15s ease; }
        .pd-hero-feat:hover{ opacity:1; }
        .pd-hero-feat .ic{
            width:26px; height:26px; border-radius:7px; background:rgba(255,255,255,.15);
            display:flex; align-items:center; justify-content:center; font-size:13px; flex-shrink:0;
            transition:background .15s ease, transform .15s ease;
        }
        .pd-hero-feat:hover .ic{ background:rgba(255,255,255,.28); transform:scale(1.08); }
        .pd-stat-icon{ width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:20px; transition:transform .18s ease; }
        .pd-card.pd-hoverable:hover .pd-stat-icon{ transform:scale(1.1) rotate(-4deg); }
        .pd-prop-row{ display:flex; align-items:center; gap:14px; padding:12px 10px; border-bottom:1px solid #f0f0f0; border-radius:12px; transition:background .15s ease; margin:0 -10px; }
        .pd-prop-row:hover{ background:#faf9f6; }
        .pd-prop-row:last-child{ border-bottom:none; }
        .pd-prop-img{ width:76px; height:60px; border-radius:10px; object-fit:cover; flex-shrink:0; transition:transform .2s ease; }
        .pd-prop-row:hover .pd-prop-img{ transform:scale(1.05); }
        .pd-prop-placeholder{
            width:76px; height:60px; border-radius:10px; flex-shrink:0; background:#f1f4f2;
            display:flex; align-items:center; justify-content:center; font-size:24px;
        }
        .pd-tag{ display:inline-block; font-size:11px; padding:2px 9px; border-radius:20px; margin-right:5px; font-weight:600; }
        .pd-tag-type{ background:#eef2ff; color:#4c5fd5; }
        .pd-tag-sale{ background:#e8f7ef; color:#1a8a4a; }
        .pd-tag-rent{ background:#fff4dd; color:#b8860b; }
        .pd-view-all{ color:var(--pd-green); text-decoration:none; font-weight:600; font-size:13px; transition:gap .15s ease; }
        .pd-view-all:hover{ text-decoration:underline; }
        .btn-pd-view-sm{
            display:inline-block; background:#e8f3ed; color:var(--pd-green); font-size:12px; font-weight:700;
            padding:5px 14px; border-radius:8px; text-decoration:none; margin-top:6px; transition:background .15s ease, transform .15s ease;
        }
        .btn-pd-view-sm:hover{ background:var(--pd-green); color:#fff; transform:translateY(-1px); }
        .pd-quick-panel{ background:var(--pd-green); border-radius:18px; padding:24px; color:#fff; }
        .pd-quick-item{
            display:flex; align-items:center; justify-content:space-between; gap:12px;
            background:rgba(255,255,255,.08); padding:14px; border-radius:12px; margin-bottom:10px;
            text-decoration:none; color:#fff; transition:background .15s ease, transform .15s ease;
        }
        .pd-quick-item:hover{ background:rgba(255,255,255,.16); color:#fff; transform:translateX(4px); }
        .pd-quick-item span:last-child{ transition:transform .15s ease; }
        .pd-quick-item:hover span:last-child{ transform:translateX(3px); }
        .pd-quick-ic{ width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,.15); display:flex; align-items:center; justify-content:center; transition:transform .18s ease; }
        .pd-quick-item:hover .pd-quick-ic{ transform:scale(1.1); }
        .pd-cta-bar{
            background:var(--pd-cream); border-radius:18px; padding:24px 28px;
            display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px;
            transition:box-shadow .18s ease;
        }
        .pd-cta-bar:hover{ box-shadow:0 8px 24px rgba(0,0,0,.06); }
        .btn-pd-outline{
            border:1.5px solid var(--pd-charcoal); background:transparent; padding:11px 20px;
            border-radius:10px; font-weight:600; text-decoration:none; color:var(--pd-charcoal); display:inline-block;
            transition:background .15s ease, color .15s ease, transform .15s ease;
        }
        .btn-pd-outline:hover{ background:var(--pd-charcoal); color:#fff; transform:translateY(-1px); }
    </style>

    <div class="py-4">
        <div class="container-fluid px-4">

            {{-- WELCOME BANNER --}}
            <div class="pd-hero mb-4">
                <span class="pd-hero-badge">ProDesk Dashboard</span>
                <h1 class="fw-bold mb-2 position-relative">{{ $greeting }}, {{ $user->name }} 👋</h1>
                <p class="mb-4 opacity-75 fs-6 position-relative" style="max-width:520px;">
                    Manage your properties and keep your real-estate business organized.
                </p>
                <div class="d-flex flex-wrap gap-4 position-relative">
                    <div class="pd-hero-feat"><span class="ic">🏠</span> List Properties</div>
                    <div class="pd-hero-feat"><span class="ic">👥</span> Manage Clients</div>
                    <div class="pd-hero-feat"><span class="ic">📈</span> Track Growth</div>
                    <div class="pd-hero-feat"><span class="ic">📱</span> Access Anywhere</div>
                </div>
            </div>

            {{-- STATISTICS --}}
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-xl-3">
                    <div class="pd-card pd-hoverable p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">Total Properties</p>
                                <h2 class="fw-bold mb-0">{{ $totalProperties }}</h2>
                            </div>
                            <div class="pd-stat-icon" style="background:#e8f3ed;">🏠</div>
                        </div>
                        <small class="text-muted d-block mt-3">All your property listings</small>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="pd-card pd-hoverable p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">For Sale</p>
                                <h2 class="fw-bold mb-0">{{ $forSale }}</h2>
                            </div>
                            <div class="pd-stat-icon" style="background:#fff5d9;">🏷️</div>
                        </div>
                        <small class="text-muted d-block mt-3">Properties available for sale</small>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="pd-card pd-hoverable p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">For Rent</p>
                                <h2 class="fw-bold mb-0">{{ $forRent }}</h2>
                            </div>
                            <div class="pd-stat-icon" style="background:#edf5ff;">🔑</div>
                        </div>
                        <small class="text-muted d-block mt-3">Properties available for rent</small>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="pd-card pd-hoverable p-4 h-100">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">Available</p>
                                <h2 class="fw-bold mb-0">{{ $available }}</h2>
                            </div>
                            <div class="pd-stat-icon" style="background:#e8f7ef;">✓</div>
                        </div>
                        <small class="text-success d-block mt-3">Currently available</small>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="row g-4">

                {{-- Recent Properties --}}
                <div class="col-lg-8">
                    <div class="pd-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="fw-bold mb-1">Recent Properties</h5>
                                <p class="text-muted small mb-0">Your latest property listings</p>
                            </div>
                            <a href="{{ route('properties.index') }}" class="pd-view-all">View All →</a>
                        </div>

                        @forelse($recentProperties as $property)
                            @php
                                $cover = $property->media->where('type', 'image')->where('is_cover', true)->first();
                                if (!$cover) {
                                    $cover = $property->media->where('type', 'image')->first();
                                }
                            @endphp

                            <div class="pd-prop-row">
                                @if($cover)
                                    <img class="pd-prop-img" src="{{ asset('storage/' . $cover->file_path) }}" alt="{{ $property->title }}">
                                @else
                                    <div class="pd-prop-placeholder">🏠</div>
                                @endif

                                <div class="flex-grow-1 min-w-0">
                                    <h6 class="fw-bold mb-1">{{ $property->title }}</h6>
                                    <small class="text-muted d-block mb-1">📍 {{ $property->address }}</small>
                                    <span class="pd-tag pd-tag-type">{{ ucfirst($property->property_type) }}</span>
                                    <span class="pd-tag {{ $property->purpose === 'rent' ? 'pd-tag-rent' : 'pd-tag-sale' }}">
                                        {{ ucfirst($property->purpose) }}
                                    </span>
                                </div>

                                <div class="text-end flex-shrink-0">
                                    <div class="fw-bold">
                                        ₹{{ number_format($property->price) }}{{ $property->purpose === 'rent' ? ' / month' : '' }}
                                    </div>
                                    <a href="{{ route('properties.show', $property) }}" class="btn-pd-view-sm">View</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <div style="font-size: 50px;">🏠</div>
                                <h6 class="fw-bold mt-3">No properties yet</h6>
                                <p class="text-muted small">Add your first property to get started.</p>
                                <a href="{{ route('properties.create') }}" class="btn-pd-primary">+ Add Property</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="col-lg-4">
                    <div class="pd-quick-panel h-100">
                        <h5 class="fw-bold mb-1">Quick Actions</h5>
                        <p class="small opacity-75 mb-4">Manage your properties quickly.</p>

                        <a href="{{ route('properties.create') }}" class="pd-quick-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="pd-quick-ic">➕</div>
                                <div>
                                    <div class="fw-semibold">Add Property</div>
                                    <small class="opacity-75">Create a new listing</small>
                                </div>
                            </div>
                            <span>›</span>
                        </a>

                        <a href="{{ route('properties.index') }}" class="pd-quick-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="pd-quick-ic">🏘️</div>
                                <div>
                                    <div class="fw-semibold">View Properties</div>
                                    <small class="opacity-75">Manage all listings</small>
                                </div>
                            </div>
                            <span>›</span>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="pd-quick-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="pd-quick-ic">👤</div>
                                <div>
                                    <div class="fw-semibold">Profile Settings</div>
                                    <small class="opacity-75">Manage your account</small>
                                </div>
                            </div>
                            <span>›</span>
                        </a>

                        <div class="mt-4 pt-4 border-top border-light border-opacity-25">
                            <h4 class="fw-bold">Build Better Deals.</h4>
                            <p class="small opacity-75 mb-0">Keep your properties organized and ready to present.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOTTOM CTA --}}
            <div class="pd-cta-bar mt-4">
                <div>
                    <h5 class="fw-bold mb-2">Your Properties. One Digital Showroom.</h5>
                    <p class="text-muted mb-0">Add properties, manage media and keep everything ready for your clients.</p>
                </div>
                <a href="{{ route('properties.index') }}" class="btn-pd-outline">Manage Properties →</a>
            </div>

        </div>
    </div>

</x-app-layout>
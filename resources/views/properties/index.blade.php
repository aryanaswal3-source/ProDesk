<x-app-layout>

    <x-slot name="header">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h2 class="h4 mb-1">
                    Properties
                </h2>

                <small class="text-muted">
                    Manage your property collection
                </small>
            </div>

            <div class="d-flex gap-2">

                {{-- Back to Dashboard --}}
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    ← Back
                </a>

                {{-- Add Property --}}
                <a href="{{ route('properties.create') }}" class="btn btn-primary">
                    + Add Property
                </a>

            </div>

        </div>

    </x-slot>


    <div class="py-4">

        <div class="container">


            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>
            @endif


            {{-- Properties --}}
            <div class="row g-4">

                @forelse($properties as $property)


                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | Property Media
                        |--------------------------------------------------------------------------
                        */

                        $media = $property->media;

                    @endphp


                    <div class="col-md-6 col-lg-4">


                        <div class="card h-100 border-0 shadow-sm overflow-hidden">


                            {{-- ===================================== --}}
                            {{-- MEDIA SECTION --}}
                            {{-- ===================================== --}}

                            @if ($media->count() > 0)
                                <div id="propertyCarousel{{ $property->id }}" class="carousel slide"
                                    data-bs-ride="false">


                                    {{-- Media --}}
                                    <div class="carousel-inner">


                                        @foreach ($media as $index => $item)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">


                                                {{-- IMAGE --}}
                                                @if ($item->type === 'image')
                                                    <img src="{{ asset('storage/' . $item->file_path) }}"
                                                        class="d-block w-100" alt="{{ $property->title }}"
                                                        style="
                                                            height: 240px;
                                                            object-fit: cover;
                                                         ">


                                                    {{-- VIDEO --}}
                                                @elseif($item->type === 'video')
                                                    <video class="d-block w-100" controls preload="metadata"
                                                        style="
                                                              height: 240px;
                                                              object-fit: cover;
                                                              background: #000;
                                                           ">

                                                        <source src="{{ asset('storage/' . $item->file_path) }}"
                                                            type="video/mp4">

                                                        Your browser does not support video playback.

                                                    </video>
                                                @endif


                                            </div>
                                        @endforeach

                                    </div>


                                    {{-- Previous --}}
                                    @if ($media->count() > 1)
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="prev">

                                            <span class="carousel-control-prev-icon"></span>

                                            <span class="visually-hidden">
                                                Previous
                                            </span>

                                        </button>


                                        {{-- Next --}}
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#propertyCarousel{{ $property->id }}" data-bs-slide="next">

                                            <span class="carousel-control-next-icon"></span>

                                            <span class="visually-hidden">
                                                Next
                                            </span>

                                        </button>
                                    @endif


                                    {{-- Indicators --}}
                                    @if ($media->count() > 1)
                                        <div class="carousel-indicators">

                                            @foreach ($media as $index => $item)
                                                <button type="button"
                                                    data-bs-target="#propertyCarousel{{ $property->id }}"
                                                    data-bs-slide-to="{{ $index }}"
                                                    class="{{ $index === 0 ? 'active' : '' }}"
                                                    aria-label="Media {{ $index + 1 }}">
                                                </button>
                                            @endforeach

                                        </div>
                                    @endif


                                </div>
                            @else
                                {{-- No Media --}}
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 240px;">

                                    <div class="text-center text-muted">

                                        <div style="font-size: 45px;">
                                            🏠
                                        </div>

                                        <div>
                                            No property media
                                        </div>

                                    </div>

                                </div>
                            @endif


                            {{-- ===================================== --}}
                            {{-- PROPERTY DETAILS --}}
                            {{-- ===================================== --}}

                            <div class="card-body">


                                {{-- Title --}}
                                <h5 class="card-title mb-2">

                                    {{ $property->title }}

                                </h5>


                                {{-- Property Type + Purpose --}}
                                <div class="mb-2">

                                    <span class="badge bg-light text-dark">

                                        {{ ucfirst($property->property_type) }}

                                    </span>

                                    <span class="badge bg-primary">

                                        {{ ucfirst($property->purpose) }}

                                    </span>

                                </div>


                                {{-- Price --}}
                                <h5 class="text-primary mb-2">

                                    ₹{{ number_format($property->price) }}

                                </h5>


                                {{-- Address --}}
                                <p class="text-muted mb-3">

                                    📍 {{ $property->address }}

                                </p>


                                {{-- Property Information --}}
                                <div class="d-flex flex-wrap gap-3 mb-3">


                                    @if ($property->bedrooms)
                                        <small class="text-muted">
                                            🛏 {{ $property->bedrooms }} Beds
                                        </small>
                                    @endif


                                    @if ($property->bathrooms)
                                        <small class="text-muted">
                                            🚿 {{ $property->bathrooms }} Baths
                                        </small>
                                    @endif


                                    @if ($property->area)
                                        <small class="text-muted">
                                            📐 {{ $property->area }}
                                        </small>
                                    @endif


                                </div>


                                {{-- Status --}}
                                <div class="mb-3">

                                    @if ($property->status === 'available')
                                        <span class="badge bg-success">
                                            Available
                                        </span>
                                    @elseif($property->status === 'hold')
                                        <span class="badge bg-warning text-dark">
                                            On Hold
                                        </span>
                                    @elseif($property->status === 'sold')
                                        <span class="badge bg-danger">
                                            Sold
                                        </span>
                                    @elseif($property->status === 'rented')
                                        <span class="badge bg-secondary">
                                            Rented
                                        </span>
                                    @endif

                                </div>


                                {{-- ===================================== --}}
                                {{-- ACTION BUTTONS --}}
                                {{-- ===================================== --}}

                                <div class="d-flex gap-2">


                                    {{-- View --}}
                                    <a href="{{ route('properties.show', $property) }}" class="btn btn-sm btn-primary">

                                        View

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('properties.edit', $property) }}"
                                        class="btn btn-sm btn-outline-secondary">

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('properties.destroy', $property) }}" method="POST"
                                        class="d-inline">

                                        @csrf

                                        @method('DELETE')


                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this property?')">

                                            Delete

                                        </button>

                                    </form>


                                </div>


                            </div>

                        </div>


                    </div>


                @empty


                    {{-- ===================================== --}}
                    {{-- EMPTY STATE --}}
                    {{-- ===================================== --}}

                    <div class="col-12">

                        <div class="text-center py-5">


                            <div style="font-size: 60px;">
                                🏠
                            </div>


                            <h4 class="mt-3">
                                No properties yet
                            </h4>


                            <p class="text-muted">
                                Start by adding your first property.
                            </p>


                            <a href="{{ route('properties.create') }}" class="btn btn-primary">

                                + Add Property

                            </a>


                        </div>

                    </div>


                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>

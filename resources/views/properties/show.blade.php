<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">

            <h2 class="h4 mb-0">
                Property Details
            </h2>

            <div class="d-flex gap-2">

                <a href="{{ route('properties.edit', $property) }}"
                   class="btn btn-primary">
                    Edit Property
                </a>

                <a href="{{ route('properties.index') }}"
                   class="btn btn-secondary">
                    ← Back
                </a>

            </div>

        </div>
    </x-slot>


    <div class="py-4">

        <div class="container">


            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Error Message --}}
            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show">

                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Property Details --}}
            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h3 class="mb-3">
                        {{ $property->title }}
                    </h3>


                    <p>
                        <strong>Property Type:</strong>
                        {{ ucfirst($property->property_type) }}
                    </p>


                    <p>
                        <strong>Purpose:</strong>
                        {{ ucfirst($property->purpose) }}
                    </p>


                    <p>
                        <strong>Price:</strong>
                        ₹{{ number_format($property->price) }}
                    </p>


                    <p>
                        <strong>Area:</strong>
                        {{ $property->area ?? 'N/A' }}
                    </p>


                    <p>
                        <strong>Bedrooms:</strong>
                        {{ $property->bedrooms ?? 'N/A' }}
                    </p>


                    <p>
                        <strong>Bathrooms:</strong>
                        {{ $property->bathrooms ?? 'N/A' }}
                    </p>


                    <p>
                        <strong>Status:</strong>
                        {{ ucfirst($property->status) }}
                    </p>


                    <p>
                        <strong>Address:</strong>
                        {{ $property->address }}
                    </p>


                    <hr>


                    <h5>Description</h5>

                    <p class="text-muted">
                        {{ $property->description ?? 'No description added.' }}
                    </p>

                </div>

            </div>


            {{-- ===================================== --}}
            {{-- PROPERTY MEDIA --}}
            {{-- ===================================== --}}

            <div class="mt-5">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="mb-0">
                        Property Media
                    </h4>

                </div>


                {{-- Upload Media --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-body">

                        <h5 class="mb-3">
                            Upload Photo / Video
                        </h5>


                        <form action="{{ route('properties.media.store', $property) }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf


                            <div class="mb-3">

                                <label class="form-label">
                                    Select Photo or Video
                                </label>

                                <input type="file"
                                       name="media"
                                       class="form-control"
                                       accept="image/*,video/*"
                                       required>

                            </div>


                            <button type="submit"
                                    class="btn btn-primary">

                                Upload Media

                            </button>

                        </form>

                    </div>

                </div>


                {{-- ===================================== --}}
                {{-- PROPERTY PHOTOS --}}
                {{-- ===================================== --}}

                <h4 class="mb-3">
                    Property Photos
                </h4>


                @php

                    $images = $property->media
                        ->where('type', 'image');

                    $videos = $property->media
                        ->where('type', 'video');

                @endphp


                @if($images->count())


                    <div class="row g-4 mb-5">


                        @foreach($images as $media)


                            <div class="col-md-6 col-lg-4">


                                <div class="card h-100 shadow-sm border-0 overflow-hidden">


                                    {{-- Image --}}
                                    <img src="{{ asset('storage/' . $media->file_path) }}"
                                         class="card-img-top"
                                         style="
                                            height: 220px;
                                            object-fit: cover;
                                         "
                                         alt="Property Image">


                                    <div class="card-body">


                                        {{-- Cover Badge --}}
                                        @if($media->is_cover)

                                            <div class="mb-3">

                                                <span class="badge bg-success">

                                                    ⭐ Cover Photo

                                                </span>

                                            </div>

                                        @endif


                                        <div class="d-flex gap-2 flex-wrap">


                                            {{-- Set Cover --}}
                                            @if(!$media->is_cover)

                                                <form action="{{ route('properties.media.cover', $media) }}"
                                                      method="POST">

                                                    @csrf

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-primary">

                                                        ⭐ Set as Cover

                                                    </button>

                                                </form>

                                            @endif


                                            {{-- Delete --}}
                                            <form action="{{ route('properties.media.destroy', $media) }}"
                                                  method="POST">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Delete this photo?')">

                                                    Delete

                                                </button>

                                            </form>


                                        </div>

                                    </div>

                                </div>


                            </div>


                        @endforeach


                    </div>


                @else


                    <div class="alert alert-light border">

                        No photos uploaded yet.

                    </div>


                @endif



                {{-- ===================================== --}}
                {{-- PROPERTY VIDEOS --}}
                {{-- ===================================== --}}

                <h4 class="mb-3 mt-4">
                    Property Videos
                </h4>


                @if($videos->count())


                    <div class="row g-4">


                        @foreach($videos as $media)


                            <div class="col-md-6">


                                <div class="card shadow-sm border-0 overflow-hidden">


                                    {{-- Video --}}
                                    <video controls
                                           class="w-100"
                                           preload="metadata"
                                           style="
                                                max-height: 350px;
                                                background: #000;
                                           ">

                                        <source src="{{ asset('storage/' . $media->file_path) }}">

                                        Your browser does not support video playback.

                                    </video>


                                    <div class="card-body">


                                        <form action="{{ route('properties.media.destroy', $media) }}"
                                              method="POST">

                                            @csrf

                                            @method('DELETE')


                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this video?')">

                                                Delete Video

                                            </button>

                                        </form>

                                    </div>

                                </div>


                            </div>


                        @endforeach


                    </div>


                @else


                    <div class="alert alert-light border">

                        No videos uploaded yet.

                    </div>


                @endif


            </div>

        </div>

    </div>

</x-app-layout>
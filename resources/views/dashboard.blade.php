<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold">
                    ProDesk Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Welcome back, {{ auth()->user()->name }} 👋
                </p>
            </div>

            <a href="{{ route('properties.create') }}"
               class="btn btn-primary">
                + Add Property
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">

            {{-- Stats --}}
            <div class="row g-4 mb-4">

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <p class="text-muted mb-2">
                                Total Properties
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ auth()->user()->properties()->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <p class="text-muted mb-2">
                                For Sale
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ auth()->user()->properties()->where('purpose', 'sale')->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <p class="text-muted mb-2">
                                For Rent
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ auth()->user()->properties()->where('purpose', 'rent')->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <p class="text-muted mb-2">
                                Available
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ auth()->user()->properties()->where('status', 'available')->count() }}
                            </h2>
                        </div>
                    </div>
                </div>

            </div>


            {{-- Quick Actions --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Quick Actions
                    </h5>

                    <div class="d-flex flex-wrap gap-2">

                        <a href="{{ route('properties.index') }}"
                           class="btn btn-outline-primary">
                            🏠 View Properties
                        </a>

                        <a href="{{ route('properties.create') }}"
                           class="btn btn-primary">
                            + Add Property
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="btn btn-outline-secondary">
                            ⚙ Profile Settings
                        </a>

                    </div>

                </div>

            </div>


            {{-- Recent Properties --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="fw-bold mb-0">
                            Recent Properties
                        </h5>

                        <a href="{{ route('properties.index') }}"
                           class="text-decoration-none">
                            View All →
                        </a>

                    </div>


                    @php
                        $recentProperties = auth()->user()
                            ->properties()
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp


                    @forelse($recentProperties as $property)

                        <div class="border rounded p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <h6 class="fw-bold mb-1">
                                        {{ $property->title }}
                                    </h6>

                                    <p class="text-muted mb-1">
                                        {{ $property->address }}
                                    </p>

                                    <small class="text-muted">
                                        {{ ucfirst($property->property_type) }}
                                        •
                                        {{ ucfirst($property->purpose) }}
                                    </small>

                                </div>

                                <div class="text-end">

                                    <strong>
                                        ₹{{ number_format($property->price) }}
                                    </strong>

                                    <br>

                                    <a href="{{ route('properties.show', $property) }}"
                                       class="btn btn-sm btn-outline-primary mt-2">
                                        View
                                    </a>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-4">

                            <h6 class="fw-bold">
                                No properties yet
                            </h6>

                            <p class="text-muted">
                                Add your first property to start your digital catalogue.
                            </p>

                            <a href="{{ route('properties.create') }}"
                               class="btn btn-primary">
                                + Add Property
                            </a>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
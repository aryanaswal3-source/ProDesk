<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1">Add Property</h2>
                <p class="text-muted mb-0">
                    Add a new property to your catalogue.
                </p>
            </div>

            <a href="{{ route('properties.index') }}"
               class="btn btn-outline-secondary">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body p-4">

                    <form action="{{ route('properties.store') }}"
                          method="POST">

                        @csrf

                        <div class="row g-3">

                            {{-- Property Title --}}
                            <div class="col-md-8">
                                <label class="form-label">
                                    Property Title
                                </label>

                                <input type="text"
                                       name="title"
                                       value="{{ old('title') }}"
                                       class="form-control"
                                       placeholder="e.g. Luxury 3 BHK House"
                                       required>
                            </div>

                            {{-- Property Type --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Property Type
                                </label>

                                <select name="property_type"
                                        class="form-select"
                                        required>
                                    <option value="">Select Type</option>

                                    <option value="house"
                                        {{ old('property_type') == 'house' ? 'selected' : '' }}>
                                        House
                                    </option>

                                    <option value="flat"
                                        {{ old('property_type') == 'flat' ? 'selected' : '' }}>
                                        Flat / Apartment
                                    </option>

                                    <option value="plot"
                                        {{ old('property_type') == 'plot' ? 'selected' : '' }}>
                                        Plot
                                    </option>

                                    <option value="shop"
                                        {{ old('property_type') == 'shop' ? 'selected' : '' }}>
                                        Shop
                                    </option>

                                    <option value="office"
                                        {{ old('property_type') == 'office' ? 'selected' : '' }}>
                                        Office
                                    </option>
                                </select>
                            </div>

                            {{-- Purpose --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Purpose
                                </label>

                                <select name="purpose"
                                        class="form-select"
                                        required>
                                    <option value="">Select Purpose</option>

                                    <option value="sale"
                                        {{ old('purpose') == 'sale' ? 'selected' : '' }}>
                                        For Sale
                                    </option>

                                    <option value="rent"
                                        {{ old('purpose') == 'rent' ? 'selected' : '' }}>
                                        For Rent
                                    </option>
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Price
                                </label>

                                <input type="number"
                                       name="price"
                                       value="{{ old('price') }}"
                                       class="form-control"
                                       placeholder="e.g. 8500000"
                                       min="0"
                                       required>
                            </div>

                            {{-- Area --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Area (sq.ft.)
                                </label>

                                <input type="number"
                                       name="area"
                                       value="{{ old('area') }}"
                                       class="form-control"
                                       placeholder="e.g. 1800"
                                       min="0">
                            </div>

                            {{-- Bedrooms --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Bedrooms
                                </label>

                                <input type="number"
                                       name="bedrooms"
                                       value="{{ old('bedrooms') }}"
                                       class="form-control"
                                       min="0"
                                       placeholder="e.g. 3">
                            </div>

                            {{-- Bathrooms --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Bathrooms
                                </label>

                                <input type="number"
                                       name="bathrooms"
                                       value="{{ old('bathrooms') }}"
                                       class="form-control"
                                       min="0"
                                       placeholder="e.g. 2">
                            </div>

                            {{-- Status --}}
                            <div class="col-md-4">
                                <label class="form-label">
                                    Status
                                </label>

                                <select name="status"
                                        class="form-select"
                                        required>

                                    <option value="available"
                                        {{ old('status', 'available') == 'available' ? 'selected' : '' }}>
                                        Available
                                    </option>

                                    <option value="hold"
                                        {{ old('status') == 'hold' ? 'selected' : '' }}>
                                        Hold
                                    </option>

                                    <option value="sold"
                                        {{ old('status') == 'sold' ? 'selected' : '' }}>
                                        Sold
                                    </option>

                                    <option value="rented"
                                        {{ old('status') == 'rented' ? 'selected' : '' }}>
                                        Rented
                                    </option>

                                </select>
                            </div>

                            {{-- Address --}}
                            <div class="col-12">
                                <label class="form-label">
                                    Address
                                </label>

                                <textarea name="address"
                                          class="form-control"
                                          rows="2"
                                          placeholder="Enter complete property address"
                                          required>{{ old('address') }}</textarea>
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <label class="form-label">
                                    Description
                                </label>

                                <textarea name="description"
                                          class="form-control"
                                          rows="5"
                                          placeholder="Describe the property...">{{ old('description') }}</textarea>
                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('properties.index') }}"
                               class="btn btn-light">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Save Property
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
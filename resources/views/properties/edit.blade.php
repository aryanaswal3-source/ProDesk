<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">
                Edit Property
            </h2>

            <a href="{{ route('properties.index') }}"
               class="btn btn-secondary">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('properties.update', $property) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Property Title</label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title', $property->title) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Property Type</label>

                            <select name="property_type"
                                    class="form-select"
                                    required>

                                <option value="house"
                                    {{ old('property_type', $property->property_type) == 'house' ? 'selected' : '' }}>
                                    House
                                </option>

                                <option value="flat"
                                    {{ old('property_type', $property->property_type) == 'flat' ? 'selected' : '' }}>
                                    Flat
                                </option>

                                <option value="plot"
                                    {{ old('property_type', $property->property_type) == 'plot' ? 'selected' : '' }}>
                                    Plot
                                </option>

                                <option value="shop"
                                    {{ old('property_type', $property->property_type) == 'shop' ? 'selected' : '' }}>
                                    Shop
                                </option>

                                <option value="office"
                                    {{ old('property_type', $property->property_type) == 'office' ? 'selected' : '' }}>
                                    Office
                                </option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Purpose</label>

                            <select name="purpose"
                                    class="form-select"
                                    required>

                                <option value="sale"
                                    {{ old('purpose', $property->purpose) == 'sale' ? 'selected' : '' }}>
                                    Sale
                                </option>

                                <option value="rent"
                                    {{ old('purpose', $property->purpose) == 'rent' ? 'selected' : '' }}>
                                    Rent
                                </option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>

                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   value="{{ old('price', $property->price) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Area</label>

                            <input type="number"
                                   name="area"
                                   class="form-control"
                                   value="{{ old('area', $property->area) }}">
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bedrooms</label>

                                <input type="number"
                                       name="bedrooms"
                                       class="form-control"
                                       value="{{ old('bedrooms', $property->bedrooms) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bathrooms</label>

                                <input type="number"
                                       name="bathrooms"
                                       class="form-control"
                                       value="{{ old('bathrooms', $property->bathrooms) }}">
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>

                            <select name="status"
                                    class="form-select"
                                    required>

                                <option value="available"
                                    {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="hold"
                                    {{ old('status', $property->status) == 'hold' ? 'selected' : '' }}>
                                    Hold
                                </option>

                                <option value="sold"
                                    {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>
                                    Sold
                                </option>

                                <option value="rented"
                                    {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>
                                    Rented
                                </option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>

                            <input type="text"
                                   name="address"
                                   class="form-control"
                                   value="{{ old('address', $property->address) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>

                            <textarea name="description"
                                      class="form-control"
                                      rows="5">{{ old('description', $property->description) }}</textarea>
                        </div>

                        <button type="submit"
                                class="btn btn-primary">
                            Update Property
                        </button>

                        <a href="{{ route('properties.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
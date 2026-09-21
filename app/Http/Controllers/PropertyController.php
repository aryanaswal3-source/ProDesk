<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display all properties of logged-in dealer.
     */
    public function index()
    {
        $properties = auth()->user()
            ->properties()
            ->with('media')
            ->latest()
            ->get();

        return view('properties.index', compact('properties'));
    }

    /**
     * Show Add Property form.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store new property.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'property_type' => 'required|string|max:100',
            'purpose' => 'required|in:sale,rent',
            'price' => 'required|numeric|min:0',
            'area' => 'nullable|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string',
            'status' => 'required|in:available,hold,sold,rented',
        ]);

        $validated['user_id'] = auth()->id();

        Property::create($validated);

        return redirect()
            ->route('properties.index')
            ->with('success', 'Property added successfully.');
    }

    /**
     * Show a single property.
     */
    public function show(Property $property)
    {
        $this->authorizeProperty($property);

        $property->load('media');

        return view('properties.show', compact('property'));
    }

    /**
     * Show edit form.
     */
    public function edit(Property $property)
    {
        $this->authorizeProperty($property);

        return view('properties.edit', compact('property'));
    }

    /**
     * Update property.
     */
    public function update(Request $request, Property $property)
    {
        $this->authorizeProperty($property);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'property_type' => 'required|string|max:100',
            'purpose' => 'required|in:sale,rent',
            'price' => 'required|numeric|min:0',
            'area' => 'nullable|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'address' => 'required|string|max:500',
            'description' => 'nullable|string',
            'status' => 'required|in:available,hold,sold,rented',
        ]);

        $property->update($validated);

        return redirect()
            ->route('properties.index')
            ->with('success', 'Property updated successfully.');
    }

    /**
     * Delete property.
     */
    public function destroy(Property $property)
    {
        $this->authorizeProperty($property);

        $property->delete();

        return redirect()
            ->route('properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    /**
     * Make sure dealer can access only their own property.
     */
    private function authorizeProperty(Property $property): void
    {
        abort_unless(
            $property->user_id === auth()->id(),
            403
        );
    }
}
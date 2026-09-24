<?php

namespace App\Http\Controllers;

use App\Models\Property;

class PublicPropertyController extends Controller
{
    public function show(Property $property)
    {
        $property->load('media');

        return view('properties.public', compact('property'));
    }
}
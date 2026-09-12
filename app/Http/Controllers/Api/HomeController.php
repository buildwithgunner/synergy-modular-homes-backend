<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $homes = Home::latest()->get();
        return response()->json($homes);
    }

    public function show($id)
    {
        $home = Home::findOrFail($id);
        return response()->json($home);
    }

    public function store(Request $request)
    {
        $data = $this->prepareData($request);

        $validated = validator($data, $this->rules())->validate();

        // Keep old `price` field in sync
        if (isset($validated['price_min'])) {
            $validated['price'] = $validated['price_min'];
        }

        $home = Home::create($validated);

        return response()->json($home, 201);
    }

    public function update(Request $request, $id)
    {
        $home = Home::findOrFail($id);

        $data = $this->prepareData($request);

        $validated = validator($data, $this->rules(true))->validate();

        if (isset($validated['price_min'])) {
            $validated['price'] = $validated['price_min'];
        }

        $home->update($validated);

        return response()->json($home);
    }

    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();
        return response()->json(['message' => 'Home deleted']);
    }

    private function rules($isUpdate = false): array
    {
        $required = $isUpdate ? 'sometimes' : 'required';

        return [
            'title'                     => "$required|string|max:255",
            'house_name'                => 'nullable|string|max:255',
            'price_min'                 => "$required|numeric|min:0",
            'price_max'                 => "$required|numeric|min:0|gte:price_min",
            'currency'                  => 'nullable|string|max:10',
            'beds'                      => 'nullable|integer|min:0',
            'baths'                     => 'nullable|numeric|min:0',
            'living_area_min'           => 'nullable|integer|min:0',
            'living_area_max'           => 'nullable|integer|min:0|gte:living_area_min',
            'total_covered_area_min'    => 'nullable|integer|min:0',
            'total_covered_area_max'    => 'nullable|integer|min:0|gte:total_covered_area_min',
            'location'                  => 'nullable|string|max:255',
            'type'                      => 'nullable|string|max:255',
            'house_type'                => 'nullable|string|max:255',
            'description'               => 'nullable|string',
            'image'                     => 'nullable|string',
            'status'                    => 'nullable|string|max:50',
            'is_featured'               => 'nullable|boolean',
            'specs'                     => 'nullable|array',
            'amenities'                 => 'nullable|array',
            'images'                    => 'nullable|array',
        ];
    }

    private function prepareData(Request $request): array
    {
        $data = $request->all();

        // Decode JSON strings coming from FormData
        foreach (['specs', 'amenities', 'images'] as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = json_decode($data[$field], true) ?: [];
            }
        }

        // Convert is_featured from "1"/"0" / "true"/"false"
        if (isset($data['is_featured'])) {
            $data['is_featured'] = filter_var($data['is_featured'], FILTER_VALIDATE_BOOLEAN);
        }

        // Handle main image upload
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('homes', 'public');
            $data['image'] = asset('storage/' . $path);
        }

        // Handle gallery uploads
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('homes/gallery', 'public');
                $galleryPaths[] = asset('storage/' . $path);
            }

            $existing = $data['images'] ?? [];
            if (!is_array($existing)) {
                $existing = [];
            }

            $data['images'] = array_values(array_merge($existing, $galleryPaths));
        }

        return $data;
    }
}
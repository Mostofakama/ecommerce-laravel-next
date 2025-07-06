<?php

namespace App\Services;
use Exception;
use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class BannerServices{
       public function index()
    {
        
        $banners = Banner::paginate(10);
        return success($banners,'All banners fetched successfully');
    }

    public function store($request)
    {
       //return $request->image;
        // Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
          //  return 'yes';
            $file = $request->file('image');
            
            $randomName = Str::random(20) . '-' . time() . '.' . $file->getClientOriginalExtension();
           
            $file->storeAs('uploads/banner', $randomName, 'public');
            $imagePath = 'uploads/banner/' . $randomName;
        }
        
        $banner = Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle ?? null,
            'cta' => $request->cta ?? null,
            'cta_url' => $request->cta_url ?? null,
            'position' => $request->position ?? 'top',
            'type' => $request->type ?? 'slider',
            'order' => is_numeric($request->order) ? $request->order : 0, // ✅ fixed
            'status' => $request->status ?? true,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
            'image' => $imagePath, 
        ]);
       //dd($banner);
        return success($banner, 'Banner created successfully', true);
    }

    public function show($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            return success($banner, 'Banner fetched successfully');
        } catch (Exception $e) {
            return error('Banner not found', 404, $e->getMessage());
        }
    }

    public function update( $request, $id)
    {
        try {
            $banner = Banner::findOrFail($id);

            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'cta' => 'nullable|string|max:100',
                'cta_url' => 'nullable|string|max:255',
                'position' => ['nullable', Rule::in(['top', 'middle', 'bottom'])],
                'type' => ['nullable', Rule::in(['slider', 'popup', 'static'])],
                'order' => 'nullable|integer',
                'status' => 'boolean',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20048',
            ]);

            // 🔸 Image Upload (Replace old one)
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }

                $file = $request->file('image');
                $randomName = Str::random(20) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/banner', $randomName, 'public');
                $validated['image'] = 'uploads/banner/' . $randomName;
            }

            $banner->update($validated);
            return success($banner, 'Banner updated successfully');
        } catch (Exception $e) {
            return error('Banner update failed', 500, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);

            // 🔸 Delete image from storage
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();
            return success(null, 'Banner deleted successfully');
        } catch (Exception $e) {
            return error('Banner deletion failed', 500, $e->getMessage());
        }
    }
}
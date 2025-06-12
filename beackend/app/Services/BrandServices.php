<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;

class BrandServices{
    public function index()
    {
      $brand = Brand::paginate(10);
      return response()->json([
        'status' => true,
        'message' => 'all Brand get successfully!',
        'data' => $brand
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $audioFile = $request->file('image');
        $audioExtension = $audioFile->getClientOriginalExtension();
        $audioFilename = Str::random(20).'-'.time().'.'.$audioExtension;
        $audioFile->move(public_path('uploads/brand'), $audioFilename);

       $brand = Brand::create([
            'name'   => $request->name,
            'slug'   => $request->slug,
            'image'  => $audioFilename,
       ]);

       return response()->json([
          'status' => true,
          'message' => 'Brand Create Successfully',
          'data' => $brand,
       ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $brand = Brand::find($id);
        if(!$brand){
            return response()->json([
              'status' => false,
              'message' => 'brand not found!',
            ],401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Single brand Find Successfully!',
            'data' => $brand,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request,  $id)
    {
      $brandId = Brand::find($id);
      if (!$brandId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Brand not found',
                ], 404);
            }
             
      $data = $request->only([
          'name','slug',
      ]);

        if($request->hasFile('image')){
          if ($brandId->image && file_exists(public_path('uploads/brand/'.$brandId->image))) {
                    unlink(public_path('uploads/brand/'.$brandId->image));
                }
                 $imageFile = $request->file('image');
                $imageExtension = $imageFile->getClientOriginalExtension();
                $imageFilename = Str::random(20) .'-'.time().'.'.$imageExtension;
                $imageFile->move(public_path('uploads/brand'), $imageFilename);
                $data['image'] = $imageFilename;

        }

        $brandId->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully!',
            'data' => $brandId
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
          try {
            $Brand = Brand::find($id);
            
            if (!$Brand) {
                return response()->json([
                    'success' => false,
                    'message' => 'Brand not found',
                ], 404);
            }

            // Delete audio file
            if ($Brand->image && file_exists(public_path('uploads/brand/'.$Brand->image))) {
                    unlink(public_path('uploads/brand/'.$Brand->image));
                }

            
            $Brand->delete();

            return response()->json([
                'success' => true,
                'message' => 'Brand deleted successfully!',
            ]);

        } catch (\Throwable $th) {
            \Log::error('Brand deletion failed: '.$th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Brand',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
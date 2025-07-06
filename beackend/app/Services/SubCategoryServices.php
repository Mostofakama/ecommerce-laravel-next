<?php 

namespace App\Services;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryServices{
      public function index()
    {
      $category = SubCategory::paginate(10);
      return response()->json([
        'status' => true,
        'message' => 'all Sub Category get successfully!',
        'data' => $category
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
         $ImageFilename = null;
       // return $request;
       if ($request->hasFile('image')) {
        $ImageFile = $request->file('image');
        $ImageFileExtension = $ImageFile->getClientOriginalExtension();
        $ImageFilename = Str::random(20).'-'.time().'.'.$ImageFileExtension;
        $ImageFile->move(public_path('uploads/subcategory'), $ImageFilename);
       }
       // return $ImageFilename;
       $category = SubCategory::create([
            'name'   => $request->name,
            'slug'   => $request->slug,
            'image'  => $ImageFilename,
            'category_id' => $request->category_id,
            'status' => true,
       ]);

       return response()->json([
          'status' => true,
          'message' => 'Sub Category Create Successfully',
          'data' => $category,
       ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $category = SubCategory::find($id);
        if(!$category){
            return response()->json([
              'status' => false,
              'message' => 'Sub Category not found!',
            ],401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Single Sub Category Find Successfully!',
            'data' => $category,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request,  $id)
    {
      $catId = SubCategory::find($id);
      if (!$catId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sub Category not found',
                ], 404);
            }
             
      $data = $request->only([
          'name','slug','status','category_id'
      ]);

        if($request->hasFile('image')){
          if ($catId->image && file_exists(public_path('uploads/subcategory/'.$catId->image))) {
                    unlink(public_path('uploads/subcategory/'.$catId->image));
                }
                 $audioFile = $request->file('image');
                $audioExtension = $audioFile->getClientOriginalExtension();
                $audioFilename = Str::random(20) .'-'.time().'.'.$audioExtension;
                $audioFile->move(public_path('uploads/subcategory'), $audioFilename);
                $data['image'] = $audioFilename;

        }

        $catId->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Sub Category updated successfully!',
            'data' => $catId
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
          try {
            $catId = SubCategory::find($id);
            
            if (!$catId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sub Category not found',
                ], 404);
            }

            // Delete audio file
            if ($catId->image && file_exists(public_path('uploads/subcategory/'.$catId->image))) {
                    unlink(public_path('uploads/subcategory/'.$catId->image));
                }

            
            $catId->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sub Category deleted successfully!',
            ]);

        } catch (\Throwable $th) {
            \Log::error('Sub Category deletion failed: '.$th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete sub category',
                'error' => $th->getMessage()
            ], 500);
        }
    }



    public function categoryForm()
    {
        $category = Category::get();
        return response()->json([
            'status' =>true,
            'message' => 'all category select',
            'data' => $category,
        ]);
    }

    public function BrandForm()
    {
        $category = Brand::get();
        return response()->json([
            'status' =>true,
            'message' => 'all brand select',
            'data' => $category,
        ]);
    }
    public function SubCategoryForm()
    {
         $category = SubCategory::get();
        return response()->json([
            'status' =>true,
            'message' => 'All SubCategory select',
            'data' => $category,
        ]);
    }
}
<?php 

namespace App\Services;

class SubCategoryServices{
      public function index()
    {
      $category = Category::paginate(10);
      return response()->json([
        'status' => true,
        'message' => 'all Category get successfully!',
        'data' => $category
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
        $audioFile->move(public_path('uploads/category'), $audioFilename);

       $category = Category::create([
            'name'   => $request->name,
            'slug'   => $request->slug,
            'image'  => $audioFilename,
            'status' => true,
       ]);

       return response()->json([
          'status' => true,
          'message' => 'Category Create Successfully',
          'data' => $category,
       ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
              'status' => false,
              'message' => 'category not found!',
            ],401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Single Category Find Successfully!',
            'data' => $category,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request,  $id)
    {
      $catId = Category::find($id);
      if (!$catId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found',
                ], 404);
            }
             
      $data = $request->only([
          'name','slug','status'
      ]);

        if($request->hasFile('image')){
          if ($catId->image && file_exists(public_path('uploads/category/'.$catId->image))) {
                    unlink(public_path('uploads/category/'.$catId->image));
                }
                 $audioFile = $request->file('image');
                $audioExtension = $audioFile->getClientOriginalExtension();
                $audioFilename = Str::random(20) .'-'.time().'.'.$audioExtension;
                $audioFile->move(public_path('uploads/category'), $audioFilename);
                $data['image'] = $audioFilename;

        }

        $catId->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
            'data' => $catId
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
          try {
            $catId = Category::find($id);
            
            if (!$catId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            // Delete audio file
            if ($catId->image && file_exists(public_path('uploads/category/'.$catId->image))) {
                    unlink(public_path('uploads/category/'.$catId->image));
                }

            
            $catId->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully!',
            ]);

        } catch (\Throwable $th) {
            \Log::error('Category deletion failed: '.$th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
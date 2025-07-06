<?php 

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductVariant;

class ProductServices{
      public function index()
    {
      $products = Product::with([
        'brand:id,name',
        'category:id,name',
        'subCategory:id,name',
        'images:id,product_id,image,image_path,is_primary',
        'variants:id,product_id,color,size,quantity,is_active'
    ])
    ->latest()
    ->paginate(10);

    return response()->json([
        'status' => true,
        'message' => 'Product list with relations fetched successfully!',
        'data' => $products
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {

   
    $thumbnailPath = null;
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $randomName = Str::random(20) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/products/thumbnail', $randomName, 'public');
        $thumbnailPath = 'uploads/products/thumbnail/' . $randomName;
    }

    // Create product
    $product = Product::create([
        'name' => $request->name,
        'sku' => $request->sku,
        'slug' => $request->slug ?? Str::slug($request->name),
        'description' => $request->description,
        'summary' => $request->summary,
        'price' => $request->price,
        'original_price' => $request->original_price,
        'discount_type' => $request->discount_type,
        'discount_value' => $request->discount_value,
        'final_price' => $request->final_price, // Already calculated by frontend
        'quantity' => $request->quantity,
        'brand_id' => $request->brand_id,
        'category_id' => $request->category_id,
        'sub_category_id' => $request->subcategory_id,
        'status' => $request->status,
        'new_product' => $request->new_product ?? false,
        'best_seller' => $request->best_seller ?? false,
        'thumbnail' => $thumbnailPath,
        'meta_title' => $request->meta_title,
        'meta_description' => $request->meta_description,
        'meta_keyword' => $request->meta_keyword,
    ]);

    // Upload gallery images with random names
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $randomName = Str::random(20) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/products/gallery', $randomName, 'public');
            $imagePath = 'uploads/products/gallery/' . $randomName;

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $randomName,
                'image_path' => $imagePath,
                'is_primary' => false,
            ]);
        }
    }

    // Save variants
    if ($request->filled('variants')) {
        foreach ($request->variants as $variant) {
            ProductVariant::create([
                'product_id' => $product->id,
                'color' => $variant['color'] ?? null,
                'size' => $variant['size'] ?? null,
                'quantity' => $variant['quantity'],
                'is_active' => $variant['is_active'] ?? true,
            ]);
        }
    }

    return response()->json([
        'status' => true,
        'message' => 'Product created successfully!',
        'data' => $product->load(['brand', 'category', 'subCategory', 'images', 'variants']),
    ]);
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
            'message' => 'Sub category from category select',
            'data' => $category,
        ]);
    }
}
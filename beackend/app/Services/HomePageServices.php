<?php

namespace App\Services;

use App\Models\Product;

class HomePageServices{
  public function HomePageProduct(){
    $products = Product::with('brand')
    ->where('status', 'active')
    ->orderByDesc('created_at')
    ->paginate(15);
    return response()->json([
        'status' => true,
        'message' => 'Product list with relations fetched successfully!',
        'data' => $products
    ]);
  }

   public function SingleProduct( $slug){
     $product = Product::with(['brand','category','subCategory', 'images', 'variants'])
        ->where('slug', $slug)
        ->where('status', 'active')
        ->first();

    if (!$product) {
        return response()->json([
            'status' => false,
            'message' => 'Product not found!',
        ], 404);
    }

    return response()->json([
        'status' => true,
        'message' => 'Single product loaded successfully!',
        'data' => $product
    ]);
   }


    public function search( $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json(['error' => 'Query is required'], 400);
        }

        $products = Product::select('id', 'name', 'thumbnail','slug')->where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('sku', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%");
        })->get();

        
        return success($products,'search the product!');
    }


      public function FilterProduct($request)
    {
        // Step 1: Query builder তৈরি
        $query = Product::query();

        // Step 2: Filters অনুযায়ী শর্ত যোগ করা
        // 🔸 Category filter (multiple)
        if ($request->filled('categories')) {
            $categoryIds = explode(',', $request->categories);
            $query->whereIn('category_id', $categoryIds);
        }

        // 🔸 Subcategory filter
        if ($request->filled('subcategories')) {
            $subcategoryIds = explode(',', $request->subcategories);
            $query->whereIn('subcategory_id', $subcategoryIds);
        }

        // 🔸 Brand filter
        if ($request->filled('brands')) {
            $brandIds = explode(',', $request->brands);
            $query->whereIn('brand_id', $brandIds);
        }

        // 🔸 Price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 🔸 Discount range
        if ($request->filled('min_discount')) {
            $query->where('discount_percent', '>=', $request->min_discount);
        }
        if ($request->filled('max_discount')) {
            $query->where('discount_percent', '<=', $request->max_discount);
        }

        // 🔸 Sort logic
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'Best Seller':
                    $query->orderBy('sold_count', 'desc'); 
                    break;
                case 'New Released':
                    $query->orderBy('created_at', 'desc'); 
                    break;
                case 'Price - Low to High':
                    $query->orderBy('price', 'asc');
                    break;
                case 'Price - High to Low':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        $products = $query->paginate(20);

        return success($products,'Filter the product!');
    }


    public function NewProduct(){
      $products = Product::with('brand')
      ->where('status', 'active')
      ->where('new_product', true)
      ->orderByDesc('created_at')
      ->limit(10)
      ->get();
      return response()->json([
          'status' => true,
          'message' => 'Product list with relations fetched successfully!',
          'data' => $products
      ]);
    }

    public function BestSeller(){
      $products = Product::with('brand')
      ->where('status', 'active')
      ->where('best_seller', true)
      ->orderByDesc('created_at')
      ->limit(10)
      ->get();
      return response()->json([
          'status' => true,
          'message' => 'Product list with relations fetched successfully!',
          'data' => $products
      ]);
    }
}



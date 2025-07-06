<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\ProductServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequestStore;

class ProductController extends Controller
{
     protected $ProductServices;


    public function __construct(ProductServices $ProductServices){
      $this->ProductServices = $ProductServices;
    }
    public function index()
    {
       return $this->ProductServices->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequestStore $request)
    {
        return $this->ProductServices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->ProductServices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->ProductServices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return $this->ProductServices->destroy($id);
    }
}

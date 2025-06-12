<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubCategoryServices;
use App\Http\Requests\SubCategoryRequestStore;
use App\Http\Requests\SubCategoryRequestUpdate;

class SubCategoryController extends Controller
{ protected $SubCategoryServices;

    public function __construct(SubCategoryServices $SubCategoryServices){
      $this->SubCategoryServices = $SubCategoryServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->SubCategoryServices->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequestStore $request)
    {
        return $this->SubCategoryServices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->SubCategoryServices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequestUpdate $request, string $id)
    {
        return $this->SubCategoryServices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->SubCategoryServices->destroy($id);
    }
}

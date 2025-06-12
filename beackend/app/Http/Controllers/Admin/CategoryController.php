<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CategoryServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequestStore;
use App\Http\Requests\CategoryRequestUpdate;

class CategoryController extends Controller
{
    protected $CategoryServices;

    public function __construct(CategoryServices $CategoryServices){
      $this->CategoryServices = $CategoryServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->CategoryServices->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequestStore $request)
    {
         return $this->CategoryServices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return $this->CategoryServices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequestUpdate $request, string $id)
    {
         return $this->CategoryServices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         return $this->CategoryServices->destroy($id);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\BrandServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequestStore;
use App\Http\Requests\BrandRequestUpdate;

class BrandController extends Controller
{
    protected $BrandServices;

  
    public function __construct(BrandServices $BrandServices){
      $this->BrandServices = $BrandServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->BrandServices->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequestStore $request)
    {
        return $this->BrandServices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->BrandServices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequestUpdate $request, string $id)
    {
       return $this->BrandServices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return $this->BrandServices->destroy($id);
    }
}

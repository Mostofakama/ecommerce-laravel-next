<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\BannerServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{   
     protected $BannerServices;

  
    public function __construct(BannerServices $BannerServices){
      $this->BannerServices = $BannerServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return $this->BannerServices->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
       
        return $this->BannerServices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $this->BannerServices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->BannerServices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return $this->BannerServices->destroy($id);
    }
}

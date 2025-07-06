<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\AddressServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddressUpdateRequest;

class AddressController extends Controller
{
    protected $AddressServices;
    
    public function __construct(AddressServices $AddressServices){
      $this->AddressServices = $AddressServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->AddressServices->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        return $this->AddressServices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->AddressServices->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressUpdateRequest $request, string $id)
    {
        return $this->AddressServices->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->AddressServices->destroy($id);
    }
    
}

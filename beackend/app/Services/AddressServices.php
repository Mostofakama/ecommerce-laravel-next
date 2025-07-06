<?php 

namespace App\Services;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddressUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;

class AddressServices{
   public function index()
    {
        $address = Auth::user()->addresses()->with(['division', 'district', 'upazila'])->get();
        
     
        return success($address,'All Address Get');

    }

    public function store( $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        if (!empty($data['is_default']) && $data['is_default']) {
            $user->addresses()->update(['is_default' => false]);
        }
       
        $data['is_selected'] = false; 
        $data['user_id'] = $user->id;
        $address = Address::create($data);

        return success($address,'Your Address Create successful!');
    }

    public function update( $request, $id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $data = $request->validated();

        if (!empty($data['is_default']) && $data['is_default']) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }

        $address->update($data);
        return success($address,'Your Address Update successful!');
    }

    public function show($id)
    {
        $address= Address::where('id', $id)->where('user_id', Auth::id())
            ->with(['division', 'district', 'upazila'])->firstOrFail();
            return success($address,'Single Address get!');
    }

    public function destroy($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $address->delete();
        
        return success('Address deleted successfully');
    }

  
}

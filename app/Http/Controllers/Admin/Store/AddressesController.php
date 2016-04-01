<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Admin\Controller;
use App\Models\Store;
use Request;

class AddressesController extends Controller
{
    protected $section = 'storeAdmin';

    public function update($id)
    {
        $address = Store\Address::findOrFail($id);
        $address->unguard();
        $address->update(Request::input('address'));
        $address->save();

        return ['message' => 'address updated'];
    }
}

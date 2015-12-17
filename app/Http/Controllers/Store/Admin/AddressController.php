<?php

namespace App\Http\Controllers\Store\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Auth;
use Request;

class AddressController extends Controller
{
    protected $section = 'storeAdmin';

    public function __construct()
    {
        $this->middleware('auth');

        return parent::__construct();
    }

    public function update($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $address = Store\Address::findOrFail($id);
        $address->unguard();
        $address->update(Request::input('address'));
        $address->save();

        return ['message' => 'address updated'];
    }
}

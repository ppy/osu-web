<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Admin\Controller;
use App\Models\Store;
use Request;

class AddressesController extends Controller
{
    public function update($id)
    {
        $address = Store\Address::findOrFail($id);
        $address->unguard();
        $address->update(Request::input('address'));
        $address->save();

        return ['message' => 'address updated'];
    }
}

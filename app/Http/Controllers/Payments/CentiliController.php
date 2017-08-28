<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers\Payments;

use App\Events\Fulfillment\ProcessorValidationFailed;
use App\Exceptions\InvalidSignatureException;
use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Libraries\Payments\CentiliPaymentProcessor;
use App\Models\Store\Order;
use Auth;
use Request;

class CentiliController extends Controller
{
    public function callback(Request $request)
    {
        $processor = new CentiliPaymentProcessor($request->getFacadeRoot());
        if ($processor->isSkipped()) {
            // skip user_search notification
            return '';
        }

        try {
            $processor->run();
        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return response(['message' => 'A validation error occured while running the transaction'], 406);
        } catch (InvalidSignatureException $e) {
            return response(['message' => $e->getMessage()], 406);
        }

        return 'ok';
    }
}

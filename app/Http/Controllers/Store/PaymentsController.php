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

namespace App\Http\Controllers\Store;

use App\Libraries\CheckoutHelper;
use App\Models\Store\Order;
use Auth;
use Illuminate\Database\QueryException;
use Xsolla\SDK\API\XsollaClient;
use Xsolla\SDK\API\PaymentUI\TokenRequest;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-user-restricted');
        $this->middleware('verify-user');

        return parent::__construct();
    }

    public function xsolla()
    {
    }

    public function xsollaToken()
    {
        $projectId = config('xsolla.project_id');
        $user = Auth::user();
        $cart = Order::cart($user);

        if ($cart === null) {
            return;
        }

        $checkout = new CheckoutHelper($cart);

        $tokenRequest = new TokenRequest($projectId, (string)$user->user_id);
        $tokenRequest
            ->setSandboxMode(true)
            ->setExternalPaymentId($checkout->getXsollaCheckoutCode())
            ->setUserEmail($user->user_email)
            ->setUserName($user->username)
            ->setPurchase($cart->getTotal(), 'USD')
            ->setCustomParameters(array('key1' => 'value1', 'key2' => 'value2'));

        $xsollaClient = XsollaClient::factory(array(
            'merchant_id' => config('xsolla.merchant_id'),
            'api_key' => config('xsolla.api_key'),
        ));
        $token = $xsollaClient->createPaymentUITokenFromRequest($tokenRequest);

        return $token;
    }
}

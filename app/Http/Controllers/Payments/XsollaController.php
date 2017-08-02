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

use App\Http\Controllers\Controller;
use App\Libraries\Payments\XsollaNotificationProcessor;
use App\Models\Store\Order;
use Auth;
use Request;
use Xsolla\SDK\API\XsollaClient;
use Xsolla\SDK\API\PaymentUI\TokenRequest;

class XsollaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['token']]);
        $this->middleware('check-user-restricted', ['only' => ['token']]);
        $this->middleware('verify-user', ['only' => ['token']]);

        return parent::__construct();
    }

    public function token()
    {
        $projectId = config('xsolla.project_id');
        $user = Auth::user();
        $order = Order::cart($user);

        if ($order === null) {
            return;
        }

        $tokenRequest = new TokenRequest($projectId, (string)$user->user_id);
        $tokenRequest
            ->setSandboxMode(true)
            ->setExternalPaymentId($order->getOrderNumber())
            ->setUserEmail($user->user_email)
            ->setUserName($user->username)
            ->setPurchase($order->getTotal(), 'USD')
            ->setCustomParameters([
                'subtotal' => $order->getSubtotal(),
                'shipping' => $order->getShipping(),
            ]);

        $xsollaClient = XsollaClient::factory(array(
            'merchant_id' => config('xsolla.merchant_id'),
            'api_key' => config('xsolla.api_key'),
        ));

        $token = $xsollaClient->createPaymentUITokenFromRequest($tokenRequest);

        return $token;
    }
    public function callback(Request $request)
    {
        $processor = new XsollaNotificationProcessor($request->getFacadeRoot());

        try {
            $processor->validateTransaction();
            $processor->apply();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return 'whee';
    }
}

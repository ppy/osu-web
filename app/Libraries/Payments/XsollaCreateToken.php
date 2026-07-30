<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Payments;

use App\Exceptions\InvariantException;
use App\Models\Store\Order;
use App\Models\User;
use Xsolla\SDK\API\PaymentUI\TokenRequest;
use Xsolla\SDK\API\XsollaClient;

class XsollaCreateToken
{
    public function __construct(private Order $order, private User $user)
    {
        if ($this->order->user_id !== $this->user->getKey()) {
            throw new InvariantException();
        }
    }

    public function run()
    {
        $projectId = $GLOBALS['cfg']['payments']['xsolla']['project_id'];
        $tokenRequest = new TokenRequest($projectId, (string) $this->user->getKey());
        $tokenRequest
            ->setSandboxMode($GLOBALS['cfg']['payments']['sandbox'])
            ->setExternalPaymentId($this->order->getOrderNumber())
            ->setUserEmail($this->user->user_email)
            ->setUserName($this->user->username)
            ->setPurchase($this->order->getTotal(), 'USD')
            ->setCustomParameters([
                'subtotal' => $this->order->getSubtotal(),
                'shipping' => $this->order->shipping,
                'order_id' => $this->order['order_id'],
            ]);

        $xsollaClient = XsollaClient::factory([
            'merchant_id' => $GLOBALS['cfg']['payments']['xsolla']['merchant_id'],
            'api_key' => $GLOBALS['cfg']['payments']['xsolla']['api_key'],
        ]);

        // This will be used for XPayStationWidget options.
        return [
            'access_token' => $xsollaClient->createPaymentUITokenFromRequest($tokenRequest),
            'sandbox' => $GLOBALS['cfg']['payments']['sandbox'],
        ];
    }
}

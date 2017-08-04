<?php

namespace App\Libraries\Payments;

use App\Libraries\Commands\ApplySupporterTag;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;

class SupporterTagCommandBuilder
{
    private $order;
    private $minimumRequired = 0;
    private $changes = [];

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function addOrderItem(OrderItem $item)
    {
        \Log::debug('addOrderItem');
        $extraData = $item['extra_data'];
        $targetId = intval($extraData['target_id']);
        $duration = intval($extraData['duration']);
        $minimum = SupporterTag::getMinimumDonation($duration);

        $this->minimumRequired += $minimum;
        $this->addChange($targetId, $duration, $item['cost']);
    }

    public function isValid()
    {
        \Log::debug("total: {$this->order->getTotal()}, required: {$this->minimumRequired}");
        return $this->order->getTotal() >= $this->minimumRequired;
    }

    public function getCommands()
    {
        $commands = [];
        foreach ($this->changes as $change) {
            $params = [
                'donorId' => $this->order['user_id'],
                'targetId' => $change['targetId'],
                'duration' => $change['duration'],
                'amount' => $change['amount'],
            ];
            $commands[] = new ApplySupporterTag($this->order['transaction_id'], $params);
        }

        return $commands;
    }

    /**
     * Stages supporter tag changes.
     */
    private function addChange(int $targetId, int $duration, int $amount)
    {
        \Log::debug(__CLASS__."::addChange({$targetId}, ${duration}, {$amount})");
        $this->changes[] = [
            'targetId' => $targetId,
            'duration' => $duration,
            'amount' => $amount
        ];
    }
}

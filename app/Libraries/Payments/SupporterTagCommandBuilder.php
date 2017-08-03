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
        $this->addChange($targetId, $duration);
    }

    public function isValid()
    {
        \Log::debug("total: {$this->order->getTotal()}, required: {$this->minimumRequired}");
        return $this->order->getTotal() >= $this->minimumRequired;
    }

    public function getCommands()
    {
        $commands = [];
        foreach ($this->changes as $targetId => $duration) {
            $params = [
                'donorId' => $this->order['user_id'],
                'targetId' => $targetId,
                'duration' => $duration,
            ];
            $commands[] = new ApplySupporterTag($this->order['transaction_id'], $params);
        }

        return $commands;
    }

    /**
     * Stages supporter tag changes.
     *
     * @param int $userId id of the user to apply a supporter tag to.
     * @param int $duration duration of the supporter tag in months.
     */
    private function addChange(int $userId, int $duration)
    {
        \Log::debug(__CLASS__."::addChange({$userId}, ${duration})");
        if (isset($this->changes[$userId])) {
            $this->changes[$userId] += $duration;
        } else {
            $this->changes[$userId] = $duration;
        }
    }
}

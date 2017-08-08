<?php

namespace App\Libraries\Fulfillments;

use App\Libraries\Fulfillments\Subcommands\ApplySupporterTag;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;

class SupporterTagFulfillment extends OrderFulfiller
{
    private $minimumRequired = 0;
    private $commands = [];

    private function addOrderItem(OrderItem $item)
    {
        \Log::debug('addOrderItem');
        $extraData = $item['extra_data'];
        $targetId = (int) $extraData['target_id'];
        $duration = (int) $extraData['duration'];
        $minimum = SupporterTag::getMinimumDonation($duration);

        $this->minimumRequired += $minimum;

        $params = [
            'donorId' => $this->order['user_id'],
            'targetId' => $targetId,
            'duration' => $duration,
            'amount' => $item['cost'],
        ];
        $this->commands[] = new ApplySupporterTag("{$this->order['transaction_id']}-{$item['id']}", $params);
    }

    public function run($context)
    {
        $commands = $this->getCommands();

        if (!$this->isValid()) {
            throw new \Exception('not valid');
        }

        foreach ($commands as $command) {
            $command->run($context);
        }
    }

    public function revoke($context)
    {
        $commands = $this->getCommands();
        foreach ($commands as $command) {
            $command->revoke($context);
        }
    }

    public function isValid()
    {
        \Log::debug("total: {$this->order->getTotal()}, required: {$this->minimumRequired}");
        return $this->order->getTotal() >= $this->minimumRequired;
    }

    public function getCommands()
    {
        $items = $this->order->items()->customClass('supporter-tag')->get();
        \Log::debug($items);
        foreach ($items as $item) {
            $this->addOrderItem($item);
        }

        return $this->commands;
    }
}

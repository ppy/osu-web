<?php

namespace App\Libraries\Fulfillments;

use App\Libraries\Fulfillments\Subcommands\ApplySupporterTag;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\SupporterTag;
use App\Models\User;
use Mail;

class SupporterTagFulfillment extends OrderFulfiller
{
    private $minimumRequired = 0;
    private $commands;

    private $orderItems;

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

    public function afterRun($context)
    {
        $items = $this->getOrderItems();
        $donor = $this->order->user;
        $giftees = [];
        $donationTotal = $items->sum('cost');
        $length = 0;
        foreach ($items as $item) {
            $length += (int) $item['extra_data']['duration'];
            $targetId = $item['extra_data']['target_id'];
            $target = User::find($targetId);
            // TODO: warn is user doesn't exist, but don't explode.
            if ($donor->getKey() != $target->getKey()) {
                $giftees[$targetId] = $target;
            }
        }

        \Log::debug("send donation thanks to {$donor->user_email}");
        Mail::to($donor->user_email)
            ->queue(new \App\Mail\DonationThanks($donor, $length, $donationTotal));

        foreach ($giftees as $giftee) {
            \Log::debug("send gift thanks to {$giftee->user_email}");
            Mail::to($giftee->user_email)
                ->queue(new \App\Mail\SupporterGift($donor, $giftee, $length));
        }
    }

    public function isValid()
    {
        \Log::debug("total: {$this->order->getTotal()}, required: {$this->minimumRequired}");
        return $this->order->getTotal() >= $this->minimumRequired;
    }

    private function getOrderItems()
    {
        if (!isset($this->orderItems)) {
            $this->orderItems = $this->order->items()->customClass('supporter-tag')->get();
        }

        return $this->orderItems;
    }

    private function getCommands()
    {
        if (!isset($this->commands)) {
            $items = $this->getOrderItems();
            \Log::debug($items);
            $commands = [];
            foreach ($items as $item) {
                $commands[] = $this->createCommand($item);
            }

            $this->commands = $commands;
        }

        return $this->commands;
    }

    private function createCommand(OrderItem $item)
    {
        \Log::debug('createCommand');
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

        return new ApplySupporterTag("{$this->order['transaction_id']}-{$item['id']}", $params);
    }
}

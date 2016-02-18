<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Console\Commands;

use App\Models\Store;
use Illuminate\Console\Command;
use Slack;

class StoreCheckOrderTrackingStatus extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'store:tracking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks tracking status of all shipped (but not delivered) items.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $orders = Store\Order::where('status', '=', 'shipped')->where('tracking_code', '!=', '')->orderBy('updated_at')->get();
        $count = count($orders);

        if (!$count) {
            return;
        }

        $this->info("found $count orders.");

        Slack::send("Checking order tracking status ($count orders)...");

        $globalStatuses = [];

        $i = 0;
        foreach ($orders as $o) {
            ++$i;

            try {
                if (!strlen(trim($o->tracking_code)) || (strpos($o->tracking_code, 'EJ') !== 0 && strpos($o->tracking_code, 'RR') !== 0)) {
                    continue;
                }

                if (!$o->shipped_at) {
                    $o->shipped_at = time();
                    $o->save();
                }

                $orderStatuses = [];
                $retainedCodes = [];
                $deliveredCodes = [];
                $trackingCodes = explode(',', $o->tracking_code);

                //a single order may have multiple tracking numbers
                foreach ($trackingCodes as $code) {
                    $code = trim($code);

                    $response = file_get_contents("https://trackings.post.japanpost.jp/services/srv/search/direct?searchKind=S004&locale=en&reqCodeNo1=$code");

                    preg_match_all("/\<td rowspan=\"2\" class=\"w_150\"\>([^\<]*)\<\/td\>/", $response, $status);

                    if (!count($status[1])) {
                        if (!$o->last_tracking_state) {
                            $days_until_warning = 4;
                            if (time() - $o->shipped_at->timestamp > 3600 * 24 * $days_until_warning) {
                                Slack::send("WARNING: <https://store.ppy.sh/store/admin/orders/{$o->order_id}|Order #{$o->order_id}> has no tracking after {$days_until_warning} days!");
                            }
                        }
                        continue;
                    }

                    $thisStatus = end($status[1]);

                    switch ($thisStatus) {
                        case 'Final delivery':
                        case 'P.O.Box Delivery':
                            array_push($deliveredCodes, $code);
                            break;
                        case 'Retention':
                        case 'Absence. Attempted delivery.':
                            array_push($retainedCodes, $code);
                            break;
                    }

                    array_push($orderStatuses, $thisStatus);
                }

                $lastStatus = implode(' / ', $orderStatuses);
                $globalStatuses[$lastStatus][] = $o;

                if (strlen($lastStatus) === 0 || $lastStatus === $o->last_tracking_state) {
                    continue;
                } //no change in tracking state since our last check.

                $this->info("#$i: Order #{$o->order_id} (https://store.ppy.sh/store/invoice/{$o->order_id})\t{$o->address->country_code}\tshipped {$o->shipped_at}\t$lastStatus");

                foreach ($retainedCodes as $code) {
                    mail($o->user->user_email, 'IMPORTANT: Your osu!store order is pending delivery', "Hi {$o->user->username},

We have been tracking your order and noticed that it is currently in the state of \"{$thisStatus}\".

This means it has likely reached your local post office, but you weren't around to collect the package. Please check your letterbox for any notices of missed packages, and if there is no sign of such a notice please contact or visit your local post office and enquire using your tracking number ({$code}) to ensure you receive your order successfully. If no action is taken in 7 days, they are likely to return the package to us, so it is very important that you follow up on this.

You can check the current tracking status here: https://store.ppy.sh/store/invoice/{$o->order_id}.

If you have any questions, don't hesitate to reply to this email.

Regards,
The osu!store team", 'From: "osu!store team" <osustore@ppy.sh>');
                    Slack::send("<https://store.ppy.sh/store/invoice/{$o->order_id}|Order #{$o->order_id}> is being held at the destination post office. Contacting user ({$o->user->user_email}).");
                }

                if (count($deliveredCodes) === count($trackingCodes)) {
                    Slack::send("<https://store.ppy.sh/store/invoice/{$o->order_id}|Order #{$o->order_id}> has been delivered!");
                    $o->status = 'delivered';
                }

                if (!$o->last_tracking_state) {
                    //first status update should sent out an email to the user.
                    Slack::send("<https://store.ppy.sh/store/invoice/{$o->order_id}|Order #{$o->order_id}> is now being tracked with an initial state of \"$lastStatus\"");
                    mail($o->user->user_email, 'Your osu!store order is on its way!', "Hi {$o->user->username},

Thanks again for your osu!store order!

We have just shipped your order out from Japan! You can follow the progress of it at https://store.ppy.sh/store/invoice/{$o->order_id}.

If you have any questions, don't hesitate to reply to this email.

Regards,
The osu!store team", 'From: "osu!store team" <osustore@ppy.sh>');
                } else {
                    Slack::send("<https://store.ppy.sh/store/invoice/{$o->order_id}|Order #{$o->order_id}> has changed status from \"{$o->last_tracking_state}\" to \"$lastStatus\"");
                }

                $o->last_tracking_state = $lastStatus;
                $o->save();
            } catch (\Exception $e) {
                //slack could throw errors here if their servers are dead.
            }
        }

        $fields = [];
        foreach ($globalStatuses as $k => $v) {
            $orderstring = '';
            foreach ($v as $o) {
                $orderstring .= "<https://store.ppy.sh/store/invoice/{$o->order_id}|{$o->order_id}({$o->address->country_code})> ";
            }
            $fields[] = ['title' => $k, 'value' => $orderstring];
        }

        Slack::attach([
            'color' => 'good',
            'fields' => $fields,
        ])->send('Tracking Results are in:');
    }
}

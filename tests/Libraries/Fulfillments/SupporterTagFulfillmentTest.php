<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Fulfillments;

use App\Libraries\Fulfillments\FulfillmentException;
use App\Libraries\Fulfillments\SupporterTagFulfillment;
use App\Mail\DonationThanks;
use App\Mail\SupporterGift;
use App\Models\Event;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\User;
use App\Models\UserDonation;
use Carbon\Carbon;
use Mail;
use Tests\TestCase;

class SupporterTagFulfillmentTest extends TestCase
{
    private Order $order;
    private User $user;

    public function testDonateSupporterTagToSelf()
    {
        $donor = $this->user;
        $expectedExpiry = $donor->osu_subscriptionexpiry->copy()->addMonthsNoOverflow(1);
        $this->createDonationOrderItem($this->user, false, false);

        (new SupporterTagFulfillment($this->order))->run();

        $donor->refresh();
        $this->assertTrue($donor->osu_subscriber);
        $this->assertTrue($expectedExpiry->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(2, $donor->osu_featurevotes);
    }

    public function testDonateSupporterTagToOthers()
    {
        $today = Carbon::today();

        $donor = $this->user;
        $giftee = User::factory()->create([
            'osu_featurevotes' => 0,
            'osu_subscriptionexpiry' => $today->copy(),
            'user_sig' => '',
        ]);
        $expectedExpiry = $giftee->osu_subscriptionexpiry->copy()->addMonthsNoOverflow(1);

        $this->createDonationOrderItem($giftee, false, false);

        (new SupporterTagFulfillment($this->order))->run();

        $donor->refresh();
        $giftee->refresh();

        // giftee gets subscription, not donor.
        $this->assertFalse($donor->osu_subscriber);
        $this->assertTrue($giftee->osu_subscriber);

        // donor's expiry should not change.
        $this->assertTrue($expectedExpiry->equalTo($giftee->osu_subscriptionexpiry));
        $this->assertTrue($today->equalTo($donor->osu_subscriptionexpiry));

        // votes go to donor.
        $this->assertSame(2, $donor->osu_featurevotes);
        $this->assertSame(0, $giftee->osu_featurevotes);
    }

    /**
     * @dataProvider boolDataProvider
     */
    public function testMailDonateSupporterTagToOthers(bool $hidden)
    {
        Mail::fake();

        $giftee1 = User::factory()->create(['user_sig' => '']); // prevent factory from generating user_sig
        $giftee2 = User::factory()->create(['user_sig' => '']);

        // This also tests multiple gifts only send 1 mail/event each
        $this->createDonationOrderItem($giftee1, false, false, $hidden);
        $this->createDonationOrderItem($giftee1, false, false, $hidden);
        $this->createDonationOrderItem($giftee2, false, false, $hidden);

        $this->expectCountChange(fn () => Event::where('user_id', $giftee1->getKey())->count(), 1);
        $this->expectCountChange(fn () => Event::where('user_id', $giftee2->getKey())->count(), 1);
        $this->expectCountChange(fn () => Event::where('user_id', $this->user->getKey())->count(), $hidden ? 0 : 1);

        (new SupporterTagFulfillment($this->order))->run();

        Mail::assertQueued(SupporterGift::class, function ($mail) use ($giftee1, $giftee2) {
            $params = $this->invokeProperty($mail, 'params');

            if ($params['giftee']->is($giftee1)) {
                return $params['duration'] === 2;
            } elseif ($params['giftee']->is($giftee2)) {
                return $params['duration'] === 1;
            }
        });

        Mail::assertQueued(DonationThanks::class, function ($mail) {
            return $this->invokeProperty($mail, 'params')['isGift'] === true; // non-truthy check
        });

        Mail::assertQueued(SupporterGift::class, 2);
        Mail::assertQueued(DonationThanks::class, 1);
    }

    /**
     * @dataProvider boolDataProvider
     */
    public function testMailDonateSupporterTagToSelf(bool $hidden)
    {
        Mail::fake();

        $this->createDonationOrderItem($this->user, false, false, $hidden);
        $this->createDonationOrderItem($this->user, false, false, $hidden);

        $this->expectCountChange(fn () => Event::where('user_id', $this->user->getKey())->count(), $hidden ? 0 : 1);

        (new SupporterTagFulfillment($this->order))->run();

        Mail::assertQueued(DonationThanks::class, function ($mail) {
            $params = $this->invokeProperty($mail, 'params');

            return $params['duration'] === 2
                && $params['isGift'] === false; // non-truthy check
        });

        Mail::assertNotQueued(SupporterGift::class);
        Mail::assertQueued(DonationThanks::class, 1);
    }

    public function testPartiallyFulfilledOrder()
    {
        $donor = $this->user;
        $expectedExpiry = $donor->osu_subscriptionexpiry->copy()->addMonthsNoOverflow(1);

        // consider the first item as processed
        $this->createDonationOrderItem($this->user, false, true);
        $this->createDonationOrderItem($this->user, false, false);

        (new SupporterTagFulfillment($this->order))->run();

        $donor->refresh();
        // Should only apply one supporter tag.
        $this->assertTrue($donor->osu_subscriber);
        $this->assertTrue($expectedExpiry->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(2, $donor->osu_featurevotes);
    }

    public function testAlreadyFulfilledOrder()
    {
        $donor = $this->user;
        $expectedExpiry = $donor->osu_subscriptionexpiry->copy();

        $this->createDonationOrderItem($this->user, false, true);
        $this->createDonationOrderItem($this->user, false, true);

        (new SupporterTagFulfillment($this->order))->run();

        $donor->refresh();
        // Should not apply any supporter tags
        $this->assertFalse($donor->osu_subscriber);
        $this->assertTrue($expectedExpiry->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(0, $donor->osu_featurevotes);
    }

    public function testRevokeDonateSupporterTagToSelf()
    {
        $today = Carbon::today();

        $donor = $this->user;
        $donor->update([
            'osu_featurevotes' => 2,
            'osu_subscriber' => true,
            'osu_subscriptionexpiry' => $today->copy()->addMonthsNoOverflow(1),
        ]);

        // workaround date insanity during testing
        $expectedExpiry = $today->copy();
        $insane = $today->day > $donor->osu_subscriptionexpiry->endOfMonth()->day;
        if ($insane) {
            $expectedExpiry = $today->day($donor->osu_subscriptionexpiry->endOfMonth()->day);
        }

        $this->createDonationOrderItem($this->user, false, true);

        (new SupporterTagFulfillment($this->order))->revoke();

        $donor->refresh();

        $this->assertTrue($expectedExpiry->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(0, $donor->osu_featurevotes);
        $this->assertFalse($donor->osu_subscriber);
    }

    public function testPartiallyRevokedOrder()
    {
        $today = Carbon::today();

        $donor = $this->user;
        $donor->update([
            'osu_featurevotes' => 4,
            'osu_subscriber' => true,
            'osu_subscriptionexpiry' => $today->copy()->addMonthsNoOverflow(2),
        ]);

        $oldExpiry = $donor->osu_subscriptionexpiry;

        $this->createDonationOrderItem($this->user, true, true);
        $this->createDonationOrderItem($this->user, true, false);

        (new SupporterTagFulfillment($this->order))->revoke();

        $donor->refresh();

        // there should be 1 month left.
        $this->assertTrue($oldExpiry->subMonthsNoOverflow(1)->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(2, $donor->osu_featurevotes);
        $this->assertTrue($donor->osu_subscriber);
    }

    public function testAlreadyRevokedOrder()
    {
        $today = Carbon::today();

        $donor = $this->user;
        $donor->update([
            'osu_featurevotes' => 4,
            'osu_subscriber' => true,
            'osu_subscriptionexpiry' => $today->copy()->addMonthsNoOverflow(2),
        ]);

        $this->createDonationOrderItem($this->user, true, true);
        $this->createDonationOrderItem($this->user, true, true);

        (new SupporterTagFulfillment($this->order))->revoke();

        $donor->refresh();

        $this->assertTrue($today->copy()->addMonthsNoOverflow(2)->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(4, $donor->osu_featurevotes);
        $this->assertTrue($donor->osu_subscriber);
    }

    public function testDonateSupporterTagAfterExpired()
    {
        $today = Carbon::today();

        $donor = $this->user;
        $donor->update([
            'osu_subscriber' => true,
            'osu_subscriptionexpiry' => $today->copy()->subYears(1),
        ]);

        $expectedExpiry = $today->copy()->addMonthsNoOverflow(1);
        $this->createDonationOrderItem($this->user, false, false);

        (new SupporterTagFulfillment($this->order))->run();

        $donor->refresh();
        $this->assertTrue($donor->osu_subscriber);
        $this->assertTrue($expectedExpiry->equalTo($donor->osu_subscriptionexpiry));
        $this->assertSame(2, $donor->osu_featurevotes);
    }

    // Sanity test against weirdness
    public function testInsufficientAmountSingle()
    {
        $this->createOrderItem($this->user, 1, 3);

        $this->expectException(FulfillmentException::class);
        $this->expectCountChange(fn () => UserDonation::count(), 0);

        (new SupporterTagFulfillment($this->order))->run();
    }

    public function testInsufficientAmountMultiple()
    {
        $this->createOrderItem($this->user, 1, 3);
        $this->createOrderItem($this->user, 1, 4);

        $this->expectException(FulfillmentException::class);
        $this->expectCountChange(fn () => UserDonation::count(), 0);

        (new SupporterTagFulfillment($this->order))->run();
    }

    public function boolDataProvider()
    {
        return [
            [true],
            [false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'osu_featurevotes' => 0,
            'osu_subscriptionexpiry' => Carbon::today(),
        ]);

        $this->order = factory(Order::class)->states('paid')->create([
            'user_id' => $this->user->user_id,
        ]);
    }

    private function createDonationOrderItem(User $giftee, bool $cancelled, bool $ranPreviously, bool $hidden = false)
    {
        $orderItem = $this->createOrderItem($giftee, 1, 4, $hidden);

        if ($cancelled) {
            $this->createUserDonation($orderItem, $giftee, false);
            if ($ranPreviously) {
                $this->createUserDonation($orderItem, $giftee, true);
            }
        } else {
            if ($ranPreviously) {
                $this->createUserDonation($orderItem, $giftee, false);
            }
        }
    }

    private function createUserDonation(OrderItem $orderItem, User $giftee, bool $cancelled)
    {
        $donor = $orderItem->order->user;

        return factory(UserDonation::class)->create([
            'transaction_id' => "{$orderItem->order->transaction_id}-{$orderItem->id}".($cancelled ? '-cancel' : ''),
            'user_id' => $donor->user_id,
            'target_user_id' => $giftee->user_id,
        ]);
    }

    private function createOrderItem(User $user, int $duration, int $amount, bool $hidden = false)
    {
        return factory(OrderItem::class)->states('supporter_tag')->create([
            'order_id' => $this->order->order_id,
            'cost' => $amount,
            'extra_data' => [
                'duration' => $duration,
                'hidden' => $hidden,
                'target_id' => $user->user_id,
                'username' => $user->username,
            ],
        ]);
    }
}

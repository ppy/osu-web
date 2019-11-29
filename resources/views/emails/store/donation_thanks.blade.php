{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
{!! trans('common.email.hello', ['user' => $donor->username]) !!}

{!! trans('fulfillments.mail.donation_thanks.content.support._', [
    'support' => trans('fulfillments.mail.donation_thanks.content.support.'.($continued ? 'repeat' : 'first')),
]) !!}
{!! trans('fulfillments.mail.donation_thanks.content.keep_free') !!}
{!! trans('fulfillments.mail.donation_thanks.content.benefit.'.($isGift ? 'gift' : 'self'), [
    'duration' => $duration,
]) !!}
{!! trans('fulfillments.mail.donation_thanks.content.benefit_more') !!}

{!! trans('fulfillments.mail.donation_thanks.content.keep_running', [
    'minutes' => trans_choice('common.count.minutes', $minutes),
]) !!}

{!! trans('fulfillments.mail.donation_thanks.content.feedback') !!}

{!! trans('common.email.closing') !!}
Dean Herbert (peppy)

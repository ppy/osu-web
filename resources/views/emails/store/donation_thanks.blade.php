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
{!! trans('mail.common.hello', ['user' => $donor->username]) !!}

{!! trans('mail.donation_thanks.support._', [
    'support' => trans('mail.donation_thanks.support.'.($continued ? 'repeat' : 'first')),
]) !!}
{!! trans('mail.donation_thanks.keep_free') !!}
{!! trans('mail.donation_thanks.benefit.'.($isGift ? 'gift' : 'self'), [
    'duration' => $duration,
]) !!}
{!! trans('mail.donation_thanks.benefit_more') !!}

{!! trans('mail.donation_thanks.keep_running', [
    'minutes' => trans_choice('common.count.minutes', $minutes),
]) !!}

{!! trans('mail.donation_thanks.feedback') !!}

{!! trans('mail.common.closing') !!}
Dean Herbert (peppy)

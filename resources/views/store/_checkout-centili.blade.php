{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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

<div class="store-payment-method">
    <a href="https://api.centili.com/payment/widget?apikey={{ config('payments.centili.api_key') }}"
       class="store-payment-method__cell store-payment-button"
    >
        <div class="store-payment-button__content">
            Centili
        </div>
    </a>

    <div class="store-payment-method__cell">
        <div class="store-text store-text--header">Pay with ¥COINS</div>

        <div class="store-text store-text--block">You can complete your transactions using ¥COINS</div>

        <div class="store-text store-text--block store-text--emphasis">Optionssss.</div>
    </div>
</div>

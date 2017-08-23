<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Libraries\Fulfillments;

use App\Exceptions\NotImplementedException;

/**
 * Placeholder class for handling non-custom class order item fulfillment.
 */
class GenericFulfillment extends OrderFulfiller
{
    public function __construct($order)
    {
        throw new NotImplementedException();
    }

    public function run()
    {
        throw new NotImplementedException();
    }

    public function revoke()
    {
        throw new NotImplementedException();
    }

    public function validationErrorsTranslationPrefix()
    {
        throw new NotImplementedException();
    }
}

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

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller as BaseController;
use App\Libraries\ControllerExceptionHandler;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        if (method_exists($this, 'exceptionHandler')) {
            // Have to resolve this before setting middleware or else
            // default exception handler will fire first and we won't be able to tell it
            // to shut up.
            $this->setShouldntReport(true);

            $this->middleware(function ($request, $next) {
                $response = $next($request);
                if ($response->exception !== null) {
                    return $this->exceptionHandler($response->exception) ?? $response;
                }

                return $response;
            });
        }

        return parent::__construct();
    }

    protected function setShouldntReport(bool $flag)
    {
        $handler = resolve(ControllerExceptionHandler::class);
        $handler->shouldntReport = $flag;
    }
}

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

namespace App\Libraries;

use Illuminate\Database\ConnectionInterface;

class TransactionStateManager
{
    private $states = [];

    public function begin(ConnectionInterface $connection)
    {
        $name = $connection->getName();
        \Log::info("begin transaction {$name}");

        $this->push($name, new TransactionState($connection));
    }

    public function commit(ConnectionInterface $connection)
    {
        $name = $connection->getName();
        \Log::info("committing {$name}");
    }

    public function rollback(ConnectionInterface $connection)
    {
        $name = $connection->getName();
        \Log::info("rolling back {$name}");
    }

    private function push(string $name, $item)
    {
        if (!isset($this->states[$name])) {
            $this->states[$name] = $item;
        }

        \Log::info("pushed {$name}");
    }
}

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

    public function __construct()
    {
        // for handling cases outside of transactions.
        $this->states[''] = new TransactionState(null);
    }

    public function isCompleted()
    {
        return array_reduce(array_values($this->states), function ($completed, $state) {
            return $completed && $state->isCompleted();
        }, true);
    }

    public function begin(ConnectionInterface $connection)
    {
        $name = $connection->getName();

        $this->push($name, new TransactionState($connection));
    }

    public function commit()
    {
        if ($this->isCompleted()) {
            foreach ($this->states as $name => $state) {
                $state->commit();
            }
        }
    }

    public function current(string $name)
    {
        return $this->states[$name] ?? $this->states[''];
    }

    public function rollback()
    {
        if ($this->isCompleted()) {
            foreach ($this->states as $name => $state) {
                $state->rollback();
            }
        }
    }

    private function push(string $name, $item)
    {
        if (!isset($this->states[$name])) {
            $this->states[$name] = $item;
        }
    }
}

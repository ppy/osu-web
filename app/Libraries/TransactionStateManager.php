<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

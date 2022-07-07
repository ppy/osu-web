<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Illuminate\Database\ConnectionInterface;

class TransactionStateManager
{
    private array $states;

    public function __construct()
    {
        $this->resetStates();
    }

    public function isCompleted()
    {
        foreach ($this->states as $_name => $state) {
            if (!$state->isCompleted()) {
                return false;
            }
        }

        return true;
    }

    public function begin(ConnectionInterface $connection)
    {
        $name = $connection->getName();

        $this->push($name, new TransactionState($connection));
    }

    public function commit()
    {
        if ($this->isCompleted()) {
            foreach ($this->states as $_name => $state) {
                $state->commit();
            }
            $this->resetStates();
        }
    }

    public function current(string $name)
    {
        return $this->states[$name] ?? $this->states[''];
    }

    public function rollback()
    {
        if ($this->isCompleted()) {
            foreach ($this->states as $_name => $state) {
                $state->rollback();
            }
            $this->resetStates();
        }
    }

    private function push(string $name, $item)
    {
        $this->states[$name] ??= $item;
    }

    private function resetStates(): void
    {
        // for handling cases outside of transactions.
        $this->states = ['' => new TransactionState(null)];
    }
}

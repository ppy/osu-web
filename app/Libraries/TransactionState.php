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

class TransactionState
{
    private $connection;

    private $commits = [];
    private $rollbacks = [];

    public function __construct(ConnectionInterface $connection = null)
    {
        $this->connection = $connection;
    }

    public function isReal()
    {
        return $this->connection !== null;
    }

    public function isCompleted()
    {
        // TODO: throw if null connection instead since it should only run with actual transactions?
        return $this->connection ? $this->connection->transactionLevel() === 0 : true;
    }

    public function addCommittable($committable)
    {
        $this->commits[] = $committable;
    }

    public function addRollbackable($rollbackable)
    {
        $this->rollbacks[] = $rollbackable;
    }

    public function commit()
    {
        foreach ($this->uniqueCommits() as $commit) {
            $commit->afterCommit();
        }

        $this->clear();
    }

    public function rollback()
    {
        foreach ($this->uniqueRollbacks() as $rollback) {
            $rollback->afterRollback();
        }

        $this->clear();
    }

    public function clear()
    {
        $this->commits = [];
        $this->rollbacks = [];
    }

    private function uniqueCommits()
    {
        return static::uniqueModels($this->commits);
    }

    private function uniqueRollbacks()
    {
        return static::uniqueModels($this->rollbacks);
    }

    private static function uniqueModels(array $models)
    {
        $array = [];

        foreach ($models as $model) {
            if (static::uniqueIn($model, $array)) {
                $array[] = $model;
            }
        }

        return $array;
    }

    private static function uniqueIn($model, $array)
    {
        // use model's uniqueness test if model is persisted and has a primary key.
        // otherwise use a reference comparison.
        if ($model->exists && $model->getKey() !== null) {
            foreach ($array as $obj) {
                if ($model->is($obj)) {
                    return false;
                }
            }
        } else {
            foreach ($array as $obj) {
                if ($model === $obj) {
                    return false;
                }
            }
        }

        return true;
    }
}

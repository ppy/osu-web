<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

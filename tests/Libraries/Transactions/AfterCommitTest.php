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

namespace Tests;

use App\Libraries\Transactions\AfterCommit;
use App\Models\Model;
use Config;
use DB;
use Illuminate\Support\Facades\Schema;
use TestCase;

class AfterCommitTest extends TestCase
{
    protected $connectionsToTransact = [];

    public function setUp()
    {
        parent::setUp();

        // create a dummy table
        Schema::create('test_after_commit', function ($table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function tearDown()
    {
        Schema::drop('test_after_commit');

        parent::tearDown();
    }

    public function testModelAfterCommitSupportDoesEnlist()
    {
        $model = $this->afterCommittable();
        $model->save();
        $this->assertSame(1, $model->afterCommitCount);
        $this->assertSame(1, $model->enlisted);
    }

    public function testModelWithoutAfterCommitSupportDoesNotEnlist()
    {
        $model = $this->notAfterCommittable();
        $model->save();
        $this->assertSame(0, $model->afterCommitCount);
        $this->assertSame(1, $model->enlisted);
    }

    public function testModelAfterCommitTransaction()
    {
        // count should increase after transaction completes but not before.
        $model = $this->afterCommittable();
        DB::transaction(function () use ($model) {
            $model->save();

            $this->assertSame(1, count($this->getPendingCommits('mysql')));
            $this->assertSame(0, $model->afterCommitCount);
        });

        $this->assertSame(0, count($this->getPendingCommits('mysql')));
        $this->assertSame(1, $model->afterCommitCount);
    }

    public function testModelAfterCommitTransactionUnrelatedConnection()
    {
        // count should increase after save.
        $model = $this->afterCommittable();
        DB::connection('mysql-store')->transaction(function () use ($model) {
            $model->save();

            $this->assertSame(1, $model->afterCommitCount);
        });

        $this->assertSame(1, $model->afterCommitCount);
    }

    private function getPendingCommits(string $connection)
    {
        $state = $this->getTransactionState('mysql');

        return $this->invokeProperty($state, 'commits');
    }

    private function getTransactionState(string $connection)
    {
        return resolve('transaction')->current($connection);
    }

    //
    // Test double helpers.
    //

    private function notAfterCommittable()
    {
        return new class extends Model {
            public $afterCommitCount = 0;
            public $enlisted = 0;

            protected $connection = 'mysql';
            protected $table = 'test_after_commit';

            protected function enlistCallbacks()
            {
                $this->enlisted++;
                parent::enlistCallbacks();
            }
        };
    }

    private function afterCommittable()
    {
        return new class extends Model implements AfterCommit {
            public $afterCommitCount = 0;
            public $enlisted = 0;

            protected $connection = 'mysql';
            protected $table = 'test_after_commit';

            public function afterCommit()
            {
                $this->afterCommitCount++;
            }

            protected function enlistCallbacks()
            {
                $this->enlisted++;
                parent::enlistCallbacks();
            }
        };
    }
}

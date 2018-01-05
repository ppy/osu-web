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
use Exception;
use Illuminate\Support\Facades\Schema;
use TestCase;

class AfterCommitTest extends TestCase
{
    protected $connectionsToTransact = [];

    private $exceptionMessage = 'it should not run afterCommit';

    public function setUp()
    {
        parent::setUp();

        // not ideal to create the table between every test
        // but Laravel's resolvers do not work in the
        // setUpBeforeClass/tearDownAfterClass methods.

        // force cleanup
        if (Schema::hasTable('test_after_commit')) {
            Schema::drop('test_after_commit');
        }

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
    }

    public function testModelWithoutAfterCommitSupportDoesNotEnlist()
    {
        $model = $this->notAfterCommittable();
        $model->save();

        $this->assertSame(0, $model->afterCommitCount);
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

            $this->assertNull($this->getPendingCommits('mysql'));
            $this->assertNull($this->getPendingCommits('mysql-store'));
            $this->assertSame(1, $model->afterCommitCount);
        });

        $this->assertSame(1, $model->afterCommitCount);
    }

    public function testMultipleSaveInTransaction()
    {
        $model = $this->afterCommittable();

        DB::transaction(function () use ($model) {
            $model->save();
            $model->save();

            $this->assertSame(0, $model->afterCommitCount);
            $this->assertSame(2, count($this->getPendingCommits('mysql')));
            $this->assertSame(1, count($this->getPendingUniqueCommits('mysql')));
        });

        $this->assertSame(0, count($this->getPendingCommits('mysql')));
        $this->assertSame(1, $model->afterCommitCount);
    }

    public function testNestedTransactions()
    {
        $model = $this->afterCommittable();

        DB::transaction(function () use ($model) {
            $model->save();

            DB::transaction(function () use ($model) {
                $model->save();
            });

            $this->assertSame(0, $model->afterCommitCount);
            $this->assertSame(2, count($this->getPendingCommits('mysql')));
            $this->assertSame(1, count($this->getPendingUniqueCommits('mysql')));
        });

        $this->assertSame(0, count($this->getPendingCommits('mysql')));
        $this->assertSame(1, $model->afterCommitCount);
    }

    public function testExceptionThrown()
    {
        $model = $this->afterCommittable();

        try {
            DB::transaction(function () use ($model) {
                $model->save();

                throw new Exception($this->exceptionMessage);
            });
        } catch (Exception $e) {
            $this->assertSame($this->exceptionMessage, $e->getMessage());
        }

        $this->assertSame(0, count($this->getPendingCommits('mysql')));
        $this->assertSame(0, $model->afterCommitCount);
    }

    public function testExceptionThrownAfterAnotherTransaction()
    {
        $model = $this->afterCommittable();

        try {
            DB::transaction(function () use ($model) {
                $model->save();

                DB::transaction(function () use ($model) {
                    $model->save();
                });

                throw new Exception($this->exceptionMessage);
            });
        } catch (Exception $e) {
            $this->assertSame($this->exceptionMessage, $e->getMessage());
        }


        $this->assertSame(0, count($this->getPendingCommits('mysql')));
        $this->assertSame(0, $model->afterCommitCount);
    }

    public function testExceptionThrownInOtherConnection()
    {
        $model = $this->afterCommittable();

        try {
            // After commit only runs if all transactions in scope complete.
            DB::connection('mysql-store')->transaction(function () use ($model) {
                DB::transaction(function () use ($model) {
                    $model->save();
                });

                throw new Exception($this->exceptionMessage);
            });
        } catch (Exception $e) {
            $this->assertSame($this->exceptionMessage, $e->getMessage());
        }

        $this->assertSame(0, $model->afterCommitCount);
    }

    public function testRollbackExplictlyCalled()
    {
        $model = $this->afterCommittable();

        // Explictly rolling back single transaction level should still allow
        // after commit to run at the end.
        // Same behaviour as Rails without enlisting a new transaction.
        DB::transaction(function () use ($model) {
            $model->save();

            $this->assertSame(0, $model->afterCommitCount);
            DB::transaction(function () use ($model) {
                DB::rollback();
            });
        });

        $this->assertSame(1, $model->afterCommitCount);
    }

    private function getPendingCommits(string $connection)
    {
        $state = $this->getTransactionState('mysql');

        return $state ? $this->invokeProperty($state, 'commits') : null;
    }

    private function getPendingUniqueCommits(string $connection)
    {
        $state = $this->getTransactionState('mysql');

        return $state ? $this->invokeMethod($state, 'uniqueCommits') : null;
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

            protected $connection = 'mysql';
            protected $table = 'test_after_commit';
        };
    }

    private function afterCommittable()
    {
        return new class extends Model implements AfterCommit {
            public $afterCommitCount = 0;

            protected $connection = 'mysql';
            protected $table = 'test_after_commit';

            public function afterCommit()
            {
                $this->afterCommitCount++;
            }
        };
    }
}

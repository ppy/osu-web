<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Transactions;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\Transactions\AfterCommit;
use App\Libraries\Transactions\AfterRollback;
use App\Libraries\TransactionStateManager;
use App\Models\Model;
use DB;
use Exception;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AfterCommitTest extends TestCase
{
    protected $connectionsToTransact = [];

    private $exceptionMessage = 'it should not run afterCommit';

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

            $this->assertFalse($this->getTransactionState('mysql')->isReal());
            $this->assertCount(0, $this->getPendingCommits(''));
            $this->assertCount(0, $this->getPendingCommits('mysql-store'));
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
            DB::transaction(function () {
                DB::rollBack(); // this breaks the tests at the end when running on Travis
            });
        });

        $this->assertSame(1, $model->afterCommitCount);
    }

    public function testSaveOrExplode()
    {
        $model = $this->afterCommittable();
        $model->result = false;
        $thrown = false;

        try {
            DB::transaction(function () use ($model) {
                $model->saveOrExplode();
            });
        } catch (ModelNotSavedException $e) {
            $thrown = true;
        }

        $this->assertTrue($thrown);
        $this->assertSame(0, count($this->getPendingCommits('mysql')));
        $this->assertSame(0, $model->afterCommitCount);
        $this->assertSame(1, $model->afterRollbackCount);
    }

    protected function setUp(): void
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

    protected function tearDown(): void
    {
        Schema::drop('test_after_commit');

        parent::tearDown();
    }

    private function getPendingCommits(string $connection)
    {
        $state = $this->getTransactionState($connection);

        return $state ? $this->invokeProperty($state, 'commits') : null;
    }

    private function getPendingUniqueCommits(string $connection)
    {
        $state = $this->getTransactionState($connection);

        return $state ? $this->invokeMethod($state, 'uniqueCommits') : null;
    }

    private function getTransactionState(string $connection)
    {
        return resolve(TransactionStateManager::class)->current($connection);
    }

    /*
       Test double helpers.
    */

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
        return new class extends Model implements AfterCommit, AfterRollback {
            public $afterCommitCount = 0;
            public $afterRollbackCount = 0;
            public $result = true;

            protected $connection = 'mysql';
            protected $table = 'test_after_commit';

            public function afterCommit()
            {
                $this->afterCommitCount++;
            }

            public function afterRollback()
            {
                $this->afterRollbackCount++;
            }

            public function save(array $options = [])
            {
                return parent::save($options) && $this->result;
            }
        };
    }
}

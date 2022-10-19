<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\MorphMap;
use App\Libraries\Transactions\AfterCommit;
use App\Libraries\Transactions\AfterRollback;
use App\Libraries\TransactionStateManager;
use App\Scopes\MacroableModelScope;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\ClassMorphViolationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $guarded = [];
    protected $macros;
    protected $primaryKeys;

    public static function booted()
    {
        static::addGlobalScope(new MacroableModelScope());
    }

    public function getForeignKey()
    {
        if ($this->primaryKey === null || $this->primaryKey === 'id') {
            return parent::getForeignKey();
        }

        return $this->primaryKey;
    }

    public function getKey()
    {
        return $this->getRawAttribute($this->primaryKey);
    }

    public function getMacros()
    {
        static $baseMacros = [
            'getWithHasMore',
            'last',
            'realCount',
        ];

        return array_merge($this->macros ?? [], $baseMacros);
    }

    public function getMorphClass()
    {
        $className = static::class;

        $ret = MorphMap::getType($className);

        if ($ret !== null) {
            return $ret;
        }

        throw new ClassMorphViolationException($this);
    }

    public function getRawAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Locks the current model for update with `select for update`.
     *
     * @return $this
     */
    public function lockSelf()
    {
        return $this->lockForUpdate()->find($this->getKey());
    }

    public function macroGetWithHasMore()
    {
        return function ($query) {
            $limit = $query->getQuery()->limit;
            if ($limit === null) {
                throw new Exception('"getWithHasMore" was called on query without "limit" specified');
            }
            $moreLimit = $limit + 1;
            $result = $query->limit($moreLimit)->get();

            $hasMore = $result->count() === $moreLimit;

            if ($hasMore) {
                $result->pop();
            }

            return [$result, $hasMore];
        };
    }

    public function macroLast()
    {
        return function ($baseQuery, $column = null) {
            $query = clone $baseQuery;

            return $query->orderBy($column ?? $this->getKeyName(), 'DESC')->first();
        };
    }

    public function macroRealCount()
    {
        return function ($baseQuery) {
            $query = clone $baseQuery;
            $query->unorder();
            $query->getQuery()->offset = null;
            $query->limit(null);

            return min($query->count(), config('osu.pagination.max_count'));
        };
    }

    public function refresh()
    {
        if (method_exists($this, 'resetMemoized')) {
            $this->resetMemoized();
        }

        return parent::refresh();
    }

    public function scopeReorderBy($query, $field, $order)
    {
        return $query->unorder()->orderBy($field, $order);
    }

    public function scopeOrderByField($query, $field, $ids)
    {
        $size = count($ids);

        if ($size === 0) {
            return;
        }

        $bind = implode(',', array_fill(0, $size, '?'));
        $string = "FIELD({$field}, {$bind})";
        $values = array_map('strval', $ids);

        $query->orderByRaw($string, $values);
    }

    public function scopeNone($query)
    {
        $query->whereRaw('false');
    }

    public function scopeUnorder($query)
    {
        $query->getQuery()->orders = null;

        return $query;
    }

    public function scopeWithPresent($query, $column)
    {
        $query->whereNotNull($column)->where($column, '<>', '');
    }

    public function delete()
    {
        return $this->runAfterCommitWrapper(function () {
            return parent::delete();
        });
    }

    public function save(array $options = [])
    {
        return $this->runAfterCommitWrapper(function () use ($options) {
            return parent::save($options);
        });
    }

    public function saveOrExplode($options = [])
    {
        return $this->getConnection()->transaction(function () use ($options) {
            $result = $this->save($options);

            if ($result === false) {
                $message = method_exists($this, 'validationErrors') ?
                    $this->validationErrors()->toSentence() :
                    'failed saving model';

                throw new ModelNotSavedException($message);
            }

            return $result;
        });
    }

    public function dbName()
    {
        $connection = $this->connection ?? config('database.default');

        return config("database.connections.{$connection}.database");
    }

    public function tableName(bool $includeDbPrefix = false)
    {
        return ($includeDbPrefix ? $this->dbName().'.' : '').$this->getTable();
    }

    /**
     * Fast Time Attribute Getter (kind of)
     *
     * This is only usable for models with default dateFormat (`Y-m-d H:i:s`).
     */
    protected function getTimeFast(string $key): ?Carbon
    {
        $value = $this->getRawAttribute($key);

        return $value === null
            ? null
            : Carbon::createFromFormat('Y-m-d H:i:s', $value);
    }

    /**
     * Fast Time Attribute to Json Transformer
     *
     * Key must be suffixed with `_json`.
     * This is only usable for models with default dateFormat (`Y-m-d H:i:s`).
     */
    protected function getJsonTimeFast(string $key): ?string
    {
        $value = $this->getRawAttribute(substr($key, 0, -5));

        if ($value === null) {
            return null;
        }

        // From: "2020-10-10 10:10:10"
        // To: "2020-10-10T10:10:10Z"
        $value[10] = 'T';

        return "{$value}Z";
    }

    // Allows save/update/delete to work with composite primary keys.
    // Note this doesn't fix 'find' method and a bunch of other laravel things
    // which rely on getKeyName and getKey (and they themselves are broken as well).
    protected function setKeysForSaveQuery($query)
    {
        if (isset($this->primaryKeys)) {
            foreach ($this->primaryKeys as $key) {
                $query->where([$key => $this->original[$key] ?? null]);
            }

            return $query;
        }

        return parent::setKeysForSaveQuery($query);
    }

    // same deal with setKeysForSaveQuery but for select query
    protected function setKeysForSelectQuery($query)
    {
        return $this->setKeysForSaveQuery($query);
    }

    private function enlistCallbacks($model, $connection)
    {
        $transaction = resolve(TransactionStateManager::class)->current($connection);
        if ($model instanceof AfterCommit) {
            $transaction->addCommittable($model);
        }

        if ($model instanceof AfterRollback) {
            $transaction->addRollbackable($model);
        }

        return $transaction;
    }

    private function runAfterCommitWrapper(callable $fn)
    {
        $transaction = $this->enlistCallbacks($this, $this->connection);

        $result = $fn();

        if ($this instanceof AfterCommit && $transaction->isReal() === false) {
            $transaction->commit();
        }

        return $result;
    }
}

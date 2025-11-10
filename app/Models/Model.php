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
use App\Traits\Validatable;
use Exception;
use Illuminate\Database\ClassMorphViolationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use HasFactory, Traits\FasterAttributes, Traits\IncrementInstance, Validatable;

    const MAX_FIELD_LENGTHS = [];
    const int PER_PAGE = 50;

    protected $connection = 'mysql';
    protected $guarded = [];
    protected array $macros = [];
    protected $perPage = self::PER_PAGE;
    protected $primaryKeys;

    public static function booted()
    {
        static::addGlobalScope(new MacroableModelScope());
    }

    protected static function searchQueryAndParams(array $params)
    {
        $limit = \Number::clamp(get_int($params['limit'] ?? null) ?? static::PER_PAGE, 5, 50);
        $page = max(get_int($params['page'] ?? null), 1);

        $offset = max_offset($page, $limit);
        $page = 1 + $offset / $limit;

        $query = static::limit($limit)->offset($offset);

        return [$query, compact('limit', 'page')];
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

    public function getMacros(): array
    {
        return [
            ...$this->macros,
            'getWithHasMore',
            'last',
            'realCount',
        ];
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

    /**
     * Locks the current model for update with `select for update`.
     *
     * @return $this
     */
    public function lockSelf()
    {
        return $this->lockForUpdate()->find($this->getKey());
    }

    public function macroGetWithHasMore($query)
    {
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
    }

    public function macroLast($baseQuery, $column = null)
    {
        $query = clone $baseQuery;

        return $query->orderBy($column ?? $this->getKeyName(), 'DESC')->first();
    }

    public function macroRealCount($baseQuery)
    {
        $query = clone $baseQuery;
        $query->unorder();
        $query->getQuery()->offset = null;
        $query->limit(null);

        return min($query->count(), $GLOBALS['cfg']['osu']['pagination']['max_count']);
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

    /**
     * Just like decrement but only works on saved instance instead of falling back to entire model
     */
    public function decrementInstance()
    {
        if (!$this->exists) {
            return false;
        }

        return $this->decrement(...func_get_args());
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
                $errors = $this->validationErrors();
                $message = $errors->isEmpty() ? 'failed saving model' : $errors->toSentence();

                throw new ModelNotSavedException($message);
            }

            return $result;
        });
    }

    public function dbName()
    {
        $connection = $this->connection ?? $GLOBALS['cfg']['database']['default'];

        return $GLOBALS['cfg']['database']['connections'][$connection]['database'];
    }

    public function tableName(bool $includeDbPrefix = false)
    {
        return ($includeDbPrefix ? $this->dbName().'.' : '').$this->getTable();
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

    protected function validateDbFieldLength(int $limit, string $dbField, ?string $checkField = null): void
    {
        if ($this->isDirty($dbField)) {
            $this->validateFieldLength($limit, $dbField, $checkField);
        }
    }

    protected function validateDbFieldLengths(): void
    {
        foreach (static::MAX_FIELD_LENGTHS as $field => $limit) {
            $this->validateDbFieldLength($limit, $field, $field);
        }
    }

    protected function validationErrorsTranslationPrefix(): string
    {
        return '';
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

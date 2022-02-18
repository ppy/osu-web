<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Exceptions\ModelNotSavedException;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Factory extends BaseFactory
{
    private bool $requireSaved = true;

    /**
     * Return the created model even if it fails to save.
     *
     * @return $this
     */
    public function allowUnsaved(): static
    {
        $this->requireSaved = false;

        return $this;
    }

    protected function callAfterCreating(Collection $instances, ?Model $parent = null): void
    {
        if ($this->requireSaved) {
            $instances->each(function ($model) {
                if (!$model->exists) {
                    throw new ModelNotSavedException(
                        method_exists($model, 'validationErrors')
                            ? $model->validationErrors()->toSentence()
                            : 'Failed to save model',
                    );
                }
            });
        }

        parent::callAfterCreating($instances, $parent);
    }

    protected function newInstance(array $arguments = []): static
    {
        $factory = parent::newInstance($arguments);
        $factory->requireSaved = $this->requireSaved;

        return $factory;
    }

    // TODO: remove following line after removing legacy-factories
    // fooling legacy-factories' "isLegacyFactory" check: class Hello extends Factory
}

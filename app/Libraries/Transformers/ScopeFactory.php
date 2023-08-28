<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Transformers;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\ScopeFactory as FractalScopeFactory;

class ScopeFactory extends FractalScopeFactory
{
    public function createScopeFor(Manager $manager, ResourceInterface $resource, $scopeIdentifier = null): Scope
    {
        return new Scope($manager, $resource, $scopeIdentifier);
    }
}

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Transformers;

use League\Fractal;
use League\Fractal\Resource\ResourceInterface;

class ScopeFactory extends Fractal\ScopeFactory
{
    /**
     * @param Manager $manager
     * @param ResourceInterface $resource
     * @param string|null $scopeIdentifier
     * @return Scope
     */
    public function createScopeFor(Fractal\Manager $manager, ResourceInterface $resource, $scopeIdentifier = null)
    {
        return new Scope($manager, $resource, $scopeIdentifier);
    }
}

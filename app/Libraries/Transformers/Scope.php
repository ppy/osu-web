<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Transformers;

use App\Transformers\TransformerAbstract;
use League\Fractal;

class Scope extends Fractal\Scope
{
    /**
     * {@inheritdoc}
     */
    protected function fireTransformer($transformer, $data)
    {
        if ($transformer instanceof TransformerAbstract) {
            $permission = $transformer->getRequiredPermission();
            if ($permission !== null && !priv_check($permission, $data)->can()) {
                return [[], []];
            }
        }

        return parent::fireTransformer($transformer, $data);
    }
}

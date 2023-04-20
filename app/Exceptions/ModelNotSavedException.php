<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

// This is used for model's saveOrExplode
class ModelNotSavedException extends SilencedException
{
    public static function makeResponse(?Exception $e, array $modelFields): Response
    {
        $json = [
            'error' => $e?->getMessage(),
            'form_error' => [],
        ];

        foreach ($modelFields as $field => $model) {
            $json['form_error'][$field] = $model->validationErrors()->all();
        }

        return response($json, 422);
    }

    public function getStatusCode()
    {
        return 422;
    }
}

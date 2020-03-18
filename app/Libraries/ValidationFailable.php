<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

interface ValidationFailable
{
    /**
     * Implementors should trigger a ValidationFailedEvent.
     *
     * @return void
     */
    public function dispatchValidationFailed();
}

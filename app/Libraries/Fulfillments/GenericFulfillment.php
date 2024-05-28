<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Fulfillments;

/**
 * Placeholder class for handling non-custom class order item fulfillment.
 */
class GenericFulfillment extends OrderFulfiller
{
    const TAGGED_NAME = 'generic';

    public function __construct($order)
    {
        parent::__construct($order);
    }

    public function run()
    {
        // almost noop
        \Datadog::increment(
            "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.fulfillments.run",
            1,
            ['type' => static::TAGGED_NAME]
        );
    }

    public function revoke()
    {
        // almost noop
        \Datadog::increment(
            "{$GLOBALS['cfg']['datadog-helper']['prefix_web']}.store.fulfillments.revoke",
            1,
            ['type' => static::TAGGED_NAME]
        );
    }

    public function validationErrorsTranslationPrefix(): string
    {
        return '';
    }
}

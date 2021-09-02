<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Attributes;

use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use League\CommonMark\Extension\Attributes\Node\AttributesInline;

class AttributesOnlyIdListener
{
    public function __invoke(DocumentParsedEvent $documentEvent): void
    {
        $walker = $documentEvent->getDocument()->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();

            if (!($node instanceof AttributesInline) && ($event->isEntering() || !($node instanceof Attributes))) {
                continue;
            }

            $attributes = $node->data->getData('attributes')->export();

            $newAttributes = [];
            if (isset($attributes['id'])) {
                $newAttributes['id'] = $attributes['id'];
            }

            if ($node instanceof AttributesInline) {
                $node->setAttributes($newAttributes);
            } else if ($node instanceof Attributes) {
                $node->replaceWith(new $node($newAttributes));
            }
        }
    }
}

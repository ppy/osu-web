<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Attributes;

use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use League\CommonMark\Extension\Attributes\Node\AttributesInline;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;

class AttributesAllowedListener implements ConfigurationAwareInterface
{
    private ConfigurationInterface $config;

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    public function __invoke(DocumentParsedEvent $documentEvent): void
    {
        $attributesAllowed = $this->config->exists('osu_extension/attributes_allowed') ? $this->config->get('osu_extension/attributes_allowed') ?? [] : [];

        $walker = $documentEvent->getDocument()->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();

            if ($node instanceof AttributesInline || (!$event->isEntering() && ($node instanceof Attributes))) {
                $attributes = $node->getAttributes();

                $newAttributes = [];
                foreach ($attributesAllowed as $key) {
                    if (isset($attributes[$key])) {
                        $newAttributes[$key] = $attributes[$key];
                    }
                }

                $node->setAttributes($newAttributes);
            }
        }
    }
}

<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu;

use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Table\Table;

class Extension implements ExtensionInterface
{
    private $processor;

    public function __construct(DocumentProcessor $processor)
    {
        $this->processor = $processor;
    }

    public function register(ConfigurableEnvironmentInterface $environment): void
    {
        $environment
            ->addBlockRenderer(ListItem::class, new Renderers\ListItemRenderer())
            ->addBlockRenderer(Table::class, new Renderers\TableRenderer())
            ->addEventListener(DocumentParsedEvent::class, $this->processor);
    }
}

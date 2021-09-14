<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\CommonMark\Extension\Table\Table;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

class Extension implements ConfigurableExtensionInterface
{
    /**
     * @var DocumentProcessor|null
     */
    public $processor;

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('osu_extension', Expect::structure([
            'block_name' => Expect::string(),
            'generate_toc' => Expect::bool(),
            'record_first_image' => Expect::bool(),
            'relative_url_root' => Expect::string()->nullable(),
            'style_block_allowed_classes' => Expect::array()->nullable(),
            'title_from_document' => Expect::bool(),
            'wiki_locale' => Expect::string()->nullable(),
        ]));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $this->processor = new DocumentProcessor($environment);

        $environment
            ->addRenderer(ListItem::class, new Renderers\ListItemRenderer(), 10)
            ->addRenderer(Table::class, new Renderers\TableRenderer(), 10)
            ->addEventListener(DocumentParsedEvent::class, $this->processor);
    }
}

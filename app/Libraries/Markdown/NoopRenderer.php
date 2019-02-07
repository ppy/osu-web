<?php

namespace App\Libraries\Markdown;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Node\Node;
class NoopRenderer
{
    public function render(Node $block, ElementRendererInterface $renderer)
    {
        return '';
    }
}

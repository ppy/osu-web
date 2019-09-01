<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Adapted from PHPLeague's CommonMark code fence implementation:
 * https://github.com/thephpleague/commonmark/blob/master/src/Block/Element/FencedCode.php
 */

namespace App\Libraries\Markdown\Block\Element;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;
use League\CommonMark\Util\RegexHelper;

class WikiSection extends AbstractBlock
{
    /**
     * @var int
     */
    protected $length;

    /**
     * @var string
     */
    protected $char;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @param int    $length
     * @param string $char
     * @param int    $offset
     */
    public function __construct($length, $char, $offset)
    {
        parent::__construct();

        $this->length = $length;
        $this->char = $char;
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getChar()
    {
        return $this->char;
    }

    /**
     * @param string $char
     *
     * @return $this
     */
    public function setChar($char)
    {
        $this->char = $char;

        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Returns true if this block can contain the given block as a child node
     *
     * @param AbstractBlock $block
     *
     * @return bool
     */
    public function canContain(AbstractBlock $block)
    {
        return !($block instanceof self);
    }

    /**
     * Returns true if block type can accept lines of text
     *
     * @return bool
     */
    public function acceptsLines()
    {
        return false;
    }

    /**
     * Whether this is a code block
     *
     * @return bool
     */
    public function isCode()
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor)
    {
        if ($cursor->getIndent() <= 3 && $cursor->getNextNonSpaceCharacter() === '"') {
            $match = RegexHelper::matchAll('/^(?:"{3,})(?= *$)/', $cursor->getLine(), $cursor->getNextNonSpacePosition());

            if (strlen($match[0]) >= $this->getLength()) {
                $cursor->advanceBy(strlen($match[0]));

                return false;
            }
        }

        // Skip optional spaces of fence offset
        $cursor->match('/^ {0,'.$this->offset.'}/');

        return true;
    }

    /**
     * @param ContextInterface $context
     * @param Cursor           $cursor
     */
    public function handleRemainingContents(ContextInterface $context, Cursor $cursor)
    {
        // nothing to do here, the children blocks are handled by the parser
    }

    /**
     * @param Cursor $cursor
     * @param int    $currentLineNumber
     *
     * @return bool
     */
    public function shouldLastLineBeBlank(Cursor $cursor, $currentLineNumber)
    {
        return false;
    }
}

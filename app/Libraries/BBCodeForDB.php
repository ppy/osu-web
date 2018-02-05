<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Libraries;

use App\Models\Smiley;

class BBCodeForDB
{
    public $text;
    public $uid;

    // "11111111111111111111111111111"
    // encoded with: https://www.phpbb.com/support/docs/en/3.0/kb/article/how-to-template-bitfield-and-bbcodes/
    // number of 1s are arbitrary
    public $bitfield = '////+A==';

    public function extraEscapes($text)
    {
        return str_replace(
            ['[', ']', '.', ':'],
            ['&#91;', '&#93;', '&#46;', '&#58;'],
            $text
        );
    }

    public function __construct($text = '')
    {
        $this->text = $text;
        $this->uid = config('osu.bbcode.uid');
    }

    public function parseAudio($text)
    {
        return preg_replace(
            ",\[(audio)\](.+?\.mp3)\[(/audio)\],",
            "[\\1:{$this->uid}]\\2[\\3:{$this->uid}]",
            $text
        );
    }

    /**
     * Handles:
     * - Centre (centre).
     */
    public function parseBlockSimple($text)
    {
        foreach (['centre'] as $tag) {
            $text = preg_replace(
                "#\[{$tag}](.*?)\[/{$tag}\]#s",
                "[{$tag}:{$this->uid}]\\1[/{$tag}:{$this->uid}]",
                $text
            );
        }

        return $text;
    }

    public function parseBox($text)
    {
        $text = preg_replace("#(\[box=.*?)\](.*?)(\[/box)\]#s", "\\1:{$this->uid}]\\2\\3:{$this->uid}]", $text);
        $text = preg_replace("#(\[spoilerbox)\](.*?)(\[/spoilerbox)\]#s", "\\1:{$this->uid}]\\2\\3:{$this->uid}]", $text);

        return $text;
    }

    public function parseCode($text)
    {
        return preg_replace_callback(
            "#\[code\](?<code>.+?)\[/code\]#s",
            function ($m) {
                $escapedCode = $this->extraEscapes($m['code']);

                return "[code:{$this->uid}]{$escapedCode}[/code:{$this->uid}]";
            },
            $text
        );
    }

    public function parseColour($text)
    {
        return preg_replace(
            ",\[(color=(?:#[[:xdigit:]]{6}|[[:alpha:]]+))\](.*?)\[(/color)\],s",
            "[\\1:{$this->uid}]\\2[\\3:{$this->uid}]",
            $text
        );
    }

    public function parseEmail($text)
    {
        $emailPattern = "[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z-]+";
        $text = preg_replace(
            "#\[email\]({$emailPattern})\[/email\]#",
            "[email:{$this->uid}]\\1[/email:{$this->uid}]",
            $text
        );
        $text = preg_replace(
            "#\[email=({$emailPattern})\](.+?)\[/email\]#",
            "[email=\\1:{$this->uid}]\\2[/email:{$this->uid}]",
            $text
        );

        return $text;
    }

    public function parseImage($text)
    {
        preg_match_all("#\[img\](?<url>.*?)\[/img\]#", $text, $images, PREG_SET_ORDER);

        foreach ($images as $i) {
            $escapedUrl = $this->extraEscapes($i['url']);

            $imageTag = "[img:{$this->uid}]{$escapedUrl}[/img:{$this->uid}]";
            $text = str_replace($i[0], $imageTag, $text);
        }

        return $text;
    }

    /*
    * Handles:
    * - Bold (b)
    * - Italic (i)
    * - Strike (strike, s)
    * - Underline (u)
    */
    public function parseInlineSimple($text)
    {
        foreach (['b', 'i', 'strike', 's', 'u'] as $tag) {
            $text = preg_replace(
                "#\[{$tag}](.*?)\[/{$tag}\]#s",
                "[{$tag}:{$this->uid}]\\1[/{$tag}:{$this->uid}]",
                $text
            );
        }

        return $text;
    }

    public function parseHeading($text)
    {
        $text = preg_replace(
            "#\[heading](.*?)\[/heading\]#",
            "[heading:{$this->uid}]\\1[/heading:{$this->uid}]",
            $text
        );

        return $text;
    }

    public function parseLinks($text)
    {
        $spaces = ["(^|\s)", "((?:\.|\))?(?:$|\s|\n|\r))"];
        // plain http/https/ftp

        $text = preg_replace(
            "#{$spaces[0]}((?:https?|ftp)://[^\s]+?){$spaces[1]}#",
            "\\1<!-- m --><a href='\\2' rel='nofollow'>\\2</a><!-- m -->\\3",
            $text
        );

        // www
        $text = preg_replace(
            "/{$spaces[0]}(www\.[^\s]+){$spaces[1]}/",
            "\\1<!-- w --><a href='http://\\2' rel='nofollow'>\\2</a><!-- w -->\\3",
            $text
        );

        // emails
        $text = preg_replace(
            "/{$spaces[0]}([A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z-]+){$spaces[1]}/",
            "\\1<!-- e --><a href='mailto:\\2' rel='nofollow'>\\2</a><!-- e -->\\3",
            $text
        );

        return $text;
    }

    // the implementation here is completely different and incompatible
    // with phpBB original implementation.

    public function parseList($text)
    {
        $patterns = ["/\[(list(?:=.+?)?)\]/", '[/list]'];
        $counts = [preg_match_all($patterns[0], $text), substr_count($text, $patterns[1])];
        $limit = min($counts);

        $text = str_replace('[*]', "[*:{$this->uid}]", $text);
        $text = str_replace('[/*]', '', $text);

        $text = preg_replace($patterns[0], "[\\1:{$this->uid}]", $text, $limit);
        $text = preg_replace('/'.preg_quote($patterns[1], '/').'/', "[/list:o:{$this->uid}]", $text, $limit);

        return $text;
    }

    public function parseNotice($text)
    {
        return preg_replace(
            "#\[(notice)\](.*?)\[/\\1\]#s",
            "[\\1:{$this->uid}]\\2[/\\1:{$this->uid}]",
            $text);
    }

    public function parseProfile($text)
    {
        return preg_replace_callback(
            "#\[profile\](.+?)\[/profile\]#",
            function ($m) {
                $name = $this->extraEscapes($m[1]);

                return "[profile:{$this->uid}]{$name}[/profile:{$this->uid}]";
            },
            $text
        );
    }

    // this is quite different and much more dumb than the one in phpbb

    public function parseQuote($text)
    {
        $patterns = ["/\[(quote(?:=&quot;.+?&quot;)?)\]/", '[/quote]'];
        $counts = [preg_match_all($patterns[0], $text), substr_count($text, $patterns[1])];
        $limit = min($counts);

        $text = preg_replace($patterns[0], "[\\1:{$this->uid}]", $text, $limit);
        $text = preg_replace('/'.preg_quote($patterns[1], '/').'/', "[/quote:{$this->uid}]", $text, $limit);

        return $text;
    }

    public function parseSize($text)
    {
        return preg_replace(
            "#\[(size=(?:\d+))\](.*?)\[(/size)\]#s",
            "[\\1:{$this->uid}]\\2[\\3:{$this->uid}]",
            $text
        );
    }

    // copied from www/forum/includes/message_parser.php#L1196

    public function parseSmiley($text)
    {
        $smilies = Smiley::getAll();

        $match = [];
        $replace = [];

        foreach ($smilies as $smiley) {
            $match[] = '(?<=^|[\n .])'.preg_quote($smiley['code'], '#').'(?![^<>]*>)';
            $replace[] = '<!-- s'.$smiley['code'].' --><img src="{SMILIES_PATH}/'.$smiley['smiley_url'].'" alt="'.$smiley['code'].'" title="'.$smiley['emotion'].'" /><!-- s'.$smiley['code'].' -->';
        }
        if (count($match)) {
            // Make sure the delimiter # is added in front and at the end of every element within $match
            $text = trim(preg_replace(explode(chr(0), '#'.implode('#'.chr(0).'#', $match).'#'), $replace, $text));
        }

        return $text;
    }

    public function parseUrl($text)
    {
        $urlPattern = '(?:https?|ftp)://.+?';

        $text = preg_replace_callback(
            "#\[url\]({$urlPattern})\[/url\]#",
            function ($m) {
                $url = $this->extraEscapes($m[1]);

                return "[url:{$this->uid}]{$url}[/url:{$this->uid}]";
            },
            $text
        );
        $text = preg_replace_callback(
            "#\[url=({$urlPattern})\](.+?)\[/url\]#",
            function ($m) {
                $url = $this->extraEscapes($m[1]);

                return "[url={$url}:{$this->uid}]{$m[2]}[/url:{$this->uid}]";
            },
            $text
        );

        return $text;
    }

    public function parseYoutube($text)
    {
        return preg_replace_callback(
            "#\[youtube\](.+?)\[/youtube\]#",
            function ($m) {
                $videoId = $this->extraEscapes($m[1]);

                return "[youtube:{$this->uid}]{$videoId}[/youtube:{$this->uid}]";
            },
            $text
        );
    }

    public function generate()
    {
        $text = htmlentities($this->text, ENT_QUOTES, 'UTF-8', true);

        $text = $this->parseCode($text);
        $text = $this->parseNotice($text);
        $text = $this->parseBox($text);
        $text = $this->parseQuote($text);
        $text = $this->parseList($text);

        $text = $this->parseBlockSimple($text);
        $text = $this->parseImage($text);
        $text = $this->parseInlineSimple($text);
        $text = $this->parseHeading($text);
        $text = $this->parseAudio($text);
        $text = $this->parseEmail($text);
        $text = $this->parseUrl($text);
        $text = $this->parseSize($text);
        $text = $this->parseColour($text);
        $text = $this->parseYoutube($text);
        $text = $this->parseProfile($text);

        $text = $this->parseSmiley($text);
        $text = $this->parseLinks($text);

        return $text;
    }
}

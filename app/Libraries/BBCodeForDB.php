<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Smiley;
use App\Models\User;

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
            ['[', ']', '.', ':', "\n"],
            ['&#91;', '&#93;', '&#46;', '&#58;', '&#10;'],
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
        preg_match_all("#\[audio\](?<url>.*?)\[/audio\]#", $text, $audio, PREG_SET_ORDER);

        foreach ($audio as $a) {
            $escapedUrl = $this->extraEscapes($a['url']);

            $audioTag = "[audio:{$this->uid}]{$escapedUrl}[/audio:{$this->uid}]";
            $text = str_replace($a[0], $audioTag, $text);
        }

        return $text;
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
        $text = preg_replace("#\[box=([^]]*?)\]#s", "[box=\\1:{$this->uid}]", $text);
        $text = str_replace('[/box]', "[/box:{$this->uid}]", $text);
        $text = str_replace('[spoilerbox]', "[spoilerbox:{$this->uid}]", $text);
        $text = str_replace('[/spoilerbox]', "[/spoilerbox:{$this->uid}]", $text);

        return $text;
    }

    public function parseCode($text)
    {
        return preg_replace_callback(
            "#\[code\](?<prespaces>\n*)(?<code>.+?)(?<postspaces>\n*)\[/code\]#s",
            function ($m) {
                $escapedCode = $this->extraEscapes($m['code']);

                return "[code:{$this->uid}]{$m['prespaces']}{$escapedCode}{$m['postspaces']}[/code:{$this->uid}]";
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
    * - Spoiler (spoiler)
    */
    public function parseInlineSimple($text)
    {
        foreach (['b', 'i', 'strike', 's', 'u', 'spoiler'] as $tag) {
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
        $spaces = ["(^|\[.+?\]|\s(?:&lt;|[.:([])*)", "((?:\[.+?\]|&gt;|[.:)\]])*(?:$|\s|\n|\r))"];
        $internalUrl = rtrim(preg_quote(config('app.url'), '#'), '/');

        // internal url
        $text = preg_replace(
            "#{$spaces[0]}({$internalUrl}/([^\s]+?)){$spaces[1]}#",
            "\\1<!-- m --><a href='\\2' rel='nofollow'>\\3</a><!-- m -->\\4",
            $text
        );

        // plain http/https/ftp
        $text = preg_replace(
            "#{$spaces[0]}((?:https?|ftp)://[^\s]+?){$spaces[1]}#",
            "\\1<!-- m --><a href='\\2' rel='nofollow'>\\2</a><!-- m -->\\3",
            $text
        );

        // www
        $text = preg_replace(
            "#{$spaces[0]}(www\.[^\s]+){$spaces[1]}#",
            "\\1<!-- w --><a href='http://\\2' rel='nofollow'>\\2</a><!-- w -->\\3",
            $text
        );

        // emails
        $text = preg_replace(
            "#{$spaces[0]}([A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z-]+){$spaces[1]}#",
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
            $text
        );
    }

    public function parseProfile($text)
    {
        preg_match_all('#\[profile(?:=(?<id>[0-9]+))?\](?<name>.+?)\[/profile\]#', $text, $tags);

        $count = count($tags[0]);

        if ($count > 0) {
            $users = User
                ::whereIn('user_id', $tags['id'])
                ->orWhereIn('username', $tags['name'])
                ->orWhereIn('username_clean', $tags['name'])
                ->get();

            $usersBy = [];

            foreach ($users as $user) {
                foreach (['user_id', 'username', 'username_clean'] as $key) {
                    $usersBy[$key][mb_strtolower($user->$key)] = $user;
                }
            }

            for ($i = 0; $i < $count; $i++) {
                $tag = presence($tags[0][$i]);
                $name = $tags['name'][$i];
                $nameNormalized = mb_strtolower($name);
                $id = presence($tags['id'][$i]);

                $user = $usersBy['user_id'][$id] ?? $usersBy['username'][$nameNormalized] ?? $usersBy['username_clean'][$nameNormalized] ?? null;

                if ($user === null || !$user->hasProfileVisible()) {
                    $idText = '';
                } else {
                    $idText = "={$user->getKey()}";
                    $name = $user->username;
                }

                $name = $this->extraEscapes($name);

                $text = str_replace($tag, "[profile{$idText}:{$this->uid}]{$name}[/profile:{$this->uid}]", $text);
            }
        }

        return $text;
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
                $videoId = preg_replace('/\?.*/', '', $this->extraEscapes($m[1]));

                return "[youtube:{$this->uid}]{$videoId}[/youtube:{$this->uid}]";
            },
            $text
        );
    }

    public function generate()
    {
        $text = htmlentities($this->text, ENT_QUOTES, 'UTF-8', true);

        $text = $this->unifyNewline($text);
        $text = $this->parseCode($text);
        $text = $this->parseNotice($text);
        $text = $this->parseBox($text);
        $text = $this->parseQuote($text);
        $text = $this->parseList($text);

        $text = $this->parseBlockSimple($text);
        $text = $this->parseProfile($text);
        $text = $this->parseImage($text);
        $text = $this->parseInlineSimple($text);
        $text = $this->parseHeading($text);
        $text = $this->parseAudio($text);
        $text = $this->parseEmail($text);
        $text = $this->parseUrl($text);
        $text = $this->parseSize($text);
        $text = $this->parseColour($text);
        $text = $this->parseYoutube($text);

        $text = $this->parseSmiley($text);
        $text = $this->parseLinks($text);

        return $text;
    }

    public function unifyNewline($text)
    {
        return str_replace(["\r\n", "\r"], ["\n", "\n"], $text);
    }
}

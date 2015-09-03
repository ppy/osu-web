<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries;

/*
* Note that this class doesn't actually parse random bbcode.
* It only does "second pass" parsing of phpbb-preprocessed bbcode.
* Nothing in this class does any kind of checking because it should
* be already done by phpbb.
*/
class BBCodeFromDB
{
    public $text;
    public $uid;

    public function __construct($text, $uid = '')
    {
        $this->text = $text;
        $this->uid = $uid;
    }

    public function clearSpacesBetweenTags($text)
    {
        return preg_replace("/>\s*</", '><', $text);
    }

    public function parseBold($text)
    {
        $text = str_replace("[b:{$this->uid}]", '<strong>', $text);
        $text = str_replace("[/b:{$this->uid}]", '</strong>', $text);

        return $text;
    }

    public function parseBox($text)
    {
        $text = preg_replace("#\[box=(.*?):{$this->uid}\]#", "<div class='spoiler-box'><a class='spoiler-link' href='#'><i class='fa fa-chevron-down'></i>\\1</a><div class='spoiler-body'>", $text);
        $text = str_replace("[/box:{$this->uid}]", '</div></div>', $text);

        $text = str_replace("[spoilerbox:{$this->uid}]", "<div class='spoiler-box'><a class='spoiler-link' href='#'><i class='fa fa-chevron-down'></i>collapsed text</a><div class='spoiler-body'>", $text);
        $text = str_replace("[/spoilerbox:{$this->uid}]", '</div></div>', $text);

        return $text;
    }

    public function parseCentre($text)
    {
        $text = str_replace("[centre:{$this->uid}]", '<center>', $text);
        $text = str_replace("[/centre:{$this->uid}]", '</center>', $text);

        return $text;
    }

    public function parseCode($text)
    {
        $text = str_replace("[code:{$this->uid}]", '<pre>', $text);
        $text = str_replace("[/code:{$this->uid}]", '</pre>', $text);

        return $text;
    }

    public function parseColour($text)
    {
        $text = preg_replace("#\[color=([^:]+):{$this->uid}\]#", "<span style='color:\\1'>", $text);
        $text = str_replace("[/color:{$this->uid}]", '</span>', $text);

        return $text;
    }

    public function parseEmail($text)
    {
        $text = preg_replace(
            "#\[email:{$this->uid}\](.+?)\[/email:{$this->uid}\]#",
            "<a rel='nofollow' href='mailto:\\1'>\\1</a>",
            $text
        );
        $text = preg_replace("#\[email=(.+?):{$this->uid}\]#", "<a rel='nofollow' href='mailto:\\1'>", $text);
        $text = str_replace("[/email:{$this->uid}]", '</a>', $text);

        return $text;
    }

    public function parseHeading($text)
    {
        $text = str_replace("[heading:{$this->uid}]", '<h2>', $text);
        $text = str_replace("[/heading:{$this->uid}]", '</h2>', $text);

        return $text;
    }

    public function parseItalic($text)
    {
        $text = str_replace("[i:{$this->uid}]", '<em>', $text);
        $text = str_replace("[/i:{$this->uid}]", '</em>', $text);

        return $text;
    }

    public function parseImage($text)
    {
        preg_match_all("#\[img:{$this->uid}\](?<url>[^[]+)\[/img:{$this->uid}\]#", $text, $images, PREG_SET_ORDER);

        foreach ($images as $i) {
            $proxiedSrc = proxy_image($i['url']);
            $text = str_replace($i[0], lazy_load_image($proxiedSrc), $text);
        }

        return $text;
    }

    public function parseList($text)
    {
        $text = preg_replace("#\[list=\d+:{$this->uid}\]#", '<ol>', $text);
        $text = preg_replace("#\[list(=.?)?:{$this->uid}\]#", "<ol class='unordered'>", $text);
        $text = preg_replace("#\[/\*(:m)?:{$this->uid}\]\n?#", '</li>', $text);
        $text = str_replace("[*:{$this->uid}]", '<li>', $text);
        $text = str_replace("[/list:o:{$this->uid}]", '</ol>', $text);
        $text = str_replace("[/list:u:{$this->uid}]", '</ol>', $text);

        return $text;
    }

    public function parseNotice($text)
    {
        $text = str_replace("[notice:{$this->uid}]", "<div class='well'>", $text);
        $text = str_replace("[/notice:{$this->uid}]", '</div>', $text);

        return $text;
    }

    public function parseProfile($text)
    {
        return preg_replace(
            "#\[profile:{$this->uid}\](.+?)\[/profile:{$this->uid}\]#",
            "<a href='/u/\\1'>\\1</a>",
            $text
        );
    }

    public function parseQuote($text)
    {
        $text = preg_replace("#\[quote=&quot;([^:]+)&quot;:{$this->uid}\]#", '<h4>\\1 wrote:</h4><blockquote>', $text);
        $text = str_replace("[quote:{$this->uid}]", '<blockquote>', $text);
        $text = str_replace("[/quote:{$this->uid}]", '</blockquote>', $text);

        return $text;
    }

    // stolen from: www/forum/includes/functions.php:2845
    public function parseSmilies($text)
    {
        return preg_replace('#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/(.*?) \/><!\-\- s\1 \-\->#', '<img class="smiley" src="'.config('osu.urls.smilies').'/\2 />', $text);
    }

    public function parseStrike($text)
    {
        $text = str_replace("[s:{$this->uid}]", '<del>', $text);
        $text = str_replace("[/s:{$this->uid}]", '</del>', $text);
        $text = str_replace("[strike:{$this->uid}]", '<del>', $text);
        $text = str_replace("[/strike:{$this->uid}]", '</del>', $text);

        return $text;
    }

    public function parseUnderline($text)
    {
        $text = str_replace("[u:{$this->uid}]", '<u>', $text);
        $text = str_replace("[/u:{$this->uid}]", '</u>', $text);

        return $text;
    }

    public function parseSpoiler($text)
    {
        $text = str_replace("[spoiler:{$this->uid}]", "<span class='spoiler'>", $text);
        $text = str_replace("[/spoiler:{$this->uid}]", '</span>', $text);

        return $text;
    }

    public function parseSize($text)
    {
        $text = preg_replace("#\[size=(\d+):{$this->uid}\]#", "<span class='size-\\1'>", $text);
        $text = str_replace("[/size:{$this->uid}]", '</span>', $text);

        return $text;
    }

    public function parseUrl($text)
    {
        $text = preg_replace("#\[url:{$this->uid}\](.+?)\[/url:{$this->uid}\]#", "<a rel='nofollow' href='\\1'>\\1</a>", $text);
        $text = preg_replace("#\[url=(.+?):{$this->uid}\]#", "<a rel='nofollow' href='\\1'>", $text);
        $text = str_replace("[/url:{$this->uid}]", '</a>', $text);

        return $text;
    }

    public function parseYoutube($text)
    {
        $text = str_replace("[youtube:{$this->uid}]", "<iframe width='425' height='344' src='https://www.youtube.com/embed/", $text);
        $text = str_replace("[/youtube:{$this->uid}]", "?rel=0' frameborder='0' allowfullscreen></iframe>", $text);

        return $text;
    }

    public function toHTML()
    {
        $text = $this->text;

        // block
        $text = $this->parseBox($text);
        $text = $this->parseCode($text);
        $text = $this->parseList($text);
        $text = $this->parseNotice($text);
        $text = $this->parseQuote($text);
        $text = $this->parseHeading($text);
        $text = $this->clearSpacesBetweenTags($text);

        // inline
        $text = $this->parseBold($text);
        $text = $this->parseCentre($text);
        $text = $this->parseColour($text);
        $text = $this->parseEmail($text);
        $text = $this->parseImage($text);
        $text = $this->parseItalic($text);
        $text = $this->parseSize($text);
        $text = $this->parseSmilies($text);
        $text = $this->parseSpoiler($text);
        $text = $this->parseStrike($text);
        $text = $this->parseUnderline($text);
        $text = $this->parseUrl($text);
        $text = $this->parseYoutube($text);
        $text = $this->parseProfile($text);

        $text = preg_replace('/\n/', "\n<br />", $text);
        $text = CleanHTML::purify($text);

        return "<div class='bbcode'>{$text}</div>";
    }

    public function toEditor()
    {
        $text = $this->text;

        // remove list item closing tags
        $text = str_replace("[/*:m:{$this->uid}]", '', $text);

        // remove list item type marker at closing tags
        $text = preg_replace("#\[/list:[ou]:{$this->uid}\]#", '[/list]', $text);

        // strip uids
        $text = str_replace(":{$this->uid}]", ']', $text);

        // strip url
        $text = preg_replace('#<!-- ([emw]) --><a.*?>(.*?)</a><!-- \\1 -->#', '\\2', $text);

        // strip smilies
        $text = preg_replace('#<!-- (s(.*?)) -->.*?<!-- \\1 -->#', '\\2', $text);

        return html_entity_decode($text);
    }
}

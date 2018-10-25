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
    public $refId;
    public $withGallery;

    public function __construct($text, $uid = '', $options = [])
    {
        $defaultOptions = [
            'withGallery' => false,
            'ignoreLineHeight' => false,
            'withoutImageDimensions' => false,
            'extraClasses' => '',
        ];

        $this->text = $text;
        $this->uid = $uid;
        $this->options = array_merge($defaultOptions, $options);

        if ($this->options['withGallery']) {
            $this->refId = rand();
        }
    }

    public function clearSpacesBetweenTags($text)
    {
        return preg_replace("/([^-][^-]>)\s*</", '\1<', $text);
    }

    public function parseAudio($text)
    {
        $text = str_replace("[audio:{$this->uid}]", '<audio controls="controls" src="', $text);
        $text = str_replace("[/audio:{$this->uid}]", '"></audio>', $text);

        return $text;
    }

    public function parseBold($text)
    {
        $text = str_replace("[b:{$this->uid}]", '<strong>', $text);
        $text = str_replace("[/b:{$this->uid}]", '</strong>', $text);

        return $text;
    }

    public function parseBox($text)
    {
        $text = preg_replace("#\[box=(.*?):{$this->uid}\]#", $this->parseBoxHelperPrefix('\\1'), $text);
        $text = str_replace("[/box:{$this->uid}]", $this->parseBoxHelperSuffix(), $text);

        $text = str_replace("[spoilerbox:{$this->uid}]", $this->parseBoxHelperPrefix('SPOILER'), $text);
        $text = str_replace("[/spoilerbox:{$this->uid}]", $this->parseBoxHelperSuffix(), $text);

        return $text;
    }

    public function parseBoxHelperPrefix($linkText)
    {
        return "<div class='js-spoilerbox bbcode-spoilerbox'><a class='js-spoilerbox__link bbcode-spoilerbox__link' href='#'><i class='fas fa-chevron-right bbcode-spoilerbox__arrow'></i>{$linkText}</a><div class='bbcode-spoilerbox__body'>";
    }

    public function parseBoxHelperSuffix()
    {
        return '</div></div>';
    }

    public function parseCentre($text)
    {
        $text = str_replace("[centre:{$this->uid}]", '<center>', $text);
        $text = str_replace("[/centre:{$this->uid}]", '</center>', $text);

        return $text;
    }

    public function parseCode($text)
    {
        return preg_replace(
            "#\n*\[code:{$this->uid}\]\n*(.*?)\n*\[/code:{$this->uid}\]\n*#s",
            '<pre>\\1</pre>',
            $text);
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

        $index = 0;

        foreach ($images as $i) {
            $proxiedSrc = proxy_image(html_entity_decode_better($i['url']));

            $imageTag = $galleryAttributes = '';

            if (!$this->options['withoutImageDimensions']) {
                $imageSize = fast_imagesize($proxiedSrc);
            }

            if (!$this->options['withoutImageDimensions'] && $imageSize !== null && $imageSize[0] !== 0) {
                $heightPercentage = ($imageSize[1] / $imageSize[0]) * 100;

                $topClass = 'proportional-container';
                if ($this->options['withGallery']) {
                    $topClass .= ' js-gallery';
                    $galleryAttributes = " data-width='{$imageSize[0]}' data-height='{$imageSize[1]}' data-index='{$index}' data-gallery-id='{$this->refId}' data-src='{$proxiedSrc}'";
                }

                $imageTag .= "<span class='{$topClass}' style='width: {$imageSize[0]}px;'$galleryAttributes>";
                $imageTag .= "<span class='proportional-container__height' style='padding-bottom: {$heightPercentage}%;'>";
                $imageTag .= lazy_load_image($proxiedSrc, 'proportional-container__content');
                $imageTag .= '</span>';
                $imageTag .= '</span>';

                $index += 1;
            } else {
                $imageTag .= lazy_load_image($proxiedSrc);
            }

            $text = str_replace($i[0], $imageTag, $text);
        }

        return $text;
    }

    public function parseList($text)
    {
        // basic list.
        $text = preg_replace("#\[list=\d+:{$this->uid}\]\s*\[\*:{$this->uid}\]#", '<ol><li>', $text);
        $text = preg_replace("#\[list(=.?)?:{$this->uid}\]\s*\[\*:{$this->uid}\]#", '<ol class="unordered"><li>', $text);

        // convert list items.
        $text = preg_replace("#\[/\*(:m)?:{$this->uid}\]\n?#", '</li>', $text);
        $text = str_replace("[*:{$this->uid}]", '<li>', $text);

        // close list tags.
        $text = str_replace("[/list:o:{$this->uid}]", '</ol>', $text);
        $text = str_replace("[/list:u:{$this->uid}]", '</ol>', $text);

        // list with "title", with it being just a list without style.
        $text = preg_replace("#\[list=\d+:{$this->uid}\](.+?)(<li>|</ol>)#s", '<ul class="bbcode__list-title"><li>$1</li></ul><ol>$2', $text);
        $text = preg_replace("#\[list(=.?)?:{$this->uid}\](.+?)(<li>|</ol>)#s", '<ul class="bbcode__list-title"><li>$2</li></ul><ol class="unordered">$3', $text);

        return $text;
    }

    public function parseNotice($text)
    {
        return preg_replace(
            "#\[notice:{$this->uid}\]\n*(.*?)\n*\[/notice:{$this->uid}\]\n?#s",
            "<div class='well'>\\1</div>",
            $text);
    }

    public function parseProfile($text)
    {
        preg_match_all("#\[profile:{$this->uid}\](?<id>.*?)\[/profile:{$this->uid}\]#", $text, $users, PREG_SET_ORDER);

        foreach ($users as $user) {
            $username = html_entity_decode_better($user['id']);
            $userLink = link_to_user($username, $username, null);
            $text = str_replace($user[0], $userLink, $text);
        }

        return $text;
    }

    public function parseQuote($text)
    {
        $text = preg_replace("#\[quote=&quot;([^:]+)&quot;:{$this->uid}\]\s*#", '<h4>\\1 wrote:</h4><blockquote>', $text);
        $text = preg_replace("#\[quote:{$this->uid}\]\s*#", '<blockquote>', $text);
        $text = preg_replace("#\s*\[/quote:{$this->uid}\]\s*#", '</blockquote>', $text);

        return $text;
    }

    // stolen from: www/forum/includes/functions.php:2845

    public function parseSmilies($text)
    {
        return preg_replace('#<!\-\- s(.*?) \-\-><img src="\{SMILIES_PATH\}\/(.*?) \/><!\-\- s\1 \-\->#', '<img class="smiley" src="'.osu_url('smilies').'/\2 />', $text);
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
        $text = str_replace("[youtube:{$this->uid}]", "<div class='bbcode__video-box'><div class='bbcode__video'><iframe src='https://www.youtube.com/embed/", $text);
        $text = str_replace("[/youtube:{$this->uid}]", "?rel=0' frameborder='0' allowfullscreen></iframe></div></div>", $text);

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
        $text = $this->parseAudio($text);
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

        $text = str_replace("\n", '<br />', $text);
        $text = CleanHTML::purify($text);

        $className = 'bbcode';

        if (present($this->options['extraClasses'])) {
            $className .= " {$this->options['extraClasses']}";
        }

        if ($this->options['ignoreLineHeight']) {
            $className .= ' bbcode--normal-line-height';
        }

        return "<div class='{$className}'>{$text}</div>";
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
        $text = preg_replace('#<!-- ([mw]) --><a.*?href=[\'"]([^"\']+)[\'"].*?>.*?</a><!-- \\1 -->#', '\\2', $text);
        $text = preg_replace('#<!-- e --><a.*?href=[\'"]mailto:([^"\']+)[\'"].*?>.*?</a><!-- e -->#', '\\1', $text);

        // strip relative url
        $text = preg_replace('#<!-- l --><a.*?href="(.*?)".*?>.*?</a><!-- l -->#', '\\1', $text);

        // strip smilies
        $text = preg_replace('#<!-- (s(.*?)) -->.*?<!-- \\1 -->#', '\\2', $text);

        return html_entity_decode_better($text);
    }

    public static function removeBBCodeTags($text)
    {
        // Don't care if too many characters are stripped;
        // just don't want tags to go into index because they mess up the highlighting.

        static $pattern = '#\[/?(\*|\*:m|audio|b|box|color|spoilerbox|centre|code|email|heading|i|img|list|list:o|list:u|notice|profile|quote|s|strike|u|spoiler|size|url|youtube)(=.*?(?=:))?(:[a-zA-Z0-9]{1,5})?\]#';

        return preg_replace($pattern, '', $text);
    }

    public static function removeBlockQuotes($text)
    {
        $level = 0;
        $marker = 0;

        while ($marker >= 0 && $marker < mb_strlen($text) && $level >= 0) {
            $match = static::scanForNextQuoteTag($text, $marker);
            if ($match === null) {
                return $text;
            }

            if (present($match['start'][0])) {
                $marker = $match['start'][1] + mb_strlen($match['start'][0]);
                $level++;
            } elseif (present($match['end'][0])) {
                $level--;
                $marker = $match['end'][1] + mb_strlen($match['end'][0]);
                if ($level === 0) {
                    $text = mb_substr($text, $marker, mb_strlen($text) - $marker);
                }
            } else {
                $marker = -1;
            }
        }

        return $text;
    }

    private static function scanForNextQuoteTag(string $text, $from = 0)
    {
        static $pattern = '#(?<start>\[quote(=.*?(?=:))?(:[a-zA-Z0-9]{1,5})?\])|(?<end>\[/quote(:[a-zA-Z0-9]{1,5})?\])#';

        if (preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE, $from) === 1) {
            return $matches;
        }
    }
}

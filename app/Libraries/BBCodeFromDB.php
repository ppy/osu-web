<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

	private array $options;

	public function __construct($text, $uid = '', $options = [])
	{
		$defaultOptions = [
			'withGallery' => false,
			'ignoreLineHeight' => false,
			'extraClasses' => '',
			'modifiers' => [],
		];

		$this->text = $text;
		$this->uid = presence($uid) ?? $GLOBALS['cfg']['osu']['bbcode']['uid'];
		$this->options = array_merge($defaultOptions, $options);

		if ($this->options['withGallery']) {
			$this->refId = rand();
		}
	}

	public function parseAudio($text)
	{
		preg_match_all("#\[audio:{$this->uid}\](?<url>[^[]+)\[/audio:{$this->uid}\]#", $text, $matches, PREG_SET_ORDER);

		foreach ($matches as $match) {
			$proxiedSrc = proxy_media(html_entity_decode_better($match['url']));
			$tag = '<audio controls="controls" preload="none" src="'.$proxiedSrc.'"></audio>';

			$text = str_replace($match[0], $tag, $text);
		}

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
		$text = preg_replace("#\[box=((\\\[\[\]]|[^][]|\[(\\\[\[\]]|[^][]|(?R))*\])*?):{$this->uid}\]\n*#s", $this->parseBoxHelperPrefix('\\1'), $text);
		$text = preg_replace("#\n*\[/box:{$this->uid}]\n?#s", $this->parseBoxHelperSuffix(), $text);

		$text = preg_replace("#\[spoilerbox:{$this->uid}\]\n*#s", $this->parseBoxHelperPrefix(), $text);
		$text = preg_replace("#\n*\[/spoilerbox:{$this->uid}]\n?#s", $this->parseBoxHelperSuffix(), $text);

		return $text;
	}

	public function parseBoxHelperPrefix($linkText = null)
	{
		$linkText = presence($linkText) ?? 'SPOILER';

		return "<div class='js-spoilerbox bbcode-spoilerbox'><a class='js-spoilerbox__link bbcode-spoilerbox__link' href='#'><span class='bbcode-spoilerbox__link-icon'></span>{$linkText}</a><div class='js-spoilerbox__body bbcode-spoilerbox__body'>";
	}

	public function parseBoxHelperSuffix()
	{
		return '</div></div>';
	}

	public function parseCentre($text)
	{
		$text = str_replace("[centre:{$this->uid}]", "<div data-align='center'>", $text);
		$text = str_replace("[/centre:{$this->uid}]", '</div>', $text);

		return $text;
	}

	public function parseRight($text)
	{
		$text = str_replace("[right:{$this->uid}]", "<div data-align='right'>", $text);
		$text = str_replace("[/right:{$this->uid}]", '</div>', $text);

	return $text;
	}

	public function parseCode($text)
	{
		return preg_replace(
			"#\[code:{$this->uid}\]\n*(.*?)\n*\[/code:{$this->uid}\]\n?#s",
			'<pre>\\1</pre>',
			$text
		);
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
		$text = preg_replace("#\[email=([^\]]+):{$this->uid}\]#", "<a rel='nofollow' href='mailto:\\1'>", $text);
		$text = str_replace("[/email:{$this->uid}]", '</a>', $text);

		return $text;
	}

	public function parseHeading($text)
	{
		$text = str_replace("[heading:{$this->uid}]", '<h2>', $text);
		$text = preg_replace("#\[/heading:{$this->uid}\]\n?#", '</h2>', $text);

		return $text;
	}

	public function parseImagemap($text)
	{
		return preg_replace_callback(
			'#(\[imagemap\].+?\[/imagemap\]\n?)#',
			function ($m) {
				$unescaped = html_entity_decode_better(BBCodeForDB::extraUnescape($m[1]));
				$parsed = preg_replace_callback(
					'#\[imagemap\]\n(?<imageUrl>https?://.+)\n(?<links>(?:(?:[0-9.]+ ){4}(?:\#|https?://[^\s]+|mailto:[^\s]+)(?: .*)?\n)+)\[/imagemap\]\n?#',
					function ($map) {
						$links = array_map(
							fn ($rawLink) => explode(' ', $rawLink, 6),
							explode("\n", $map['links']),
						);
						array_pop($links); // remove the empty string from last newline

						$linksHtml = implode('', array_map(
							fn ($link) => tag($link[4] === '#' ? 'span' : 'a', [
								'class' => 'imagemap__link',
								'href' => $link[4],
								'style' => implode(';', [
									"left: {$link[0]}%",
									"top: {$link[1]}%",
									"width: {$link[2]}%",
									"height: {$link[3]}%",
								]),
								'title' => $link[5] ?? '',
							]),
							$links,
						));

						$imageUrl = proxy_media($map['imageUrl']);
						$imageAttributes = [
							'class' => 'imagemap__image',
							'loading' => 'lazy',
							'src' => $imageUrl,
						];
						$imageSize = fast_imagesize($imageUrl);
						if ($imageSize !== null) {
							$imageAttributes['width'] = $imageSize[0];
							$imageAttributes['height'] = $imageSize[1];
						}
						$imageHtml = tag('img', $imageAttributes);

						return tag('div', ['class' => 'imagemap'], $imageHtml.$linksHtml);
					},
					$unescaped,
				);

				return $parsed === $unescaped ? $m[1] : $parsed;
			},
			$text,
		);
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
		$replacements = [];

		foreach ($images as $i) {
			$proxiedSrc = proxy_media(html_entity_decode_better($i['url']));

			$attributes = [
				'alt' => '',
				'src' => $proxiedSrc,
				'loading' => 'lazy',
			];

			$imageSize = fast_imagesize($proxiedSrc);
			if ($imageSize !== null && $imageSize[1] !== 0) {
				$aspectRatio = round($imageSize[0] / $imageSize[1], 4);

				$attributes['style'] = "aspect-ratio: {$aspectRatio}; width: {$imageSize[0]}px;";

				if ($this->options['withGallery']) {
					$attributes = [
						...$attributes,
						'class' => 'js-gallery',
						'data-width' => $imageSize[0],
						'data-height' => $imageSize[1],
						'data-index' => $index,
						'data-gallery-id' => $this->refId,
						'data-src' => $proxiedSrc,
					];
				}

				$index += 1;
			}

			$replacements[$i[0]] = tag('img', $attributes);
		}

		return strtr($text, $replacements);
	}

	public function parseInlineCode(string $text): string
	{
		return strtr($text, [
			"[c:{$this->uid}]" => '<code>',
			"[/c:{$this->uid}]" => '</code>',
		]);
	}

	public function parseList($text)
	{
		// basic list.
		$text = preg_replace("#\[list=[^]]+:{$this->uid}\]\s*\[\*:{$this->uid}\]#", '<ol><li>', $text);
		$text = preg_replace("#\[list:{$this->uid}\]\s*\[\*:{$this->uid}\]#", '<ol class="unordered"><li>', $text);

		// convert list items.
		$text = preg_replace("#\[/\*(:m)?:{$this->uid}\]\n?\n?#", '</li>', $text);
		$text = preg_replace("#\s*\[\*:{$this->uid}\]#", '<li>', $text);

		// close list tags.
		$text = preg_replace("#\s*\[/list:(o|u):{$this->uid}\]\n?\n?#", '</ol>', $text);

		// list with "title", with it being just a list without style.
		$text = preg_replace("#\[list=[^]]+:{$this->uid}\](.+?)(<li>|</ol>)#s", '<ul class="bbcode__list-title"><li>$1</li></ul><ol>$2', $text);
		$text = preg_replace("#\[list:{$this->uid}\](.+?)(<li>|</ol>)#s", '<ul class="bbcode__list-title"><li>$1</li></ul><ol class="unordered">$2', $text);

		return $text;
	}

	public function parseNotice($text)
	{
		return preg_replace(
			"#\[notice:{$this->uid}\]\n*(.*?)\n*\[/notice:{$this->uid}\]\n?#s",
			"<div class='well'>\\1</div>",
			$text
		);
	}

	public function parseProfile($text)
	{
		preg_match_all("#\[profile(?:=(?<id>[0-9]+))?:{$this->uid}\](?<name>.*?)\[/profile:{$this->uid}\]#", $text, $users, PREG_SET_ORDER);

		foreach ($users as $user) {
			$username = html_entity_decode_better($user['name']);
			$userId = presence($user['id']) ?? "@{$username}";
			$userLink = link_to_user($userId, $username, null);
			$text = str_replace($user[0], $userLink, $text);
		}

		return $text;
	}

	public function parseQuote($text)
	{
		$text = preg_replace("#\[quote=&quot;([^:]+)&quot;:{$this->uid}\]\s*#", '<blockquote><h4>\\1 wrote:</h4>', $text);
		$text = preg_replace("#\[quote:{$this->uid}\]\s*#", '<blockquote>', $text);
		$text = preg_replace("#\s*\[/quote:{$this->uid}\]\n?\n?#", '</blockquote>', $text);

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
		$text = preg_replace_callback(
			"#\[size=(\d+):{$this->uid}\]#",
			fn ($m) => '<span style="font-size:'.\Number::clamp((int) $m[1], 30, 200).'%;">',
			$text,
		);
		$text = strtr($text, ["[/size:{$this->uid}]" => '</span>']);

		return $text;
	}

	public function parseUrl($text)
	{
		$text = preg_replace("#\[url:{$this->uid}\](.+?)\[/url:{$this->uid}\]#", "<a rel='nofollow' href='\\1'>\\1</a>", $text);
		$text = preg_replace("#\[url=([^\]]+):{$this->uid}\]#", "<a rel='nofollow' href='\\1'>", $text);
		$text = str_replace("[/url:{$this->uid}]", '</a>', $text);

		return $text;
	}

	public function parseYoutube(string $text): string
	{
		return strtr($text, [
			"[youtube:{$this->uid}]" => "<iframe class='u-embed-wide u-embed-wide--bbcode' src='https://www.youtube.com/embed/",
			"[/youtube:{$this->uid}]" => "?rel=0' allowfullscreen></iframe>",
		]);
	}

	public function toHTML()
	{
		$text = $this->text;

		// block
		$text = $this->parseImagemap($text);
		$text = $this->parseBox($text);
		$text = $this->parseCode($text);
		$text = $this->parseList($text);
		$text = $this->parseNotice($text);
		$text = $this->parseQuote($text);
		$text = $this->parseHeading($text);

		// inline
		$text = $this->parseAudio($text);
		$text = $this->parseBold($text);
		$text = $this->parseCentre($text);
		$text = $this->parseRight($text);
		$text = $this->parseInlineCode($text);
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
		$text = app('clean-html')->purify($text);

		$className = class_with_modifiers('bbcode', $this->options['modifiers']);

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

		static $pattern = '#\[/?(\*|\*:m|audio|b|box|color|spoilerbox|centre|right|code|email|heading|i|img|list|list:o|list:u|notice|profile|quote|s|strike|u|spoiler|size|url|youtube)(=.*?(?=:))?(:[a-zA-Z0-9]{1,5})?\]#';

		return preg_replace($pattern, '', $text);
	}

	public static function removeBlockQuotes($text)
	{
		static $pattern = '#(?<start>\[quote(=.*?(?=:))?(:[a-zA-Z0-9]{1,5})?\])|(?<end>\[/quote(:[a-zA-Z0-9]{1,5})?\])#';

		$matchCount = preg_match_all($pattern, $text);
		$quotePositions = [];

		for ($_ = 0; $_ < $matchCount; $_++) {
			$offset = $quotePositions[count($quotePositions) - 1][1] ?? 0;
			preg_match($pattern, $text, $match, PREG_OFFSET_CAPTURE, $offset);

			if (present($match['start'][0])) {
				$quotePositions[] = [
					$match['start'][1],
					$match['start'][1] + strlen($match['start'][0]),
				];
			} elseif (!empty($quotePositions)) {
				$quoteEnd = $match['end'][1] + strlen($match['end'][0]);
				$text = substr($text, 0, array_pop($quotePositions)[0]).substr($text, $quoteEnd);
			}
		}

		return $text;
	}
}
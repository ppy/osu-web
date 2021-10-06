<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Libraries\LocaleMeta;
use App\Models\LoginAttempt;
use Illuminate\Support\HtmlString;

/*
 * Like array_search but returns null if not found instead of false.
 * Strict mode only.
 */
function array_search_null($value, $array)
{
    $key = array_search($value, $array, true);

    if ($key !== false) {
        return $key;
    }
}

function atom_id(string $namespace, $id = null): string
{
    return 'tag:'.request()->getHttpHost().',2019:'.$namespace.($id === null ? '' : "/{$id}");
}

function background_image($url, $proxy = true)
{
    if (!present($url)) {
        return '';
    }

    $url = $proxy ? proxy_media($url) : $url;

    return sprintf(' style="background-image:url(\'%s\');" ', e($url));
}

function beatmap_timestamp_format($ms)
{
    $s = $ms / 1000;
    $ms = $ms % 1000;
    $m = $s / 60;
    $s = $s % 60;

    return sprintf('%02d:%02d.%03d', $m, $s, $ms);
}

/**
 * Allows using both html-safe and non-safe text inside `{{ }}` directive.
 */
function blade_safe($html)
{
    return new Illuminate\Support\HtmlString($html);
}

/**
 * Like cache_remember_with_fallback but with a mutex that only allows a single process to run the callback.
 */
function cache_remember_mutexed(string $key, $seconds, $default, callable $callback, ?callable $exceptionHandler = null)
{
    static $oneMonthInSeconds = 30 * 24 * 60 * 60;
    $fullKey = "{$key}:with_fallback";
    $data = cache()->get($fullKey);

    if ($data === null || $data['expires_at']->isPast()) {
        $lockKey = "{$key}:lock";
        // this is arbitrary, but you've got other problems if it takes more than 5 minutes.
        // the max is because cache()->add() doesn't work so well with funny values.
        $lockTime = min(max($seconds, 60), 300);

        // only the first caller that manages to setnx runs this.
        if (cache()->add($lockKey, 1, $lockTime)) {
            try {
                $data = [
                    'expires_at' => Carbon\Carbon::now()->addSeconds($seconds),
                    'value' => $callback(),
                ];

                cache()->put($fullKey, $data, max($oneMonthInSeconds, $seconds * 10));
            } catch (Exception $e) {
                $handled = $exceptionHandler !== null && $exceptionHandler($e);

                if (!$handled) {
                    // Log and continue with data from the first ::get.
                    log_error($e);
                }
            } finally {
                cache()->forget($lockKey);
            }
        }
    }

    return $data['value'] ?? $default;
}

/**
 * Like Cache::remember but always save for one month or 10 * $seconds (whichever is longer)
 * and return old value if failed getting the value after it expires.
 */
function cache_remember_with_fallback($key, $seconds, $callback)
{
    static $oneMonthInSeconds = 30 * 24 * 60 * 60;

    $fullKey = "{$key}:with_fallback";

    $data = Cache::get($fullKey);

    if ($data === null || $data['expires_at']->isPast()) {
        try {
            $data = [
                'expires_at' => Carbon\Carbon::now()->addSeconds($seconds),
                'value' => $callback(),
            ];

            Cache::put($fullKey, $data, max($oneMonthInSeconds, $seconds * 10));
        } catch (Exception $e) {
            // Log and continue with data from the first ::get.
            log_error($e);
        }
    }

    return $data['value'] ?? null;
}

/**
 * Marks the content in the key as expired but leaves the fallback set amount of time.
 * Use with cache_remember_mutexed when the previous value needs to be shown while a key is being updated.
 *
 * @param string $key The key of the item to expire.
 * @param int $duration The duration the fallback should still remain available for, in seconds. Default: 1 month.
 * @return void
 */
function cache_expire_with_fallback(string $key, int $duration = 2592000)
{
    $fullKey = "{$key}:with_fallback";

    $data = Cache::get($fullKey);

    if ($data === null || $data['expires_at']->isPast()) {
        return;
    }

    $data['expires_at'] = now()->addHour(-1);
    Cache::put($fullKey, $data, $duration);
}

// Just normal Cache::forget but with the suffix.
function cache_forget_with_fallback($key)
{
    return Cache::forget("{$key}:with_fallback");
}

function captcha_enabled()
{
    return config('captcha.sitekey') !== '' && config('captcha.secret') !== '';
}

function captcha_triggered()
{
    if (!captcha_enabled()) {
        return false;
    }

    if (config('captcha.threshold') === 0) {
        $triggered = true;
    } else {
        $loginAttempts = LoginAttempt::find(request()->getClientIp());
        $triggered = $loginAttempts && $loginAttempts->failed_attempts >= config('captcha.threshold');
    }

    return $triggered;
}

function class_modifiers_each(array $modifiersArray, callable $callback)
{
    foreach ($modifiersArray as $modifiers) {
        if (is_array($modifiers)) {
            // either "$modifier => boolean" or "$i => $modifier|null"
            foreach ($modifiers as $k => $v) {
                if (is_bool($v)) {
                    if ($v) {
                        $callback($k);
                    }
                } elseif ($v !== null) {
                    $callback($v);
                }
            }
        } elseif (is_string($modifiers)) {
            $callback($modifiers);
        }
    }
}

function class_with_modifiers(string $className, ...$modifiersArray)
{
    $class = $className;

    class_modifiers_each($modifiersArray, function ($m) use (&$class, $className) {
        $class .= " {$className}--{$m}";
    });

    return $class;
}

function cleanup_cookies()
{
    $host = request()->getHost();

    // don't do anything for ip address access
    if (filter_var($host, FILTER_VALIDATE_IP) !== false) {
        return;
    }

    $hostParts = explode('.', $host);

    // don't do anything for single word domain
    if (count($hostParts) === 1) {
        return;
    }

    $domains = [$host, ''];

    // phpcs:ignore
    while (count($hostParts) > 1) {
        array_shift($hostParts);
        $domains[] = implode('.', $hostParts);
    }

    // remove duplicates and current session domain
    $sessionDomain = presence(ltrim(config('session.domain'), '.')) ?? '';
    $domains = array_diff(array_unique($domains), [$sessionDomain]);

    foreach (['locale', 'osu_session', 'XSRF-TOKEN'] as $key) {
        foreach ($domains as $domain) {
            cookie()->queueForget($key, null, $domain);
        }
    }
}

function css_group_colour($group)
{
    return '--group-colour: '.(optional($group)->colour ?? 'initial');
}

function css_var_2x(string $key, string $url)
{
    if (!present($url)) {
        return;
    }

    $url = e($url);
    $url2x = retinaify($url);

    return blade_safe("{$key}: url('{$url}'); {$key}-2x: url('{$url2x}')");
}

function current_locale_meta(): LocaleMeta
{
    return locale_meta(app()->getLocale());
}

function datadog_timing(callable $callable, $stat, array $tag = null)
{
    $withClockwork = app('clockwork.support')->isEnabled();

    if ($withClockwork) {
        // spaces used so clockwork doesn't run across the whole screen.
        $description = $stat
                       .' '.($tag['type'] ?? null)
                       .' '.($tag['index'] ?? null);

        clock()->event($description)->start();
    }

    $start = microtime(true);

    $result = $callable();

    if ($withClockwork) {
        clock()->event($description)->end();
    }

    $duration = microtime(true) - $start;
    Datadog::microtiming($stat, $duration, 1, $tag);

    return $result;
}

function db_unsigned_increment($column, $count)
{
    if ($count >= 0) {
        $value = "{$column} + {$count}";
    } else {
        $change = -$count;
        $value = "IF({$column} < {$change}, 0, {$column} - {$change})";
    }

    return DB::raw($value);
}

function default_mode()
{
    return optional(auth()->user())->playmode ?? 'osu';
}

function flag_url($countryCode)
{
    $chars = str_split($countryCode);
    $hexEmojiChars = array_map(fn ($chr) => dechex(mb_ord($chr) + 127397), $chars);
    $baseFileName = implode('-', $hexEmojiChars);

    return "/assets/images/flags/{$baseFileName}.svg";
}

function get_valid_locale($requestedLocale)
{
    if (in_array($requestedLocale, config('app.available_locales'), true)) {
        return $requestedLocale;
    }
}

function html_entity_decode_better($string)
{
    // ENT_HTML5 to handle more named entities (&apos;, etc?).
    return html_entity_decode($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function html_excerpt($body, $limit = 300)
{
    $body = html_entity_decode_better(replace_tags_with_spaces($body));

    return e(truncate($body, $limit));
}

function img2x(array $attributes)
{
    if (!present($attributes['src'] ?? null)) {
        return;
    }

    $src2x = retinaify($attributes['src']);
    $attributes['srcset'] = "{$attributes['src']} 1x, {$src2x} 1.5x";

    return tag('img', $attributes);
}

function locale_meta(string $locale): LocaleMeta
{
    return LocaleMeta::find($locale);
}

function trim_unicode(?string $value)
{
    return preg_replace('/(^\s+|\s+$)/u', '', $value);
}

function truncate(string $text, $limit = 100, $ellipsis = '...')
{
    if (mb_strlen($text) > $limit) {
        return mb_substr($text, 0, $limit - mb_strlen($ellipsis)).$ellipsis;
    }

    return $text;
}

function json_date(?DateTime $date): ?string
{
    return $date === null ? null : $date->format('Y-m-d');
}

function json_time(?DateTime $time): ?string
{
    return $time === null ? null : $time->format(DateTime::ATOM);
}

function log_error($exception)
{
    Log::error($exception);

    if (config('sentry.dsn')) {
        Sentry::captureException($exception);
    }
}

function logout()
{
    $guard = auth()->guard();
    if ($guard instanceof Illuminate\Contracts\Auth\StatefulGuard) {
        $guard->logout();
    }

    // FIXME: Temporarily here for cross-site login, nuke after old site is... nuked.
    foreach (['phpbb3_2cjk5_sid', 'phpbb3_2cjk5_sid_check'] as $key) {
        foreach (['ppy.sh', 'osu.ppy.sh', ''] as $domain) {
            cookie()->queueForget($key, null, $domain);
        }
    }

    cleanup_cookies();

    session()->invalidate();
}

function markdown($input, $preset = 'default')
{
    static $converter;

    App\Libraries\Markdown\OsuMarkdown::PRESETS[$preset] ?? $preset = 'default';

    if (!isset($converter[$preset])) {
        $converter[$preset] = new App\Libraries\Markdown\OsuMarkdown($preset);
    }

    return $converter[$preset]->load($input)->html();
}

function markdown_plain($input)
{
    static $converter;

    if (!isset($converter)) {
        $converter = new League\CommonMark\CommonMarkConverter([
            'allow_unsafe_links' => false,
            'html_input' => 'escape',
        ]);
    }

    return $converter->convertToHtml($input)->getContent();
}

function max_offset($page, $limit)
{
    $offset = ($page - 1) * $limit;

    return max(0, min($offset, config('osu.pagination.max_count') - $limit));
}

function mysql_escape_like($string)
{
    return addcslashes($string, '%_\\');
}

function oauth_token(): ?App\Models\OAuth\Token
{
    return request()->attributes->get(App\Http\Middleware\AuthApi::REQUEST_OAUTH_TOKEN_KEY);
}

function osu_trans($key = null, $replace = [], $locale = null)
{
    $translator = app('translator');

    if (is_null($key)) {
        return $translator;
    }

    if (!trans_exists($key, $locale)) {
        $locale = config('app.fallback_locale');
    }

    return $translator->get($key, $replace, $locale, false);
}

function osu_trans_choice($key, $number, array $replace = [], $locale = null)
{
    if (!trans_exists($key, $locale)) {
        $locale = config('app.fallback_locale');
    }

    if (is_array($number) || $number instanceof Countable) {
        $number = count($number);
    }

    if (!isset($replace['count_delimited'])) {
        $replace['count_delimited'] = i18n_number_format($number, null, null, null, $locale);
    }

    return app('translator')->choice($key, $number, $replace, $locale);
}

function osu_url($key)
{
    $url = config("osu.urls.{$key}");

    if (($url[0] ?? null) === '/') {
        $url = config('osu.urls.base').$url;
    }

    return $url;
}

function pack_str($str)
{
    return pack('ccH*', 0x0b, strlen($str), bin2hex($str));
}

function pagination($params, $defaults = null)
{
    $limit = clamp(get_int($params['limit'] ?? null) ?? $defaults['limit'] ?? 20, 5, 50);
    $page = max(get_int($params['page'] ?? null) ?? 1, 1);

    $offset = max_offset($page, $limit);
    $page = 1 + $offset / $limit;

    return compact('limit', 'page', 'offset');
}

function param_string_simple($value)
{
    if (is_array($value)) {
        $value = implode(',', $value);
    }

    return presence($value);
}

function product_quantity_options($product, $selected = null)
{
    if ($product->stock === null) {
        $max = $product->max_quantity;
    } else {
        $max = min($product->max_quantity, $product->stock);
    }

    $opts = [];
    for ($i = 1; $i <= $max; $i++) {
        $opts[$i] = osu_trans_choice('common.count.item', $i);
    }

    // include selected value separately if it's out of range.
    if ($selected > $max) {
        $opts[$selected] = osu_trans_choice('common.count.item', $selected);
    }

    return $opts;
}

function read_image_properties($path)
{
    try {
        $data = getimagesize($path);
    } catch (Exception $_e) {
        return;
    }

    if ($data !== false) {
        return $data;
    }
}

function read_image_properties_from_string($string)
{
    try {
        $data = getimagesizefromstring($string);
    } catch (Exception $_e) {
        return;
    }

    if ($data !== false) {
        return $data;
    }
}

// use this instead of strip_tags when <br> and <p> need to be converted to space
function replace_tags_with_spaces($body)
{
    return preg_replace('#<[^>]+>#', ' ', $body);
}

function request_country($request = null)
{
    return $request === null
        ? Request::header('CF_IPCOUNTRY')
        : $request->header('CF_IPCOUNTRY');
}

function require_login($text_key, $link_text_key)
{
    $title = osu_trans('users.anonymous.login_link');
    $link = Html::link('#', osu_trans($link_text_key), ['class' => 'js-user-link', 'title' => $title]);
    $text = osu_trans($text_key, ['link' => $link]);

    return $text;
}

function spinner(?array $modifiers = null)
{
    return tag('div', [
        'class' => class_with_modifiers('la-ball-clip-rotate', $modifiers),
    ]);
}

function strip_utf8_bom($input)
{
    if (substr($input, 0, 3) === "\xEF\xBB\xBF") {
        return substr($input, 3);
    }

    return $input;
}

function tag($element, $attributes = [], $content = null)
{
    $attributeString = '';

    foreach ($attributes ?? [] as $key => $value) {
        $attributeString .= ' '.$key.'="'.e($value).'"';
    }

    return '<'.$element.$attributeString.'>'.($content ?? '').'</'.$element.'>';
}

function to_sentence($array, $key = 'common.array_and')
{
    switch (count($array)) {
        case 0:
            return '';
        case 1:
            return (string) $array[0];
        case 2:
            return implode(osu_trans("{$key}.two_words_connector"), $array);
        default:
            return implode(osu_trans("{$key}.words_connector"), array_slice($array, 0, -1)).osu_trans("{$key}.last_word_connector").array_last($array);
    }
}

// Handles case where crowdin fills in untranslated key with empty string.
function trans_exists($key, $locale)
{
    $translated = app('translator')->get($key, [], $locale, false);

    return present($translated) && $translated !== $key;
}

function obscure_email($email)
{
    $email = explode('@', $email);

    if (!present($email[0]) || !present($email[1] ?? null)) {
        return '<unknown>';
    }

    return mb_substr($email[0], 0, 1).'***'.'@'.$email[1];
}

function countries_array_for_select()
{
    $out = [];

    foreach (App\Models\Country::forStore()->get() as $country) {
        if (!isset($lastDisplay)) {
            $lastDisplay = $country->display;
        } elseif ($lastDisplay !== $country->display) {
            $out['_disabled'] = '---';
        }
        $out[$country->acronym] = $country->name;
    }

    return $out;
}

function currency($price, $precision = 2, $zeroShowFree = true)
{
    $price = round($price, $precision);
    if ($price === 0.00 && $zeroShowFree) {
        return 'free!';
    }

    return 'US$'.i18n_number_format($price, null, null, $precision);
}

/**
 * Compares 2 money values from payment processor in a sane manner.
 * i.e. not a float.
 *
 * @param $a money value A
 * @param $b money value B
 * @return 0 if equal, 1 if $a > $b, -1 if $a < $b
 */
function compare_currency($a, $b)
{
    return (int) ($a * 100) <=> (int) ($b * 100);
}

function error_popup($message, $statusCode = 422)
{
    return response(['error' => $message], $statusCode);
}

function ext_view($view, $data = null, $type = null, $status = null)
{
    static $types = [
        'atom' => 'application/atom+xml',
        'html' => 'text/html',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'rss' => 'application/rss+xml',
    ];

    return response()->view(
        $view,
        $data ?? [],
        $status ?? 200,
        ['Content-Type' => $types[$type ?? 'html']]
    );
}

function from_app_url()
{
    // Add trailing slash so people can't just use https://osu.web.domain.com
    // to bypass https://osu.web referrer check.
    // This assumes app.url doesn't contain trailing slash.
    return starts_with(request()->headers->get('referer'), config('app.url').'/');
}

function is_api_request()
{
    return request()->is('api/*');
}

function is_json_request()
{
    return is_api_request() || request()->expectsJson();
}

function is_sql_unique_exception($ex)
{
    return starts_with(
        $ex->getMessage(),
        'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry'
    );
}

function js_localtime($date)
{
    $formatted = json_time($date);

    return "<time class='js-localtime' datetime='{$formatted}'>{$formatted}</time>";
}

function page_description($extra)
{
    $parts = ['osu!', page_title()];

    if (present($extra)) {
        $parts[] = $extra;
    }

    return blade_safe(implode(' » ', array_map('e', $parts)));
}

function page_title()
{
    $currentRoute = app('route-section')->getCurrent();
    $checkLocale = config('app.fallback_locale');
    $keys = [
        "page_title.{$currentRoute['namespace']}.{$currentRoute['controller']}.{$currentRoute['action']}",
        "page_title.{$currentRoute['namespace']}.{$currentRoute['controller']}._",
        "page_title.{$currentRoute['namespace']}._",
    ];

    foreach ($keys as $key) {
        if (trans_exists($key, $checkLocale)) {
            return osu_trans($key);
        }
    }

    return 'unknown';
}

function ujs_redirect($url, $status = 200)
{
    if (Request::ajax() && !Request::isMethod('get')) {
        return ext_view('layout.ujs-redirect', compact('url'), 'js', $status);
    } else {
        if (Request::header('Turbolinks-Referrer')) {
            Request::session()->put('_turbolinks_location', $url);
        }

        // because non-3xx redirects make no sense.
        if ($status < 300 || $status > 399) {
            $status = 302;
        }

        return redirect($url, $status);
    }
}

// strips combining characters after x levels deep
function unzalgo(?string $text, int $level = 2)
{
    return preg_replace("/(\pM{{$level}})\pM+/u", '\1', $text);
}

function route_redirect($path, $target, string $method = 'get')
{
    return Route::$method($path, '\App\Http\Controllers\RedirectController')->name("redirect:{$target}");
}

function timeago($date)
{
    $formatted = json_time($date);

    return "<time class='js-timeago' datetime='{$formatted}'>{$formatted}</time>";
}

function link_to_user($id, $username = null, $color = null, $classNames = null)
{
    if ($id instanceof App\Models\User) {
        $username ?? ($username = $id->username);
        $color ?? ($color = $id->user_colour);
        $id = $id->getKey();
    }
    $id = e($id);
    $username = e($username);
    $style = user_color_style($color, 'color');

    if ($classNames === null) {
        $classNames = ['user-name'];
    }

    $class = implode(' ', $classNames);

    if ($id === null) {
        return "<span class='{$class}'>{$username}</span>";
    } else {
        $class .= ' js-usercard';
        // FIXME: remove `rawurlencode` workaround when fixed upstream.
        // Reference: https://github.com/laravel/framework/issues/26715
        $url = e(route('users.show', rawurlencode($id)));

        return "<a class='{$class}' data-user-id='{$id}' href='{$url}' style='{$style}'>{$username}</a>";
    }
}

function issue_icon($issue)
{
    switch ($issue) {
        case 'added':
            return 'fas fa-cogs';
        case 'assigned':
            return 'fas fa-user';
        case 'confirmed':
            return 'fas fa-exclamation-triangle';
        case 'resolved':
            return 'far fa-check-circle';
        case 'duplicate':
            return 'fas fa-copy';
        case 'invalid':
            return 'far fa-times-circle';
    }
}

function build_url($build)
{
    return route('changelog.build', [optional($build->updateStream)->name ?? 'unknown', $build->version]);
}

function post_url($topicId, $postId, $jumpHash = true, $tail = false)
{
    $postIdParamKey = 'start';
    if ($tail === true) {
        $postIdParamKey = 'end';
    }

    if ($topicId === null) {
        return;
    }

    $url = route('forum.topics.show', ['topic' => $topicId, $postIdParamKey => $postId]);

    return $url;
}

function wiki_url($path = null, $locale = null, $api = null, $fullUrl = true)
{
    $path = $path === null ? 'Main_Page' : str_replace(['%2F', '%23'], ['/', '#'], rawurlencode($path));

    $params = [
        'path' => 'WIKI_PATH',
        'locale' => $locale ?? App::getLocale(),
    ];

    if ($path === 'Sitemap') {
        return route('wiki.sitemap', $params['locale'], $fullUrl);
    }

    if (starts_with("{$path}/", 'Legal/')) {
        $path = ltrim(substr($path, strlen('Legal')), '/');
        $route = 'legal';
    } else {
        $route = 'wiki.show';
    }

    if ($api ?? is_api_request()) {
        $route = 'api.'.$route;
    }

    return rtrim(str_replace($params['path'], $path, route($route, $params, $fullUrl)), '/');
}

function bbcode($text, $uid, $options = [])
{
    return (new App\Libraries\BBCodeFromDB($text, $uid, $options))->toHTML();
}

function bbcode_for_editor($text, $uid = null)
{
    return (new App\Libraries\BBCodeFromDB($text, $uid))->toEditor();
}

function concat_path($paths)
{
    return implode('/', array_filter($paths, 'present'));
}

function proxy_media($url)
{
    if (!present($url)) {
        return '';
    }

    $url = html_entity_decode_better($url);

    if (config('osu.camo.key') === null) {
        return $url;
    }

    $isProxied = starts_with($url, config('osu.camo.prefix'));

    if ($isProxied) {
        return $url;
    }

    // turn relative urls into absolute urls
    if (!preg_match('/^https?\:\/\//', $url)) {
        // ensure url is relative to the site root
        if ($url[0] !== '/') {
            $url = "/{$url}";
        }
        $url = config('app.url').$url;
    }


    $hexUrl = bin2hex($url);
    $secret = hash_hmac('sha1', $url, config('osu.camo.key'));

    return config('osu.camo.prefix')."{$secret}/{$hexUrl}";
}

function lazy_load_image($url, $class = '', $alt = '')
{
    $url = e($url);

    return "<img class='{$class}' src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' data-normal='{$url}' alt='{$alt}' />";
}

function nav_links()
{
    $defaultMode = default_mode();
    $links = [];

    $links['home'] = [
        '_' => route('home'),
        'page_title.main.news_controller._' => route('news.index'),
        'layout.menu.home.team' => wiki_url('Team'),
        'page_title.main.changelog_controller._' => route('changelog.index'),
        'page_title.main.home_controller.get_download' => route('download'),
        'page_title.main.home_controller.search' => route('search'),
    ];
    $links['beatmaps'] = [
        'page_title.main.beatmapsets_controller.index' => route('beatmapsets.index'),
        'page_title.main.artists_controller._' => route('artists.index'),
        'page_title.main.beatmap_packs_controller._' => route('packs.index'),
    ];
    $links['rankings'] = [
        'rankings.type.performance' => route('rankings', ['mode' => $defaultMode, 'type' => 'performance']),
        'rankings.type.charts' => route('rankings', ['mode' => $defaultMode, 'type' => 'charts']),
        'rankings.type.score' => route('rankings', ['mode' => $defaultMode, 'type' => 'score']),
        'rankings.type.country' => route('rankings', ['mode' => $defaultMode, 'type' => 'country']),
        'rankings.type.multiplayer' => route('multiplayer.rooms.show', ['room' => 'latest']),
        'layout.menu.rankings.kudosu' => osu_url('rankings.kudosu'),
    ];
    $links['community'] = [
        'page_title.forum._' => route('forum.forums.index'),
        'page_title.main.chat_controller._' => route('chat.index'),
        'page_title.main.contests_controller._' => route('contests.index'),
        'page_title.main.tournaments_controller._' => route('tournaments.index'),
        'page_title.main.livestreams_controller._' => route('livestreams.index'),
        'layout.menu.community.dev' => osu_url('dev'),
    ];
    $links['store'] = [
        'layout.header.store.products' => route('store.products.index'),
        'layout.header.store.cart' => route('store.cart.show'),
        'layout.header.store.orders' => route('store.orders.index'),
    ];
    $links['help'] = [
        'page_title.main.wiki_controller._' => wiki_url('Main_Page'),
        'layout.menu.help.getFaq' => wiki_url('FAQ'),
        'layout.menu.help.getRules' => wiki_url('Rules'),
        'layout.menu.help.getAbuse' => wiki_url('Reporting_Bad_Behaviour/Abuse'),
        'layout.menu.help.getSupport' => wiki_url('Help_Centre'),
    ];

    return $links;
}

function footer_landing_links()
{
    return [
        'general' => [
            'home' => route('home'),
            'changelog-index' => route('changelog.index'),
            'beatmaps' => action('BeatmapsetsController@index'),
            'download' => route('download'),
        ],
        'help' => [
            'faq' => wiki_url('FAQ'),
            'forum' => route('forum.forums.index'),
            'livestreams' => route('livestreams.index'),
            'wiki' => wiki_url('Main_Page'),
        ],
        'legal' => footer_legal_links(),
    ];
}

function footer_legal_links()
{
    $locale = app()->getLocale();

    return [
        'terms' => route('legal', ['locale' => $locale, 'path' => 'Terms']),
        'privacy' => route('legal', ['locale' => $locale, 'path' => 'Privacy']),
        'copyright' => route('legal', ['locale' => $locale, 'path' => 'Copyright']),
        'server_status' => osu_url('server_status'),
        'source_code' => osu_url('source_code'),
    ];
}

function presence($string, $valueIfBlank = null)
{
    return present($string) ? $string : $valueIfBlank;
}

function present($string)
{
    return $string !== null && $string !== '';
}

function user_color_style($color, $style)
{
    if (!present($color)) {
        return '';
    }

    return sprintf('%s: %s', $style, e($color));
}

function base62_encode($input)
{
    $numbers = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $base = strlen($numbers);

    $output = '';
    $remaining = $input;

    do {
        $output = $numbers[$remaining % $base].$output;
        $remaining = floor($remaining / $base);
    } while ($remaining > 0);

    return $output;
}

function display_regdate($user)
{
    if ($user->user_regdate === null) {
        return;
    }

    $tooltipDate = i18n_date($user->user_regdate);

    $formattedDate = i18n_date($user->user_regdate, null, 'year_month');

    if ($user->user_regdate < Carbon\Carbon::createFromDate(2008, 1, 1)) {
        return '<div title="'.$tooltipDate.'">'.osu_trans('users.show.first_members').'</div>';
    }

    return osu_trans('users.show.joined_at', [
        'date' => "<strong title='{$tooltipDate}'>{$formattedDate}</strong>",
    ]);
}

function i18n_date($datetime, $format = IntlDateFormatter::LONG, $pattern = null)
{
    $formatter = IntlDateFormatter::create(
        App::getLocale(),
        $format,
        IntlDateFormatter::NONE
    );

    if ($pattern !== null) {
        $formatter->setPattern(osu_trans("common.datetime.{$pattern}.php"));
    }

    return $formatter->format($datetime);
}

function i18n_number_format($number, $style = null, $pattern = null, $precision = null, $locale = null)
{
    $formatter = NumberFormatter::create(
        $locale ?? App::getLocale(),
        $style ?? NumberFormatter::DEFAULT_STYLE,
        $pattern
    );

    if ($precision !== null) {
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
    }

    return $formatter->format($number);
}

function open_image($path, $dimensions = null)
{
    if ($dimensions === null) {
        $dimensions = read_image_properties($path);
    }

    if (!isset($dimensions[2]) || !is_int($dimensions[2])) {
        return;
    }

    try {
        $image = null;

        switch ($dimensions[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($path);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($path);
                break;
        }

        if ($image !== false) {
            return $image;
        }
    } catch (ErrorException $_e) {
        // do nothing
    }
}

function json_collection($model, $transformer, $includes = null)
{
    $manager = new League\Fractal\Manager(new App\Libraries\Transformers\ScopeFactory());
    if ($includes !== null) {
        $manager->parseIncludes($includes);
    }
    $manager->setSerializer(new App\Serializers\ApiSerializer());

    // da bess
    if (is_string($transformer)) {
        $transformer = 'App\Transformers\\'.str_replace('/', '\\', $transformer).'Transformer';
        $transformer = new $transformer();
    }

    // we're using collection instead of item here, so we can peek at the items beforehand
    $collection = new League\Fractal\Resource\Collection($model, $transformer);

    return $manager->createData($collection)->toArray();
}

function json_item($model, $transformer, $includes = null)
{
    return json_collection([$model], $transformer, $includes)[0] ?? null;
}

function fast_imagesize($url)
{
    $result = Cache::remember("imageSize:{$url}", Carbon\Carbon::now()->addMonth(1), function () use ($url) {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                'Range: bytes=0-32768',
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
        ]);
        $data = curl_exec($curl);
        curl_close($curl);

        $result = read_image_properties_from_string($data);

        if ($result === null) {
            return false;
        } else {
            return $result;
        }
    });

    if ($result !== false) {
        return $result;
    }
}

function get_arr($input, $callback = null)
{
    if (is_array($input)) {
        if ($callback === null) {
            return $input;
        }

        $result = [];
        foreach ($input as $value) {
            $casted = call_user_func($callback, $value);

            if ($casted !== null) {
                $result[] = $casted;
            }
        }

        return $result;
    }
}

function get_bool($string)
{
    if (is_bool($string)) {
        return $string;
    } elseif ($string === 1 || $string === '1' || $string === 'on' || $string === 'true') {
        return true;
    } elseif ($string === 0 || $string === '0' || $string === 'false') {
        return false;
    }
}

/*
 * Parses a string. If it's not an empty string or null,
 * return parsed float value of it, otherwise return null.
 */
function get_float($string)
{
    if (present($string) && is_scalar($string)) {
        return (float) $string;
    }
}

/*
 * Parses a string. If it's not an empty string or null,
 * return parsed integer value of it, otherwise return null.
 */
function get_int($string)
{
    if (present($string) && is_scalar($string)) {
        return (int) $string;
    }
}

function get_length($string): ?array
{
    static $scales = [
        'ms' => 0.001,
        's' => 1,
        'm' => 60,
        'h' => 3600,
    ];

    $string = get_string($string);

    if ($string === null) {
        return null;
    }

    $scaleKey = substr($string, -2);

    if (!isset($scales[$scaleKey])) {
        $scaleKey = substr($scaleKey, -1);
    }

    if (!isset($scales[$scaleKey])) {
        $scaleKey = 's';
        $string .= $scaleKey;
    }

    $value = get_float(substr($string, 0, -strlen($scaleKey)));

    if ($value === null) {
        return null;
    }

    $scale = $scales[$scaleKey] ?? 1;
    $value *= $scale;

    return [
        'scale' => $scale,
        'value' => $value,
    ];
}

function get_file($input)
{
    if ($input instanceof Symfony\Component\HttpFoundation\File\UploadedFile) {
        return $input->getRealPath();
    }
}

function get_string($input)
{
    if (is_scalar($input)) {
        return (string) $input;
    }
}

function get_string_split($input)
{
    return get_arr(explode("\r\n", get_string($input)), function ($item) {
        return presence(trim_unicode($item));
    });
}

function get_class_basename($className)
{
    return substr($className, strrpos($className, '\\') + 1);
}

function get_class_namespace($className)
{
    return substr($className, 0, strrpos($className, '\\'));
}

function get_model_basename($model)
{
    if (!is_string($model)) {
        $model = get_class($model);
    }

    return str_replace('\\', '', snake_case(substr($model, strlen('App\\Models\\'))));
}

function ci_file_search($fileName)
{
    if (file_exists($fileName)) {
        return is_file($fileName) ? $fileName : false;
    }

    $directoryName = dirname($fileName);
    $fileArray = glob($directoryName.'/*', GLOB_NOSORT);
    $fileNameLowerCase = strtolower($fileName);
    foreach ($fileArray as $file) {
        if (strtolower($file) === $fileNameLowerCase) {
            return is_file($file) ? $file : false;
        }
    }

    return false;
}

function sanitize_filename($file)
{
    $file = mb_ereg_replace('[^\w\s\d\-_~,;\[\]\(\).]', '', $file);
    $file = mb_ereg_replace('[\.]{2,}', '.', $file);

    return $file;
}

function deltree($dir)
{
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        is_dir("$dir/$file") ? deltree("$dir/$file") : unlink("$dir/$file");
    }

    return rmdir($dir);
}

function get_param_value($input, $type)
{
    switch ($type) {
        case 'any':
            return $input;
        case 'array':
            return get_arr($input);
        case 'bool':
            return get_bool($input);
        case 'int':
            return get_int($input);
        case 'file':
            return get_file($input);
        case 'float':
            return get_float($input);
        case 'length':
            return get_length($input);
        case 'string':
            return get_string($input);
        case 'string_split':
            return get_string_split($input);
        case 'string[]':
            return get_arr($input, 'get_string');
        case 'int[]':
            return get_arr($input, 'get_int');
        case 'time':
            return parse_time_to_carbon($input);
        default:
            return presence(get_string($input));
    }
}

function get_params($input, $namespace, $keys, $options = [])
{
    if ($namespace !== null) {
        $input = array_get($input, $namespace);
    }

    $params = [];

    if (is_array($input) || ($input instanceof ArrayAccess)) {
        $options['null_missing'] = $options['null_missing'] ?? false;

        foreach ($keys as $keyAndType) {
            $keyAndType = explode(':', $keyAndType);

            $key = $keyAndType[0];
            $type = $keyAndType[1] ?? null;

            if (array_has($input, $key)) {
                $value = get_param_value(array_get($input, $key), $type);
                array_set($params, $key, $value);
            } else {
                if ($options['null_missing']) {
                    array_set($params, $key, null);
                }
            }
        }
    }

    return $params;
}

function array_rand_val($array)
{
    if ($array instanceof Illuminate\Support\Collection) {
        $array = $array->all();
    }

    if (count($array) === 0) {
        return;
    }

    return $array[array_rand($array)];
}

/**
 * Just like original builder's "pluck" but with actual casting.
 * I mean "lists" in 5.1 which then replaced by replaced "pluck"
 * function. I mean, they deprecated the "pluck" function in 5.1
 * and then goes on changing what the function does.
 *
 * If need to pluck for all rows, just call `select()` on the class.
 */
function model_pluck($builder, $key, $class = null)
{
    if ($class) {
        $selectKey = (new $class())->qualifyColumn($key);
    }

    $result = [];

    foreach ($builder->select($selectKey ?? $key)->get() as $el) {
        $result[] = $el->$key;
    }

    return $result;
}

/*
 * Returns null if $timestamp is null or 0.
 * Used for table which has not null constraints but accepts "empty" value (0).
 */
function get_time_or_null($timestamp)
{
    if ($timestamp !== 0) {
        return parse_time_to_carbon($timestamp);
    }
}

/*
 * Get unix timestamp of a DateTime (or Carbon\Carbon).
 * Returns 0 if $time is null so mysql doesn't explode because of not null
 * constraints.
 */
function get_timestamp_or_zero(DateTime $time = null): int
{
    return $time === null ? 0 : $time->getTimestamp();
}

function parse_time_to_carbon($value)
{
    if (!present($value)) {
        return;
    }

    if (is_numeric($value)) {
        return Carbon\Carbon::createFromTimestamp($value);
    }

    if (is_string($value)) {
        try {
            return Carbon\Carbon::parse($value);
        } catch (Exception $_e) {
            return;
        }
    }

    if ($value instanceof Carbon\Carbon) {
        return $value;
    }

    if ($value instanceof DateTime) {
        return Carbon\Carbon::instance($value);
    }
}

function format_duration_for_display($seconds)
{
    return floor($seconds / 60).':'.str_pad($seconds % 60, 2, '0', STR_PAD_LEFT);
}

// Converts a standard image url to a retina one
// e.g. https://local.host/test.jpg -> https://local.host/test@2x.jpg
function retinaify($url)
{
    return preg_replace('/(\.[^.]+)$/', '@2x\1', $url);
}

function priv_check($ability, $object = null)
{
    return priv_check_user(Auth::user(), $ability, $object);
}

function priv_check_user($user, $ability, $object = null)
{
    return app()->make('OsuAuthorize')->doCheckUser($user, $ability, $object);
}

// Used to generate x,y pairs for fancy-chart.coffee
function array_to_graph_json(array &$array, $property_to_use)
{
    $index = 0;

    return array_map(function ($e) use (&$index, $property_to_use) {
        return [
            'x' => $index++,
            'y' => $e[$property_to_use],
        ];
    }, $array);
}

// Fisher-Yates
function seeded_shuffle(array &$items, int $seed = 0)
{
    mt_srand($seed);
    for ($i = count($items) - 1; $i > 0; $i--) {
        $j = mt_rand(0, $i);
        $tmp = $items[$i];
        $items[$i] = $items[$j];
        $items[$j] = $tmp;
    }
    mt_srand();
}

function first_paragraph($html, $split_on = "\n")
{
    $text = strip_tags($html);
    $match_pos = strpos($text, $split_on);

    return $match_pos === false ? $text : substr($text, 0, $match_pos);
}

function build_icon($prefix)
{
    switch ($prefix) {
        case 'add':
            return 'plus';
        case 'fix':
            return 'wrench';
        case 'misc':
            return 'question';
    }
}

// clamps $number to be between $min and $max
function clamp($number, $min, $max)
{
    return min($max, max($min, $number));
}

// e.g. 100634983048665 -> 100.63 trillion
function suffixed_number_format($number)
{
    $suffixes = ['', 'k', 'million', 'billion', 'trillion']; // TODO: localize
    $k = 1000;

    if ($number < $k) {
        return $number;
    }

    $i = floor(log($number) / log($k));

    return number_format($number / pow($k, $i), 2).' '.$suffixes[$i];
}

function suffixed_number_format_tag($number)
{
    return "<span title='".i18n_number_format($number)."'>".suffixed_number_format($number).'</span>';
}

// formats a number as a percentage with a fixed number of precision
// e.g.: 98.3 -> 98.30%
function format_percentage($number, $precision = 2)
{
    // the formatter assumes decimal number while the function receives percentage number.
    return i18n_number_format($number / 100, NumberFormatter::PERCENT, null, $precision);
}

function group_users_by_online_state($users)
{
    $online = $offline = [];

    foreach ($users as $user) {
        if ($user->isOnline()) {
            $online[] = $user;
        } else {
            $offline[] = $user;
        }
    }

    return [
        'online' => $online,
        'offline' => $offline,
    ];
}

// shorthand to return the filename of an open stream/handle
function get_stream_filename($handle)
{
    $meta = stream_get_meta_data($handle);

    return $meta['uri'];
}

// Performs a HEAD request to the given url and checks the http status code.
// Returns true on status 200, otherwise false (note: doesn't support redirects/etc)
function check_url(string $url): bool
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
    ]);
    curl_exec($ch);

    $errored = curl_errno($ch) > 0 || curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200;
    curl_close($ch);

    return !$errored;
}

function mini_asset(string $url): string
{
    return str_replace(config('filesystems.disks.s3.base_url'), config('filesystems.disks.s3.mini_url'), $url);
}

function section_to_hue_map($section): int
{
    static $colourToHue = [
        'blue' => 200,
        'darkorange' => 20,
        'green' => 115,
        'orange' => 45,
        'pink' => 333,
        'purple' => 255,
        'red' => 0,
    ];

    static $sectionMapping = [
        'admin' => 'red',
        'beatmaps' => 'blue',
        'community' => 'pink',
        'error' => 'pink',
        'help' => 'orange',
        'home' => 'purple',
        'multiplayer' => 'pink',
        'rankings' => 'green',
        'store' => 'darkorange',
        'user' => 'pink',
    ];

    return isset($sectionMapping[$section]) ? $colourToHue[$sectionMapping[$section]] : $colourToHue['pink'];
}

function search_error_message(?Exception $e): ?string
{
    if ($e === null) {
        return null;
    }

    $basename = snake_case(get_class_basename(get_class($e)));
    $key = "errors.search.${basename}";
    $text = osu_trans($key);

    return $text === $key ? osu_trans('errors.search.default') : $text;
}

/**
 * Gets the path to a versioned resource.
 *
 * @param string $resource
 * @param string $manifest
 * @return HtmlString
 *
 * @throws Exception
 */
function unmix(string $resource)
{
    return app('assets-manifest')->src($resource);
}

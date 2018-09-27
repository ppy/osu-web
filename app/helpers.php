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

function background_image($url, $proxy = true)
{
    if (!present($url)) {
        return '';
    }

    $url = $proxy ? proxy_image($url) : $url;

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
 * Like Cache::remember but always save for one month or 10 * $minutes (whichever is longer)
 * and return old value if failed getting the value after it expires.
 */
function cache_remember_with_fallback($key, $minutes, $callback)
{
    static $oneMonthInMinutes = 30 * 24 * 60;

    $fullKey = "{$key}:with_fallback";

    $data = Cache::get($fullKey);

    if ($data === null || $data['expires_at']->isPast()) {
        try {
            $data = [
                'expires_at' => Carbon\Carbon::now()->addMinutes($minutes),
                'value' => $callback(),
            ];

            Cache::put($fullKey, $data, max($oneMonthInMinutes, $minutes * 10));
        } catch (Exception $e) {
            // Log and continue with data from the first ::get.
            log_error($e);
        }
    }

    return $data['value'] ?? null;
}

// Just normal Cache::forget but with the suffix.
function cache_forget_with_fallback($key)
{
    return Cache::forget("{$key}:with_fallback");
}

function datadog_timing(callable $callable, $stat, array $tag = null)
{
    $uid = uniqid($stat);
    // spaces used so clockwork doesn't run across the whole screen.
    $description = $stat
                   .' '.($tag['type'] ?? null)
                   .' '.($tag['index'] ?? null);

    $start = microtime(true);

    clock()->startEvent($uid, $description);
    $result = $callable();
    clock()->endEvent($uid);

    if (config('datadog-helper.enabled')) {
        $duration = microtime(true) - $start;
        Datadog::microtiming($stat, $duration, 1, $tag);
    }

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

function es_query_and_words($words)
{
    $parts = preg_split("/\s+/", $words, null, PREG_SPLIT_NO_EMPTY);

    if (empty($parts)) {
        return;
    }

    $partsEscaped = [];

    foreach ($parts as $part) {
        $partsEscaped[] = str_replace('-', '%2D', urlencode(strtolower($part)));
    }

    return implode(' AND ', $partsEscaped);
}

/*
 * Remove some (but not all) elasticsearch reserved characters.
 * Those characters seem to be ignored anyway even escaped so might as well
 * just remove them. Note that double quotes are not escaped so they can be
 * used for "exact" match. As a result, this doesn't always produce
 * valid query. The execution must be wrapped within a try/catch.
 *
 * This also doesn't add keyword (OR/AND). Elasticsearch default is OR.
 *
 * Reference: https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-query-string-query.html
 */
function es_query_escape_with_caveats($query)
{
    return str_replace(
        ['+', '-', '=', '&&', '||', '>', '<', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '\\', '/'],
        [' ', ' ', ' ', '  ', '  ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '  ', ' '],
        $query
    );
}

/**
 * Takes an Elasticsearch resultset and retrieves the matching models from the database,
 *  returning them in the same order as the Elasticsearch results.
 *
 *
 * @param $results Elasticsesarch results.
 * @param $class Class name of the model.
 * @return array Records matching the Elasticsearch results.
 */
function es_records($results, $class)
{
    $keyName = (new $class())->getKeyName();

    $hits = $results['hits']['hits'];
    $ids = [];
    foreach ($hits as $hit) {
        $ids[] = $hit['_id'];
    }

    $query = $class::whereIn($keyName, $ids);
    $keyed = [];
    foreach ($query->get() as $result) {
        // save for lookup.
        $keyed[$result->user_id] = $result;
    }

    // match records with elasticsearch results.
    $records = [];
    foreach ($ids as $id) {
        if (isset($keyed[$id])) {
            $records[] = $keyed[$id];
        }
    }

    return $records;
}

function flag_path($country)
{
    return '/images/flags/'.$country.'.png';
}

function get_valid_locale($requestedLocale)
{
    if (in_array($requestedLocale, config('app.available_locales'), true)) {
        return $requestedLocale;
    }

    return array_first(
        config('app.available_locales'),
        function ($value) use ($requestedLocale) {
            return starts_with($requestedLocale, $value);
        },
        config('app.fallback_locale')
    );
}

function html_entity_decode_better($string)
{
    // ENT_HTML5 to handle more named entities (&apos;, etc?).
    return html_entity_decode($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function html_excerpt($body, $limit = 300)
{
    $body = html_entity_decode_better(replace_tags_with_spaces($body));

    if (strlen($body) >= $limit) {
        $body = mb_substr($body, 0, $limit).'...';
    }

    return e($body);
}

function json_date(?DateTime $date) : ?string
{
    return $date === null ? null : $date->format('Y-m-d');
}

function json_time(?DateTime $time) : ?string
{
    return $time === null ? null : $time->format(DateTime::ATOM);
}

function locale_flag($locale)
{
    return App\Libraries\LocaleMeta::flagFor($locale);
}

function locale_name($locale)
{
    return App\Libraries\LocaleMeta::nameFor($locale);
}

function locale_for_moment($locale)
{
    if ($locale === 'en') {
        return;
    }

    if ($locale === 'zh') {
        return 'zh-cn';
    }

    if ($locale === 'zh-hk') {
        return 'zh-hk';
    }

    if ($locale === 'zh-tw') {
        return 'zh-tw';
    }

    return $locale;
}

function locale_for_timeago($locale)
{
    if ($locale === 'zh') {
        return 'zh-CN';
    }

    if ($locale === 'zh-tw') {
        return 'zh-TW';
    }

    return $locale;
}

function log_error($exception)
{
    Log::error($exception);

    if (config('sentry.dsn')) {
        Sentry::captureException($exception);
    }
}

function mysql_escape_like($string)
{
    return addcslashes($string, '%_\\');
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
        $opts[$i] = trans_choice('common.count.item', $i);
    }

    // include selected value separately if it's out of range.
    if ($selected > $max) {
        $opts[$selected] = trans_choice('common.count.item', $selected);
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
    $title = trans('users.anonymous.login_link');
    $link = Html::link('#', trans($link_text_key), ['class' => 'js-user-link', 'title' => $title]);
    $text = trans($text_key, ['link' => $link]);

    return $text;
}

function render_to_string($view, $variables = [])
{
    return view()->make($view, $variables)->render();
}

function spinner()
{
    return '<div class="la-ball-clip-rotate"></div>';
}

function strip_utf8_bom($input)
{
    if (substr($input, 0, 3) === "\xEF\xBB\xBF") {
        return substr($input, 3);
    }

    return $input;
}

function to_sentence($array, $key = 'common.array_and')
{
    switch (count($array)) {
        case 0:
            return '';
        case 1:
            return (string) $array[0];
        case 2:
            return implode(trans("{$key}.two_words_connector"), $array);
        default:
            return implode(trans("{$key}.words_connector"), array_slice($array, 0, -1)).trans("{$key}.last_word_connector").array_last($array);
    }
}

function obscure_email($email)
{
    $email = explode('@', $email);

    if (!present($email[0]) || !present($email[1] ?? null)) {
        return '<unknown>';
    }

    return $email[0][0].'***'.'@'.$email[1];
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

    return 'US$'.number_format($price, $precision);
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

function i18n_view($view)
{
    $localViewPath = sprintf('%s-%s', $view, App::getLocale());

    if (view()->exists($localViewPath)) {
        return $localViewPath;
    } else {
        return sprintf('%s-%s', $view, config('app.fallback_locale'));
    }
}

function is_api_request()
{
    return Request::is('api/*');
}

function is_sql_unique_exception($ex)
{
    return starts_with(
        $ex->getMessage(),
        'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry'
    );
}

function js_view($view, $vars = [], $status = 200)
{
    return response()
        ->view($view, $vars, $status)
        ->header('Content-Type', 'application/javascript');
}

function ujs_redirect($url, $status = 200)
{
    if (Request::ajax() && !Request::isMethod('get')) {
        return js_view('layout.ujs-redirect', ['url' => $url], $status);
    } else {
        if (Request::header('Turbolinks-Referrer')) {
            Request::session()->put('_turbolinks_location', $url);
        }

        return redirect($url);
    }
}

function route_redirect($path, $target)
{
    return Route::get($path, '\App\Http\Controllers\RedirectController')->name("redirect:{$target}");
}

function timeago($date)
{
    $display_date = i18n_time($date);
    $attribute_date = json_time($date);

    return "<time class='timeago' datetime='{$attribute_date}'>{$display_date}</time>";
}

function current_action()
{
    return explode('@', Route::currentRouteAction(), 2)[1] ?? null;
}

function link_to_user($user_id, $user_name = null, $user_color = null)
{
    if ($user_id instanceof App\Models\User) {
        $user_name ?? ($user_name = $user_id->username);
        $user_color ?? ($user_color = $user_id->user_colour);
        $user_id = $user_id->getKey();
    }
    $user_name = e($user_name);
    $style = user_color_style($user_color, 'color');

    if ($user_id) {
        $user_url = e(route('users.show', $user_id));

        return "<a class='user-name js-usercard' data-user-id='{$user_id}' href='{$user_url}' style='{$style}'>{$user_name}</a>";
    } else {
        return "<span class='user-name'>{$user_name}</span>";
    }
}

function issue_icon($issue)
{
    switch ($issue) {
        case 'added': return 'fas fa-cogs';
        case 'assigned': return 'fas fa-user';
        case 'confirmed': return 'fas fa-exclamation-triangle';
        case 'resolved': return 'far fa-check-circle';
        case 'duplicate': return 'fas fa-copy';
        case 'invalid': return 'far fa-times-circle';
    }
}

function build_url($build)
{
    return route('changelog.build', [$build->updateStream->name, $build->version]);
}

function post_url($topicId, $postId, $jumpHash = true, $tail = false)
{
    $postIdParamKey = 'start';
    if ($tail === true) {
        $postIdParamKey = 'end';
    }

    $url = route('forum.topics.show', ['topics' => $topicId, $postIdParamKey => $postId]);

    return $url;
}

function wiki_url($page = 'Welcome', $locale = null)
{
    $params = compact('page');

    if (present($locale) && $locale !== App::getLocale()) {
        $params['locale'] = $locale;
    }

    return route('wiki.show', $params);
}

function bbcode($text, $uid, $options = [])
{
    return (new App\Libraries\BBCodeFromDB($text, $uid, $options))->toHTML();
}

function bbcode_for_editor($text, $uid)
{
    return (new App\Libraries\BBCodeFromDB($text, $uid))->toEditor();
}

function proxy_image($url)
{
    // turn relative urls into absolute urls
    if (!preg_match('/^https?\:\/\//', $url)) {
        // ensure url is relative to the site root
        if ($url[0] !== '/') {
            $url = "/{$url}";
        }
        $url = config('app.url').$url;
    }

    $decoded = urldecode(html_entity_decode_better($url));

    if (config('osu.camo.key') === '') {
        return $decoded;
    }

    $isProxied = starts_with($decoded, config('osu.camo.prefix'));
    if ($isProxied) {
        return $decoded;
    }

    $url = bin2hex($decoded);
    $secret = hash_hmac('sha1', $decoded, config('osu.camo.key'));

    return config('osu.camo.prefix')."{$secret}/{$url}";
}

function lazy_load_image($url, $class = '', $alt = '')
{
    $url = e($url);

    return "<img class='{$class}' src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' data-normal='{$url}' alt='{$alt}' />";
}

function nav_links()
{
    $links = [];

    $links['home'] = [
        '_' => route('home'),
        'news-index' => route('news.index'),
        'team' => wiki_url('Team'),
        'changelog-index' => route('changelog.index'),
        'getDownload' => route('download'),
        'search' => route('search'),
    ];
    $links['beatmaps'] = [
        'index' => route('beatmapsets.index'),
        'artists' => route('artists.index'),
        'packs' => route('packs.index'),
    ];
    $links['rankings'] = [
        'index' => route('rankings', ['mode' => 'osu', 'type' => 'performance']),
        'charts' => route('rankings', ['mode' => 'osu', 'type' => 'charts']),
        'score' => route('rankings', ['mode' => 'osu', 'type' => 'score']),
        'country' => route('rankings', ['mode' => 'osu', 'type' => 'country']),
        'kudosu' => osu_url('rankings.kudosu'),
    ];
    $links['community'] = [
        'forum-forums-index' => route('forum.forums.index'),
        'contests' => route('contests.index'),
        'tournaments' => route('tournaments.index'),
        'getLive' => route('livestreams.index'),
        'dev' => osu_url('dev'),
    ];
    $links['store'] = [
        'getListing' => action('StoreController@getListing'),
        'cart-show' => route('store.cart.show'),
        'orders-index' => route('store.orders.index'),
    ];
    $links['help'] = [
        'getWiki' => wiki_url('Welcome'),
        'getFaq' => wiki_url('FAQ'),
        'getRules' => wiki_url('Rules'),
        'getSupport' => wiki_url('Help_Center'),
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
            'wiki' => wiki_url('Welcome'),
        ],
        'help' => [
            'faq' => wiki_url('FAQ'),
            'forum' => route('forum.forums.index'),
            'livestreams' => route('livestreams.index'),
            'report' => route('forum.topics.create', ['forum_id' => 5]),
        ],
        'legal' => footer_legal_links(),
    ];
}

function footer_legal_links()
{
    return [
        'terms' => route('legal', 'terms'),
        'privacy' => route('legal', 'privacy'),
        'copyright' => route('legal', 'copyright'),
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
        $output = $numbers[($remaining % $base)].$output;
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
        return '<div title="'.$tooltipDate.'">'.trans('users.show.first_members').'</div>';
    }

    return trans('users.show.joined_at', [
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
        $formatter->setPattern(trans("common.datetime.{$pattern}.php"));
    }

    return $formatter->format($datetime);
}

function i18n_time($datetime, $format = IntlDateFormatter::LONG)
{
    return IntlDateFormatter::create(App::getLocale(), $format, $format)
        ->format($datetime);
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
    $manager = new League\Fractal\Manager();
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
    return json_collection([$model], $transformer, $includes)[0];
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

function get_arr($input, $callback)
{
    if (!is_array($input)) {
        return;
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
    if (present($string)) {
        return (float) $string;
    }
}

/*
 * Parses a string. If it's not an empty string or null,
 * return parsed integer value of it, otherwise return null.
 */
function get_int($string)
{
    if (present($string)) {
        return (int) $string;
    }
}

function get_file($input)
{
    if ($input instanceof Symfony\Component\HttpFoundation\File\UploadedFile) {
        return $input->getRealPath();
    }
}

function get_string($input)
{
    if (is_string($input)) {
        return $input;
    }
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
        (is_dir("$dir/$file")) ? deltree("$dir/$file") : unlink("$dir/$file");
    }

    return rmdir($dir);
}

function get_param_value($input, $type)
{
    switch ($type) {
        case 'bool':
            return get_bool($input);
            break;
        case 'int':
            return get_int($input);
            break;
        case 'file':
            return get_file($input);
            break;
        case 'string':
            return get_string($input);
        case 'string_split':
            return get_arr(explode("\r\n", $input), 'get_string');
            break;
        case 'string[]':
            return get_arr($input, 'get_string');
            break;
        case 'int[]':
            return get_arr($input, 'get_int');
            break;
        default:
            return presence((string) $input);
    }
}

function get_params($input, $namespace, $keys)
{
    if ($namespace !== null) {
        $input = array_get($input, $namespace);
    }

    $params = [];

    foreach ($keys as $keyAndType) {
        $keyAndType = explode(':', $keyAndType);

        $key = $keyAndType[0];
        $type = $keyAndType[1] ?? null;

        if (array_has($input, $key)) {
            $value = get_param_value(array_get($input, $key), $type);

            array_set($params, $key, $value);
        }
    }

    return $params;
}

function array_rand_val($array)
{
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
        $selectKey = (new $class)->qualifyColumn($key);
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
function get_timestamp_or_zero(DateTime $time = null) : int
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
        return Carbon\Carbon::parse($value);
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
    return floor($seconds / 60).':'.str_pad(($seconds % 60), 2, '0', STR_PAD_LEFT);
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

    return ($match_pos === false) ? $text : substr($text, 0, $match_pos);
}

function build_icon($prefix)
{
    switch ($prefix) {
        case 'add': return 'plus';
        case 'fix': return 'wrench';
        case 'misc': return 'question';
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
    return "<span title='".number_format($number)."'>".suffixed_number_format($number).'</span>';
}

// formats a number as a percentage with a fixed number of precision
// e.g.: 98.3 -> 98.30%
function format_percentage($number, $precision = 2)
{
    return sprintf("%.{$precision}f%%", round($number, $precision));
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

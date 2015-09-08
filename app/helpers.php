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
function item_count($count)
{
    return Lang::choice('common.count.item', $count, ['count' => $count]);
}

function product_quantity_options($product)
{
    if ($product->stock === null) {
        $max = $product->max_quantity;
    } else {
        $max = min($product->max_quantity, $product->stock);
    }
    $opts = [];
    for ($i = 1; $i <= $max; $i++) {
        $opts[$i] = item_count($i);
    }

    return $opts;
}

function countries_array_for_select()
{
    $out = [];

    foreach (App\Models\Country::forStore()->get() as $country) {
        if (! isset($lastDisplay)) {
            $lastDisplay = $country->display;
        } elseif ($lastDisplay !== $country->display) {
            $out['_disabled'] = '---';
        }
        $out[$country->acronym] = $country->name;
    }

    return $out;
}

function currency($price)
{
    if ($price == 0) {
        return 'free!';
    }

    return sprintf('US$%.2f', $price);
}

function error_popup($message)
{
    return response(['error' => $message], 422);
}

function i18n_view($view)
{
    $current_locale_path = sprintf('%s/%s-%s.blade.php',
        config('view.paths')[0],
        str_replace('.', '/', $view),
        App::getLocale()
    );

    if (file_exists($current_locale_path)) {
        return sprintf('%s-%s', $view, App::getLocale());
    } else {
        return sprintf('%s-%s', $view, config('app.fallback_locale'));
    }
}

function js_view($view, $vars = [])
{
    return response()
        ->view($view, $vars)
        ->header('Content-Type', 'application/javascript');
}

function ujs_redirect($url)
{
    if (Request::ajax()) {
        return js_view('layout.ujs-redirect', ['url' => $url]);
    } else {
        return redirect($url);
    }
}

function timeago($date)
{
    $display_date = $date->toRfc850String();
    $attribute_date = $date->toIso8601String();

    return "<time class='timeago-raw timeago' datetime='{$attribute_date}'>{$display_date}</time>";
}

function current_action()
{
    $currentAction = \Route::currentRouteAction();
    if ($currentAction !== null) {
        return explode('@', $currentAction, 2)[1];
    }
}

function link_to_user($user_id, $user_name, $user_colour)
{
    $user_name = e($user_name);
    $style = user_colour_style($user_colour, 'color');

    if ($user_id) {
        $user_url = e(route('users.show', $user_id));

        return "<a class='user-name' href='{$user_url}' style='{$style}'>{$user_name}</a>";
    } else {
        return "<span class='user-name'>{$user_name}</span>";
    }
}

function user_icon($type, $title, $link)
{
    $title = e($title);

    return "<a href='{$link}'><div class='user-icon' data-title='{$title}'><i class='fa fa-fw fa-{$type} fa-2x'></i></div></a>";
}

function issue_icon($issue)
{
    switch ($issue) {
        case 'confirmed': return 'fa-exclamation-triangle';
        case 'resolved': return 'fa-check-circle';
        case 'duplicate': return 'fa-copy';
        case 'invalid': return 'fa-times-circle';
    }
}

function post_url($topicId, $postId, $jumpHash = true, $tail = false)
{
    $postIdParamKey = 'start';
    if ($tail === true) {
        $postIdParamKey = 'end';
    }

    $url = route('forum.topics.show', ['topics' => $topicId, $postIdParamKey => $postId]);

    if ($jumpHash === true) {
        $url .= "#forum-post-{$postId}";
    }

    return $url;
}

function play_mode_string($val)
{
    switch ($val) {
        case 0:
            return 'osu';
        case 1:
            return 'taiko';
        case 2:
            return 'ctb';
        case 3:
            return 'mania';
    }
}

function bbcode($text, $uid)
{
    return (new App\Libraries\BBCodeFromDB($text, $uid))->toHTML();
}

function bbcode_for_editor($text, $uid)
{
    return (new App\Libraries\BBCodeFromDB($text, $uid))->toEditor();
}

function proxy_image($url)
{
    $decoded = urldecode(html_entity_decode($url));
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

    return "<img class='{$class}' src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' data-layzr='{$url}' alt='{$alt}' />";
}

function nav_links()
{
    $links = [];

    if (config('app.debug')) {
        $links['home'] = [
            'getNews' => route('news'),
            'getChangelog' => route('changelog'),
            'getDownload' => route('download'),
        ];

        $links['help'] = [
            'getWiki' => route('wiki'),
            'getFaq' => route('faq'),
            'getSupport' => route('support'),
        ];

        $links['beatmaps'] = [
            'getListing' => route('beatmap-listing'),
            'getPacks' => route('packs'),
            'getCharts' => route('charts'),
            'getModding' => route('modding'),
        ];

        $links['ranking'] = [
            'getOverall' => route('ranking-overall'),
            'getCharts' => route('ranking-charts'),
            'getCountry' => route('ranking-country'),
            'getMapper' => route('ranking-mapper'),
        ];
    }

    $links['community'] = [
        'forum-forums-index' => route('forum.forums.index'),
        'tournaments' => route('tournaments.index'),
    ];

    if (config('app.debug')) {
        $links['community']['getChat'] = route('chat');
        $links['community']['getLive'] = route('live');
    }

    $links['store'] = [
        'getListing' => action('StoreController@getListing'),
        'getCart' => action('StoreController@getCart'),
    ];

    return $links;
}

function presence($string)
{
    if ($string === '') {
        return;
    }

    return $string;
}

function user_colour_style($colour, $style)
{
    if (presence($colour) === null) {
        return '';
    }

    $colour = e($colour);

    return "{$style}: #{$colour};";
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
    if ($user->user_regdate < Carbon\Carbon::createFromDate(2008, 1, 1)) {
        return trans('users.show.first_members');
    }

    return trans('users.show.joined_at', ['date' => $user->user_regdate->formatLocalized('%B %Y')]);
}

function open_image($path, $dimensions = null)
{
    if ($dimensions === null) {
        $dimensions = getimagesize($path);
    }

    switch ($dimensions[2]) {
        case IMAGETYPE_GIF:
            return imagecreatefromgif($path);
        case IMAGETYPE_JPEG:
            return imagecreatefromjpeg($path);
        case IMAGETYPE_PNG:
            return imagecreatefrompng($path);
    }
}

function fractal_collection_array($models, $transformer)
{
    $manager = new League\Fractal\Manager();
    $collection = new League\Fractal\Resource\Collection($models, $transformer);

    return $manager->createData($collection)->toArray();
}

function fractal_item_array($model, $transformer)
{
    $manager = new League\Fractal\Manager();
    $item = new League\Fractal\Resource\Item($model, $transformer);

    return $manager->createData($item)->toArray();
}

function fast_imagesize($url)
{
    // CarbonInterval doesn't work ;_;
    return Cache::remember("imageSize:{$url}", 7 * 24 * 60, function () use ($url) {
        $headers = ['Range: bytes=0-32768'];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);

        return getimagesizefromstring($data);
    });
}

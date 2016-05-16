<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Explicit > Implicit. Easier to change stuff without breaking anything.
|
*/

// home section
if (Config::get('app.debug')) {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getNews']);
} else {
    Route::get('/', ['as' => 'home', function () {
        $host = Request::getHttpHost();
        $subdomain = substr($host, 0, strpos($host, '.'));
        $redirect_path = $subdomain === 'store' ? '/store' : '/forum';

        return Redirect::to($redirect_path);
    }]);
}

Route::get('/home/news', ['as' => 'news', 'uses' => 'HomeController@getNews']);
Route::get('/home/download', ['as' => 'download', 'uses' => 'HomeController@getDownload']);
Route::get('/home/changelog', ['as' => 'changelog', 'uses' => 'HomeController@getChangelog']);
Route::get('/home/support', ['as' => 'support-the-game', 'uses' => 'HomeController@supportTheGame']);

Route::get('/icons', 'HomeController@getIcons');

// Route::get('/beatmaps/packs', ['as' => 'packs', 'uses' => 'BeatmapsController@getPacks']);
// Route::get('/beatmaps/charts/{id?}', ['as' => 'charts', 'uses' => 'BeatmapsController@getCharts']);

Route::get('/beatmaps/{beatmaps}/scores', ['as' => 'beatmaps.scores', 'uses' => 'BeatmapsController@scores']);
Route::get('/b/{beatmaps}', ['as' => 'beatmaps.show', 'uses' => 'BeatmapsController@show']);

Route::get('/beatmapsets/search/{filters?}', ['as' => 'beatmapsets.search', 'uses' => 'BeatmapsetsController@search']);
Route::resource('/beatmapsets', 'BeatmapsetsController', ['only' => ['index']]);
Route::get('/s/{beatmapsets}', ['as' => 'beatmapsets.show', 'uses' => 'BeatmapsetsController@show']);

// ranking section
Route::get('/ranking/overall', ['as' => 'ranking-overall', 'uses' => 'RankingController@getOverall']);
Route::get('/ranking/charts', ['as' => 'ranking-charts', 'uses' => 'RankingController@getCharts']);
Route::get('/ranking/country', ['as' => 'ranking-country', 'uses' => 'RankingController@getCountry']);
Route::get('/ranking/mapper', ['as' => 'ranking-mapper', 'uses' => 'RankingController@getMapper']);

// community section (forum will end up being a section of its own)
Route::get('/community/forum', function () { return Redirect::to('/forum'); });

Route::get('/community/live', ['as' => 'live', 'uses' => 'CommunityController@getLive']);
Route::post('/community/live', ['as' => 'live', 'uses' => 'CommunityController@postLive']);

Route::get('/community/chat', ['as' => 'chat', 'uses' => 'CommunityController@getChat']);
Route::get('/community/profile/{id}', function ($id) { return Redirect::route('users.show', $id); });

Route::get('/community/slack', ['as' => 'slack', 'uses' => 'CommunityController@getSlack']);
Route::post('/community/slack/agree', ['as' => 'slack.agree', 'uses' => 'CommunityController@postSlackAgree']);

Route::post('users/check-username-availability', ['as' => 'users.check-username-availability', 'uses' => 'UsersController@checkUsernameAvailability']);
Route::post('users/login', ['as' => 'users.login', 'uses' => 'UsersController@login']);
Route::delete('users/logout', ['as' => 'users.logout', 'uses' => 'UsersController@logout']);
Route::get('users/disabled', ['as' => 'users.disabled', 'uses' => 'UsersController@disabled']);

// Authentication section (Temporarily set up as replacement/improvement of config("osu.urls.*"))
Route::get('users/forgot-password', ['as' => 'users.forgot-password', function () { return Redirect::to('https://osu.ppy.sh/p/forgot'); }]);
Route::get('users/register', ['as' => 'users.register', function () { return Redirect::to('https://osu.ppy.sh/p/register'); }]);

Route::get('u/{users}', ['as' => 'users.show', 'uses' => 'UsersController@show']);

// help section
Route::get('/wiki', ['as' => 'wiki', function () { return Redirect::to('https://osu.ppy.sh/wiki'); }]);

Route::get('/help/support', ['as' => 'support', 'uses' => 'HelpController@getSupport']);
Route::get('/help/faq', ['as' => 'faq', 'uses' => 'HelpController@getFaq']);

// catchall controllers
Route::controller('/notifications', 'NotificationController');
Route::controller('/store', 'StoreController', [
    'getProduct' => 'store.product',
    'postRequestNotification' => 'store.request-notification',
]);

Route::resource('tournaments', 'TournamentsController');
Route::post('/tournaments/{tournament}/unregister', ['as' => 'tournaments.unregister', 'uses' => 'TournamentsController@unregister']);
Route::post('/tournaments/{tournament}/register', ['as' => 'tournaments.register', 'uses' => 'TournamentsController@register']);

// Forum controllers
Route::group(['prefix' => 'forum', 'namespace' => 'Forum'], function () {
    Route::get('/', ['as' => 'forum.forums.index', 'uses' => 'ForumsController@index']);
    Route::get('{forums}', ['as' => 'forum.forums.show', 'uses' => 'ForumsController@show']);

    Route::get('t/{topics}', ['as' => 'forum.topics.show', 'uses' => 'TopicsController@show']);
    Route::post('topics/preview', ['as' => 'forum.topics.preview', 'uses' => 'TopicsController@preview']);
    Route::post('topics/{topics}/reply', ['as' => 'forum.topics.reply', 'uses' => 'TopicsController@reply']);
    Route::post('topics/{topics}/lock', ['as' => 'forum.topics.lock', 'uses' => 'TopicsController@lock']);
    Route::resource('topics', 'TopicsController', ['only' => ['create', 'store']]);

    Route::resource('forum-covers', 'ForumCoversController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('topic-covers', 'TopicCoversController', ['only' => ['store', 'update', 'destroy']]);

    Route::get('p/{posts}', ['as' => 'forum.posts.show', 'uses' => 'PostsController@show']);
    Route::get('posts/{posts}/raw', ['as' => 'forum.posts.raw', 'uses' => 'PostsController@raw']);
    Route::resource('posts', 'PostsController', ['only' => ['destroy', 'update', 'edit']]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', ['as' => 'admin.root', 'uses' => 'PagesController@root']);

    Route::resource('logs', 'LogsController', ['only' => ['index']]);

    Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show']]);
    Route::get('/beatmapsets/{id}/covers', ['as' => 'admin.beatmapsets.covers', 'uses' => 'BeatmapsetsController@covers']);
    Route::post('/beatmapsets/{id}/covers/regenerate', ['as' => 'admin.beatmapsets.covers.regenerate', 'uses' => 'BeatmapsetsController@regenerateCovers']);

    Route::resource('beatmapset-discussions', 'BeatmapsetDiscussionsController', ['only' => ['store']]);

    // store admin
    Route::group(['prefix' => 'store', 'namespace' => 'Store'], function () {
        Route::post('orders/ship', ['as' => 'admin.store.orders.ship', 'uses' => 'OrdersController@ship']);
        Route::resource('orders', 'OrdersController', ['only' => ['index', 'show', 'update']]);
        Route::resource('orders.items', 'OrderItemsController', ['only' => ['update']]);

        Route::resource('addresses', 'AddressesController', ['only' => ['update']]);

        Route::get('/', function () { return Redirect::route('admin.store.orders.index'); });
    });

    Route::group(['prefix' => 'forum', 'namespace' => 'Forum'], function () {
        Route::resource('forum-covers', 'ForumCoversController', ['only' => ['index', 'store', 'update']]);
    });
});

Route::get('beatmapsets/{beatmapsets}/discussion', ['as' => 'beatmapsets.discussion', 'uses' => 'BeatmapsetsController@discussion']);

Route::put('beatmap-discussions/{beatmap_discussions}/vote', ['uses' => 'BeatmapDiscussionsController@vote', 'as' => 'beatmap-discussions.vote']);
Route::resource('beatmap-discussion-posts', 'BeatmapDiscussionPostsController', ['only' => ['store', 'update']]);

// Uploading file doesn't quite work with PUT/PATCH.
// Reference: https://bugs.php.net/bug.php?id=55815
// Note that hhvm behaves differently (the same as POST).
Route::post('/account/update-profile', ['as' => 'account.update-profile', 'uses' => 'AccountController@updateProfile']);
Route::put('/account/page', ['as' => 'account.page', 'uses' => 'AccountController@updatePage']);

// API
Route::get('/api/get_match', ['uses' => 'APIController@getMatch']);
Route::get('/api/get_packs', ['uses' => 'APIController@getPacks']);
Route::get('/api/get_user', ['uses' => 'APIController@getUser']);
Route::get('/api/get_user_best', ['uses' => 'APIController@getUserBest']);
Route::get('/api/get_user_recent', ['uses' => 'APIController@getUserRecent']);
Route::get('/api/get_replay', ['uses' => 'APIController@getReplay']);
Route::get('/api/get_scores', ['uses' => 'APIController@getScores']);
Route::get('/api/get_beatmaps', ['uses' => 'APIController@getBeatmaps']);

// status
if (Config::get('app.debug')) {
    Route::get('/status', ['uses' => 'StatusController@getMain']);
} else {
    Route::group(['domain' => 'stat.ppy.sh'], function () {
        Route::get('/', ['uses' => 'StatusController@getMain']);
    });
}

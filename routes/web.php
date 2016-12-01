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
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::post('/set-locale', ['as' => 'set-locale', 'uses' => 'HomeController@setLocale']);
Route::get('/home/download', ['as' => 'download', 'uses' => 'HomeController@getDownload']);
Route::get('/home/changelog', ['as' => 'changelog', 'uses' => 'HomeController@getChangelog']);
Route::get('/home/support', ['as' => 'support-the-game', 'uses' => 'HomeController@supportTheGame']);

Route::get('/icons', 'HomeController@getIcons');

// featured artists
Route::get('/beatmaps/artists', ['as' => 'artist.index', 'uses' => 'ArtistsController@index']);
Route::get('/beatmaps/artists/{artist}', ['as' => 'artist.show', 'uses' => 'ArtistsController@show']);

// beatmapsets
Route::get('/beatmaps/{beatmap}/scores', ['as' => 'beatmaps.scores', 'uses' => 'BeatmapsController@scores']);
Route::resource('beatmaps', 'BeatmapsController', ['only' => ['show']]);

// redirects to beatmapset anyways so there's no point
// in having an another redirect on top of that
Route::get('/b/{beatmap}', ['uses' => 'BeatmapsController@show']);

Route::get('/beatmapsets/search/{filters?}', ['as' => 'beatmapsets.search', 'uses' => 'BeatmapsetsController@search']);
Route::resource('/beatmapsets', 'BeatmapsetsController', ['only' => ['index', 'show']]);
Route::post('/beatmapsets/{beatmapset}/update-favourite', ['as' => 'beatmapsets.update-favourite', 'uses' => 'BeatmapsetsController@updateFavourite']);

Route::get('/s/{beatmapset}', function ($beatmapset) {
    return ujs_redirect(route('beatmapsets.show', ['beatmapset' => $beatmapset]));
});

// beatmapset discussions
Route::get('beatmapsets/{beatmapset}/discussion', ['as' => 'beatmapsets.discussion', 'uses' => 'BeatmapsetsController@discussion']);
Route::put('beatmapsets/{beatmapset}/nominate', ['as' => 'beatmapsets.nominate', 'uses' => 'BeatmapsetsController@nominate']);
Route::put('beatmapsets/{beatmapset}/disqualify', ['as' => 'beatmapsets.disqualify', 'uses' => 'BeatmapsetsController@disqualify']);
Route::put('beatmap-discussions/{beatmap_discussion}/vote', ['uses' => 'BeatmapDiscussionsController@vote', 'as' => 'beatmap-discussions.vote']);
Route::resource('beatmap-discussion-posts', 'BeatmapDiscussionPostsController', ['only' => ['store', 'update']]);

// contests
Route::group(['as' => 'community.', 'prefix' => 'community'], function () {
    Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);
});

// contest entries
Route::put('contest-entries/{contest_entry}/vote', ['as' => 'contest-entries.vote', 'uses' => 'ContestEntriesController@vote']);
Route::resource('contest-entries', 'ContestEntriesController', ['only' => ['store', 'destroy']]);

// ranking section
Route::get('/ranking/overall', ['as' => 'ranking-overall', 'uses' => 'RankingController@getOverall']);
Route::get('/ranking/charts', ['as' => 'ranking-charts', 'uses' => 'RankingController@getCharts']);
Route::get('/ranking/country', ['as' => 'ranking-country', 'uses' => 'RankingController@getCountry']);
Route::get('/ranking/mapper', ['as' => 'ranking-mapper', 'uses' => 'RankingController@getMapper']);

// community section (forum will end up being a section of its own)
Route::get('/community/forum', function () {
    return Redirect::to('/forum');
});

Route::resource('livestreams', 'LivestreamsController', ['only' => ['index']]);
Route::post('livestreams/promote', ['as' => 'livestreams.promote', 'uses' => 'LivestreamsController@promote']);

Route::get('/community/chat', ['as' => 'chat', 'uses' => 'CommunityController@getChat']);
Route::get('/community/profile/{id}', function ($id) {
    return Redirect::route('users.show', $id);
});

Route::get('/community/slack', ['as' => 'slack', 'uses' => 'CommunityController@getSlack']);
Route::post('/community/slack/agree', ['as' => 'slack.agree', 'uses' => 'CommunityController@postSlackAgree']);

Route::resource('matches', 'MatchesController', ['only' => ['show']]);
Route::get('/matches/{match}/history', ['as' => 'matches.history', 'uses' => 'MatchesController@history']);

Route::get('/mp/{match}', function ($match) {
    return ujs_redirect(route('matches.show', ['match' => $match]));
});

Route::post('users/check-username-availability', ['as' => 'users.check-username-availability', 'uses' => 'UsersController@checkUsernameAvailability']);
Route::post('users/login', ['as' => 'users.login', 'uses' => 'UsersController@login']);
Route::delete('users/logout', ['as' => 'users.logout', 'uses' => 'UsersController@logout']);
Route::get('users/disabled', ['as' => 'users.disabled', 'uses' => 'UsersController@disabled']);

// Authentication section (Temporarily set up as replacement/improvement of config("osu.urls.*"))
Route::get('users/forgot-password', ['as' => 'users.forgot-password', function () {
    return Redirect::to('https://osu.ppy.sh/p/forgot');
}]);
Route::get('users/register', ['as' => 'users.register', function () {
    return Redirect::to('https://osu.ppy.sh/p/register');
}]);

Route::get('u/{user}', ['as' => 'users.show', 'uses' => 'UsersController@show']);

// help section
Route::get('/wiki', ['as' => 'wiki', function () {
    return Redirect::to('https://osu.ppy.sh/wiki');
}]);

Route::get('/help/support', ['as' => 'support', 'uses' => 'HelpController@getSupport']);
Route::get('/help/faq', ['as' => 'faq', 'uses' => 'HelpController@getFaq']);

Route::get('/store', 'StoreController@getIndex');
Route::get('/store/listing', 'StoreController@getListing')->name('store.products.index');
Route::get('/store/invoice', 'StoreController@getInvoice');
Route::get('/store/invoice/{invoice}', 'StoreController@getInvoice');
Route::get('/store/product/{product}', 'StoreController@getProduct')->name('store.product');
Route::get('/store/cart', 'StoreController@getCart');
Route::get('/store/checkout', 'StoreController@getCheckout');
Route::post('/store/update-cart', 'StoreController@postUpdateCart');
Route::post('/store/update-address', 'StoreController@postUpdateAddress');
Route::post('/store/new-address', 'StoreController@postNewAddress');
Route::post('/store/add-to-cart', 'StoreController@postAddToCart');
Route::post('/store/checkout', 'StoreController@postCheckout');
Route::put('/store/request-notification/{product}/{action}', 'StoreController@putRequestNotification')->name('store.request-notification');

Route::resource('tournaments', 'TournamentsController');
Route::post('/tournaments/{tournament}/unregister', ['as' => 'tournaments.unregister', 'uses' => 'TournamentsController@unregister']);
Route::post('/tournaments/{tournament}/register', ['as' => 'tournaments.register', 'uses' => 'TournamentsController@register']);

// Forum controllers
Route::group(['as' => 'forum.', 'prefix' => 'forum', 'namespace' => 'Forum'], function () {
    Route::get('t/{topic}', ['as' => 'topics.show', 'uses' => 'TopicsController@show']);
    Route::post('topics/preview', ['as' => 'topics.preview', 'uses' => 'TopicsController@preview']);
    Route::post('topics/{topic}/lock', ['as' => 'topics.lock', 'uses' => 'TopicsController@lock']);
    Route::post('topics/{topic}/move', ['as' => 'topics.move', 'uses' => 'TopicsController@move']);
    Route::post('topics/{topic}/pin', ['as' => 'topics.pin', 'uses' => 'TopicsController@pin']);
    Route::post('topics/{topic}/reply', ['as' => 'topics.reply', 'uses' => 'TopicsController@reply']);
    Route::post('topics/{topic}/vote-feature', ['as' => 'topics.vote-feature', 'uses' => 'TopicsController@voteFeature']);
    Route::post('topics/{topic}/vote', ['as' => 'topics.vote', 'uses' => 'TopicsController@vote']);
    Route::post('topics/{topic}/watch', ['as' => 'topics.watch', 'uses' => 'TopicsController@watch']);
    Route::resource('topics', 'TopicsController', ['only' => ['create', 'store', 'update']]);
    Route::resource('topic-watches', 'TopicWatchesController', ['only' => ['index']]);

    Route::resource('forum-covers', 'ForumCoversController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('topic-covers', 'TopicCoversController', ['only' => ['store', 'update', 'destroy']]);

    Route::get('p/{post}', ['as' => 'posts.show', 'uses' => 'PostsController@show']);
    Route::get('posts/{post}/raw', ['as' => 'posts.raw', 'uses' => 'PostsController@raw']);
    Route::resource('posts', 'PostsController', ['only' => ['destroy', 'update', 'edit']]);

    Route::get('/', ['as' => 'forums.index', 'uses' => 'ForumsController@index']);
    Route::get('{forum}', ['as' => 'forums.show', 'uses' => 'ForumsController@show']);
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', ['as' => 'root', 'uses' => 'PagesController@root']);

    Route::resource('logs', 'LogsController', ['only' => ['index']]);

    Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show']]);
    Route::get('/beatmapsets/{beatmapset}/covers', ['as' => 'beatmapsets.covers', 'uses' => 'BeatmapsetsController@covers']);
    Route::post('/beatmapsets/{beatmapset}/covers/regenerate', ['as' => 'beatmapsets.covers.regenerate', 'uses' => 'BeatmapsetsController@regenerateCovers']);

    Route::post('contests/{id}/zip', ['as' => 'contests.getZip', 'uses' => 'ContestsController@gimmeZip']);
    Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);

    Route::resource('beatmapset-discussions', 'BeatmapsetDiscussionsController', ['only' => ['store']]);

    // store admin
    Route::group(['as' => 'store.', 'prefix' => 'store', 'namespace' => 'Store'], function () {
        Route::post('orders/ship', ['as' => 'orders.ship', 'uses' => 'OrdersController@ship']);
        Route::resource('orders', 'OrdersController', ['only' => ['index', 'show', 'update']]);
        Route::resource('orders.items', 'OrderItemsController', ['only' => ['update']]);

        Route::resource('addresses', 'AddressesController', ['only' => ['update']]);

        Route::get('/', function () {
            return Redirect::route('admin.store.orders.index');
        });
    });

    Route::group(['as' => 'forum.', 'prefix' => 'forum', 'namespace' => 'Forum'], function () {
        Route::resource('forum-covers', 'ForumCoversController', ['only' => ['index', 'store', 'update']]);
    });
});

// Uploading file doesn't quite work with PUT/PATCH.
// Reference: https://bugs.php.net/bug.php?id=55815
// Note that hhvm behaves differently (the same as POST).
Route::post('/account/update-profile', ['as' => 'account.update-profile', 'uses' => 'AccountController@updateProfile']);
Route::put('/account/page', ['as' => 'account.page', 'uses' => 'AccountController@updatePage']);
Route::post('/account/verify', ['as' => 'account.verify', 'uses' => 'AccountController@verify']);
Route::post('/account/reissue-code', ['as' => 'account.reissue-code', 'uses' => 'AccountController@reissueCode']);

// API
Route::group(['prefix' => 'api', 'namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'v2'], function () {
        Route::group(['prefix' => 'chat'], function () {
            Route::get('channels', ['uses' => 'ChatController@channels']);                //  GET /api/v2/chat/channels
            Route::get('messages', ['uses' => 'ChatController@messages']);                //  GET /api/v2/chat/messages
            Route::get('messages/private', ['uses' => 'ChatController@privateMessages']); //  GET /api/v2/chat/messages/private
            // Route::post('messages/new', ['uses' => 'ChatController@postMessage']);        // POST /api/v2/chat/messages/new
        });

        Route::group(['prefix' => 'beatmapsets'], function () {
            Route::get('favourites', ['uses' => 'BeatmapsetsController@favourites']);     //  GET /api/v2/beatmapsets/favourites
        });
        Route::group(['prefix' => 'beatmaps'], function () {
            Route::get('scores', ['uses' => 'BeatmapsController@scores']);                //  GET /api/v2/beatmaps/scores
            // Route::get('/{id}/scores', ['uses' => 'BeatmapsController@scores']);          //  GET /api/v2/beatmaps/:beatmap_id/scores
        });
        Route::get('me', ['uses' => 'UsersController@me']);                               //  GET /api/v2/me
        Route::get('users/{user}', ['uses' => 'UsersController@show']);                   //  GET /api/v2/users/:user_id
    });
    // legacy api routes
    Route::group(['prefix' => 'v1'], function () {
        Route::get('get_match', ['uses' => 'LegacyController@getMatch']);
        Route::get('get_packs', ['uses' => 'LegacyController@getPacks']);
        Route::get('get_user', ['uses' => 'LegacyController@getUser']);
        Route::get('get_user_best', ['uses' => 'LegacyController@getUserBest']);
        Route::get('get_user_recent', ['uses' => 'LegacyController@getUserRecent']);
        Route::get('get_replay', ['uses' => 'LegacyController@getReplay']);
        Route::get('get_scores', ['uses' => 'LegacyController@getScores']);
        Route::get('get_beatmaps', ['uses' => 'LegacyController@getBeatmaps']);
    });
});

// status
if (Config::get('app.debug')) {
    Route::get('/status', ['uses' => 'StatusController@getMain']);
} else {
    Route::group(['domain' => 'stat.ppy.sh'], function () {
        Route::get('/', ['uses' => 'StatusController@getMain']);
    });
}

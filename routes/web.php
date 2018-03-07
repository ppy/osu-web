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
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/beatmapsets/{beatmapset}/covers', 'BeatmapsetsController@covers')->name('beatmapsets.covers');
    Route::post('/beatmapsets/{beatmapset}/covers/regenerate', 'BeatmapsetsController@regenerateCovers')->name('beatmapsets.covers.regenerate');
    Route::post('/beatmapsets/{beatmapset}/covers/remove', 'BeatmapsetsController@removeCovers')->name('beatmapsets.covers.remove');
    Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show', 'update']]);

    Route::post('contests/{id}/zip', 'ContestsController@gimmeZip')->name('contests.get-zip');
    Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);

    Route::resource('logs', 'LogsController', ['only' => ['index']]);

    Route::get('/', 'PagesController@root')->name('root');

    Route::group(['as' => 'forum.', 'prefix' => 'forum', 'namespace' => 'Forum'], function () {
        Route::resource('forum-covers', 'ForumCoversController', ['only' => ['index', 'store', 'update']]);
    });

    Route::group(['as' => 'store.', 'prefix' => 'store', 'namespace' => 'Store'], function () {
        Route::resource('addresses', 'AddressesController', ['only' => ['update']]);

        Route::post('orders/ship', 'OrdersController@ship')->name('orders.ship');
        Route::resource('orders', 'OrdersController', ['only' => ['index', 'show', 'update']]);

        Route::resource('orders.items', 'OrderItemsController', ['only' => ['update']]);

        route_redirect('/', 'admin.store.orders.index');
    });
});

Route::group(['prefix' => 'beatmaps'], function () {
    // featured artists
    Route::resource('artists', 'ArtistsController', ['only' => ['index', 'show']]);
    Route::resource('packs', 'BeatmapPacksController', ['only' => ['index', 'show']]);
});
Route::get('beatmaps/{beatmap}/scores', 'BeatmapsController@scores')->name('beatmaps.scores');
Route::resource('beatmaps', 'BeatmapsController', ['only' => ['show']]);

Route::group(['prefix' => 'beatmapsets'], function () {
    Route::put('beatmap-discussions/{beatmap_discussion}/vote', 'BeatmapDiscussionsController@vote')->name('beatmap-discussions.vote');
    Route::post('beatmap-discussions/{beatmap_discussion}/restore', 'BeatmapDiscussionsController@restore')->name('beatmap-discussions.restore');
    Route::post('beatmap-discussions/{beatmap_discussion}/deny-kudosu', 'BeatmapDiscussionsController@denyKudosu')->name('beatmap-discussions.deny-kudosu');
    Route::post('beatmap-discussions/{beatmap_discussion}/allow-kudosu', 'BeatmapDiscussionsController@allowKudosu')->name('beatmap-discussions.allow-kudosu');
    Route::resource('beatmap-discussions', 'BeatmapDiscussionsController', ['only' => ['destroy', 'index', 'show']]);

    Route::post('beatmap-discussions-posts/{beatmap_discussion_post}/restore', 'BeatmapDiscussionPostsController@restore')->name('beatmap-discussion-posts.restore');
    Route::resource('beatmap-discussion-posts', 'BeatmapDiscussionPostsController', ['only' => ['destroy', 'index', 'store', 'update']]);
});

Route::group(['prefix' => 'beatmapsets', 'as' => 'beatmapsets.'], function () {
    Route::resource('events', 'BeatmapsetEventsController', ['only' => ['index']]);
    Route::resource('watches', 'BeatmapsetWatchesController', ['only' => ['index', 'update', 'destroy']]);

    Route::group(['prefix' => 'discussions', 'as' => 'discussions.'], function () {
        Route::resource('votes', 'BeatmapsetDiscussionVotesController', ['only' => ['index']]);
    });
});
Route::get('beatmapsets/search/{filters?}', 'BeatmapsetsController@search')->name('beatmapsets.search');
Route::get('beatmapsets/{beatmapset}/discussion/{beatmap?}/{mode?}/{filter?}', 'BeatmapsetsController@discussion')->name('beatmapsets.discussion');
Route::get('beatmapsets/{beatmapset}/download', 'BeatmapsetsController@download')->name('beatmapsets.download');
Route::put('beatmapsets/{beatmapset}/nominate', 'BeatmapsetsController@nominate')->name('beatmapsets.nominate');
Route::put('beatmapsets/{beatmapset}/disqualify', 'BeatmapsetsController@disqualify')->name('beatmapsets.disqualify');
Route::post('beatmapsets/{beatmapset}/update-favourite', 'BeatmapsetsController@updateFavourite')->name('beatmapsets.update-favourite');
Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['index', 'show', 'update']]);

Route::group(['prefix' => 'community'], function () {
    Route::get('chat', 'CommunityController@getChat')->name('chat');

    Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);

    Route::put('contest-entries/{contest_entry}/vote', 'ContestEntriesController@vote')->name('contest-entries.vote');
    Route::resource('contest-entries', 'ContestEntriesController', ['only' => ['store', 'destroy']]);

    Route::post('livestreams/promote', 'LivestreamsController@promote')->name('livestreams.promote');
    Route::resource('livestreams', 'LivestreamsController', ['only' => ['index']]);

    Route::get('matches/{match}/history', 'MatchesController@history')->name('matches.history');
    Route::resource('matches', 'MatchesController', ['only' => ['show']]);

    Route::post('tournaments/{tournament}/unregister', 'TournamentsController@unregister')->name('tournaments.unregister');
    Route::post('tournaments/{tournament}/register', 'TournamentsController@register')->name('tournaments.register');
    Route::resource('tournaments', 'TournamentsController');

    route_redirect('profile/{id}', 'users.show');

    Route::group(['as' => 'forum.', 'namespace' => 'Forum'], function () {
        Route::group(['prefix' => 'forums'], function () {
            Route::resource('forum-covers', 'ForumCoversController', ['only' => ['store', 'update', 'destroy']]);

            Route::get('posts/{post}/raw', 'PostsController@raw')->name('posts.raw');
            Route::post('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
            Route::resource('posts', 'PostsController', ['only' => ['destroy', 'edit', 'show', 'update']]);

            Route::post('topics/preview', 'TopicsController@preview')->name('topics.preview');
            Route::post('topics/{topic}/issue-tag', 'TopicsController@issueTag')->name('topics.issue-tag');
            Route::post('topics/{topic}/lock', 'TopicsController@lock')->name('topics.lock');
            Route::post('topics/{topic}/move', 'TopicsController@move')->name('topics.move');
            Route::post('topics/{topic}/pin', 'TopicsController@pin')->name('topics.pin');
            Route::post('topics/{topic}/reply', 'TopicsController@reply')->name('topics.reply');
            Route::post('topics/{topic}/vote', 'TopicsController@vote')->name('topics.vote');
            Route::post('topics/{topic}/vote-feature', 'TopicsController@voteFeature')->name('topics.vote-feature');
            Route::post('topics/{topic}/watch', 'TopicsController@watch')->name('topics.watch');
            Route::resource('topics', 'TopicsController', ['only' => ['create', 'show', 'store', 'update']]);

            Route::resource('topic-covers', 'TopicCoversController', ['only' => ['store', 'update', 'destroy']]);

            Route::resource('topic-watches', 'TopicWatchesController', ['only' => ['index']]);
        });

        Route::get('forums/search', 'ForumsController@search')->name('forums.search');
        Route::resource('forums', 'ForumsController', ['only' => ['index', 'show']]);
    });
});

Route::resource('groups', 'GroupsController', ['only' => ['show']]);

Route::group(['prefix' => 'home'], function () {
    Route::get('account/edit', 'AccountController@edit')->name('account.edit');
    // Uploading file doesn't quite work with PUT/PATCH.
    // Reference: https://bugs.php.net/bug.php?id=55815
    // Note that hhvm behaves differently (the same as POST).
    Route::post('account/avatar', 'AccountController@avatar')->name('account.avatar');
    Route::post('account/cover', 'AccountController@cover')->name('account.cover');
    Route::put('account/email', 'AccountController@updateEmail')->name('account.email');
    Route::put('account/page', 'AccountController@updatePage')->name('account.page');
    Route::put('account/password', 'AccountController@updatePassword')->name('account.password');
    Route::post('account/reissue-code', 'AccountController@reissueCode')->name('account.reissue-code');
    Route::post('account/verify', 'AccountController@verify')->name('account.verify');
    Route::put('account', 'AccountController@update')->name('account.update');

    Route::get('search', 'HomeController@search')->name('search');
    Route::get('quick-search', 'HomeController@quickSearch')->name('quick-search');
    Route::post('bbcode-preview', 'HomeController@bbcodePreview')->name('bbcode-preview');
    Route::resource('changelog', 'ChangelogController', ['only' => ['index', 'show']]);
    Route::get('download', 'HomeController@getDownload')->name('download');
    Route::get('icons', 'HomeController@getIcons');
    Route::post('set-locale', 'HomeController@setLocale')->name('set-locale');
    Route::get('support', 'HomeController@supportTheGame')->name('support-the-game');

    Route::delete('password-reset', 'PasswordResetController@destroy');
    Route::get('password-reset', 'PasswordResetController@index')->name('password-reset');
    Route::post('password-reset', 'PasswordResetController@create');
    Route::put('password-reset', 'PasswordResetController@update');

    Route::get('support-osu-popup', 'HomeController@osuSupportPopup')->name('support-osu-popup');
    Route::get('download-quota-check', 'HomeController@downloadQuotaCheck')->name('download-quota-check');

    Route::resource('friends', 'FriendsController', ['only' => ['index', 'store', 'destroy']]);
    Route::resource('news', 'NewsController', ['except' => ['destroy']]);
});

Route::get('legal/{page}', 'LegalController@show')->name('legal');

Route::get('rankings/{mode?}/{type?}', 'RankingController@index')->name('rankings');

Route::post('session', 'SessionsController@store')->name('login');
Route::delete('session', 'SessionsController@destroy')->name('logout');

Route::post('users/check-username-availability', 'UsersController@checkUsernameAvailability')->name('users.check-username-availability');
Route::post('users/check-username-exists', 'UsersController@checkUsernameExists')->name('users.check-username-exists');
Route::get('users/disabled', 'UsersController@disabled')->name('users.disabled');
Route::get('users/{user}/card', 'UsersController@card')->name('users.card');

// extras
Route::get('users/{user}/kudosu', 'UsersController@kudosu')->name('users.kudosu');
Route::get('users/{user}/recent_activity', 'UsersController@recentActivity')->name('users.recent-activity');
Route::get('users/{user}/scores/{type}', 'UsersController@scores')->name('users.scores');
Route::get('users/{user}/beatmapsets/{type}', 'UsersController@beatmapsets')->name('users.beatmapsets');

Route::get('users/{user}/beatmapset-activities', 'UsersController@beatmapsetActivities')->name('users.beatmapset-activities');
Route::get('users/{user}/{mode?}', 'UsersController@show')->name('users.show');
// Route::resource('users', 'UsersController', ['only' => 'store']);

Route::group(['prefix' => 'help'], function () {
    // help section
    Route::get('wiki/{page?}', 'WikiController@show')->name('wiki.show')->where('page', '.+');
    Route::put('wiki/{page}', 'WikiController@update')->where('page', '.+');
    route_redirect('/', 'wiki.show');

    Route::get('support', 'HelpController@getSupport')->name('support');
    Route::get('faq', 'HelpController@getFaq')->name('faq');
});

// FIXME: someone split this crap up into proper controllers
Route::group(['as' => 'store.', 'prefix' => 'store'], function () {
    Route::get('/', 'StoreController@getIndex');

    Route::get('listing', 'StoreController@getListing')->name('products.index');
    Route::get('invoice/{invoice}', 'StoreController@getInvoice')->name('invoice.show');

    Route::post('update-cart', 'Store\CartController@store'); // temporarily to avoid 404ing after deploy
    Route::post('update-address', 'StoreController@postUpdateAddress');
    Route::post('new-address', 'StoreController@postNewAddress');
    Route::post('add-to-cart', 'StoreController@postAddToCart');

    Route::group(['namespace' => 'Store'], function () {
        Route::post('products/{product}/notification-request', 'NotificationRequestsController@store')->name('notification-request');
        Route::delete('products/{product}/notification-request', 'NotificationRequestsController@destroy');

        // Store splitting starts here
        Route::get('cart', 'CartController@show')->name('cart.show');
        Route::resource('cart', 'CartController', ['only' => ['store']]);

        Route::delete('checkout', 'CheckoutController@destroy')->name('checkout.destroy');
        Route::get('checkout', 'CheckoutController@show')->name('checkout.show');
        Route::resource('checkout', 'CheckoutController', ['only' => ['store']]);

        route_redirect('product/{product}', 'store.products.show');
        Route::resource('products', 'ProductsController', ['only' => ['show']]);
    });
});

Route::group(['as' => 'payments.', 'prefix' => 'payments', 'namespace' => 'Payments'], function () {
    Route::group(['as' => 'paypal.', 'prefix' => 'paypal'], function () {
        Route::get('approved', 'PaypalController@approved')->name('approved');
        Route::get('declined', 'PaypalController@declined')->name('declined');
        Route::post('create', 'PaypalController@create')->name('create');
        Route::get('completed', 'PaypalController@completed')->name('completed');
        Route::post('ipn', 'PaypalController@ipn')->name('ipn');
    });

    Route::group(['as' => 'xsolla.', 'prefix' => 'xsolla'], function () {
        Route::get('completed', 'XsollaController@completed')->name('completed');
        Route::post('token', 'XsollaController@token')->name('token');
        Route::post('callback', 'XsollaController@callback')->name('callback');
    });

    Route::group(['as' => 'centili.', 'prefix' => 'centili'], function () {
        Route::match(['post', 'get'], 'callback', 'CentiliController@callback')->name('callback');
        Route::get('completed', 'CentiliController@completed')->name('completed');
        Route::get('failed', 'CentiliController@failed')->name('failed');
    });
});

// API
Route::group(['as' => 'api.', 'prefix' => 'api', 'namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'v2'], function () {
        Route::group(['prefix' => 'chat'], function () {
            //  GET /api/v2/chat/channels
            Route::get('channels', 'ChatController@channels');
            //  GET /api/v2/chat/messages
            Route::get('messages', 'ChatController@messages');
            //  GET /api/v2/chat/messages/private
            Route::get('messages/private', 'ChatController@privateMessages');
            // POST /api/v2/chat/messages/new
            Route::post('messages', 'ChatController@postMessage');
        });

        Route::resource('rooms', 'RoomsController', ['only' => ['show']]);

        Route::group(['prefix' => 'beatmapsets'], function () {
            Route::get('favourites', 'BeatmapsetsController@favourites');     //  GET /api/v2/beatmapsets/favourites
        });

        // Beatmaps
        //   GET /api/v2/beatmaps/:beatmap_id/scores
        Route::get('beatmaps/{id}/scores', '\App\Http\Controllers\BeatmapsController@scores');
        //   GET /api/v2/beatmaps/lookup
        Route::get('beatmaps/lookup', 'BeatmapsController@lookup');
        //   GET /api/v2/beatmaps/:beatmap_id
        Route::resource('beatmaps', 'BeatmapsController', ['only' => ['show']]);

        // Beatmapsets
        //   GET /api/v2/beatmapsets/search/:filters
        Route::get('beatmapsets/search/{filters?}', '\App\Http\Controllers\BeatmapsetsController@search');
        //   GET /api/v2/beatmapsets/lookup
        Route::get('beatmapsets/lookup', 'BeatmapsetsController@lookup');
        //   GET /api/v2/beatmapsets/:beatmapset/download
        Route::get('beatmapsets/{beatmapset}/download', '\App\Http\Controllers\BeatmapsetsController@download');
        //   GET /api/v2/beatmapsets/:beatmapset_id
        Route::resource('beatmapsets', '\App\Http\Controllers\BeatmapsetsController', ['only' => ['show']]);

        // Friends
        //  GET /api/v2/friends
        Route::resource('friends', '\App\Http\Controllers\FriendsController', ['only' => ['index']]);

        //  GET /api/v2/me
        Route::get('me', '\App\Http\Controllers\UsersController@me');
        //  GET /api/v2/me/download-quota-check
        Route::get('me/download-quota-check', '\App\Http\Controllers\HomeController@downloadQuotaCheck');
        //  GET /api/v2/rankings/:mode/:type
        Route::get('rankings/{mode}/{type}', '\App\Http\Controllers\RankingController@index');

        //  GET /api/v2/users/:user_id/kudosu
        Route::get('users/{user}/kudosu', '\App\Http\Controllers\UsersController@kudosu');
        //  GET /api/v2/users/:user_id/scores/:type [best, firsts, recent]
        Route::get('users/{user}/scores/{type}', '\App\Http\Controllers\UsersController@scores');
        //  GET /api/v2/users/:user_id/beatmapsets/:type [most_played, favourite, ranked_and_approved, unranked, graveyard]
        Route::get('users/{user}/beatmapsets/{type}', '\App\Http\Controllers\UsersController@beatmapsets');
        // GET /api/v2/users/:user_id/recent_activity
        Route::get('users/{user}/recent_activity', '\App\Http\Controllers\UsersController@recentActivity');
        //  GET /api/v2/users/:user_id/:mode [osu, taiko, fruits, mania]
        Route::get('users/{user}/{mode?}', '\App\Http\Controllers\UsersController@show');
    });
    // legacy api routes
    Route::group(['prefix' => 'v1'], function () {
        Route::get('get_match', 'LegacyController@getMatch');
        Route::get('get_packs', 'LegacyController@getPacks');
        Route::get('get_user', 'LegacyController@getUser');
        Route::get('get_user_best', 'LegacyController@getUserBest');
        Route::get('get_user_recent', 'LegacyController@getUserRecent');
        Route::get('get_replay', 'LegacyController@getReplay');
        Route::get('get_scores', 'LegacyController@getScores');
        Route::get('get_beatmaps', 'LegacyController@getBeatmaps');
    });
});

// Callbacks for legacy systems to interact with
Route::group(['prefix' => '_lio', 'middleware' => 'lio'], function () {
    Route::post('/refresh-beatmapset-cache/{beatmapset}', 'LegacyInterOpController@refreshBeatmapsetCache');
    Route::post('/regenerate-beatmapset-covers/{beatmapset}', 'LegacyInterOpController@regenerateBeatmapsetCovers');
    Route::get('/news', 'LegacyInterOpController@news');
});

Route::get('/home', 'HomeController@index')->name('home');
route_redirect('/', 'home');

// redirects go here
route_redirect('forum/p/{post}', 'forum.posts.show');
route_redirect('forum/t/{topic}', 'forum.topics.show');
route_redirect('forum/{forum}', 'forum.forums.show');
// redirects to beatmapset anyways so there's no point
// in having an another redirect on top of that
Route::get('b/{beatmap}', 'BeatmapsController@show');
route_redirect('g/{group}', 'groups.show');
route_redirect('s/{beatmapset}', 'beatmapsets.show');
route_redirect('u/{user}', 'users.show');
route_redirect('forum', 'forum.forums.index');
route_redirect('mp/{match}', 'matches.show');
route_redirect('wiki/{page?}', 'wiki.show');

// status
if (Config::get('app.debug')) {
    Route::get('/status', 'StatusController@getMain');
} else {
    Route::group(['domain' => 'stat.ppy.sh'], function () {
        Route::get('/', 'StatusController@getMain');
    });
}

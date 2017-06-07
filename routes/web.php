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
    Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show']]);

    Route::resource('beatmapset-discussions', 'BeatmapsetDiscussionsController', ['only' => ['store']]);

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

        Route::get('/', function () {
            return ujs_redirect(route('admin.store.orders.index'));
        });
    });
});

Route::group(['prefix' => 'beatmaps'], function () {
    // featured artists
    Route::resource('artists', 'ArtistsController', ['only' => ['index', 'show']]);
});
Route::get('beatmaps/{beatmap}/scores', 'BeatmapsController@scores')->name('beatmaps.scores');
Route::resource('beatmaps', 'BeatmapsController', ['only' => ['show']]);

Route::group(['prefix' => 'beatmapsets'], function () {
    Route::put('beatmap-discussions/{beatmap_discussion}/vote', 'BeatmapDiscussionsController@vote')->name('beatmap-discussions.vote');
    Route::post('beatmap-discussions/{beatmap_discussion}/restore', 'BeatmapDiscussionsController@restore')->name('beatmap-discussions.restore');
    Route::post('beatmap-discussions/{beatmap_discussion}/deny-kudosu', 'BeatmapDiscussionsController@denyKudosu')->name('beatmap-discussions.deny-kudosu');
    Route::post('beatmap-discussions/{beatmap_discussion}/allow-kudosu', 'BeatmapDiscussionsController@allowKudosu')->name('beatmap-discussions.allow-kudosu');
    Route::resource('beatmap-discussions', 'BeatmapDiscussionsController', ['only' => ['destroy', 'show']]);

    Route::post('beatmap-discussions-posts/{beatmap_discussion_post}/restore', 'BeatmapDiscussionPostsController@restore')->name('beatmap-discussion-posts.restore');
    Route::resource('beatmap-discussion-posts', 'BeatmapDiscussionPostsController', ['only' => ['destroy', 'store', 'update']]);
});
Route::get('beatmapsets/search/{filters?}', 'BeatmapsetsController@search')->name('beatmapsets.search');
Route::get('beatmapsets/{beatmapset}/discussion', 'BeatmapsetsController@discussion')->name('beatmapsets.discussion');
Route::put('beatmapsets/{beatmapset}/nominate', 'BeatmapsetsController@nominate')->name('beatmapsets.nominate');
Route::put('beatmapsets/{beatmapset}/disqualify', 'BeatmapsetsController@disqualify')->name('beatmapsets.disqualify');
Route::post('beatmapsets/{beatmapset}/update-favourite', 'BeatmapsetsController@updateFavourite')->name('beatmapsets.update-favourite');
Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['index', 'show']]);

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

    Route::get('profile/{id}', function ($id) {
        return ujs_redirect(route('users.show', $id));
    });

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

    // FIXME: enable later.
    // Route::get('search', 'HomeController@search')->name('search');
    Route::post('bbcode-preview', 'HomeController@bbcodePreview')->name('bbcode-preview');
    Route::get('changelog', 'HomeController@getChangelog')->name('changelog');
    Route::get('download', 'HomeController@getDownload')->name('download');
    Route::get('icons', 'HomeController@getIcons');
    Route::post('set-locale', 'HomeController@setLocale')->name('set-locale');
    Route::get('support', 'HomeController@supportTheGame')->name('support-the-game');

    Route::delete('password-reset', 'PasswordResetController@destroy');
    Route::get('password-reset', 'PasswordResetController@index')->name('password-reset');
    Route::post('password-reset', 'PasswordResetController@create');
    Route::put('password-reset', 'PasswordResetController@update');

    Route::resource('news', 'NewsController', ['except' => ['destroy']]);
});

Route::get('legal/{page}', 'LegalController@show')->name('legal');

// ranking section
Route::get('/rankings/{mode?}', function ($mode = 'osu') {
    if (!array_key_exists($mode, App\Models\Beatmap::MODES)) {
        abort(404);
    }

    return Redirect::route('rankings', ['mode' => $mode, 'type' => 'performance']);
});
Route::get('/rankings/{mode}/{type}', 'RankingController@index')->name('rankings');

Route::post('session', 'SessionsController@store')->name('login');
Route::delete('session', 'SessionsController@destroy')->name('logout');

Route::post('users/check-username-availability', 'UsersController@checkUsernameAvailability')->name('users.check-username-availability');
Route::get('users/disabled', 'UsersController@disabled')->name('users.disabled');
Route::get('users/register', function () {
    return Redirect::to('https://osu.ppy.sh/p/register');
})->name('users.register');
Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::group(['prefix' => 'help'], function () {
    // help section
    Route::get('wiki/{page}', 'WikiController@show')->name('wiki.show')->where('page', '.+');
    Route::put('wiki/{page}', 'WikiController@update')->where('page', '.+');
    Route::get('wiki', function () {
        return ujs_redirect(wiki_url());
    })->name('wiki');

    Route::get('support', 'HelpController@getSupport')->name('support');
    Route::get('faq', 'HelpController@getFaq')->name('faq');

    Route::get('/', function () {
        return ujs_redirect(wiki_url());
    });
});

// FIXME: someone split this crap up into proper controllers
Route::get('store', 'StoreController@getIndex');
Route::get('store/listing', 'StoreController@getListing')->name('store.products.index');
Route::get('store/invoice', 'StoreController@getInvoice');
Route::get('store/invoice/{invoice}', 'StoreController@getInvoice');
Route::get('store/product/{product}', 'StoreController@getProduct')->name('store.product');
Route::get('store/cart', 'StoreController@getCart');
Route::get('store/checkout', 'StoreController@getCheckout');
Route::post('store/update-cart', 'StoreController@postUpdateCart');
Route::post('store/update-address', 'StoreController@postUpdateAddress');
Route::post('store/new-address', 'StoreController@postNewAddress');
Route::post('store/add-to-cart', 'StoreController@postAddToCart');
Route::post('store/checkout', 'StoreController@postCheckout');
Route::post('store/products/{product}/notification-request', 'Store\NotificationRequestsController@store')->name('store.notification-request');
Route::delete('store/products/{product}/notification-request', 'Store\NotificationRequestsController@destroy');

// API
Route::group(['as' => 'api.', 'prefix' => 'api', 'namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'v2'], function () {
        Route::group(['prefix' => 'chat'], function () {
            //  GET /api/v2/chat/channels
            Route::get('channels', ['uses' => 'ChatController@channels']);
            //  GET /api/v2/chat/messages
            Route::get('messages', ['uses' => 'ChatController@messages']);
            //  GET /api/v2/chat/messages/private
            Route::get('messages/private', ['uses' => 'ChatController@privateMessages']);
            // POST /api/v2/chat/messages/new
            Route::post('messages', ['uses' => 'ChatController@postMessage']);
        });

        Route::resource('rooms', 'RoomsController', ['only' => ['show']]);

        Route::group(['prefix' => 'beatmapsets'], function () {
            Route::get('favourites', ['uses' => 'BeatmapsetsController@favourites']);     //  GET /api/v2/beatmapsets/favourites
        });

        // Beatmaps
        //   GET /api/v2/beatmaps/:beatmap_id/scores
        Route::get('beatmaps/{id}/scores', ['uses' => '\App\Http\Controllers\BeatmapsController@scores']);
        //   GET /api/v2/beatmaps/lookup
        Route::get('beatmaps/lookup', ['uses' => 'BeatmapsController@lookup']);
        //   GET /api/v2/beatmaps/:beatmap_id
        Route::resource('beatmaps', 'BeatmapsController', ['only' => ['show']]);
        //   GET /api/v2/beatmapsets/search/:filters
        Route::get('beatmapsets/search/{filters?}', '\App\Http\Controllers\BeatmapsetsController@search');

        //  GET /api/v2/me
        Route::get('me', ['uses' => 'UsersController@me']);
        //  GET /api/v2/rankings/:mode/:type
        Route::get('rankings/{mode}/{type}', '\App\Http\Controllers\RankingController@index');
        //  GET /api/v2/users/:user_id
        Route::get('users/{user}', ['uses' => 'UsersController@show']);
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

// Callbacks for legacy systems to interact with
Route::group(['prefix' => '_lio', 'middleware' => 'lio'], function () {
    Route::post('/regenerate-beatmapset-covers/{beatmapset}', ['uses' => 'LegacyInterOpController@regenerateBeatmapsetCovers']);
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return ujs_redirect(route('home'));
});

// redirects go here
Route::get('forum/p/{post}', function ($post) {
    return ujs_redirect(route('forum.posts.show', compact('post')));
});
Route::get('forum/t/{topic}', function ($topic) {
    return ujs_redirect(route('forum.topics.show', compact('topic')));
});
Route::get('forum/{forum}', function ($forum) {
    return ujs_redirect(route('forum.forums.show', compact('forum')));
});
// redirects to beatmapset anyways so there's no point
// in having an another redirect on top of that
Route::get('b/{beatmap}', ['uses' => 'BeatmapsController@show']);

Route::get('s/{beatmapset}', function ($beatmapset) {
    return ujs_redirect(route('beatmapsets.show', compact('beatmapset')));
});

Route::get('u/{user}', function ($user) {
    return ujs_redirect(route('users.show', compact('user')));
});

Route::get('forum', function () {
    return ujs_redirect(route('forum.forums.index'));
});

// temporary news redirect
Route::get('news/{id}', function ($id) {
    return Redirect::to("https://osu.ppy.sh/news/{$id}");
});

Route::get('mp/{match}', function ($match) {
    return ujs_redirect(route('matches.show', compact('match')));
});

// soon-to-be notifications
Route::get('notifications', ['as' => 'notifications.index', function () {
    return Redirect::to('https://osu.ppy.sh/forum/ucp.php?i=pm&folder=inbox');
}]);

Route::get('wiki', function () {
    return ujs_redirect(route('wiki'));
})->where('page', '.+');

Route::get('wiki/{page}', function ($page) {
    return ujs_redirect(route('wiki.show', compact('page')));
})->where('page', '.+');

// status
if (Config::get('app.debug')) {
    Route::get('/status', ['uses' => 'StatusController@getMain']);
} else {
    Route::group(['domain' => 'stat.ppy.sh'], function () {
        Route::get('/', ['uses' => 'StatusController@getMain']);
    });
}

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

$main_domain = $store_domain = $stat_domain = Config::get('osu.domains.base_domain');

if (Config::get('osu.domains.use_subdomains')) {
    $main_domain = Config::get('osu.domains.main_prefix').'.'.$main_domain;
    $store_domain = Config::get('osu.domains.store_prefix').'.'.$store_domain;
    $stat_domain = Config::get('osu.domains.stat_prefix').'.'.$stat_domain;
}

/*
|--------------------------------------------------------------------------
| Store routes
|--------------------------------------------------------------------------
*/

Route::group(['domain' => $store_domain], function () {
    Route::controller('/store', 'StoreController', [
        'getProduct' => 'store.product',
        'putRequestNotification' => 'store.request-notification',
    ]);

    Route::get('/', function () {
        return Redirect::to('/store');
    });
});

/*
|--------------------------------------------------------------------------
| Status routes
|--------------------------------------------------------------------------
*/

Route::group(['domain' => $stat_domain], function () {
    Route::get('/', ['uses' => 'StatusController@getMain']);
});

/*
|--------------------------------------------------------------------------
| Main site routes
|--------------------------------------------------------------------------
*/

Route::group(['domain' => $main_domain], function () {
    if (Config::get('app.debug')) {
        Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getNews']);
    } else {
        Route::get('/', ['as' => 'home', function () {
            return Redirect::to('/forum');
        }]);
    }

    // Home section
    Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
        Route::get('/news', ['as' => 'news', 'uses' => 'HomeController@getNews']);
        Route::get('/download', ['as' => 'download', 'uses' => 'HomeController@getDownload']);
        Route::get('/changelog', ['as' => 'changelog', 'uses' => 'HomeController@getChangelog']);
        Route::get('/support', ['as' => 'supporter', 'uses' => 'HomeController@getSupporter']);
    });

    // Beatmaps section
    Route::group(['prefix' => 'beatmaps', 'as' => 'beatmaps.'], function () {
        // Route::get('/packs', ['as' => 'packs', 'uses' => 'BeatmapsController@getPacks']);
        // Route::get('/charts/{id?}', ['as' => 'charts', 'uses' => 'BeatmapsController@getCharts']);

        Route::get('/{beatmaps}/scores', ['as' => 'scores', 'uses' => 'BeatmapsController@scores']);
    });
    Route::get('/b/{beatmaps}', ['as' => 'beatmaps.show', 'uses' => 'BeatmapsController@show']);

    // Beatmapsets section
    Route::group(['prefix' => 'beatmapsets', 'as' => 'beatmapsets.'], function () {
        Route::get('/search/{filters?}', ['as' => 'search', 'uses' => 'BeatmapsetsController@search']);
        Route::get('/{beatmapsets}/discussion', ['as' => 'discussion', 'uses' => 'BeatmapsetsController@discussion']);
    });
    Route::resource('/beatmapsets', 'BeatmapsetsController', ['only' => ['index']]);
    Route::get('/s/{beatmapsets}', ['as' => 'beatmapsets.show', 'uses' => 'BeatmapsetsController@show']);

    // Ranking section
    Route::group(['prefix' => 'ranking', 'as' => 'ranking.'], function () {
        Route::get('/overall', ['as' => 'overall', 'uses' => 'RankingController@getOverall']);
        Route::get('/charts', ['as' => 'charts', 'uses' => 'RankingController@getCharts']);
        Route::get('/country', ['as' => 'country', 'uses' => 'RankingController@getCountry']);
        Route::get('/mapper', ['as' => 'mapper', 'uses' => 'RankingController@getMapper']);
    });

    // Livestreams section
    Route::resource('livestreams', 'LivestreamsController', ['only' => ['index']]);
    Route::group(['prefix' => 'livestreams', 'as' => 'livestreams.'], function () {
        Route::post('promote', ['as' => 'livestreams.promote', 'uses' => 'LivestreamsController@promote']);
    });

    // Community section
    Route::group(['prefix' => 'community', 'as' => 'community.'], function () {
        Route::get('/chat', ['as' => 'chat', 'uses' => 'CommunityController@getChat']);
        Route::get('/slack', ['as' => 'slack', 'uses' => 'CommunityController@getSlack']);
        Route::post('/slack/agree', ['as' => 'slack.agree', 'uses' => 'CommunityController@postSlackAgree']);

        Route::get('/profile/{id}', function ($id) {
            return Redirect::route('users.show', $id);
        });

        Route::get('/forum', function () {
            return Redirect::to('/forum');
        });
    });

    // Show user
    Route::get('u/{users}', ['as' => 'users.show', 'uses' => 'UsersController@show']);

    // Help section
    Route::group(['prefix' => 'help', 'as' => 'help.'], function () {
        Route::get('/support', ['as' => 'support', 'uses' => 'HelpController@getSupport']);
        Route::get('/faq', ['as' => 'faq', 'uses' => 'HelpController@getFaq']);
    });

    Route::get('/wiki', ['as' => 'help.wiki', function () {
        return Redirect::to('https://osu.ppy.sh/wiki');
    }]);

    // Catchall controllers
    Route::controller('/notifications', 'NotificationController');

    // Tournaments section
    Route::resource('tournaments', 'TournamentsController');
    Route::group(['prefix' => 'tournaments', 'as' => 'tournaments.'], function () {
        Route::post('/{tournament}/unregister', ['as' => 'unregister', 'uses' => 'TournamentsController@unregister']);
        Route::post('/{tournament}/register', ['as' => 'register', 'uses' => 'TournamentsController@register']);
    });

    // Forum section
    Route::group(['prefix' => 'forum', 'as' => 'forum.', 'namespace' => 'Forum'], function () {
        Route::get('/', ['as' => 'forums.index', 'uses' => 'ForumsController@index']);
        Route::get('{forums}', ['as' => 'forums.show', 'uses' => 'ForumsController@show']);

        Route::get('t/{topics}', ['as' => 'topics.show', 'uses' => 'TopicsController@show']);
        Route::post('topics/preview', ['as' => 'topics.preview', 'uses' => 'TopicsController@preview']);
        Route::post('topics/{topics}/reply', ['as' => 'topics.reply', 'uses' => 'TopicsController@reply']);
        Route::post('topics/{topics}/lock', ['as' => 'topics.lock', 'uses' => 'TopicsController@lock']);
        Route::post('topics/{topics}/move', ['as' => 'topics.move', 'uses' => 'TopicsController@move']);
        Route::post('topics/{topics}/vote-feature', ['as' => 'topics.vote-feature', 'uses' => 'TopicsController@voteFeature']);

        Route::get('p/{posts}', ['as' => 'posts.show', 'uses' => 'PostsController@show']);
        Route::get('posts/{posts}/raw', ['as' => 'posts.raw', 'uses' => 'PostsController@raw']);
    });

    Route::group(['prefix' => 'forum', 'namespace' => 'Forum'], function () {
        Route::resource('topics', 'TopicsController', ['only' => ['create', 'store']]);
        Route::resource('posts', 'PostsController', ['only' => ['destroy', 'update', 'edit']]);

        Route::resource('forum-covers', 'ForumCoversController', ['only' => ['store', 'update', 'destroy']]);
        Route::resource('topic-covers', 'TopicCoversController', ['only' => ['store', 'update', 'destroy']]);
    });

    Route::group(['prefix' => 'beatmap-discussions', 'as' => 'beatmap-discussions.'], function () {
        Route::put('/{beatmap_discussions}/vote', ['uses' => 'BeatmapDiscussionsController@vote', 'as' => 'vote']);
    });
    Route::resource('beatmap-discussion-posts', 'BeatmapDiscussionPostsController', ['only' => ['store', 'update']]);

    // Account section

    // Uploading file doesn't quite work with PUT/PATCH.
    // Reference: https://bugs.php.net/bug.php?id=55815
    // Note that hhvm behaves differently (the same as POST).
    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::post('/update-profile', ['as' => 'update-profile', 'uses' => 'AccountController@updateProfile']);
        Route::put('/page', ['as' => 'page', 'uses' => 'AccountController@updatePage']);
    });

    // Admin section
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

            Route::get('/', function () {
                return Redirect::route('admin.store.orders.index');
            });
        });

        Route::group(['prefix' => 'forum', 'namespace' => 'Forum'], function () {
            Route::resource('forum-covers', 'ForumCoversController', ['only' => ['index', 'store', 'update']]);
        });
    });

    // OAuth2 (for API)
    Route::group(['prefix' => 'oauth', 'as' => 'oauth.'], function () {
        Route::get('/authorize', ['as' => 'authorize.get', 'middleware' => ['check-authorization-params'], 'uses' => 'OAuthController@authorizeForm']);
        Route::post('/authorize', ['as' => 'authorize.post', 'middleware' => ['check-authorization-params'], 'uses' => 'OAuthController@authorizePost']);
        Route::post('/access_token', ['uses' => 'OAuthController@getAccessToken']);
    });


    // Status debug section
    if (Config::get('app.debug')) {
        Route::get('/status', ['uses' => 'StatusController@getMain']);
    }

    Route::get('/icons', 'HomeController@getIcons');
});

// Users section
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::post('/check-username-availability', ['as' => 'check-username-availability', 'uses' => 'UsersController@checkUsernameAvailability']);
    Route::post('/login', ['as' => 'login', 'uses' => 'UsersController@login']);
    Route::delete('/logout', ['as' => 'logout', 'uses' => 'UsersController@logout']);
    Route::get('/disabled', ['as' => 'disabled', 'uses' => 'UsersController@disabled']);

    // Authentication section (Temporarily set up as replacement/improvement of config("osu.urls.*"))
    Route::get('/forgot-password', ['as' => 'forgot-password', function () {
        return Redirect::to('https://osu.ppy.sh/p/forgot');
    }]);
    Route::get('/register', ['as' => 'register', function () {
        return Redirect::to('https://osu.ppy.sh/p/register');
    }]);
});

// API
Route::group(['prefix' => 'api', 'namespace' => 'API', 'middleware' => 'oauth'], function () {
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
        Route::get('users/{id}', ['uses' => 'UsersController@show']);                     //  GET /api/v2/users/:user_id
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

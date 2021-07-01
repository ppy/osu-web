<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Http\Middleware\ThrottleRequests;

Route::group(['middleware' => ['web']], function () {
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/beatmapsets/{beatmapset}/covers', 'BeatmapsetsController@covers')->name('beatmapsets.covers');
        Route::post('/beatmapsets/{beatmapset}/covers/regenerate', 'BeatmapsetsController@regenerateCovers')->name('beatmapsets.covers.regenerate');
        Route::post('/beatmapsets/{beatmapset}/covers/remove', 'BeatmapsetsController@removeCovers')->name('beatmapsets.covers.remove');
        Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show', 'update']]);

        Route::post('contests/{contest}/zip', 'ContestsController@gimmeZip')->name('contests.get-zip');
        Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);

        Route::resource('user-contest-entries', 'UserContestEntriesController', ['only' => ['destroy']]);
        Route::post('user-contest-entries/{user_contest_entry}/restore', 'UserContestEntriesController@restore')->name('user-contest-entries.restore');

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
        Route::get('packs/{pack}/raw', 'BeatmapPacksController@raw')->name('packs.raw');

        Route::group(['as' => 'beatmaps.', 'prefix' => '{beatmap}'], function () {
            Route::get('scores/users/{user}', 'BeatmapsController@userScore');
            Route::get('scores', 'BeatmapsController@scores')->name('scores');
            Route::put('update-owner', 'BeatmapsController@updateOwner')->name('update-owner');
        });
    });

    Route::resource('beatmaps', 'BeatmapsController', ['only' => ['show']]);

    Route::group(['prefix' => 'beatmapsets'], function () {
        route_redirect('beatmap-discussions', 'beatmapsets.discussions.index');
        route_redirect('beatmap-discussions/{beatmap_discussion}', 'beatmapsets.discussions.destroy', 'delete');
        route_redirect('beatmap-discussions/{beatmap_discussion}', 'beatmapsets.discussions.show');
        route_redirect('beatmap-discussions/{beatmap_discussion}/vote', 'beatmapsets.discussions.vote', 'put');
        route_redirect('beatmap-discussions/{beatmap_discussion}/restore', 'beatmapsets.discussions.restore', 'post');
        route_redirect('beatmap-discussions/{beatmap_discussion}/deny-kudosu', 'beatmapsets.discussions.deny-kudosu', 'post');
        route_redirect('beatmap-discussions/{beatmap_discussion}/allow-kudosu', 'beatmapsets.discussions.allow-kudosu', 'post');

        route_redirect('beatmap-discussion-posts/{beatmap_discussion_post}', 'beatmapsets.discussions.posts.destroy', 'delete');
        route_redirect('beatmap-discussion-posts/{beatmap_discussion_post}', 'beatmapsets.discussions.posts.store', 'post');
        route_redirect('beatmap-discussion-posts/{beatmap_discussion_post}', 'beatmapsets.discussions.posts.update', 'put');
        route_redirect('beatmap-discussion-posts/{beatmap_discussion_post}/restore', 'beatmapsets.discussions.posts.restore', 'post');
        route_redirect('beatmap-discussion-posts', 'beatmapsets.discussions.posts.index');
    });

    Route::group(['prefix' => 'beatmapsets', 'as' => 'beatmapsets.'], function () {
        Route::resource('events', 'BeatmapsetEventsController', ['only' => ['index']]);
        // keeping old link alive
        route_redirect('watches', 'follows.index');
        Route::resource('watches', 'BeatmapsetWatchesController', ['only' => ['update', 'destroy']]);

        Route::group(['prefix' => 'discussions', 'as' => 'discussions.'], function () {
            Route::put('{discussion}/vote', 'BeatmapDiscussionsController@vote')->name('vote');
            Route::post('{discussion}/restore', 'BeatmapDiscussionsController@restore')->name('restore');
            Route::post('{discussion}/deny-kudosu', 'BeatmapDiscussionsController@denyKudosu')->name('deny-kudosu');
            Route::post('{discussion}/allow-kudosu', 'BeatmapDiscussionsController@allowKudosu')->name('allow-kudosu');

            Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
                Route::post('{post}/restore', 'BeatmapDiscussionPostsController@restore')->name('restore');
            });

            Route::resource('posts', 'BeatmapDiscussionPostsController', ['only' => ['destroy', 'index', 'show', 'store', 'update']]);
            Route::resource('votes', 'BeatmapsetDiscussionVotesController', ['only' => ['index']]);
        });

        Route::resource('discussions', 'BeatmapDiscussionsController', ['only' => ['destroy', 'index', 'show']]);

        Route::group(['namespace' => 'Beatmapsets'], function () {
            Route::apiResource('{beatmapset}/favourites', 'FavouritesController', ['only' => ['store']]);
        });
    });
    Route::get('beatmapsets/search/{filters?}', 'BeatmapsetsController@search')->name('beatmapsets.search');
    Route::get('beatmapsets/{beatmapset}/discussion/{beatmap?}/{mode?}/{filter?}', 'BeatmapsetsController@discussion')->name('beatmapsets.discussion');
    Route::post('beatmapsets/{beatmapset}/discussion/review', 'BeatmapDiscussionsController@review')->name('beatmapsets.discussion.review');
    Route::post('beatmapsets/{beatmapset}/discussion-lock', 'BeatmapsetsController@discussionLock')->name('beatmapsets.discussion-lock');
    Route::post('beatmapsets/{beatmapset}/discussion-unlock', 'BeatmapsetsController@discussionUnlock')->name('beatmapsets.discussion-unlock');
    Route::get('beatmapsets/{beatmapset}/download', 'BeatmapsetsController@download')->name('beatmapsets.download');
    Route::put('beatmapsets/{beatmapset}/love', 'BeatmapsetsController@love')->name('beatmapsets.love');
    Route::delete('beatmapsets/{beatmapset}/love', 'BeatmapsetsController@removeFromLoved')->name('beatmapsets.remove-from-loved');
    Route::put('beatmapsets/{beatmapset}/nominate', 'BeatmapsetsController@nominate')->name('beatmapsets.nominate');
    Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['destroy', 'index', 'show', 'update']]);

    Route::group(['prefix' => 'scores/{mode}', 'as' => 'scores.'], function () {
        Route::get('{score}/download', 'ScoresController@download')->name('download');
        Route::get('{score}', 'ScoresController@show')->name('show');
    });

    Route::resource('client-verifications', 'ClientVerificationsController', ['only' => ['create', 'store']]);

    Route::resource('comments', 'CommentsController', ['except' => ['create', 'edit']]);
    Route::post('comments/{comment}/pin', 'CommentsController@pinStore')->name('comments.pin');
    Route::delete('comments/{comment}/pin', 'CommentsController@pinDestroy');
    Route::post('comments/{comment}/restore', 'CommentsController@restore')->name('comments.restore');
    Route::post('comments/{comment}/vote', 'CommentsController@voteStore')->name('comments.vote');
    Route::delete('comments/{comment}/vote', 'CommentsController@voteDestroy');

    Route::group(['prefix' => 'community'], function () {
        Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);

        Route::put('contest-entries/{contest_entry}/vote', 'ContestEntriesController@vote')->name('contest-entries.vote');
        Route::resource('contest-entries', 'ContestEntriesController', ['only' => ['store', 'destroy']]);

        Route::post('livestreams/promote', 'LivestreamsController@promote')->name('livestreams.promote');
        Route::resource('livestreams', 'LivestreamsController', ['only' => ['index']]);

        Route::resource('matches', 'MatchesController', ['only' => ['show']]);

        Route::post('tournaments/{tournament}/unregister', 'TournamentsController@unregister')->name('tournaments.unregister');
        Route::post('tournaments/{tournament}/register', 'TournamentsController@register')->name('tournaments.register');
        Route::resource('tournaments', 'TournamentsController', ['only' => ['index', 'show']]);

        Route::group(['as' => 'forum.', 'namespace' => 'Forum'], function () {
            Route::group(['prefix' => 'forums'], function () {
                Route::resource('forum-covers', 'ForumCoversController', ['only' => ['store', 'update', 'destroy']]);

                Route::get('posts/{post}/raw', 'PostsController@raw')->name('posts.raw');
                Route::post('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
                Route::resource('posts', 'PostsController', ['only' => ['destroy', 'edit', 'show', 'update']]);

                Route::post('topics/{topic}/edit-poll', 'TopicsController@editPollPost')->name('topics.edit-poll.store');
                Route::get('topics/{topic}/edit-poll', 'TopicsController@editPollGet')->name('topics.edit-poll');

                Route::get('topics/{topic}/logs', 'TopicLogsController@show')->name('topics.logs');

                Route::post('topics/preview', 'TopicsController@preview')->name('topics.preview');
                Route::post('topics/{topic}/issue-tag', 'TopicsController@issueTag')->name('topics.issue-tag');
                Route::post('topics/{topic}/lock', 'TopicsController@lock')->name('topics.lock');
                Route::post('topics/{topic}/move', 'TopicsController@move')->name('topics.move');
                Route::post('topics/{topic}/pin', 'TopicsController@pin')->name('topics.pin');
                Route::post('topics/{topic}/reply', 'TopicsController@reply')->name('topics.reply');
                Route::post('topics/{topic}/restore', 'TopicsController@restore')->name('topics.restore');
                Route::post('topics/{topic}/vote', 'TopicsController@vote')->name('topics.vote');
                Route::post('topics/{topic}/vote-feature', 'TopicsController@voteFeature')->name('topics.vote-feature');
                Route::resource('topics', 'TopicsController', ['only' => ['create', 'destroy', 'show', 'store', 'update']]);

                Route::resource('topic-covers', 'TopicCoversController', ['only' => ['store', 'update', 'destroy']]);

                // keeping old link alive
                route_redirect('topic-watches', 'follows.index');
                Route::resource('topic-watches', 'TopicWatchesController', ['only' => ['update']]);
            });

            Route::post('forums/mark-as-read', 'ForumsController@markAsRead')->name('forums.mark-as-read');
            Route::resource('forums', 'ForumsController', ['only' => ['index', 'show']]);
        });

        Route::group(['as' => 'chat.', 'prefix' => 'chat', 'namespace' => 'Chat'], function () {
            Route::post('new', 'ChatController@newConversation')->name('new');
            Route::get('updates', 'ChatController@updates')->name('updates');
            Route::get('presence', 'ChatController@presence')->name('presence');
            Route::group(['as' => 'channels.', 'prefix' => 'channels'], function () {
                Route::apiResource('{channel}/messages', 'Channels\MessagesController', ['only' => ['index', 'store']]);
                Route::put('{channel}/users/{user}', 'ChannelsController@join')->name('join');
                Route::delete('{channel}/users/{user}', 'ChannelsController@part')->name('part');
                Route::put('{channel}/mark-as-read/{message}', 'ChannelsController@markAsRead')->name('mark-as-read');
            });
            Route::apiResource('channels', 'ChannelsController', ['only' => ['index', 'show']]);
        });
        Route::resource('chat', 'ChatController', ['only' => ['index']]);
    });

    Route::resource('groups', 'GroupsController', ['only' => ['show']]);

    Route::group(['prefix' => 'home'], function () {
        Route::group(['as' => 'account.', 'prefix' => 'account'], function () {
            Route::get('edit', 'AccountController@edit')->name('edit');
            // Uploading file doesn't quite work with PUT/PATCH.
            // Reference: https://bugs.php.net/bug.php?id=55815
            // Note that hhvm behaves differently (the same as POST).
            Route::post('avatar', 'AccountController@avatar')->name('avatar');
            Route::post('cover', 'AccountController@cover')->name('cover');
            Route::put('email', 'AccountController@updateEmail')->name('email');
            Route::put('notification-options', 'AccountController@updateNotificationOptions')->name('notification-options');
            Route::put('options', 'AccountController@updateOptions')->name('options');
            Route::put('password', 'AccountController@updatePassword')->name('password');
            Route::post('reissue-code', 'AccountController@reissueCode')->name('reissue-code');
            Route::resource('sessions', 'Account\SessionsController', ['only' => ['destroy']]);
            Route::get('verify', 'AccountController@verifyLink');
            Route::post('verify', 'AccountController@verify')->name('verify');
            Route::put('/', 'AccountController@update')->name('update');
        });

        Route::get('quick-search', 'HomeController@quickSearch')->name('quick-search');
        Route::get('search', 'HomeController@search')->name('search');
        Route::post('bbcode-preview', 'HomeController@bbcodePreview')->name('bbcode-preview');
        Route::get('changelog/{stream}/{build}', 'ChangelogController@build')->name('changelog.build');
        Route::post('changelog/github', 'ChangelogController@github');
        Route::resource('changelog', 'ChangelogController', ['only' => ['index', 'show']]);
        Route::get('download', 'HomeController@getDownload')->name('download');
        Route::post('set-locale', 'HomeController@setLocale')->name('set-locale');
        Route::get('support', 'HomeController@supportTheGame')->name('support-the-game');
        Route::get('testflight', 'HomeController@testflight')->name('testflight');

        Route::delete('password-reset', 'PasswordResetController@destroy');
        Route::get('password-reset', 'PasswordResetController@index')->name('password-reset');
        Route::post('password-reset', 'PasswordResetController@create');
        Route::put('password-reset', 'PasswordResetController@update');

        Route::get('support-osu-popup', 'HomeController@osuSupportPopup')->name('support-osu-popup');
        Route::get('download-quota-check', 'HomeController@downloadQuotaCheck')->name('download-quota-check');

        Route::resource('blocks', 'BlocksController', ['only' => ['store', 'destroy']]);
        Route::resource('friends', 'FriendsController', ['only' => ['index', 'store', 'destroy']]);
        Route::resource('news', 'NewsController', ['only' => ['index', 'show', 'store', 'update']]);

        Route::get('messages/users/{user}', 'HomeController@messageUser')->name('messages.users.show');

        Route::resource('follows', 'FollowsController', ['only' => ['store']]);
        Route::get('follows/{subtype?}', 'FollowsController@index')->name('follows.index');
        Route::delete('follows', 'FollowsController@destroy')->name('follows.destroy');
    });

    Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
    Route::get('notifications/endpoint', 'NotificationsController@endpoint')->name('notifications.endpoint');
    Route::post('notifications/mark-read', 'NotificationsController@markRead')->name('notifications.mark-read');
    Route::delete('notifications', 'NotificationsController@batchDestroy');

    Route::get('legal/{locale?}/{path?}', 'LegalController@show')->name('legal');
    Route::put('legal/{locale}/{path}', 'LegalController@update');

    Route::group(['prefix' => 'multiplayer', 'as' => 'multiplayer.', 'namespace' => 'Multiplayer'], function () {
        Route::resource('rooms', 'RoomsController', ['only' => ['show']]);
    });

    Route::group(['as' => 'oauth.', 'prefix' => 'oauth', 'namespace' => 'OAuth'], function () {
        Route::resource('authorized-clients', 'AuthorizedClientsController', ['only' => ['destroy']]);
        Route::resource('clients', 'ClientsController', ['except' => ['create', 'edit', 'show']]);
        Route::post('clients/{client}/reset-secret', 'ClientsController@resetSecret')->name('clients.reset-secret');
    });

    Route::get('rankings/{mode?}/{type?}', 'RankingController@index')->name('rankings');

    Route::resource('reports', 'ReportsController', ['only' => ['store']]);

    Route::post('session', 'SessionsController@store')->name('login');
    Route::delete('session', 'SessionsController@destroy')->name('logout');

    Route::post('users/check-username-availability', 'UsersController@checkUsernameAvailability')->name('users.check-username-availability');
    Route::post('users/check-username-exists', 'UsersController@checkUsernameExists')->name('users.check-username-exists');
    Route::get('users/disabled', 'UsersController@disabled')->name('users.disabled');
    Route::get('users/{user}/card', 'UsersController@card')->name('users.card');

    // extras
    Route::group(['as' => 'users.', 'prefix' => 'users/{user}'], function () {
        Route::put('page', 'UsersController@updatePage')->name('page');
    });
    Route::get('users/{user}/kudosu', 'UsersController@kudosu')->name('users.kudosu');
    Route::get('users/{user}/recent_activity', 'UsersController@recentActivity')->name('users.recent-activity');
    Route::get('users/{user}/scores/{type}', 'UsersController@scores')->name('users.scores');
    Route::get('users/{user}/beatmapsets/{type}', 'UsersController@beatmapsets')->name('users.beatmapsets');

    Route::get('users/{user}/posts', 'UsersController@posts')->name('users.posts');

    Route::group(['as' => 'users.modding.', 'prefix' => 'users/{user}/modding', 'namespace' => 'Users'], function () {
        Route::get('/', 'ModdingHistoryController@index')->name('index');
        Route::get('/posts', 'ModdingHistoryController@posts')->name('posts');
        Route::get('/votes-given', 'ModdingHistoryController@votesGiven')->name('votes-given');
        Route::get('/votes-received', 'ModdingHistoryController@votesReceived')->name('votes-received');
    });

    Route::get('users/{user}/{mode?}', 'UsersController@show')->name('users.show');
    Route::resource('users', 'UsersController', ['only' => 'store']);

    Route::get('wiki/{locale}/Sitemap', 'WikiController@sitemap')->name('wiki.sitemap');
    Route::get('wiki/images/{path}', 'WikiController@image')->name('wiki.image')->where('path', '.+');
    Route::get('wiki/{locale?}/{path?}', 'WikiController@show')->name('wiki.show')->where('path', '.+');
    Route::put('wiki/{locale}/{path}', 'WikiController@update')->where('path', '.+');
    Route::get('wiki-suggestions', 'WikiController@suggestions')->name('wiki-suggestions');

    // FIXME: someone split this crap up into proper controllers
    Route::group(['as' => 'store.', 'prefix' => 'store'], function () {
        route_redirect('/', 'store.products.index');

        Route::get('listing', 'StoreController@getListing')->name('products.index');
        Route::get('invoice/{invoice}', 'StoreController@getInvoice')->name('invoice.show');

        Route::post('update-address', 'StoreController@postUpdateAddress');
        Route::post('new-address', 'StoreController@postNewAddress');

        Route::group(['namespace' => 'Store'], function () {
            Route::post('products/{product}/notification-request', 'NotificationRequestsController@store')->name('notification-request');
            Route::delete('products/{product}/notification-request', 'NotificationRequestsController@destroy');

            // Store splitting starts here
            Route::get('cart', 'CartController@show')->name('cart.show');
            Route::resource('cart', 'CartController', ['only' => ['store']]);

            Route::resource('checkout', 'CheckoutController', ['only' => ['show', 'store']]);

            Route::resource('orders', 'OrdersController', ['only' => ['destroy', 'index']]);

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

        Route::group(['as' => 'shopify.', 'prefix' => 'shopify'], function () {
            Route::post('callback', 'ShopifyController@callback')->name('callback');
        });
    });

    Route::get('/home', 'HomeController@index')->name('home');

    route_redirect('/', 'home');

    if (config('osu.scores.rank_cache.local_server')) {
        Route::get('rankLookup', 'ScoresController@userRankLookup');
    }

    // redirects go here
    route_redirect('forum/p/{post}', 'forum.posts.show');
    route_redirect('po/{post}', 'forum.posts.show:');
    route_redirect('forum/t/{topic}', 'forum.topics.show');
    route_redirect('forum/{forum}', 'forum.forums.show');
    // redirects to beatmapset anyways so there's no point
    // in having an another redirect on top of that
    Route::get('b/{beatmap}', 'BeatmapsController@show')->name('redirect:beatmaps.show');
    route_redirect('g/{group}', 'groups.show');
    route_redirect('s/{beatmapset}', 'beatmapsets.show');
    route_redirect('u/{user}', 'users.show');
    route_redirect('forum', 'forum.forums.index');
    route_redirect('mp/{match}', 'matches.show');
    route_redirect('help/wiki/{path?}', 'wiki.show')->where('path', '.+');
});

// API
// require-scopes is not in the api group at the moment to reduce the number of things that need immediate fixing.
Route::group(['as' => 'api.', 'prefix' => 'api', 'middleware' => ['api', ThrottleRequests::getApiThrottle(), 'require-scopes']], function () {
    Route::group(['prefix' => 'v2'], function () {
        Route::group(['as' => 'beatmaps.', 'prefix' => 'beatmaps'], function () {
            Route::get('lookup', 'API\BeatmapsController@lookup');

            Route::group(['prefix' => '{beatmap}'], function () {
                Route::get('scores/users/{user}', 'BeatmapsController@userScore');
                Route::get('scores', 'BeatmapsController@scores')->name('scores');

                Route::group(['as' => 'solo.', 'prefix' => 'solo'], function () {
                    Route::resource('scores', 'Solo\ScoresController', ['only' => ['store', 'update']]);
                });
            });
        });

        Route::resource('beatmaps', 'API\BeatmapsController', ['only' => ['show']]);

        Route::group(['as' => 'beatmapsets.', 'prefix' => 'beatmapsets'], function () {
            Route::apiResource('events', 'BeatmapsetEventsController', ['only' => ['index']]);

            Route::group(['as' => 'discussions.', 'prefix' => 'discussions'], function () {
                Route::apiResource('posts', 'BeatmapDiscussionPostsController', ['only' => ['index']]);
                Route::apiResource('votes', 'BeatmapsetDiscussionVotesController', ['only' => ['index']]);
            });

            Route::resource('discussions', 'BeatmapDiscussionsController', ['only' => ['index']]);

            // TODO: move other beatmapset routes here
            Route::group(['namespace' => 'Beatmapsets'], function () {
                Route::apiResource('{beatmapset}/favourites', 'FavouritesController', ['only' => ['store']]);
            });
        });

        Route::apiResource('comments', 'CommentsController');
        Route::post('comments/{comment}/vote', 'CommentsController@voteStore')->name('comments.vote');
        Route::delete('comments/{comment}/vote', 'CommentsController@voteDestroy');

        Route::group(['as' => 'chat.', 'prefix' => 'chat', 'namespace' => 'Chat'], function () {
            Route::post('new', 'ChatController@newConversation')->name('new');
            Route::get('updates', 'ChatController@updates')->name('updates');
            Route::get('presence', 'ChatController@presence')->name('presence');
            Route::group(['as' => 'channels.', 'prefix' => 'channels'], function () {
                Route::apiResource('{channel}/messages', 'Channels\MessagesController', ['only' => ['index', 'store']]);
                Route::put('{channel}/users/{user}', 'ChannelsController@join')->name('join');
                Route::delete('{channel}/users/{user}', 'ChannelsController@part')->name('part');
                Route::put('{channel}/mark-as-read/{message}', 'ChannelsController@markAsRead')->name('mark-as-read');
            });
            Route::apiResource('channels', 'ChannelsController', ['only' => ['index', 'show', 'store']]);
        });

        Route::get('changelog/{stream}/{build}', 'ChangelogController@build')->name('changelog.build');
        Route::resource('changelog', 'ChangelogController', ['only' => ['index', 'show']]);

        Route::group(['as' => 'forum.', 'namespace' => 'Forum'], function () {
            Route::group(['prefix' => 'forums'], function () {
                Route::post('topics/{topic}/reply', 'TopicsController@reply')->name('topics.reply');
                Route::resource('topics', 'TopicsController', ['only' => ['show', 'store', 'update']]);
                Route::resource('posts', 'PostsController', ['only' => ['update']]);
            });
        });
        Route::resource('matches', 'MatchesController', ['only' => ['index', 'show']]);

        Route::group(['as' => 'rooms.', 'prefix' => 'rooms'], function () {
            Route::get('{mode?}', 'Multiplayer\RoomsController@index')->name('index')->where('mode', 'owned|participated|ended');
            Route::put('{room}/users/{user}', 'Multiplayer\RoomsController@join')->name('join');
            Route::delete('{room}/users/{user}', 'Multiplayer\RoomsController@part')->name('part');
            Route::get('{room}/leaderboard', 'Multiplayer\RoomsController@leaderboard');
            Route::group(['as' => 'playlist.', 'prefix' => '{room}/playlist'], function () {
                Route::get('{playlist}/scores/users/{user}', 'Multiplayer\Rooms\Playlist\ScoresController@showUser');
                Route::apiResource('{playlist}/scores', 'Multiplayer\Rooms\Playlist\ScoresController', ['only' => ['index', 'show', 'store', 'update']]);
            });
        });

        Route::resource('reports', 'ReportsController', ['only' => ['store']]);

        Route::apiResource('rooms', 'Multiplayer\RoomsController', ['only' => ['show', 'store']]);

        Route::apiResource('seasonal-backgrounds', 'SeasonalBackgroundsController', ['only' => ['index']]);

        Route::group(['prefix' => 'scores/{mode}', 'as' => 'scores.'], function () {
            Route::get('{score}/download', 'ScoresController@download')->middleware(ThrottleRequests::getApiThrottle('scores_download'))->name('download');
            Route::get('{score}', 'ScoresController@show')->name('show');
        });

        // Beatmapsets
        //   GET /api/v2/beatmapsets/search/:filters
        Route::get('beatmapsets/search/{filters?}', 'BeatmapsetsController@search');
        //   GET /api/v2/beatmapsets/lookup
        Route::get('beatmapsets/lookup', 'API\BeatmapsetsController@lookup');
        //   GET /api/v2/beatmapsets/:beatmapset/download
        Route::get('beatmapsets/{beatmapset}/download', 'BeatmapsetsController@download');
        //   GET /api/v2/beatmapsets/:beatmapset_id
        Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show']]);

        // Friends
        //  GET /api/v2/friends
        Route::resource('friends', 'FriendsController', ['only' => ['index']]);

        //  GET /api/v2/me
        Route::get('me/{mode?}', 'UsersController@me')->name('me');
        //  GET /api/v2/me/download-quota-check
        Route::get('me/download-quota-check', 'HomeController@downloadQuotaCheck');

        Route::delete('oauth/tokens/current', 'OAuth\TokensController@destroyCurrent')->name('oauth.tokens.current');

        Route::apiResource('news', 'NewsController', ['only' => ['index', 'show']]);

        // Notifications
        //  GET /api/v2/notifications
        Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
        //  POST /api/v2/notifications/mark-read
        Route::post('notifications/mark-read', 'NotificationsController@markRead')->name('notifications.mark-read');

        //  GET /api/v2/rankings/:mode/:type
        Route::get('rankings/{mode}/{type}', 'RankingController@index');
        Route::resource('spotlights', 'SpotlightsController', ['only' => ['index']]);

        Route::get('search', 'HomeController@search');

        //  GET /api/v2/users/:user_id/kudosu
        Route::get('users/{user}/kudosu', 'UsersController@kudosu');
        //  GET /api/v2/users/:user_id/scores/:type [best, firsts, recent]
        Route::get('users/{user}/scores/{type}', 'UsersController@scores');
        //  GET /api/v2/users/:user_id/beatmapsets/:type [most_played, favourite, ranked, pending, graveyard]
        Route::get('users/{user}/beatmapsets/{type}', 'UsersController@beatmapsets');
        // GET /api/v2/users/:user_id/recent_activity
        Route::get('users/{user}/recent_activity', 'UsersController@recentActivity');
        //  GET /api/v2/users/:user_id/:mode [osu, taiko, fruits, mania]
        Route::get('users/{user}/{mode?}', 'UsersController@show')->name('users.show');
        Route::resource('users', 'UsersController', ['only' => ['index']]);

        Route::get('wiki/{locale}/{path}', 'WikiController@show')->name('wiki.show')->where('path', '.+');
    });
});

// Callbacks for legacy systems to interact with
Route::group(['prefix' => '_lio', 'middleware' => 'lio', 'as' => 'interop.'], function () {
    Route::post('generate-notification', 'LegacyInterOpController@generateNotification');
    Route::post('index-beatmapset/{beatmapset}', 'LegacyInterOpController@indexBeatmapset');
    Route::post('/refresh-beatmapset-cache/{beatmapset}', 'LegacyInterOpController@refreshBeatmapsetCache');
    Route::post('user-achievement/{user}/{achievement}/{beatmap?}', 'LegacyInterOpController@userAchievement')->name('user-achievement');
    Route::post('/user-best-scores-check/{user}', 'LegacyInterOpController@userBestScoresCheck');
    Route::post('user-send-message', 'LegacyInterOpController@userSendMessage');
    Route::post('user-batch-mark-channel-as-read', 'LegacyInterOpController@userBatchMarkChannelAsRead');
    Route::post('user-batch-send-message', 'LegacyInterOpController@userBatchSendMessage');
    Route::delete('/user-sessions/{user}', 'LegacyInterOpController@userSessionsDestroy');
    Route::post('user-index/{user}', 'LegacyInterOpController@userIndex');
    Route::post('user-recalculate-ranked-scores/{user}', 'LegacyInterOpController@userRecalculateRankedScores');
    Route::get('/news', 'LegacyInterOpController@news');
    Route::apiResource('users', 'InterOp\UsersController', ['only' => ['store']]);

    Route::group(['namespace' => 'InterOp'], function () {
        Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['destroy']]);
        Route::post('beatmapsets/{beatmapset}/broadcast-new', 'BeatmapsetsController@broadcastNew');

        Route::group(['as' => 'indexing.', 'prefix' => 'indexing'], function () {
            Route::apiResource('bulk', 'Indexing\BulkController', ['only' => ['store']]);
        });

        Route::group(['as' => 'user-groups.'], function () {
            Route::post('user-group', 'UserGroupsController@store')->name('store');
            Route::delete('user-group', 'UserGroupsController@destroy')->name('destroy');
            Route::post('user-default-group', 'UserGroupsController@setDefault')->name('store-default');
        });
    });
});

Route::any('{catchall}', 'FallbackController@index')->where('catchall', '.*')->fallback();

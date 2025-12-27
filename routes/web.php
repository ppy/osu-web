<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Http\Middleware\ThrottleRequests;

Route::get('wiki/images/{path}', 'WikiController@image')->name('wiki.image')->where('path', '.+');
Route::get('media-url', 'ProxyMediaController')->name('media-url');

Route::group(['middleware' => ['web']], function () {
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('/beatmapsets/{beatmapset}/covers', 'BeatmapsetsController@covers')->name('beatmapsets.covers');
        Route::post('/beatmapsets/{beatmapset}/covers/regenerate', 'BeatmapsetsController@regenerateCovers')->name('beatmapsets.covers.regenerate');
        Route::post('/beatmapsets/{beatmapset}/covers/remove', 'BeatmapsetsController@removeCovers')->name('beatmapsets.covers.remove');
        Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show', 'update']]);

        Route::group(['as' => 'contests.', 'prefix' => 'contests/{contest}'], function () {
            Route::post('calculate', 'ContestsController@calculate')->name('calculate');
            Route::post('zip', 'ContestsController@gimmeZip')->name('get-zip');
        });
        Route::resource('contests', 'ContestsController', ['only' => ['index', 'show']]);

        Route::resource('user-contest-entries', 'UserContestEntriesController', ['only' => ['destroy']]);
        Route::post('user-contest-entries/{user_contest_entry}/restore', 'UserContestEntriesController@restore')->name('user-contest-entries.restore');

        Route::resource('logs', 'LogsController', ['only' => ['index']]);

        Route::get('/', 'PagesController@root')->name('root');

        Route::group(['as' => 'forum.', 'prefix' => 'forum', 'namespace' => 'Forum'], function () {
            Route::resource('forum-covers', 'ForumCoversController', ['only' => ['index', 'store', 'update']]);
        });
    });

    Route::resource('authenticator-app', 'UserTotpController', ['only' => ['create', 'store']]);
    Route::post('authenticator-app/cancel-create', 'UserTotpController@cancelCreate')->name('authenticator-app.cancel-create');
    Route::get('authenticator-app/edit', 'UserTotpController@edit')->name('authenticator-app.edit');
    Route::delete('authenticator-app', 'UserTotpController@destroy')->name('authenticator-app.destroy');
    Route::post('authenticator-app/issue-uri', 'UserTotpController@issueUri')->name('authenticator-app.issue-uri');

    Route::group(['prefix' => 'beatmaps'], function () {
        // featured artists
        Route::group(['as' => 'artists.', 'prefix' => 'artists'], function () {
            Route::resource('tracks', 'ArtistTracksController', ['only' => ['index']]);
        });
        Route::resource('artists', 'ArtistsController', ['only' => ['index', 'show']]);
        Route::resource('artists/tracks', 'ArtistTracksController', ['only' => 'show']);

        Route::resource('packs', 'BeatmapPacksController', ['only' => ['index', 'show']]);

        Route::group(['as' => 'beatmaps.', 'prefix' => '{beatmap}'], function () {
            Route::get('scores', 'BeatmapsController@scores')->name('scores');
            Route::get('solo-scores', 'BeatmapsController@soloScores')->name('solo-scores');
            Route::post('update-owner', 'BeatmapsController@updateOwner')->name('update-owner');
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

    Route::get('beatmapset-version-files/{beatmapset_version_file}/download', 'BeatmapsetVersionFilesController@download')->name('beatmapset-version-files.download');

    Route::group(['prefix' => 'beatmapsets', 'as' => 'beatmapsets.'], function () {
        Route::resource('events', 'BeatmapsetEventsController', ['only' => ['index']]);
        Route::get('search', 'BeatmapsetsController@search')->name('search');
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

        Route::group(['prefix' => '{beatmapset}'], function () {
            Route::get('discussion/{beatmap?}/{mode?}/{filter?}', 'BeatmapsetsController@discussion')->name('discussion');
            Route::post('discussion/review', 'BeatmapDiscussionsController@review')->name('discussion.review');
            Route::get('discussion-last-update', 'BeatmapsetsController@discussionLastUpdate')->name('discussion-last-update');
            Route::post('discussion-lock', 'BeatmapsetsController@discussionLock')->name('discussion-lock');
            Route::post('discussion-unlock', 'BeatmapsetsController@discussionUnlock')->name('discussion-unlock');
            Route::get('download', 'BeatmapsetsController@download')->name('download');
            Route::put('love', 'BeatmapsetsController@love')->name('love');
            Route::delete('love', 'BeatmapsetsController@removeFromLoved')->name('remove-from-loved');
            Route::put('nominate', 'BeatmapsetsController@nominate')->name('nominate');

            Route::get('versions', 'BeatmapsetsController@versions')->name('versions');

            Route::group(['namespace' => 'Beatmapsets'], function () {
                Route::apiResource('favourites', 'FavouritesController', ['only' => ['store']]);
            });
        });
    });
    Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['destroy', 'index', 'show', 'update']]);

    Route::group(['prefix' => 'scores', 'as' => 'scores.'], function () {
        Route::get('{score}/download', 'ScoresController@download')->name('download');
        Route::get('{rulesetOrScore}/{score}/download', 'ScoresController@download')->name('download-legacy');

        Route::get('{rulesetOrScore}/{score?}', 'ScoresController@show')->name('show');
    });

    Route::group(['prefix' => 'score-pins/{score}', 'as' => 'score-pins.'], function () {
        Route::post('reorder', 'ScorePinsController@reorder')->name('reorder');
        Route::delete('/', 'ScorePinsController@destroy')->name('destroy');
        Route::put('/', 'ScorePinsController@store')->name('store');
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

        Route::group(['as' => 'contests.', 'prefix' => 'contests/{contest}'], function () {
            Route::get('judge', 'ContestsController@judge')->name('judge');
            Route::get('entries/{contest_entry}/results', 'ContestEntriesController@judgeResults')->name('entries.judge-results');
            Route::put('entries/{contest_entry}/judge-vote', 'ContestEntriesController@judgeVote')->name('entries.judge-vote');
        });

        Route::put('contest-entries/{contest_entry}/vote', 'ContestEntriesController@vote')->name('contest-entries.vote');
        Route::resource('contest-entries', 'ContestEntriesController', ['only' => ['store', 'destroy']]);

        Route::post('livestreams/promote', 'LivestreamsController@promote')->name('livestreams.promote');
        Route::resource('livestreams', 'LivestreamsController', ['only' => ['index']]);

        Route::resource('matches', 'LegacyMatchesController', ['only' => ['show']]);

        Route::post('tournaments/{tournament}/unregister', 'TournamentsController@unregister')->name('tournaments.unregister');
        Route::post('tournaments/{tournament}/register', 'TournamentsController@register')->name('tournaments.register');
        Route::resource('tournaments', 'TournamentsController', ['only' => ['index', 'show']]);

        Route::group(['as' => 'forum.', 'namespace' => 'Forum'], function () {
            Route::group(['prefix' => 'forums'], function () {
                Route::resource('forum-covers', 'ForumCoversController', ['only' => ['store', 'update', 'destroy']]);

                Route::get('posts/{post}/raw', 'PostsController@raw')->name('posts.raw');
                Route::post('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
                Route::resource('posts', 'PostsController', ['only' => ['destroy', 'edit', 'show', 'update']]);

                Route::group(['as' => 'topics.', 'prefix' => 'topics/{topic}'], function () {
                    Route::resource('logs', 'TopicLogsController', ['only' => 'index']);

                    Route::post('edit-poll', 'TopicsController@editPollPost')->name('edit-poll.store');
                    Route::get('edit-poll', 'TopicsController@editPollGet')->name('edit-poll');

                    Route::post('issue-tag', 'TopicsController@issueTag')->name('issue-tag');
                    Route::post('lock', 'TopicsController@lock')->name('lock');
                    Route::post('move', 'TopicsController@move')->name('move');
                    Route::post('pin', 'TopicsController@pin')->name('pin');
                    Route::post('reply', 'TopicsController@reply')->name('reply');
                    Route::post('restore', 'TopicsController@restore')->name('restore');
                    Route::post('vote', 'TopicsController@vote')->name('vote');
                    Route::post('vote-feature', 'TopicsController@voteFeature')->name('vote-feature');
                });

                Route::post('topics/preview', 'TopicsController@preview')->name('preview');
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
            Route::post('ack', 'ChatController@ack')->name('ack');
            Route::post('new', 'ChatController@newConversation')->name('new');
            Route::get('presence', 'ChatController@presence')->name('presence');
            Route::get('updates', 'ChatController@updates')->name('updates');
            Route::group(['as' => 'channels.', 'prefix' => 'channels'], function () {
                Route::apiResource('{channel}/messages', 'Channels\MessagesController', ['only' => ['index', 'store']]);
                Route::apiResource('{channel}/users', 'Channels\UsersController', ['only' => ['index']]);
                Route::put('{channel}/users/{user}', 'ChannelsController@join')->name('join');
                Route::delete('{channel}/users/{user}', 'ChannelsController@part')->name('part');
                Route::put('{channel}/mark-as-read/{message}', 'ChannelsController@markAsRead')->name('mark-as-read');
            });
            Route::apiResource('channels', 'ChannelsController', ['only' => ['index', 'show', 'store']]);
        });
        Route::resource('chat', 'ChatController', ['only' => ['index']]);
    });

    Route::get('groups/history', 'GroupHistoryController@index')->name('group-history.index');
    Route::resource('groups', 'GroupsController', ['only' => ['show']]);

    Route::group(['prefix' => 'home'], function () {
        Route::group(['as' => 'account.', 'prefix' => 'account'], function () {
            Route::get('edit', 'AccountController@edit')->name('edit');
            // Uploading file doesn't quite work with PUT/PATCH.
            // Reference: https://bugs.php.net/bug.php?id=55815
            // Note that hhvm behaves differently (the same as POST).
            Route::post('avatar', 'AccountController@avatar')->name('avatar');
            Route::put('country', 'AccountController@updateCountry')->name('country');
            Route::post('cover', 'AccountController@cover')->name('cover');
            Route::put('email', 'AccountController@updateEmail')->name('email');
            Route::put('notification-options', 'AccountController@updateNotificationOptions')->name('notification-options');
            Route::put('options', 'AccountController@updateOptions')->name('options');
            Route::put('password', 'AccountController@updatePassword')->name('password');
            Route::post('reissue-code', 'AccountController@reissueCode')->name('reissue-code');
            Route::resource('sessions', 'Account\SessionsController', ['only' => ['destroy']]);
            Route::get('verify', 'AccountController@verifyLink');
            Route::post('verify', 'AccountController@verify')->name('verify');
            Route::post('verify/mail-fallback', 'AccountController@verificationMailFallback')->name('verify.mail-fallback');
            Route::put('/', 'AccountController@update')->name('update');

            Route::get('github-users/callback', 'Account\GithubUsersController@callback')->name('github-users.callback');
            Route::resource('github-users', 'Account\GithubUsersController', ['only' => ['create']]);
            Route::delete('github-users', 'Account\GithubUsersController@destroy')->name('github-users.destroy');
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

        Route::get('password-reset', 'PasswordResetController@index')->name('password-reset');
        Route::post('password-reset', 'PasswordResetController@create');
        Route::put('password-reset', 'PasswordResetController@update');
        Route::get('password-reset/reset', 'PasswordResetController@reset')->name('password-reset.reset');
        Route::post('password-reset/resend-mail', 'PasswordResetController@resendMail')->name('password-reset.resend-mail');

        Route::get('download-quota-check', 'HomeController@downloadQuotaCheck')->name('download-quota-check');

        Route::resource('blocks', 'BlocksController', ['only' => ['store', 'destroy']]);
        Route::resource('friends', 'FriendsController', ['only' => ['index', 'store', 'destroy']]);
        Route::resource('news', 'NewsController', ['only' => ['index', 'show', 'store', 'update']]);

        Route::get('messages/users/{user}', 'HomeController@messageUser')->name('messages.users.show');

        Route::resource('follows', 'FollowsController', ['only' => ['store']]);
        Route::get('follows/{subtype?}', 'FollowsController@index')->name('follows.index');
        Route::delete('follows', 'FollowsController@destroy')->name('follows.destroy');
    });

    Route::resource('legacy-api-key', 'LegacyApiKeyController', ['only' => ['store']]);
    Route::delete('legacy-api-key', 'LegacyApiKeyController@destroy')->name('legacy-api-key.destroy');

    Route::resource('legacy-irc-key', 'LegacyIrcKeyController', ['only' => ['store']]);
    Route::delete('legacy-irc-key', 'LegacyIrcKeyController@destroy')->name('legacy-irc-key.destroy');

    Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
    Route::get('notifications/endpoint', 'NotificationsController@endpoint')->name('notifications.endpoint');
    Route::post('notifications/mark-read', 'NotificationsController@markRead')->name('notifications.mark-read');
    Route::delete('notifications', 'NotificationsController@batchDestroy');

    Route::get('legal/{locale?}/{path?}', 'LegalController@show')->name('legal');
    Route::put('legal/{locale}/{path}', 'LegalController@update');

    Route::group(['prefix' => 'multiplayer', 'as' => 'multiplayer.', 'namespace' => 'Multiplayer'], function () {
        Route::get('rooms/{room}/events', 'RoomsController@events')->name('rooms.events');
        Route::resource('rooms', 'RoomsController', ['only' => ['show']]);
    });

    Route::get('news/{tumblrId}', 'NewsController@redirect');

    Route::group(['as' => 'oauth.', 'prefix' => 'oauth', 'namespace' => 'OAuth'], function () {
        Route::resource('authorized-clients', 'AuthorizedClientsController', ['only' => ['destroy']]);
        Route::resource('clients', 'ClientsController', ['except' => ['create', 'edit', 'show']]);
        Route::post('clients/{client}/reset-secret', 'ClientsController@resetSecret')->name('clients.reset-secret');
    });

    Route::get('rankings/kudosu', 'RankingController@kudosu')->name('rankings.kudosu');
    Route::resource('rankings/daily-challenge', 'Ranking\DailyChallengeController', ['only' => ['index', 'show']]);
    Route::get('rankings/quickplay/{mode?}/{pool?}', 'Ranking\MatchmakingController@show')->name('rankings.matchmaking');
    Route::get('rankings/top-plays/{mode?}', 'Ranking\TopPlaysController@show')->name('rankings.top-plays');
    Route::get('rankings/{mode?}/{type?}/{sort?}', 'RankingController@index')->name('rankings');

    Route::resource('reports', 'ReportsController', ['only' => ['store']]);

    Route::resource('seasons', 'SeasonsController', ['only' => 'show']);
    Route::get('seasons/{season}/rooms', 'SeasonsController@rooms')->name('seasons.rooms');

    Route::post('session', 'SessionsController@store')->name('login');
    Route::delete('session', 'SessionsController@destroy')->name('logout');

    Route::post('user-cover-presets/batch-activate', 'UserCoverPresetsController@batchActivate')->name('user-cover-presets.batch-activate');
    Route::resource('user-cover-presets', 'UserCoverPresetsController', ['only' => ['index', 'store', 'update']]);

    Route::group(['as' => 'teams.', 'prefix' => 'teams/{team}'], function () {
        Route::resource('applications', 'Teams\ApplicationsController', ['only' => ['destroy', 'store']]);
        Route::post('applications/{application}/accept', 'Teams\ApplicationsController@accept')->name('applications.accept');
        Route::post('applications/{application}/reject', 'Teams\ApplicationsController@reject')->name('applications.reject');
        Route::get('leaderboard/{ruleset?}', 'TeamsController@leaderboard')->name('leaderboard');
        Route::post('part', 'TeamsController@part')->name('part');
        Route::resource('members', 'Teams\MembersController', ['only' => ['destroy', 'index']]);
        Route::post('members/{member}/set-leader', 'Teams\MembersController@setLeader')->name('members.set-leader');
    });
    Route::resource('teams', 'TeamsController', ['only' => ['create', 'destroy', 'edit', 'store', 'update']]);
    Route::get('teams/{team}/{ruleset?}', 'TeamsController@show')->name('teams.show');

    Route::post('users/check-username-availability', 'UsersController@checkUsernameAvailability')->name('users.check-username-availability');
    Route::get('users/lookup', 'Users\LookupController@index')->name('users.lookup');
    Route::get('users/disabled', 'UsersController@disabled')->name('users.disabled');
    Route::get('users/create', 'UsersController@create')->name('users.create');
    Route::post('users/store-web', 'UsersController@storeWeb')->name('users.store-web');

    Route::group(['as' => 'users.', 'prefix' => 'users/{user}'], function () {
        Route::get('extra-pages/{page}', 'UsersController@extraPages')->name('extra-page');
        Route::put('page', 'UsersController@updatePage')->name('page');
        Route::group(['namespace' => 'Users'], function () {
            Route::resource('{typeGroup}', 'MultiplayerController', ['only' => 'index'])->where(['typeGroup' => 'multiplayer|playlists|quickplay|realtime'])->names('multiplayer');

            Route::group(['as' => 'modding.', 'prefix' => 'modding'], function () {
                Route::get('/', 'ModdingHistoryController@index')->name('index');
                Route::get('/posts', 'ModdingHistoryController@posts')->name('posts');
                Route::get('/votes-given', 'ModdingHistoryController@votesGiven')->name('votes-given');
                Route::get('/votes-received', 'ModdingHistoryController@votesReceived')->name('votes-received');
            });
        });

        Route::get('kudosu', 'UsersController@kudosu')->name('kudosu');
        Route::get('recent_activity', 'UsersController@recentActivity')->name('recent-activity');
        Route::get('scores/{type}', 'UsersController@scores')->name('scores');
        Route::get('beatmapsets/{type}', 'UsersController@beatmapsets')->name('beatmapsets');
    });

    Route::get('users/{user}/posts', 'UsersController@posts')->name('users.posts');
    Route::get('users/{user}/{mode?}', 'UsersController@show')->name('users.show');
    Route::resource('users', 'UsersController', ['only' => ['store']]);

    Route::get('wiki/{locale}/Sitemap', 'WikiController@sitemap')->name('wiki.sitemap');
    Route::get('wiki/{locale?}/{path?}', 'WikiController@show')->name('wiki.show')->where('path', '.+');
    Route::put('wiki/{locale}/{path}', 'WikiController@update')->where('path', '.+');
    Route::get('wiki-suggestions', 'WikiController@suggestions')->name('wiki-suggestions');

    // FIXME: someone split this crap up into proper controllers
    Route::group(['as' => 'store.', 'prefix' => 'store'], function () {
        route_redirect('/', 'store.products.index');

        Route::get('listing', 'StoreController@getListing')->name('products.index');
        Route::get('invoice/{invoice}', 'StoreController@getInvoice')->name('invoice.show');

        Route::group(['namespace' => 'Store'], function () {
            Route::post('products/{product}/notification-request', 'NotificationRequestsController@store')->name('notification-request');
            Route::delete('products/{product}/notification-request', 'NotificationRequestsController@destroy');

            // Store splitting starts here
            Route::get('cart', 'CartController@show')->name('cart.show');
            Route::delete('cart', 'CartController@empty')->name('cart.empty');
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
            Route::post('ipn', 'PaypalController@ipn')->name('ipn');
        });

        Route::group(['as' => 'xsolla.', 'prefix' => 'xsolla'], function () {
            Route::get('completed', 'XsollaController@completed')->name('completed');
            Route::post('token', 'XsollaController@token')->name('token');
            Route::post('callback', 'XsollaController@callback')->name('callback');
        });

        Route::group(['as' => 'shopify.', 'prefix' => 'shopify'], function () {
            Route::post('callback', 'ShopifyController@callback')->name('callback');
        });
    });

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/wrapped/{userId}', 'WrappedController@show');

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
// There's also a different group which skips throttle middleware.
Route::group(['as' => 'api.', 'prefix' => 'api', 'middleware' => ['api', ThrottleRequests::getApiThrottle(), 'require-scopes']], function () {
    Route::group(['prefix' => 'v2'], function () {
        Route::group(['middleware' => ['require-scopes:any']], function () {
            Route::post('session/verify', 'AccountController@verify')->name('verify');
            Route::post('session/verify/mail-fallback', 'AccountController@verificationMailFallback')->name('verify.mail-fallback');
            Route::post('session/verify/reissue', 'AccountController@reissueCode')->name('verify.reissue');
        });

        Route::group(['as' => 'beatmaps.', 'prefix' => 'beatmaps'], function () {
            Route::get('lookup', 'BeatmapsController@lookup')->name('lookup');

            Route::apiResource('packs', 'BeatmapPacksController', ['only' => ['index', 'show']]);

            Route::group(['prefix' => '{beatmap}'], function () {
                Route::get('scores/users/{user}', 'BeatmapsController@userScore')->name('user.score');
                Route::get('scores/users/{user}/all', 'BeatmapsController@userScoreAll')->name('user.scores');
                Route::get('scores', 'BeatmapsController@scores')->name('scores');
                Route::get('solo-scores', 'BeatmapsController@soloScores')->name('solo-scores');

                Route::group(['as' => 'solo.', 'prefix' => 'solo'], function () {
                    Route::post('scores', 'ScoreTokensController@store')->name('score-tokens.store');

                    Route::group(['namespace' => 'Solo'], function () {
                        Route::put('scores/{token}', 'ScoresController@store')->name('scores.store');
                    });
                });

                Route::apiResource('tags', 'BeatmapTagsController', ['only' => ['destroy', 'update']]);
            });
        });

        Route::resource('beatmaps', 'BeatmapsController', ['only' => ['index', 'show']]);
        Route::post('beatmaps/{beatmap}/attributes', 'BeatmapsController@attributes')->name('beatmaps.attributes');

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

        Route::resource('blocks', 'BlocksController', ['only' => ['destroy', 'index', 'store']]);

        Route::apiResource('comments', 'CommentsController');
        Route::post('comments/{comment}/vote', 'CommentsController@voteStore')->name('comments.vote');
        Route::delete('comments/{comment}/vote', 'CommentsController@voteDestroy');

        Route::group(['as' => 'chat.', 'prefix' => 'chat', 'namespace' => 'Chat'], function () {
            Route::post('ack', 'ChatController@ack')->name('ack');
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

        Route::apiResource('events', 'EventsController', ['only' => ['index']]);

        Route::group(['as' => 'forum.', 'namespace' => 'Forum'], function () {
            Route::group(['prefix' => 'forums'], function () {
                Route::group(['as' => 'topics.', 'prefix' => 'topics/{topic}'], function () {
                    Route::post('lock', 'TopicsController@lock')->name('lock');
                    Route::post('move', 'TopicsController@move')->name('move');
                    Route::post('pin', 'TopicsController@pin')->name('pin');
                    Route::post('reply', 'TopicsController@reply')->name('reply');
                });

                Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'store', 'update']]);
                Route::resource('posts', 'PostsController', ['only' => ['update']]);
            });
            Route::resource('forums', 'ForumsController', ['only' => ['index', 'show']]);
        });
        Route::resource('matches', 'LegacyMatchesController', ['only' => ['index', 'show']]);

        Route::resource('reports', 'ReportsController', ['only' => ['store']]);

        Route::group(['as' => 'rooms.', 'prefix' => 'rooms'], function () {
            Route::put('{room}/users/{user}', 'Multiplayer\RoomsController@join')->name('join');
            Route::delete('{room}/users/{user}', 'Multiplayer\RoomsController@part')->name('part');
            Route::get('{room}/leaderboard', 'Multiplayer\RoomsController@leaderboard');
            Route::get('{room}/events', 'Multiplayer\RoomsController@events');
            Route::group(['as' => 'playlist.', 'prefix' => '{room}/playlist'], function () {
                Route::get('{playlist}/scores/users/{user}', 'Multiplayer\Rooms\Playlist\ScoresController@showUser');
                Route::apiResource('{playlist}/scores', 'Multiplayer\Rooms\Playlist\ScoresController', ['only' => ['index', 'show', 'store', 'update']]);
            });
        });

        Route::apiResource('rooms', 'Multiplayer\RoomsController', ['only' => ['index', 'show', 'store', 'destroy']]);

        Route::apiResource('seasonal-backgrounds', 'SeasonalBackgroundsController', ['only' => ['index']]);

        Route::group(['prefix' => 'scores', 'as' => 'scores.'], function () {
            Route::get('{score}/download', 'ScoresController@download')->middleware(ThrottleRequests::getApiThrottle('scores_download'))->name('download');
            Route::get('{rulesetOrScore}/{score}/download', 'ScoresController@download')->middleware(ThrottleRequests::getApiThrottle('scores_download'))->name('download-legacy');

            Route::get('{rulesetOrScore}/{score?}', 'ScoresController@show')->name('show');

            Route::get('/', 'ScoresController@index');
        });

        Route::group(['prefix' => 'score-pins/{score}', 'as' => 'score-pins.'], function () {
            Route::post('reorder', 'ScorePinsController@reorder')->name('reorder');
            Route::delete('/', 'ScorePinsController@destroy')->name('destroy');
            Route::put('/', 'ScorePinsController@store')->name('store');
        });

        Route::get('users/lookup', 'Users\LookupController@index')->name('users.lookup');
        Route::group(['as' => 'users.', 'prefix' => 'users/{user}'], function () {
            //  GET /api/v2/users/:user_id/kudosu
            Route::get('kudosu', 'UsersController@kudosu');
            //  GET /api/v2/users/:user_id/scores/:type [best, firsts, recent]
            Route::get('scores/{type}', 'UsersController@scores');
            //  GET /api/v2/users/:user_id/beatmapsets/:type [most_played, favourite, ranked, pending, graveyard]
            Route::get('beatmapsets/{type}', 'UsersController@beatmapsets');
            // GET /api/v2/users/:user_id/recent_activity
            Route::get('recent_activity', 'UsersController@recentActivity');

            Route::group(['namespace' => 'Users'], function () {
                Route::get('beatmaps-passed', 'BeatmapsController@beatmapsPassed');
            });

            //  GET /api/v2/users/:user_id/:mode [osu, taiko, fruits, mania]
            Route::get('{mode?}', 'UsersController@show')->name('show');
        });
        Route::apiResource('users', 'UsersController', ['only' => ['index']]);

        // Beatmapsets
        //   GET /api/v2/beatmapsets/search/:filters
        Route::get('beatmapsets/search', 'BeatmapsetsController@search');
        //   GET /api/v2/beatmapsets/lookup
        Route::get('beatmapsets/lookup', 'BeatmapsetsController@lookup');
        //   GET /api/v2/beatmapsets/:beatmapset_id
        Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['show']]);

        // Friends
        Route::resource('friends', 'FriendsController', ['only' => ['index', 'store', 'destroy']]);

        Route::get('me/beatmapset-favourites', 'Account\BeatmapsetFavouritesController@index');
        //  GET /api/v2/me/download-quota-check
        Route::get('me/download-quota-check', 'HomeController@downloadQuotaCheck')->name('download-quota-check');
        //  GET /api/v2/me
        Route::get('me/{mode?}', 'UsersController@me')->name('me');

        Route::delete('oauth/tokens/current', 'OAuth\TokensController@destroyCurrent')->name('oauth.tokens.current');

        Route::apiResource('news', 'NewsController', ['only' => ['index', 'show']]);

        // Notifications
        //  GET /api/v2/notifications
        Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
        //  POST /api/v2/notifications/mark-read
        Route::post('notifications/mark-read', 'NotificationsController@markRead')->name('notifications.mark-read');

        Route::get('rankings/kudosu', 'RankingController@kudosu');
        //  GET /api/v2/rankings/:mode/:type
        Route::get('rankings/{mode}/{type}', 'RankingController@index')->name('rankings');
        Route::resource('spotlights', 'SpotlightsController', ['only' => ['index']]);

        Route::get('search', 'HomeController@search');

        Route::get('wiki/{locale}/{path}', 'WikiController@show')->name('wiki.show')->where('path', '.+');

        // Tags
        Route::apiResource('tags', 'TagsController', ['only' => ['index']]);
    });
});

// Duplicate of the other api group but without throttle.
Route::group(['as' => 'api.', 'prefix' => 'api/v2', 'middleware' => ['api', 'require-scopes']], function () {
    //   GET /api/v2/beatmapsets/:beatmapset/download
    Route::get('beatmapsets/{beatmapset}/download', 'BeatmapsetsController@download');
});

// Callbacks for legacy systems to interact with
Route::group(['prefix' => '_lio', 'middleware' => 'lio', 'as' => 'interop.'], function () {
    Route::post('generate-notification', 'LegacyInterOpController@generateNotification');
    Route::post('index-beatmapset/{beatmapset}', 'LegacyInterOpController@indexBeatmapset');
    Route::post('/refresh-beatmapset-cache/{beatmapset}', 'LegacyInterOpController@refreshBeatmapsetCache');
    Route::post('user-send-message', 'LegacyInterOpController@userSendMessage');
    Route::post('user-batch-mark-channel-as-read', 'LegacyInterOpController@userBatchMarkChannelAsRead');
    Route::post('user-batch-send-message', 'LegacyInterOpController@userBatchSendMessage');
    Route::delete('/user-sessions/{user}', 'LegacyInterOpController@userSessionsDestroy');
    Route::post('user-index/{user}', 'LegacyInterOpController@userIndex');
    Route::post('user-recalculate-ranked-scores/{user}', 'LegacyInterOpController@userRecalculateRankedScores');
    Route::get('/news', 'LegacyInterOpController@news');

    Route::group(['namespace' => 'InterOp'], function () {
        Route::post('artist-tracks/reindex-all', 'ArtistTracksController@reindexAll');

        Route::group(['as' => 'beatmapsets.', 'prefix' => 'beatmapsets'], function () {
            Route::group(['prefix' => '{beatmapset}'], function () {
                Route::post('broadcast-new', 'BeatmapsetsController@broadcastNew')->name('broadcast-new');
                Route::post('broadcast-revive', 'BeatmapsetsController@broadcastRevive')->name('broadcast-revive');
                Route::post('broadcast-update', 'BeatmapsetsController@broadcastUpdate')->name('broadcast-update');
                Route::post('disqualify', 'BeatmapsetsController@disqualify')->name('disqualify');
            });
        });
        Route::resource('beatmapsets', 'BeatmapsetsController', ['only' => ['destroy']]);

        Route::group(['as' => 'indexing.', 'prefix' => 'indexing'], function () {
            Route::apiResource('bulk', 'Indexing\BulkController', ['only' => ['store']]);
        });

        Route::group(['as' => 'multiplayer.', 'namespace' => 'Multiplayer', 'prefix' => 'multiplayer'], function () {
            Route::put('rooms/{room}/users/{user}', 'RoomsController@join')->name('rooms.join');
            Route::delete('rooms/{room}/users/{user}', 'RoomsController@part')->name('rooms.part');
            Route::apiResource('rooms', 'RoomsController', ['only' => ['store']]);
        });

        Route::resource('teams', 'TeamsController', ['only' => ['destroy']]);

        Route::post('user-achievement/{user}/{achievement}/{beatmap?}', 'UsersController@achievement')->name('users.achievement');
        Route::post('users/{user}/{beatmap}/{ruleset}/rank-achieved', 'UsersController@rankAchieved')->name('users.rank-achieved');
        Route::post('users/{user}/{beatmap}/{ruleset}/first-place-lost', 'UsersController@firstPlaceLost')->name('users.first-place-lost');

        Route::group(['as' => 'user-group.'], function () {
            Route::put('users/{user}/groups/{group}', 'UserGroupsController@update')->name('update');
            Route::delete('users/{user}/groups/{group}', 'UserGroupsController@destroy')->name('destroy');
            Route::post('users/{user}/groups/{group}/default', 'UserGroupsController@setDefault')->name('set-default');
        });

        Route::apiResource('users', 'UsersController', ['only' => ['store']]);
    });
});

Route::get('opensearch.xml', 'HomeController@opensearch');
Route::any('{catchall}', 'FallbackController@index')->where('catchall', '.*')->fallback();

{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Libraries\ApidocRouteHelper;
    use Knuckles\Scribe\Extracting\Generator;

    $wikiUrl = wiki_url('Bot_account', null, false);
@endphp

# Introduction

Welcome to the documentation for osu!api v2. You can use this API to get information on various circles and those who click them.

<aside class="warning">
WARNING: The API is under heavy development and has not stabilised yet. If you choose to use it at this stage, you do so at your own risk. Endpoints may appear, disappear, be renamed and completely change behaviour without warning.
</aside>

Note that while we endeavour to keep this documentation up to date, consider it a work-in-progress and note that it will likely contain errors.

If you notice any errors in the documentation or encounter problems using the API, please check for (or create if necessary) [issues on GitHub](https://github.com/ppy/osu-web/issues). Alternatively, you can ask in `#osu-web` [on the development discord](https://discord.gg/ppy).

Code examples are provided in the dark area to the right, you can use the tabs at the top of the page to switch between bash and javascript samples.

# Terms of Use

Use the API for good. Don't overdo it. If in doubt, ask before (ab)using :). _this section may expand as necessary_.

Current rate limit is set at an insanely high 1200 requests per minute, with burst capability of up to 200 beyond that. If you require more, you probably fall into the above category of abuse. If you are doing more than 60 requests a minute, you should probably give [peppy](mailto:pe@ppy.sh) a yell.

# Endpoint

## Base URL

The base URL is: `{{ config('app.url') }}/api/[version]/`

## API Versions

This is combined with the base endpoint to determine where requests should be sent.

Version | Status
------- | ---------------------------------------------------------------
v2      | current _(not yet public, consider unstable and expect breaking changes)_
v1      | _legacy api provided by the old site, will be deprecated soon_

# Authentication

Routes marked with the <a class="badge badge-scope badge-scope-oauth" name="scope-oauth">OAuth</a> label require a valid OAuth2 token for access.

More information about applications you have registered and granted permissions to can be found [here](#managing-oauth-applications).

The API supports the following grant types:
- [Authorization Code Grant](https://oauth.net/2/grant-types/authorization-code/)
- [Client Credentials Grant](https://oauth.net/2/grant-types/client-credentials/)

Before you can use the osu!api, you will need to
1. have registered an OAuth Application.
2. acquire an access token by either:
  - authorizing users for your application;
  - requesting Client Credentials token.


## Registering an OAuth application

Before you can get an OAuth token, you will need to register an OAuth application on your [account settings page]({{ route('account.edit').'#new-oauth-application' }})

To register an OAuth application you will need to provide the:

Name                     | Description
-------------------------|--------------------------
Application Name         | This is the name that will be visible to users of your application. The name of your application cannot be changed.
Application Callback URL | The URL in your application where users will be sent after authorization.

The `Application Callback URL` is required when for using [Authorization Codes](#authorization-code-grant).
This may be left blank if you are only using [Client Credentials Grants](#client-credentials-grant).

Your new OAuth application will have a `Client ID` and `Client Secret`; the `Client Secret` is like a password for your OAuth application, it should be kept private and **do not share it with anyone else**.


## Authorization Code Grant

The flow to authorize users for your application is:
1. Requesting authorization from users
2. Users are redirected back to your site
3. Your application accesses the API with the user's access token

<aside class="notice">
Restricted users can grant authorization like anyone else. If your client should not support restricted users, it can check <code>is_restricted</code> from the <a href="#get-own-data">Get Own Data</a> response.
</aside>


### Request authorization from a user

@php
    $description = 'To obtain an access token, you must first get an authorization code that is created when a user grants permissions to your application. To request permission from the user, they should be redirected to:';
    $uri = route('oauth.authorizations.authorize', null, false);
    $route = [
        'boundUri' => $uri,
        'cleanBodyParameters' => [],
        'fileParameters' => [],
        'headers' => [],
        'metadata' => ['authenticated' => false, 'description' => $description],
        'methods' => ['GET'],
        'nestedBodyParameters' => [],
        'responses' => [],
        'uri' => $uri,
        'urlParameters' => [],
        'queryParameters' => [
            'client_id' => [
                'description' => 'The Client ID you received when you [registered]('.route('account.edit').'#new-oauth-application).',
                'name' => 'client_id',
                'type' => 'number',
                'value' => 1,
            ],
            'redirect_uri' => [
                'description' => 'The URL in your application where users will be sent after authorization. This must match the registered Application Callback URL exactly.',
                'name' => 'redirect_uri',
                'value' => 'http://localhost:4000',
            ],
            'response_type' => [
                'description' => 'This should always be `code` when requesting authorization.',
                'name' => 'response_type',
                'value' => 'code',
            ],
            'scope' => [
                'description' => 'A space-delimited string of [scopes](#scopes).',
                'name' => 'scope',
                'required' => false,
                'value' => 'public identify',
            ],
            'state' => [
                'description' => 'Data that will be returned when a temporary code is issued. It can be used to provide a token for protecting against cross-site request forgery attacks.',
                'name' => 'state',
                'required' => false,
                'value' => 'randomval',
            ],
        ],
    ];
    $route['cleanQueryParameters'] = Generator::cleanParams($route['queryParameters']);
@endphp
@include('scribe::partials.endpoint', [
    'endpointId' => 'oauth-authorizations-authorize',
    'route' => $route,
    'settings' => [
        'interactive' => false,
        // request should be done on browser
        'languages' => [],
    ],
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

### User is redirected back to your site

@php
    $description = <<<EOT
        If the user accepts your request, they will be redirected back to your site with a temporary single-use `code` contained in the URL parameter.
        If a `state` value was provided in the previous request, it will be returned here.

        <aside class="notice">
            If you are using `state` as protection against CSRF attacks, your OAuth client is responsible for validating this value.
        </aside>

        Exchange this `code` for an access token:

        ---

        ### Response Format

        Successful requests will be issued an access token:

        Name          | Type   | Description
        --------------|--------|-----------------------------
        token_type    | string | The type of token, this should always be `Bearer`.
        expires_in    | number | The number of seconds the token will be valid for.
        access_token  | string | The access token.
        refresh_token | string | The refresh token.
        EOT;
    $uri = route('oauth.passport.token', null, false);
    $route = [
        'boundUri' => $uri,
        'cleanQueryParameters' => [],
        'fileParameters' => [],
        'headers' => [],
        'metadata' => ['authenticated' => false, 'description' => $description],
        'methods' => ['POST'],
        'nestedBodyParameters' => [
            'client_id' => [
                'description' => 'The client ID of your application.',
                'name' => 'client_id',
                'required' => true,
                'value' => 1,
            ],
            'client_secret' => [
                'description' => 'The client secret of your application.',
                'name' => 'client_secret',
                'required' => true,
                'value' => 'clientsecret',
            ],
            'code' => [
                'description' => 'The code you received.',
                'name' => 'code',
                'required' => true,
                'value' => 'receivedcode',
            ],
            'grant_type' => [
                'description' => 'This must always be `authorization_code`',
                'name' => 'grant_type',
                'required' => true,
                'value' => 'authorization_code',
            ],
            'redirect_uri' => [
                'description' => 'The URL in your application where users will be sent after authorization.',
                'name' => 'redirect_uri',
                'required' => true,
                'value' => 'http://localhost:4000',
            ],
        ],
        'queryParameters' => [],
        'responses' => [
            [
                'content' => [
                    'access_token' => 'verylongstring',
                    'expires_in' => 86400,
                    'refresh_token' => 'anotherlongstring',
                    'token_type' => 'Bearer',
                ],
                'status' => 200,
            ],
        ],
        'showresponse' => true,
        'uri' => $uri,
        'urlParameters' => [],
    ];
    $route['cleanBodyParameters'] = Generator::cleanParams($route['nestedBodyParameters']);
@endphp
@include('scribe::partials.endpoint', [
    'endpointId' => 'oauth-passport-token',
    'route' => $route,
    'settings' => [
        'interactive' => false,
        'languages' => config('scribe.example_languages'),
    ],
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

## Client Credentials Grant

@php
    $description = <<<EOT
        The client credential flow provides a way for developers to get access tokens that do not have associated user permissions; as such, these tokens are considered as guest users.

        Example for requesting Client Credentials token:

        ---

        ### Response Format

        Successful requests will be issued an access token:

        Name          | Type   | Description
        --------------|--------|-----------------------------
        token_type    | string | The type of token, this should always be `Bearer`.
        expires_in    | number | The number of seconds the token will be valid for.
        access_token  | string | The access token.
        EOT;
    $uri = route('oauth.passport.token', null, false);
    $route = [
        'boundUri' => $uri,
        'cleanQueryParameters' => [],
        'fileParameters' => [],
        'headers' => [],
        'metadata' => ['authenticated' => false, 'description' => $description],
        'methods' => ['POST'],
        'nestedBodyParameters' => [
            'client_id' => [
                'description' => 'The Client ID you received when you [registered]('.route('account.edit').'#new-oauth-application).',
                'name' => 'client_id',
                'required' => true,
                'type' => 'number',
                'value' => 1,
            ],
            'client_secret' => [
                'description' => 'The client secret of your application.',
                'name' => 'client_secret',
                'required' => true,
                'type' => 'string',
                'value' => 'clientsecret',
            ],
            'grant_type' => [
                'description' => 'This must always be `client_credentials`.',
                'name' => 'grant_type',
                'required' => true,
                'type' => 'string',
                'value' => 'client_credentials',
            ],
            'scope' => [
                'description' => 'Must be `public`; other scopes have no meaningful effect.',
                'name' => 'scope',
                'required' => true,
                'type' => 'string',
                'value' => 'public',
            ],
        ],
        'queryParameters' => [],
        'responses' => [
            [
                'content' => [
                    'access_token' => 'verylongstring',
                    'expires_in' => 86400,
                    'token_type' => 'Bearer',
                ],
                'status' => 200,
            ],
        ],
        'showresponse' => true,
        'uri' => $uri,
        'urlParameters' => [],
    ];
    $route['cleanBodyParameters'] = Generator::cleanParams($route['nestedBodyParameters']);
@endphp
@include('scribe::partials.endpoint', [
    'endpointId' => 'oauth-passport-token-client',
    'route' => $route,
    'settings' => [
        'interactive' => false,
        'languages' => config('scribe.example_languages'),
    ],
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

## Using the access token to access the API

With the access token, you can make requests to osu!api on behalf of a user.

The token should be included in the header of requests to the API.

`Authorization: Bearer @{{token}}`

```shell
# With shell, you can just pass the correct header with each request
curl "{{ config('app.url') }}/api/[version]/[endpoint]"
  -H "Authorization: Bearer @{{token}}"
```

```javascript
// This javascript example uses fetch()
fetch("{{ config('app.url') }}/api/[version]/[endpoint]", {
    headers: {
      Authorization: 'Bearer @{{token}}'
    }
});
```

> Make sure to replace `@{{token}}` with your OAuth2 token.

<aside class="notice">
You must replace <code>@{{token}}</code> with your OAuth2 token.
</aside>


## Resource Owner

The `Resource Owner` is the user that a token acts on behalf of.

For [Authorization Code Grant](#authorization-code-grant) tokens, the Resource Owner is the user authorizing the token.

[Client Credentials Grant](#client-credentials-grant) tokens do not have a Resource Owner (i.e. is a guest user), unless they have been granted the {{ ApidocRouteHelper::scopeBadge('delegate') }} scope. The Resource Owner of tokens with the {{ ApidocRouteHelper::scopeBadge('delegate') }} scope is the owner of the OAuth Application that was granted the token.

Routes marked with <span class='badge badge-scope badge-user'>requires user</span> require the use of tokens that have a Resource Owner.


## Client Credentials Delegation

Client Credentials Grant tokens may be allowed to act on behalf of the owner of the OAuth client (delegation) by requesting the {{ ApidocRouteHelper::scopeBadge('delegate') }} scope, in addition to other scopes supporting delegation.
When using delegation, scopes that support delegation cannot be used together with scopes that do not support delegation.
Delegation is only available to [Chat Bot]({{ $wikiUrl }})s.

The following scopes currently support delegation:

Name   |
-------|
{{ ApidocRouteHelper::scopeBadge('chat.write') }} |


## Scopes

The following scopes are currently supported:

@php
$scopeDescriptions = [
    'chat.write' => "Allows sending chat messages on a user's behalf.",
    'delegate' => "Allows acting as the owner of a client; only available for [Client Credentials Grant](#client-credentials-grant).",
    'forum.write' => "Allows creating and editing forum posts on a user's behalf.",
    'friends.read' => 'Allows reading of the user\'s friend list.',
    'identify' => 'Allows reading of the public profile of the user (`/me`).',
    'public' => 'Allows reading of publicly available data on behalf of the user.',
];
@endphp

Name   | Description
-------|-------------------------------
@foreach ($scopeDescriptions as $scope => $description)
<a class="badge badge-scope badge-scope-{{ $scope }}" name="scope-{{ $scope }}">{{ $scope }}</a> | {{ $description }}
@endforeach

`identify` is the default scope for the [Authorization Code Grant](#authorization-code-grant) and always implicitly provided. The [Client Credentials Grant](#client-credentials-grant) does not currently have any default scopes.

Routes marked with <a class="badge badge-scope badge-scope-lazer" name="scope-lazer">lazer</a> are intended for use by the [osu!lazer](https://github.com/ppy/osu) client and not currently available for use with Authorization Code or Client Credentials grants.

Using the {{ ApidocRouteHelper::scopeBadge('chat.write') }} scope requires either
- a [Chat Bot]({{ $wikiUrl }}) account to send messages on behalf of other users.
- Authorization code grant where the user is the same as the client's owner (send as yourself).


## Managing OAuth applications

Your [account settings]({{ route('account.edit').'#oauth' }}) page will show your registered OAuth applications, and all the OAuth applications you have granted permissions to.

### Reset Client Secret

You can generate a new `Client Secret` by choosing to "Reset client secret", however, this will disable all access tokens issued for the application.


# Changelog

For a full list of changes, see the
[Changelog on the site]({{ route('changelog.show', ['changelog' => 'web']) }}).

## Breaking Changes

### 2021-09-01
- `last_read_id` in [ChatChannel](#chatchannel) is deprecated, use `current_user_attributes.last_read_id` instead.

### 2021-08-11
- `bot` scope removed in favour for `delegate` scope [Client Credentials Delegation](#client-credentials-delegation).

### 2021-06-14
- Removed `description` from [UserGroup](#usergroup). It has been moved to an optional attribute with a different type on [Group](#group).

### 2021-06-09
- `ranked_and_approved_beatmapset_count` and `unranked_beatmapset_count` attributes in [UserCompact](#usercompact) object have been deprecated and replaced with `ranked_beatmapset_count` and `pending_beatmapset_count` respectively.
- `ranked_and_approved` and `unranked` types in [Get User Beatmaps](#get-user-beatmaps) have been deprecated and replaced with `ranked` and `pending` respectively.

### 2021-04-20
- `cover_url` in [User](#user) is deprecated, use `cover.url` instead.

### 2021-02-25
- `current_mode_rank` has been removed from [UserCompact](#usercompact)
- attributes in [UserStatistics](#userstatistics) have been moved around
  - `rank.country` is deprecated, replaced by `country_rank`
  - `rank.global` and `pp_rank` are removed, replaced by `global_rank`

### 2020-09-08
- `presence` removed from `chat/new` response.

### 2020-08-28
- `/rooms/{room_id}/leaderboard` no longer returns an array at the top level; an object with keys is now returned.

### 2020-05-01
- `users.read` scope removed, replaced with more general `public` scope.

### 2020-02-18
- Beatmap `max_combo` and build update stream `user_count` now return the values as primitives instead of numbers wrapped in an array.

### 2019-10-09
- Ranking API response no longer returns an array at the top level; an object with keys is now returned.

### 2019-07-18
- [`User`](#user) now returns counts directly as primitives instead of numbers wrapped in an array.

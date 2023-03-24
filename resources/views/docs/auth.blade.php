{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Libraries\ApidocRouteHelper;
    use Knuckles\Camel\Output\OutputEndpointData;

    $baseUrl = config('app.url');
    $wikiUrl = wiki_url('Bot_account', null, false);

    $defaultHeaders = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/x-www-form-urlencoded',
    ];
@endphp

<h1>Authentication</h1>

<p>
    Routes marked with the <a class="badge badge-scope badge-scope-oauth" name="scope-oauth">OAuth</a> label require a valid OAuth2 token for access.
</p>

<p>
    More information about applications you have registered and granted permissions to can be found <a href="#managing-oauth-applications">here</a>.
</p>

<p>
    The API supports the following grant types:
    <ul>
        <li><a href="https://oauth.net/2/grant-types/authorization-code/">Authorization Code Grant</a>
        <li><a href="https://oauth.net/2/grant-types/client-credentials/">Client Credentials Grant</a>
    </ul>
</p>

<p>
    Before you can use the osu!api, you will need to
    <ol>
        <li>have registered an OAuth Application.
        <li>
            acquire an access token by either:
            <ul>
                <li>authorizing users for your application;
                <li>requesting Client Credentials token.
            </ul>
    </ol>
</p>


<h2>Registering an OAuth application</h2>

<p>
    Before you can get an OAuth token, you will need to register an OAuth application on your <a href="{{ route('account.edit').'#new-oauth-application' }}">account settings page</a>.
<p>

<p>
    To register an OAuth application you will need to provide the:
</p>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Application Name</td>
            <td>
                This is the name that will be visible to users of your application. The name of your application cannot be changed.
            </td>
        </tr>
        <tr>
            <td>Application Callback URL</td>
            <td>
                The URL in your application where users will be sent after authorization.
            </td>
        </tr>
    </tbody>
</table>

<p>
    The <code>Application Callback URL</code> is required when for using <a href="#authorization-code-grant">Authorization Codes</a>.
    This may be left blank if you are only using <a href="#client-credentials-grant">Client Credentials Grants</a>.
</p>

<p>
    Your new OAuth application will have a <code>Client ID</code> and <code>Client Secret</code>; the <code>Client Secret</code> is like a password for your OAuth application, it should be kept private and <strong>do not share it with anyone else</strong>.
</p>


<h2>Authorization Code Grant</h2>

<p>
    The flow to authorize users for your application is:
    <ol>
        <li>Requesting authorization from users
        <li>Users are redirected back to your site
        <li>Your application accesses the API with the user's access token
    </ol>
</p>

<aside class="notice">
Restricted users can grant authorization like anyone else. If your client should not support restricted users, it can check <code>is_restricted</code> from the <a href="#get-own-data">Get Own Data</a> response.
</aside>


<h3>Request authorization from a user</h3>

@php
    $description = 'To obtain an access token, you must first get an authorization code that is created when a user grants permissions to your application. To request permission from the user, they should be redirected to:';
    $uri = route('oauth.authorizations.authorize', null, false);
    $endpoint = new OutputEndpointData([
        'metadata' => ['authenticated' => false, 'description' => $description],
        'methods' => ['GET'],
        'httpMethods' => ['GET'],
        'uri' => $uri,
        'queryParameters' => [
            'client_id' => [
                'description' => 'The Client ID you received when you [registered]('.route('account.edit').'#new-oauth-application).',
                'name' => 'client_id',
                'type' => 'number',
                'example' => 1,
            ],
            'redirect_uri' => [
                'description' => 'The URL in your application where users will be sent after authorization. This must match the registered Application Callback URL exactly.',
                'name' => 'redirect_uri',
                'example' => 'http://localhost:4000',
            ],
            'response_type' => [
                'description' => 'This should always be `code` when requesting authorization.',
                'name' => 'response_type',
                'example' => 'code',
            ],
            'scope' => [
                'description' => 'A space-delimited string of [scopes](#scopes).',
                'name' => 'scope',
                'required' => false,
                'example' => 'public identify',
            ],
            'state' => [
                'description' => 'Data that will be returned when a temporary code is issued. It can be used to provide a token for protecting against cross-site request forgery attacks.',
                'name' => 'state',
                'required' => false,
                'example' => 'randomval',
            ],
        ],
    ]);
@endphp
@include('docs.endpoint', [
    'endpoint' => $endpoint,
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

<h3>User is redirected back to your site</h3>

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
    $endpoint = new OutputEndpointData([
        'bodyParameters' => [
            'client_id' => [
                'description' => 'The client ID of your application.',
                'name' => 'client_id',
                'required' => true,
                'example' => 1,
            ],
            'client_secret' => [
                'description' => 'The client secret of your application.',
                'name' => 'client_secret',
                'required' => true,
                'example' => 'clientsecret',
            ],
            'code' => [
                'description' => 'The code you received.',
                'name' => 'code',
                'required' => true,
                'example' => 'receivedcode',
            ],
            'grant_type' => [
                'description' => 'This must always be `authorization_code`',
                'name' => 'grant_type',
                'required' => true,
                'example' => 'authorization_code',
            ],
            'redirect_uri' => [
                'description' => 'The URL in your application where users will be sent after authorization.',
                'name' => 'redirect_uri',
                'required' => true,
                'example' => 'http://localhost:4000',
            ],
        ],
        'boundUri' => $uri,
        'cleanQueryParameters' => [],
        'fileParameters' => [],
        'headers' => $defaultHeaders,
        'metadata' => ['authenticated' => false, 'description' => $description],
        'httpMethods' => ['POST'],
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
    ]);
@endphp
@include('docs.endpoint', [
    'endpoint' => $endpoint,
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

<h3>Refresh access token</h3>

@php
    $description = <<<EOT
        Access token expires after some time as per `expires_in` field. Refresh the token to get new access token without going through authorization process again.

        Use `refresh_token` received during previous access token request:

        ---

        ### Response Format

        Successful requests will be issued an access token and a new refresh token:

        Name          | Type   | Description
        --------------|--------|-----------------------------
        token_type    | string | The type of token, this should always be `Bearer`.
        expires_in    | number | The number of seconds the token will be valid for.
        access_token  | string | The access token.
        refresh_token | string | The refresh token.
        EOT;
    $uri = route('oauth.passport.token', null, false);
    $endpoint = new OutputEndpointData([
        'bodyParameters' => [
            'client_id' => [
                'description' => 'The Client ID you received when you [registered]('.route('account.edit').'#new-oauth-application).',
                'name' => 'client_id',
                'required' => true,
                'type' => 'number',
                'example' => 1,
            ],
            'client_secret' => [
                'description' => 'The client secret of your application.',
                'name' => 'client_secret',
                'required' => true,
                'type' => 'string',
                'example' => 'clientsecret',
            ],
            'grant_type' => [
                'description' => 'This must always be `refresh_token`.',
                'name' => 'grant_type',
                'required' => true,
                'type' => 'string',
                'example' => 'refresh_token',
            ],
            'refresh_token' => [
                'description' => 'Value of refresh token received from previous access token request.',
                'name' => 'refresh_token',
                'required' => true,
                'type' => 'string',
                'example' => 'longstring',
            ],
            'scope' => [
                'description' => "A space-delimited string of [scopes](#scopes). Specifying fewer scopes than existing access token is allowed but subsequent refresh tokens can't re-add removed scopes. If this isn't specified, existing access token scopes will be used.",
                'name' => 'scope',
                'required' => false,
                'example' => 'public identify',
            ],
        ],
        'boundUri' => $uri,
        'cleanQueryParameters' => [],
        'fileParameters' => [],
        'headers' => $defaultHeaders,
        'metadata' => ['authenticated' => false, 'description' => $description],
        'httpMethods' => ['POST'],
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
    ]);
@endphp
@include('docs.endpoint', [
    'endpoint' => $endpoint,
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

<h2>Client Credentials Grant</h2>

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
    $endpoint = new OutputEndpointData([
        'bodyParameters' => [
            'client_id' => [
                'description' => 'The Client ID you received when you [registered]('.route('account.edit').'#new-oauth-application).',
                'name' => 'client_id',
                'required' => true,
                'type' => 'number',
                'example' => 1,
            ],
            'client_secret' => [
                'description' => 'The client secret of your application.',
                'name' => 'client_secret',
                'required' => true,
                'type' => 'string',
                'example' => 'clientsecret',
            ],
            'grant_type' => [
                'description' => 'This must always be `client_credentials`.',
                'name' => 'grant_type',
                'required' => true,
                'type' => 'string',
                'example' => 'client_credentials',
            ],
            'scope' => [
                'description' => 'Must be `public`; other scopes have no meaningful effect.',
                'name' => 'scope',
                'required' => true,
                'type' => 'string',
                'example' => 'public',
            ],
        ],
        'boundUri' => $uri,
        'cleanQueryParameters' => [],
        'fileParameters' => [],
        'headers' => $defaultHeaders,
        'metadata' => ['authenticated' => false, 'description' => $description],
        'httpMethods' => ['POST'],
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
    ]);
@endphp
@include('docs.endpoint', [
    'endpoint' => $endpoint,
    'showEndpointTitle' => false,
    'showRequestTitle' => false,
])

<h2>Using the access token to access the API</h2>

<p>
    With the access token, you can make requests to osu!api on behalf of a user.
</p>

<p>
    The token should be included in the header of requests to the API.
</p>

<p>
    <code>Authorization: Bearer @{{token}}</code>
</p>

<div class="bash-example">
    <pre><code class="language-bash"
># With shell, you can just pass the correct header with each request
curl "{{ config('app.url') }}/api/[version]/[endpoint]"
  -H "Authorization: Bearer @{{token}}"</code><pre>
</div>

<div class="javascript-example">
    <pre><code class="language-javascript"
>// This javascript example uses fetch()
fetch("{{ config('app.url') }}/api/[version]/[endpoint]", {
    headers: {
      Authorization: 'Bearer @{{token}}'
    }
});</code></pre>
</div>

<blockquote><p>Make sure to replace <code>@{{token}}</code> with your OAuth2 token.</p></blockquote>

<aside class="notice">
    You must replace <code>@{{token}}</code> with your OAuth2 token.
</aside>


<h2>Resource Owner</h2>

<p>
    The <code>Resource Owner</code> is the user that a token acts on behalf of.
</p>

<p>
    For <a href="#authorization-code-grant">Authorization Code Grant</a> tokens, the Resource Owner is the user authorizing the token.
</p>

<p>
    <a href="#client-credentials-grant">Client Credentials Grant</a> tokens do not have a Resource Owner (i.e. is a guest user), unless they have been granted the {{ ApidocRouteHelper::scopeBadge('delegate') }} scope. The Resource Owner of tokens with the {{ ApidocRouteHelper::scopeBadge('delegate') }} scope is the owner of the OAuth Application that was granted the token.
</p>

<p>
    Routes marked with <span class='badge badge-scope badge-user'>requires user</span> require the use of tokens that have a Resource Owner.
</p>


<h2>Client Credentials Delegation</h2>

<p>
    Client Credentials Grant tokens may be allowed to act on behalf of the owner of the OAuth client (delegation) by requesting the {{ ApidocRouteHelper::scopeBadge('delegate') }} scope, in addition to other scopes supporting delegation.
    When using delegation, scopes that support delegation cannot be used together with scopes that do not support delegation.
    Delegation is only available to <a href="{{ $wikiUrl }}">Chat Bot</a>s.
</p>

<p>
    The following scopes currently support delegation:
</p>

<table>
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ ApidocRouteHelper::scopeBadge('chat.write') }}</td>
        </tr>
    </tbody>
</table>

<h2>Scopes</h2>

<p>
    The following scopes are currently supported:
</p>

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

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scopeDescriptions as $scope => $description)
            <tr>
                <td>
                    <a class="badge badge-scope badge-scope-{{ $scope }}" name="scope-{{ $scope }}">{{ $scope }}</a>
                </td>
                <td>{!! markdown_plain($description) !!}</td>
            </tr>
        @endforeach
        <tr>
        </tr>
    </tbody>
</table>

<p>
    <code>identify</code> is the default scope for the <a href="#authorization-code-grant">Authorization Code Grant</a> and always implicitly provided. The <a href="#client-credentials-grant">Client Credentials Grant</a> does not currently have any default scopes.
</p>

<p>
    Routes marked with <a class="badge badge-scope badge-scope-lazer" name="scope-lazer">lazer</a> are intended for use by the <a href="https://github.com/ppy/osu">osu!lazer</a> client and not currently available for use with Authorization Code or Client Credentials grants.
</p>

<p>
    Using the {{ ApidocRouteHelper::scopeBadge('chat.write') }} scope requires either
    <ul>
        <li>a <a href="{{ $wikiUrl }}">Chat Bot</a> account to send messages on behalf of other users.
        <li>Authorization code grant where the user is the same as the client's owner (send as yourself).
    </ul>
</p>


<h2>Managing OAuth applications</h2>

<p>
    Your <a href="{{ route('account.edit').'#oauth' }}">account settings</a> page will show your registered OAuth applications, and all the OAuth applications you have granted permissions to.
</p>

<h3>Reset Client Secret</h3>

<p>
    You can generate a new <code>Client Secret</code> by choosing to "Reset client secret", however, this will disable all access tokens issued for the application.
</p>

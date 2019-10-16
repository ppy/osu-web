# Introduction

Welcome to the documentation for osu!api v2. You can use this API to get information on various circles and those who click them.

<aside class="warning">
WARNING: The API in under heavy development and has not stabilised yet. If you choose to use it at this stage, you do so at your own risk. Endpoints may appear, disappear, be renamed and completely change behaviour without warning.
</aside>

Note that while we endeavour to keep this documentation up to date, consider it a work-in-progress and note that it will likely contains errors.

If you notice any errors in the documentation or encounter problems using the API, please check for (or create if necessary) [issues on GitHub](https://github.com/ppy/osu-web/issues). Alternatively, you can ask in `#osu-web` [on the development discord](https://discord.gg/ppy).

Code examples are provided in the dark area to the right, you can use the tabs at the top of the page to switch between bash and javascript samples.

@if($showPostmanCollectionButton)
If you use [Postman](https://getpostman.com), you can [download a collection here](collection.json).
@endif

# Terms of Use

Use the API for good. Don't overdo it. If in doubt, ask before (ab)using :). _this section may expand as necessary_.

Current rate limit is set at an insanely high 1200 requests per minute, with burst capability of up to 200 beyond that. If you require more, you probably fall into the above category of abuse. If you are doing more than 60 requests a minute, you should probably give [peppy](mailto:pe@ppy.sh) a yell.

# Endpoint

## Base URL

The base URL is: `{{ trim(config('app.url'), '/') }}/api/[version]/`

## API Versions

This is combined with the base endpoint to determine where requests should be sent.

Version | Status
------- | ---------------------------------------------------------------
v2      | current _(not yet public, consider unstable and expect breaking changes)_
v1      | _legacy api provided by the old site, will be deprecated soon_

# Authentication

```shell
# With shell, you can just pass the correct header with each request
curl "{{ trim(config('app.url'), '/') }}/api/[version]/[endpoint]"
  -H "Authorization: Bearer @{{token}}"
```

> Make sure to replace `@{{token}}` with your OAuth2 token.

<aside class="warning">
Public access is not yet available, thus this section is incomplete.
</aside>

osu!api uses OAuth2 to grant access to the API. You can register for access `[somewhere eventually]`.

osu!api requires a valid token to be included with all API requests in a header that looks like the following:

`Authorization: Bearer @{{token}}`

<aside class="notice">
You must replace <code>@{{token}}</code> with your OAuth2 token.
</aside>

# Changelog

For a full list of changes, see the
[Changelog on the site]({{ route('changelog.show', ['version' => 'web']) }}).

## Breaking Changes

### 2019-10-09
- Ranking API response no longer returns an array at the top level; an object with keys is now returned.

### 2019-07-18
- [`User`](#user) now returns counts directly as primitives instead of numbers wrapped in an array.

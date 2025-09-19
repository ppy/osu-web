{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
# Introduction

Welcome to the documentation for osu!api v2. You can use this API to get information on various circles and those who click them.

Note that while we endeavour to keep this documentation up to date, consider it a work-in-progress and note that it will likely contain errors.

If you notice any errors in the documentation or encounter problems using the API, please check for (or create if necessary) [issues on GitHub](https://github.com/ppy/osu-web/issues). Alternatively, you can ask in `#osu-web` [on the development discord](https://discord.gg/ppy).

Code examples are provided in the dark area to the right, you can use the tabs at the top of the page to switch between bash and javascript samples.

# Terms of Use

Use the API for good. Don't overdo it. If in doubt, ask before (ab)using :). _this section may expand as necessary_.

Current rate limit is set at an insanely high 1200 requests per minute, with burst capability of up to 200 beyond that. If you require more, you probably fall into the above category of abuse. If you are doing more than 60 requests a minute, you should probably give [peppy](mailto:pe@ppy.sh) a yell.

# Wrappers

Below is a list of some language-specific wrappers maintained by the community. Your mileage may vary when using them – please report any issues to the wrapper first before reporting back to us.

- [ossapi](https://github.com/Liam-DeVoe/ossapi) (python)
- [aiosu](https://github.com/NiceAesth/aiosu) (python)
- [osu.py](https://github.com/sheppsu/osu.py) (python)
- [rosu-v2](https://github.com/MaxOhn/rosu-v2) (rust)
- [osu.js](https://github.com/L-Mario564/osu.js) (javascript/typescript)
- [osu-api-v2-js](https://github.com/TTTaevas/osu-api-v2-js) (javascript/typescript)

# Changelog

For a full list of changes, see the
[Changelog on the site]({{ route('changelog.show', ['changelog' => 'web']) }}).

## Breaking Changes

### 2025-04-10
- `/beatmaps/{beatmap}/solo-scores` endpoint has been deprecated. Use `/beatmaps/{beatmap}/scores` instead.

### 2024-07-30
- `key` parameter for Get User endpoint has been deprecated. Prefix username with `@` to lookup by username instead.

### 2024-01-23
- `active_tournament_banner` in [User](#user) has been deprecated, use `active_tournament_banners` instead.

### 2023-10-17
- GameMode has been renamed to [Ruleset](#ruleset); existing property names remain unchanged.
- `number` has been removed from documentation and replaced with `integer` or `float` to better reflect the type of number.

### 2023-09-11
- object structures with two main variants (Beatmap, Beatmapset, and User) have their naming changed. The base object which previously has `Compact` suffix has their suffix removed and the previously extended object with no suffix now has `Extended` suffix instead. This matches existing TypeScript interface.

### 2023-02-17
- `content_html` in [ChatMessage](#chatmessage) has been deprecated; pre-rendered markdown will be removed.

### 2023-01-05
- `new_channel_id` in [Create New PM](#create-new-pm) response has been deprecated, use `channel.channel_id` instead.

### 2022-11-21
- `messages` has been removed from Chat [Get Updates](#get-updates).

### 2022-11-11
- `recent_messages` in [ChatChannel](#chatchannel) has been deprecated, it will be removed from [Create Channel](#create-channel) response in the near future.

### 2022-09-27
- `user` include in [Get User Scores](#get-user-scores) response has been deprecated, it will be removed in the near future.

### 2022-07-06
- `chat/presence` endpoint has been deprecated, it will be removed in the near future.

### 2022-06-08
- `discussion_enabled` in Beatmapset is deprecated. All beatmapsets now have it enabled.

### 2021-10-28
- `beatmap` in [Get Beatmap scores](#get-beatmap-scores) `scores` array item is removed (it's never been documented in the first place).

### 2021-09-01
- `last_read_id` in [ChatChannel](#chatchannel) is deprecated, use `current_user_attributes.last_read_id` instead.

### 2021-08-11
- `bot` scope removed in favour for `delegate` scope [Client Credentials Delegation](#client-credentials-delegation).

### 2021-06-14
- Removed `description` from [UserGroup](#usergroup). It has been moved to an optional attribute with a different type on [Group](#group).

### 2021-06-09
- `ranked_and_approved_beatmapset_count` and `unranked_beatmapset_count` attributes in UserCompact object have been deprecated and replaced with `ranked_beatmapset_count` and `pending_beatmapset_count` respectively.
- `ranked_and_approved` and `unranked` types in [Get User Beatmaps](#get-user-beatmaps) have been deprecated and replaced with `ranked` and `pending` respectively.

### 2021-04-20
- `cover_url` in User is deprecated, use `cover.url` instead.

### 2021-02-25
- `current_mode_rank` has been removed from UserCompact
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
- User now returns counts directly as primitives instead of numbers wrapped in an array.


# Endpoint

## Base URL

The base URL is: `{{ $GLOBALS['cfg']['app']['url'] }}/api/[version]/`

## API Versions

This is combined with the base endpoint to determine where requests should be sent.

Version | Status
------- | ---------------------------------------------------------------
v2      | current
v1      | _legacy api provided by the old site, will be deprecated soon_

### API Response Version

Sometimes, an API response need to be updated in non-backward compatible ways. In such cases, the `x-api-version` header is used to determine which version of the response will be returned.

Version 0 is assumed when the header is omitted.

Version  | Change
-------- | ------
20220705 | [Score](#score) object with different set of fields.
20240529 | [`GET /rooms`](#get-multiplayer-rooms) will not return rooms with category `daily_challenge` prior to this version. Temporary, will not be supported after 2024-11-29.

## Language

Language for the response is determined by `Accept-Language` header when specified. Specifying `*` or not setting the header will set the language to user configured language when accessing API as a user.

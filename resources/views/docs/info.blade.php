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

# Endpoint

## Base URL

The base URL is: `{{ config('app.url') }}/api/[version]/`

## API Versions

This is combined with the base endpoint to determine where requests should be sent.

Version | Status
------- | ---------------------------------------------------------------
v2      | current _(not yet public, consider unstable and expect breaking changes)_
v1      | _legacy api provided by the old site, will be deprecated soon_


# Changelog

For a full list of changes, see the
[Changelog on the site]({{ route('changelog.show', ['changelog' => 'web']) }}).

## Breaking Changes

### 2021-10-28
- `beatmap` in [Get Beatmap scores](#get-beatmap-scores) `scores` array item is removed (it's never been documented in the first place).

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

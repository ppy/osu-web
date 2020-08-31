# Object Structures

## Beatmap

Represent a beatmap. This extends [BeatmapCompact](#beatmapcompact) with additional attributes.

Field | Type | Description
------|------|------------

## BeatmapCompact

Represent a beatmap.

Field | Type | Description
------|------|------------

## Beatmapset

Represents a beatmapset. This extends [BeatmapsetCompact](#beatmapsetcompact) with additional attributes.

Field | Type | Description
------|------|------------


## BeatmapsetCompact

Represents a beatmapset.

Field           | Type                 | Description
----------------|----------------------|------------
artist          | string               | |
artist_unicode  | string               | |
covers          | Cover                | |
creator         | string               | |
favourite_count | number               | |
id              | number               | |
play_count      | number               | |
preview_url     | string               | |
source          | string               | |
status          | string               | |
title           | string               | |
title_unicode   | string               | |
user_id         | number               | |
video           | string               | |
beatmaps        | [Beatmap?](#beatmap) | |
has_favourited  | number?              | Not always included.


## Comment
```json
{
  "commentable_id": 407,
  "commentable_type": "news_post",
  "created_at": "2019-09-05T06:31:20+00:00",
  "deleted_at": null,
  "edited_at": null,
  "edited_by_id": null,
  "id": 276,
  "legacy_name": null,
  "message": "yes",
  "message_html": "<div class='osu-md-default'><p class=\"osu-md-default__paragraph\">yes</p>\n</div>",
  "parent_id": null,
  "pinned": true,
  "replies_count": 0,
  "updated_at": "2019-09-05T06:31:20+00:00",
  "user_id": 1,
  "votes_count": 0
}
```

Represents an single comment.

Field            | Type       | Description
---------------- | ---------- | ------------------
commentable_id   | number     | ID of the object the comment is attached to
commentable_type | string     | type of object the comment is attached to
created_at       | string     | ISO 8601 date
deleted_at       | string?    | ISO 8601 date if the comment was deleted; null, otherwise
edited_at        | string?    | ISO 8601 date if the comment was edited; null, otherwise
edited_by_id     | number?    | user id of the user that edited the post; null, otherwise
id               | number     | the ID of the comment
legacy_name      | string?    | username displayed on legacy comments
message          | string?    | markdown of the comment's content
message_html     | string?    | html version of the comment's content
parent_id        | number?    | ID of the comment's parent
pinned           | boolean    | Pin status of the comment
replies_count    | number     | number of replies to the comment
updated_at       | string     | ISO 8601 date
user_id          | number     | user ID of the poster
votes_count      | number     | number of votes


## CommentableMeta
```json
{
  "id": 407,
  "title": "Clicking circles linked to increased performance",
  "type": "news_post",
  "url": "https://osu.ppy.sh/home/"
}
```

Metadata of the object that a comment is attached to.

Field            | Type       | Description
---------------- | ---------- | ------------------
id               | number     | the ID of the object
title            | string     | display title
type             | string     | the type of the object
url              | string     | url of the object


## CommentBundle
```json
{
  "commentable_meta": [
    {
      "id": 407,
      "title": "Clicking circles linked to increased performance",
      "type": "news_post",
      "url": "https://osu.ppy.sh/home"
    }
  ],
  "comments": [
    {
      "commentable_id": 407,
      "commentable_type": "news_post",
      "created_at": "2019-09-05T06:31:20+00:00",
      "deleted_at": null,
      "edited_at": null,
      "edited_by_id": null,
      "id": 276,
      "legacy_name": null,
      "message": "yes",
      "message_html": "<div class='osu-md-default'><p class=\"osu-md-default__paragraph\">yes</p>\n</div>",
      "parent_id": null,
      "replies_count": 0,
      "updated_at": "2019-09-05T06:31:20+00:00",
      "user_id": 1,
      "votes_count": 1337
    },
    {
      "commentable_id": 407,
      "commentable_type": "news_post",
      "created_at": "2019-09-05T07:31:20+00:00",
      "deleted_at": null,
      "edited_at": null,
      "edited_by_id": null,
      "id": 277,
      "legacy_name": null,
      "message": "absolutely",
      "message_html": "<div class='osu-md-default'><p class=\"osu-md-default__paragraph\">absolutely</p>\n</div>",
      "parent_id": null,
      "replies_count": 0,
      "updated_at": "2019-09-05T07:31:20+00:00",
      "user_id": 2,
      "votes_count": 1337
    }
  ],
  "has_more": true,
  "has_more_id": 276,
  "included_comments": [],
  "pinned_comments": [],
  "sort": "new",
  "user_follow": false,
  "user_votes": [277],
  "users": [
    {
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country_code": "AU",
      "default_group": "pippi",
      "id": 1,
      "is_active": true,
      "is_bot": false,
      "is_online": true,
      "is_supporter": true,
      "last_visit": "2025-09-05T08:35:00+00:00",
      "pm_friends_only": false,
      "profile_colour": null,
      "username": "pippi"
    },
    {
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country_code": "AU",
      "default_group": "yuzu",
      "id": 2,
      "is_active": true,
      "is_bot": false,
      "is_online": false,
      "is_supporter": true,
      "last_visit": "2025-09-04T09:28:00+00:00",
      "pm_friends_only": false,
      "profile_colour": null,
      "username": "yuzu"
     }
  ]
}
```

Comments and related data.

Field             | Type                                  | Description
----------------- | ------------------------------------- | --------------------------------------------------------------
commentable_meta  | [CommentableMeta](#commentablemeta)[] | ID of the object the comment is attached to
comments          | [Comment](#comment)[]                 | Array of comments ordered according to `sort`;
has_more          | boolean                               | If there are more comments or replies available
has_more_id       | number?                               |
included_comments | [Comment](#comment)[]                 | Related comments; e.g. parent comments and nested replies
pinned_comments   | [Comment](#comment)[]?                | Pinned comments
sort              | string                                | one of the [CommentSort](#commentsort) types
top_level_count   | number?                               | Number of comments at the top level. Not returned for replies.
total             | number?                               | Total number of comments. Not retuned for replies.
user_follow       | boolean                               | is the current user watching the comment thread?
user_votes        | number[]                              | IDs of the comments in the bundle the current user has upvoted
users             | [UserCompact](#usercompact)[]         | array of users related to the comments


## CommentSort

Available sort types are `new`, `old`, `top`.

Type  | Sort Fields
----- | ------------------------------------------------------------------------
new   | `created_at` (descending), `id` (descending)
old   | `created_at` (ascending), `id` (ascending)
top   | `votes_count` (descending), `created_at` (descending), `id` (descending)

### Building cursor for comments listing

The returned response will be for comments after the specified sort fields.

For example, use last loaded comment for the fields value to load more comments. Also make sure to use same `sort` and `parent_id` values.

## ChatChannel
```json
{
  "channel_id": 1337,
  "name": "test channel",
  "description": "wheeeee",
  "icon": "/images/layout/avatar-guest@2x.png",
  "type": "GROUP",
  "first_message_id": 10,
  "last_read_id": 9150005005,
  "last_message_id": 9150005005,
  "moderated": false,
  "users": [
    2,
    3,
    102
  ]
}
```

Represents an individual chat "channel" in the game.

Field            | Type                 | Description
---------------- | -------------------- | ------------------
channel_id       | number               | |
name             | string               | |
description      | string?              | |
icon*            | string               | display icon for the channel
type             | string               | see channel types below
first_message_id*| number?              | `message_id` of first message (only returned in presence responses)
last_read_id*    | number?              | `message_id` of last message read (only returned in presence responses)
last_message_id* | number?              | `message_id` of last known message (only returned in presence responses)
recent_messages  | ChatMessage[]?       | up to 50 most recent messages
moderated*       | boolean              | user can't send message when the value is `true` (only returned in presence responses)
users*           | number[]?            | array of `user_id` that are in the channel (not included for `PUBLIC` channels)

### Channel Types

Type        | Permission Check for Joining/Messaging
----------- | -----------------------------------------------------
PUBLIC      | |
PRIVATE     | is player in the allowed groups? (channel.allowed_groups)
MULTIPLAYER | is player currently in the mp game?
SPECTATOR   | |
TEMPORARY   | _deprecated_
PM          | see below (user_channels)
GROUP       | is player in channel? (user_channels)

For PMs, two factors are taken into account:

- Is either user blocking the other? If so, deny.
- Does the target only accept PMs from friends? Is the current user a friend? If not, deny.

<aside class="notice">
Public channels, group chats and private DMs are all considered "channels".
</aside>


## ChatMessage
```json
{
  "message_id": 9150005004,
  "sender_id": 2,
  "channel_id": 5,
  "timestamp": "2018-07-06T06:33:34+00:00",
  "content": "i am a lazerface",
  "is_action": 0,
  "sender": {
    "id": 2,
    "username": "peppy",
    "profile_colour": "#3366FF",
    "avatar_url": "https://a.ppy.sh/2?1519081077.png",
    "country_code": "AU",
    "is_active": true,
    "is_bot": false,
    "is_online": true,
    "is_supporter": true
  }
}
```

Represents an individual Message within a [ChatChannel](#chatchannel).

Field      | Type                         | Description
---------- | ---------------------------- | ------------------------------------------------------------
message_id | number                       | unique identifier for message
sender_id  | number                       | `user_id` of the sender
channel_id | number                       | `channel_id` of where the message was sent
timestamp  | string                       | when the message was sent, ISO-8601
content    | string                       | message content
is_action  | boolean                      | was this an action? i.e. `/me dances`
sender     | [UserCompact](#usercompact)  | embeded UserCompact object to save additional api lookups


## Cursor
```json
{
  "_id": 5,
  "_score": 36.234
}
```

```json
{
  "page": 2,
}
```

A structure included in some API responses containing the parameters to get the next set of results.

The values of the cursor should be provided to next request of the same endpoint to get the next set of results.

If there are no more results available, a cursor with a value of `null` is returned: `"cursor": null`.

## Event

The object has different attributes depending on its `type`. Following are attributes available to all types.

Field      | Type                      | Description
-----------|---------------------------|------------
created_at | [Timestamp](#timestamp)   | |
id         | number                    | |
type       | [Event.Type](#event-type) | |

### Additional objects

<div id="event-beatmap" data-unique="event-beatmap"></div>

#### Beatmap

Field | Type
------|-------
title | string
url   | string

<div id="event-beatmapset" data-unique="event-beatmapset"></div>

#### Beatmapset

Field | Type
------|-------
title | string
url   | string

<div id="event-user" data-unique="event-user"></div>

#### User

Field            | Type    | Description
-----------------|---------|---------------------------------
username         | string  | |
url              | string  | |
previousUsername | string? | Only for `usernameChange` event.

<div id="event-type" data-unique="event-type"></div>

### Available Types

#### achievement

When user obtained an achievement.

Field       | Type
------------|------------
achievement | Achievement
user        | [Event.User](#event-user)

#### beatmapPlaycount

When a beatmap has been played for certain number of times.

Field       | Type
------------|------------
beatmap     | [Event.Beatmap](#event-beatmap)
count       | number

#### beatmapsetApprove

When a beatmapset changes state.

Field      | Type                                  | Description
-----------|---------------------------------------|--------------------------------------------
approval   | string                                | `ranked`, `approved`, `qualified`, `loved`.
beatmapset | [Event.Beatmapset](#event-beatmapset) | |
user       | [Event.User](#event-user)             | Beatmapset owner.

#### beatmapsetDelete

When a beatmapset is deleted.

Field      | Type
-----------|--------------------------------------
beatmapset | [Event.Beatmapset](#event-beatmapset)

#### beatmapsetRevive

When a beatmapset in graveyard state is updated.

Field      | Type                                  | Description
-----------|---------------------------------------|------------------
beatmapset | [Event.Beatmapset](#event-beatmapset) | |
user       | [Event.User](#event-user)             | Beatmapset owner.

#### beatmapsetUpdate

When a beatmapset is updated.

Field      | Type                                  | Description
-----------|---------------------------------------|------------------
beatmapset | [Event.Beatmapset](#event-beatmapset) | |
user       | [Event.User](#event-user)             | Beatmapset owner.

#### beatmapsetUpload

When a new beatmapset is uploaded.

Field      | Type                                  | Description
-----------|---------------------------------------|------------------
beatmapset | [Event.Beatmapset](#event-beatmapset) | |
user       | [Event.User](#event-user)             | Beatmapset owner.

#### rank

When a user achieves a certain rank on a beatmap.

Field     | Type                            | Description
----------|---------------------------------|--------------------------------------------
scoreRank | string                          | (FIXME)
rank      | number                          | |
mode      | GameMode                        | |
beatmap   | [Event.Beatmap](#event-beatmap) | |
user      | [Event.User](#event-user)       | |

#### rankLost

When a user loses first place to another user.

Field     | Type
----------|-------------
mode      | [GameMode](#gamemode)
beatmap   | [Event.Beatmap](#event-beatmap)
user      | [Event.User](#event-user)

#### userSupportAgain

When a user supports osu! for the second and onwards.

Field     | Type
----------|----------
user      | [Event.User](#event-user)

#### userSupportFirst

When a user becomes a supporter for the first time.

Field     | Type
----------|----------
user      | [Event.User](#event-user)

#### userSupportGift

When a user is gifted a supporter tag by another user.

Field | Type                      | Description
------|---------------------------|----------------
user  | [Event.User](#event-user) | Recipient user.

#### usernameChange

When a user changes their username.

Field     | Type                      | Description
----------|---------------------------|-----------------------------
user      | [Event.User](#event-user) | Includes `previousUsername`.

## Notification
```json
{
  "id": 1,
  "name": "channel_message",
  "created_at": "2019-04-24T07:12:43+00:00",
  "object_type": "channel",
  "object_id": 1,
  "source_user_id": 1,
  "is_read": true,
  "details": {
    "username": "someone",
    ...
  }
}
```

Represents a notification object.

Field            | Type    | Description
---------------- | ------- | ------------------------------------------------------------------------
id               | number  | |
name             | string  | Name of the event
created_at       | string  | ISO 8601 date
object_type      | string  | |
object_id        | number  | |
source_user_id   | number? | |
is_read          | boolean | |
details          | object  | `message_id` of last known message (only returned in presence responses)

### Event Names

Name                                                                           | Description
------------------------------------------------------------------------------ | -------------------------------------------------------------------
[beatmapset_discussion_lock](#notification-beatmapset_discussion_lock)         | Discussion on beatmap has been locked
[beatmapset_discussion_post_new](#notification-beatmapset_discussion_post_new) | New discussion post on beatmap
[beatmapset_discussion_unlock](#notification-beatmapset_discussion_unlock)     | Discussion on beatmap has been unlocked
[beatmapset_disqualify](#notification-beatmapset_disqualify)                   | Beatmap was disqualified
[beatmapset_love](#notification-beatmapset_love)                               | Beatmap was promoted to loved
[beatmapset_nominate](#notification-beatmapset_nominate)                       | Beatmap was nominated
[beatmapset_qualify](#notification-beatmapset_qualify)                         | Beatmap has gained enough nominations and entered the ranking queue
[beatmapset_reset_nominations](#notification-beatmapset_reset_nominations)     | Nomination of beatmap was reset
[channel_message](#notification-channel_message)                               | Someone sent chat message
[forum_topic_reply](#notification-forum_topic_reply)                           | Someone replied on forum topic

<div id="notification-beatmapset_discussion_lock" data-unique="notification-beatmapset_discussion_lock"></div>

#### `beatmapset_discussion_lock`

Field          | Type   | Description
-------------- | ------ | --------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User who locked discussion

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
cover_url | string | Beatmap cover
title     | string | Beatmap title
username  | string | Username of `source_user_id`

<div id="notification-beatmapset_discussion_post_new" data-unique="notification-beatmapset_discussion_post_new"></div>

#### `beatmapset_discussion_post_new`

Field          | Type   | Description
-------------- | ------ | -----------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | Poster of the discussion

Details object:

Field         | Type    | Description
------------- | ------- | ------------------------------
title         | string  | Beatmap title
cover_url     | string  | Beatmap cover
discussion_id | number  | |
post_id       | number  | |
beatmap_id    | number? | `null` if posted to general all
username      | string  | Username of `source_user_id`

<div id="notification-beatmapset_discussion_unlock" data-unique="notification-beatmapset_discussion_unlock"></div>

#### `beatmapset_discussion_unlock`

Field          | Type   | Description
-------------- | ------ | ----------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User who unlocked discussion

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
title     | string | Beatmap title
cover_url | string | Beatmap cover
username  | string | Username of `source_user_id`

<div id="notification-beatmapset_disqualify" data-unique="notification-beatmapset_disqualify"></div>

#### `beatmapset_disqualify`

Field          | Type   | Description
-------------- | ------ | --------------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User who disqualified beatmapset

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
title     | string | Beatmap title
cover_url | string | Beatmap cover
username  | string | Username of `source_user_id`


<div id="notification-beatmapset_love" data-unique="notification-beatmapset_love"></div>

#### `beatmapset_love`

Field          | Type   | Description
-------------- | ------ | -------------------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User who promoted beatmapset to loved

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
title     | string | Beatmap title
cover_url | string | Beatmap cover
username  | string | Username of `source_user_id`

<div id="notification-beatmapset_nominate" data-unique="notification-beatmapset_nominate"></div>

#### `beatmapset_nominate`

Field          | Type   | Description
-------------- | ------ | -----------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User who nominated beatmapset

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
title     | string | Beatmap title
cover_url | string | Beatmap cover
username  | string | Username of `source_user_id`

<div id="notification-beatmapset_qualify" data-unique="notification-beatmapset_qualify"></div>

#### `beatmapset_qualify`

Field          | Type   | Description
-------------- | ------ | -------------------------------------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User whom beatmapset nomination triggered qualification

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
title     | string | Beatmap title
cover_url | string | Beatmap cover
username  | string | Username of `source_user_id`

<div id="notification-beatmapset_reset_nominations" data-unique="notification-beatmapset_reset_nominations"></div>

#### `beatmapset_reset_nominations`

Field          | Type   | Description
-------------- | ------ | -----------------------------------
object_id      | number | Beatmapset id
object_type    | string | `beatmapset`
source_user_id | number | User who triggered nomination reset

Details object:

Field     | Type   | Description
--------- | ------ | ----------------------------
title     | string | Beatmap title
cover_url | string | Beatmap cover
username  | string | Username of `source_user_id`

<div id="notification-channel_message" data-unique="notification-channel_message"></div>

#### `channel_message`

Field          | Type   | Description
-------------- | ------ | -----------------------
object_id      | number | Channel id
object_type    | string | `channel`
source_user_id | number | User who posted message

Details object:

Field     | Type   | Description
--------- | ------ | ---------------------------------------------------------------------------------
title     | string | Up to 36 characters of the message (ends with `...` when exceeding 36 characters)
cover_url | string | Avatar of `source_user_id`
username  | string | Username of `source_user_id`

<div id="notification-forum_topic_reply" data-unique="notification-forum_topic_reply"></div>

#### `forum_topic_reply`

Field          | Type   | Description
-------------- | ------ | -----------------------
object_id      | number | Topic id
object_type    | string | `forum_topic`
source_user_id | number | User who posted message

Details object:

Field     | Type    | Description
--------- | ------- | ----------------------------
title     | string  | Title of the replied topic
cover_url | string  | Topic cover
post_id   | number  | Post id
username  | string? | Username of `source_user_id`


## GameMode

Available game modes:

Name   | Descriprion
------ | ---------------
fruits | osu!catch
mania  | osu!mania
osu    | osu!standard
taiko  | osu!taiko

## Group

Field       | Type   | Description
------------|--------|-------------------------------------
id          | number | |
identifier  | string | Unique string to identify the group.
name        | string | |
short_name  | string | Short name of the group for display.
description | string | |
colour      | string | |

## KudosuHistory

Field      | Type       | Description
-----------|------------|-----------------------------
id         | number     | |
action     | string     | Either `give`, `reset`, or `revoke`.
amount     | number     | |
model      | string     | Object type which the exchange happened on (`forum_post`, etc).
created_at | Timestamp  | |
giver      | Giver?     | Simple detail of the user who started the exchange.
post       | Post       | Simple detail of the object for display.

### Giver

Field    | Type
---------|-------
url      | string
username | string

### Post

Field | Type    | Description
------|---------|------------------------------------------------------------------------
url   | string? | Url of the object.
title | string  | Title of the object. It'll be "[deleted beatmap]" for deleted beatmaps.

## MultiplayerScore

Score data.

Field              | Type                       | Description
-------------------|----------------------------|-------------------
`id`               | `number`                   |  |
`user_id`          | `number`                   |  |
`room_id`          | `number`                   |  |
`playlist_item_id` | `number`                   |  |
`beatmap_id`       | `number`                   |  |
`rank`             | `rank`                     |  |
`total_score`      | `number`                   |  |
`accuracy`         | `number`                   |  |
`max_combo`        | `number`                   |  |
`mods`             | `Mod[]`                    |  |
`statistics`       | `Statistics`               |  |
`passed`           | `bool`                     |  |
`position`         | `number?`                  |  |
`scores_around`    | `MultiplayerScoresAround?` | Scores around the specified score.
`user`             | `User`                     |  |

## MultiplayerScores

An object which contains scores and related data for fetching next page of the result.

Field        | Type                      | Description
-------------|---------------------------|--------------------------------------------------------------
`cursor`     | `MultiplayerScoresCursor` | To be used to fetch the next page.
`params`     | `object`                  | To be used to fetch the next page.
`scores`     | `MultiplayerScore[]`      |  |
`total`      | `number?`                 | Index only. Total scores of the specified playlist item.
`user_score` | `MultiplayerScore?`       | Index only. Score of the accessing user if exists.

To fetch the next page, make request to [scores index](#get-scores) with relevant `room` and `playlist`,
with parameters which consists of:

- everything in `params`
- everything in `cursor` as sub field of `cursor`

For example, given a response which `params` contains

Key     | Value
--------| -----------
`sort`  | `score_asc`
`limit` | `10`

and `cursor` of

Key           | Value
--------------|------
`score_id`    | `1`
`total_score` | `10`

then the parameters would be

Field                 | Value
----------------------|------------
`sort`                | `score_asc`
`limit`               | `10`
`cursor[score_id]`    | `1`
`cursor[total_score]` | `10`

and thus the query string is `sort=score_asc&limit=10&cursor[score_id]=1&cursor[total_score]=10`.

## MultiplayerScoresAround

Field    | Type                | Description
---------|---------------------|------------
`higher` | `MultiplayerScores` |  |
`lower`  | `MultiplayerScores` |  |

## MultiplayerScoresCursor

An object which contains pointer for fetching further results of a request. It depends on the sort option.

Field         | Type     | Description
--------------|----------|---------------------------------------------------------------------------
`score_id`    | `number` | Last score id of current result (`score_asc`, `score_desc`).
`total_score` | `number` | Last score's total score of current result (`score_asc`, `score_desc`).

## MultiplayerScoresSort

Sort option for multiplayer scores index.

Name         | Descriprion
------------ | ----------------------------
`score_asc`  | Sort by scores, ascending.
`score_desc` | Sort by scores, descending.

## Ranking Response
```json
{
  "cursor": {

  },
  "ranking": [
    {
      "grade_counts": {
          "a": 3,
          "s": 2,
          "sh": 6,
          "ss": 2,
          "ssh": 3
      },
      "hit_accuracy": 92.19,
      "is_ranked": true,
      "level": {
          "current": 30,
          "progress": 0
      },
      "maximum_combo": 3948,
      "play_count": 228050,
      "play_time": null,
      "pp": 990,
      "pp_rank": 87468,
      "ranked_score": 1502995536,
      "replays_watched_by_others": 0,
      "total_hits": 5856573,
      "total_score": 2104193750,
      "user": {
          "avatar_url": "/images/layout/avatar-guest.png",
          "country": {
              "code": "GF",
              "name": "French Guiana"
          },
          "country_code": "GF",
          "cover": {
              "custom_url": null,
              "id": "3",
              "url": "http://osuweb.test/images/headers/profile-covers/c3.jpg"
          },
          "default_group": "default",
          "id": 458402,
          "is_active": false,
          "is_bot": false,
          "is_online": false,
          "is_supporter": true,
          "last_visit": "2017-02-22T11:07:10+00:00",
          "pm_friends_only": false,
          "profile_colour": null,
          "username": "serdman"
      }
    }
  ],
  "total": 100
}
```

Field          | Type                                | Description
-------------- | ----------------------------------- | --------------------------------------------------------------------
beatmapsets    | [Beatmapset](#beatmapset)[]?        | The list of beatmaps in the requested spotlight for the given `mode`; only available if `type` is `charts`
cursor         | [Cursor](#cursor)                   | A cursor
ranking        | [UserStatistics](#userstatistics)[] | Score details ordered by rank in descending order.
spotlight      | [Spotlight](#spotlight)?            | Spotlight details; only available if `type` is `charts`
total          | number                              | An approximate count of ranks available


## Spotlight Response
```json
{
  "spotlights": [
    {
      "end_date": "2019-03-22T00:00:00+00:00",
      "id": 1,
      "mode_specific": false,
      "name": "Best spinning circles 2019",
      "start_date": "2019-02-22T00:00:00+00:00",
      "type": "yearly",
    },
    {
      "end_date": "2019-03-22T00:00:00+00:00",
      "id": 2,
      "mode_specific": true,
      "name": "Ultimate fruit collector February 2019",
      "start_date": "2019-02-22T00:00:00+00:00",
      "type": "monthly",
    }
  ],
}
```

Field          | Type                                | Description
-------------- | ----------------------------------- | --------------------------------------------------------------------
spotlights     | [Spotlight](#spotlight)[]           | An array of spotlights


## RankingType

Available ranking types:

Name        | Descriprion
----------- | ---------------------------------
charts      | Spotlight
country     | Country
performance | Performance
score       | Score


## Spotlight
```json
{
  "end_date": "2019-03-22T00:00:00+00:00",
  "id": 1,
  "mode_specific": false,
  "name": "Best spinning circles 2019",
  "start_date": "2019-02-22T00:00:00+00:00",
  "type": "yearly",
}
```

The details of a spotlight.

Field             | Type     | Description
----------------- | -------- | ----------------------------------------------------------------------------
end_date          | DateTime | The end date of the spotlight.
id                | number   | The ID of this spotlight.
mode_specific     | number   | If the spotlight has different mades specific to each [GameMode](#gamemode).
participant_count | number?  | The number of users participating in this spotlight. This is only shown when viewing a single spotlight.
name              | number   | The name of the spotlight.
start_date        | DateTime | The starting date of the spotlight.
type              | string   | The type of spotlight.

## Timestamp
```json
  "2020-01-01T00:00:00+00:00"
```

Timestamp string in ISO 8601 format.

## User
```json
{
  "avatar_url": "https://a.ppy.sh/1?1501234567.jpeg",
  "country_code": "AU",
  "default_group": "default",
  "id": 1,
  "is_active": true,
  "is_bot": false,
  "is_online": false,
  "is_supporter": true,
  "last_visit": "2020-01-01T00:00:00+00:00",
  "pm_friends_only": false,
  "profile_colour": "#000000",
  "username": "osuuser",
  "cover_url": "https://assets.ppy.sh/user-profile-covers/1/0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef.jpeg",
  "discord": "osuuser#1337",
  "has_supported": true,
  "interests": null,
  "join_date": "2010-01-01T00:00:00+00:00",
  "kudosu": {
    "total": 20,
    "available": 10
  },
  "lastfm": null,
  "location": null,
  "max_blocks": 50,
  "max_friends": 500,
  "occupation": null,
  "playmode": "osu",
  "playstyle": [
    "mouse",
    "touch"
  ],
  "post_count": 100,
  "profile_order": [
    "me",
    "recent_activity",
    "beatmaps",
    "historical",
    "kudosu",
    "top_ranks",
    "medals"
  ],
  "skype": null,
  "title": null,
  "twitter": "osuuser",
  "website": "https://osu.ppy.sh",
  "country": {
    "code": "AU",
    "name": "Australia"
  },
  "cover": {
    "custom_url": "https://assets.ppy.sh/user-profile-covers/1/0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef.jpeg",
    "url": "https://assets.ppy.sh/user-profile-covers/1/0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef.jpeg",
    "id": null
  },
  "account_history": [],
  "active_tournament_banner": [],
  "badges": [
    {
      "awarded_at": "2015-01-01T00:00:00+00:00",
      "description": "Test badge",
      "image_url": "https://assets.ppy.sh/profile-badges/test.png",
      "url": ""
    }
  ],
  "favourite_beatmapset_count": 10,
  "follower_count": 100,
  "graveyard_beatmapset_count": 10,
  "groups": [
    {
      "id": 1,
      "identifier": "gmt",
      "name": "gmt",
      "short_name": "GMT",
      "description": "",
      "colour": "#FF0000"
    }
  ],
  "loved_beatmapset_count": 0,
  "monthly_playcounts": [
    {
      "start_date": "2019-11-01",
      "count": 100
    },
    {
      "start_date": "2019-12-01",
      "count": 150
    },
    {
      "start_date": "2020-01-01",
      "count": 20
    }
  ],
  "page": {
    "html": "<div class='bbcode bbcode--profile-page'><center>Hello</center></div>",
    "raw": "[centre]Hello[/centre]"
  },
  "previous_usernames": [],
  "ranked_and_approved_beatmapset_count": 10,
  "replays_watched_counts": [
    {
      "start_date": "2019-11-01",
      "count": 10
    },
    {
      "start_date": "2019-12-01",
      "count": 12
    },
    {
      "start_date": "2020-01-01",
      "count": 1
    }
  ],
  "scores_first_count": 0,
  "statistics": {
    "level": {
      "current": 60,
      "progress": 55
    },
    "pp": 100,
    "pp_rank": 2000,
    "ranked_score": 2000000,
    "hit_accuracy": 90.5,
    "play_count": 1000,
    "play_time": 100000,
    "total_score": 3000000,
    "total_hits": 6000,
    "maximum_combo": 500,
    "replays_watched_by_others": 270,
    "is_ranked": true,
    "grade_counts": {
      "ss": 10,
      "ssh": 5,
      "s": 50,
      "sh": 0,
      "a": 40
    },
    "rank": {
      "global": 15000,
      "country": 30000
    }
  },
  "support_level": 3,
  "unranked_beatmapset_count": 0,
  "user_achievements": [
    {
      "achieved_at": "2020-01-01T00:00:00+00:00",
      "achievement_id": 1
    }
  ],
  "rankHistory": {
    "mode": "osu",
    "data": [
      16200,
      15500,
      15000
    ]
  }
}
```

Represents a User. Extends [UserCompact](#usercompact) object with additional attributes.

Field                                | Type                                             | Description
-------------------------------------|--------------------------------------------------|------------------------------------------------------------
cover_url                            | string                                           | url of profile cover
discord                              | string?                                          | |
has_supported                        | boolean                                          | whether or not ever being a supporter in the past
interests                            | string?                                          | |
join_date                            | Timestamp                                        | |
kudosu.available                     | number                                           | |
kudosu.total                         | number                                           | |
last_visit                           | Timestamp?                                       | last access time. `null` if the user hides online presence
lastfm                               | string?                                          | |
location                             | string?                                          | |
max_blocks                           | number                                           | maximum number of users allowed to be blocked
max_friends                          | number                                           | maximum number of friends allowed to be added
occupation                           | string?                                          | |
playmode                             | [GameMode](#gamemode)                            | |
pm_friends_only                      | boolean                                          | whether or not the user allows PM from other than friends
post_count                           | number                                           | number of forum posts
profile_order                        | [ProfilePage](#user-profilepage)[]               | ordered array of sections in user profile page
skype                                | string?                                          | |
title                                | string?                                          | user-specific title
twitter                              | string?                                          | |
website                              | string?                                          | |
account_history                      | UserAccountHistory[]                             | |
active_tournament_banner             | [ProfileBanner](#user-profilebanner)?            | |
badges                               | UserBadge[]                                      | |
favourite_beatmapset_count           | number                                           | |
follower_count                       | number                                           | |
graveyard_beatmapset_count           | number                                           | |
groups                               | [Group](#group)[]                                | |
loved_beatmapset_count               | number                                           | |
monthly_playcounts                   | [UserMonthlyPlaycount](#usermounthlyplaycount)[] | |
page                                 |                                                  | |
previous_usernames                   |                                                  | |
rankHistory                          |                                                  | |
ranked_and_approved_beatmapset_count |                                                  | |
replays_watched_counts               |                                                  | |
scores_first_count                   |                                                  | |
statistics                           |                                                  | |
support_level                        |                                                  | |
unranked_beatmapset_count            |                                                  | |
user_achievements                    |                                                  | |

<div id="user-profilebanner" data-unique="user-profilebanner"></div>

### ProfileBanner

Field         | Type        | Description
--------------|-------------|------------
id            | number      | |
tournament_id | number      | |
image         | string      | |

<div id="user-profilepage" data-unique="user-profilepage"></div>

### ProfilePage

| Section         |
|-----------------|
| me              |
| recent_activity |
| beatmaps        |
| historical      |
| kudosu          |
| top_ranks       |
| medals          |

### UserAccountHistory

Field       | Type      | Description
------------|-----------|------------
id          | number    | |
type        | string    | `note`, `restriction`, or `silence`.
timestamp   | Timestamp | |
length      | number    | In seconds.

### UserBadge

Field       | Type      | Description
------------|-----------|------------
awarded_at  | Timestamp | |
description | string    | |
image_url   | string    | |
url         | string    | |

## UserCompact
```json
{
  "id": 2,
  "username": "peppy",
  "profile_colour": "#3366FF",
  "avatar_url": "https://a.ppy.sh/2?1519081077.png",
  "country_code": "AU",
  "is_active": true,
  "is_bot": false,
  "is_online": true,
  "is_supporter": true
}
```
Mainly used for embedding in certain responses to save additional api lookups.

Field          | Type        | Description
-------------- | ------------| ----------------------------------------------------------------------
id             | number      | unique identifier for user
username       | string      | user's display name
profile_colour | string      | colour of username/profile highlight, hex code (e.g. `#333333`)
avatar_url     | string      | url of user's avatar
country_code   | string      | two-letter code representing user's country
is_active      | boolean     | has this account been active in the last x months?
is_bot         | boolean     | is this a bot account?
is_online      | boolean     | is the user currently online? (either on lazer or the new website)
is_supporter   | boolean     | does this user have supporter?


## UserStatistics
```json
{
  "grade_counts": {
      "a": 3,
      "s": 2,
      "sh": 6,
      "ss": 2,
      "ssh": 3
  },
  "hit_accuracy": 92.19,
  "is_ranked": true,
  "level": {
      "current": 30,
      "progress": 0
  },
  "maximum_combo": 3948,
  "play_count": 228050,
  "play_time": null,
  "pp": 990,
  "pp_rank": 87468,
  "ranked_score": 1502995536,
  "replays_watched_by_others": 0,
  "total_hits": 5856573,
  "total_score": 2104193750,
  "user": {
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country": {
          "code": "AU",
          "name": "Australia"
      },
      "country_code": "AU",
      "cover": {
          "custom_url": null,
          "id": "3",
          "url": "https://assets.ppy.sh/user-profile-covers/2/baba245ef60834b769694178f8f6d4f6166c5188c740de084656ad2b80f1eea7.jpeg"
      },
      "default_group": "ppy",
      "id": 2,
      "is_active": false,
      "is_bot": false,
      "is_online": false,
      "is_supporter": true,
      "last_visit": "2019-02-22T11:07:10+00:00",
      "pm_friends_only": false,
      "profile_colour": "#3366FF",
      "username": "peppy"
  }
}
```

A summary of various gameplay statistics for a [User](#user). Specific to a [GameMode](#gamemode)

Field                     | Type                        | Description
------------------------- | --------------------------- | -------------------------------------------
grade_counts.a            | number                      | Number of A ranked scores.
grade_counts.s            | number                      | Number of S ranked scores.
grade_counts.sh           | number                      | Number of Silver S ranked scores.
grade_counts.ss           | number                      | Number of SS ranked scores.
grade_counts.ssh          | number                      | Number of Silver SS ranked scores.
hit_accuracy              | number                      | Hit accuracy percentage
is_ranked                 | boolean                     | Is actively ranked
level.cuurent             | number                      | Current level.
level.progress            | number                      | Progress to next level.
maximum_combo             | number                      | Highest maximum combo.
play_count                | number                      | Number of maps played.
play_time                 | number                      | Cummulative time played.
pp                        | number                      | Performance points
pp_rank                   | number                      | Current rank according to pp.
ranked_score              | number                      | Current ranked score.
replays_watched_by_others | number                      | Number of replays watched by other users.
total_hits                | number                      | Total number of hits.
total_score               | number                      | Total score.
user                      | [UserCompact](#usercompact) | The associated user.


## WikiPage

```json
{
    "layout": "markdown_page",
    "locale": "en",
    "markdown": "# osu! (game mode)\n\n![Gameplay of osu!](/wiki/shared/Interface_osu.jpg \"osu! Interface\")\n\nMarkdownMarkdownTruncated",
    "path": "Game_Modes/osu!",
    "subtitle": "Game Modes",
    "tags": ["tap", "circles"],
    "title": "osu! (game mode)"
}
```

Represents a wiki article

Field    | Type     | Description
-------- | -------- | ----------------------------------------------------------
layout   | string   | The layout type for the page.
locale   | string   | All lowercase BCP 47 language tag.
markdown | string   | Markdown content.
path     | string   | Path of the article.
subtitle | string?  | The article's subtitle.
tags     | string[] | Associated tags for the article.
title    | string   | The article's title.

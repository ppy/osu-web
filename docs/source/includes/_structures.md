# Object Structures

## ChatChannel
```json
{
  "channel_id": 1337,
  "name": "test channel",
  "description": "wheeeee",
  "icon": "/images/layout/avatar-guest@2x.png",
  "type": "GROUP",
  "last_read_id": 9150005005,
  "last_message_id": 9150005005,
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
last_read_id*    | number?              | `message_id` of last message read (only returned in presence responses)
last_message_id* | number?              | `message_id` of last known message (only returned in presence responses)
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

## User
```json
{
  "💃": true,
}
```

Represents a User.

<aside class="notice">TODO: This &gt;.&gt;</aside>


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
This is a subset of the above [User](#user), mainly used for embedding in certain responses to save additional api lookups.

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

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

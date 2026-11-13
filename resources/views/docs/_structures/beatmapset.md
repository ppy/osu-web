## Beatmapset

Represents a beatmapset.

Field           | Type                         | Description
--------------- | ---------------------------- | -----------
artist          | string                       | |
artist_unicode  | string                       | |
covers          | [Covers](#beatmapset-covers) | |
creator         | string                       | |
favourite_count | integer                      | |
id              | integer                      | |
nsfw            | boolean                      | |
offset          | integer                      | |
play_count      | integer                      | |
preview_url     | string                       | |
source          | string                       | |
status          | string                       | |
spotlight       | boolean                      | |
title           | string                       | |
title_unicode   | string                       | |
user_id         | integer                      | |
video           | boolean                      | |

Those fields are optional.

Field                   | Type                                                         | Description
----------------------- | ------------------------------------------------------------ | -----------
beatmaps                | ([Beatmap](#beatmap)\|[BeatmapExtended](#beatmapextended))[] | |
converts                |                                                              | |
current_nominations     | [Nomination](#nomination)[]                                  | |
current_user_attributes |                                                              | |
description             |                                                              | |
discussions             |                                                              | |
events                  |                                                              | |
genre                   |                                                              | |
has_favourited          | boolean                                                      | |
language                |                                                              | |
nominations             |                                                              | |
pack_tags               | string[]                                                     | |
ratings                 |                                                              | |
recent_favourites       |                                                              | |
related_users           |                                                              | |
user                    |                                                              | |
track_id                | integer                                                      | |
is_exclusive_track      | boolean                                                      | |

<div id="beatmapset-covers" data-unique="beatmapset-covers"></div>

### Covers

Field        | Type
------------ | ------
cover        | string
cover@2x     | string
card         | string
card@2x      | string
list         | string
list@2x      | string
slimcover    | string
slimcover@2x | string

<div id="beatmapset-rank-status" data-unique="beatmapset-rank-status"></div>

### Rank status

The possible values are denoted either as integer or string.

Integer | String
------- | ---------
-2      | graveyard
-1      | wip
0       | pending
1       | ranked
2       | approved
3       | qualified
4       | loved

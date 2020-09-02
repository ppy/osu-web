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

Those fields are optional.

Field                   | Type                  | Description
----------------------- | --------------------- | -----------
beatmaps                | [Beatmap](#beatmap)[] | |
converts                |                       | |
current_user_attributes |                       | |
description             |                       | |
discussions             |                       | |
events                  |                       | |
genre                   |                       | |
has_favourited          | boolean               | |
language                |                       | |
nominations             |                       | |
ratings                 |                       | |
recent_favourites       |                       | |
related_users           |                       | |
user                    |                       | |

<div id="beatmapsetcompact-rank-status" data-unique="beatmapsetcompact-rank-status"></div>

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

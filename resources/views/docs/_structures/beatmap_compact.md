## BeatmapCompact

Represent a beatmap.

Field             | Type                  | Description
----------------- | --------------------- | -----------
difficulty_rating | float                 | |
id                | integer               | |
mode              | [GameMode](#gamemode) | |
status            | string                | See [Rank status](#beatmapsetcompact-rank-status) for list of possible values.
total_length      | integer               | |
version           | string                | |

Optional attributes:

Field       | Type                                                                     | Description
----------- | ------------------------------------------------------------------------ | -----------
beatmapset  | [Beatmapset](#beatmapset)\|[BeatmapsetCompact](#beatmapsetcompact)\|null | `Beatmapset` for `Beatmap` object, `BeatmapsetCompact` for `BeatmapCompact` object. `null` if the beatmap doesn't have associated beatmapset (e.g. deleted).
checksum    | string?                                                                  | |
failtimes   | [Failtimes](#beatmapcompact-failtimes)                                   | |
max_combo   | integer                                                                  | |

<div id="beatmapcompact-failtimes" data-unique="beatmapcompact-failtimes"></div>

### Failtimes

All fields are optional but there's always at least one field returned.

Field | Type       | Description
----- | ---------- | --------------------
exit  | integer[]? | Array of length 100.
fail  | integer[]? | Array of length 100.

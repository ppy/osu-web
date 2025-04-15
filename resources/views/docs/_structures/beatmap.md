## Beatmap

Represent a beatmap.

Field             | Type                  | Description
----------------- | --------------------- | -----------
beatmapset_id     | integer               | |
difficulty_rating | float                 | |
id                | integer               | |
mode              | [Ruleset](#ruleset)   | |
status            | string                | See [Rank status](#beatmapset-rank-status) for list of possible values.
total_length      | integer               | |
user_id           | integer               | |
version           | string                | |

Optional attributes:

Field                  | Type                                                                       | Description
---------------------- | -------------------------------------------------------------------------- | -----------
beatmapset             | [Beatmapset](#beatmapset)\|[BeatmapsetExtended](#beatmapsetextended)\|null | `Beatmapset` for `Beatmap` object, `BeatmapsetExtended` for `BeatmapExtended` object. `null` if the beatmap doesn't have associated beatmapset (e.g. deleted).
checksum               | string?                                                                    | |
current_user_playcount | integer                                                                    | |
failtimes              | [Failtimes](#beatmap-failtimes)                                            | |
max_combo              | integer                                                                    | |
owners                 | [BeatmapOwner](#beatmapowner)[]                                            | List of owners (mappers) for the Beatmap.

<div id="beatmap-failtimes" data-unique="beatmap-failtimes"></div>

### Failtimes

All fields are optional but there's always at least one field returned.

Field | Type       | Description
----- | ---------- | --------------------
exit  | integer[]? | Array of length 100.
fail  | integer[]? | Array of length 100.

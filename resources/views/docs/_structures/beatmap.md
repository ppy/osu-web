## Beatmap

Represent a beatmap. This extends [BeatmapCompact](#beatmapcompact) with additional attributes.

Additional attributes:

Field          | Type                     | Description
-------------- | ------------------------ | -----------------------------------------------------------------------
accuracy       | float                    | |
ar             | float                    | |
beatmapset_id  | integer                  | |
bpm            | float?                   | |
convert        | boolean                  | |
count_circles  | integer                  | |
count_sliders  | integer                  | |
count_spinners | integer                  | |
cs             | float                    | |
deleted_at     | [Timestamp](#timestamp)? | |
drain          | float                    | |
hit_length     | integer                  | |
is_scoreable   | boolean                  | |
last_updated   | [Timestamp](#timestamp)  | |
mode_int       | integer                  | |
passcount      | integer                  | |
playcount      | integer                  | |
ranked         | integer                  | See [Rank status](#beatmapsetcompact-rank-status) for list of possible values.
url            | string                   | |

## Score

Field                 | Type                    | Description
--------------------- | ----------------------- | -----------
id                    | integer                 | |
best_id               | integer?                | |
user_id               | integer                 | |
accuracy              | float                   | |
mods                  | Mod[]                   | |
score                 | integer                 | |
max_combo             | integer                 | |
perfect               | boolean                 | |
statistics.count_50   | integer                 | |
statistics.count_100  | integer                 | |
statistics.count_300  | integer                 | |
statistics.count_geki | integer                 | |
statistics.count_katu | integer                 | |
statistics.count_miss | integer                 | |
passed                | boolean                 | |
pp                    | float?                  | |
rank                  | Grade                   | |
created_at            | [Timestamp](#timestamp) | |
mode                  | [GameMode](#gamemode)   | |
mode_int              | integer                 | |
replay                | boolean                 | |

Optional attributes:

Field        | Type                                     | Description
------------ | ---------------------------------------- | -----------
beatmap      | [Beatmap](#beatmap)?                     | |
beatmapset   | [BeatmapsetCompact](#beatmapsetcompact)? | |
rank_country | integer?                                 | |
rank_global  | integer?                                 | |
weight       |                                          | |
user         | [UserCompact](#usercompact)?             | |
match        |                                          | |

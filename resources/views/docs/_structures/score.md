## Score

The following is the format returned when API v2 version header is 20220705 or higher. Exceptions apply (f.ex. doesn't apply for legacy match score).

Field               | Type                     | Description
------------------- | ------------------------ | -----------
accuracy            | float                    | |
beatmap_id          | integer                  | |
best_id             | integer?                 | |
build_id            | integer?                 | |
classic_total_score | integer                  | Only for `solo_score` type
ended_at            | [Timestamp](#timestamp)  | |
has_replay          | boolean                  | |
id                  | integer                  | |
is_perfect_combo    | boolean                  | |
legacy_perfect      | boolean                  | |
legacy_score_id     | integer?                 | |
legacy_total_score  | integer                  | |
max_combo           | integer                  | |
maximum_statistics  | ScoreStatistics          | |
mods                | Mod[]                    | |
passed              | boolean                  | |
playlist_item_id    | integer                  | Only for multiplayer score
pp                  | float?                   | |
preserve            | boolean                  | Whether or not the score may eventually be deleted. Only for `solo_score` type
processed           | boolean                  | Only for `solo_score` type
rank                | string                   | |
ranked              | boolean                  | Whether or not the score can have pp. Only for `solo_score` type
room_id             | integer                  | Only for multiplayer score
ruleset_id          | integer                  | |
started_at          | [Timestamp](#timestamp)? | |
statistics          | ScoreStatistics          | |
total_score         | integer                  | |
type                | string                   | |
user_id             | integer                  | |

### Initial version

The following is the format returned when API v2 version header is 20220704 or lower.

Field                 | Type    | Description
--------------------- | ------- | -----------
id                    |         | |
best_id               |         | |
user_id               |         | |
accuracy              |         | |
mods                  |         | |
score                 |         | |
max_combo             |         | |
perfect               |         | |
statistics.count_50   |         | |
statistics.count_100  |         | |
statistics.count_300  |         | |
statistics.count_geki |         | |
statistics.count_katu |         | |
statistics.count_miss |         | |
passed                | boolean | |
pp                    |         | |
rank                  |         | |
created_at            |         | |
mode                  |         | |
mode_int              |         | |
replay                |         | |

### Optional attributes

Field                   | Type                                                 | Description
----------------------- | ---------------------------------------------------- | -----------
beatmap                 |                                                      | |
beatmapset              |                                                      | |
current_user_attributes | integer?                                             | |
match                   |                                                      | Only for legacy match score
position                | integer?                                             | Only for multiplayer score
rank_country            |                                                      | |
rank_global             |                                                      | |
scores_around           | [MultiplayerScoresAround](#multiplayerscoresaround)? | Scores around the specified score. Only for multiplayer score
user                    |                                                      | |
weight                  |                                                      | |

## Score

The following is the format returned when API v2 version header is 20220705 or higher. Exceptions apply (f.ex. doesn't apply for legacy match score).

Field               | Type                                 | Description
------------------- |--------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
accuracy            | float                               | The accuracy achieved by the user, as a decimal in \[0, 1\] range.                                                                                                                                                                             |
beatmap_id          | integer                             | The ID of the beatmap that the score was set on.                                                                                                                                                                                               |
best_id             | integer?                            | No longer used.                                                                                                                                                                                                                                |
build_id            | integer?                            | The ID of the game build the score was set on.                                                                                                                                                                                                 |
classic_total_score | integer                             | Total score calculated using lazer's "classic scoring" variant. Only present for `solo_score` type.                                                                                                                                            |
ended_at            | [Timestamp](#timestamp)             | When the user finished playing.                                                                                                                                                                                                                |
has_replay          | boolean                             | Whether an online replay exists for this score.                                                                                                                                                                                                |
id                  | integer                             | The ID of this score.                                                                                                                                                                                                                          |
is_perfect_combo    | boolean                             | Whether the user has achieved perfect combo using lazer logic.<sup>1</sup>                                                                                                                                                                     |
legacy_perfect      | boolean                             | Whether the user has achieved perfect combo using stable logic.<sup>1</sup>                                                                                                                                                                    |
legacy_score_id     | integer?                            | Only present on scores set in stable. The ID of this score in the old ID scheme preceding lazer.                                                                                                                                               |
legacy_total_score  | integer                             | Only present on scores set in stable. The total score achieved by the user in stable's scoring algorithm (colloquially known as "score V1").                                                                                                   |
max_combo           | integer                             | The largest combo achieved by the user during gameplay.                                                                                                                                                                                        |
maximum_statistics  | [ScoreStatistics](#scorestatistics) | The best possible score statistics achievable on the map the user played.                                                                                                                                                                      |
mods                | [Mod](#mod)[]                       | The mods used when setting this score.                                                                                                                                                                                                         |
passed              | boolean                             | Whether the user passed or failed gameplay.                                                                                                                                                                                                    |
playlist_item_id    | integer                             | The ID of the multiplayer playlist item associated with this score. Only present for multiplayer scores.                                                                                                                                       |
pp                  | float?                              | Number of performance points awarded to this score.                                                                                                                                                                                            |
preserve            | boolean                             | Whether or not the score may eventually be deleted. Only present for `solo_score` type.                                                                                                                                                        |
processed           | boolean                             | Whether or not the score has been fully processed server-side (most notably including calculation of `pp`). Only present for `solo_score` type.                                                                                                |
rank                | string                              | The letter rank achieved by the score. Notably, this always follows [lazer's updated rank criteria](https://osu.ppy.sh/wiki/en/Client/Release_stream/Lazer/Gameplay_differences_in_osu!(lazer)#differences-in-grading-systems).                |
ranked              | boolean                             | Whether or not this score can be visible on beatmap leaderboards. Notably, presence of unranked mods **does not** influence the value of this flag, and whether a score gives PP **does not** depend on this flag. Only for `solo_score` type. |
room_id             | integer                             | The ID of the room that the user was in when setting this score. Only present for multiplayer scores.
ruleset_id          | integer                             | The ID of the ruleset that this score was set on.                                                                                                                                                                                              |
started_at          | [Timestamp](#timestamp)?            | When the user started playing.                                                                                                                                                                                                                 |
statistics          | [ScoreStatistics](#scorestatistics) | The score statistics achieved in this score,                                                                                                                                                                                                   |
total_score         | integer                             | Total score calculated using lazer's "standardised scoring" variant.                                                                                                                                                                           |
type                | string                              |                                                                                                                                                                                                                                                |
user_id             | integer                             | The ID of the user that achieved this score.                                                                                                                                                                                                   |

<sup>1</sup> These two values are in most cases the same. The one exception where they may differ is osu!mania, because of the removal of the mechanic in which holding down a hold note grants combo for "ticks". See [relevant wiki article](https://osu.ppy.sh/wiki/en/Client/Release_stream/Lazer/Gameplay_differences_in_osu!(lazer)#hold-note-ticks-are-removed) for details.

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

The following fields may also be present in particular contexts.
These optional fields apply to both aforementioned formats.

Field                   | Type                                                 | Description
----------------------- |------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------
beatmap                 | [BeatmapExtended](#beatmapextended)                  | The beatmap that the score was set on.                                                                                         |
beatmapset              | [BeatmapSet](#beatmapset)                            | The beatmapset that the score was set on.                                                                                      |
current_user_attributes | CurrentUserAttributes?                               | Contains information about whether the user in whose name the API request is performed has this score pinned on their profile. |
match                   |                                                      | Contains data relevant to multiplayer matches (`slot`, `team`, `pass`). Only for legacy match scores.
position                | integer?                                             | The position of the score on the leaderboard of the current playlist item. Only for multiplayer scores.
rank_country            |                                                      | The rank of the score on the user's country leaderboards.                                                                      |
rank_global             |                                                      | The rank of the score on global leaderboards.                                                                                  |
scores_around           | [MultiplayerScoresAround](#multiplayerscoresaround)? | Scores around the specified score. Only for multiplayer scores.
user                    |                                                      | The user that set this score.                                                                                                  |
weight                  |                                                      | Information about this score's weighted contribution to the user's total PP.                                                   |

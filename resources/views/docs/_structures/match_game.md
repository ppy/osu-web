## MatchGame

Field        | Type                     | Description
------------ | ------------------------ | -----------
id           | integer                  | |
beatmap      | [Beatmap](#beatmap)      | Includes `beatmapset`.
beatmap_id   | integer                  | |
start_time   | [Timestamp](#timestamp)  | |
end_time     | [Timestamp](#timestamp)? | |
mode         | [Ruleset](#ruleset)      | |
mode_int     | integer                  | |
mods         | string[]                 | Mod combination used for this match game as an array of mod acronyms.
scores       | [Score](#score)[]        | List of scores set by each player for this match game.
scoring_type | string                   | `accuracy`, `combo`, `score`, `scorev2`.
team_type    | string                   | `head-to-head`, `tag-coop`, `tag-team-vs`, `team-vs`.

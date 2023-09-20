## BeatmapDifficultyAttributes

Represent beatmap difficulty attributes. Following fields are always present and then there are additional fields for different rulesets.

Field       | Type
----------- | ----
max_combo   | integer
star_rating | float

### osu

Field                 | Type
--------------------- | ----
aim_difficulty        | float
approach_rate         | float
flashlight_difficulty | float
overall_difficulty    | float
slider_factor         | float
speed_difficulty      | float

### taiko

Field              | Type
------------------ | ----
stamina_difficulty | float
rhythm_difficulty  | float
colour_difficulty  | float
approach_rate      | float
great_hit_window   | float

### fruits

Field         | Type
------------- | ----
approach_rate | float

### mania

Field            | Type
---------------- | ----
great_hit_window | float
score_multiplier | float

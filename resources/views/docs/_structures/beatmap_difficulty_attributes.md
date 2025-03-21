## BeatmapDifficultyAttributes

Represent beatmap difficulty attributes. Following fields are always present and then there are additional fields for different rulesets.

Field       | Type
----------- | ----
star_rating | float
max_combo   | integer

### osu

Field                        | Type
---------------------------- | ----
aim_difficulty               | float
aim_difficult_slider_count   | float
speed_difficulty             | float
speed_note_count             | float
slider_factor                | float
aim_difficult_strain_count   | float
speed_difficult_strain_count | float

### taiko

Field               | Type
------------------- | ----
mono_stamina_factor | float

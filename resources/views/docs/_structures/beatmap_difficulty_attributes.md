## BeatmapDifficultyAttributes

Represent beatmap difficulty attributes. Following fields are always present and then there are additional fields for different rulesets.

Field       | Type
----------- | ----
star_rating | float
max_combo   | integer

### osu

Field                            | Type
-------------------------------- | ----
aim_difficulty                   | float
aim_difficult_slider_count       | float
speed_difficulty                 | float
speed_note_count                 | float
flashlight_difficulty            | float
reading_difficulty               | float
slider_factor                    | float
aim_top_weighted_slider_factor   | float
speed_top_weighted_slider_factor | float
aim_difficult_strain_count       | float
speed_difficult_strain_count     | float
reading_difficult_note_count     | float
nested_score_per_object          | float
legacy_score_base_multiplier     | float
maximum_legacy_combo_score       | float

### taiko

Field                    | Type
------------------------ | ----
rhythm_difficulty_factor | float
mono_stamina_factor      | float
consistency_factor       | float

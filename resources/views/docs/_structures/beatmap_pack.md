## BeatmapPack

Represent a beatmap pack.

Field             | Type                    | Description
----------------- | ----------------------- | -----------
author            | string                  |
date              | [Timestamp](#timestamp) |
name              | string                  |
no_diff_reduction | boolean                 | Whether difficulty reduction mods may be used to clear the pack.
ruleset_id        | number                  |
tag               | string                  | The tag of the beatmap pack. Starts with a character representing the type (See the `Tag` column of [BeatmapPackType](#beatmappacktype)) followed by an integer.
url               | string                  | The download url of the beatmap pack.

### Optional Attributes

Field                               | Type                        | Description
----------------------------------- | --------------------------- | -----------
beatmapsets                         | [Beatmapset](#beatmapset)[] |
user_completion_data.beatmapset_ids | number[]                    | IDs of beatmapsets completed by the user (according to the requirements of the pack)
user_completion_data.completed      | boolean                     | Whether all beatmapsets are completed or not
## BeatmapPack

Represent a beatmap pack.

Field             | Type                    | Description
----------------- | ----------------------- | -----------
author            | string                  |
date              | [Timestamp](#timestamp) |
hidden            | boolean                 |
name              | string                  |
pack_id           | integer                 |
no_diff_reduction | boolean                 | Whether difficulty reduction mods may be used to clear the pack.
mode              | [GameMode](#gamemode)   |
tag               | string                  | The tag of the beatmap pack. Starts with a character representing the type (See the `Tag` column of [BeatmapPackType](#beatmappacktype)) followed by an integer.
url               | string                  | The download url of the beatmap pack.

### Optional Attributes

Field                | Type                        | Description
-------------------- | --------------------------- | -----------
beatmapsets          | [Beatmapset](#beatmapset)[] |
user_completion_data |                             |

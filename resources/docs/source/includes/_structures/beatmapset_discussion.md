## BeatmapsetDiscussion

Represents a Beatmapset modding discussion.

Field                   | Type                                     | Description
----------------------- | ---------------------------------------- | -----------
id                      | number                                   | |
beatmapset_id           | number                                   | |
beatmap_id              | number                                   | |
user_id                 | number                                   | |
deleted_by_id           | number                                   | |
message_type            | [MessageType](#messagetype)              | |
parent_id               | number?                                  | |
timestamp               | number?                                  | |
resolved                | boolean                                  | |
can_be_resolved         | boolean                                  | |
can_grant_kudosu        | boolean                                  | |
created_at              | [Timestamp](#timestamp)                  | |
updated_at              | [Timestamp](#timestamp)                  | |
deleted_at              | [Timestamp](#timestamp)?                 | |
last_post_at            | [Timestamp](#timestamp)                  | |
kudosu_denied           | boolean                                  | |
beatmap                 | [BeatmapCompact](#beatmapcompact)?       | |
beatmapset              | [BeatmapsetCompact](#beatmapsetcompact)? | |
posts                   |                                          | |
current_user_attributes |                                          | |
votes                   |                                          | |
starting_post           |                                          | |


### MessageType

Name        | Description
----------- | -----------
hype        | |
mapper_note | |
praise      | |
problem     | |
review      | |
suggestion  | |

## BeatmapsetDiscussion

Represents a Beatmapset modding discussion.

Field                   | Type                                                     | Description
----------------------- | -------------------------------------------------------- | -----------
beatmap                 | [BeatmapCompact](#beatmapcompact)?                       | |
beatmap_id              | number?                                                  | |
beatmapset              | [BeatmapsetCompact](#beatmapsetcompact)?                 | |
beatmapset_id           | number                                                   | |
can_be_resolved         | boolean                                                  | |
can_grant_kudosu        | boolean                                                  | |
created_at              | [Timestamp](#timestamp)                                  | |
current_user_attributes | [CurrentUserAttributes](#currentuserattributes)?         | |
deleted_at              | [Timestamp](#timestamp)?                                 | |
deleted_by_id           | number?                                                  | |
id                      | number                                                   | |
kudosu_denied           | boolean                                                  | |
last_post_at            | [Timestamp](#timestamp)?                                 | |
message_type            | [MessageType](#messagetype)                              | |
parent_id               | number?                                                  | |
posts                   | [BeatmapsetDiscussionPost](#beatmapsetdiscussionpost)[]? | |
resolved                | boolean                                                  | |
starting_post           | [BeatmapsetDiscussionPost](#beatmapsetdiscussionpost)?   | |
timestamp               | number?                                                  | |
updated_at              | [Timestamp](#timestamp)                                  | |
user_id                 | number                                                   | |
votes                   | object[]                                                 | TODO: change structure

### MessageType

Name        | Description
----------- | -----------
hype        | |
mapper_note | |
praise      | |
problem     | |
review      | |
suggestion  | |

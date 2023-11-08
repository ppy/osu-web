## BeatmapsetDiscussion

Represents a Beatmapset modding discussion.

Field                   | Type                                                     | Description
----------------------- | -------------------------------------------------------- | -----------
beatmap                 | [Beatmap](#beatmap)?                                     | |
beatmap_id              | integer?                                                 | |
beatmapset              | [Beatmapset](#beatmapset)?                               | |
beatmapset_id           | integer                                                  | |
can_be_resolved         | boolean                                                  | |
can_grant_kudosu        | boolean                                                  | |
created_at              | [Timestamp](#timestamp)                                  | |
current_user_attributes | [CurrentUserAttributes](#currentuserattributes)          | |
deleted_at              | [Timestamp](#timestamp)?                                 | |
deleted_by_id           | integer?                                                 | |
id                      | integer                                                  | |
kudosu_denied           | boolean                                                  | |
last_post_at            | [Timestamp](#timestamp)                                  | |
message_type            | [MessageType](#messagetype)                              | |
parent_id               | integer?                                                 | |
posts                   | [BeatmapsetDiscussionPost](#beatmapsetdiscussionpost)[]? | |
resolved                | boolean                                                  | |
starting_post           | [BeatmapsetDiscussionPost](#beatmapsetdiscussionpost)?   | |
timestamp               | integer?                                                 | |
updated_at              | [Timestamp](#timestamp)                                  | |
user_id                 | integer                                                  | |

### MessageType

Name        | Description
----------- | -----------
hype        | |
mapper_note | |
praise      | |
problem     | |
review      | |
suggestion  | |

## Beatmapset

Represents a beatmapset. This extends [BeatmapsetCompact](#beatmapsetcompact) with additional attributes.

Field                          | Type                     | Description
------------------------------ | ------------------------ | -----------------------------------------------------------------------
availability.download_disabled | boolean                  | |
availability.more_information  | string?                  | |
bpm                            | float                    | |
can_be_hyped                   | boolean                  | |
creator                        | string                   | Username of the mapper at the time of beatmapset creation.
discussion_enabled             | boolean                  | |
discussion_locked              | boolean                  | |
hype.current                   | integer                  | |
hype.required                  | integer                  | |
is_scoreable                   | boolean                  | |
last_updated                   | [Timestamp](#timestamp)  | |
legacy_thread_url              | string?                  | |
nominations.current            | integer                  | |
nominations.required           | integer                  | |
ranked                         | integer                  | See [Rank status](#beatmapset-rank-status) for list of possible values.
ranked_date                    | [Timestamp](#timestamp)? | |
source                         | string                   | |
storyboard                     | boolean                  | |
submitted_date                 | [Timestamp](#timestamp)? | |
tags                           | string                   | |

The following attributes are always included as well:

| Field          |
| -------------- |
| has_favourited |

## BeatmapsetExtended

Represents a beatmapset. This extends [Beatmapset](#beatmapset) with additional attributes.

Field                          | Type                         | Description
------------------------------ | ---------------------------- | -----------------------------------------------------------------------
availability.download_disabled | boolean                      | |
availability.more_information  | string?                      | |
bpm                            | float                        | |
can_be_hyped                   | boolean                      | |
deleted_at                     | [Timestamp](#timestamp)?     | |
discussion_enabled             | boolean                      | Deprecated, all beatmapsets now have discussion enabled. |
discussion_locked              | boolean                      | |
hype.current                   | integer                      | |
hype.required                  | integer                      | |
is_scoreable                   | boolean                      | |
last_updated                   | [Timestamp](#timestamp)      | |
legacy_thread_url              | string?                      | |
nominations_summary.current    | integer                      | |
nominations_summary.required   | integer                      | |
ranked                         | integer                      | See [Rank status](#beatmapset-rank-status) for list of possible values.
ranked_date                    | [Timestamp](#timestamp)?     | |
rating                         | float                        | |
source                         | string                       | |
storyboard                     | boolean                      | |
submitted_date                 | [Timestamp](#timestamp)?     | |
tags                           | string                       | |

The following attributes are always included as well:

| Field          |
| -------------- |
| has_favourited |

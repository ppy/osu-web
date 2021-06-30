## Forum Topic

Field         | Type
--------------|-----
created_at    | [Timestamp](#timestamp)
deleted_at    | [Timestamp](#timestamp)
first_post_id | number
forum_id      | number
id            | number
is_locked     | boolean
last_post_id  | number
poll          | [Poll](#forum-topic-poll)?
post_count    | number
title         | string
type          | `normal` \| `sticky` \| `announcement`
updated_at    | [Timestamp](#timestamp)
user_id       | number

<div id="forum-topic-poll" data-unique="forum-topic-poll"></div>

### Poll

Field                   | Type
------------------------|-----
allow_vote_change       | boolean
ended_at                | [Timestamp](#timestamp)?
hide_incomplete_results | boolean
last_vote_at            | [Timestamp](#timestamp)?
max_votes               | number
options                 | [PollOption](#forum-topic-polloption)[]
started_at              | [Timestamp](#timestamp)
title.bbcode            | string
title.html              | string
total_vote_count        | number

<div id="forum-topic-polloption" data-unique="forum-topic-polloption"></div>

### PollOption

Field       | Type    | Notes
------------|---------|------
id          | number  | Unique only per-topic.
text.bbcode | string  | |
text.html   | string  | |
vote_count  | number? | Not present if the poll is incomplete and results are hidden.

<div id="forum-object" data-unique="forum-object"></div>

## Forum

Field       | Type                      | Notes
------------|---------------------------|-------
id          | integer                   |
name        | string                    |
description | string                    |
subforums   | [Forum](#forum-object)[]? | Maximum 2 layers of subforums from the top-level Forum

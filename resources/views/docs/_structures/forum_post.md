## Forum Post

Field        | Type                     | Description
------------ | ------------------------ | -----------
created_at   | [Timestamp](#timestamp)  | |
deleted_at   | [Timestamp](#timestamp)? | |
edited_at    | [Timestamp](#timestamp)? | |
edited_by_id | integer?                 | |
forum_id     | integer                  | |
id           | integer                  | |
topic_id     | integer                  | |
user_id      | integer                  | |

Following fields are optional.

Field     | Type   | Description
--------- | ------ | -----------
body.html | string | Post content in HTML format.
body.raw  | string | Post content in BBCode format.

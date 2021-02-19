## Forum Post

Field        | Type                    | Description
------------ | ----------------------- | -----------
id           | number                  | |
edited_by_id | number                  | |
forum_id     | number                  | |
topic_id     | number                  | |
user_id      | number                  | |
created_at   | [Timestamp](#timestamp) | |
deleted_at   | [Timestamp](#timestamp) | |
edited_at    | [Timestamp](#timestamp) | |

Following fields are optional.

Field     | Type   | Description
--------- | ------ | -----------
body.html | string | Post content in HTML format.
body.raw  | string | Post content in BBCode format.

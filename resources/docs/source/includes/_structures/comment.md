## Comment
```json
{
  "commentable_id": 407,
  "commentable_type": "news_post",
  "created_at": "2019-09-05T06:31:20+00:00",
  "deleted_at": null,
  "edited_at": null,
  "edited_by_id": null,
  "id": 276,
  "legacy_name": null,
  "message": "yes",
  "message_html": "<div class='osu-md-default'><p class=\"osu-md-default__paragraph\">yes</p>\n</div>",
  "parent_id": null,
  "pinned": true,
  "replies_count": 0,
  "updated_at": "2019-09-05T06:31:20+00:00",
  "user_id": 1,
  "votes_count": 0
}
```

Represents an single comment.

Field            | Type       | Description
---------------- | ---------- | ------------------
commentable_id   | number     | ID of the object the comment is attached to
commentable_type | string     | type of object the comment is attached to
created_at       | string     | ISO 8601 date
deleted_at       | string?    | ISO 8601 date if the comment was deleted; null, otherwise
edited_at        | string?    | ISO 8601 date if the comment was edited; null, otherwise
edited_by_id     | number?    | user id of the user that edited the post; null, otherwise
id               | number     | the ID of the comment
legacy_name      | string?    | username displayed on legacy comments
message          | string?    | markdown of the comment's content
message_html     | string?    | html version of the comment's content
parent_id        | number?    | ID of the comment's parent
pinned           | boolean    | Pin status of the comment
replies_count    | number     | number of replies to the comment
updated_at       | string     | ISO 8601 date
user_id          | number     | user ID of the poster
votes_count      | number     | number of votes

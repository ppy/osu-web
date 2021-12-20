## CommentBundle
```json
{
  "commentable_meta": [
    {
      "id": 407,
      "title": "Clicking circles linked to increased performance",
      "type": "news_post",
      "url": "https://osu.ppy.sh/home"
    }
  ],
  "comments": [
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
      "replies_count": 0,
      "updated_at": "2019-09-05T06:31:20+00:00",
      "user_id": 1,
      "votes_count": 1337
    },
    {
      "commentable_id": 407,
      "commentable_type": "news_post",
      "created_at": "2019-09-05T07:31:20+00:00",
      "deleted_at": null,
      "edited_at": null,
      "edited_by_id": null,
      "id": 277,
      "legacy_name": null,
      "message": "absolutely",
      "message_html": "<div class='osu-md-default'><p class=\"osu-md-default__paragraph\">absolutely</p>\n</div>",
      "parent_id": null,
      "replies_count": 0,
      "updated_at": "2019-09-05T07:31:20+00:00",
      "user_id": 2,
      "votes_count": 1337
    }
  ],
  "has_more": true,
  "has_more_id": 276,
  "included_comments": [],
  "pinned_comments": [],
  "sort": "new",
  "user_follow": false,
  "user_votes": [277],
  "users": [
    {
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country_code": "AU",
      "default_group": "pippi",
      "id": 1,
      "is_active": true,
      "is_bot": false,
      "is_online": true,
      "is_supporter": true,
      "last_visit": "2025-09-05T08:35:00+00:00",
      "pm_friends_only": false,
      "profile_colour": null,
      "username": "pippi"
    },
    {
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country_code": "AU",
      "default_group": "yuzu",
      "id": 2,
      "is_active": true,
      "is_bot": false,
      "is_online": false,
      "is_supporter": true,
      "last_visit": "2025-09-04T09:28:00+00:00",
      "pm_friends_only": false,
      "profile_colour": null,
      "username": "yuzu"
     }
  ]
}
```

Comments and related data.

Field             | Type                                  | Description
----------------- | ------------------------------------- | --------------------------------------------------------------
commentable_meta  | [CommentableMeta](#commentablemeta)[] | ID of the object the comment is attached to
comments          | [Comment](#comment)[]                 | Array of comments ordered according to `sort`;
cursor            | [Cursor](#cursor)                     |
has_more          | boolean                               | If there are more comments or replies available
has_more_id       | number?                               |
included_comments | [Comment](#comment)[]                 | Related comments; e.g. parent comments and nested replies
pinned_comments   | [Comment](#comment)[]?                | Pinned comments
sort              | string                                | one of the [CommentSort](#commentsort) types
top_level_count   | number?                               | Number of comments at the top level. Not returned for replies.
total             | number?                               | Total number of comments. Not retuned for replies.
user_follow       | boolean                               | is the current user watching the comment thread?
user_votes        | number[]                              | IDs of the comments in the bundle the current user has upvoted
users             | [UserCompact](#usercompact)[]         | array of users related to the comments

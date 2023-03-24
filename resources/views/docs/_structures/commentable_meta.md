## CommentableMeta
```json
{
  "id": 407,
  "title": "Clicking circles linked to increased performance",
  "type": "news_post",
  "url": "https://osu.ppy.sh/home/"
}
```

Metadata of the object that a comment is attached to.

If object is available:

Field                   | Type                                                               | Description
----------------------- | ------------------------------------------------------------------ | ------------------
current_user_attributes | [CurrentUserAttributes](#commentable-meta-current-user-attributes) | |
id                      | number                                                             | the ID of the object
owner_id                | number?                                                            | User ID which owns the object
owner_title             | string?                                                            | Object owner type, used for display (`MAPPER` for beatmapset)
title                   | string                                                             | display title
type                    | string                                                             | the type of the object
url                     | string                                                             | url of the object

Otherwise if object has been deleted:

Field | Type   | Description
----- | ------ | ------------------
title | string | display title


<div id="commentable-meta-current-user-attributes"></div>

### CurrentUserAttributes

Field                  | Type    | Description
---------------------- | ------- | -----------
can_new_comment_reason | string? | null if current user can comment on it, reason sentence otherwise

## ChatMessage
```json
{
  "channel_id": 5,
  "content": "i am a lazerface",
  "is_action": false,
  "message_id": 9150005004,
  "sender_id": 2,
  "timestamp": "2018-07-06T06:33:34+00:00",
  "type": "plain",
  "uuid": "some-uuid-string",
  "sender": {
    "id": 2,
    "username": "peppy",
    "profile_colour": "#3366FF",
    "avatar_url": "https://a.ppy.sh/2?1519081077.png",
    "country_code": "AU",
    "is_active": true,
    "is_bot": false,
    "is_online": true,
    "is_supporter": true
  }
}
```

Represents an individual Message within a [ChatChannel](#chatchannel).

Field        | Type                         | Description
------------ | ---------------------------- | ------------------------------------------------------------
channel_id   | number                       | `channel_id` of where the message was sent
content      | string                       | message content
content_html | string?                      | Deprecated. Markdown message content as HTML
is_action    | boolean                      | was this an action? i.e. `/me dances`
message_id   | number                       | unique identifier for message
sender_id    | number                       | `user_id` of the sender
timestamp    | string                       | when the message was sent, ISO-8601
type         | string                       | type of message; 'action', 'markdown' or 'plain'
uuid         | string?                      | message identifier originally sent by client

Optional attributes:

Field      | Type                         | Description
---------- | ---------------------------- | ------------------------------------------------------------
sender     | [UserCompact](#usercompact)  | embedded UserCompact object to save additional api lookups

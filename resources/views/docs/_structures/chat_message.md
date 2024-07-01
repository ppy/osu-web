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

Field        | Type                    | Description
------------ | ----------------------- | ------------------------------------------------------------
channel_id   | integer                 | `channel_id` of where the message was sent
content      | string                  | message content
is_action    | boolean                 | was this an action? i.e. `/me dances`
message_id   | integer                 | unique identifier for message
sender_id    | integer                 | `user_id` of the sender
timestamp    | [Timestamp](#timestamp) | when the message was sent, ISO-8601
type         | string                  | type of message; 'action', 'markdown' or 'plain'
uuid         | string?                 | message identifier originally sent by client

Optional attributes:

Field      | Type          | Description
---------- | ------------- | ------------------------------------------------------------
sender     | [User](#user) | embedded User object to save additional api lookups

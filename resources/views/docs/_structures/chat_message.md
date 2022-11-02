## ChatMessage
```json
{
  "message_id": 9150005004,
  "sender_id": 2,
  "channel_id": 5,
  "timestamp": "2018-07-06T06:33:34+00:00",
  "content": "i am a lazerface",
  "is_action": 0,
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

Field      | Type                         | Description
---------- | ---------------------------- | ------------------------------------------------------------
message_id | number                       | unique identifier for message
sender_id  | number                       | `user_id` of the sender
channel_id | number                       | `channel_id` of where the message was sent
timestamp  | string                       | when the message was sent, ISO-8601
content    | string                       | message content
is_action  | boolean                      | was this an action? i.e. `/me dances`
sender     | [UserCompact](#usercompact)  | embedded UserCompact object to save additional api lookups

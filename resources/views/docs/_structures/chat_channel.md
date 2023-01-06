## ChatChannel
```json
{
  "channel_id": 1337,
  "current_user_attributes": {
    "can_message": true,
    "can_message_error": null,
    "last_read_id": 9150005005,
  },
  "name": "test channel",
  "description": "wheeeee",
  "icon": "/images/layout/avatar-guest@2x.png",
  "type": "GROUP",
  "last_read_id": 9150005005,
  "last_message_id": 9150005005,
  "moderated": false,
  "users": [
    2,
    3,
    102
  ]
}
```

Represents an individual chat "channel" in the game.

Field                   | Type                          | Description
----------------------- | ----------------------------- | ------------------
channel_id              | number                        | |
name                    | string                        | |
description             | string?                       | |
icon                    | string?                       | display icon for the channel
type                    | [ChannelType](#channeltype)   | type of channel
moderated               | boolean                       | user can't send message when the value is `true`
uuid                    | string?                       | value from requests that is relayed back to the sender.

Optional attributes:

Field                   | Type                                             | Description
----------------------- | ------------------------------------------------ | ------------------
current_user_attributes | [CurrentUserAttributes](#currentuserattributes)? | only present on some responses
last_read_id            | number?                                          | Deprecated; use `current_user_attributes.last_read_id`.
last_message_id         | number?                                          | `message_id` of last known message (only returned in presence responses)
recent_messages         | ChatMessage[]?                                   | Deprecated; up to 50 most recent messages
users                   | number[]?                                        | array of `user_id` that are in the channel (not included for `PUBLIC` channels)

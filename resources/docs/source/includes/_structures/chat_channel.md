## ChatChannel
```json
{
  "channel_id": 1337,
  "name": "test channel",
  "description": "wheeeee",
  "icon": "/images/layout/avatar-guest@2x.png",
  "type": "GROUP",
  "first_message_id": 10,
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

Field            | Type                 | Description
---------------- | -------------------- | ------------------
channel_id       | number               | |
name             | string               | |
description      | string?              | |
icon*            | string               | display icon for the channel
type             | string               | see channel types below
first_message_id*| number?              | `message_id` of first message (only returned in presence responses)
last_read_id*    | number?              | `message_id` of last message read (only returned in presence responses)
last_message_id* | number?              | `message_id` of last known message (only returned in presence responses)
recent_messages  | ChatMessage[]?       | up to 50 most recent messages
moderated*       | boolean              | user can't send message when the value is `true` (only returned in presence responses)
users*           | number[]?            | array of `user_id` that are in the channel (not included for `PUBLIC` channels)

### Channel Types

Type        | Permission Check for Joining/Messaging
----------- | -----------------------------------------------------
PUBLIC      | |
PRIVATE     | is player in the allowed groups? (channel.allowed_groups)
MULTIPLAYER | is player currently in the mp game?
SPECTATOR   | |
TEMPORARY   | _deprecated_
PM          | see below (user_channels)
GROUP       | is player in channel? (user_channels)

For PMs, two factors are taken into account:

- Is either user blocking the other? If so, deny.
- Does the target only accept PMs from friends? Is the current user a friend? If not, deny.

<aside class="notice">
Public channels, group chats and private DMs are all considered "channels".
</aside>

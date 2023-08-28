# Websocket Events

Websocket events generally have the following standard format:

```json
{
  "data": {},
  "event": "some.event"
}
```

Field | Type    | Description
----- |-------- | -------------
event | string  | Name of the event.
data  | object? | Event payload.

## logout event

User session using same authentication key has been logged out (not yet implemented for OAuth authentication).
Server will disconnect session after sending this event so don't try to reconnect.

## new event

Sent when a new notification is received.

### Payload Format

See [Notification](#notification) object for notification types.

## read event

Sent when a notification has been read.

<aside class="notice">
  This event does not use the <code>data</code> property for payload.
</aside>

TODO: `ids` should be moved to `data` to match other events.

Field | Type     | Description
----- | -------- | ----------------------------------
event | string   | `read`
ids   | number[] | id of Notifications which are read

## chat.channel.join

Broadcast to the user when the user joins a chat channel.

### Payload Format

[ChatChannel](#chat-channel) with `current_user_attributes`, `last_message_id`, `users` additional attributes.

## chat.channel.part

Broadcast to the user when the user leaves a chat channel.

### Payload Format

[ChatChannel](#chat-channel) with `current_user_attributes`, `last_message_id`, `users` additional attributes.

## chat.message.new

Sent to the user when the user receives a chat message.

### Payload Format

Field    | Type                          | Description
-------- |------------------------------ |-------------
messages | [ChatMessage](#chatmessage)[] | The messages received.
users    | [UserCompact](#usercompact)[] | The related users who sent the messages.

Messages intented for a user are always sent even if the user does not currently have the channel open.
Such messages include PM and Announcement messages.

Other messages, e.g. public channel messages are not sent if the user is no longer present in the channel.

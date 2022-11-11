
# Websocket Events

The following Chat-related events are sent to the user over the websocket connection:

## chat.channel.join

Broadcast to the user when the user joins a channel.

### Response Format

[ChatChannel](#chat-channel) with `current_user_attributes`, `last_message_id`, `users` additional attributes.

## chat.channel.part

Broadcast to the user when the user leaves a channel.

### Response Format

[ChatChannel](#chat-channel) with `current_user_attributes`, `last_message_id`, `users` additional attributes.

## chat.message.new

Sent to the user when the user receives a message.

### Response Format

Field    | Type                          | Description
---------|-------------------------------|-------------
messages | [ChatMessage](#chatmessage)[] | The messages received.
users    | [UserCompact](#usercompact)[] | The related users who sent the messages.


Messages intented for a user are always sent even if the user does not currently have the channel open.
Such messages include PM and Announcement messages.

Other messages, e.g. public channel messages are not sent if the user is no longer present in the channel.

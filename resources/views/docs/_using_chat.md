# Using Chat

TODO: better title

Chat consists of HTTP-based and websocket-based APIs.

The Chat websocket API allows receiving updates in real-time; this requires a connection to the [Notification Websocket](#websocket).
Sending messages is still performed through the HTTP-based API.

<aside class="notice">
  Websocket messages may arrive before or after the related HTTP web request completes.
  It is up to the client to handle this.
</aside>

To begin receiving chat messages, clients should send the [chat.start](#chatstart) event across the socket connection.
To stop receiving chat messages, send [chat.end](#chatend).

## Public channels and activity timeout

To continue receiving chat messages in [PUBLIC](#channeltype) channels,
clients must peridiocally request the [Chat Keepalive](#chat-keepalive) endpoint to remain active;
30 seconds is a reasonable interval.
When a client is no longer considered active, the server will stop sending messages in public channels to the client.

Private messages are not affected by this activity timeout.

## Getting the user's channel list

TODO: update default parameter

To get the list of channels the user is in, make a request to [Get Updates](#get-updates) with the `presence` as part of the `includes` parameter.
e.g. `GET` `/chat/updates?includes[]=presence`

## Creating a channel

Make a request to the [Create Channel](#create-channel) endpoint

Only `PM` and `ANNOUNCE` type channels may be created. Creating a channel will automatically join it.
Re-creating a `PM` channel will simply rejoin the existing channel.

## Joining a channel

Make a request to the [Join Channel](#join-channel) endpoint where `channel` is the `channel_id`.

A [chat.channel.join](#chatchanneljoin) event is sent when the over the websocket when the user joins a channel.

## Leaving a channel

Make a request to the [Leave Channel](#leave-channel) endpoint.

Leaving a channel will remove it from the User's channel list.

A [chat.channel.part](#chatchannelpart) event is sent over the websocket when the user leaves a channel.

## Sending messages

Channels should be [joined](#joining-a-channel) or [created](#creating-a-channel) before messages are sent to them.
To send a message a channel, make a request to the [Send Message to Channel](#send-message-to-channel) endpoint.

A [chat.message.new](#chatmessagenew) event is sent over the websocket when the user receives a message.

## Getting info about a channel

Make a request to the [Get Channel](#get-channel) endpoint.

## Getting channel message history

Make a request to the [Get Channel Messages](#get-channel-messages) endpoint.

# Notification Websocket

## Connection

```bash
wscat -c "{notification_endpoint}"
  -H "Authorization: Bearer {{token}}"
```

> The above command will wait and display new notifications as they arrive

This endpoint allows you to receive notifications without constantly polling the server. Correct notification will be a JSON string with at least `event` field:

Field | Type   | Description
----- | ------ | -----------
event | string | See below

Events:

- `logout`: user session using same authentication key has been logged out (not yet implemented for OAuth authentication)
- `new`: new notification
- `read`: notification has been read


## `logout` event

Server will disconnect session after sending this event so don't try to reconnect.

Field | Type   | Description
----- | ------ | -----------
event | string | `logout`

## `new` event

New notification. See [Notification](#notification) object for notification types.

Field | Type                          | Description
----- | ----------------------------- | -----------
event | string                        | `new`
data  | [Notification](#notification) |


## `read` event

Notification has been read.

Field | Type    | Description
----- | ------- | ----------------------------------
event| string   | `read`
ids  | number[] | id of Notifications which are read

# Websocket

## Connection

```bash
wscat -c "{notification_endpoint}"
  -H "Authorization: Bearer {{token}}"
```

> The above command will wait and display new notifications as they arrive

This endpoint allows you to receive notifications and chat events without constantly polling the server.

Events received over the websocket have the follow basic format:

Field | Type    | Description
----- | ------- | -----------------------
event | string  | The name of the event.
data  | object? | Payload of the event; see [Websocket Events](#websocket-events)

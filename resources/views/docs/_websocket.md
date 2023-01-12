# Websocket

## Connection

```bash
wscat -c "{notification_endpoint}"
  -H "Authorization: Bearer {{token}}"
```

> The above command will wait and display new notifications as they arrive

This endpoint allows you to receive notifications and chat events without constantly polling the server.

See [Websocket Events](#websocket-events) for the structure of websocket messages.

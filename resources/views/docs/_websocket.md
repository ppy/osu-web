# Websocket

## Connection

```bash
wscat -c "{notification_endpoint}"
  -H "Authorization: Bearer {{token}}"
```

```javascript
// Requires nodejs with using ESM.
// Browser WebSocket does not support header option.
import WebSocket from 'ws';

const url = 'notification-endpoint';
const token = 'some-token';
const headers = { Authorization: `Bearer ${token}`};

const ws = new WebSocket(url, [], { headers });
ws.on('message', (buffer) => console.log(buffer.toString()));
```

> The above command will wait and display new notifications as they arrive

This endpoint allows you to receive notifications and chat events without constantly polling the server.

See [Websocket Events](#websocket-events) for the structure of websocket messages.

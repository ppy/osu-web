# Websocket Commands

Websocket commands have the format:

```json
{
  "event": "some.event"
}
```

Field | Type    | Description
----- |-------- | -------------
event | string  | Name of the event.

Commands currently do not have any payload.

## chat.start

Send to the websocket to start receiving chat messages.

```javascript
webSocket.send(JSON.stringify({ event: 'chat.start' }));
```

## chat.end

Send to the websocket to stop receiving chat messages.

```javascript
webSocket.send(JSON.stringify({ event: 'chat.start' }));
```

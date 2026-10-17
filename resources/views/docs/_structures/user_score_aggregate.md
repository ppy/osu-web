## UserScoreAggregate

```json
{
  "accuracy": 92.32,
  "attempts": 8,
  "completed": false,
  "pp": 0,
  "room_id": 73421,
  "total_score": "164681041",
  "user_id": 6441
}
```

Aggregates all high scores set by a user in a given multiplayer room.

| Name        | Type    | Description                                            |
|-------------|---------|--------------------------------------------------------|
| accuracy    | float   | Average accuracy across all scores.                    |
| attempts    | int     | Total number of scores submitted to the room.          |
| completed   | boolean | Whether all beatmaps in the playlist have been played. |
| pp          | int     | Not used.                                              |
| room_id     | int     | ID of the room.                                        |
| total_score | int     | Sum of all scores.                                     |
| user_id     | int     | ID of the user.                                        |

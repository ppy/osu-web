## MultiplayerScore

Score data.

Field              | Type                       | Description
-------------------|----------------------------|-------------------
`id`               | `number`                   |  |
`user_id`          | `number`                   |  |
`room_id`          | `number`                   |  |
`playlist_item_id` | `number`                   |  |
`beatmap_id`       | `number`                   |  |
`rank`             | `rank`                     |  |
`total_score`      | `number`                   |  |
`accuracy`         | `number`                   |  |
`max_combo`        | `number`                   |  |
`mods`             | `Mod[]`                    |  |
`statistics`       | `Statistics`               |  |
`passed`           | `bool`                     |  |
`position`         | `number?`                  |  |
`scores_around`    | `MultiplayerScoresAround?` | Scores around the specified score.
`user`             | `User`                     |  |

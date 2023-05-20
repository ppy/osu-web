## MultiplayerScores

An object which contains scores and related data for fetching next page of the result.

Field           | Type                 | Description
--------------- | -------------------- | -------------------------------------------------------------
`cursor_string` | `CursorString`       | To be used to fetch the next page.
`params`        | `object`             | Parameters used for score listing.
`scores`        | `MultiplayerScore[]` | |
`total`         | `number?`            | Index only. Total scores of the specified playlist item.
`user_score`    | `MultiplayerScore?`  | Index only. Score of the accessing user if exists.

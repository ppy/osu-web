## MultiplayerScoresCursor

An object which contains pointer for fetching further results of a request. It depends on the sort option.

Field         | Type    | Description
--------------|---------|---------------------------------------------------------------------------
score_id      | integer | Last score id of current result (`score_asc`, `score_desc`).
total_score   | integer | Last score's total score of current result (`score_asc`, `score_desc`).

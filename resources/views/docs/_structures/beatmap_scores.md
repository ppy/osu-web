## BeatmapScores
```json
{
  "scores": [],
  "userScore": {}
}
```

Field              | Type                                   | Description
------------------ | -------------------------------------- | --------------------------------------------------------------------
scores             | [Score](#score)[]                      | The list of top scores for the beatmap in descending order.
userScore          | [BeatmapUserScore](#beatmapuserscore)? | The score of the current user. This is not returned if the current user does not have a score. Note: will be moved to `user_score` in the future

## BeatmapScores
```json
{
  "scores": [],
  "userScore": {
    "position": 1,
    "score": {}
  }
}
```

Field              | Type              | Description
------------------ | ----------------- | --------------------------------------------------------------------
scores             | [Score](#score)[] | The list of top scores for the beatmap in descending order.
userScore          | Object?           | The score of the current user. This is not returned if the current user does not have a score.
userScore.position | number            | The position of the user's score in the Beatmap's ranking, if available.
userScore.score    | [Score](#score)   | The details of the user's score in the Beatmap's ranking, if available

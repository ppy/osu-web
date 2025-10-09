## ScoreStatistics
```json
{
  "ok": 3,
  "great": 211,
  "ignore_hit": 56,
  "slider_tail_hit": 56
}
```

`ScoreStatistics` is a dictionary whose keys are [hit results as defined by the lazer client](https://github.com/ppy/osu/wiki/Scoring#hit-results), and whose values are counts of said hit results.
This structure is used to represent both the counts of each result achieved by the user on a particular score, and best possible counts of each result on a perfect play.

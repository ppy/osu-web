## UserStatistics
```json
{
  "grade_counts": {
      "a": 3,
      "s": 2,
      "sh": 6,
      "ss": 2,
      "ssh": 3
  },
  "hit_accuracy": 92.19,
  "is_ranked": true,
  "level": {
      "current": 30,
      "progress": 0
  },
  "maximum_combo": 3948,
  "play_count": 228050,
  "play_time": null,
  "pp": 990,
  "global_rank": 87468,
  "ranked_score": 1502995536,
  "replays_watched_by_others": 0,
  "total_hits": 5856573,
  "total_score": 2104193750,
  "user": {
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country": {
          "code": "AU",
          "name": "Australia"
      },
      "country_code": "AU",
      "cover": {
          "custom_url": null,
          "id": "3",
          "url": "https://assets.ppy.sh/user-profile-covers/2/baba245ef60834b769694178f8f6d4f6166c5188c740de084656ad2b80f1eea7.jpeg"
      },
      "default_group": "ppy",
      "id": 2,
      "is_active": false,
      "is_bot": false,
      "is_online": false,
      "is_supporter": true,
      "last_visit": "2019-02-22T11:07:10+00:00",
      "pm_friends_only": false,
      "profile_colour": "#3366FF",
      "username": "peppy"
  }
}
```

A summary of various gameplay statistics for a [User](#user). Specific to a [GameMode](#gamemode)

Field                     | Type                        | Description
------------------------- | --------------------------- | -------------------------------------------
grade_counts.a            | number                      | Number of A ranked scores.
grade_counts.s            | number                      | Number of S ranked scores.
grade_counts.sh           | number                      | Number of Silver S ranked scores.
grade_counts.ss           | number                      | Number of SS ranked scores.
grade_counts.ssh          | number                      | Number of Silver SS ranked scores.
hit_accuracy              | number                      | Hit accuracy percentage
is_ranked                 | boolean                     | Is actively ranked
level.current             | number                      | Current level.
level.progress            | number                      | Progress to next level.
maximum_combo             | number                      | Highest maximum combo.
play_count                | number                      | Number of maps played.
play_time                 | number                      | Cumulative time played.
pp                        | number                      | Performance points
global_rank               | number?                     | Current rank according to pp.
ranked_score              | number                      | Current ranked score.
replays_watched_by_others | number                      | Number of replays watched by other users.
total_hits                | number                      | Total number of hits.
total_score               | number                      | Total score.
user                      | [UserCompact](#usercompact) | The associated user.

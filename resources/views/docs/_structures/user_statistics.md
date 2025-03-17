## UserStatistics
```json
{
  "count_100": 0,
  "count_300": 0,
  "count_50": 0,
  "count_miss": 0,
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

A summary of various gameplay statistics for a [User](#user). Specific to a [Ruleset](#ruleset)

Field                     | Type     | Description
------------------------- | -------- | -----------
count_100                 | integer  | |
count_300                 | integer  | |
count_50                  | integer  | |
count_miss                | integer  | |
country_rank              | integer? | Current country rank according to pp.
grade_counts.a            | integer  | Number of A ranked scores.
grade_counts.s            | integer  | Number of S ranked scores.
grade_counts.sh           | integer  | Number of Silver S ranked scores.
grade_counts.ss           | integer  | Number of SS ranked scores.
grade_counts.ssh          | integer  | Number of Silver SS ranked scores.
hit_accuracy              | float    | Hit accuracy percentage
is_ranked                 | boolean  | Is actively ranked
level.current             | integer  | Current level.
level.progress            | float    | Progress to next level.
maximum_combo             | integer  | Highest maximum combo.
play_count                | integer  | Number of maps played.
play_time                 | integer  | Cumulative time played.
pp                        | float    | Performance points
pp_exp                    | float    | Experimental (lazer) performance points. Deprecated; it's now always 0.
global_rank               | integer? | Current rank according to pp.
global_rank_exp           | integer? | Current rank according to experimental (lazer) pp. Deprecated; it's now always null.
ranked_score              | integer  | Current ranked score.
replays_watched_by_others | integer  | Number of replays watched by other users.
total_hits                | integer  | Total number of hits.
total_score               | integer  | Total score.

### Optional attributes

Field                     | Type          | Description
------------------------- | ------------- | -----------
rank_change_since_30_days | integer?      | Difference between current rank and rank 30 days ago, according to pp.
user                      | [User](#user) | |

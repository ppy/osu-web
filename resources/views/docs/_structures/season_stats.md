## SeasonStats
```json
{
  "division": {
    "colour_tier": "gold",
    "id": 1,
    "image_url": "https://assets.ppy.sh/season-divisions/gold.png",
    "name": "Gold",
    "threshold": 0.1
  },
  "rank": 12,
  "season": {
    "end_date": null,
    "id": 1,
    "name": "Spotlights Summer 2026 (4K)",
    "room_count": 3,
    "ruleset_id": 3,
    "start_date": "2026-07-27T00:00:00Z",
    "variant": "4k"
  },
  "total_score": 123456
}
```

A user's ranking in a [Season](#season).

Field       | Type                                | Description
----------- | ----------------------------------- | -----------
division    | [SeasonDivision](#seasondivision)   | |
rank        | integer                             | |
season      | [Season](#season)                   | |
total_score | number                              | Weighted season score.

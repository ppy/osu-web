## Season
```json
{
  "end_date": null,
  "id": 1,
  "name": "Spotlights Summer 2026 (4K)",
  "room_count": 3,
  "ruleset_id": 3,
  "start_date": "2026-07-27T00:00:00Z",
  "variant": "4k"
}
```

A playlist season (Spotlights).

Field       | Type                    | Description
----------- | ----------------------- | -----------
end_date    | [Timestamp](#timestamp)? | End date. `null` while the season is ongoing.
id          | integer                 | |
name        | string                  | |
room_count  | integer                 | Number of rooms in the season.
ruleset_id  | integer?                | [Ruleset](#ruleset) id. `null` if unset.
start_date  | [Timestamp](#timestamp)? | |
variant     | string?                 | Mode variant. For osu!mania, `4k` or `7k`. `null` if the season is not variant-specific.

## SeasonDivision
```json
{
  "colour_tier": "gold",
  "id": 1,
  "image_url": "https://assets.ppy.sh/season-divisions/gold.png",
  "name": "Gold",
  "threshold": 0.1
}
```

A ranking division within a [Season](#season).

Field       | Type    | Description
----------- | ------- | -----------
colour_tier | string  | Colour tier token used for display.
id          | integer | |
image_url   | string  | |
name        | string  | |
threshold   | number  | Inclusive upper percentile of the season's participants for this division, in `[0, 1]`.

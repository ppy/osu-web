## TeamExtended

```json
{
  "flag_url": "https://assets.ppy.sh/teams/flag/1/b46fb10dbfd8a35dc50e6c00296c0dc6172dffc3ed3d3a4b379277ba498399f.png",
  "id": 1,
  "name": "example team",
  "short_name": "TEAM",
  "cover_url": "https://assets.ppy.sh/teams/header/1/33e5b115557a4a44377d2c8510a55badd7dd014173595192ad2f82ee053a3302.jpeg",
  "created_at": "2025-12-30T00:48:32+00:00",
  "default_ruleset_id": 0,
  "description": "[b]example description[/b]",
  "is_open": true,
  "empty_slots": 7,
  "leader": {
    "avatar_url": "https://osu.ppy.sh/images/layout/avatar-guest@2x.png",
    "country_code": "AU",
    "default_group": "default",
    "id": 1,
    "is_active": true,
    "is_bot": false,
    "is_deleted": false,
    "is_online": false,
    "is_supporter": false,
    "last_visit": "2025-12-30T20:16:49+00:00",
    "pm_friends_only": false,
    "profile_colour": null,
    "username": "osuuser",
    "country": {
      "code": "AU",
      "name": "Australia"
    },
    "cover": {
      "custom_url": "https://assets.ppy.sh/teams/header/1/33e5b115557a4a44377d2c8510a55badd7dd014173595192ad2f82ee053a3302.jpeg",
      "url": "https://assets.ppy.sh/teams/header/1/33e5b115557a4a44377d2c8510a55badd7dd014173595192ad2f82ee053a3302.jpeg",
      "id": null
    },
    "groups": [],
    "team": {
      "flag_url": "https://assets.ppy.sh/teams/flag/1/b46fb10dbfd8a35dc50e6c00296c0dc6172dffc3ed3d3a4b379277ba498399f.png",
      "id": 1,
      "name": "example team",
      "short_name": "TEAM"
    }
  },
  "members": [
    {
      "avatar_url": "https://osu.ppy.sh/images/layout/avatar-guest@2x.png",
      "country_code": "AU",
      "default_group": "default",
      "id": 2,
      "is_active": true,
      "is_bot": false,
      "is_deleted": false,
      "is_online": false,
      "is_supporter": false,
      "last_visit": "2025-12-30T20:16:49+00:00",
      "pm_friends_only": false,
      "profile_colour": null,
      "username": "osuuser2",
      "country": {
        "code": "AU",
        "name": "Australia"
      },
      "cover": {
        "custom_url": "https://assets.ppy.sh/teams/header/1/33e5b115557a4a44377d2c8510a55badd7dd014173595192ad2f82ee053a3302.jpeg",
        "url": "https://assets.ppy.sh/teams/header/1/33e5b115557a4a44377d2c8510a55badd7dd014173595192ad2f82ee053a3302.jpeg",
        "id": null
      },
      "groups": [],
      "team": {
        "flag_url": "https://assets.ppy.sh/teams/flag/1/b46fb10dbfd8a35dc50e6c00296c0dc6172dffc3ed3d3a4b379277ba498399f.png",
        "id": 1,
        "name": "example team",
        "short_name": "TEAM"
      }
    }
  ],
  "members_count": 1,
  "statistics": {
    "play_count": 123,
    "ranked_score": 63742331,
    "performance": 54634,
    "rank": 1
  }
}
```

Represents a team. Extends [Team](#team) object with additional attributes.

| Field              | Type                              | Description                                                 |
|--------------------|-----------------------------------|-------------------------------------------------------------|
| cover_url          | string?                           | URL to the cover image                                      |
| created_at         | [Timestamp](#timestamp)           |                                                             |
| default_ruleset_id | integer                           |                                                             |
| description        | string?                           |                                                             |
| is_open            | boolean                           | Whether the team is currently accepting member applications |



In addition, the following [optional attributes on Team](#team-optionalattributes) are included:

- empty_slots
- leader
- members
- statistics

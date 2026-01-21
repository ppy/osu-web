## Team
```json
{
  "flag_url": "https://assets.ppy.sh/teams/flag/1/b46fb10dbfd8a35dc50e6c00296c0dc6172dffc3ed3d3a4b379277ba498399f.png",
  "id": 1,
  "name": "example team",
  "short_name": "TEAM"
}
```

Represents a team.

| Field      | Type    | Description                                                |
|------------|---------|------------------------------------------------------------|
| flag_url   | string? | URL to an image containing the team's flag/profile picture |
| id         | integer | unique identifier of the team                              |
| name       | string  | team's display name                                        |
| short_name | string  | team's unique short identifier (max 4 characters)          |

<div id="team-optionalattributes" data-unique="team-optionalattributes"></div>

### Optional attributes

Following are attributes which may be additionally included in the response. Relevant endpoints should list them if applicable.

| Field         | Type                              | Notes                                              |
|---------------|-----------------------------------|----------------------------------------------------|
| empty_slots   | integer                           | amount of available free slots in the team         |
| leader        | [User](#user)                     | the current owner of the team                      |
| members_count | integer                           | amount of users currently in the team              |
| statistics    | [TeamStatistics](#teamstatistics) | the team's gameplay statistics for a given ruleset |

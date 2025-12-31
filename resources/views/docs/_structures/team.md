## Team
```json
{
  "id": 1,
  "name": "example team",
  "short_name": "TEAM",
  "flag_url": "https://assets.ppy.sh/teams/flag/1/b46fb10dbfd8a35dc50e6c00296c0dc6172dffc3ed3d3a4b379277ba498399f.png"
}
```

Represents a team.

| Field      | Type    | Description                                                |
|------------|---------|------------------------------------------------------------|
| id         | integer | unique identifier of the team                              |
| name       | string  | team's display name                                        |
| short_name | string  | team's unique short identifier (max 4 characters)          |
| flag_url   | string? | URL to an image containing the team's flag/profile picture |

### Optional attributes

Following are attributes which may be additionally included in the response. Relevant endpoints should list them if applicable.

| Field         | Type          | Notes                                      |
|---------------|---------------|--------------------------------------------|
| leader        | [User](#user) | the current owner of the team              |
| members_count | integer       | amount of users currently in the team      |
| empty_slots   | integer       | amount of available free slots in the team |

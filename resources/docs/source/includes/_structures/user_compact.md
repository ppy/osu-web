## UserCompact
```json
{
  "id": 2,
  "username": "peppy",
  "profile_colour": "#3366FF",
  "avatar_url": "https://a.ppy.sh/2?1519081077.png",
  "country_code": "AU",
  "is_active": true,
  "is_bot": false,
  "is_online": true,
  "is_supporter": true
}
```
Mainly used for embedding in certain responses to save additional api lookups.

Field          | Type        | Description
-------------- | ------------| ----------------------------------------------------------------------
id             | number      | unique identifier for user
username       | string      | user's display name
profile_colour | string      | colour of username/profile highlight, hex code (e.g. `#333333`)
avatar_url     | string      | url of user's avatar
country_code   | string      | two-letter code representing user's country
is_active      | boolean     | has this account been active in the last x months?
is_bot         | boolean     | is this a bot account?
is_online      | boolean     | is the user currently online? (either on lazer or the new website)
is_supporter   | boolean     | does this user have supporter?

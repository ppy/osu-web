## ChatChannelShow

```json
{
  "channel": {
    "channel_id": 1337,
    "name": "test channel",
    "description": "wheeeee",
    "icon": "/images/layout/avatar-guest@2x.png",
    "type": "PM",
    "first_message_id": 10,
    "last_read_id": 9150005005,
    "last_message_id": 9150005005,
    "moderated": false,
    "users": [
      2,
      102
    ]
  },
  "users": [
    {
      "id": 2,
      "username": "peppy",
      "profile_colour": "#3366FF",
      "avatar_url": "https://a.ppy.sh/2?1519081077.png",
      "country_code": "AU",
      "is_active": true,
      "is_bot": false,
      "is_deleted": false,
      "is_online": true,
      "is_supporter": true
    },
    {
      "id": 102,
      "username": "lambchop",
      "profile_colour": "#3366FF",
      "icon": "/images/layout/avatar-guest@2x.png",
      "country_code": "NZ",
      "is_active": true,
      "is_bot": false,
      "is_deleted": false,
      "is_online": false,
      "is_supporter": false
    }
  ]
}
```


Field   | Type                        | Description
------- | --------------------------- | ----------------------------------------
channel | [ChatChannel](#chatchannel) | |
users   | [UserCompact](#usercompact) | Users are only visible for PM channels.

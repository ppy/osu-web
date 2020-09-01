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

### Optional attributes

Following are attributes which may be additionally included in the response. Relevant endpoints should list them if applicable.

Field                                | Type
-------------------------------------|------------------------------------------------------------------
account_history                      | [UserAccountHistory](#usercompact-useraccounthistory)[]
active_tournament_banner             | [UserCompact.ProfileBanner](#usercompact-profilebanner)
badges                               | [UserBadge](#usercompact-userbadge)[]
blocks                               | |
country                              | |
cover                                | |
current_mode_rank                    | |
favourite_beatmapset_count           | number
follower_count                       | number
friends                              | |
graveyard_beatmapset_count           | number
groups                               | [Group](#group)[]
is_admin                             | |
is_bng                               | |
is_full_bn                           | |
is_gmt                               | |
is_limited_bn                        | |
is_moderator                         | |
is_nat                               | |
is_restricted                        | |
is_silenced                          | |
loved_beatmapset_count               | number
monthly_playcounts                   | [UserMonthlyPlaycount](#usermonthlyplaycount)[]
page                                 | |
previous_usernames                   | |
ranked_and_approved_beatmapset_count | |
replays_watched_counts               | |
scores_first_count                   | |
statistics                           | |
support_level                        | |
unranked_beatmapset_count            | |
unread_pm_count                      | |
user_achievements                    | |
user_preferences                     | |
rank_history                         | |

<div id="usercompact-profilebanner" data-unique="usercompact-profilebanner"></div>

### ProfileBanner

Field         | Type        | Description
--------------|-------------|------------
id            | number      | |
tournament_id | number      | |
image         | string      | |

<div id="usercompact-useraccounthistory" data-unique="usercompact-useraccounthistory"></div>

### UserAccountHistory

Field       | Type      | Description
------------|-----------|------------
id          | number    | |
type        | string    | `note`, `restriction`, or `silence`.
timestamp   | Timestamp | |
length      | number    | In seconds.

<div id="usercompact-userbadge" data-unique="usercompact-userbadge"></div>

### UserBadge

Field       | Type      | Description
------------|-----------|------------
awarded_at  | Timestamp | |
description | string    | |
image_url   | string    | |
url         | string    | |

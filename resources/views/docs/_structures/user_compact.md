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
  "is_deleted": false,
  "is_online": true,
  "is_supporter": true
}
```

Mainly used for embedding in certain responses to save additional api lookups.

Field           | Type                      | Description
--------------- | ------------------------- | ----------------------------------------------------------------------
avatar_url      | string                    | url of user's avatar
country_code    | string                    | two-letter code representing user's country
default_group   | string                    | Identifier of the default [Group](#group) the user belongs to.
id              | number                    | unique identifier for user
is_active       | boolean                   | has this account been active in the last x months?
is_bot          | boolean                   | is this a bot account?
is_deleted      | boolean                   ||
is_online       | boolean                   | is the user currently online? (either on lazer or the new website)
is_supporter    | boolean                   | does this user have supporter?
last_visit      | [Timestamp](#timestamp)?  | last access time. `null` if the user hides online presence
pm_friends_only | boolean                   | whether or not the user allows PM from other than friends
profile_colour  | string?                   | colour of username/profile highlight, hex code (e.g. `#333333`)
username        | string                    | user's display name

<div id="usercompact-optionalattributes" data-unique="usercompact-optionalattributes"></div>

### Optional attributes

Following are attributes which may be additionally included in the response. Relevant endpoints should list them if applicable.

Field                      | Type
---------------------------|-----
account_history            | [UserAccountHistory](#usercompact-useraccounthistory)[]
active_tournament_banner   | [UserCompact.ProfileBanner](#usercompact-profilebanner)?
badges                     | [UserBadge](#usercompact-userbadge)[]
beatmap_playcounts_count   | number
blocks                     | |
country                    | |
cover                      | |
favourite_beatmapset_count | number
follower_count             | number
friends                    | |
graveyard_beatmapset_count | number
groups                     | [UserGroup](#usergroup)[]
is_restricted              | boolean?
loved_beatmapset_count     | number
monthly_playcounts         | [UserMonthlyPlaycount](#usermonthlyplaycount)[]
page                       | |
pending_beatmapset_count   | |
previous_usernames         | |
rank_history               | |
ranked_beatmapset_count    | |
replays_watched_counts     | |
scores_best_count          | number
scores_first_count         | number
scores_recent_count        | number
statistics                 | |
statistics_rulesets        | UserStatisticsRulesets
support_level              | |
unread_pm_count            | |
user_achievements          | |
user_preferences           | |

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
description | string?   | |
id          | number    | |
length      | number    | In seconds.
timestamp   | Timestamp | |
type        | string    | `note`, `restriction`, or `silence`.

<div id="usercompact-userbadge" data-unique="usercompact-userbadge"></div>

### UserBadge

Field       | Type      | Description
------------|-----------|------------
awarded_at  | Timestamp | |
description | string    | |
image_url   | string    | |
url         | string    | |

## User
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

Represents a user.

Field           | Type                      | Description
--------------- | ------------------------- | ----------------------------------------------------------------------
avatar_url      | string                    | url of user's avatar
country_code    | string                    | two-letter code representing user's country
default_group   | string?                   | Identifier of the default [Group](#group) the user belongs to.
id              | integer                   | unique identifier for user
is_active       | boolean                   | has this account been active in the last x months?
is_bot          | boolean                   | is this a bot account?
is_deleted      | boolean                   | |
is_online       | boolean                   | is the user currently online? (either on lazer or the new website)
is_supporter    | boolean                   | does this user have supporter?
last_visit      | [Timestamp](#timestamp)?  | last access time. `null` if the user hides online presence
pm_friends_only | boolean                   | whether or not the user allows PM from other than friends
profile_colour  | string?                   | colour of username/profile highlight, hex code (e.g. `#333333`)
username        | string                    | user's display name

<div id="user-optionalattributes" data-unique="user-optionalattributes"></div>

### Optional attributes

Following are attributes which may be additionally included in the response. Relevant endpoints should list them if applicable.

Field                      | Type | Notes
---------------------------|----- | -----
account_history            | [User.UserAccountHistory](#user-useraccounthistory)[] | |
active_tournament_banner   | [User.ProfileBanner](#user-profilebanner)? | Deprecated, use `active_tournament_banners` instead.
active_tournament_banners  | [User.ProfileBanner](#user-profilebanner)[] | |
badges                     | [User.UserBadge](#user-userbadge)[] | |
beatmap_playcounts_count   | integer | |
blocks                     | | |
country                    | | |
cover                      | | |
favourite_beatmapset_count | integer | |
follow_user_mapping        | integer[] | |
follower_count             | integer | |
friends                    | | |
graveyard_beatmapset_count | integer | |
groups                     | [UserGroup](#usergroup)[] | |
guest_beatmapset_count     | integer | |
is_restricted              | boolean? | |
kudosu                     | [User.Kudosu](#user-kudosu) | |
loved_beatmapset_count     | integer | |
mapping_follower_count     | integer | |
monthly_playcounts         | [UserMonthlyPlaycount](#usermonthlyplaycount)[] | |
nominated_beatmapset_count | integer | |
page                       | | |
pending_beatmapset_count   | | |
previous_usernames         | | |
rank_highest               | [User.RankHighest](#user-rankhighest)? | |
rank_history               | | |
ranked_beatmapset_count    | | |
replays_watched_counts     | | |
scores_best_count          | integer | |
scores_first_count         | integer | |
scores_recent_count        | integer | |
session_verified           | boolean | |
statistics                 | [UserStatistics](#userstatistics) | |
statistics_rulesets        | UserStatisticsRulesets | |
support_level              | | |
unread_pm_count            | | |
user_achievements          | | |
user_preferences           | | |

<div id="user-kudosu" data-unique="user-kudosu"></div>

### Kudosu

Field     | Type
----------|-----
available | integer
total     | integer

<div id="user-profilebanner" data-unique="user-profilebanner"></div>

### ProfileBanner

Field         | Type        | Description
--------------|-------------|------------
id            | integer     | |
tournament_id | integer     | |
image         | string?     | |
image@2x      | string?     | |

<div id="user-profilepage" data-unique="user-profilepage"></div>

### ProfilePage

| Section         |
|-----------------|
| me              |
| recent_activity |
| beatmaps        |
| historical      |
| kudosu          |
| top_ranks       |
| medals          |

<div id="user-rankhighest" data-unique="user-rankhighest"></div>

### RankHighest

Field      | Type
-----------|-----
rank       | integer
updated_at | [Timestamp](#timestamp)

<div id="user-useraccounthistory" data-unique="user-useraccounthistory"></div>

### UserAccountHistory

Field       | Type                    | Description
------------|-------------------------|------------
description | string?                 | |
id          | integer                 | |
length      | integer                 | In seconds.
permanent   | boolean                 | |
timestamp   | [Timestamp](#timestamp) | |
type        | string                  | `note`, `restriction`, or `silence`.

<div id="user-userbadge" data-unique="user-userbadge"></div>

### UserBadge

Field        | Type                    | Description
-------------|-------------------------|------------
awarded_at   | [Timestamp](#timestamp) | |
description  | string                  | |
image@2x_url | string                  | |
image_url    | string                  | |
url          | string                  | |

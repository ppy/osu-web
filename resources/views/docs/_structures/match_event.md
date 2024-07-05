## MatchEvent

Field       | Type                                           | Description
----------- | ---------------------------------------------- | -----------
id          | integer                                        | |
detail.type | [MatchEventType](#match-event-type-navigation) | |
detail.text | string                                         | |
timestamp   | [Timestamp](#timestamp)                        | |
user_id     | integer?                                       | |

### Optional Attributes

Field | Type                    | Description
----- | ----------------------- | -----------
game  | [MatchGame](#matchgame) | The game associated with the [MatchEvent](#matchevent)

<div id="match-event-type-navigation" data-unique="match-event-type-navigation"></div>

### MatchEventType

Name            | Description
--------------- | ------------
host-changed    | |
match-created   | |
match-disbanded | |
other           | |
player-joined   | |
player-kicked   | |
player-left     | |

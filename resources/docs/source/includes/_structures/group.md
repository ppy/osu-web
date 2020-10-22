## Group

Field           | Type   | Description
----------------|--------|------------------------------------------------------------
id              | number | |
identifier      | string | Unique string to identify the group.
is_probationary | string | Whether members of this group are considered probationary.
name            | string | |
short_name      | string | Short name of the group for display.
description     | string | |
colour          | string | |


If [Group](#group) is returned as part of a [User](#user) object, it may also contain:

Field           | Type     | Description
----------------|----------|------------------------------------------------------------
playmodes       | string[] | [GameModes](#gamemode) which the member is responsible for, e.g. in the case of BN/NAT

## UserGroup

Describes the [Group](#group) membership of a [User](#user) - most of the attributes will be the same as the relevant [Group](#group)

Field           | Type      | Description
----------------|-----------|------------------------------------------------------------
id              | number    | ID (of [Group](#group))
identifier      | string    | Unique string to identify the group.
is_probationary | boolean   | Whether members of this group are considered probationary.
name            | string    | |
short_name      | string    | Short name of the group for display.
description     | string    | |
colour          | string    | |
playmodes       | string[]? | [GameModes](#gamemode) which the member is responsible for, e.g. in the case of BN/NAT (only present when `has_playmodes` is set on [Group](#group))

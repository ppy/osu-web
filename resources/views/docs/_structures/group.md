## Group

This object is not returned by any endpoints yet. It is here only as a reference for [UserGroup](#usergroup).

Field           | Type    | Description
----------------|---------|------------------------------------------------------------
colour          | string? | |
has_listing     | boolean | Whether this group displays a listing at `/groups/{id}`.
has_playmodes   | boolean | Whether this group associates [GameModes](#gamemode) with users' memberships.
id              | number  | |
identifier      | string  | Unique string to identify the group.
is_probationary | boolean | Whether members of this group are considered probationary.
name            | string  | |
short_name      | string  | Short name of the group for display.

### Optional Attributes

The following are attributes which may be additionally included in responses. Relevant endpoints should list them if applicable.

Field       | Type
------------|-----
description | [Description](#group-description)?

<div id="group-description" data-unique="group-description"></div>

### Description

Field    | Type
---------|-----
html     | string
markdown | string

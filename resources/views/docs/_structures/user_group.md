## UserGroup

Describes a [Group](#group) membership of a [User](#user). It contains all of the attributes of the [Group](#group), in addition to what is listed here.

Field     | Type      | Description
----------|-----------|------------------------------------------------------------
playmodes | string[]? | [GameModes](#gamemode) associated with this membership (null if `has_playmodes` is unset).

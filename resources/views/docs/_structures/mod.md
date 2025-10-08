## Mod
```json
{
  "acronym": "MU",
  "settings": {
    "inverse_muting": true,
    "mute_combo_count": 1,
    "affects_hit_sounds": false
  }
}
```

Represents a single configured gameplay mod.

Field    | Type                             | Description
---------|----------------------------------|----------------------------------------------------
acronym  | string                           | The acronym of the mod.
settings | [ModSetting](#mod-modsetting)[]? | The list of configured settings on the mod, if any.

<div id="mod-modsetting" data-unique="mod-modsetting"></div>

### ModSetting

Field | Type   | Description
------|--------|--------------------------
name  | string | The name of the setting.
value | object | The value of the setting.

The names and types of values of possible settings depend on which mod they pertain to.
You can find a list of possible mods, and possible settings for each mod, in [`mods.json`](https://github.com/ppy/osu-web/blob/master/database/mods.json).

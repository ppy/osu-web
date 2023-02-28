## Build

```json
{
  "id": 5778,
  "version": "20210520.2",
  "display_version": "20210520.2",
  "users": 22059,
  "created_at": "2021-05-20T14:28:04+00:00",
  "update_stream": {
    "id": 5,
    "name": "stable40",
    "display_name": "Stable",
    "is_featured": true
  }
}
```

Field           | Type
----------------|-----
created_at      | [Timestamp](#timestamp)
display_version | string
id              | number
update_stream   | [UpdateStream](#updatestream)?
users           | number
version         | string?

### Optional Attributes

The following are attributes which may be additionally included in responses. Relevant endpoints should list them if applicable.

Field             | Type                                | Notes
------------------|-------------------------------------|------
changelog_entries | [ChangelogEntry](#changelogentry)[] | If the build has no changelog entries, a placeholder is generated.
versions          | [Versions](#build-versions)         | |

<div id="build-versions" data-unique="build-versions"></div>

### Versions

Field    | Type
---------|-----
next     | [Build](#build)?
previous | [Build](#build)?

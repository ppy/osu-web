## UserRelation
```json
{
  "target_id": 3,
  "relation_type": "friend",
  "mutual": true
}
```

Field         | Type                | Notes
--------------|---------------------|------------
mutual        | boolean             | Always `false` for blocks.
relation_type | `block` \| `friend` | |
target_id     | number              | |

### Optional Attributes

The following are attributes which may be additionally included in responses. Relevant endpoints should list them if applicable.

Field  | Type
-------|-----
target | [UserCompact](#usercompact)

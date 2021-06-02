## CommentSort

Available sort types are `new`, `old`, `top`.

Type  | Sort Fields
----- | ------------------------------------------------------------------------
new   | `created_at` (descending), `id` (descending)
old   | `created_at` (ascending), `id` (ascending)
top   | `votes_count` (descending), `created_at` (descending), `id` (descending)

### Building cursor for comments listing

The returned response will be for comments after the specified sort fields.

For example, use last loaded comment for the fields value to load more comments. Also make sure to use same `sort` and `parent_id` values.

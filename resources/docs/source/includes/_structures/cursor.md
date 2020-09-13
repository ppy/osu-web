## Cursor
```json
{
  "_id": 5,
  "_score": 36.234
}
```

```json
{
  "page": 2,
}
```

A structure included in some API responses containing the parameters to get the next set of results.

The values of the cursor should be provided to next request of the same endpoint to get the next set of results.

If there are no more results available, a cursor with a value of `null` is returned: `"cursor": null`.

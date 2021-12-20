## MultiplayerScores

An object which contains scores and related data for fetching next page of the result.

Field        | Type                      | Description
-------------|---------------------------|--------------------------------------------------------------
`cursor`     | `MultiplayerScoresCursor` | To be used to fetch the next page.
`params`     | `object`                  | To be used to fetch the next page.
`scores`     | `MultiplayerScore[]`      |  |
`total`      | `number?`                 | Index only. Total scores of the specified playlist item.
`user_score` | `MultiplayerScore?`       | Index only. Score of the accessing user if exists.

To fetch the next page, make request to [scores index](#get-scores) with relevant `room` and `playlist`,
with parameters which consists of:

- everything in `params`
- everything in `cursor` as sub field of `cursor`

For example, given a response which `params` contains

Key     | Value
--------| -----------
`sort`  | `score_asc`
`limit` | `10`

and `cursor` of

Key           | Value
--------------|------
`score_id`    | `1`
`total_score` | `10`

then the parameters would be

Field                 | Value
----------------------|------------
`sort`                | `score_asc`
`limit`               | `10`
`cursor[score_id]`    | `1`
`cursor[total_score]` | `10`

and thus the query string is `sort=score_asc&limit=10&cursor[score_id]=1&cursor[total_score]=10`.

## ChangelogEntry

```json
{
  "id": null,
  "repository": null,
  "github_pull_request_id": null,
  "github_url": null,
  "url": "https://osu.ppy.sh/home/news/2021-05-20-spring-fanart-contest-results",
  "type": "fix",
  "category": "Misc",
  "title": "Spring is here!",
  "message_html": "<div class='changelog-md'><p class=\"changelog-md__paragraph\">New seasonal backgrounds ahoy! Amazing work by the artists.</p>\n</div>",
  "major": true,
  "created_at": "2021-05-20T10:56:49+00:00"
}
```

Field                  | Type
-----------------------|-----
category               | string
created_at             | [Timestamp](#timestamp)?
github_pull_request_id | number?
github_url             | string?
id                     | number?
major                  | boolean
repository             | string?
title                  | string?
type                   | string
url                    | string?

### Optional Attributes

The following are attributes which may be additionally included in responses. Relevant endpoints should list them if applicable.

Field        | Type                      | Notes
------------ | ------------------------- | -----
github_user  | [GithubUser](#githubuser) | If the changelog entry has no GitHub user, a placeholder is generated.
message      | string?                   | Entry message in Markdown format. Embedded HTML is allowed.
message_html | string?                   | Entry message in HTML format.

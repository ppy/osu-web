## NewsPost

Field        | Type                    | Description
-------------|-------------------------|------------
author       | string                  | |
edit_url     | string                  | Link to the file view on GitHub.
first_image  | string?                 | Link to the first image in the document.
id           | number                  | |
published_at | [Timestamp](#timestamp) | |
slug         | string                  | Filename without the extension, used in URLs.
title        | string                  | |
updated_at   | [Timestamp](#timestamp) | |

### Optional Attributes

Field      | Type                               | Description
-----------|------------------------------------|------------
content    | string                             | HTML post content.
navigation | [Navigation](#newspost-navigation) | Navigation metadata.
preview    | string                             | First paragraph of `content` with HTML markup stripped.

<div id="newspost-navigation" data-unique="newspost-navigation"></div>

### Navigation

Field | Type                   | Description
------|------------------------|------------
newer | [NewsPost](#newspost)? | Next post.
older | [NewsPost](#newspost)? | Previous post.

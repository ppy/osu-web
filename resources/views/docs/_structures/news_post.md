## NewsPost

Field        | Type                    | Description
-------------|-------------------------|------------
id           | number                  | |
author       | string                  | |
edit_url     | string                  | Link to the file view on GitHub.
first_image  | string?                 | Link to the first image in the document.
published_at | [Timestamp](#timestamp) | |
updated_at   | [Timestamp](#timestamp) | |
slug         | string                  | Unique identifier made by joining the publish date and title.
title        | string                  | |

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

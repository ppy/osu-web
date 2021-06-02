## WikiPage

```json
{
    "layout": "markdown_page",
    "locale": "en",
    "markdown": "# osu! (game mode)\n\n![Gameplay of osu!](/wiki/shared/Interface_osu.jpg \"osu! Interface\")\n\nMarkdownMarkdownTruncated",
    "other_locales": ["ja", "id", "pt-br"],
    "path": "Game_Modes/osu!",
    "subtitle": "Game Modes",
    "tags": ["tap", "circles"],
    "title": "osu! (game mode)"
}
```

Represents a wiki article

Field         | Type     | Description
------------- | -------- | -----------------------------------------------------
layout        | string   | The layout type for the page.
locale        | string   | All lowercase BCP 47 language tag.
markdown      | string   | Markdown content.
other_locales | string[] | Other available locales for the article.
path          | string   | Path of the article.
subtitle      | string?  | The article's subtitle.
tags          | string[] | Associated tags for the article.
title         | string   | The article's title.

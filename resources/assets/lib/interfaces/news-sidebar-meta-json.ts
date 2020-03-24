// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewsPostJson from './news-post-json';

export default interface NewsSidebarMetaJson {
  current_year: number;
  news_posts: NewsPostJson[];
  years: number[];
}

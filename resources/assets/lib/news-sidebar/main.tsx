// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewsPostJson from 'interfaces/news-post-json';
import NewsSidebarMetaJson from 'interfaces/news-sidebar-meta-json';
import * as moment from 'moment';
import * as osu from 'osu-common';
import * as React from 'react';
import MonthListing from './month-listing';
import Years from './years';

interface GroupedPosts {
  [date: string]: NewsPostJson[];
}

interface DateMap {
  [date: string]: moment.Moment;
}

interface Props {
  currentPost?: NewsPostJson;
  data: NewsSidebarMetaJson;
}

export default function Main(props: Props) {
  const groupedPosts: GroupedPosts = {};
  const dateMap: DateMap = {};
  const postDates = new Set<string>();

  for (const post of props.data.news_posts) {
    const publishedAt = moment.utc(post.published_at);
    const key = publishedAt.format('YYYY-MM');

    (groupedPosts[key] = groupedPosts[key] ?? []).push(post);
    dateMap[key] = publishedAt;
    postDates.add(key);
  }

  const orderedPostDates = [...postDates];
  orderedPostDates.sort().reverse();
  let first = true;

  return (
    <div className='sidebar'>
      <button
        className='sidebar__mobile-toggle sidebar__mobile-toggle--mobile-only js-mobile-toggle'
        data-mobile-toggle-target='news-archive'
        type='button'
      >
        <h2 className='sidebar__title'>
          {osu.trans('news.sidebar.archive')}
        </h2>

        <div className='sidebar__mobile-toggle-icon'>
          <i className='fas fa-chevron-down' />
        </div>
      </button>

      <div className='sidebar__content hidden-xs js-mobile-toggle' data-mobile-toggle-id='news-archive'>
        <Years currentYear={props.data.current_year} years={props.data.years} />

        {orderedPostDates.map((key) => {
          if (groupedPosts[key] == null || dateMap[key] == null) {
            return;
          }

          const date = dateMap[key];
          const initialExpand = first;
          first = false;

          return (<MonthListing
            key={key}
            currentPost={props.currentPost}
            date={date}
            initialExpand={initialExpand}
            posts={groupedPosts[key]}
          />);
        })}
      </div>
    </div>
  );
}

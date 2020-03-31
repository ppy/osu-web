// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewsPostJson from 'interfaces/news-post-json';
import NewsSidebarMetaJson from 'interfaces/news-sidebar-meta-json';
import { groupBy, rangeRight } from 'lodash';
import * as moment from 'moment';
import * as React from 'react';
import MonthListing from './month-listing';
import Years from './years';

interface Props {
  currentPost?: NewsPostJson;
  data: NewsSidebarMetaJson;
}

export default function Main(props: Props) {
  const byMonth = groupBy(props.data.news_posts, (post) => moment.utc(post.published_at).month());

  let first = true;

  return (
    <div className='sidebar'>
      <button
        type='button'
        className='sidebar__mobile-toggle sidebar__mobile-toggle--mobile-only js-mobile-toggle'
        data-mobile-toggle-target='news-archive'
      >
        <h2 className='sidebar__title'>
          {osu.trans('news.sidebar.archive')}
        </h2>

        <div className='sidebar__mobile-toggle-icon'>
          <i className='fas fa-chevron-down' />
        </div>
      </button>

      <div className='sidebar__content hidden-xs js-mobile-toggle' data-mobile-toggle-id='news-archive'>
        <Years years={props.data.years} currentYear={props.data.current_year} />

        {rangeRight(0, 12).map((month) => {
          if (byMonth[month] == null) {
            return;
          }

          const initialExpand = first;
          first = false;

          return <MonthListing
            year={props.data.current_year}
            initialExpand={initialExpand}
            key={month}
            month={month}
            posts={byMonth[month]}
            currentPost={props.currentPost}
          />;
        })}
      </div>
    </div>
  );
}

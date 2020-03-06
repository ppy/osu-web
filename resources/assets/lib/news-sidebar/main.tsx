/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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

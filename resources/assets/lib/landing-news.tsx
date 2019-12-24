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
import PostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import PostItem from 'news-index/post-item';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';

export function LandingNews({posts}: {posts: PostJson[]}) {
  return (
    <div className='landing-news'>
      {posts.length > 0 &&
        <>
          <div className='landing-news__posts'>
            {<PostItem post={posts[0]} modifiers={['landing', 'hover']} />}
          </div>
          <div className='landing-news__posts'>
            {_.slice(posts, 1).map((post: PostJson, i: number) => <PostItem post={post} modifiers={['landing', 'hover']} key={i}/>)}
          </div>
          <div className='landing-news__link'>
            <ShowMoreLink
              hasMore={true}
              loading={false}
              hideIcon={true}
              label={osu.trans('home.landing.see_more_news')}
              url={route('news.index')}
            />
          </div>
        </>
      }
    </div>
  );
}

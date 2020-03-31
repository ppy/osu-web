// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
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
              modifiers={['no-icon']}
              label={osu.trans('home.landing.see_more_news')}
              url={route('news.index')}
            />
          </div>
        </>
      }
    </div>
  );
}

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */
import PostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import PostItem from 'news-index/post-item';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';

export function LandingNews({posts}: {posts: PostJson[]}) {
  return (
    <div className='landing-news'>
      <div className='landing-news__posts'>
        {posts.map((post: PostJson, i: number) => <PostItem post={post} modifiers={['landing', 'hover']} key={i}/>)}
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
    </div>
  );
}

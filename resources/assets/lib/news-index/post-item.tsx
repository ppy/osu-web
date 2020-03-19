// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import PostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as moment from 'moment';
import * as React from 'react';

export default function PostItem({modifiers, post}: {modifiers?: string[], post: PostJson}) {
  let cover;

  if (post.first_image != null) {
    cover = <img className='news-card__cover' src={post.first_image} />;
  }

  let preview = post.preview;

  if (preview == null) {
    preview = '';
  }

  return (
    <a
      href={route('news.show', {news: post.slug})}
      className={osu.classWithModifiers('news-card', modifiers || ['index', 'hover'])}
    >
      {cover}
      <div className='news-card__overlay' />
      <div className='news-card__content'>
        <div
          className='news-card__time js-tooltip-time'
          title={post.published_at}
        >
          {moment(post.published_at).format('ll')}
        </div>

        <div className='news-card__main'>
          <div className='news-card__title'>{post.title}</div>
          <div className='news-card__preview' dangerouslySetInnerHTML={{__html: preview}} />
        </div>
      </div>
    </a>
  );
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import PostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as moment from 'moment';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';

export default function PostItem({modifiers, post}: {modifiers?: string[]; post: PostJson}) {
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
      className={osu.classWithModifiers('news-card', modifiers ?? ['index', 'hover'])}
      href={route('news.show', { news: post.slug })}
    >
      <div className='news-card__cover-container'>
        {cover}
        <div
          className='news-card__time js-tooltip-time'
          title={post.published_at}
        >
          {moment.utc(post.published_at).format('ll')}
        </div>
      </div>

      <div className='news-card__main'>
        <div className='news-card__row news-card__row--title'>{post.title}</div>
        <div
          dangerouslySetInnerHTML={{ __html: preview }}
          className='news-card__row news-card__row--preview'
        />
        <div className='news-card__row news-card__row--author'>
          <StringWithComponent
            mappings={{ ':user': <strong key='author'>{post.author}</strong> }}
            pattern={osu.trans('news.show.by')}
          />
        </div>
      </div>
    </a>
  );
}

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
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  modifiers?: string[];
  post: PostJson;
}

export default class PostItem extends React.Component<Props, {}> {
  render() {
    let cover;

    if (this.props.post.first_image != null) {
      cover = <img className='news-card__cover' src={this.props.post.first_image} />;
    }

    let preview = this.props.post.preview;

    if (preview == null) {
      preview = '';
    }

    return (
      <a
        href={route('news.show', {news: this.props.post.slug})}
        className={osu.classWithModifiers('news-card', this.props.modifiers || ['index'])}
      >
        {cover}
        <div className='news-card__overlay' />
        <div className='news-card__content'>
          <div
            className='news-card__time js-tooltip-time'
            title={this.props.post.published_at}
          >
            {moment(this.props.post.published_at).format('ll')}
          </div>

          <div className='news-card__main'>
            <div className='news-card__title'>{this.props.post.title}</div>
            <div className='news-card__preview' dangerouslySetInnerHTML={{__html: preview}} />
          </div>
        </div>
      </a>
    );
  }
}

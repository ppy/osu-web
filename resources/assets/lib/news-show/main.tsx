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

import AdminMenu from 'admin-menu';
import { Comments } from 'comments';
import { CommentsManager } from 'comments-manager';
import NewsPostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as moment from 'moment';
import NewsHeader from 'news-header';
import * as React from 'react';

interface Props {
  commentBundle: any;
  container: HTMLElement;
  post: NewsPostJson;
}

export default class Main extends React.Component<Props> {
  private contentContainer = React.createRef<HTMLDivElement>();

  componentDidMount() {
    const container = this.contentContainer.current;

    if (!container) {
      return;
    }

    const audioTags = container.getElementsByTagName('audio');

    _.each(audioTags, (audio) => {
      audio.volume = 0.45;
    });
  }

  render() {
    const {content, author} = this.processContent();

    return (
      <>
        <NewsHeader
          section='show'
          post={this.props.post}
          title={osu.trans('news.show.title.info')}
        />
        <div className='osu-page osu-page--news'>
          <div className='news-show'>
            {this.renderHeader({author})}

            <div
              ref={this.contentContainer}
              dangerouslySetInnerHTML={{
                __html: content,
              }}
            />

            <div className='news-show__nav'>
              {this.renderNav()}
            </div>
          </div>
        </div>
        <div className='osu-page osu-page---compact'>
          <CommentsManager
            commentableType='news_post'
            commentableId={this.props.post.id}
            component={Comments}
            componentProps={{
              modifiers: ['changelog'],
            }}
          />
        </div>

        <AdminMenu
          items={[
            {
              component: 'a',
              icon: 'fab fa-github',
              props: {
                href: this.props.post.edit_url,
              },
              text: osu.trans('wiki.show.edit.link'),
            },
            {
              component: 'button',
              icon: 'fas fa-sync',
              props: {
                'data-method': 'put',
                'data-reload-on-success': 1,
                'data-remote': true,
                'data-url': route('news.update', {news: this.props.post.id}),
                'type': 'button',
              },
              text: osu.trans('news.update.button'),
            },
          ]}
        />
      </>
    );
  }

  private processContent = () => {
    let content = this.props.post.content;

    if (content == null) {
      content = '';
    }

    const contentHTML = document.createElement('div');
    contentHTML.innerHTML = content;

    const firstImage = contentHTML.querySelector('img');
    if (firstImage != null && firstImage.parentElement != null) {
      firstImage.parentElement.remove();
    }

    let author;
    const authorEl = _.last(contentHTML.querySelectorAll('p'));
    if (authorEl != null && authorEl.textContent != null && authorEl.textContent.match(/^[—–][^—–]/) != null) {
      author = authorEl.textContent.slice(1);
    }

    content = contentHTML.innerHTML;

    return {content, author};
  }

  private renderHeader = ({author}: {author?: string}) => {
    let authorDiv;

    if (author != null) {
      authorDiv = <div className='news-card__author'>{osu.trans('news.show.by', {user: author})}</div>;
    }

    let cover;

    if (this.props.post.first_image != null) {
      cover = <img className='news-card__cover' src={this.props.post.first_image} />;
    }

    return (
      <div className='news-card news-card--show'>
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
            {authorDiv}
          </div>
        </div>
      </div>
    );
  }

  private renderNav = () => {
    if (this.props.post.navigation == null) {
      return;
    }

    let newerLink;
    let olderLink;

    const newerPost = this.props.post.navigation.newer;
    const olderPost = this.props.post.navigation.older;

    if (newerPost != null) {
      newerLink = (
        <a
          className='page-nav__link'
          href={route('news.show', {news: newerPost.slug})}
          title={newerPost.title}
        >
          <span className='page-nav__label'>
            {osu.trans('news.show.nav.newer')}
          </span>
          <span className='fas fa-chevron-right' />
        </a>
      );
    }

    if (olderPost != null) {
      olderLink = (
        <a
          className='page-nav__link'
          href={route('news.show', {news: olderPost.slug})}
          title={olderPost.title}
        >
          <span className='fas fa-chevron-left' />
          <span className='page-nav__label'>
            {osu.trans('news.show.nav.older')}
          </span>
        </a>
      );
    }

    return (
      <div className='page-nav'>
        <div className='page-nav__item page-nav__item--left'>
          {olderLink}
        </div>
        <div className='page-nav__item page-nav__item--right'>
          {newerLink}
        </div>
      </div>
    );
  }
}

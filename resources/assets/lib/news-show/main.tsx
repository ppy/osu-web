// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AdminMenu from 'admin-menu';
import { Comments } from 'comments';
import { CommentsManager } from 'comments-manager';
import NewsPostJson from 'interfaces/news-post-json';
import NewsSidebarMetaJson from 'interfaces/news-sidebar-meta-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import NewsHeader from 'news-header';
import PostItem from 'news-index/post-item';
import NewsSidebar from 'news-sidebar/main';
import osu from 'osu-common';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import { classWithModifiers } from 'utils/css';

interface Props {
  container: HTMLElement;
  post: NewsPostJson;
  sidebarMeta: NewsSidebarMetaJson;
}

function NavPost({ post, subtitle, modifiers }: { modifiers: string[]; post?: NewsPostJson; subtitle: string }) {
  if (post == null) {
    return null;
  }

  return (
    <a
      className={classWithModifiers('page-nav-fancy', modifiers)}
      href={route('news.show', { news: post.slug })}
      style={{ backgroundImage: osu.urlPresence(post.first_image) }}
    >
      <div className='page-nav-fancy__label'>
        <div className='page-nav-fancy__subtitle'>
          {subtitle}
        </div>
        <div className='page-nav-fancy__title'>
          {post.title}
        </div>
      </div>
      <div className='page-nav-fancy__icon'>
        <i className='fas fa-chevron-right' />
      </div>
    </a>
  );
}

export default class Main extends React.Component<Props> {
  render() {
    const { content } = this.processContent();

    return (
      <>
        <NewsHeader
          post={this.props.post}
          section='show'
          title={osu.trans('news.show.title.info')}
        />

        <div className='osu-page osu-page--wiki'>
          <div className='wiki-page'>
            <div className='wiki-page__toc'>
              <NewsSidebar currentPost={this.props.post} data={this.props.sidebarMeta} />
            </div>

            <div className='wiki-page__content'>
              <div className='news-show'>
                <PostItem modifiers={['show']} post={this.props.post} />

                <div className='news-show__info'>
                  <h1 className='news-show__title'>{this.props.post.title}</h1>
                  <p className='news-show__author'>
                    <StringWithComponent
                      mappings={{ ':user': <strong key='author'>{this.props.post.author}</strong> }}
                      pattern={osu.trans('news.show.by')}
                    />
                  </p>
                </div>

                <div className='js-audio--group' dangerouslySetInnerHTML={{ __html: content }} />

                <div className='news-show__nav'>
                  {this.renderNav()}
                </div>
              </div>
            </div>
          </div>

          <CommentsManager
            commentableId={this.props.post.id}
            commentableType='news_post'
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
                'data-url': route('news.update', { news: this.props.post.id }),
                type: 'button',
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

    const firstImageUrl = this.props.post.first_image;

    if (firstImageUrl != null) {
      const firstImage = contentHTML.querySelector(`img[src="${CSS.escape(firstImageUrl)}"]`);

      if (firstImage != null) {
        const firstImageParent = firstImage.parentElement;

        if (firstImageParent?.children.length === 1) {
          firstImageParent.remove();
        } else {
          firstImage.remove();
        }
      }
    }

    content = contentHTML.innerHTML;

    return { content };
  };

  private renderNav = () => {
    if (this.props.post.navigation == null) {
      return;
    }

    const newerPost = this.props.post.navigation.newer;
    const olderPost = this.props.post.navigation.older;

    return (
      <>
        <NavPost modifiers={['next']} post={newerPost} subtitle={osu.trans('news.show.nav.newer')} />
        <NavPost modifiers={['prev']} post={olderPost} subtitle={osu.trans('news.show.nav.older')} />
      </>
    );
  };
}

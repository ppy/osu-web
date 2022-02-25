// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AdminMenu from 'components/admin-menu';
import NewsHeader from 'components/news-header';
import ShowMoreLink from 'components/show-more-link';
import PostJson from 'interfaces/news-post-json';
import NewsSidebarMetaJson from 'interfaces/news-sidebar-meta-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import NewsSidebar from 'news-sidebar/main';
import * as React from 'react';
import { jsonClone } from 'utils/json';
import PostItem from './post-item';

interface NewsSearch {
  limit: number;
  year: number;
}

interface NewsIndexJson {
  cursor: unknown;
  news_posts: PostJson[];
  news_sidebar: NewsSidebarMetaJson;
  search: NewsSearch;
}

interface Props {
  container: HTMLElement;
  data: NewsIndexJson;
}

@observer
export default class Main extends React.Component<Props> {
  @observable private data = jsonClone(this.props.data);
  @observable private loadingXhr?: JQuery.jqXHR | null = null;

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.loadingXhr?.abort();
  }

  render() {
    return (
      <>
        <NewsHeader
          section='index'
          title={osu.trans('news.index.title.info')}
        />
        <div className='osu-page osu-page--wiki'>
          <div className='wiki-page'>
            <div className='wiki-page__toc'>
              <NewsSidebar data={this.data.news_sidebar} />
            </div>

            <div className='wiki-page__content'>
              <div className='news-index'>
                {this.data.news_posts.map((post) => (
                  <PostItem key={post.id} post={post} />
                ))}

                <div className='news-index__item news-index__item--more'>
                  <ShowMoreLink
                    callback={this.handleShowMore}
                    hasMore={this.data.cursor != null}
                    loading={this.loadingXhr != null}
                    modifiers='t-dark-purple-dark'
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <AdminMenu
          items={[
            {
              component: 'button',
              icon: 'fas fa-sync',
              props: {
                'data-method': 'post',
                'data-reload-on-success': '1',
                'data-remote': true,
                'data-url': route('news.store'),
                type: 'button',
              },
              text: osu.trans('news.store.button'),
            },
          ]}
        />
      </>
    );
  }

  @action
  private handleShowMore = () => {
    if (this.data.cursor == null || this.loadingXhr != null) {
      return;
    }

    this.loadingXhr = $.get(route('news.index'), { ...this.data.search, cursor: this.data.cursor })
      .done(action((newData: NewsIndexJson) => {
        newData.news_posts = this.data.news_posts.concat(newData.news_posts);
        this.data = newData;
        this.props.container.dataset.props = JSON.stringify({ data: this.data });
      })).always(action(() => {
        this.loadingXhr = null;
      }));
  };
}

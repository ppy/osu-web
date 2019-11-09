/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import AdminMenu from 'admin-menu';
import PostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import NewsHeader from 'news-header';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';
import PostItem from './post-item';

interface Props {
  container: HTMLElement;
  data: PostsJson;
}

interface PostsJson {
  news_posts: PostJson[];
  search: Search;
}

interface Search {
  cursor: SearchCursor;
  limit: number;
}

interface SearchCursor {
  id?: number;
  published_at?: string;
}

interface State {
  hasMore: boolean;
  loading: boolean;
  posts: PostJson[];
}

export default class Main extends React.Component<Props, State> {
  private eventId = `news-index-${osu.uuid()}`;

  constructor(props: Props) {
    super(props);

    this.restoreState();

    if (this.state == null) {
      this.state = this.newStateFromData(props.data);
    }
  }

  componentDidMount = () => {
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.saveState);
  }

  componentWillUnmount = () => {
    $(document).off(`.${this.eventId}`);
  }

  render() {
    const titleTrans = {
      info: osu.trans('news.index.title.info'),
      key: 'news.index.title._',
    };

    return (
      <>
        <NewsHeader
          section='index'
          titleTrans={titleTrans}
        />
        <div className='osu-page osu-page--news'>
          <div className='news-index'>
            {this.state.posts.map((post, i) => {
              let containerClass = 'news-index__item';
              if (i === 0) {
                containerClass += ' news-index__item--first';
              }

              return <div key={post.id} className={containerClass}><PostItem post={post} /></div>;
            })}

            <div className='news-index__item news-index__item--more'>
              <ShowMoreLink
                callback={this.showMore}
                hasMore={this.state.hasMore}
                loading={this.state.loading}
                modifiers={['t-dark-purple-dark']}
              />
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
                'type': 'button',
              },
              text: osu.trans('news.store.button'),
            },
          ]}
        />
      </>
    );
  }

  private newStateFromData = (data: PostsJson) => {
    const hasMore = data.news_posts.length === data.search.limit;
    let posts: PostJson[];
    let loading: boolean;

    if (this.state == null) {
      posts = [];
      loading = false;
    } else {
      posts = this.state.posts;
      loading = this.state.loading;
    }

    posts = posts.concat(data.news_posts);

    if (hasMore) {
      posts.pop();
    }

    return {posts, hasMore, loading};
  }

  private restoreState = () => {
    const savedState = this.props.container.dataset.lastState;
    if (savedState != null) {
      this.state = JSON.parse(savedState) as State;
      delete this.props.container.dataset.lastState;
    }
  }

  private saveState = () => {
    this.props.container.dataset.lastState = JSON.stringify(this.state);
  }

  private showMore = () => {
    if (!this.state.hasMore) {
      return;
    }

    if (this.state.posts.length === 0) {
      return;
    }

    const search: Search = {
      cursor: {},
      limit: 21,
    };

    const lastPost = _.last(this.state.posts);
    if (lastPost != null) {
      search.cursor.id = lastPost.id;
      search.cursor.published_at = lastPost.published_at;
    }

    this.setState({loading: true});

    $.get(route('news.index'), search)
    .done((data) => {
      this.setState(this.newStateFromData(data as PostsJson));
    }).always(() => {
      this.setState({loading: false});
    });
  }
}

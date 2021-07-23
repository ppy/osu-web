// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import NewsPostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as moment from 'moment';
import osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';

interface Props {
  currentPost?: NewsPostJson;
  date: moment.Moment;
  initialExpand: boolean;
  posts: NewsPostJson[];
}

interface State {
  expanded: boolean;
}

export default class MonthListing extends React.Component<Props, State> {
  get stateRecordKey(): string {
    return this.props.date.format('YYYYMM');
  }

  get stateRecordValue(): boolean | null {
    if (this.stateRecord instanceof HTMLElement) {
      if (this.stateRecord.dataset[this.stateRecordKey] != null) {
        return this.stateRecord.dataset[this.stateRecordKey] === '1';
      }
    }

    return null;
  }
  state = { expanded: false };
  stateRecord: HTMLElement | null = null;

  constructor(props: Props) {
    super(props);

    if (core.windowSize.isMobile) {
      this.state.expanded = false;
    } else {
      if (props.currentPost == null) {
        this.state.expanded = props.initialExpand;
      } else {
        const currentPostDate = moment.utc(props.currentPost.published_at);
        this.state.expanded = currentPostDate.year() === props.date.year() && currentPostDate.month() === props.date.month();
      }
    }

    const stateRecord = document.querySelector('.js-news-sidebar-record');

    if (stateRecord instanceof HTMLElement) {
      this.stateRecord = stateRecord;
    }

    if (this.stateRecordValue == null) {
      this.recordState();
    } else {
      this.state.expanded = this.stateRecordValue;
    }

  }

  render() {
    return (
      <div className='news-sidebar-month'>
        <button className='news-sidebar-month__toggle' onClick={this.toggleExpand} type='button'>
          {this.props.date.format(osu.trans('common.datetime.year_month_short.moment'))}

          <span className='news-sidebar-month__toggle-icon'>
            <i
              className={this.state.expanded ? 'fas fa-chevron-up' : 'fas fa-chevron-down'}
            />
          </span>
        </button>

        <ul className={`news-sidebar-month__items ${this.state.expanded ? '' : 'hidden'}`}>
          {this.props.posts.map(this.renderPost)}
        </ul>
      </div>
    );
  }

  private recordState = () => {
    if (this.stateRecord != null) {
      this.stateRecord.dataset[this.stateRecordKey] = this.state.expanded ? '1' : '';
    }
  };

  private renderPost = (post: NewsPostJson) => {
    let linkClass = 'news-sidebar-month__item';

    if (this.props.currentPost != null && this.props.currentPost.id === post.id) {
      linkClass += ' news-sidebar-month__item--active';
    }

    return (
      <li key={post.id}>
        <a
          className={linkClass}
          href={route('news.show', { news: post.slug })}
        >
          {post.title}
        </a>
      </li>
    );
  };

  private toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded }, this.recordState);
  };
}

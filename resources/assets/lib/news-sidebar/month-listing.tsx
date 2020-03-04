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

import NewsPostJson from 'interfaces/news-post-json';
import { route } from 'laroute';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  currentPost?: NewsPostJson;
  initialExpand: boolean;
  month: number;
  posts: NewsPostJson[];
  year: number;
}

interface State {
  expanded: boolean;
}

export default class MonthListing extends React.Component<Props, State> {

  get stateRecordKey(): string {
    return `month-${this.props.month}`;
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

    if (props.currentPost == null) {
      this.state.expanded = props.initialExpand;
    } else {
      const currentPostDate = moment.utc(props.currentPost.published_at);
      this.state.expanded = currentPostDate.year() === props.year && currentPostDate.month() === props.month;
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
        <button className='news-sidebar-month__toggle' type='button' onClick={this.toggleExpand}>
          {moment.utc([this.props.year, this.props.month]).format(osu.trans('common.datetime.year_month_short.moment'))}

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
  }

  private renderPost = (post: NewsPostJson) => {
    let linkClass = 'news-sidebar-month__item';

    if (this.props.currentPost != null && this.props.currentPost.id === post.id) {
      linkClass += ' news-sidebar-month__item--active';
    }

    return (
      <li key={post.id}>
        <a
          href={route('news.show', { news: post.slug })}
          className={linkClass}
        >
          {post.title}
        </a>
      </li>
    );
  }

  private toggleExpand = () => {
    this.setState({ expanded: !this.state.expanded }, this.recordState);
  }
}

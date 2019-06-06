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

import * as _ from 'lodash';
import { observer } from 'mobx-react';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';
import TypeGroup from './type-group';
import Worker from './worker';

interface Props {
  type?: string;
  worker: Worker;
}

@observer
export default class Main extends React.Component<Props> {
  private menuId: string;

  constructor(props: Props) {
    super(props);

    this.menuId = `nav-notification-popup-${osu.uuid()}`;
  }

  render() {
    if (!this.props.worker.isActive()) {
      return null;
    }

    return (
      <>
        <button
          className={this.buttonClass()}
          data-click-menu-target={this.menuId}
        >
          <span className={this.mainClass()}>
            <i className='fas fa-inbox' />
            <span className='notification-icon__count'>
              {this.unreadCount()}
            </span>
          </span>
        </button>
        <div className='nav-click-popup'>
          <div
            className='notification-popup js-click-menu js-nav2--centered-popup u-fancy-scrollbar'
            data-click-menu-id={this.menuId}
            data-visibility='hidden'
          >
            <div className='notification-popup__scroll-container'>
              {this.renderTypeGroup()}

              {this.renderShowMoreButton()}
            </div>
          </div>
        </div>
      </>
    );
  }

  private buttonClass() {
    let ret = 'js-click-menu nav-button';

    if (this.props.type === 'mobile') {
      ret += ' nav-button--mobile';
    } else {
      ret += ' nav-button--stadium';
    }

    return ret;
  }

  private mainClass() {
    let ret = 'notification-icon';

    if (this.props.worker.unreadCount > 0) {
      ret += ' notification-icon--glow';
    }

    if (this.props.type === 'mobile') {
      ret += ' notification-icon--mobile';
    }

    return ret;
  }

  private renderShowMoreButton() {
    if (!this.props.worker.hasMore) {
      return;
    }

    return (
      <div className='notification-popup__show-more'>
        <ShowMoreLink
          callback={this.props.worker.loadMore}
          hasMore={this.props.worker.hasMore}
          loading={this.props.worker.loadingMore}
          modifiers={['t-greysky']}
        />
      </div>
    );
  }

  private renderTypeGroup() {
    const items: React.ReactNode[] = [];

    this.props.worker.itemsGroupedByType.forEach((value, key) => {
      if (value.length === 0) {
        return;
      }

      items.push(
        (
          <div key={key} className='notification-popup__item'>
            <TypeGroup
              item={value[0]}
              items={value}
              worker={this.props.worker}
            />
          </div>
        ),
      );
    });

    if (items.length === 0) {
      items.push(this.props.worker.hasMore ? (
        <div key='empty-with-more' className='notification-popup__empty-with-more' />
      ) : (
        <p key='empty' className='notification-popup__empty'>
          {osu.trans('notifications.all_read')}
        </p>
      ));
    }

    return items;
  }

  private unreadCount() {
    if (this.props.worker.hasData) {
      return osu.formatNumber(this.props.worker.unreadCount);
    } else {
      return '...';
    }
  }
}

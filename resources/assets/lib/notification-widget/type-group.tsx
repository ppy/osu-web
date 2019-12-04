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

import { route } from 'laroute';
import * as _ from 'lodash';
import { action } from 'mobx';
import { observer } from 'mobx-react';
import NotificationStack from 'models/notification-stack';
import NotificationType from 'models/notification-type';
import { NotificationContext } from 'notifications-context';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';
import { Spinner } from 'spinner';
import ItemGroup from './item-group';
import ItemSingular from './item-singular';
import { WithMarkReadProps } from './with-mark-read';

interface Props {
  canShowMore: boolean;
  type: NotificationType;
}

const bn = 'notification-type-group';

@observer
export default class TypeGroup extends React.Component<Props & WithMarkReadProps> {
  static readonly contextType = NotificationContext;
  static readonly defaultProps = {
    canShowMore: true,
  };

  render() {
    const type = this.props.type;
    if (!type.hasVisibleNotifications) {
      return null;
    }

    return (
      <>
        <div className='notification-popup__item'>
          <div className={bn}>
            <div className={`${bn}__header`}>
              <div className={`${bn}__type`}>
                {osu.trans(`notifications.item.${this.props.type.name}._`)}

                {this.renderNotificationCount()}
              </div>

              {this.renderMarkAllReadButton()}
            </div>
            <div className={`${bn}__items`}>
              {this.renderStacks()}
            </div>
          </div>
        </div>
        {this.renderShowMore()}
      </>
    );
  }

  private handleMarkAllAsRead = () => {
    this.props.type.markTypeAsRead();
  }

  @action
  private handleShowMore = () => {
    this.props.type.loadMore(this.context);
  }

  private renderMarkAllReadButton() {
    if (this.props.type.name === 'legacy_pm') return null;

    let markAllReadClass = `${bn}__clear-all`;
    let markingAsReadSpinner: React.ReactNode = null;

    if (this.props.type.isMarkingAsRead) {
      markingAsReadSpinner = (
        <span className={`${bn}__clear-all-spinner`}>
          <Spinner />
        </span>
      );
      markAllReadClass += ` ${bn}__clear-all--disabled`;
    }

    return (
      <button
        className={markAllReadClass}
        type='button'
        onClick={this.handleMarkAllAsRead}
      >
        {markingAsReadSpinner}
        {osu.trans('notifications.mark_all_read')}
      </button>
    );
  }

  private renderNotificationCount() {
    if (this.props.type.name === 'legacy_pm') return null;

    return (
      <span className={`${bn}__count`}>
        {osu.formatNumber(this.props.type.total)}
      </span>
    );
  }

  private renderShowMore() {
    const type = this.props.type;
    if (type.cursor == null) return null;

    if (!this.props.canShowMore) {
      return (
        <a className={`${bn}__show-more-link`} href={route('notifications.index', { type: this.props.type.name })}>
          See more notifications
        </a>
      );
    }

    return (
      <div className='notification-popup__show-more'>
        <ShowMoreLink
          callback={this.handleShowMore}
          hasMore={type.cursor != null}
          loading={type.isLoading}
          modifiers={['t-greysky']}
        />
      </div>
    );
  }

  private renderStack = (stack: NotificationStack) => {
    const isSingle = stack.isSingle;
    const params = {
      markingAsRead: this.props.type.isMarkingAsRead,
    };

    let component;
    if (isSingle) {
      component = <ItemSingular stack={stack} {...params} />;
    } else {
      component = <ItemGroup stack={stack} {...params} />;
    }

    return (
      <div className={`${bn}__item`} key={stack.id}>
        {component}
      </div>
    );
  }

  private renderStacks() {
    const type = this.props.type;
    const nodes: React.ReactNode[] = [];

    const stacks = type.stacks;
    stacks.forEach((stack: NotificationStack) => {
      if (!stack.hasVisibleNotifiations) return;

      nodes.push(this.renderStack(stack));
    });

    return nodes;
  }
}

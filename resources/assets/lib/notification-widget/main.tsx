// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import { Name, typeNames } from 'models/notification-type';
import { NotificationContext } from 'notifications-context';
import LegacyPm from 'notifications/legacy-pm';
import NotificationController from 'notifications/notification-controller';
import NotificationReadButton from 'notifications/notification-read-button';
import osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import Stack from './stack';

interface Link {
  title: string;
  type: Name;
}

interface Props {
  excludes: Name[];
  extraClasses?: string;
  only?: Name;
}

interface State {
  hasError: boolean;
}

@observer
export default class Main extends React.Component<Props, State> {
  static readonly defaultProps = {
    excludes: [],
  };

  readonly state = {
    hasError: false,
  };

  private readonly controller = new NotificationController(
    core.dataStore.notificationStore,
    { excludes: this.props.excludes, isWidget: true },
    this.props.only ?? null,
  );
  private readonly typeNames = typeNames.filter((name) => !this.props.excludes.includes(name));

  @computed
  get links() {
    return this.typeNames.map((type) => ({ title: osu.trans(`notifications.filters.${type ?? '_'}`), type }));
  }

  static getDerivedStateFromError(error: Error) {
    // eslint-disable-next-line no-console
    console.error(error);
    return { hasError: true };
  }

  render() {
    const blockClass = `notification-popup u-fancy-scrollbar ${this.props.extraClasses ?? ''}`;

    return (
      <NotificationContext.Provider value={{ excludes: this.props.excludes, isWidget: true }}>
        <div className={blockClass}>
          <div className='notification-popup__scroll-container'>
            {this.renderFilters()}
            <div className='notification-popup__buttons'>
              {this.renderHistoryLink()}
              <div className='notification-popup__clear-button'>
                {this.renderMarkAsReadButton()}
              </div>
            </div>
            {this.renderLegacyPm()}
            <div className='notification-stacks'>
              {this.renderStacks()}
              {this.renderShowMore()}
            </div>
          </div>
        </div>
      </NotificationContext.Provider>
    );
  }

  private handleFilterClick = (event: React.MouseEvent<HTMLButtonElement>) => {
    const type = ((event.currentTarget as HTMLButtonElement).dataset.type ?? null) as Name;
    this.controller.navigateTo(type);
  };

  private handleMarkAsRead = () => {
    this.controller.markCurrentTypeAsRead();
  };

  private handleShowMore = () => {
    this.controller.loadMore();
  };

  private renderFilter = (link: Link) => {
    const type = this.controller.getType(link.type);
    const isSameFilter = link.type === this.controller.currentFilter;

    if (type.name !== null && type.isEmpty && !isSameFilter) return null;

    const data = { 'data-type': link.type };
    const modifiers = isSameFilter ? ['active'] : [];

    return (
      <button
        key={link.title}
        className={osu.classWithModifiers('notification-popup__filter', modifiers)}
        onClick={this.handleFilterClick}
        {...data}
      >
        <span className='notification-popup__filter-count'>{this.controller.getTotal(type)}</span>
        <span>{link.title}</span>
      </button>
    );
  };

  private renderFilters() {
    if (this.props.only != null || !core.notificationsWorker.hasData) return null;

    return (
      <div className='notification-popup__filters'>
        {this.links.map(this.renderFilter)}
      </div>
    );
  }

  private renderHistoryLink() {
    const linkName = this.props.only === 'channel' ? 'chat.index' : 'notifications.index';

    return (
      <a className='notification-popup__filter' href={route(linkName)}>
        {osu.trans(`notifications.see_${this.props.only ?? 'all'}`)}
      </a>
    );
  }

  private renderLegacyPm() {
    if (this.controller.currentFilter != null) return;

    return <LegacyPm />;
  }

  private renderMarkAsReadButton() {
    const type = this.controller.type;
    if (type.isEmpty) return null;

    return (
      <NotificationReadButton
        isMarkingAsRead={type.isMarkingAsRead}
        onMarkAsRead={this.handleMarkAsRead}
        text={osu.trans('notifications.mark_read', { type: osu.trans(`notifications.filters.${type.name ?? '_'}`) })}
      />
    );
  }

  private renderShowMore() {
    const type = this.controller.type;

    return (
      <ShowMoreLink
        callback={this.handleShowMore}
        hasMore={type?.hasMore}
        loading={type?.isLoading}
        modifiers={['notification-group', 'notification-list']}
      />
    );
  }

  private renderStacks() {
    if (this.state.hasError) {
      return;
    }

    const nodes = this.controller.stacks.map((stack) => <Stack key={stack.id} stack={stack} />);

    if (nodes.length === 0) {
      let transKey = 'notifications.loading';
      if (core.notificationsWorker.hasData) {
        if (this.controller.currentFilter == null) {
          transKey = 'notifications.all_read';
        } else {
          transKey = 'notifications.none';
        }
      } else if (core.notificationsWorker.waitingVerification) {
        transKey = 'notifications.verifying';
      }

      return (
        <p key='empty' className='notification-popup__empty'>
          {osu.trans(transKey)}
        </p>
      );
    }

    return nodes;
  }
}

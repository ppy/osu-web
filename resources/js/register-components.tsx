// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetPanel, { Props as BeatmapsetPanelProps } from 'beatmapset-panel';
import BeatmapsetEvents, { Props as BeatmapsetEventsProps } from 'components/beatmapset-events';
import BlockButton from 'components/block-button';
import ChatIcon from 'components/chat-icon';
import { Comments } from 'components/comments';
import { CommentsManager, Props as CommentsManagerProps } from 'components/comments-manager';
import CountdownTimer from 'components/countdown-timer';
import { LandingNews } from 'components/landing-news';
import MainNotificationIcon from 'components/main-notification-icon';
import QuickSearchButton from 'components/quick-search-button';
import RankingCountryFilter from 'components/ranking-country-filter';
import RankingSelectOptions from 'components/ranking-select-options';
import RankingUserFilter from 'components/ranking-user-filter';
import RankingVariantFilter from 'components/ranking-variant-filter';
import SpotlightSelectOptions from 'components/spotlight-select-options';
import { UserCard } from 'components/user-card';
import { UserCardStore } from 'components/user-card-store';
import { startListening, UserCardTooltip } from 'components/user-card-tooltip';
import { UserCards } from 'components/user-cards';
import { WikiSearch } from 'components/wiki-search';
import { keyBy } from 'lodash';
import { observable } from 'mobx';
import { deletedUser } from 'models/user';
import NotificationWidget from 'notification-widget/main';
import core from 'osu-core-singleton';
import QuickSearch from 'quick-search/main';
import QuickSearchWorker from 'quick-search/worker';
import * as React from 'react';
import { parseJson } from 'utils/json';

function reqJson<T>(input: string|undefined): T {
  // This will throw when input is missing and thus parsing empty string.
  return JSON.parse(input ?? '') as T;
}

function reqStr(input: string|undefined) {
  if (input == null) {
    throw new Error('unexpected undefined value');
  }

  return input;
}

core.reactTurbolinks.register('countdownTimer', (container) => (
  <CountdownTimer deadline={reqStr(container.dataset.deadline)} />
));

core.reactTurbolinks.register('blockButton', (container) => (
  <BlockButton userId={parseInt(reqStr(container.dataset.target), 10)} />
));

core.reactTurbolinks.register('beatmap-discussion-events', () => {
  const props: BeatmapsetEventsProps = {
    events: parseJson('json-events'),
    mode: 'list',
    users: keyBy(parseJson('json-users'), 'id'),
  };

  // TODO: move to store?
  // eslint-disable-next-line id-blacklist
  props.users.null = props.users.undefined = deletedUser.toJson();

  return <BeatmapsetEvents {...props} />;
});

core.reactTurbolinks.register('beatmapset-panel', (container) => {
  const props: BeatmapsetPanelProps = reqJson(container.dataset.beatmapsetPanel);

  return <BeatmapsetPanel {...observable(props)} />;
});

core.reactTurbolinks.register('ranking-select-options', () => (
  <RankingSelectOptions {...parseJson('json-ranking-select-options')} />
));

core.reactTurbolinks.register('spotlight-select-options', () => (
  <SpotlightSelectOptions {...parseJson('json-spotlight-select-options')} />
));

core.reactTurbolinks.register('comments', (container) => {
  const props = {
    ...reqJson<Omit<CommentsManagerProps, 'component'>>(container.dataset.props),
    component: Comments,
  };

  return <CommentsManager {...props} />;
});

core.reactTurbolinks.register('chat-icon', (container) => (
  <ChatIcon type={container.dataset.type} />
));

core.reactTurbolinks.register('main-notification-icon', (container) => (
  <MainNotificationIcon type={container.dataset.type} />
));

core.reactTurbolinks.register('notification-widget', (container) => (
  <NotificationWidget {...reqJson(container.dataset.notificationWidget)} />
));

const quickSearchWorker = new QuickSearchWorker();
core.reactTurbolinks.register('quick-search', () => (
  <QuickSearch worker={quickSearchWorker} />
));

core.reactTurbolinks.register('quick-search-button', () => (
  <QuickSearchButton worker={quickSearchWorker} />
));

core.reactTurbolinks.register('ranking-country-filter', () => (
  <RankingCountryFilter {...parseJson('json-country-filter')} />
));

core.reactTurbolinks.register('ranking-user-filter', () => (
  <RankingUserFilter {...parseJson('json-user-filter')} />
));

core.reactTurbolinks.register('ranking-variant-filter', () => (
  <RankingVariantFilter {...parseJson('json-variant-filter')} />
));

core.reactTurbolinks.register('user-card', (container) => (
  <UserCard
    modifiers={reqJson(container.dataset.modifiers ?? 'null')}
    user={container.dataset.isCurrentUser === '1' ? core.currentUser : reqJson(container.dataset.user ?? 'null')}
  />
));

core.reactTurbolinks.register('user-card-store', (container) => (
  <UserCardStore user={reqJson(container.dataset.user)} />
));

core.reactTurbolinks.register('user-card-tooltip', (container) => (
  <UserCardTooltip
    container={container}
    lookup={reqStr(container.dataset.lookup)}
  />
));

$(document).ready(startListening);
core.reactTurbolinks.register('user-cards', (container) => (
  <UserCards
    modifiers={reqJson(container.dataset.modifiers ?? 'null')}
    users={reqJson(container.dataset.users ?? '[]')}
    viewMode='card'
  />
));

core.reactTurbolinks.register('wiki-search', () => <WikiSearch />);

core.reactTurbolinks.register('landing-news', () => (
  <LandingNews posts={parseJson('json-posts')} />
));

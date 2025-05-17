// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import LegacyMatchEventJson from 'interfaces/legacy-match-event-json';
import LegacyMatchJson from 'interfaces/legacy-match-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { keyBy, dropRightWhile } from 'lodash';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { mobxArrayGet } from 'utils/array';
import { classWithModifiers } from 'utils/css';
import Content from './content';

interface LegacyMultiplayerHistoryJson {
  current_game_id?: number;
  events: LegacyMatchEventJson[];
  first_event_id: number;
  latest_event_id: number;
  match: LegacyMatchJson;
  users: UserJson[];
}

interface Props {
  events: LegacyMultiplayerHistoryJson;
}

interface State {
  currentGameId?: number;
  events: LegacyMatchEventJson[];
  latestEventId: number;
  match: LegacyMatchJson;
  users: Partial<Record<number, UserJson>>;
}

const fetchLimit = 100;
const maximumEvents = 500;
const refreshTimeout = 10000;

@observer
export default class Main extends React.Component<Props, State> {
  private autoloadTimeout: undefined | number;
  @observable private readonly data: State;
  @observable private loadingNext = false;
  @observable private loadingPrevious = false;

  private get hasLatest(): boolean {
    const lastEvent = mobxArrayGet(this.data.events, this.data.events.length - 1);

    return lastEvent != null && lastEvent.id === this.data.latestEventId;
  }

  private get hasNext(): boolean {
    return this.isOngoing || !this.hasLatest;
  }

  private get hasPrevious(): boolean {
    const firstEvent = mobxArrayGet(this.data.events, 0);

    return firstEvent != null && firstEvent.id !== this.props.events.first_event_id;
  }

  private get isAutoloading(): boolean {
    return this.isOngoing && this.hasLatest;
  }

  private get isOngoing(): boolean {
    return this.data.match.end_time == null;
  }

  private get minNextEventId(): number | undefined {
    if (this.data.currentGameId != null) {
      const currentGame = this.data.events.find((e) => e.game?.id === this.data.currentGameId);
      if (currentGame != null) {
        return currentGame.id - 1;
      }
    }

    return this.data.events.length === 0
      ? undefined
      : this.data.events[this.data.events.length - 1].id;
  }

  constructor(props: Props) {
    super(props);

    this.data = {
      currentGameId: props.events.current_game_id,
      events: props.events.events,
      latestEventId: props.events.latest_event_id,
      match: props.events.match,
      users: keyBy(props.events.users, 'id'),
    };
    makeObservable(this);
  }

  componentDidMount() {
    this.delayedAutoload();
  }

  componentWillUnmount() {
    clearTimeout(this.autoloadTimeout);
  }

  render() {
    return (
      <>
        <HeaderV4 theme='mp-history' />
        <div className={classWithModifiers('osu-page', ['generic'])}>
          <Content
            currentGameId={this.data.currentGameId}
            events={this.data.events}
            hasNext={this.hasNext}
            hasPrevious={this.hasPrevious}
            isAutoloading={this.isAutoloading}
            loadNext={this.loadNext}
            loadPrevious={this.loadPrevious}
            loadingNext={this.loadingNext}
            loadingPrevious={this.loadingPrevious}
            match={this.data.match}
            users={this.data.users} />
        </div>
      </>
    );
  }

  @action
  private readonly addUsers = (users: UserJson[]) => {
    for (const user of users) {
      this.data.users[user.id] = user;
    }
  };

  private readonly autoload = () => {
    if (!this.isAutoloading) {
      return;
    }

    this.loadNext();
  };

  private delayedAutoload() {
    this.autoloadTimeout = setTimeout(this.autoload, refreshTimeout);
  }

  @action
  private readonly loadNext = () => {
    if (!this.hasNext || this.loadingNext) {
      return;
    }

    clearTimeout(this.autoloadTimeout);
    this.loadingNext = true;

    $.ajax(
      route('matches.show', { match: this.data.match.id }),
      {
        data: {
          after: this.minNextEventId,
          limit: fetchLimit,
        },
        dataType: 'JSON',
        method: 'GET',
      })
      .done((data: LegacyMultiplayerHistoryJson) => runInAction(() => {
        if (data.events.length === 0) {
          return;
        }

        const startEventId = data.events[0]?.id ?? 0;

        this.data.events = dropRightWhile(this.data.events, (e) => e.id >= startEventId)
          .concat(data.events)
          .slice(-maximumEvents);
        this.addUsers(data.users);
        this.data.currentGameId = data.current_game_id;
        this.data.latestEventId = data.latest_event_id;
        this.data.match = data.match;
      }))
      .always(action(() => {
        this.loadingNext = false;
        this.delayedAutoload();
      }));
  };

  @action
  private readonly loadPrevious = () => {
    if (!this.hasPrevious) {
      return;
    }

    this.loadingPrevious = true;

    $.ajax(
      route('matches.show', { match: this.data.match.id }),
      {
        data: {
          before: this.data.events[0]?.id,
          limit: fetchLimit,
        },
        dataType: 'JSON',
        method: 'GET',
      })
      .done((data: LegacyMultiplayerHistoryJson) => runInAction(() => {
        if (data.events.length === 0) {
          return;
        }

        this.data.events = data.events.concat(this.data.events).slice(0, maximumEvents);
        this.addUsers(data.users);
        this.data.currentGameId = data.current_game_id;
        this.data.latestEventId = data.latest_event_id;
        this.data.match = data.match;
      }))
      .always(action(() => {
        this.loadingPrevious = false;
      }));
  };
}

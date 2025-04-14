// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import LegacyMatchEventJson from 'interfaces/legacy-match-event-json';
import LegacyMatchJson from 'interfaces/legacy-match-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { keyBy, dropRightWhile } from 'lodash';
import * as React from 'react';
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
  loadingNext: boolean;
  loadingPrevious: boolean;
  match: LegacyMatchJson;
  users: Partial<Record<number, UserJson>>;
}

const fetchLimit = 100;
const maximumEvents = 500;
const refreshTimeout = 10000;

export default class Main extends React.Component<Props, State> {
  private readonly timeouts: Partial<Record<string, number>> = {};

  constructor(props: Props) {
    super(props);

    this.state = {
      currentGameId: props.events.current_game_id,
      events: props.events.events,
      latestEventId: props.events.latest_event_id,
      loadingNext: false,
      loadingPrevious: false,
      match: props.events.match,
      users: keyBy(props.events.users, 'id'),
    };
  }

  componentDidMount() {
    this.delayedAutoload();
  }

  componentWillUnmount() {
    for (const timeout of Object.values(this.timeouts)) {
      clearTimeout(timeout);
    }
  }

  render() {
    return (
      <>
        <HeaderV4 theme='mp-history' />
        <div className={classWithModifiers('osu-page', ['generic'])}>
          <Content
            currentGameId={this.state.currentGameId}
            events={this.state.events}
            hasNext={this.hasNext}
            hasPrevious={this.hasPrevious}
            isAutoloading={this.isAutoloading}
            loadNext={this.loadNext}
            loadPrevious={this.loadPrevious}
            loadingNext={this.state.loadingNext}
            loadingPrevious={this.state.loadingPrevious}
            match={this.state.match}
            users={this.state.users} />
        </div>
      </>
    );
  }

  private autoload() {
    if (!this.isAutoloading) {
      return;
    }

    this.loadNext();
  }

  private delayedAutoload() {
    this.timeouts.autoload = setTimeout(() => this.autoload(), refreshTimeout);
  }

  private get hasLatest(): boolean {
    const lastEvent = this.state.events[this.state.events.length - 1];

    return lastEvent != null && lastEvent.id === this.state.latestEventId;
  }

  private get hasNext(): boolean {
    return this.isOngoing || !this.hasLatest;
  }

  private get hasPrevious(): boolean {
    const firstEvent = this.state.events[0];

    return firstEvent != null && firstEvent.id !== this.props.events.first_event_id;
  }

  private get isAutoloading(): boolean {
    return this.isOngoing && this.hasLatest;
  }

  private get isOngoing(): boolean {
    return this.state.match.end_time == null;
  }

  private readonly loadNext = () => {
    if (!this.hasNext) {
      return;
    }

    clearTimeout(this.timeouts.autoload);
    this.setState({ loadingNext: true });

    $.ajax(
      route('matches.show', { match: this.state.match.id }),
      {
        data: {
          after: this.minNextEventId(),
          limit: fetchLimit,
        },
        dataType: 'JSON',
        method: 'GET',
      })
      .done((data: LegacyMultiplayerHistoryJson) => {
        if (data.events.length === 0) {
          return;
        }

        const startEventId = data.events[0]?.id ?? 0;

        const newEvents = dropRightWhile(this.state.events, (e) => e.id >= startEventId)
          .concat(data.events)
          .slice(-maximumEvents);
        const newUsers = this.newUsersHash(data.users);

        this.setState({
          currentGameId: data.current_game_id,
          events: newEvents,
          latestEventId: data.latest_event_id,
          match: data.match,
          users: newUsers,
        });
      })
      .always(() => {
        this.setState({ loadingNext: false });
        this.delayedAutoload();
      });
  };

  private readonly loadPrevious = () => {
    if (!this.hasPrevious) {
      return;
    }

    this.setState({ loadingPrevious: true });

    $.ajax(
      route('matches.show', { match: this.state.match.id }),
      {
        data: {
          before: this.state.events[0]?.id,
          limit: fetchLimit,
        },
        dataType: 'JSON',
        method: 'GET',
      })
      .done((data: LegacyMultiplayerHistoryJson) => {
        if (data.events.length === 0) {
          return;
        }

        const newEvents = data.events.concat(this.state.events)
          .slice(0, maximumEvents);
        const newUsers = this.newUsersHash(data.users);

        this.setState({
          currentGameId: data.current_game_id,
          events: newEvents,
          latestEventId: data.latest_event_id,
          users: newUsers,
        });
      })
      .always(() => {
        this.setState({ loadingPrevious: false });
      });
  };

  private minNextEventId(): number | undefined {
    if (this.state.currentGameId != null) {
      const currentGame = this.state.events.find((e) => e.game?.id === this.state.currentGameId);
      if (currentGame != null) {
        return currentGame.id - 1;
      }
    }

    return this.state.events[this.state.events.length - 1]?.id;
  }

  private newUsersHash(users: UserJson[]): Partial<Record<number, UserJson>> {
    return { ...this.state.users, ...keyBy(users, 'id') };
  }
}

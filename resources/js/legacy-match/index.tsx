// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import LegacyMatchEventJson from 'interfaces/legacy-match-event-json';
import LegacyMatchJson from 'interfaces/legacy-match-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { dropRightWhile } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
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

interface Data {
  currentGameId?: number;
  events: LegacyMatchEventJson[];
  latestEventId: number;
  match: LegacyMatchJson;
  users: Partial<Record<number, UserJson>>;
}

const fetchLimit = 100;
const maximumEvents = 500;
const refreshTimeout = 10000;

function dataFromJson(existingData: Data | null, json: LegacyMultiplayerHistoryJson, prepend: boolean) {
  let events = existingData?.events ?? [];
  if (json.events.length > 0) {
    if (prepend) {
      events = json.events.concat(events).slice(0, maximumEvents);
    } else {
      const startEventId = json.events[0].id;

      events = dropRightWhile(events, (e) => e.id >= startEventId)
        .concat(json.events)
        .slice(-maximumEvents);
    }
  }

  const users = existingData?.users ?? {};
  for (const user of json.users) {
    users[user.id] = user;
  }

  return {
    currentGameId: json.current_game_id,
    events,
    latestEventId: json.latest_event_id,
    match: json.match,
    users,
  };
}


@observer
export default class LegacyMatch extends React.Component<Props> {
  private autoloadTimeout: undefined | number;
  @observable private data: Data;
  @observable private loadingNext = false;
  @observable private loadingPrevious = false;

  private get hasLatest(): boolean {
    const lastEvent = mobxArrayGet(this.data.events, -1);

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

  @computed
  private get minNextEventId(): number | undefined {
    if (this.data.currentGameId != null) {
      const currentGame = this.data.events.find((e) => e.game?.id === this.data.currentGameId);
      if (currentGame != null) {
        return currentGame.id - 1;
      }
    }

    return mobxArrayGet(this.data.events, -1)?.id;
  }

  constructor(props: Props) {
    super(props);

    this.data = dataFromJson(null, props.events, false);
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
      .done((json: LegacyMultiplayerHistoryJson) => runInAction(() => {
        this.data = dataFromJson(this.data, json, false);
      }))
      .always(action(() => {
        this.loadingNext = false;
        this.delayedAutoload();
      }));
  };

  @action
  private readonly loadPrevious = () => {
    if (!this.hasPrevious || this.loadingPrevious) {
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
      .done((json: LegacyMultiplayerHistoryJson) => runInAction(() => {
        this.data = dataFromJson(this.data, json, true);
      }))
      .always(action(() => {
        this.loadingPrevious = false;
      }));
  };
}

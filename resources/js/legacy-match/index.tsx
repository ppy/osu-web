// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import LegacyMatchEventJson from 'interfaces/legacy-match-event-json';
import LegacyMatchJson from 'interfaces/legacy-match-json';
import { playlistItemFromLegacy } from 'interfaces/playlist-item-json';
import { eventFromLegacy } from 'interfaces/realtime-room-event-json';
import { roomJsonFromLegacy } from 'interfaces/room-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { dropRightWhile, keyBy, last } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import Content, { Data } from './content';

interface LegacyMultiplayerHistoryJson {
  current_game_id: null | number;
  events: LegacyMatchEventJson[];
  first_event_id: number;
  latest_event_id: number;
  match: LegacyMatchJson;
  users: UserJson[];
}

interface Props {
  events: LegacyMultiplayerHistoryJson;
}

const fetchLimit = 100;
const maximumEvents = 500;
const refreshTimeout = 10000;

function dataFromJson(existingData: Data | null, json: LegacyMultiplayerHistoryJson, prepend: boolean): Data {
  let events = existingData?.events ?? [];
  if (json.events.length > 0) {
    const convertedEvents = json.events.map(eventFromLegacy);
    if (prepend) {
      events = convertedEvents.concat(events).slice(0, maximumEvents);
    } else {
      const startEventId = json.events[0].id;

      events = dropRightWhile(events, (e) => e.id >= startEventId)
        .concat(convertedEvents)
        .slice(-maximumEvents);
    }
  }

  const beatmaps = existingData?.beatmaps ?? {};
  const beatmapsets = existingData?.beatmapsets ?? {};
  const playlistItems = existingData?.playlistItems ?? {};
  for (const event of json.events) {
    if (event.game != null) {
      playlistItems[event.game.id] = playlistItemFromLegacy(event.game);
      if (event.game.beatmap != null) {
        beatmaps[event.game.beatmap.id] = event.game.beatmap;
        if (event.game.beatmap.beatmapset != null) {
          beatmapsets[event.game.beatmap.beatmapset.id] = event.game.beatmap.beatmapset;
        }
      }
    }
  }

  const room = roomJsonFromLegacy(json.match);
  const users = Object.assign(existingData?.users ?? {}, keyBy(json.users, 'id'));

  return {
    beatmaps,
    beatmapsets,
    currentPlaylistItemId: json.current_game_id,
    events,
    lastEventId: json.latest_event_id,
    playlistItems,
    room,
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
    const lastEvent = last(this.data.events);

    return lastEvent != null && lastEvent.id === this.data.lastEventId;
  }

  private get hasNext(): boolean {
    return this.isOngoing || !this.hasLatest;
  }

  private get hasPrevious(): boolean {
    const firstEvent = this.data.events[0];

    return firstEvent != null && firstEvent.id !== this.props.events.first_event_id;
  }

  private get isAutoloading(): boolean {
    return this.isOngoing && this.hasLatest;
  }

  private get isOngoing(): boolean {
    return this.data.room.ends_at == null;
  }

  @computed
  private get minNextEventId(): number | undefined {
    if (this.data.currentPlaylistItemId != null) {
      const currentGame = this.data.events.find((e) => e.playlist_item_id === this.data.currentPlaylistItemId);
      if (currentGame != null) {
        return currentGame.id - 1;
      }
    }

    return last(this.data.events)?.id;
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
        <div className={classWithModifiers('osu-page', 'generic')}>
          <Content
            data={this.data}
            hasNext={this.hasNext}
            hasPrevious={this.hasPrevious}
            isAutoloading={this.isAutoloading}
            loadNext={this.loadNext}
            loadPrevious={this.loadPrevious}
            loadingNext={this.loadingNext}
            loadingPrevious={this.loadingPrevious}
          />
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
      route('matches.show', { match: this.data.room.id }),
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
      route('matches.show', { match: this.data.room.id }),
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

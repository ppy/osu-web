// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { PlaylistItemJsonForMultiplayerEvent } from 'interfaces/playlist-item-json';
import RealtimeRoomEventJson from 'interfaces/realtime-room-event-json';
import RoomJson from 'interfaces/room-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import Content, { Data } from 'legacy-match/content';
import { keyBy, last } from 'lodash';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface MultiplayerRoomEventsJson {
  beatmaps: BeatmapJson[];
  beatmapsets: BeatmapsetJson[];
  current_playlist_item_id: null | number;
  events: RealtimeRoomEventJson[];
  first_event_id: number;
  last_event_id: number;
  playlist_items: PlaylistItemJsonForMultiplayerEvent[];
  room: RoomJson;
  users: UserJson[];
}

interface Props {
  events: MultiplayerRoomEventsJson;
}

const fetchLimit = 100;
const maximumEvents = 500;
const refreshTimeout = 10000;

function dataFromJson(existingData: Data | null, json: MultiplayerRoomEventsJson, prepend: boolean): Data {
  let events = existingData?.events ?? [];
  if (json.events.length > 0) {
    if (prepend) {
      events = json.events.concat(events).slice(0, maximumEvents);
    } else {
      events = events.concat(json.events).slice(-maximumEvents);
    }
  }

  const beatmaps = Object.assign(existingData?.beatmaps ?? {}, keyBy(json.beatmaps, 'id'));
  const beatmapsets = Object.assign(existingData?.beatmapsets ?? {}, keyBy(json.beatmapsets, 'id'));
  const playlistItems = Object.assign(existingData?.playlistItems ?? {}, keyBy(json.playlist_items, 'id'));
  const users = Object.assign(existingData?.users ?? {}, keyBy(json.users, 'id'));

  return {
    beatmaps,
    beatmapsets,
    currentPlaylistItemId: json.current_playlist_item_id,
    events,
    lastEventId: json.last_event_id,
    playlistItems,
    room: json.room,
    users,
  };
}


@observer
export default class MultiplayerRoomEvents extends React.Component<Props> {
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
          <p>
            <a
              className='btn-osu-big btn-osu-big--rounded-thin'
              href={route('multiplayer.rooms.show', { room: this.data.room.id })}
            >
              <span className='fas fa-arrow-left' /> {trans('multiplayer.room.view_summary')}
            </a>
          </p>
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
      route('multiplayer.rooms.events', { room: this.data.room.id }),
      {
        data: {
          after: last(this.data.events)?.id,
          limit: fetchLimit,
        },
        dataType: 'JSON',
        method: 'GET',
      })
      .done((json: MultiplayerRoomEventsJson) => runInAction(() => {
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
      route('multiplayer.rooms.events', { room: this.data.room.id }),
      {
        data: {
          before: this.data.events[0]?.id,
          limit: fetchLimit,
        },
        dataType: 'JSON',
        method: 'GET',
      })
      .done((json: MultiplayerRoomEventsJson) => runInAction(() => {
        this.data = dataFromJson(this.data, json, true);
      }))
      .always(action(() => {
        this.loadingPrevious = false;
      }));
  };
}

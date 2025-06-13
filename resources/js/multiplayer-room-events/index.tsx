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
import Content, { Data, fetchLimit, maximumEvents } from 'legacy-match/content';
import { keyBy, last } from 'lodash';
import { makeObservable, observable, runInAction } from 'mobx';
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
    firstEventId: json.first_event_id,
    lastEventId: json.last_event_id,
    playlistItems,
    room: json.room,
    users,
  };
}


@observer
export default class MultiplayerRoomEvents extends React.Component<Props> {
  @observable private data: Data;

  constructor(props: Props) {
    super(props);

    this.data = dataFromJson(null, props.events, false);
    makeObservable(this);
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
            loadNext={this.loadNext}
            loadPrevious={this.loadPrevious}
          />
        </div>
      </>
    );
  }

  private readonly loadNext = (): JQuery.jqXHR<void> => $.ajax(
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
    }));

  private readonly loadPrevious = (): JQuery.jqXHR<void> => $.ajax(
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
    }));
}

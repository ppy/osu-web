// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { PlaylistItemJsonForMultiplayerEvent } from 'interfaces/playlist-item-json';
import RealtimeRoomEventJson from 'interfaces/realtime-room-event-json';
import RoomJson from 'interfaces/room-json';
import UserJson from 'interfaces/user-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { bottomPageDistance } from 'utils/html';
import { trans } from 'utils/lang';
import Event from './event';
import Game from './game';

export interface Data {
  beatmaps: Partial<Record<number, BeatmapJson>>;
  beatmapsets: Partial<Record<number, BeatmapsetJson>>;
  currentPlaylistItemId: null | number;
  events: RealtimeRoomEventJson[];
  lastEventId: number;
  playlistItems: Partial<Record<number, PlaylistItemJsonForMultiplayerEvent>>;
  room: RoomJson;
  users: Partial<Record<number, UserJson>>;
}

interface Props {
  data: Data;
  hasNext: boolean;
  hasPrevious: boolean;
  isAutoloading: boolean;
  loadingNext: boolean;
  loadingPrevious: boolean;
  loadNext: () => void;
  loadPrevious: () => void;
}

interface Snapshot {
  reference?: {
    fn: () => number;
    prev: number;
  };
  scrollToLastEvent: boolean;
}

export interface TeamScores {
  blue: number;
  red: number;
}

@observer
export default class Content extends React.PureComponent<Props> {
  private inEvent = false;
  private scoresCache: Partial<Record<number, TeamScores>> = {};

  componentDidUpdate(prevProps: Readonly<Props>, prevState: Readonly<unknown>, snapshot?: Snapshot) {
    if (snapshot?.scrollToLastEvent) {
      $(window).stop().scrollTo(document.body.scrollHeight, 500);
    } else if (snapshot?.reference) {
      const referenceCurrent = snapshot.reference.fn();
      const documentScrollTopCurrent = window.scrollY;
      const documentScrollTopTarget = documentScrollTopCurrent + referenceCurrent - snapshot.reference.prev;
      window.scrollTo(window.scrollX, documentScrollTopTarget);
    }
  }

  getSnapshotBeforeUpdate(prevProps: Readonly<Props>): Snapshot {
    const snapshot: Snapshot = {
      scrollToLastEvent: prevProps.isAutoloading && this.props.isAutoloading && bottomPageDistance() < 10,
    };

    if (!snapshot.scrollToLastEvent) {
      const hadEvents = prevProps.data.events != null && prevProps.data.events.length > 0;
      const hasEvents = this.props.data.events != null && this.props.data.events.length > 0;
      if (hadEvents && hasEvents) {
        let referenceFn: () => number;

        // This is to allow events to be added without moving currently
        // visible events on viewport.
        if (prevProps.data.events[0].id > this.props.data.events[0].id) {
          referenceFn = () => document.body.scrollHeight;
        } else {
          referenceFn = () => 0;
        }

        snapshot.reference = {
          fn: referenceFn,
          prev: referenceFn(),
        };
      }
    }

    return snapshot;
  }

  render() {
    this.inEvent = false;

    return (
      <div className='mp-history-content'>
        <h3 className='mp-history-content__item'>{this.props.data.room.name}</h3>
        {this.props.hasPrevious &&
          <div className={classWithModifiers('mp-history-content__item', ['more'])}>
            <ShowMoreLink
              callback={this.props.loadPrevious}
              direction='up'
              hasMore
              loading={this.props.loadingPrevious} />
          </div>}
        {this.props.data.events.map((event) => this.renderEvent(event))}
        {this.closeEventsGroup()}
        {this.props.hasNext &&
          <div className={classWithModifiers('mp-history-content__item', ['more'])}>
            {this.props.isAutoloading && <div className='mp-history-content__autoload-label'>{trans('matches.match.in_progress_spinner_label')}</div>}
            <ShowMoreLink
              callback={this.props.loadNext}
              hasMore
              loading={this.props.isAutoloading || this.props.loadingNext} />
          </div>}
      </div>
    );
  }

  private closeEventsGroup() {
    if (this.inEvent) {
      this.inEvent = false;
      return <div className={classWithModifiers('mp-history-content__item', ['event', 'event-close'])} />;
    }
  }

  private openEventsGroup() {
    if (!this.inEvent) {
      this.inEvent = true;
      return <div className={classWithModifiers('mp-history-content__item', ['event', 'event-open'])} />;
    }
  }

  private renderEvent(event: RealtimeRoomEventJson) {
    if (event.event_type === 'game_started') {
      if (event.playlist_item_id == null) {
        return null;
      }

      const playlistItem = this.props.data.playlistItems[event.playlist_item_id];
      if (playlistItem == null || (!playlistItem.expired && playlistItem.id !== this.props.data.currentPlaylistItemId)) {
        return null;
      }

      return (
        <React.Fragment key={event.id}>
          {this.closeEventsGroup()}

          <div className="mp-history-content__item">
            <Game
              data={this.props.data}
              playlistItem={playlistItem}
              teamScores={this.teamScores(playlistItem)}
            />
          </div>
        </React.Fragment>
      );
    } else {
      return (
        <React.Fragment key={event.id}>
          {this.openEventsGroup()}

          <div className={classWithModifiers('mp-history-content__item', ['event'])}>
            <Event
              key={event.id}
              event={event}
              users={this.props.data.users} />
          </div>
        </React.Fragment>
      );
    }
  }

  private teamScores(playlistItem: PlaylistItemJsonForMultiplayerEvent): TeamScores {
    // this only caches ended games which scores shouldn't change ever.
    const cachedScore = this.scoresCache[playlistItem.id];

    if (cachedScore != null) {
      return cachedScore;
    }

    const scores: TeamScores = { blue: 0, red: 0 };

    if (!playlistItem.expired) {
      return scores;
    }

    for (const score of playlistItem.scores) {
      if (!score.passed) continue;

      const team = playlistItem.details.teams?.[score.user_id];
      if (team == null) {
        continue;
      }
      scores[team] += score.total_score;
    }

    return this.scoresCache[playlistItem.id] = scores;
  }
}

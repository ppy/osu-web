// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { PlaylistItemJsonForMultiplayerEvent } from 'interfaces/playlist-item-json';
import RealtimeRoomEventJson from 'interfaces/realtime-room-event-json';
import RoomJson from 'interfaces/room-json';
import UserJson from 'interfaces/user-json';
import { last } from 'lodash';
import { action, makeObservable, observable, reaction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { bottomPageDistance } from 'utils/html';
import { trans } from 'utils/lang';
import Event from './event';
import Game from './game';

export const fetchLimit = 100;
export const maximumEvents = 500;
const refreshTimeout = 10000;

export interface Data {
  beatmaps: Partial<Record<number, BeatmapJson>>;
  beatmapsets: Partial<Record<number, BeatmapsetJson>>;
  currentPlaylistItemId: null | number;
  events: RealtimeRoomEventJson[];
  firstEventId: number;
  lastEventId: number;
  playlistItems: Partial<Record<number, PlaylistItemJsonForMultiplayerEvent>>;
  room: RoomJson;
  users: Partial<Record<number, UserJson>>;
}

interface Props {
  data: Data;
  loadNext: () => JQuery.jqXHR<void>;
  loadPrevious: () => JQuery.jqXHR<void>;
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
  private autoloadTimeout: undefined | number;
  private inEvent = false;
  @observable private loadingNext = false;
  @observable private loadingPrevious = false;
  private scoresCache: Partial<Record<number, TeamScores>> = {};
  private snapshot: Snapshot | undefined;
  private readonly snapshotReaction;

  private get hasLatest(): boolean {
    const lastEvent = last(this.props.data.events);

    return lastEvent != null && lastEvent.id === this.props.data.lastEventId;
  }

  private get hasNext(): boolean {
    return this.isOngoing || !this.hasLatest;
  }

  private get hasPrevious(): boolean {
    const firstEvent = this.props.data.events[0];

    return firstEvent != null && firstEvent.id !== this.props.data.firstEventId;
  }

  private get isAutoloading(): boolean {
    return this.isOngoing && this.hasLatest;
  }

  private get isOngoing(): boolean {
    return this.props.data.room.ends_at == null;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    this.snapshotReaction = reaction(
      () => ({
        firstEventId: this.props.data.events[0]?.id,
        isAutoloading: this.isAutoloading,
      }),
      (value, prevValue) => {
        this.snapshot = {
          scrollToLastEvent: prevValue.isAutoloading && value.isAutoloading && bottomPageDistance() < 10,
        };

        if (!this.snapshot.scrollToLastEvent) {
          const hadEvents = prevValue.firstEventId != null;
          const hasEvents = value.firstEventId != null;
          if (hadEvents && hasEvents) {
            let referenceFn: () => number;

            // This is to allow events to be added without moving currently
            // visible events on viewport.
            if (prevValue.firstEventId > value.firstEventId) {
              referenceFn = () => document.body.scrollHeight;
            } else {
              referenceFn = () => 0;
            }

            this.snapshot.reference = {
              fn: referenceFn,
              prev: referenceFn(),
            };
          }
        }
      },
    );
  }

  componentDidMount() {
    this.delayedAutoload();
  }

  componentDidUpdate() {
    if (this.snapshot?.scrollToLastEvent) {
      $(window).stop().scrollTo(document.body.scrollHeight, 500);
    } else if (this.snapshot?.reference) {
      const referenceCurrent = this.snapshot.reference.fn();
      const documentScrollTopCurrent = window.scrollY;
      const documentScrollTopTarget = documentScrollTopCurrent + referenceCurrent - this.snapshot.reference.prev;
      window.scrollTo(window.scrollX, documentScrollTopTarget);
    }
    this.snapshot = undefined;
  }

  componentWillUnmount() {
    clearTimeout(this.autoloadTimeout);
    this.snapshotReaction();
  }

  render() {
    this.inEvent = false;

    return (
      <div className='mp-history-content'>
        <h3 className='mp-history-content__item'>{this.props.data.room.name}</h3>
        {this.hasPrevious &&
          <div className={classWithModifiers('mp-history-content__item', ['more'])}>
            <ShowMoreLink
              callback={this.loadPrevious}
              direction='up'
              hasMore
              loading={this.loadingPrevious} />
          </div>}
        {this.props.data.events.map((event) => this.renderEvent(event))}
        {this.closeEventsGroup()}
        {this.hasNext &&
          <div className={classWithModifiers('mp-history-content__item', ['more'])}>
            {this.isAutoloading && <div className='mp-history-content__autoload-label'>{trans('matches.match.in_progress_spinner_label')}</div>}
            <ShowMoreLink
              callback={this.loadNext}
              hasMore
              loading={this.isAutoloading || this.loadingNext} />
          </div>}
      </div>
    );
  }

  private readonly autoload = () => {
    if (this.isAutoloading) {
      this.loadNext();
    }
  };

  private closeEventsGroup() {
    if (this.inEvent) {
      this.inEvent = false;
      return <div className={classWithModifiers('mp-history-content__item', ['event', 'event-close'])} />;
    }
  }

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

    this.props.loadNext().always(action(() => {
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

    this.props.loadPrevious().always(action(() => {
      this.loadingPrevious = false;
    }));
  };

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

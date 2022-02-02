// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DifficultyBadge from 'difficulty-badge';
import Img2x from 'img2x';
import RoomJson from 'interfaces/room-json';
import { route } from 'laroute';
import { maxBy, minBy } from 'lodash';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import { UserLink } from 'user-link';
import { getDiffColour } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import MultiplayerHistoryStore from './multiplayer-history-store';

interface Props {
  room: RoomJson & Required<Pick<RoomJson, 'playlist'>>;
  store: MultiplayerHistoryStore;
}

const endingSoonDiffMs = 60 * 60 * 1000; // 60 minutes.

@observer
export default class Room extends React.Component<Props> {
  @computed
  private get status() {
    if (!this.props.room.active) {
      return 'ended';
    }

    const diff = new Date(this.props.room.ends_at).getTime() - new Date().getTime();

    return diff < endingSoonDiffMs ? 'soon' : 'active';
  }

  @computed
  private get maxDifficulty() {
    const max = maxBy(this.props.room.playlist, (playlist) => this.props.store.beatmaps.get(playlist.beatmap_id)?.difficulty_rating);
    return this.props.store.beatmaps.get(max?.beatmap_id ?? 0)?.difficulty_rating ?? 0;
  }

  @computed
  private get minDifficulty() {
    const min = minBy(this.props.room.playlist, (playlist) => this.props.store.beatmaps.get(playlist.beatmap_id)?.difficulty_rating);
    return this.props.store.beatmaps.get(min?.beatmap_id ?? 0)?.difficulty_rating ?? 0;
  }

  private get background() {
    const beatmap = this.props.store.beatmaps.get(this.props.room.playlist[0].beatmap_id);
    const beatmapset = this.props.store.beatmapsets.get(beatmap?.beatmapset_id ?? 0);

    if (beatmapset == null) return undefined;

    return beatmapset.covers.cover;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const endsAt = moment(this.props.room.ends_at);

    return (
      <div className='multiplayer-room'>
        {this.renderCover()}
        <div className='multiplayer-room__content'>
          <div className='multiplayer-room__badge-container'>
            <div className={classWithModifiers('multiplayer-room__badge', [this.status])}>{osu.trans(`multiplayer.room.status.${this.status}`)}</div>
            <time className='js-tooltip-time u-hover' title={this.props.room.ends_at}>
              {this.status === 'ended'
                ? endsAt.fromNow()
                : osu.trans('multiplayer.room.time_left', { time: endsAt.fromNow(true) })}
            </time>
          </div>
          <div className='multiplayer-room__details'>
            <div className='multiplayer-room__name'>{this.props.room.name}</div>
            {this.renderMembers()}
          </div>
          <div className='multiplayer-room__badge-container multiplayer-room__badge-container--bottom'>
            <div className={classWithModifiers('multiplayer-room__badge', ['map-count'])}>{osu.transChoice('multiplayer.room.map_count', this.props.room.playlist.length)}</div>
            <div
              className='multiplayer-room__difficulty'
              style={{
                '--max-difficulty': getDiffColour(this.maxDifficulty),
                '--min-difficulty': getDiffColour(this.minDifficulty),
              } as React.CSSProperties}
            >
              <DifficultyBadge rating={this.minDifficulty} />
              {this.minDifficulty !== this.maxDifficulty && <DifficultyBadge rating={this.maxDifficulty} />}
            </div>
          </div>
        </div>
      </div>
    );
  }

  private renderCover() {
    return (
      <a className='multiplayer-room__cover-container' href={route('multiplayer.rooms.show', { room: this.props.room.id })}>
        <div className='multiplayer-room__cover multiplayer-room__cover--default' />
        <Img2x className='multiplayer-room__cover' hideOnError src={this.background} />
      </a>
    );
  }

  private renderHost() {
    return (
      <div className='multiplayer-room__host'>
        <StringWithComponent
          mappings={{ user: <UserLink className='u-hover' user={this.props.room.host} /> }}
          pattern={osu.trans('multiplayer.room.hosted_by')}
        />
      </div>
    );
  }

  private renderMembers() {
    return (
      <div className='multiplayer-room__members'>
        {this.renderHost()}
        {this.renderParticipants()}
      </div>
    );
  }

  private renderParticipants() {
    return (
      <div className='multiplayer-room__participants'>
        {osu.transChoice('multiplayer.room.player_count', this.props.room.participant_count)}
      </div>
    );
  }
}

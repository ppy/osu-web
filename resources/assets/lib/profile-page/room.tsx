// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DifficultyBadge from 'difficulty-badge';
import Img2x from 'img2x';
import RoomJson from 'interfaces/room-json';
import { maxBy, minBy } from 'lodash';
import * as React from 'react';
import { StringWithComponent } from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { UserLink } from 'user-link';
import UserMultiplayerHistoryContext from 'user-multiplayer-history-context';
import { getDiffRating } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';

interface Props {
  room: RoomJson & Required<Pick<RoomJson, 'playlist'>>;
}

const endingSoonDiffMs = 60 * 60 * 1000; // 60 minutes.
const hideImage = (e: React.SyntheticEvent<HTMLElement>) => {
  e.currentTarget.style.display = 'none';
};

export default class Room extends React.Component<Props> {
  static contextType = UserMultiplayerHistoryContext;
  declare context: React.ContextType<typeof UserMultiplayerHistoryContext>;

  get status() {
    if (!this.props.room.active) {
      return 'ended';
    }

    const diff = new Date(this.props.room.ends_at).getTime() - new Date().getTime();

    return diff < endingSoonDiffMs ? 'soon' : 'active';
  }

  get maxDifficulty() {
    const max = maxBy(this.props.room.playlist, (playlist) => this.context.beatmaps.get(playlist.beatmap_id)?.difficulty_rating);
    return this.context.beatmaps.get(max?.beatmap_id ?? 0)?.difficulty_rating ?? 0;
  }

  get minDifficulty() {
    const min = minBy(this.props.room.playlist, (playlist) => this.context.beatmaps.get(playlist.beatmap_id)?.difficulty_rating);
    return this.context.beatmaps.get(min?.beatmap_id ?? 0)?.difficulty_rating ?? 0;
  }

  get background() {
    const beatmap = this.context.beatmaps.get(this.props.room.playlist[0].beatmap_id);
    const beatmapset = this.context.beatmapsets.get(beatmap?.beatmapset_id ?? 0);

    if (beatmapset == null) return undefined;

    return beatmapset.covers.cover;
  }

  render() {
    return (
      <div className='multiplayer-room'>
        {this.renderCover()}
        <div className='multiplayer-room__content'>
          <div className='multiplayer-room__ends'>
            <div className='multiplayer-room__badge-container'>
              <div className={classWithModifiers('multiplayer-room__badge', [this.status])}>{osu.trans(`multiplayer.room.status.${this.status}`)}</div>
              <TimeWithTooltip dateTime={this.props.room.ends_at} relative />
            </div>
          </div>
          <div className='multiplayer-room__details'>
            <div className='multiplayer-room__name'>{this.props.room.name}</div>
            {this.renderMembers()}
          </div>
          <div className='multiplayer-room__badge-container'>
            <div className={classWithModifiers('multiplayer-room__badge', ['map-count'])}>{osu.transChoice('multiplayer.room.map_count', this.props.room.playlist.length)}</div>
            <div
              className='multiplayer-room__difficulty'
              style={{
                background: `linear-gradient(0deg, var(--diff-${getDiffRating(this.maxDifficulty)}) 50%, var(--diff-${getDiffRating(this.minDifficulty)}) 50%)`,
              }}
            >
              <DifficultyBadge rating={this.minDifficulty} />
              <DifficultyBadge rating={this.maxDifficulty} />
            </div>
          </div>
        </div>
      </div>
    );
  }

  private renderCover() {
    return (
      <div className='multiplayer-room__cover-container'>
        <Img2x className='multiplayer-room__cover' onError={hideImage} src={this.background} />
      </div>

    );
  }

  private renderHost() {
    return (
      <div className='multiplayer-room__host'>
        <StringWithComponent
          mappings={{ ':user': <UserLink key='user' user={this.props.room.host} /> }}
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
        {this.props.room.participant_count} players
      </div>
    );
  }
}

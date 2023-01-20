// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import DifficultyBadge from 'components/difficulty-badge';
import StringWithComponent from 'components/string-with-component';
import { UserLink } from 'components/user-link';
import { EndpointRoomJson } from 'interfaces/user-multiplayer-history-json';
import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as moment from 'moment';
import * as React from 'react';
import { getDiffColour } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { trans, transChoice } from 'utils/lang';
import MultiplayerHistoryStore from './multiplayer-history-store';

interface Props {
  room: EndpointRoomJson;
  store: MultiplayerHistoryStore;
}

const endingSoonDiffMs = 60 * 60 * 1000; // 60 minutes.

@observer
export default class Room extends React.Component<Props> {
  private get playlistItemCount() {
    return this.props.room.active
      ? this.props.room.playlist_item_stats.count_active
      : this.props.room.playlist_item_stats.count_total;
  }

  @computed
  private get status() {
    if (!this.props.room.active) {
      return 'ended';
    }

    if (this.props.room.ends_at == null) {
      return 'active';
    }

    const diff = new Date(this.props.room.ends_at).getTime() - new Date().getTime();

    return diff < endingSoonDiffMs ? 'soon' : 'active';
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const endsAt = this.props.room.ends_at;

    return (
      <div className='multiplayer-room'>
        {this.renderCover()}
        <div className='multiplayer-room__content'>
          <div className='multiplayer-room__badge-container'>
            <div className={classWithModifiers('multiplayer-room__badge', [this.status])}>{trans(`multiplayer.room.status.${this.status}`)}</div>
            {endsAt != null &&
              <time className='js-tooltip-time u-hover' title={endsAt}>
                {this.status === 'ended'
                  ? moment(endsAt).fromNow()
                  : trans('multiplayer.room.time_left', { time: moment(endsAt).fromNow(true) })}
              </time>
            }
          </div>
          <div className='multiplayer-room__details'>
            <div className='multiplayer-room__name'>{this.props.room.name}</div>
            {this.renderMembers()}
          </div>
          <div className='multiplayer-room__badge-container multiplayer-room__badge-container--bottom'>
            <div className={classWithModifiers('multiplayer-room__badge', ['map-count'])}>{transChoice('multiplayer.room.map_count', this.playlistItemCount)}</div>
            <div
              className='multiplayer-room__difficulty'
              style={{
                '--max-difficulty': getDiffColour(this.props.room.difficulty_range.max),
                '--min-difficulty': getDiffColour(this.props.room.difficulty_range.min),
              } as React.CSSProperties}
            >
              <DifficultyBadge rating={this.props.room.difficulty_range.min} />
              {this.props.room.difficulty_range.max !== this.props.room.difficulty_range.min &&
                <DifficultyBadge rating={this.props.room.difficulty_range.max} />
              }
            </div>
          </div>
        </div>
      </div>
    );
  }

  private renderCover() {
    return (
      <a className='multiplayer-room__cover-container' href={route('multiplayer.rooms.show', { room: this.props.room.id })}>
        <BeatmapsetCover
          beatmapset={this.props.room.current_playlist_item?.beatmap?.beatmapset}
          modifiers='full'
          size='cover'
        />
      </a>
    );
  }

  private renderHost() {
    return (
      <div className='multiplayer-room__host'>
        <StringWithComponent
          mappings={{ user: <UserLink className='u-hover' user={this.props.room.host} /> }}
          pattern={trans('multiplayer.room.hosted_by')}
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
        {transChoice('multiplayer.room.player_count', this.props.room.participant_count)}
      </div>
    );
  }
}

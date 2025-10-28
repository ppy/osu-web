// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import Mod from 'components/mod';
import TimeWithTooltip from 'components/time-with-tooltip';
import { deletedBeatmap } from 'interfaces/beatmap-json';
import { deletedBeatmapset } from 'interfaces/beatmapset-json';
import { PlaylistItemJsonForMultiplayerEvent } from 'interfaces/playlist-item-json';
import { rulesetIdToName } from 'interfaces/ruleset';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { Data } from './content';

interface Props {
  data: Data;
  playlistItem: PlaylistItemJsonForMultiplayerEvent;
}

const timeFormat = 'LTS';

export default observer(function GameHeader(props: Props) {
  const beatmap = props.data.beatmaps[props.playlistItem.beatmap_id] ?? deletedBeatmap(rulesetIdToName[props.playlistItem.ruleset_id]);
  const beatmapset = props.data.beatmapsets[beatmap.beatmapset_id] ?? deletedBeatmapset();

  let title = getTitle(beatmapset);
  let url: string | undefined;
  if (props.playlistItem.freestyle) {
    if (beatmapset.id !== 0) {
      url = route('beatmapsets.show', { beatmapset: beatmapset.id });
    }
  } else {
    if (beatmap.id !== 0) {
      url = route('beatmaps.show', { beatmap: beatmap.id });
    }

    const version = beatmap.version;
    if (version !== '') {
      title += ` [${version}]`;
    }
  }

  const startTime = <TimeWithTooltip dateTime={props.playlistItem.details.started_at} format={timeFormat} />;
  const endTime = !props.playlistItem.expired || props.playlistItem.played_at == null
    ? null
    : <TimeWithTooltip dateTime={props.playlistItem.played_at} format={timeFormat} />;

  return (
    <a
      className='mp-history-game__header'
      href={url}>
      <BeatmapsetCover
        beatmapset={beatmapset}
        modifiers='full'
        size='cover' />
      <div className='mp-history-game__header-overlay' />
      <div className='mp-history-game__stats-box'>
        {endTime != null
          ? <span className='mp-history-game__stat'>{startTime} - {endTime}</span>
          : <span className='mp-history-game__stat'>{startTime} {trans('matches.match.in-progress')}</span>}
        <span className='mp-history-game__stat'>
          {props.playlistItem.freestyle
            ? trans('matches.game.freestyle')
            : trans(`beatmaps.mode.${rulesetIdToName[props.playlistItem.ruleset_id]}`)}
        </span>
        <span className='mp-history-game__stat'>{trans(`matches.game.scoring-type.${props.playlistItem.legacy_scoring_type ?? 'score'}`)}</span>
      </div>
      <div className='mp-history-game__metadata-box'>
        <h1 className={classWithModifiers('mp-history-game__metadata', ['title'])}>{title}</h1>
        <h2 className={classWithModifiers('mp-history-game__metadata', ['artist'])}>{getArtist(beatmapset)}</h2>
      </div>
      <div className='mp-history-game__mods'>
        {props.playlistItem.required_mods.map((mod) => (<Mod key={mod.acronym} mod={mod} />))}
      </div>
      <div
        className='mp-history-game__team-type'
        style={{
          backgroundImage: `url(/images/badges/team-types/${props.playlistItem.details.room_type}.svg)`,
        }}
        title={trans(`matches.match.team_types.${props.playlistItem.details.room_type}`)} />
    </a>
  );
});

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import Mod from 'components/mod';
import TimeWithTooltip from 'components/time-with-tooltip';
import BeatmapJson from 'interfaces/beatmap-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import LegacyMatchGameJson from 'interfaces/legacy-match-game-json';
import { route } from 'laroute';
import * as React from 'react';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  beatmap: BeatmapJson;
  beatmapset: BeatmapsetJson;
  game: LegacyMatchGameJson;
}

const timeFormat = 'LTS';

export default function GameHeader(props: Props) {
  let title = getTitle(props.beatmapset);
  const version = props.beatmap.version;
  if (version !== '') {
    title += ` [${version}]`;
  }

  const startTime = <TimeWithTooltip dateTime={props.game.start_time} format={timeFormat} />;
  const endTime = props.game.end_time != null
    ? <TimeWithTooltip dateTime={props.game.end_time} format={timeFormat} />
    : null;

  return (
    <a
      className='mp-history-game__header'
      href={props.beatmap.id != null ? route('beatmaps.show', { beatmap: props.beatmap.id }) : undefined}>
      <BeatmapsetCover
        beatmapset={props.beatmapset}
        modifiers='full'
        size='cover' />
      <div className='mp-history-game__header-overlay' />
      <div className='mp-history-game__stats-box'>
        {endTime != null
          ? <span className='mp-history-game__stat'>{startTime} - {endTime}</span>
          : <span className='mp-history-game__stat'>{startTime} {trans('matches.match.in-progress')}</span>}
        <span className='mp-history-game__stat'>{trans(`beatmaps.mode.${props.game.mode}`)}</span>
        <span className='mp-history-game__stat'>{trans(`matches.game.scoring-type.${props.game.scoring_type}`)}</span>
      </div>
      <div className='mp-history-game__metadata-box'>
        <h1 className={classWithModifiers('mp-history-game__metadata', ['title'])}>{title}</h1>
        <h2 className={classWithModifiers('mp-history-game__metadata', ['artist'])}>{getArtist(props.beatmapset)}</h2>
      </div>
      <div className='mp-history-game__mods'>
        {props.game.mods.map((mod) => (<Mod key={mod} mod={{ acronym: mod }} />))}
      </div>
      <div
        className='mp-history-game__team-type'
        style={{
          backgroundImage: `url(/images/badges/team-types/${props.game.team_type}.svg)`,
        }}
        title={trans(`matches.match.team-types.${props.game.team_type}`)} />
    </a>
  );
}

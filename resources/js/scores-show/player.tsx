// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Mod from 'components/mod';
import ScoreValue from 'components/score-value';
import { ScoreJsonForShow } from 'interfaces/score-json';
import * as moment from 'moment';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { displayMods } from 'utils/score-helper';

interface Props {
  score: ScoreJsonForShow;
}

export default function Player(props: Props) {
  let title: string;
  let content: React.ReactNode;

  if (
    props.score.rank_global == null ||
    props.score.rank_global === 0 ||
    (props.score.type === 'solo_score' && (!props.score.ranked || !props.score.preserve))
  ) {
    title = trans('scores.status.no_rank');
    content = '-';
  } else {
    title = '';
    content = <>#{formatNumber(props.score.rank_global)}</>;
  }

  return (
    <div className='score-player'>
      <div className='score-player__row score-player__row--score'>
        <div className='score-player__mods'>
          {displayMods(props.score).map((mod) => (
            <Mod key={mod.acronym} mod={mod} />
          ))}
        </div>

        <div className='score-player__score'>
          <ScoreValue score={props.score} />
        </div>
      </div>

      <div className='score-player__row score-player__row--player'>
        <span>
          {trans('scores.show.player.by')}
        </span>
        <strong>
          {props.score.user.username}
        </strong>
        <span>
          {trans('scores.show.player.submitted_on')}
        </span>
        <strong>
          {moment(props.score.ended_at).format('LLL')}
        </strong>
      </div>

      <div className='score-player__row score-player__row--rank'>
        <div className='score-player__rank score-player__rank--label'>
          {trans('scores.show.player.rank.global')}
        </div>
        <div className='score-player__rank score-player__rank--value'>
          <span title={title}>{content}</span>
        </div>
      </div>
    </div>
  );
}

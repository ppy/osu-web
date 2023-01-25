// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Mod from 'components/mod';
import { SoloScoreJsonForShow } from 'interfaces/solo-score-json';
import * as moment from 'moment';
import * as React from 'react';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { totalScore } from 'utils/score-helper';

interface Props {
  score: SoloScoreJsonForShow;
}

export default function Player(props: Props) {
  return (
    <div className='score-player'>
      <div className='score-player__row score-player__row--score'>
        <div className='score-player__score'>
          {formatNumber(totalScore(props.score))}
        </div>

        <div className='score-player__mods'>
          {props.score.mods.map((mod) => (
            <div key={mod.acronym} className='score-player__mod'>
              <Mod mod={mod.acronym} />
            </div>
          ))}
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
          {props.score.rank_global == null ? '-' : `#${formatNumber(props.score.rank_global)}`}
        </div>
      </div>
    </div>
  );
}

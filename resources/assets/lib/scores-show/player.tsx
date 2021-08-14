// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import Mod from 'mod';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  score: ScoreJson;
}

export default function Player(props: Props) {
  return (
    <div className='score-player'>
      <div className='score-player__row score-player__row--score'>
        <div className='score-player__score'>
          {osu.formatNumber(props.score.score)}
        </div>

        <div className='score-player__mods'>
          {props.score.mods.map((mod) => (
            <div key={mod} className='score-player__mod'>
              <Mod mod={mod} />
            </div>
          ))}
        </div>
      </div>

      <div className='score-player__row score-player__row--player'>
        <span>
          {osu.trans('scores.show.player.by')}
        </span>
        <strong>
          {props.score.user.username}
        </strong>
        <span>
          {osu.trans('scores.show.player.submitted_on')}
        </span>
        <strong>
          {moment(props.score.created_at).format('LLL')}
        </strong>
      </div>

      <div className='score-player__row score-player__row--rank'>
        <div className='score-player__rank score-player__rank--label'>
          {osu.trans('scores.show.player.rank.global')}
        </div>
        <div className='score-player__rank score-player__rank--value'>
          {props.score.rank_global == null ? '-' : `#${osu.formatNumber(props.score.rank_global)}`}
        </div>
      </div>
    </div>
  );
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import Mod from 'mod';
import { PlayDetailMenu } from 'play-detail-menu';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import TimeWithTooltip from 'time-with-tooltip';
import { getArtist, getTitle, shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { hasMenu } from 'utils/score-helper';

const bn = 'play-detail';

interface Props {
  activated: boolean;
  score: ScoreJson;
}

interface State {
  compact: boolean;
}

export default class PlayDetail extends React.PureComponent<Props, State> {
  render() {
    const score = this.props.score;
    const { beatmap, beatmapset } = score;

    if (beatmap == null || beatmapset == null) {
      throw new Error('score json is missing beatmap or beatmapset details');
    }

    const blockClass = classWithModifiers(
      bn,
      this.props.activated ? 'active' : 'highlightable',
    );

    return (
      <div className={blockClass}>
        <div className={`${bn}__group ${bn}__group--top`}>
          <div className={`${bn}__icon ${bn}__icon--main`}>
            <div className={`score-rank score-rank--full score-rank--${score.rank}`} />
          </div>

          <div className={`${bn}__detail`}>
            <a
              className={`${bn}__title u-ellipsis-overflow`}
              href={route('beatmaps.show', { beatmap: beatmap.id, mode: score.mode })}
            >
              {getTitle(beatmapset)}
              {' '}
              <small className={`${bn}__artist`}>
                {osu.trans('users.show.extra.beatmaps.by_artist', { artist: getArtist(beatmapset) })}
              </small>
            </a>
            <div className={`${bn}__beatmap-and-time`}>
              <span className={`${bn}__beatmap`}>
                {beatmap.version}
              </span>
              <span className={`${bn}__time`}>
                <TimeWithTooltip dateTime={score.created_at} relative />
              </span>
            </div>
          </div>
        </div>

        <div className={`${bn}__group ${bn}__group--bottom`}>
          <div className={`${bn}__score-detail ${bn}__score-detail--score`}>
            <div className={`${bn}__icon ${bn}__icon--extra`}>
              <div className={`score-rank score-rank--full score-rank--${score.rank}`} />
            </div>
            <div className={`${bn}__score-detail-top-right`}>
              <div className={`${bn}__accuracy-and-weighted-pp`}>
                <span className={`${bn}__accuracy`}>
                  {osu.formatNumber(score.accuracy * 100, 2)}%
                </span>
                {score.weight != null && (
                  <span className={`${bn}__weighted-pp`}>
                    {score.pp != null && `${osu.formatNumber(Math.round(score.weight.pp))}pp`}
                  </span>
                )}
              </div>

              {score.weight != null && (
                <div className={`${bn}__pp-weight`}>
                  {osu.trans('users.show.extra.top_ranks.pp_weight', {
                    percentage: `${osu.formatNumber(Math.round(score.weight.percentage))}%`,
                  })}
                </div>
              )}
            </div>
          </div>

          <div className={`${bn}__score-detail ${bn}__score-detail--mods`}>
            {score.mods.map((mod) => <Mod key={mod} mod={mod} />)}
          </div>

          <div className={`${bn}__pp`}>
            {shouldShowPp(beatmap) ? (
              <PpValue
                score={score}
                suffix={<span className={`${bn}__pp-unit`}>pp</span>}
              />
            ) : (
              <span title={osu.trans('users.show.extra.top_ranks.not_ranked')}>
                {(beatmap.status === 'loved') ? (
                  <span className='fas fa-heart'/>
                ) : (
                  '-'
                )}
              </span>
            )}
          </div>

          <div className={`${bn}__more`}>
            {hasMenu(score) && <PlayDetailMenu score={score} />}
          </div>
        </div>
      </div>
    );
  }
}

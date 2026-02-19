// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Mod from 'components/mod';
import { PlayDetailMenu } from 'components/play-detail-menu';
import TimeWithTooltip from 'components/time-with-tooltip';
import { rulesetIdToName } from 'interfaces/ruleset';
import { ScoreReplayStatsJsonForUser } from 'interfaces/score-replay-stats-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { rulesetName, shouldShowPp } from 'utils/beatmap-helper';
import { getArtist, getTitle } from 'utils/beatmapset-helper';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { accuracy, displayMods, hasMenu, rank } from 'utils/score-helper';
import { beatmapUrl } from 'utils/url';

interface Props {
  stats: ScoreReplayStatsJsonForUser;
  user: UserJson;
}

export default function ScoreReplayStatsEntry(props: Props) {
  const user = props.user;
  const stats = props.stats;
  const score = stats.score;
  const scoreRank = rank(score);
  const { beatmap, beatmapset } = score;

  return (
    <div className='play-detail'>
      <div className='play-detail__group play-detail__group--top'>
        <div className='play-detail__icon play-detail__icon--main'>
          <div className={`score-rank score-rank--full score-rank--${scoreRank}`} />
        </div>

        <div className='play-detail__detail'>
          <a
            className='play-detail__title u-ellipsis-overflow'
            href={beatmapUrl(beatmap, rulesetName(score.ruleset_id))}
          >
            {getTitle(beatmapset)}
            {' '}
            <small className='play-detail__artist'>
              {trans('users.show.extra.beatmaps.by_artist', { artist: getArtist(beatmapset) })}
            </small>
          </a>
          <div className='play-detail__beatmap-and-time'>
            <span className='play-detail__beatmap'>
              <span className={`fal fa-extra-mode-${rulesetIdToName[score.ruleset_id]}`} />
              {' '}
              {beatmap.version}
            </span>
            <span className='play-detail__time'>
              <TimeWithTooltip dateTime={score.ended_at} relative />
            </span>
          </div>
        </div>
      </div>

      <div className='play-detail__group play-detail__group--bottom'>
        <div className='play-detail__score-detail'>
          <div className='play-detail__icon play-detail__icon--extra'>
            <div className={`score-rank score-rank--full score-rank--${scoreRank}`} />
          </div>
          <div className='play-detail__score-detail-top-right'>
            <div className='play-detail__accuracy-and-weighted-pp'>
              <span className='play-detail__accuracy'>
                {formatNumber(accuracy(score), 2, { style: 'percent' })}
              </span>
              <span className='play-detail__weighted-pp'>
                {shouldShowPp(beatmap) ? (
                  <PpValue
                    score={score}
                    suffix='pp'
                  />
                ) : (
                  <span title={trans('users.show.extra.top_ranks.not_ranked')}>
                    {(beatmap.status === 'loved') ? (
                      <span className='fas fa-heart' />
                    ) : (
                      '-'
                    )}
                  </span>
                )}
              </span>
            </div>
          </div>
        </div>

        <div className='play-detail__mods-pp'>
          <div className='play-detail__mods'>
            {displayMods(score, false).map((mod) => <Mod key={mod.acronym} mod={mod} />)}
          </div>

          <div className='play-detail__pp play-detail__pp--watch-count'>
            <span>
              <small><span className='fas fa-eye' /></small>
              {' '}
              {formatNumber(stats.watch_count)}
            </span>
          </div>
        </div>

        <div className='play-detail__more'>
          {hasMenu(score) && <PlayDetailMenu score={score} user={user} />}
        </div>
      </div>
    </div>
  );
}

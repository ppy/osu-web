// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import FlagTeam from 'components/flag-team';
import Mod from 'components/mod';
import { PlayDetailMenu } from 'components/play-detail-menu';
import ScoreboardTime from 'components/scoreboard-time';
import UserLink from 'components/user-link';
import { ScoreJsonForTopPlays } from 'interfaces/score-json';
import { route } from 'laroute';
import * as React from 'react';
import { getTitle } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { displayMods, hasMenu, rank } from 'utils/score-helper';

interface Props {
  first_score_rank: number;
  ruleset_id: number;
  scores: ScoreJsonForTopPlays[];
}

export default function RankingScores(props: Props) {
  return (
    <div className='ranking-page-grid'>
      <div className='ranking-page-grid-item ranking-page-grid-item--header'>
        <div className='ranking-page-grid-item__content'>
          <div className='ranking-page-grid-item__col' />
          <div className='ranking-page-grid-item__col' />
          <div className='ranking-page-grid-item__col' />
          <div className='ranking-page-grid-item__col'>
            {trans('beatmapsets.show.scoreboard.headers.combo')}
          </div>
          <div className='ranking-page-grid-item__col'>
            {trans('beatmapsets.show.scoreboard.headers.accuracy')}
          </div>
          <div className='ranking-page-grid-item__col ranking-page-grid-item__col--number-focus'>
            {trans('beatmapsets.show.scoreboard.headers.pp')}
          </div>
          <div className='ranking-page-grid-item__col'>
            {trans('beatmapsets.show.scoreboard.headers.time')}
          </div>
          <div className='ranking-page-grid-item__col'>
            {trans('beatmapsets.show.scoreboard.headers.mods')}
          </div>
          <div className='ranking-page-grid-item__col' />
          <div className='ranking-page-grid-item__col' />
        </div>
      </div>
      {props.scores.map((score, i) => (
        <div key={score.id} className='ranking-page-grid-item'>
          <a
            className='ranking-page-grid-item__link-bg'
            href={route('scores.show', { rulesetOrScore: score.id })}
          />
          <div className='ranking-page-grid-item__content'>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--number ranking-page-grid-item__col--number-focus'>
              #{formatNumber(i + props.first_score_rank)}
            </div>
            <div className='ranking-page-table-main'>
              <span className='ranking-page-table-main__flag'>
                <span className='u-contents u-hover'>
                  <FlagCountry country={score.user.country} />
                </span>
              </span>
              {score.user.team != null &&
                <span className='ranking-page-table-main__flag'>
                  <a className='u-contents u-hover' href={route('teams.show', { team: score.user.team.id })}>
                    <FlagTeam team={score.user.team} />
                  </a>
                </span>
              }
              <UserLink
                className='ranking-page-table-main__link u-hover'
                tooltipPosition='right center'
                user={score.user}
              />
            </div>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--beatmap'>
              <a className='u-ellipsis-overflow u-hover' href={route('beatmaps.show', { beatmap: score.beatmap_id })}>
                {`${getTitle(score.beatmapset)} [${score.beatmap.version}]`}
              </a>
            </div>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--number'>
              <span className={classWithModifiers('ranking-page-grid-item__value', { perfect: score.is_perfect_combo })}>
                {formatNumber(score.max_combo)}
              </span>
            </div>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--number'>
              <span className={classWithModifiers('ranking-page-grid-item__value', { perfect: score.accuracy === 1 })}>
                {formatNumber(score.accuracy, 2, { style: 'percent' })}
              </span>
            </div>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--number ranking-page-grid-item__col--number-focus'>
              <span className='u-hover' title={formatNumber(score.pp ?? 0)}>
                {formatNumber(Math.round(score.pp ?? 0))}
              </span>
            </div>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--number'>
              <span className='u-contents u-hover'>
                <ScoreboardTime dateTime={score.ended_at} />
              </span>
            </div>
            <div className='ranking-page-grid-item__col'>
              <div className='ranking-page-grid-item__icons u-hover'>
                {displayMods(score).map((mod) => <Mod key={mod.acronym} mod={mod} modifiers='dynamic' />)}
              </div>
            </div>
            <div className='ranking-page-grid-item__col'>
              <div className='ranking-page-grid-item__icons'>
                <div className={`score-rank score-rank--${rank(score)}`} />
              </div>
            </div>
            <div className='ranking-page-grid-item__col ranking-page-grid-item__col--menu u-hover'>
              {hasMenu(score) && <PlayDetailMenu score={score} user={score.user} />}
            </div>
          </div>
        </div>
      ))}
    </div>
  );
}

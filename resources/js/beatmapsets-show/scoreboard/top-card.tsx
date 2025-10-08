// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import FlagTeam from 'components/flag-team';
import Mod from 'components/mod';
import ScorePin from 'components/score-pin';
import ScoreValue from 'components/score-value';
import ScoreboardTime from 'components/scoreboard-time';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import BeatmapJson from 'interfaces/beatmap-json';
import { ScoreJsonForBeatmap } from 'interfaces/score-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { rulesetName, shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { accuracy, displayMods, isPerfectCombo, calculateStatisticsFor, rank, scoreUrl } from 'utils/score-helper';

interface Props {
  beatmap: BeatmapJson;
  modifiers?: Modifiers;
  position?: number;
  score: ScoreJsonForBeatmap;
}

export default class TopCard extends React.PureComponent<Props> {
  render() {
    const ruleset = rulesetName(this.props.score.ruleset_id);
    const scoreAccuracy = accuracy(this.props.score);
    const avatar = <UserAvatar user={this.props.score.user} />;

    return (
      <div className={classWithModifiers('beatmap-score-top', this.props.modifiers)}>
        <a
          className='beatmap-score-top__link-container'
          href={scoreUrl(this.props.score)}
        />

        <div className='beatmap-score-top__section'>
          <div className='beatmap-score-top__wrapping-container beatmap-score-top__wrapping-container--left'>
            <div className='beatmap-score-top__position'>
              <div className='beatmap-score-top__position-number'>
                {this.props.position != null ? `#${this.props.position}` : '-'}
              </div>
              <div className={classWithModifiers('score-rank', 'tiny', rank(this.props.score))} />
            </div>

            <div className='beatmap-score-top__avatar'>
              {this.props.score.user.is_deleted ? (
                avatar
              ) : (
                <a
                  className='u-hover'
                  href={route('users.show', { mode: ruleset, user: this.props.score.user_id })}
                >
                  {avatar}
                </a>
              )}
            </div>

            <div className='beatmap-score-top__user-box'>
              <UserLink
                className='beatmap-score-top__username u-hover'
                mode={ruleset}
                user={this.props.score.user}
              />

              <div className='beatmap-score-top__achieved u-hover'>
                <StringWithComponent
                  mappings={{
                    when: <TimeWithTooltip dateTime={this.props.score.ended_at} relative />,
                  }}
                  pattern={trans('beatmapsets.show.scoreboard.achieved')}
                />
              </div>

              <div className='beatmap-score-top__flags'>
                <a
                  className='u-hover'
                  href={route('rankings', {
                    country: this.props.score.user.country_code,
                    mode: ruleset,
                    type: 'performance',
                  })}
                >
                  <FlagCountry
                    country={this.props.score.user.country}
                    modifiers='flat'
                  />
                </a>

                {this.props.score.user.team != null &&
                  <a
                    className='u-hover'
                    href={route('teams.show', { team: this.props.score.user.team.id })}
                  >
                    <FlagTeam team={this.props.score.user.team} />
                  </a>
                }
              </div>
            </div>
          </div>

          <div className='beatmap-score-top__wrapping-container beatmap-score-top__wrapping-container--right'>
            <div className='beatmap-score-top__stats'>
              {core.scorePins.canBePinned(this.props.score) &&
                <div className='beatmap-score-top__stat'>
                  <div className='beatmap-score-top__stat-header'>
                    {trans('beatmapsets.show.scoreboard.headers.pin')}
                  </div>
                  <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller u-hover'>
                    <ScorePin className='btn-osu-big' score={this.props.score} />
                  </div>
                </div>
              }

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--wider'>
                  {trans('beatmapsets.show.scoreboard.headers.score_total')}
                </div>
                <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--score'>
                  <ScoreValue score={this.props.score} />
                </div>
              </div>
            </div>

            <div className='beatmap-score-top__stats'>
              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--wider'>
                  {trans('beatmapsets.show.scoreboard.headers.accuracy')}
                </div>
                <div
                  className={classWithModifiers('beatmap-score-top__stat-value', {
                    perfect: scoreAccuracy === 1,
                  })}
                >
                  {formatNumber(scoreAccuracy * 100, 2)}%
                </div>
              </div>

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--wider'>
                  {trans('beatmapsets.show.scoreboard.headers.combo')}
                </div>
                <div
                  className={classWithModifiers('beatmap-score-top__stat-value', {
                    perfect: isPerfectCombo(this.props.score),
                  })}
                >
                  {formatNumber(this.props.score.max_combo)}x
                </div>
              </div>
            </div>

            <div className='beatmap-score-top__stats beatmap-score-top__stats--wrappable'>
              {calculateStatisticsFor(this.props.score, 'leaderboard').map((attr) => (
                <div key={attr.label.short} className='beatmap-score-top__stat'>
                  <div className='beatmap-score-top__stat-header'>
                    {attr.label.short}
                  </div>
                  <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller'>
                    {formatNumber(attr.value)}
                  </div>
                </div>
              ))}

              {shouldShowPp(this.props.beatmap) && (
                <div className='beatmap-score-top__stat'>
                  <div className='beatmap-score-top__stat-header'>
                    {trans('beatmapsets.show.scoreboard.headers.pp')}
                  </div>
                  <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller u-hover'>
                    <PpValue score={this.props.score} />
                  </div>
                </div>
              )}

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header'>
                  {trans('beatmapsets.show.scoreboard.headers.time')}
                </div>
                <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller u-hover'>
                  <ScoreboardTime dateTime={this.props.score.ended_at} />
                </div>
              </div>

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--mods'>
                  {trans('beatmapsets.show.scoreboard.headers.mods')}
                </div>
                <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--mods u-hover'>
                  {displayMods(this.props.score).map((mod) => <Mod key={mod.acronym} mod={mod} />)}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

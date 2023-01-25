// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import Mod from 'components/mod';
import ScorePin from 'components/score-pin';
import ScoreboardTime from 'components/scoreboard-time';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserAvatar from 'components/user-avatar';
import { UserLink } from 'components/user-link';
import BeatmapJson from 'interfaces/beatmap-json';
import { SoloScoreJsonForBeatmap } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { rulesetName, shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { isPerfectCombo, modeAttributesMap, scoreUrl, totalScore } from 'utils/score-helper';

interface Props {
  beatmap: BeatmapJson;
  modifiers?: Modifiers;
  position?: number;
  score: SoloScoreJsonForBeatmap;
}

export default class TopCard extends React.PureComponent<Props> {
  render() {
    const ruleset = rulesetName(this.props.score.ruleset_id);
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
              <div className={classWithModifiers('score-rank', 'tiny', this.props.score.rank)} />
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
                  {formatNumber(totalScore(this.props.score))}
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
                    perfect: this.props.score.accuracy === 1,
                  })}
                >
                  {formatNumber(this.props.score.accuracy * 100, 2)}%
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
              {modeAttributesMap[ruleset].map((attr) => (
                <div key={attr.attribute} className='beatmap-score-top__stat'>
                  <div className='beatmap-score-top__stat-header'>
                    {attr.label}
                  </div>
                  <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller'>
                    {formatNumber(this.props.score.statistics[attr.attribute] ?? 0)}
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
                  {this.props.score.mods.map((mod) => <Mod key={mod.acronym} mod={mod.acronym} />)}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

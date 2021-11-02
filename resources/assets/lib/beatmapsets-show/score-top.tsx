// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'flag-country';
import BeatmapJson from 'interfaces/beatmap-json';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import Mod from 'mod';
import * as React from 'react';
import ScoreboardTime from 'scoreboard-time';
import PpValue from 'scores/pp-value';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import UserAvatar from 'user-avatar';
import { UserLink } from 'user-link';
import { shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers, Modifiers } from 'utils/css';
import { modeAttributesMap } from 'utils/score';

interface Props {
  beatmap: BeatmapJson;
  modifiers?: Modifiers;
  position?: number;
  score: ScoreJson;
}

export default class ScoreTop extends React.PureComponent<Props> {
  render() {
    const avatar = <UserAvatar user={this.props.score.user} />;

    return (
      <div className={classWithModifiers('beatmap-score-top', this.props.modifiers)}>
        <a
          className='beatmap-score-top__link-container'
          href={route('scores.show', {
            mode: this.props.score.mode,
            score: this.props.score.best_id,
          })}
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
                  href={route('users.show', { mode: this.props.score.mode, user: this.props.score.user_id })}
                >
                  {avatar}
                </a>
              )}
            </div>

            <div className='beatmap-score-top__user-box'>
              <UserLink
                className='beatmap-score-top__username u-hover'
                mode={this.props.score.mode}
                user={this.props.score.user}
              />

              <div className='beatmap-score-top__achieved u-hover'>
                <StringWithComponent
                  mappings={{
                    when: <TimeWithTooltip dateTime={this.props.score.created_at} relative />,
                  }}
                  pattern={osu.trans('beatmapsets.show.scoreboard.achieved')}
                />
              </div>

              <a
                className='u-hover'
                href={route('rankings', {
                  country: this.props.score.user.country_code,
                  mode: this.props.score.mode,
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
              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--wider'>
                  {osu.trans('beatmapsets.show.scoreboard.headers.score_total')}
                </div>
                <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--score'>
                  {osu.formatNumber(this.props.score.score)}
                </div>
              </div>
            </div>

            <div className='beatmap-score-top__stats'>
              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--wider'>
                  {osu.trans('beatmapsets.show.scoreboard.headers.accuracy')}
                </div>
                <div
                  className={classWithModifiers('beatmap-score-top__stat-value', {
                    perfect: this.props.score.accuracy === 1,
                  })}
                >
                  {osu.formatNumber(this.props.score.accuracy * 100, 2)}%
                </div>
              </div>

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--wider'>
                  {osu.trans('beatmapsets.show.scoreboard.headers.combo')}
                </div>
                <div
                  className={classWithModifiers('beatmap-score-top__stat-value', {
                    perfect: this.props.score.max_combo === this.props.beatmap.max_combo,
                  })}
                >
                  {osu.formatNumber(this.props.score.max_combo)}x
                </div>
              </div>
            </div>

            <div className='beatmap-score-top__stats beatmap-score-top__stats--wrappable'>
              {modeAttributesMap[this.props.beatmap.mode].map((attr) => (
                <div key={attr.attribute} className='beatmap-score-top__stat'>
                  <div className='beatmap-score-top__stat-header'>
                    {attr.label}
                  </div>
                  <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller'>
                    {osu.formatNumber(this.props.score.statistics[attr.attribute])}
                  </div>
                </div>
              ))}

              {shouldShowPp(this.props.beatmap) && (
                <div className='beatmap-score-top__stat'>
                  <div className='beatmap-score-top__stat-header'>
                    {osu.trans('beatmapsets.show.scoreboard.headers.pp')}
                  </div>
                  <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller u-hover'>
                    <PpValue score={this.props.score} />
                  </div>
                </div>
              )}

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header'>
                  {osu.trans('beatmapsets.show.scoreboard.headers.time')}
                </div>
                <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--smaller u-hover'>
                  <ScoreboardTime dateTime={this.props.score.created_at} />
                </div>
              </div>

              <div className='beatmap-score-top__stat'>
                <div className='beatmap-score-top__stat-header beatmap-score-top__stat-header--mods'>
                  {osu.trans('beatmapsets.show.scoreboard.headers.mods')}
                </div>
                <div className='beatmap-score-top__stat-value beatmap-score-top__stat-value--mods u-hover'>
                  {this.props.score.mods.map((mod) => <Mod key={mod} mod={mod} />)}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

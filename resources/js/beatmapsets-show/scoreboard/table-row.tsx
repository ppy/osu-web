// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import FlagTeam from 'components/flag-team';
import Mod from 'components/mod';
import { PlayDetailMenu } from 'components/play-detail-menu';
import ScoreValue from 'components/score-value';
import ScoreboardTime from 'components/scoreboard-time';
import UserLink from 'components/user-link';
import BeatmapJson from 'interfaces/beatmap-json';
import { ScoreJsonForBeatmap } from 'interfaces/score-json';
import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { accuracy, displayMods, hasMenu, isPerfectCombo, calculateStatisticsFor, rank, scoreUrl } from 'utils/score-helper';

const bn = 'beatmap-scoreboard-table';

interface TdLinkProps {
  children?: React.ReactNode;
  href: string;
  modifiers?: Modifiers;
}

function TdLink(linkProps: TdLinkProps) {
  return (
    <td className={`${bn}__cell`}>
      <a
        className={classWithModifiers(`${bn}__cell-content`, linkProps.modifiers)}
        href={linkProps.href}
      >
        {linkProps.children}
      </a>
    </td>
  );
}

interface Props {
  activated: boolean;
  beatmap: BeatmapJson;
  highlightFriends: boolean;
  index: number;
  score: ScoreJsonForBeatmap;
  showPp: boolean;
}

@observer
export default class ScoreboardTableRow extends React.Component<Props> {
  @computed
  get scoreUrl() {
    return scoreUrl(this.props.score);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    const score = this.props.score;
    const scoreAccuracy = accuracy(score);
    const blockClass = classWithModifiers(`${bn}__body-row`,
      this.props.activated ? 'menu-active' : 'highlightable',
      {
        first: this.props.index === 0,
        friend: this.props.highlightFriends && core.currentUserModel.isFriendWith(score.user.id),
        self: score.user.id === core.currentUser?.id,
      },
    );

    return (
      <tr className={blockClass}>
        <TdLink href={this.scoreUrl} modifiers='rank'>
          {`#${this.props.index + 1}`}
        </TdLink>

        <TdLink href={this.scoreUrl} modifiers='grade'>
          <div className={classWithModifiers('score-rank', ['tiny', rank(score)])} />
        </TdLink>

        <TdLink href={this.scoreUrl} modifiers='score'>
          <ScoreValue score={score} />
        </TdLink>

        <TdLink href={this.scoreUrl} modifiers={{ perfect: scoreAccuracy === 1 }}>
          {`${formatNumber(scoreAccuracy * 100, 2)}%`}
        </TdLink>

        <td className={`${bn}__cell`}>
          {score.user.country_code != null &&
            <a
              className={`${bn}__cell-content`}
              href={route('rankings', {
                country: score.user.country_code,
                mode: this.props.beatmap.mode,
                type: 'performance',
              })}
            >
              <FlagCountry country={score.user.country} modifiers='flat' />
            </a>
          }
        </td>

        {score.user.is_deleted ? (
          <TdLink href={this.scoreUrl}>
            {trans('users.deleted')}
          </TdLink>
        ) : (
          <td className={`${bn}__cell ${bn}__cell--player u-relative`}>
            <a className={classWithModifiers(`${bn}__cell-content`, 'bg-link')} href={this.scoreUrl} />
            <span className={`${bn}__cell-content u-hover-none`}>
              {score.user.team != null &&
                <a className='u-contents u-hover' href={route('teams.show', { team: score.user.team.id })}>
                  <FlagTeam team={score.user.team} />
                </a>
              }
              <UserLink
                className={`${bn}__user-link u-hover`}
                mode={this.props.beatmap.mode}
                user={score.user}
              />
            </span>
          </td>
        )}

        <TdLink href={this.scoreUrl} modifiers={{ perfect: isPerfectCombo(score) }}>
          {`${formatNumber(score.max_combo)}x`}
        </TdLink>

        {calculateStatisticsFor(score, 'leaderboard').map((stat) => (
          <TdLink
            key={stat.label.short}
            href={this.scoreUrl}
            modifiers={{ zero: stat.value === 0 }}
          >
            {formatNumber(stat.value)}
          </TdLink>
        ))}

        {this.props.showPp &&
          <TdLink href={this.scoreUrl}>
            <PpValue score={score} />
          </TdLink>
        }

        <TdLink href={this.scoreUrl} modifiers='time'>
          <ScoreboardTime dateTime={score.ended_at} />
        </TdLink>

        <TdLink href={this.scoreUrl} modifiers='mods'>
          <div className={`${bn}__mods`}>
            {displayMods(score).map((mod) => <Mod key={mod.acronym} mod={mod} />)}
          </div>
        </TdLink>

        <td className={`${bn}__popup-menu`}>
          {hasMenu(score) && <PlayDetailMenu score={score} user={score.user} />}
        </td>
      </tr>
    );
  }
}

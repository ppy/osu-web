// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'components/flag-country';
import Mod from 'components/mod';
import { PlayDetailMenu } from 'components/play-detail-menu';
import ScoreboardTime from 'components/scoreboard-time';
import BeatmapJson from 'interfaces/beatmap-json';
import { SoloScoreJsonForBeatmap } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import PpValue from 'scores/pp-value';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { hasMenu, isPerfectCombo, modeAttributesMap, scoreUrl, totalScore } from 'utils/score-helper';

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
  score: SoloScoreJsonForBeatmap;
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
          <div className={classWithModifiers('score-rank', ['tiny', score.rank])} />
        </TdLink>

        <TdLink href={this.scoreUrl} modifiers='score'>
          {formatNumber(totalScore(score))}
        </TdLink>

        <TdLink href={this.scoreUrl} modifiers={{ perfect: score.accuracy === 1 }}>
          {`${formatNumber(score.accuracy * 100, 2)}%`}
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
            {osu.trans('users.deleted')}
          </TdLink>
        ) : (
          <td className={`${bn}__cell u-relative`}>
            <a
              className={`${bn}__cell-content ${bn}__cell-content--user-link js-usercard`}
              data-user-id={score.user.id}
              href={route('users.show', { mode: this.props.beatmap.mode, user: score.user.id })}
            >
              {score.user.username}
            </a>

            <a className={`${bn}__cell-content`} href={this.scoreUrl} />
          </td>
        )}

        <TdLink href={this.scoreUrl} modifiers={{ perfect: isPerfectCombo(score) }}>
          {`${formatNumber(score.max_combo)}x`}
        </TdLink>

        {modeAttributesMap[this.props.beatmap.mode].map((stat) => (
          <TdLink
            key={stat.attribute}
            href={this.scoreUrl}
            modifiers={{ zero: (score.statistics[stat.attribute] ?? 0) === 0 }}
          >
            {formatNumber(score.statistics[stat.attribute] ?? 0)}
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
            {score.mods.map((mod) => <Mod key={mod.acronym} mod={mod.acronym} />)}
          </div>
        </TdLink>

        <td className={`${bn}__popup-menu`}>
          {hasMenu(score) && <PlayDetailMenu score={score} user={score.user} />}
        </td>
      </tr>
    );
  }
}

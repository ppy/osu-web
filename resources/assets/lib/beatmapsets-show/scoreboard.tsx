// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { switchNever } from 'utils/switch-never';
import ScoreTop from './score-top';
import ScoreboardMod from './scoreboard-mod';
import ScoreboardTab from './scoreboard-tab';
import ScoreboardTable from './scoreboard-table';
import ScoreboardType, { scoreboardTypes } from './scoreboard-type';

const defaultMods = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'HD', 'FL', 'SO'];
const osuMods = defaultMods.concat('TD');
const maniaMods = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'FI', 'HD', 'FL', 'MR'];
const maniaKeyMods = ['4K', '5K', '6K', '7K', '8K', '9K'];

interface Props {
  beatmap: BeatmapExtendedJson;
  enabledMods: string[];
  isScoreable: boolean;
  loadingState: null | 'error' | 'loading' | 'supporter_only' | 'unranked';
  scores: ScoreJson[];
  type: ScoreboardType;
  userScore?: ScoreJson;
  userScorePosition?: number;
}

export default class Scoreboard extends React.PureComponent<Props> {
  get mods() {
    if (this.props.beatmap.mode === 'mania') {
      if (this.props.beatmap.convert) {
        return [...maniaMods, ...maniaKeyMods];
      }

      return maniaMods;
    }

    if (this.props.beatmap.mode === 'osu') {
      return osuMods;
    }

    return defaultMods;
  }

  render() {
    const enabledMods = new Set(this.props.enabledMods);

    return (
      <div className='beatmapset-scoreboard'>
        <div className='page-tabs'>
          {scoreboardTypes.map((type) => (
            <ScoreboardTab
              key={type}
              active={this.props.type === type}
              type={type}
            />
          ))}
        </div>

        {this.props.isScoreable &&
          <div className={classWithModifiers('beatmapset-scoreboard__mods', { initial: enabledMods.size === 0 })}>
            {this.mods.map((mod) => <ScoreboardMod key={mod} enabled={enabledMods.has(mod)} mod={mod} />)}
          </div>
        }

        <div className={classWithModifiers('beatmapset-scoreboard__main', { loading: this.props.loadingState === 'loading' })}>
          {this.renderMain()}
        </div>
      </div>
    );
  }

  private readonly onClickRetryButton = () => {
    $.publish('beatmapset:scoreboard:retry');
  };

  private renderEmptyMessage(key: string) {
    return (
      <p className='beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'>
        {osu.trans(`beatmapsets.show.scoreboard.no_scores.${key}`)}
      </p>
    );
  }

  private renderErrorMessage() {
    return (
      <div className='beatmapset-scoreboard__notice'>
        <p>
          {osu.trans('beatmapsets.show.scoreboard.error')}
        </p>

        <p className='beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'>
          <button className='btn-osu-big btn-osu-big--rounded-thin' onClick={this.onClickRetryButton} type='button'>
            {osu.trans('common.buttons.retry')}
          </button>
        </p>
      </div>
    );
  }

  private renderMain() {
    switch (this.props.loadingState) {
      case null:
        if (this.props.scores.length > 0) {
          return this.renderScores();
        }

        return this.renderEmptyMessage(this.props.type);

      case 'error':
        return this.renderErrorMessage();

      case 'loading':
        return this.renderEmptyMessage('loading');

      case 'unranked':
        return this.renderUnrankedMessage();

      case 'supporter_only':
        return this.renderSupporterOnlyMessage();

      default:
        switchNever(this.props.loadingState);
        throw new Error('unsupported loading state');
    }
  }

  private renderScores() {
    return (
      <div>
        <div className='beatmap-scoreboard-top'>
          <div className='beatmap-scoreboard-top__item'>
            <ScoreTop beatmap={this.props.beatmap} position={1} score={this.props.scores[0]} />
          </div>

          {this.props.userScore != null && this.props.scores[0].user.id !== this.props.userScore.user.id &&
            <div className='beatmap-scoreboard-top__item'>
              <ScoreTop beatmap={this.props.beatmap} position={this.props.userScorePosition} score={this.props.userScore} />
            </div>
          }
        </div>

        <ScoreboardTable
          beatmap={this.props.beatmap}
          scoreboardType={this.props.type}
          scores={this.props.scores}
        />
      </div>
    );
  }

  private renderSupporterOnlyMessage() {
    return (
      <div className='beatmapset-scoreboard__notice'>
        <p className='beatmapset-scoreboard__supporter-text'>
          {osu.trans('beatmapsets.show.scoreboard.supporter-only')}
        </p>

        <p className='beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'>
          <StringWithComponent
            mappings={{ here: <a href={route('support-the-game')}>{osu.trans('beatmapsets.show.scoreboard.supporter_link.here')}</a> }}
            pattern={osu.trans('beatmapsets.show.scoreboard.supporter_link._')}
          />
        </p>
      </div>
    );
  }

  private renderUnrankedMessage() {
    return (
      <p className='beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'>
        {osu.trans('beatmapsets.show.scoreboard.no_scores.unranked')}
      </p>
    );
  }
}

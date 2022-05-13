// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import { route } from 'laroute';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { switchNever } from 'utils/switch-never';
import Controller from './controller';
import ScoreTop from './score-top';
import ScoreboardMod from './scoreboard-mod';
import ScoreboardTab from './scoreboard-tab';
import ScoreboardTable from './scoreboard-table';
import { scoreboardTypes } from './scoreboard-type';

const defaultMods = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'HD', 'FL', 'SO'];
const osuMods = defaultMods.concat('TD');
const maniaMods = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'FI', 'HD', 'FL', 'MR'];
const maniaKeyMods = ['4K', '5K', '6K', '7K', '8K', '9K'];

interface Props {
  controller: Controller;
}

@observer
export default class Scoreboard extends React.Component<Props> {
  private get controller() {
    return this.props.controller;
  }

  @computed
  private get mods() {
    if (this.controller.currentBeatmap.mode === 'mania') {
      if (this.controller.currentBeatmap.convert) {
        return [...maniaMods, ...maniaKeyMods];
      }

      return maniaMods;
    }

    if (this.controller.currentBeatmap.mode === 'osu') {
      return osuMods;
    }

    return defaultMods;
  }

  private get scores() {
    return this.controller.state.scores;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <div className='beatmapset-scoreboard'>
        <div className='page-tabs'>
          {scoreboardTypes.map((type) => (
            <ScoreboardTab
              key={type}
              controller={this.controller}
              type={type}
            />
          ))}
        </div>

        {this.controller.currentBeatmap.is_scoreable &&
          <div className={classWithModifiers('beatmapset-scoreboard__mods', { initial: this.controller.enabledMods.size === 0 })}>
            {this.mods.map((mod) => <ScoreboardMod key={mod} controller={this.controller} mod={mod} />)}
          </div>
        }

        <div className={classWithModifiers('beatmapset-scoreboard__main', {
          loading: this.controller.state.scoreLoadingState === 'loading',
        })}>
          {this.renderMain()}
        </div>
      </div>
    );
  }

  private readonly onClickRetryButton = () => {
    this.controller.setCurrentScoreboard({ forceReload: true });
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
    switch (this.controller.state.scoreLoadingState) {
      case null:
        if (this.scores.scores.length > 0) {
          return this.renderScores();
        }

        return this.renderEmptyMessage(this.controller.state.currentScoreboardType);

      case 'error':
        return this.renderErrorMessage();

      case 'loading':
        return this.renderEmptyMessage('loading');

      case 'unranked':
        return this.renderUnrankedMessage();

      case 'supporter_only':
        return this.renderSupporterOnlyMessage();

      default:
        switchNever(this.controller.state.scoreLoadingState);
        throw new Error('unsupported loading state');
    }
  }

  private renderScores() {
    return (
      <div>
        <div className='beatmap-scoreboard-top'>
          <div className='beatmap-scoreboard-top__item'>
            <ScoreTop
              beatmap={this.controller.currentBeatmap}
              position={1}
              score={this.scores.scores[0]}
            />
          </div>

          {this.scores.user_score != null && this.scores.scores[0].user.id !== this.scores.user_score.score.user.id &&
            <div className='beatmap-scoreboard-top__item'>
              <ScoreTop
                beatmap={this.controller.currentBeatmap}
                position={this.scores.user_score.position}
                score={this.scores.user_score.score}
              />
            </div>
          }
        </div>

        <ScoreboardTable controller={this.controller} />
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

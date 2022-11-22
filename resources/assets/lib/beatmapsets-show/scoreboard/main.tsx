// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { route } from 'laroute';
import { computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { switchNever } from 'utils/switch-never';
import Controller from './controller';
import Mod from './mod';
import { scoreboardTypes } from './scoreboard-type';
import Tab from './tab';
import Table from './table';
import TopCard from './top-card';

const defaultMods = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'HD', 'FL', 'SO'];
const osuMods = defaultMods.concat('TD');
const maniaMods = ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'FI', 'HD', 'FL', 'MR'];
const maniaKeyMods = ['4K', '5K', '6K', '7K', '8K', '9K'];

interface Props {
  beatmap: BeatmapExtendedJson;
  container: HTMLElement;
}

@observer
export default class Main extends React.Component<Props> {
  @observable private controller: Controller;

  private get data() {
    return this.controller.data;
  }

  @computed
  private get mods() {
    if (this.controller.beatmap.mode === 'mania') {
      if (this.controller.beatmap.convert) {
        return [...maniaMods, ...maniaKeyMods];
      }

      return maniaMods;
    }

    if (this.controller.beatmap.mode === 'osu') {
      return osuMods;
    }

    return defaultMods;
  }

  constructor(props: Props) {
    super(props);
    this.controller = new Controller(this.props.container, () => this.props.beatmap);

    makeObservable(this);
  }

  render() {
    return (
      <div className='beatmapset-scoreboard'>
        <div className='page-tabs'>
          {scoreboardTypes.map((type) => (
            <Tab
              key={type}
              controller={this.controller}
              type={type}
            />
          ))}
        </div>

        {this.controller.beatmap.is_scoreable &&
          <div className={classWithModifiers('beatmapset-scoreboard__mods', { initial: this.controller.enabledMods.size === 0 })}>
            {this.mods.map((mod) => <Mod key={mod} controller={this.controller} mod={mod} />)}
          </div>
        }

        <div className={classWithModifiers('beatmapset-scoreboard__main', {
          loading: this.controller.loadingState === 'loading',
        })}>
          {this.renderMain()}
        </div>
      </div>
    );
  }

  private readonly onClickRetryButton = () => {
    this.controller.setCurrent({ forceReload: true });
  };

  private renderEmptyMessage(key: string) {
    return (
      <p className='beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'>
        {trans(`beatmapsets.show.scoreboard.no_scores.${key}`)}
      </p>
    );
  }

  private renderErrorMessage() {
    return (
      <div className='beatmapset-scoreboard__notice'>
        <p>
          {trans('beatmapsets.show.scoreboard.error')}
        </p>

        <p className='beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'>
          <button className='btn-osu-big btn-osu-big--rounded-thin' onClick={this.onClickRetryButton} type='button'>
            {trans('common.buttons.retry')}
          </button>
        </p>
      </div>
    );
  }

  private renderMain() {
    switch (this.controller.loadingState) {
      case null:
        if (this.data.scores.length > 0) {
          return this.renderScores();
        }

        return this.renderEmptyMessage(this.controller.currentType);

      case 'error':
        return this.renderErrorMessage();

      case 'loading':
        return this.renderEmptyMessage('loading');

      case 'unranked':
        return this.renderUnrankedMessage();

      case 'supporter_only':
        return this.renderSupporterOnlyMessage();

      default:
        switchNever(this.controller.loadingState);
        throw new Error('unsupported loading state');
    }
  }

  private renderScores() {
    return (
      <div>
        <div className='beatmap-scoreboard-top'>
          <div className='beatmap-scoreboard-top__item'>
            <TopCard
              beatmap={this.controller.beatmap}
              position={1}
              score={this.data.scores[0]}
            />
          </div>

          {this.data.user_score != null && this.data.scores[0].user.id !== this.data.user_score.score.user.id &&
            <div className='beatmap-scoreboard-top__item'>
              <TopCard
                beatmap={this.controller.beatmap}
                position={this.data.user_score.position}
                score={this.data.user_score.score}
              />
            </div>
          }
        </div>

        <Table controller={this.controller} />
      </div>
    );
  }

  private renderSupporterOnlyMessage() {
    return (
      <div className='beatmapset-scoreboard__notice'>
        <p className='beatmapset-scoreboard__supporter-text'>
          {trans('beatmapsets.show.scoreboard.supporter-only')}
        </p>

        <p className='beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'>
          <StringWithComponent
            mappings={{ here: <a href={route('support-the-game')}>{trans('beatmapsets.show.scoreboard.supporter_link.here')}</a> }}
            pattern={trans('beatmapsets.show.scoreboard.supporter_link._')}
          />
        </p>
      </div>
    );
  }

  private renderUnrankedMessage() {
    return (
      <p className='beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'>
        {trans('beatmapsets.show.scoreboard.no_scores.unranked')}
      </p>
    );
  }
}

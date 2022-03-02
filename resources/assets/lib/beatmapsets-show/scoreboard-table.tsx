// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreboardTableRow from 'beatmapsets-show/scoreboard-table-row';
import BeatmapJson from 'interfaces/beatmap-json';
import ScoreJson from 'interfaces/score-json';
import { action, computed, observable, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { shouldShowPp } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';
import { modeAttributesMap } from 'utils/score-helper';
import ScoreboardType from './scoreboard-type';

const bn = 'beatmap-scoreboard-table';

interface Props {
  beatmap: BeatmapJson;
  scoreboardType: ScoreboardType;
  scores: ScoreJson[];
}

@observer
export default class ScoreboardTable extends React.Component<Props> {
  @observable activeKey: number | null = null;
  private readonly containerContextValue: {
    activeKeyDidChange: (key: number | null) => void;
  };

  @computed
  get showPp() {
    return shouldShowPp(this.props.beatmap);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    this.containerContextValue = { activeKeyDidChange: this.activeKeyDidChange };
  }

  render() {
    return (
      <ContainerContext.Provider value={this.containerContextValue}>
        <div className={classWithModifiers(bn, { 'menu-active': this.activeKey != null })}>
          <table className={`${bn}__table`}>
            <thead>
              <tr>
                <th className={`${bn}__header ${bn}__header--rank`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.rank')}
                </th>
                <th className={`${bn}__header ${bn}__header--grade`} />
                <th className={`${bn}__header ${bn}__header--score`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.score')}
                </th>
                <th className={`${bn}__header ${bn}__header--accuracy`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.accuracy')}
                </th>
                <th className={`${bn}__header ${bn}__header--flag`} />
                <th className={`${bn}__header ${bn}__header--player`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.player')}
                </th>
                <th className={`${bn}__header ${bn}__header--maxcombo`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.combo')}
                </th>
                {modeAttributesMap[this.props.beatmap.mode].map((stat) => (
                  <th
                    key={stat.attribute}
                    className={classWithModifiers(`${bn}__header`, ['hitstat', `hitstat-${stat.attribute}`])}
                  >
                    {stat.label}
                  </th>
                ))}
                {this.showPp &&
                  <th className={`${bn}__header ${bn}__header--pp`}>
                    {osu.trans('beatmapsets.show.scoreboard.headers.pp')}
                  </th>
                }
                <th className={`${bn}__header ${bn}__header--time`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.time')}
                </th>
                <th className={`${bn}__header ${bn}__header--mods`}>
                  {osu.trans('beatmapsets.show.scoreboard.headers.mods')}
                </th>
                <th className={`${bn}__header ${bn}__header--popup-menu`} />
              </tr>
            </thead>
            <tbody className={`${bn}__body`}>
              {this.props.scores.map((score, index) => (
                <KeyContext.Provider key={index} value={index}>
                  <ScoreboardTableRow
                    activated={this.activeKey === index}
                    beatmap={this.props.beatmap}
                    highlightFriends={this.props.scoreboardType !== 'friend'}
                    index={index}
                    score={score}
                    showPp={this.showPp}
                  />
                </KeyContext.Provider>
              ))}
            </tbody>
          </table>
        </div>
      </ContainerContext.Provider>
    );
  }

  @action
  private activeKeyDidChange = (key: number | null) => {
    this.activeKey = key;
  };
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import PlayDetail from 'play-detail';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { classWithModifiers } from 'utils/css';

interface Props {
  scores: ScoreJson[];
}

interface State {
  activeKey: number | null;
}

export default class PlayDetailList extends React.PureComponent<Props, State> {
  state: Readonly<State> = {
    activeKey: null,
  };

  render() {
    const uniqueScores = new Map<number, ScoreJson>();
    this.props.scores.forEach((score) => uniqueScores.set(score.id, score));

    return (
      <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
        <div className={classWithModifiers('play-detail-list', { 'menu-active': this.state.activeKey != null })}>
          {[...uniqueScores].map(([key, score]) => (
            <KeyContext.Provider key={key} value={key}>
              <PlayDetail activated={this.state.activeKey === key} score={score} />
            </KeyContext.Provider>
          ))}
        </div>
      </ContainerContext.Provider>
    );
  }

  private activeKeyDidChange = (key: number | null) => {
    this.setState({ activeKey: key });
  };
}

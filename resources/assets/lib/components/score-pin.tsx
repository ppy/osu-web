// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';

interface Props {
  className: string;
  onUpdate?: () => void;
  score: ScoreJson;
}

@observer
export default class ScorePin extends React.Component<Props> {
  @computed
  private get isPinned() {
    return core.scorePins.isPinned(this.props.score);
  }

  @computed
  private get label() {
    const targetState = this.isPinned ? '0' : '1';

    return osu.trans(`users.show.extra.top_ranks.pin.to_${targetState}`);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <button className={this.props.className} onClick={this.onClick} type='button'>
        {this.label}
      </button>
    );
  }

  private readonly onClick = () => {
    const targetState = this.isPinned ? '0' : '1';

    core.scorePins.apiPin(this.props.score, !this.isPinned)
      .done(() => {
        osu.popup(osu.trans(`users.show.extra.top_ranks.pin.to_${targetState}_done`), 'info');
        this.props.onUpdate?.();
      }).fail(onErrorWithCallback(this.onClick));
  };
}

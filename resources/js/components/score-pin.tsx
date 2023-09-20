// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import SoloScoreJson from 'interfaces/solo-score-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';
import { popup } from 'utils/popup';

interface Props {
  className: string;
  onUpdate?: () => void;
  score: SoloScoreJson;
}

@observer
export default class ScorePin extends React.Component<Props> {
  private onUpdateCallbacks: {
    done: Props['onUpdate'];
    fail: ReturnType<typeof onErrorWithCallback>;
  } | null = null;

  @computed
  private get isPinned() {
    return core.scorePins.isPinned(this.props.score);
  }

  @computed
  private get label() {
    const targetState = this.isPinned ? '0' : '1';

    return trans(`users.show.extra.top_ranks.pin.to_${targetState}`);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.onUpdateCallbacks = null;
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
    this.onUpdateCallbacks = {
      done: this.props.onUpdate,
      fail: onErrorWithCallback(this.onClick),
    };

    core.scorePins.apiPin(this.props.score, !this.isPinned)
      .done(() => {
        popup(trans(`users.show.extra.top_ranks.pin.to_${targetState}_done`), 'info');
        this.onUpdateCallbacks?.done?.();
      }).fail((xhr, status) => this.onUpdateCallbacks?.fail(xhr, status));
  };
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionsStateWorker from './discussions-state-worker';

interface Props {
  worker: DiscussionsStateWorker;
}

@observer
export default class Refresh extends React.PureComponent<Props> {
  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <button
        className={classWithModifiers('floating-toolbar-button', { updates: this.props.worker.hasUpdates })}
        data-tooltip-float='fixed'
        disabled={!this.props.worker.hasUpdates}
        onClick={this.handleClick}
        title={trans(`beatmap_discussions.refresh.${this.props.worker.state}`)}
      >
        <i className='fas fa-rotate' />
        {this.props.worker.busy ? (
          <Spinner />
        ) : (
          <span className='fas fa-sync-alt' />
        )}
      </button>
    );
  }

  @action
  private readonly handleClick = () => {
    this.props.worker.refresh();
  };
}

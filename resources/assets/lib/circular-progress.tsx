// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from './utils/css';

interface Props {
  countUp: boolean;
  current: number;
  ignoreProgress: boolean;
  max: number;
  onlyShowAsWarning: boolean;
  theme: string;
  tooltip?: string;
}

export class CircularProgress extends React.PureComponent<Props, any> {
  static defaultProps = {
    countUp: false,
    ignoreProgress: false,
    onlyShowAsWarning: false,
    theme: '',
  };

  bn = 'circular-progress';

  render() {
    const bn = this.bn;
    const percentage = Math.min(1, this.props.current / this.props.max);
    const warnThreshold = 0.75;

    if (this.props.onlyShowAsWarning && percentage < warnThreshold) {
      return null;
    }

    const displayNumber = this.props.countUp
      ? this.props.current
      : this.props.max - this.props.current;

    const transform = this.props.ignoreProgress
      ? undefined
      : { transform: `rotate(${percentage}turn)` };

    return (
      <div
        className={classWithModifiers(bn, {
          over: percentage === 1,
          over50: percentage > 0.5,
          warn: percentage >= warnThreshold && percentage < 1,
          [this.props.theme]: osu.present(this.props.theme),
        })}
        title={this.props.tooltip || `${this.props.current} / ${this.props.max}`}
      >
        <div className={`${bn}__label`}>{displayNumber}</div>
        <div className={`${bn}__slice`}>
          <div className={`${bn}__circle`} style={transform} />
          <div className={`${bn}__circle ${bn}__circle--fill`} />
        </div>
      </div>
    );
  }
}

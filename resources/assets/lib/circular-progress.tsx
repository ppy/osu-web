// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

interface Props {
  current: number;
  max: number;
  onlyShowAsWarning?: boolean;
  theme?: string;
  tooltip?: string;
}

export class CircularProgress extends React.PureComponent<Props, any> {
  bn = 'circular-progress';

  render() {
    const bn = this.bn;
    const percentage = Math.min(1, this.props.current / this.props.max);
    const rotation = `${360 * percentage}deg`;
    const mods = [];
    const warnThreshold = 0.75;

    if (this.props.onlyShowAsWarning && percentage < warnThreshold) {
      return null;
    }

    if (percentage > 0.5) {
      mods.push('over50');
    }

    if (percentage === 1) {
      mods.push('over');
    } else if (percentage >= warnThreshold) {
      mods.push('warn');
    }

    if (this.props.theme) {
      mods.push(this.props.theme);
    }

    return (
      <div
        className={osu.classWithModifiers(bn, mods)}
        title={this.props.tooltip || `${this.props.current} / ${this.props.max}`}
      >
        <div className={`${bn}__label`}>{this.props.max - this.props.current}</div>
        <div className={`${bn}__slice`}>
          <div
            className={`${bn}__bar`}
            style={{
              transform: `rotate(${rotation})`,
            }}
          />
          <div className={`${bn}__fill`} />
        </div>
      </div>
    );
  }
}

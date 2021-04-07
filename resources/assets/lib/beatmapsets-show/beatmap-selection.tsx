// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { generate as generateHash } from 'utils/beatmapset-page-hash';

interface Props {
  active: boolean;
  beatmap: BeatmapJsonExtended;
}

export default class BeatmapSelection extends React.Component<Props> {

  render() {
    let className = 'beatmapset-beatmap-picker__beatmap';
    if (this.props.active) {
      className += ' beatmapset-beatmap-picker__beatmap--active';
    }

    return (
      <a
        className={className}
        onClick={this.onClick}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        href={generateHash({ beatmap: this.props.beatmap })}
      >
        <BeatmapIcon beatmap={this.props.beatmap} modifier='beatmapset' showTitle={false} />
      </a>
    );
  }
  private onClick = (e: React.SyntheticEvent) => {
    e.preventDefault();

    if (this.props.active) return;

    $.publish('beatmapset:beatmap:set', { beatmap: this.props.beatmap });
  }

  private onMouseEnter = () => {
    $.publish('beatmapset:hoveredbeatmap:set', this.props.beatmap);
  }

  private onMouseLeave = () => {
    $.publish('beatmapset:hoveredbeatmap:set', null);
  }
}

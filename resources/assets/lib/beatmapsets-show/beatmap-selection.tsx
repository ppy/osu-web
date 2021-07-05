// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapIcon } from 'beatmap-icon';
import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import * as React from 'react';
import { getDiffRating } from 'utils/beatmap-helper';
import { generate as generateHash } from 'utils/beatmapset-page-hash';
import { classWithModifiers } from 'utils/css';

interface Props {
  active: boolean;
  beatmap: BeatmapJsonExtended;
}

export default class BeatmapSelection extends React.PureComponent<Props> {
  render() {
    const className = classWithModifiers('beatmapset-beatmap-picker__beatmap', { active: this.props.active });

    return (
      <a
        className={className}
        href={generateHash({ beatmap: this.props.beatmap })}
        onClick={this.onClick}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        style={{
          '--stripe-colour': `var(--diff-${getDiffRating(this.props.beatmap.difficulty_rating)})`,
        } as React.CSSProperties}
      >
        <BeatmapIcon beatmap={this.props.beatmap} modifier='beatmapset' showTitle={false} />
      </a>
    );
  }

  private onClick = (e: React.SyntheticEvent) => {
    e.preventDefault();

    if (this.props.active) return;

    $.publish('beatmapset:beatmap:set', { beatmap: this.props.beatmap });
  };

  private onMouseEnter = () => {
    $.publish('beatmapset:hoveredbeatmap:set', this.props.beatmap);
  };

  private onMouseLeave = () => {
    $.publish('beatmapset:hoveredbeatmap:set', null);
  };
}

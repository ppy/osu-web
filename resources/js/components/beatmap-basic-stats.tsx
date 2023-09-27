// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import { formatDuration, formatNumber } from 'utils/html';
import { trans } from 'utils/lang';

const bn = 'beatmap-basic-stats';

const statKeys = ['total_length', 'bpm', 'count_circles', 'count_sliders'] as const;
type StatKey = typeof statKeys[number];

interface Props {
  beatmap: BeatmapExtendedJson;
  beatmapset: BeatmapsetJson;
}

@observer
export default class BeatmapBasicStats extends React.Component<Props> {
  render() {
    return (
      <div className={bn}>
        {statKeys.map(this.renderEntry)}
      </div>
    );
  }

  private readonly renderEntry = (key: StatKey) => {
    const titleParams: Partial<Record<string, string>> = {};
    let titleAppend = '';
    const rawValue = this.props.beatmap[key];
    let value: string;

    switch (key) {
      case 'bpm': {
        if (rawValue > 1000) {
          value = '∞';
        }

        const offset = this.props.beatmapset.offset;
        if (offset !== 0) {
          titleAppend += ` (${trans('beatmapsets.show.stats.offset', { offset: formatNumber(offset) })})`;
        }
        break;
      }
      case 'total_length':
        value = formatDuration(this.props.beatmap[key]);
        titleParams.hit_length = formatDuration(this.props.beatmap.hit_length);
        break;
    }

    value ??= formatNumber(rawValue);

    return (
      <div
        key={key}
        className={`${bn}__entry`}
        title={`${trans(`beatmapsets.show.stats.${key}`, titleParams)}${titleAppend}`}
      >
        <div
          className={`${bn}__entry-icon`}
          style={{
            backgroundImage: `url(/images/layout/beatmapset-page/${key}.svg)`,
          }}
        />
        <span>{value}</span>
      </div>
    );
  };
}

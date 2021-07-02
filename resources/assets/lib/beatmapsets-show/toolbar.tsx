// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as React from 'react';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
  currentBeatmap: BeatmapJsonExtended;
}

export default class Toolbar extends React.PureComponent<Props> {
  render() {
    return (
      <div className='beatmapset-toolbar'>
        <div className='beatmapset-toolbar__count'>
          <div>
            <div>
              {osu.trans('beatmapsets.show.details.count.total_play')}
            </div>
            <div className='beatmapset-toolbar__count-value'>
              {osu.formatNumber(this.props.beatmapset.play_count)}
            </div>
          </div>

          <div>
            <div>
              {osu.trans('beatmapsets.show.details.count.diff_play')}
            </div>
            <div className='beatmapset-toolbar__count-value'>
              {osu.formatNumber(this.props.currentBeatmap.playcount)}
            </div>
          </div>
        </div>
      </div>
    );
  }
}

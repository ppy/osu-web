// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson } from 'beatmapsets/beatmapset-json';
import * as React from 'react';
import { group as groupBeatmaps } from 'utils/beatmap-helper';

interface Props {
  beatmapset: BeatmapsetJson;
  onClose: () => void;
}

interface State {
  selectedBeatmapIds: number[];
}

export default class LoveConfirmation extends React.PureComponent<Props, State> {
  constructor(props: Props) {
    super(props);

    this.state = {
      selectedBeatmapIds: this.props.beatmapset.beatmaps?.map((beatmap) => beatmap.id) ?? [],
    };
  }

  render() {
    const groupedBeatmaps = [...groupBeatmaps(this.props.beatmapset.beatmaps ?? [])];

    return (
      <div className='love-confirmation'>
        <div className='love-confirmation__row love-confirmation__row--title'>
          Choose difficulties to be loved
        </div>

        <div className='love-confirmation__row love-confirmation__row--content'>
          <ul className='love-confirmation__difficulty-list'>
            {groupedBeatmaps.map(([, beatmaps]) => (
              beatmaps.map((beatmap) => (
                <li
                  key={beatmap.id}
                  className='love-confirmation__difficulty-list-item'
                >
                  <label className='osu-switch-v2'>
                    <input
                      checked={this.state.selectedBeatmapIds.includes(beatmap.id)}
                      className='osu-switch-v2__input'
                      onChange={this.handleCheckboxChange}
                      type='checkbox'
                      value={beatmap.id}
                    />
                    <span className='osu-switch-v2__content' />
                    <div className='love-confirmation__difficulty-name'>
                      {beatmap.version}
                    </div>
                  </label>
                </li>
              ))
            ))}
          </ul>
        </div>

        <div className='love-confirmation__row love-confirmation__row--footer'>
          <button
            className='btn-osu-big btn-osu-big--rounded-thin'
            type='button'
          >
            Loved
          </button>

          <button
            className='btn-osu-big btn-osu-big--rounded-thin'
            onClick={this.props.onClose}
            type='button'
          >
            {osu.trans('common.buttons.close')}
          </button>
        </div>
      </div>
    );
  }

  private handleCheckboxChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const beatmapId = parseInt(e.target.value, 10);

    const idx = this.state.selectedBeatmapIds.indexOf(beatmapId);
    const newSelectedIds = [...this.state.selectedBeatmapIds];

    if (idx >= 0) {
      newSelectedIds.splice(idx, 1);
    } else {
      newSelectedIds.push(beatmapId);
    }

    this.setState({ selectedBeatmapIds: [...newSelectedIds] });
  };

}

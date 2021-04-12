// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapGroup } from 'beatmapset-panel';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import * as React from 'react';
import { TransitionStatus } from 'react-transition-group';
import { getDiffRating } from 'utils/beatmap-helper';

interface Props {
  groupedBeatmaps: BeatmapGroup[];
  onMouseEnter: () => void;
  onMouseLeave: () => void;
  state: TransitionStatus;
  transitionDuration: number;
}

const beatmapsPopupTransitionStyles: Record<TransitionStatus, React.CSSProperties> = {
  entered: { opacity: 1 },
  entering: {},
  exited: {},
  exiting: {},
  unmounted: {},
};

@observer
export default class BeatmapsPopup extends React.Component<Props> {
  render() {
    return (
      <div
        className='beatmaps-popup'
        onMouseEnter={this.props.onMouseEnter}
        onMouseLeave={this.props.onMouseLeave}
        style={{
          opacity: 0,
          transitionDuration: `${this.props.transitionDuration}ms`,
          ...beatmapsPopupTransitionStyles[this.props.state],
        }}
      >
        <div className='beatmaps-popup__content'>
          {this.props.groupedBeatmaps.map(({ beatmaps, mode }: BeatmapGroup) => (
            <div key={mode} className='beatmaps-popup__group'>
              {beatmaps.map((beatmap) => (
                <a
                  className='beatmaps-popup-item'
                  href={route('beatmaps.show', { beatmap: beatmap.id })}
                  key={beatmap.id}
                >
                  <span className='beatmaps-popup-item__col beatmaps-popup-item__col--mode'>
                    <span className={`fal fa-extra-mode-${beatmap.mode}`} />
                  </span>
                  <span
                    className='beatmaps-popup-item__col beatmaps-popup-item__col--difficulty'
                    style={{
                      '--bg': `var(--diff-${getDiffRating(beatmap.difficulty_rating)})`,
                    } as React.CSSProperties}
                  >
                    <span className='beatmaps-popup-item__difficulty-icon'>
                      <span className='fas fa-star' />
                    </span>
                    {osu.formatNumber(beatmap.difficulty_rating, 2)}
                  </span>
                  <span className='beatmaps-popup-item__col beatmaps-popup-item__col--name'>
                    {beatmap.version}
                  </span>
                </a>
              ))}
            </div>
          ))}
        </div>
      </div>
    );
  }
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapGroup } from 'beatmapset-panel';
import BeatmapJson from 'interfaces/beatmap-json';
import { route } from 'laroute';
import { observer } from 'mobx-react';
import { Portal } from 'portal';
import * as React from 'react';
import { TransitionStatus } from 'react-transition-group';
import { getDiffRating } from 'utils/beatmap-helper';

interface Props {
  groupedBeatmaps: BeatmapGroup[];
  onMouseEnter: () => void;
  onMouseLeave: () => void;
  parent: HTMLElement | null;
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

const Item = observer(({ beatmaps, mode }: BeatmapGroup) => (
  <div className='beatmaps-popup__group'>
    {beatmaps.map((beatmap) => <ItemRow key={beatmap.id} beatmap={beatmap} />)}
  </div>
));

const ItemRow = observer(({ beatmap }: { beatmap: BeatmapJson }) => (
  <a
    className='beatmaps-popup-item'
    href={route('beatmaps.show', { beatmap: beatmap.id })}
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
    <span className='beatmaps-popup-item__col beatmaps-popup-item__col--name u-ellipsis-overflow'>
      {beatmap.version}
    </span>
  </a>
));

@observer
export default class BeatmapsPopup extends React.Component<Props> {
  contentRef = React.createRef<HTMLDivElement>();

  render() {
    const style: React.CSSProperties = {
      opacity: 0,
      transitionDuration: `${this.props.transitionDuration}ms`,
      ...beatmapsPopupTransitionStyles[this.props.state],
    };

    if (this.props.parent != null) {
      const parentRects = this.props.parent.getBoundingClientRect();

      style.top = `${window.scrollY + parentRects.bottom}px`;
      style.left = `${window.scrollX + parentRects.left}px`;
      style.width = `${parentRects.width}px`;
    }

    return (
      <Portal>
        <div
          ref={this.contentRef}
          className='beatmaps-popup'
          onMouseEnter={this.props.onMouseEnter}
          onMouseLeave={this.props.onMouseLeave}
          style={style}
        >
          <div className='beatmaps-popup__content'>
            {this.props.groupedBeatmaps.map((props) => <Item key={props.mode} {...props} />)}
          </div>
        </div>
      </Portal>
    );
  }
}

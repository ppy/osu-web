// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapJsonExtended from 'interfaces/beatmap-json-extended';
import GameMode from 'interfaces/game-mode';
import { sumBy } from 'lodash';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmaps: Map<GameMode, BeatmapJsonExtended[]>;
  counts?: Partial<Record<GameMode, number>>;
  currentMode: GameMode;
  hrefFunc?: (mode: GameMode) => string;
}

export default class PlaymodeTabs extends React.Component<Props> {
  render() {
    return (
      <div className='game-mode game-mode--beatmapsets'>
        <ul className='game-mode__items'>
          {[...this.props.beatmaps].map(([mode, beatmaps]) => {
            const disabled = beatmaps.length === 0;

            const linkClass = classWithModifiers('game-mode-link', {
              active: mode === this.props.currentMode,
              disabled,
            });

            const count = this.count(mode);

            return (
              <li key={mode} className='game-mode__item'>
                <a
                  className={linkClass}
                  data-disabled={disabled.toString()}
                  data-mode={mode}
                  href={this.props.hrefFunc?.(mode) ?? '#'}
                  onClick={this.switchMode}
                >
                  {osu.trans(`beatmaps.mode.${mode}`)}
                  {count != null && <span className='game-mode-link__badge'>{count}</span>}
                </a>
              </li>
            );
          })}
        </ul>
      </div>
    );
  }

  private count = (mode: GameMode) => {
    if (this.props.counts?.[mode] != null) {
      return this.props.counts[mode];
    }

    const count = sumBy(this.props.beatmaps.get(mode), (beatmap) => beatmap.convert ? 0 : 1);

    return count > 0 ? count : undefined;
  };

  private switchMode = (e: React.MouseEvent<HTMLAnchorElement>) => {
    e.preventDefault();
    const target = e.currentTarget;

    const mode = target.dataset.mode as GameMode;

    if (this.props.currentMode === mode) return;
    if (target.dataset.disabled === 'true') return;

    $.publish('playmode:set', { mode });
  };
}

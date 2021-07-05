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
  iconLink: boolean;
}

export default class PlaymodeTabs extends React.Component<Props> {
  static defaultProps = {
    iconLink: false,
  };

  render() {
    return (
      <div
        className={classWithModifiers('game-mode', {
          beatmapsets: true,
          icon: this.props.iconLink,
        })}
      >
        <ul className={classWithModifiers('game-mode__items', { icon: this.props.iconLink })}>
          {[...this.props.beatmaps].map(([mode, beatmaps]) => {
            const disabled = beatmaps.length === 0;

            const linkClass = classWithModifiers('game-mode-link', {
              active: mode === this.props.currentMode,
              disabled,
              icon: this.props.iconLink,
            });

            const count = this.count(mode);

            return (
              <li
                key={mode}
                className={classWithModifiers('game-mode__item', {
                  icon: this.props.iconLink,
                })}
              >
                <a
                  className={linkClass}
                  data-disabled={disabled.toString()}
                  data-mode={mode}
                  href={this.props.hrefFunc?.(mode) ?? '#'}
                  onClick={this.switchMode}
                >
                  {
                    this.props.iconLink ? (
                      <i className={`fal fa-extra-mode-${mode}`} />
                    ) : (
                      <>
                        {osu.trans(`beatmaps.mode.${mode}`)}
                        {count != null && <span className='game-mode-link__badge'>{count}</span>}
                      </>
                    )
                  }
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

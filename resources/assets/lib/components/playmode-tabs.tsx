// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Entry {
  count?: number;
  disabled: boolean;
  href?: string;
  mode: GameMode;
}

interface Props {
  currentMode: GameMode;
  defaultMode?: GameMode;
  entries: Entry[];
  onClick?: (event: React.MouseEvent<HTMLAnchorElement>, mode: GameMode) => void;
}

export default class PlaymodeTabs extends React.Component<Props> {
  render() {
    return (
      <ul className='game-mode'>
        {this.props.entries.map((entry) => (
          <li key={entry.mode}>
            <a
              className={classWithModifiers('game-mode-link', {
                active: entry.mode === this.props.currentMode,
                disabled: entry.disabled,
              })}
              data-disabled={entry.disabled ? '1' : '0'}
              data-mode={entry.mode}
              href={entry.href == null || entry.disabled ? '#' : entry.href}
              onClick={this.onClick}
            >
              <span
                className={`fal fa-extra-mode-${entry.mode}`}
                title={entry.disabled ? undefined : osu.trans(`beatmaps.mode.${entry.mode}`)}
              />
              {entry.mode === this.props.defaultMode &&
                <span
                  className='game-mode-link__icon'
                  title={osu.trans('users.show.edit.default_playmode.is_default_tooltip')}
                >
                  <span className='fas fa-star' />
                </span>
              }
              {entry.count != null && <span className='game-mode-link__badge'>{entry.count}</span>}
            </a>
          </li>
        ))}
      </ul>
    );
  }

  private readonly onClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    const target = e.currentTarget;
    const mode = target.dataset.mode as GameMode;

    if (this.props.currentMode !== mode && target.dataset.disabled !== '1') {
      this.props.onClick?.(e, mode);

      return;
    }

    e.preventDefault();
  };
}

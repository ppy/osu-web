// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GameMode from 'interfaces/game-mode';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';

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
  modifiers?: Modifiers;
  onClick?: (event: React.MouseEvent<HTMLAnchorElement>, mode: GameMode) => void;
}

export default class PlaymodeTabs extends React.Component<Props> {
  render() {
    return (
      <ul className={classWithModifiers('game-mode', this.props.modifiers)}>
        {this.props.entries.map(this.renderLink)}
      </ul>
    );
  }

  private readonly onClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    const target = e.currentTarget;
    const mode = target.dataset.mode as GameMode;

    if (this.props.currentMode !== mode) {
      this.props.onClick?.(e, mode);

      return;
    }

    e.preventDefault();
  };

  private readonly renderLink = (entry: Entry) => {
    const content = (
      <>
        <span
          className={`fal fa-extra-mode-${entry.mode}`}
          title={entry.disabled ? undefined : trans(`beatmaps.mode.${entry.mode}`)}
        />
        {entry.mode === this.props.defaultMode &&
          <span
            className='game-mode-link__icon'
            title={trans('users.show.edit.default_playmode.is_default_tooltip')}
          >
            <span className='fas fa-star' />
          </span>
        }
        {entry.count != null && <span className='game-mode-link__badge'>{entry.count}</span>}
      </>
    );

    const className = classWithModifiers('game-mode-link', {
      active: entry.mode === this.props.currentMode,
      disabled: entry.disabled,
    });

    return (
      <li key={entry.mode}>
        {entry.disabled
          ? <span className={className}>{content}</span>
          : (
            <a
              className={className}
              data-mode={entry.mode}
              href={entry.href ?? '#'}
              onClick={this.onClick}
            >
              {content}
            </a>
          )}
      </li>
    );
  };
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { getInt } from 'utils/math';
import { isValidMode, Mode } from './markdown-editor';

interface Props {
  id: number;
  mode?: Mode;
  onModeChange: (id: number, mode: Mode) => void;
}

@observer
export default class MarkdownEditorSwitcher extends React.Component<Props> {
  render() {
    const currentMode = this.props.mode ?? 'write';

    return (
      <ul className='header-nav-v4 header-nav-v4--list header-nav-v4--wide'>
        {['write', 'preview'].map((mode) => (
          <li key={mode} className='header-nav-v4__item'>
            <button
              className={classWithModifiers('header-nav-v4__link', { active: mode === currentMode })}
              data-id={this.props.id}
              data-mode={mode}
              onClick={this.handleClick}
            >
              {mode}
            </button>
          </li>
        ))}
      </ul>
    );
  }

  @action
  private handleClick = (event: React.SyntheticEvent<HTMLButtonElement>) => {
    const id = getInt(event.currentTarget.dataset.id);
    const mode = event.currentTarget.dataset.mode;
    if (id == null || !isValidMode(mode)) return;
    this.props.onModeChange(id, mode);
  };
}

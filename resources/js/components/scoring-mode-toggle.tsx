// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

const icon = {
  classic: 'fas fa-check-square',
  standardised: 'far fa-square',
};
const toggledMode = {
  classic: 'standardised',
  standardised: 'classic',
} as const;

interface Props {
  className: string;
}

@observer
export default class ScoringModeToggle extends React.Component<Props> {
  render() {
    return (
      <button
        className={this.props.className}
        onClick={this.handleClick}
        title={trans('layout.popup_user.links.scoring_mode_toggle_tooltip')}
        type='button'
      >
        <span>
          <span className={icon[core.userPreferences.get('scoring_mode')]} />
          {' ' + trans('layout.popup_user.links.scoring_mode_toggle')}
        </span>
      </button>
    );
  }

  private handleClick(this: void) {
    core.userPreferences.set('scoring_mode', toggledMode[core.userPreferences.get('scoring_mode')]);
  }
}

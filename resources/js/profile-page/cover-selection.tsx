// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserCoverPresetJson from 'interfaces/user-cover-preset-json';
import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, Modifiers, urlPresence } from 'utils/css';
import { trans } from 'utils/lang';
import Controller from './controller';

const bn = 'profile-cover-selection';

interface Props {
  controller: Controller;
  modifiers?: Modifiers;
  preset: Partial<UserCoverPresetJson>;
}

@observer
export default class CoverSelection extends React.PureComponent<Props> {
  private get isSelected() {
    return this.props.controller.currentCoverPresetId === this.props.preset.id;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <button
        className={classWithModifiers(bn, this.props.modifiers)}
        onClick={this.onClick}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        style={{
          backgroundImage: urlPresence(this.props.preset.url),
        }}
      >
        {this.isSelected && (
          <span className='profile-cover-selection__selected'>
            <span className='far fa-check-circle' />
          </span>
        )}
      </button>
    );
  }

  @action
  private readonly onClick = () => {
    if (this.props.preset.url == null || this.isSelected) return;

    if (this.props.controller.holdoverCoverPreset != null && !confirm(trans('users.show.edit.cover.holdover_remove_confirm'))) {
      return;
    }

    this.props.controller.apiSetCover(this.props.preset.id ?? -1);
  };

  private readonly onMouseEnter = () => {
    if (this.props.preset.url == null) return;

    this.props.controller.debouncedSetDisplayCoverUrl(this.props.preset.url);
    this.props.controller.debouncedSetDisplayCoverUrl.flush();
  };

  private readonly onMouseLeave = () => {
    this.props.controller.debouncedSetDisplayCoverUrl(null);
  };
}

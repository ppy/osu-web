// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, Modifiers, urlPresence } from 'utils/css';
import { trans } from 'utils/lang';
import Controller from './controller';

const bn = 'profile-cover-selection';

interface Props {
  confirmUpdate: boolean;
  controller: Controller;
  id: number;
  isSelected: boolean;
  modifiers?: Modifiers;
  url: string | null;
}

@observer
export default class CoverSelection extends React.PureComponent<Props> {
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
          backgroundImage: urlPresence(this.props.url),
        }}
      >
        {this.props.isSelected && (
          <span className='profile-cover-selection__selected'>
            <span className='far fa-check-circle' />
          </span>
        )}
      </button>
    );
  }

  @action
  private readonly onClick = () => {
    if (this.props.url == null || this.props.isSelected) return;

    if (this.props.confirmUpdate && !confirm(trans('users.show.edit.cover.holdover_remove_confirm'))) {
      return;
    }

    this.props.controller.apiSetCover(this.props.id);
  };

  private readonly onMouseEnter = () => {
    if (this.props.url == null) return;

    this.props.controller.debouncedSetDisplayCoverUrl(this.props.url);
    this.props.controller.debouncedSetDisplayCoverUrl.flush();
  };

  private readonly onMouseLeave = () => {
    this.props.controller.debouncedSetDisplayCoverUrl(null);
  };
}

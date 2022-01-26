// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import Controller from './controller';

const bn = 'profile-cover-selection';

interface Props {
  controller: Controller;
  isSelected: boolean;
  modifiers?: Modifiers;
  name: string;
  thumbUrl: string | null;
  url: string | null;
}

@observer
export default class CoverSelection extends React.PureComponent<Props> {
  render() {
    return (
      <button
        className={classWithModifiers(bn, this.props.modifiers)}
        onClick={this.onClick}
        onMouseEnter={this.onMouseEnter}
        onMouseLeave={this.onMouseLeave}
        style={{
          backgroundImage: osu.urlPresence(this.props.thumbUrl),
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

  private readonly onClick = () => {
    if (this.props.url == null) return;

    this.props.controller.apiSetCover(this.props.name);
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

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import Controller from './controller';
import CoverSelector from './cover-selector';
import HueSelector from './hue-selector';

interface Props {
  controller: Controller;
}

export default class ProfileEditPopup extends React.PureComponent<Props> {
  render() {
    return (
      <div className='profile-edit-popup'>
        <CoverSelector controller={this.props.controller} />
        <HueSelector controller={this.props.controller} />
      </div>
    );
  }
}

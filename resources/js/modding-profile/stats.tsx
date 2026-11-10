// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserModdingProfileJson from 'interfaces/user-modding-profile-json';
import * as React from 'react';
import Beatmapsets from './beatmapsets';
import Modding from './modding';

interface Props {
  user: UserModdingProfileJson;
}

export default class Stats extends React.PureComponent<Props> {
  render() {
    return (
      <div className='modding-profile-stats'>
        <Modding user={this.props.user} />
        <Beatmapsets user={this.props.user} />
      </div>
    );
  }
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';
import DetailBarButtons from 'profile-page/detail-bar-buttons';
import * as React from 'react';

interface Props {
  user: UserExtendedJson;
}

export default class DetailBarColumns extends React.Component<Props> {
  render() {
    return (
      <>
        <div className='profile-detail-bar__column'>
          <DetailBarButtons user={this.props.user} />
        </div>
        {this.props.children != null && (
          <div className='profile-detail-bar__column profile-detail-bar__column--right'>
            {this.props.children}
          </div>
        )}
      </>
    );
  }
}

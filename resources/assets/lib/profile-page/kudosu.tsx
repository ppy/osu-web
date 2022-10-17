// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageKudosu from 'components/profile-page-kudosu';
import * as React from 'react';
import ExtraPageProps from './extra-page-props';

export default class Kudosu extends React.Component<ExtraPageProps> {
  render() {
    return (
      <ProfilePageKudosu
        kudosu={this.props.controller.state.lazy.kudosu}
        name={this.props.name}
        total={this.props.controller.state.user.kudosu.total}
        userId={this.props.controller.state.user.id}
        withEdit={this.props.controller.withEdit}
      />
    );
  }
}

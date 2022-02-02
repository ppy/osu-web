// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import { observer } from 'mobx-react';
import * as React from 'react';
import Controller from './controller';
import GameModeSwitcher from './game-mode-switcher';
import headerLinks from './header-links';

interface Props {
  controller: Controller;
}

@observer
export default class Header extends React.Component<Props> {
  render() {
    return (
      <HeaderV4
        backgroundImage={this.props.controller.displayCoverUrl}
        isCoverUpdating={this.props.controller.isUpdatingCover}
        links={headerLinks(this.props.controller.state.user, 'show')}
        theme='users'
        titleAppend={<GameModeSwitcher controller={this.props.controller} />}
      />
    );
  }
}

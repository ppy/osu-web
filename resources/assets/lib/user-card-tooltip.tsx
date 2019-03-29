/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as React from 'react';
import { activeKeyDidChange, ContainerContext, KeyContext, State as ActiveKeyState } from 'stateful-activation-context';
import { TooltipContext } from 'tooltip-context';
import { UserCard } from 'user-card';

declare global {
  interface Window {
    tooltipWithActiveMenu?: React.Component;
  }
}

interface PropsInterface {
  container: HTMLElement;
  lookup: string;
}

interface StateInterface extends ActiveKeyState {
  user?: User;
}

/**
 * This component's job is to get the data and bootstrap the actual UserCard component for tooltips.
 */
export class UserCardTooltip extends React.PureComponent<PropsInterface, StateInterface> {
  readonly activeKeyDidChange = (key: any) => {
    window.tooltipWithActiveMenu = key;
    activeKeyDidChange.bind(this)(key);
  }

  readonly state: StateInterface = {};

  componentDidMount() {
    this.getUser().then((user) => {
      this.setState({ user });
    });
  }

  getUser() {
    const url = laroute.route('users.card', { user: this.props.lookup });

    return $.ajax({
      dataType: 'json',
      type: 'GET',
      url,
    });
  }

  render() {
    const activated = this.state.activeKey === this.props.lookup;

    return (
      <TooltipContext.Provider value={this.props.container}>
        <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
          <KeyContext.Provider key={this.props.lookup} value={this.props.lookup}>
            <UserCard activated={activated} user={this.state.user} />
          </KeyContext.Provider>
        </ContainerContext.Provider>
      </TooltipContext.Provider>
    );
  }
}

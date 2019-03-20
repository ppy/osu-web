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

interface Props {
  render(renderProps: RenderProps): React.ReactFragment;
}

interface RenderProps {
  state: State;
  willUpdate(params: State): void; // a callback to update the activated state of the wrapper.
}

interface State {
  // activeIndex?: any;
  active: boolean;
  key: any;
}

/**
 * A wrapper component for tracking which menu in a list is 'active'.
 * TODO: should probably move to a context provider.
 */
export class StatefulActivation extends React.PureComponent<Props, State> {
  readonly state: State = {
    active: false,
    key: null,
  };

  render() {
    const { state, willUpdate } = this;
    return (
      <>
        {this.props.render({ state, willUpdate })}
      </>
    );
  }
  willUpdate = (params: State) => {
    this.setState({
      active: params.active,
      key: params.active ? params.key : null,
    });
  }
}

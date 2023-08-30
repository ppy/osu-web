// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import * as React from 'react';
import type { Modifiers } from 'utils/css';
import CommentsController from './comments-controller';
import { Sort } from './sort';

interface Props {
  controller: CommentsController;
  modifiers?: Modifiers;
}

@observer
export default class CommentsSort extends React.Component<Props> {
  render() {
    return (
      <Sort
        currentValue={this.props.controller.nextState.sort ?? this.props.controller.state.sort}
        modifiers={this.props.modifiers}
        onChange={this.handleChange}
        values={['new', 'old', 'top']}
      />
    );
  }

  private readonly handleChange = (e: React.MouseEvent<HTMLButtonElement>) => {
    this.props.controller.apiSetSort(e.currentTarget.dataset.value ?? '');
  };
}

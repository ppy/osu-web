// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import type { Modifiers } from 'utils/css';
import { Sort } from './sort';

const uiState = core.dataStore.uiState;

interface Props {
  modifiers?: Modifiers;
}

@observer
export default class CommentsSort extends React.Component<Props> {
  render() {
    return (
      <Sort
        currentValue={uiState.comments.loadingSort ?? uiState.comments.currentSort}
        modifiers={this.props.modifiers}
        onChange={this.handleChange}
        values={['new', 'old', 'top']}
      />
    );
  }

  private handleChange(this: void, e: React.MouseEvent<HTMLButtonElement>) {
    $.publish('comments:sort', { sort: e.currentTarget.dataset.value });
  }
}

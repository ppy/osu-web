// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetCardSize } from 'beatmapset-panel';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

const icon = {
  extra: 'fas fa-th-large',
  normal: 'fas fa-th',
};

interface Props {
  classElement: string;
  size: BeatmapsetCardSize;
}

@observer
export default class BeatmapsetCardViewSelector extends React.Component<Props> {
  @computed
  private get isActive() {
    return this.props.size === core.userPreferences.get('beatmapset_card_size');
  }

  render() {
    return (
      <button
        className={classWithModifiers(this.props.classElement, { active: this.isActive, button: true })}
        onClick={this.handleClick}
        type='button'
      >
        <span className={icon[this.props.size]} />
      </button>
    );
  }

  private handleClick = () => {
    void core.userPreferences.set('beatmapset_card_size', this.props.size);
  };
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import SelectOptions from 'components/select-options';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { getInt } from 'utils/math';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
}

@observer
export default class BeatmapList extends React.PureComponent<Props> {
  @computed
  private get options() {
    const beatmaps = this.props.discussionsState.groupedBeatmaps.get(this.props.discussionsState.currentBeatmap.mode) ?? [];

    return beatmaps.map((beatmap) => {
      const count = this.props.discussionsState.unresolvedDiscussionCounts.byBeatmap[beatmap.id];
      return {
        href: makeUrl({ beatmap, filter: this.props.discussionsState.currentFilter }),
        id: beatmap.id,
        text: (
          <BeatmapListItem
            beatmap={beatmap}
            beatmapUrl={makeUrl({ beatmap, filter: this.props.discussionsState.currentFilter })}
            beatmapset={this.props.discussionsState.beatmapset}
            count={count}
            showNonGuestOwner={false}
            showOwners
          />
        ),
      };
    });
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  render() {
    return (
      <SelectOptions
        href={makeUrl({ beatmap: this.props.discussionsState.currentBeatmap })}
        modifiers='beatmap-list'
        onSelect={this.handleSelect}
        options={this.options}
        selected={this.props.discussionsState.currentBeatmapId}
      >
        <BeatmapListItem beatmap={this.props.discussionsState.currentBeatmap} modifiers='large' showOwners={false} />
      </SelectOptions>
    );
  }

  @action
  private readonly handleSelect = (id?: string) => {
    const beatmapId = getInt(id);
    if (beatmapId == null) return;

    this.props.discussionsState.currentBeatmapId = beatmapId;
    this.props.discussionsState.changeDiscussionPage('timeline');
  };
}

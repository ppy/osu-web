// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { kebabCase, snakeCase } from 'lodash';
import { computed } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { Filter } from './current-discussions';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
}

const bn = 'counter-box';
const statTypes: Filter[] = ['mine', 'mapperNotes', 'resolved', 'pending', 'praises', 'deleted', 'total'];

@observer
export default class TypeFilters extends React.Component<Props> {
  @computed
  private get discussionCounts() {
    const counts: Partial<Record<Filter, number>> = {};
    const selectedUserId = this.props.discussionsState.selectedUserId;

    for (const type of statTypes) {
      let discussions = this.props.discussionsState.discussionsByFilter[type];
      if (selectedUserId != null) {
        discussions = discussions.filter((discussion) => discussion.user_id === selectedUserId);
      }

      counts[type] = discussions.length;
    }

    return counts;
  }

  render() {
    return statTypes.map(this.renderType);
  }

  private readonly renderType = (type: Filter) => {
    if ((type === 'deleted') && !core.currentUser?.is_admin) {
      return null;
    }

    let topClasses = classWithModifiers(bn, 'beatmap-discussions', kebabCase(type));
    if (this.props.discussionsState.currentPage !== 'events' && this.props.discussionsState.currentFilter === type) {
      topClasses += ' js-active';
    }

    return (
      <a
        key={type}
        className={topClasses}
        data-type={type}
        href={makeUrl({
          beatmapId: this.props.discussionsState.currentBeatmap.id,
          beatmapsetId: this.props.discussionsState.beatmapset.id,
          filter: type,
          mode: this.props.discussionsState.currentPage,
        })}
        onClick={this.setFilter}
      >
        <div className={`${bn}__content`}>
          <div className={`${bn}__title`}>
            {trans(`beatmaps.discussions.stats.${snakeCase(type)}`)}
          </div>
          <div className={`${bn}__count`}>
            {this.discussionCounts[type]}
          </div>
        </div>
        <div className={`${bn}__line`} />
      </a>
    );
  };

  private readonly setFilter = (event: React.SyntheticEvent<HTMLElement>) => {
    event.preventDefault();
    this.props.discussionsState.changeFilter(event.currentTarget.dataset.type);
  };
}


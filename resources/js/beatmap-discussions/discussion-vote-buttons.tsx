// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { createTooltip } from 'components/user-list-popup';
import { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import DiscussionsState from './discussions-state';

const voteTypes = ['up', 'down'] as const;
type VoteType = typeof voteTypes[number];

interface Props {
  cannotVote: boolean;
  discussion: BeatmapsetDiscussionJsonForShow;
  discussionsState: DiscussionsState;
  users: Map<number | null | undefined, UserJson>;
}

@observer
export default class DiscussionVoteButtons extends React.Component<Props> {
  private readonly tooltipDisposers: Partial<Record<VoteType, () => void>> = {};
  @observable private voteXhr: JQuery.jqXHR<BeatmapsetWithDiscussionsJson> | null = null;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentWillUnmount() {
    this.voteXhr?.abort();
    Object.values(this.tooltipDisposers).forEach((disposer) => disposer?.());
  }

  render() {
    return voteTypes.map((type) => (
      <div
        key={type}
        data-type={type}
        onMouseOver={this.handleHover}
        onTouchStart={this.handleHover}
      >
        {this.renderVote(type)}
      </div>
    ));
  }

  @action
  private readonly handleClick = (e: React.MouseEvent<HTMLButtonElement>) => {
    if (this.voteXhr != null) return;

    showLoadingOverlay();

    this.voteXhr = $.ajax(route('beatmapsets.discussions.vote', { discussion: this.props.discussion.id }), {
      data: {
        beatmap_discussion_vote: {
          score: e.currentTarget.dataset.score,
        },
      },
      method: 'PUT',
    });

    this.voteXhr
      .done((beatmapset) => this.props.discussionsState.update({ beatmapset }))
      .fail(onError)
      .always(action(() => {
        hideLoadingOverlay();
        this.voteXhr = null;
      }));
  };

  private readonly handleHover = (event: React.MouseEvent<HTMLDivElement> | React.TouchEvent<HTMLDivElement>) => {
    const target = event.currentTarget;
    const type = target.dataset.type as VoteType;

    this.tooltipDisposers[type] ??= createTooltip(
      () => target,
      () => {
        const count = this.props.discussion.votes[type];

        return {
          count,
          title: count < 1
            ? trans(`beatmaps.discussions.votes.none.${type}`)
            : `${trans(`beatmaps.discussions.votes.latest.${type}`)}:`,
          users: this.props.discussion.votes.voters[type].map((id) => this.props.users.get(id) ?? { id }),
        };

      },
      'top center',
    );
  };

  private renderVote(type: VoteType) {
    const [baseScore, icon] = type === 'up' ? [1, 'thumbs-up'] : [-1, 'thumbs-down'];
    const currentVote = this.props.discussion.current_user_attributes?.vote_score;
    const score = currentVote === baseScore ? 0 : baseScore;
    const disabled = this.voteXhr != null || this.props.cannotVote;

    return (
      <button
        className={classWithModifiers('beatmap-discussion-vote', type, { inactive: score !== 0 })}
        data-score={score}
        disabled={disabled}
        onClick={this.handleClick}
      >
        <i className={`fas fa-${icon}`} />
        <span className='beatmap-discussion-vote__count'>{this.props.discussion.votes[type]}</span>
      </button>
    );
  }
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapListItem from 'components/beatmap-list-item';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import UserJson from 'interfaces/user-json';
import { action, autorun, computed, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { blackoutToggle } from 'utils/blackout';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { nextVal } from 'utils/seq';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
  users: Map<number | null | undefined, UserJson>;
}

@observer
export default class BeatmapList extends React.Component<Props> {
  private readonly eventId = `beatmapset-discussions-show-beatmap-list-${nextVal()}`;
  @observable private showingSelector = false;

  @computed
  private get beatmaps() {
    return this.props.discussionsState.groupedBeatmaps.get(this.props.discussionsState.currentBeatmap.mode) ?? [];
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
    disposeOnUnmount(this, autorun(() => {
      blackoutToggle(this, this.showingSelector);
    }));
  }

  componentDidMount() {
    $(document).on(`click.${this.eventId}`, this.onDocumentClick);
    $(document).on(`turbo:before-cache.${this.eventId}`, this.handleBeforeCache);
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
    blackoutToggle(this, false);
  }

  render() {
    return (
      <div className={classWithModifiers('beatmap-list', { selecting: this.showingSelector })}>
        <div className='beatmap-list__body'>
          <a
            className='beatmap-list__item beatmap-list__item--selected beatmap-list__item--large js-beatmap-list-selector'
            href={makeUrl({ beatmap: this.props.discussionsState.currentBeatmap })}
            onClick={this.toggleSelector}
          >
            <BeatmapListItem beatmap={this.props.discussionsState.currentBeatmap} modifiers='large' showOwners={false} />
            <div className='beatmap-list__item-selector-button'>
              <span className='fas fa-chevron-down' />
            </div>
          </a>

          <div className='beatmap-list__selector-container'>
            <div className='beatmap-list__selector'>
              {this.beatmaps.map(this.beatmapListItem)}
            </div>
          </div>
        </div>
      </div>
    );
  }

  private readonly beatmapListItem = (beatmap: BeatmapExtendedJson) => {
    const count = this.props.discussionsState.unresolvedDiscussionCounts.byBeatmap[beatmap.id];

    return (
      <div
        key={beatmap.id}
        className={classWithModifiers('beatmap-list__item', { current: beatmap.id === this.props.discussionsState.currentBeatmap.id })}
        data-id={beatmap.id}
        onClick={this.selectBeatmap}
      >
        <BeatmapListItem
          beatmap={beatmap}
          beatmapUrl={makeUrl({ beatmap, filter: this.props.discussionsState.currentFilter })}
          beatmapset={this.props.discussionsState.beatmapset}
          showNonGuestOwner={false}
          showOwners
        />
        {count != null &&
          <div className='beatmap-list__item-count'>
            {formatNumber(count)}
          </div>
        }
      </div>
    );
  };

  @action
  private readonly handleBeforeCache = () => {
    this.setShowingSelector(false);
  };

  @action
  private readonly onDocumentClick = (e: JQuery.ClickEvent) => {
    if (e.button !== 0) return;

    if ($(e.target).closest('.js-beatmap-list-selector').length) {
      return;
    }

    this.setShowingSelector(false);
  };

  @action
  private readonly selectBeatmap = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    e.preventDefault();

    const beatmapId = parseInt(e.currentTarget.dataset.id ?? '', 10);

    this.props.discussionsState.currentBeatmapId = beatmapId;
    this.props.discussionsState.changeDiscussionPage('timeline');
  };

  @action
  private setShowingSelector(state: boolean) {
    this.showingSelector = state;
  }

  @action
  private readonly toggleSelector = (e: React.MouseEvent<HTMLElement>) => {
    if (e.button !== 0) return;
    e.preventDefault();

    this.setShowingSelector(!this.showingSelector);
  };
}

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import ShowMoreLink from 'components/show-more-link';
import { ScoreCurrentUserPinJson } from 'interfaces/score-json';
import { SoloScoreJsonForUser } from 'interfaces/solo-score-json';
import { action, autorun, computed, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';
import { TopScoreSection } from './extra-page-props';
import PlayDetail from './play-detail';

type ScoreSections = TopScoreSection | 'scoresRecent';

const sectionMaps = {
  scoresBest: {
    key: 'best',
    showPpWeight: true,
    translationKey: 'top_ranks.best',
  },
  scoresFirsts: {
    key: 'firsts',
    translationKey: 'top_ranks.first',
  },
  scoresPinned: {
    key: 'pinned',
    translationKey: 'top_ranks.pinned',
  },
  scoresRecent: {
    key: 'recent',
    translationKey: 'historical.recent_plays',
  },
} as const;

interface Props {
  controller: Controller;
  section: ScoreSections;
}

@observer
export default class PlayDetailList extends React.Component<Props> {
  @observable activeKey: number | null = null;
  private readonly containerContextValue: {
    activeKeyDidChange: (key: number | null) => void;
  };
  private readonly listRef = React.createRef<HTMLDivElement>();

  @computed
  private get scores() {
    return this.sectionMap.key === 'recent' ? this.props.controller.state.historical.recent : this.props.controller.state.topScores[this.sectionMap.key];
  }

  @computed
  private get sectionMap() {
    return sectionMaps[this.props.section];
  }

  @computed
  private get withPinSortable() {
    return this.props.section === 'scoresPinned' && this.props.controller.withEdit;
  }

  @computed
  private get uniqueItems() {
    const ret = new Map<number, SoloScoreJsonForUser>();
    this.scores.items.forEach((item) => ret.set(item.id, item));

    return [...ret.values()];
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    // Do this after makeObservable call to make sure it's the decorated version of the function.
    this.containerContextValue = { activeKeyDidChange: this.activeKeyDidChange };
  }

  componentDidMount() {
    disposeOnUnmount(this, autorun(() => {
      const list = this.listRef.current;
      const enablePinSortable = this.withPinSortable;

      if (list != null) {
        const $list = $(list);

        if (enablePinSortable) {
          $list.sortable({
            cursor: 'move',
            handle: '.js-score-pin-sortable-handle',
            items: '.js-score-pin-sortable',
            scrollSpeed: 10,
            update: this.onUpdatePinOrder,
          });
        } else {
          if ($list.sortable('instance') != null) {
            $list.sortable('destroy');
          }
        }
      }
    }));
  }

  render() {
    const showPpWeight = 'showPpWeight' in this.sectionMap && this.sectionMap.showPpWeight;

    return (
      <>
        <ProfilePageExtraSectionTitle
          count={this.scores.count}
          titleKey={`users.show.extra.${this.sectionMap.translationKey}.title`}
        />

        <ContainerContext.Provider value={this.containerContextValue}>
          <div ref={this.listRef} className={`${classWithModifiers('play-detail-list', { 'menu-active': this.activeKey != null })} u-relative`}>
            {(this.uniqueItems).map((score) => (
              <KeyContext.Provider key={score.id} value={score.id}>
                <PlayDetail
                  activated={this.activeKey === score.id}
                  score={score}
                  showPinSortableHandle={this.withPinSortable}
                  showPpWeight={showPpWeight}
                />
              </KeyContext.Provider>
            ))}
          </div>
        </ContainerContext.Provider>

        <ShowMoreLink
          {...this.scores.pagination}
          callback={this.onShowMore}
          data={this.props.section}
          modifiers='profile-page'
        />
      </>
    );
  }

  @action
  private activeKeyDidChange = (key: number | null) => {
    this.activeKey = key;
  };

  private onShowMore = () => {
    this.props.controller.apiShowMore(this.props.section);
  };

  private onUpdatePinOrder = (event: Event, ui: JQueryUI.SortableUIParams) => {
    if (!Array.isArray(this.scores.items)) {
      throw new Error('trying to update pin order with missing data');
    }

    const target = event.target;

    if (target == null) return;

    const $target = $(target);
    const newOrder = $target.sortable('toArray', { attribute: 'data-score-pin' }).map((jsonString) => JSON.parse(jsonString) as ScoreCurrentUserPinJson);

    const reordered = JSON.parse(ui.item.attr('data-score-pin') ?? '') as ScoreCurrentUserPinJson;
    const currentIndex = this.scores.items.findIndex((item) => item.id === reordered.score_id);
    const newIndex = newOrder.findIndex((item) => item.score_id === reordered.score_id);

    if (currentIndex !== newIndex) {
      this.props.controller.apiReorderScorePin(currentIndex, newIndex);
    }
  };
}

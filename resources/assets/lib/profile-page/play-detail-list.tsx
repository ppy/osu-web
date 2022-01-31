// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import ShowMoreLink from 'components/show-more-link';
import ScoreJson, { ScoreCurrentUserPinJson } from 'interfaces/score-json';
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
    countKey: 'scores_best_count',
    showPpWeight: true,
    translationKey: 'top_ranks.best',
  },
  scoresFirsts: {
    countKey: 'scores_first_count',
    translationKey: 'top_ranks.first',
  },
  scoresPinned: {
    countKey: 'scores_pinned_count',
    translationKey: 'top_ranks.pinned',
  },
  scoresRecent: {
    countKey: 'scores_recent_count',
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
  private get paginatorJson() {
    return this.props.controller.paginatorJson(this.props.section);
  }

  @computed
  private get withPinSortable() {
    return this.props.section === 'scoresPinned' && this.props.controller.withEdit;
  }

  @computed
  private get uniqueItems() {
    if (!Array.isArray(this.paginatorJson.items)) return [];

    const ret = new Map<number, ScoreJson>();
    this.paginatorJson.items.forEach((item) => ret.set(item.id, item));

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
    if (!Array.isArray(this.paginatorJson.items)) {
      return <p>{this.paginatorJson.items.error}</p>;
    }

    const sectionMap = sectionMaps[this.props.section];
    const showPpWeight = 'showPpWeight' in sectionMap && sectionMap.showPpWeight;

    return (
      <>
        <ProfilePageExtraSectionTitle
          count={this.props.controller.state.user[sectionMap.countKey]}
          titleKey={`users.show.extra.${sectionMap.translationKey}.title`}
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
          {...this.paginatorJson.pagination}
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
    if (!Array.isArray(this.paginatorJson.items)) {
      throw new Error('trying to update pin order with missing data');
    }

    const target = event.target;

    if (target == null) return;

    const $target = $(target);
    const newOrder = $target.sortable('toArray', { attribute: 'data-score-pin' }).map((jsonString) => JSON.parse(jsonString) as ScoreCurrentUserPinJson);

    const reordered = JSON.parse(ui.item.attr('data-score-pin') ?? '') as ScoreCurrentUserPinJson;
    const currentIndex = this.paginatorJson.items.findIndex((item) => item.id === reordered.score_id);
    const newIndex = newOrder.findIndex((item) => item.score_id === reordered.score_id);

    if (currentIndex !== newIndex) {
      this.props.controller.apiReorderScorePin(currentIndex, newIndex);
    }
  };
}

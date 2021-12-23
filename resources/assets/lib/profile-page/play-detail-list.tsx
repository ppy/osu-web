// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import ScoreJson, { ScoreCurrentUserPinJson } from 'interfaces/score-json';
import { action, autorun, computed, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';
import { TopScoreSection } from './extra-page-props';
import PlayDetail from './play-detail';

type ScoreSections = TopScoreSection | 'scoresRecent';

const sectionMaps = {
  scoresBest: {
    count: 'scores_best_count',
    translationKey: 'top_ranks.best',
  },
  scoresFirsts: {
    count: 'scores_first_count',
    translationKey: 'top_ranks.first',
  },
  scoresPinned: {
    count: 'scores_pinned_count',
    translationKey: 'top_ranks.pinned',
  },
  scoresRecent: {
    count: 'scores_recent_count',
    translationKey: 'historical.recent_plays',
  },
} as const;

interface Props {
  controller: Controller;
  section: ScoreSections;
}

interface State {
  activeKey: number | null;
}

@observer
export default class PlayDetailList extends React.Component<Props, State> {
  @observable activeKey: number | null = null;
  private listRef = React.createRef<HTMLDivElement>();

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

    const { count, translationKey } = sectionMaps[this.props.section];

    return (
      <>
        <ProfilePageExtraSectionTitle
          count={this.props.controller.state.user[count]}
          titleKey={`users.show.extra.${translationKey}.title`}
        />

        <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
          <div ref={this.listRef} className={classWithModifiers('play-detail-list', { 'menu-active': this.activeKey != null })}>
            {(this.uniqueItems).map((score) => (
              <KeyContext.Provider key={score.id} value={score.id}>
                <PlayDetail
                  activated={this.activeKey === score.id}
                  score={score}
                  showPinSortableHandle={this.withPinSortable}
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

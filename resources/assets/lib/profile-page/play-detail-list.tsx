// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import { ContainerContext, KeyContext } from 'stateful-activation-context';
import { classWithModifiers } from 'utils/css';
import Controller from './controller';
import { TopScoreSection } from './extra-page-props';
import PlayDetail from './play-detail';

interface Props {
  controller: Controller;
  section: TopScoreSection | 'scoresRecent';
}

interface State {
  activeKey: number | null;
}

@observer
export default class PlayDetailList extends React.Component<Props, State> {
  @observable activeKey: number | null = null;

  @computed
  private get paginatorJson() {
    return this.props.controller.paginatorJson(this.props.section);
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

  render() {
    if (!Array.isArray(this.paginatorJson.items)) {
      return <p>{this.paginatorJson.items.error}</p>;
    }

    return (
      <>
        <ContainerContext.Provider value={{ activeKeyDidChange: this.activeKeyDidChange }}>
          <div className={classWithModifiers('play-detail-list', { 'menu-active': this.activeKey != null })}>
            {(this.uniqueItems).map((score) => (
              <KeyContext.Provider key={score.id} value={score.id}>
                <PlayDetail activated={this.activeKey === score.id} score={score} />
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
}

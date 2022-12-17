// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import MultiplayerListJson from 'interfaces/multiplayer-list-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import MultiplayerListStore from 'stores/multiplayer-list-store';
import { trans } from 'utils/lang';
import MultiplayerRoom from './multiplayer-room';

interface Props {
  showMoreRoute: string;
  store: MultiplayerListStore;
}

@observer
export default class MultiplayerList extends React.Component<Props> {
  @observable private loading = false;

  @computed
  private get hasMore() {
    return this.props.store.cursor != null;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    if (this.props.store.rooms.length === 0) {
      return (
        <div className='multiplayer-list'>
          {trans('multiplayer.empty._', {
            type_group: trans(`multiplayer.empty.${this.props.store.typeGroup}`),
          })}
        </div>
      );
    }

    return (
      <div className='multiplayer-list'>
        {this.props.store.rooms.map((room) => <MultiplayerRoom key={room.id} room={room} store={this.props.store} />)}
        <div className='multiplayer-list__more'>
          <ShowMoreLink
            callback={this.handleShowMore}
            hasMore={this.hasMore}
            loading={this.loading}
          />
        </div>
      </div>
    );
  }

  @action
  private handleShowMore = () => {
    if (this.loading) return;

    this.loading = true;
    const url = this.props.showMoreRoute;
    void $.getJSON(url, { cursor: this.props.store.cursor })
      .done(action((response: MultiplayerListJson) => {
        this.props.store.updateWithJson(response);
      })).always(action(() => {
        this.loading = false;
      }));
  };
}

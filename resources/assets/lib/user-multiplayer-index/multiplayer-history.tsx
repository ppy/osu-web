// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import UserJson from 'interfaces/user-json';
import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import Room from 'user-multiplayer-index/room';
import MultiplayerHistoryStore from './multiplayer-history-store';

interface Props {
  store: MultiplayerHistoryStore;
  user: UserJson;
}

@observer
export default class MultiplayerHistory extends React.Component<Props> {
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
        <div className='user-multiplayer-history'>
          {osu.trans('multiplayer.empty._', {
            type_group: osu.trans(`multiplayer.empty.${this.props.store.typeGroup}`),
          })}
        </div>
      );
    }

    return (
      <div className='user-multiplayer-history'>
        {this.props.store.rooms.map((room) => <Room key={room.id} room={room} store={this.props.store} />)}
        <div className='user-multiplayer-history__more'>
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
    const url = route('users.multiplayer.index', { typeGroup: this.props.store.typeGroup, user: this.props.user.id });
    void $.getJSON(url, { cursor: this.props.store.cursor })
      .done(action((response: UserMultiplayerHistoryJson) => {
        this.props.store.updateWithJson(response);
      })).always(action(() => {
        this.loading = false;
      }));
  };
}

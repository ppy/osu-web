// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import RoomListJson from 'interfaces/room-list-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import RoomListStore from 'stores/room-list-store';
import MultiplayerRoom from './multiplayer-room';

interface Props {
  emptyMessage: string;
  showMoreUrl: string;
  store: RoomListStore;
}

@observer
export default class RoomList extends React.Component<Props> {
  @observable private loading = false;

  @computed
  private get hasMore() {
    return this.props.store.cursorString != null;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    if (this.props.store.rooms.length === 0) {
      return (
        <div className='room-list'>
          {this.props.emptyMessage}
        </div>
      );
    }

    return (
      <div className='room-list'>
        {this.props.store.rooms.map((room) => <MultiplayerRoom key={room.id} room={room} />)}
        <ShowMoreLink
          callback={this.handleShowMore}
          hasMore={this.hasMore}
          loading={this.loading}
        />
      </div>
    );
  }

  @action
  private readonly handleShowMore = () => {
    if (this.loading) return;

    this.loading = true;

    const url = this.props.showMoreUrl;
    void $.getJSON(url, { cursor_string: this.props.store.cursorString })
      .done(action((response: RoomListJson) => {
        this.props.store.updateWithJson(response);
      })).always(action(() => {
        this.loading = false;
      }));
  };
}

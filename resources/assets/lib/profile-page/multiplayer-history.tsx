// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserMultiplayerHistoryContext, { updateStore } from 'beatmap-discussions/rooms-context';
import UserJsonExtended from 'interfaces/user-json-extended';
import UserMultiplayerHistoryJson from 'interfaces/user-multiplayer-history-json';
import { route } from 'laroute';
import { action, computed, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import Room from './room';

export interface Props {
  user: UserJsonExtended;
}

@observer
export default class MultiplayerHistory extends React.Component<Props> {
  static contextType = UserMultiplayerHistoryContext;
  declare context: React.ContextType<typeof UserMultiplayerHistoryContext>;

  @observable loading = false;

  @computed
  private get hasMore() {
    return this.context.cursor != null;
  }

  render() {
    return (
      <div className='multiplayer-history'>
        {this.context.rooms.map((room) => <Room key={room.id} room={room} />)}
        <ShowMoreLink
          callback={this.handleShowMore}
          hasMore={this.hasMore}
          loading={this.loading}
        />
      </div>
    );
  }

  @action
  private handleShowMore = () => {
    if (this.loading) return;

    this.loading = true;
    const url = route('users.multiplayer.index', { user: this.props.user.id });
    void $.getJSON(url, { cursor: this.context.cursor })
      .done(action((response: UserMultiplayerHistoryJson) => {
        updateStore(this.context, response);
      })).always(action(() => {
        this.loading = false;
      }));
  };
}

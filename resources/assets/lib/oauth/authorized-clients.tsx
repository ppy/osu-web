// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import { AuthorizedClient } from 'oauth/authorized-client';
import * as osu from 'osu-common';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.clientStore;

@observer
export class AuthorizedClients extends React.Component {
  render() {
    return (
      <div className='oauth-clients'>
        {store.clients.size > 0 ? this.renderClients() : this.renderEmpty()}
      </div>
    );
  }

  renderClients() {
    return [...store.clients.values()].map((client) => (
      <div key={client.id} className='oauth-clients__client'>
        <AuthorizedClient client={client} />
      </div>

    ));
  }

  renderEmpty() {
    return <div className='oauth-clients__client'>{osu.trans('oauth.authorized_clients.none')}</div>;
  }
}

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { observer } from 'mobx-react';
import { AuthorizedClient } from 'oauth/authorized-client';
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
    return [...store.clients.values()].map((client) => {
      return (
        <div className='oauth-clients__client' key={client.id}>
          <AuthorizedClient client={client} />
        </div>

      );
    });
  }

  renderEmpty() {
    return <div className='oauth-clients__client'>{osu.trans('oauth.authorized_clients.none')}</div>;
  }
}

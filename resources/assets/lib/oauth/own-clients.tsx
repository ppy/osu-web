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

import { OwnClient } from 'oauth/own-client-component';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.ownClientStore;

export class OwnClients extends React.Component {
  render() {
    return (
      <div className='authorized-clients'>
        {store.clients.size > 0 ? this.renderClients() : this.renderEmpty()}
      </div>
    );
  }

  renderClients() {
    return [...store.clients.values()].map((client) => {
      return <OwnClient client={client} key={client.id} />;
    });
  }
  renderEmpty() {
    return osu.trans('oauth.own-clients.none');
  }
}

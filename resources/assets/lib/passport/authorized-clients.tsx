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

import { runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.clientStore;

@observer
export class AuthorizedClients extends React.Component {
  componentDidMount() {
    runInAction(() => store.fetchAll());
  }

  render() {
    const rows: JSX.Element[] = [];
    for (const client of store.clients.values()) {
      rows.push((
        <tr key={client.id}>
          <td>{client.name}</td>
          <td>{Array.from(client.scopes).join(', ')}</td>
          <td>
            { client.revoked ? (
              'Revoked'
            ) : (
              <button
                data-client-id={client.id}
                onClick={this.revokeClicked}
              >
                Revoke
              </button>
            )}
          </td>
        </tr>
      ));
    }

    return (
      <table>
        <thead>
          <tr>
            <td>Name</td>
            <td>Scopes</td>
            <td />
          </tr>
        </thead>
        <tbody>
          {rows}
        </tbody>
      </table>
    );
  }

  revokeClicked = (event: React.MouseEvent<HTMLElement>) => {
    if (!confirm('Revoke this token?')) { return; }

    const clientId = (event.target as HTMLElement).dataset.clientId;
    if (clientId != null) {
      store.revoke(+clientId);
    }
  }
}

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
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.tokenStore;

interface Props {
}

@observer
export class AuthorizedClients extends React.Component<Props> {
  componentDidMount() {
    store.fetchAll();
  }

  render() {
    const rows: JSX.Element[] = [];
    for (const token of store.tokens.values()) {
      rows.push((
        <tr key={token.id}>
          <td>{token.client.name}</td>
          <td>{token.scopes.join(', ')}</td>
          <td>{token.created_at}</td>
          <td>{token.expires_at}</td>
          <td>
            <button
              data-token-id={token.id}
              onClick={this.revokeClicked}
            >
              Revoke
            </button>
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
            <td>Created At</td>
            <td>Expires At</td>
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

    const tokenId = (event.target as HTMLElement).dataset.tokenId;
    if (tokenId != null) {
      store.revoke(tokenId);
    }
  }
}

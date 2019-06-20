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

import * as React from 'react';

interface ClientJSON {
  created_at: string;
  id: number;
  name: string | null;
  password_client: boolean;
  personal_access_client: boolean;
  redirect: string;
  revoked: boolean;
  updated_at: string;
  user_id: number;
}

interface TokenJSON {
  client: ClientJSON;
  client_id: number;
  created_at: string;
  expires_at: string;
  id: string;
  name: string | null;
  revoked: boolean;
  scopes: [];
  updated_at: string;
  user_id: number;
}

interface Props {
}

interface State {
  tokens: TokenJSON[];
}

export class AuthorizedClients extends React.Component<Props, State> {
  readonly state: State = {
    tokens: [],
  };

  componentDidMount() {
    this.getTokens();
  }

  render() {
    const rows: JSX.Element[] = [];
    for (const token of this.state.tokens) {
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

  async getTokens() {
    const response: TokenJSON[] = await $.get('/oauth/tokens');
    this.setState({
      tokens: response,
    });
  }

  async revoke(id: string) {
    await $.ajax({
      method: 'DELETE',
      url: '/oauth/tokens/' + id,
    });

    this.getTokens();
  }

  revokeClicked = (event: React.MouseEvent<HTMLElement>) => {
    if (!confirm('Revoke this token?')) { return; }

    const tokenId = (event.target as HTMLElement).dataset.tokenId;
    if (tokenId != null) {
      this.revoke(tokenId);
    }
  }
}
